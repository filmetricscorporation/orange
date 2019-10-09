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

/**
 * viewWorkShiftAction
 */
class viewWorkShiftListAction extends basePimAction {

    public function execute($request) {

        $loggedInEmpNum = $this->getUser()->getEmployeeNumber();
        $loggedInUserName = $_SESSION['fname'];

        $workshift = $request->getParameter('workshift');
        $empNumber = (isset($workshift['emp_number'])) ? $workshift['emp_number'] : $request->getParameter('empNumber');
        $this->empNumber = $empNumber;
        $this->essUserMode = !$this->isAllowedAdminOnlyActions($loggedInEmpNum, $empNumber);

        $this->ownRecords = ($loggedInEmpNum == $empNumber) ? true : false;

        $this->workshiftPermissions = $this->getDataGroupPermissions('workshift_details', $empNumber);

        //var_dump($this->workshiftPermissions);

        $adminMode = $this->getUser()->hasCredential(Auth::ADMIN_ROLE);
        $this->isSupervisor = $this->isSupervisor($loggedInEmpNum, $empNumber);

        $this->essMode = !$adminMode && !empty($loggedInEmpNum) && ($empNumber == $loggedInEmpNum);

        if (!$this->IsActionAccessible($empNumber)) {
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }

        $employee = $this->getEmployeeService()->getEmployee($empNumber);
        $params = array('empNumber' => $empNumber, 'ESS' => $this->essMode,
            'employee' => $employee,
            'loggedInUser' => $loggedInEmpNum,
            'loggedInUserName' => $loggedInUserName,
            'workshiftPermissions' => $this->workshiftPermissions);

        $this->form = new EmployeeWorkShiftForm(array(), $params, true);


        // TODO: Use embedForm or mergeForm?
        $this->directDepositForm = new EmployeeDirectDepositForm(array(), array(), true);

        if ($this->getRequest()->isMethod('post')) {

            // Handle the form submission    
            $this->form->bind($request->getParameter($this->form->getName()));

            if ($this->form->isValid()) {

                if ($this->workshiftPermissions->canCreate() || $this->workshiftPermissions->canUpdate()) {

                    $workshift = $this->form->getWorkShift();

                    $setDirectDebit = $this->form->getValue('set_direct_debit');
                    $directDebitOk = true;

                    if (!empty($setDirectDebit)) {

                        $this->directDepositForm->bind($request->getParameter($this->directDepositForm->getName()));

                        if ($this->directDepositForm->isValid()) {
                            $this->directDepositForm->getDirectDeposit($workshift);
                        } else {

                            $validationMsg = '';
                            foreach ($this->directDepositForm->getWidgetSchema()->getPositions() as $widgetName) {
                                if ($this->directDepositForm[$widgetName]->hasError()) {
                                    $validationMsg .= $widgetName . ' ' . __($this->directDepositForm[$widgetName]->getError()->getMessageFormat());
                                }
                            }

                            $this->getUser()->setFlash('warning', $validationMsg);
                            $directDebitOk = false;
                        }
                    } else {
                        $workshift->directDebit->delete();
                        $workshift->clearRelated('directDebit');
                    }

                    if ($directDebitOk) {
                        $service = $this->getEmployeeService();
                        $this->setOperationName('UPDATE SALARY');
                        $service->saveEmployeeWorkShift($workshift);                

                        $this->getUser()->setFlash('workshift.success', __(TopLevelMessages::SAVE_SUCCESS));  
                    }
                }
            } else {
                $validationMsg = '';
                foreach ($this->form->getWidgetSchema()->getPositions() as $widgetName) {
                    if ($this->form[$widgetName]->hasError()) {
                        $validationMsg .= $widgetName . ' ' . __($this->form[$widgetName]->getError()->getMessageFormat());
                    }
                }

                $this->getUser()->setFlash('warning', $validationMsg);
            }
            $this->redirect('pim/viewWorkShiftList?empNumber=' . $empNumber);  
        } else {
            if ($this->workshiftPermissions->canRead()) {
                $this->workshiftList = $this->getEmployeeService()->getEmployeeSalaries($empNumber);
            }
        }
        $this->listForm = new DefaultListForm();
    }

}
