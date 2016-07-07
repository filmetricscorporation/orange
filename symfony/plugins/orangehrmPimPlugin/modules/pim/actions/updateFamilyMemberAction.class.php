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
 * Actions class for PIM module updateFamilyMemberAction
 */
class updateFamilyMemberAction extends basePimAction {

    /**
     * Add / update employee familymember
     *
     * @param int $empNumber Employee number
     *
     * @return boolean true if successfully assigned, false otherwise
     */
    public function execute($request) {

        $familymember = $request->getParameter('familymember');

        $empNumber = (isset($familymember['empNumber'])) ? $familymember['empNumber'] : $request->getParameter('empNumber');
        $this->empNumber = $empNumber;

        $this->familymemberPermissions = $this->getDataGroupPermissions('family_members', $empNumber);

        var_dump($familymember);

        $loggedInEmpNum = $this->getUser()->getEmployeeNumber();
        $adminMode = $this->getUser()->hasCredential(Auth::ADMIN_ROLE);
        
        if (!$this->IsActionAccessible($empNumber)) {
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }

        $essMode = !$adminMode && !empty($loggedInEmpNum) && ($empNumber == $loggedInEmpNum);
        $param = array('empNumber' => $empNumber, 'ESS' => $essMode, 'familymemberPermissions' => $this->familymemberPermissions);

        $this->form = new EmployeeFamilyMemberForm(array(), $param, true);

        if ($this->familymemberPermissions->canUpdate() || $this->familymemberPermissions->canCreate()) {
            if ($this->getRequest()->isMethod('post')) {

                $this->form->bind($request->getParameter($this->form->getName()));
                if ($this->form->isValid()) {
                    $this->form->save();
                    $this->getUser()->setFlash('viewFamilyMembers.success', __(TopLevelMessages::SAVE_SUCCESS));
                }
            }
        }

        $empNumber = $request->getParameter('empNumber');

        $this->redirect('pim/viewFamilyMembers?empNumber=' . $empNumber);
    }

}
