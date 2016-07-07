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
 * Actions class for PIM module familymembers
 */
class viewFamilyMembersAction extends basePimAction {

    /**
     * @param sfForm $form
     * @return
     */
    public function setForm(sfForm $form) {
        if (is_null($this->form)) {
            $this->form = $form;
        }
    }

    public function execute($request) {

        $loggedInEmpNum = $this->getUser()->getEmployeeNumber();
        $this->showBackButton = true;

        $familymemberParams = $request->getParameter('familymember');
        $empNumber = (isset($familymemberParams['empNumber'])) ? $familymemberParams['empNumber'] : $request->getParameter('empNumber');
        $this->empNumber = $empNumber;

        $this->familymemberPermissions = $this->getDataGroupPermissions('family_members', $empNumber);

        $adminMode = $this->getUser()->hasCredential(Auth::ADMIN_ROLE);

        //hiding the back button if its self ESS view
        if ($loggedInEmpNum == $empNumber) {
            $this->showBackButton = false;
        }

        if (!$this->IsActionAccessible($empNumber)) {
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }

        $essMode = !$adminMode && !empty($loggedInEmpNum) && ($empNumber == $loggedInEmpNum);
        $param = array('empNumber' => $empNumber, 'ESS' => $essMode, 'familymemberPermissions' => $this->familymemberPermissions);

        $this->setForm(new EmployeeFamilyMemberForm(array(), $param, true));
        $this->deleteForm = new EmployeeFamilyMembersDeleteForm(array(), $param, true);

        $this->familymembers = $this->getEmployeeService()->getEmployeeFamilyMembers($this->empNumber);
    }

}
