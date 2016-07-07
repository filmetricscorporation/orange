<?php

/*
  // OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
  // all the essential functionalities required for any enterprise.
  // Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com

  // OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
  // the GNU General Public License as published by the Free Software Foundation; either
  // version 2 of the License, or (at your option) any later version.

  // OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
  // without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
  // See the GNU General Public License for more details.

  // You should have received a copy of the GNU General Public License along with this program;
  // if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
  // Boston, MA  02110-1301, USA
 */

/**
 * Form class for employee workshift detail
 */
class EmployeeWorkShiftForm extends BaseForm {

    public $fullName;
    public $isConfidential;
    private $currencyService;
    public $havePayGrades = false;
    private $payGrades;
    private $currencies;
    private $payPeriods;

    /**
     * Get CurrencyService
     * @returns CurrencyService
     */
    public function getCurrencyService() {
        if (is_null($this->currencyService)) {
            $this->currencyService = new CurrencyService();
        }
        return $this->currencyService;
    }

    /**
     * Set CurrencyService
     * @param CurrencyService $currencyService
     */
    public function setCurrencyService(CurrencyService $currencyService) {
        $this->currencyService = $currencyService;
    }

    public function configure() {
         $this->workshiftPermissions = $this->getOption('workshiftPermissions');
         
        $empNumber = $this->getOption('empNumber');
        $employee = $this->getOption('employee');
         //$this->fullName = $employee->getFullName();
        
        // 20160426
        $this->fullName = $employee->getFullName() . "|" . $employee->is_confidential;

        $this->payGrades = $this->_getPayGrades();
        $this->currencies = $this->_getCurrencies();
        $this->payPeriods = $this->_getPayPeriods();

        $widgets = array('emp_number' => new sfWidgetFormInputHidden(array(), array('value' => $empNumber)));
        $validators = array('emp_number' => new sfValidatorString(array('required' => true)));

        if ($this->workshiftPermissions->canRead()) {

            $workshiftWidgets = $this->getWorkShiftWidgets();
            $workshiftValidators = $this->getWorkShiftValidators();

            if (!($this->workshiftPermissions->canUpdate() || $this->workshiftPermissions->canCreate()) ) {
                foreach ($workshiftWidgets as $widgetName => $widget) {
                    $widget->setAttribute('disabled', 'disabled');
                }
            }
            $widgets = array_merge($widgets, $workshiftWidgets);
            $validators = array_merge($validators, $workshiftValidators);
        }

        $this->setWidgets($widgets);
        $this->setValidators($validators);

        $this->widgetSchema->setNameFormat('workshift[%s]');

        // set up your post validator method
        $this->validatorSchema->setPostValidator(
                new sfValidatorCallback(array(
                    'callback' => array($this, 'postValidate')
                ))
        );
    }

    /*
     * Tis fuction will return the widgets of the form
     */

    public function getWorkShiftWidgets() {
        $widgets = array();

        //creating widgets
        // Note: Widget names were kept from old non-symfony version
        $widgets['id'] = new sfWidgetFormInputHidden();
        $widgets['workshift_id'] = new sfWidgetFormSelect(array('choices' => $this->currencies));
        $widgets['dayperiod_code'] = new sfWidgetFormSelect(array('choices' => $this->payPeriods));

        if (count($this->payGrades) > 0) {
            $this->havePayGrades = true;
            $widgets['work_shift_code'] = new sfWidgetFormSelect(array('choices' => $this->payGrades));
        } else {
            $widgets['work_shift_code'] = new sfWidgetFormInputHidden();
        }

        // Remove default options from list validated against
        //unset($this->payGrades['']);
        unset($this->currencies['']);
        unset($this->payPeriods['']);

        return $widgets;
    }

    /*
     * Tis fuction will return the form validators
     */

    public function getWorkShiftValidators() {

        $validators = array(
            'id' => new sfValidatorNumber(array('required' => false, 'min' => 0)),
            'workshift_id' => new sfValidatorChoice(array('required' => true, 'choices' => array_keys($this->currencies))),
            //'basic_workshift' => new sfValidatorNumber(array('required' => true, 'trim' => true, 'min' => 0, 'max' => 999999999.99)),
            'dayperiod_code' => new sfValidatorChoice(array('required' => false, 'choices' => array_keys($this->payPeriods))),
            //'workshift_component' => new sfValidatorString(array('required' => false, 'max_length' => 100)),
            //'comments' => new sfValidatorString(array('required' => false, 'max_length' => 255)),
            //'set_direct_debit' => new sfValidatorString(array('required' => false)),
        );
        
        if ($this->havePayGrades) {
            $validator = array('work_shift_code' => new sfValidatorChoice(array('required' => false, 'choices' => array_keys($this->payGrades))));
        } else {
            // We do not expect a value. Validate as an empty string
            $validator = array('work_shift_code' => new sfValidatorString(array('required' => false, 'max_length' => 10)));
        }
        
        $validators = array_merge($validators, $validator);

        return $validators;
    }

    public function postValidate($validator, $values) {
        $service = new PayGradeService();

        $workshiftGrade = $values['sal_grd_code'];

        $workshift = $values['basic_workshift'];

        if (!empty($workshiftGrade)) {

            $workshiftDetail = $service->getCurrencyByCurrencyIdAndPayGradeId($values['currency_id'], $workshiftGrade);


            if (empty($workshiftDetail)) {

                $message = sfContext::getInstance()->getI18N()->__('Invalid WorkShift Grade.');
                $error = new sfValidatorError($validator, $message);
                throw new sfValidatorErrorSchema($validator, array('' => $error));
            } else if ((!empty($workshiftDetail->minWorkShift) && ($workshift < $workshiftDetail->minWorkShift)) ||
                    (!empty($workshiftDetail->maxWorkShift) && ($workshift > $workshiftDetail->maxWorkShift))) {

                $message = sfContext::getInstance()->getI18N()->__('WorkShift should be within min and max');
                $error = new sfValidatorError($validator, $message);
                throw new sfValidatorErrorSchema($validator, array('basic_workshift' => $error));
            }
        } else {
            $values['sal_grd_code'] = null;
        }

        // cleanup cmbPayPeriod
        $payPeriod = $values['payperiod_code'];
        if ($payPeriod == '0' || $payPeriod = '') {
            $values['payperiod_code'] = null;
        }

        // Convert workshift to a string. Since database field is a string field.
        // Otherwise, it may be converted to a string using scientific notation when encrypting.
        //        
        // Remove trailing zeros - will always have decimal point, so 
        // only trailing decimals are removed.
        $formattedWorkShift = rtrim(sprintf("%.2F", $workshift), '0');

        // Remove decimal point (if it is the last char).
        $formattedWorkShift = rtrim($formattedWorkShift, '.');

        $values['basic_workshift'] = $formattedWorkShift;

        return $values;
    }

    /**
     * Get EmployeeWorkShift object
     */
    public function getWorkShift() {

        $id = $this->getValue('id');

        $empWorkShift = false;

        if (!empty($id)) {
            $empWorkShift = Doctrine::getTable('EmployeeWorkShift')->find($id);
        }

        if ($empWorkShift === false) {
            $empWorkShift = new EmployeeWorkShift();
        }

        $empWorkShift->setEmpNumber($this->getValue('emp_number'));
        $empWorkShift->setPayGradeId($this->getValue('sal_grd_code'));
        $empWorkShift->setCurrencyCode($this->getValue('currency_id'));
        $empWorkShift->setPayPeriodId($this->getValue('payperiod_code'));
        $empWorkShift->setWorkShiftName($this->getValue('workshift_component'));
        $empWorkShift->setAmount($this->getValue('basic_workshift'));
        $empWorkShift->setNotes($this->getValue('comments'));
        
        $setDirectDebit = $this->getValue('set_direct_debit');
        if ($setDirectDebit) {
            
        }

        return $empWorkShift;
    }

    private function _getPayGrades() {
        $choices = array();

        $service = new WorkShiftService();
        $payGrades = $service->getWorkShiftList();

        if (count($payGrades) > 0) {
            $choices = array('' => '-- ' . __('Select') . ' --');

            foreach ($payGrades as $payGrade) {
                //$choices[$payGrade->getId()] = $payGrade->getName() . "   [" . $payGrade->getStartTime() . " - " . $payGrade->getStartTime() . "]";
                //$choices[$payGrade->getId()] = $payGrade->getName(); echo "test";
            }
        }
        return $choices;
    }

    /**
     * Get Pay Periods as array.
     * 
     * @return Array (empty array if no pay periods defined).
     */
    private function _getPayPeriods() {
        //$payPeriods = Doctrine::getTable('Payperiod')->findAll();

        //foreach ($payPeriods as $payPeriod) {
        //    $choices[$payPeriod->getCode()] = $payPeriod->getName();
        //}

        //asort($choices);

        //$choices = array('' => '-- ' . __('Select') . ' --') + $choices;
        $i18nHelper = sfContext::getInstance()->getI18N();
        $choices = array('' => "-- " . __('Select') . " --", 'Monday'=> $i18nHelper->__('Monday'), 'Tuesday'=> $i18nHelper->__('Tuesday'), 'Wednesday'=> $i18nHelper->__('Wednesday'), 'Thursday'=> $i18nHelper->__('Thursday'), 'Friday'=> $i18nHelper->__('Friday'), 'Saturday'=> $i18nHelper->__('Saturday'), 'Sunday'=> $i18nHelper->__('Sunday'));

        return $choices;
    }

    private function _getCurrencies() {
        $currencies = $this->getCurrencyService()->getCurrencyList();
        $choices = array('' => '-- ' . __('Select') . ' --');

        foreach ($currencies as $currency) {
            $choices[$currency->getCurrencyId()] = $currency->getCurrencyName();
        }
        return $choices;
    }

}

