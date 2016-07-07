<?php
/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 */
class EmployeeCharacterReferenceForm extends sfForm {
    
    private $employeeService;
    public $fullName;
    public $isConfidential;
    private $widgets = array();
    public $empCharacterReferenceList;

    /**
     * Get EmployeeService
     * @returns EmployeeService
     */
    public function getEmployeeService() {
        if(is_null($this->employeeService)) {
            $this->employeeService = new EmployeeService();
            $this->employeeService->setEmployeeDao(new EmployeeDao());
        }
        return $this->employeeService;
    }

    /**
     * Set EmployeeService
     * @param EmployeeService $employeeService
     */
    public function setEmployeeService(EmployeeService $employeeService) {
        $this->employeeService = $employeeService;
    }

    public function configure() {
        $this->characterReferencePermissions = $this->getOption('characterReferencePermissions');
        
        $empNumber = $this->getOption('empNumber');
        $employee = $this->getEmployeeService()->getEmployee($empNumber);
        $this->fullName = $employee->getFullName();
        
        // 20160426
        $this->fullName = $employee->getFullName() . "|" . $employee->is_confidential;

        $this->empCharacterReferenceList = $this->getEmployeeService()->getEmployeeCharacterReferences($empNumber);

        $widgets = array('emp_number' => new sfWidgetFormInputHidden(array(), array('value' => $empNumber)));
        $validators = array('emp_number' => new sfValidatorString(array('required' => false)));
        
        if ($this->characterReferencePermissions->canRead()) {

            $characterReferencesWidgets = $this->getCharacterReferencesWidgets();
            $characterReferencesValidators = $this->getCharacterReferencesValidators();

            if (!($this->characterReferencePermissions->canUpdate() || $this->characterReferencePermissions->canCreate()) ) {
                foreach ($characterReferencesWidgets as $widgetName => $widget) {
                    $widget->setAttribute('disabled', 'disabled');
                }
            }
            $widgets = array_merge($widgets, $characterReferencesWidgets);
            $validators = array_merge($validators, $characterReferencesValidators);
        }

        $this->setWidgets($widgets);
        $this->setValidators($validators);


        $this->widgetSchema->setNameFormat('characterReference[%s]');
    }
    
    
    /*
     * Tis fuction will return the widgets of the form
     */
    public function getCharacterReferencesWidgets() {
        $widgets = array();

        //creating widgets
        //$widgets['code'] = new sfWidgetFormSelect(array('choices' => $this->_getCharacterReferenceList()));
        $widgets['name'] = new sfWidgetFormInputText();
        $widgets['relation'] = new sfWidgetFormInputText();
        $widgets['company'] = new sfWidgetFormInputText();
        $widgets['position'] = new sfWidgetFormInputText();
        $widgets['contact_number'] = new sfWidgetFormInputText();

        return $widgets;
    }

    /*
     * Tis fuction will return the form validators
     */
    public function getCharacterReferencesValidators() {
        
        $validators = array(
            'name' => new sfValidatorString(array('required' => true, 'max_length' => 150)),
            'relation' => new sfValidatorString(array('required' => false, 'max_length' => 50)),
            'company' => new sfValidatorString(array('required' => true, 'max_length' => 100)),
            'position' => new sfValidatorString(array('required' => false, 'max_length' => 50)),
            'contact_number' => new sfValidatorString(array('required' => false, 'max_length' => 30)),
        );

        return $validators;
    }

    private function _getCharacterReferenceList() {
        $characterReferenceService = new CharacterReferenceService();
        $characterReferenceList = $characterReferenceService->getCharacterReferenceList();
        $list = array("" => "-- " . __('Select') . " --");

        foreach($characterReferenceList as $characterReference) {
            $list[$characterReference->getId()] = $characterReference->getName();
        }
        
        return $list;
    }
}
?>