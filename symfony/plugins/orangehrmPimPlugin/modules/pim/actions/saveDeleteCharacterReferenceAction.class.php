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
class saveDeleteCharacterReferenceAction extends basePimAction {

    /**
     * @param sfForm $form
     * @return
     */
    public function setCharacterReferenceForm(sfForm $form) {
        if (is_null($this->characterReferenceForm)) {
            $this->characterReferenceForm = $form;
        }
    }

    public function execute($request) {
        $form = new DefaultListForm();
        $form->bind($request->getParameter($form->getName()));
        $experience = $request->getParameter('experience');
        $empNumber = (isset($experience['emp_number'])) ? $experience['emp_number'] : $request->getParameter('empNumber');

        if (!$this->IsActionAccessible($empNumber)) {
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }

        $this->characterReferencePermissions = $this->getDataGroupPermissions('qualification_character_reference', $empNumber);

        $this->setCharacterReferenceForm(new CharacterReferenceForm(array(), array('empNumber' => $empNumber, 'characterReferencePermissions' => $this->characterReferencePermissions), true));

        //this is to save work experience
        if ($request->isMethod('post')) {
            if ($request->getParameter('option') == "save") {
                if ($this->characterReferencePermissions->canCreate() || $this->characterReferencePermissions->canUpdate()) {

                    $this->characterReferenceForm->bind($request->getParameter($this->characterReferenceForm->getName()));

                    if ($this->characterReferenceForm->isValid()) {
                        $characterReference = $this->getCharacterReference($this->characterReferenceForm);
                        $this->setOperationName(($characterReference->getSeqno() == '') ? 'ADD WORK EXPERIENCE' : 'CHANGE WORK EXPERIENCE');
                        $this->getEmployeeService()->saveEmployeeCharacterReference($characterReference);
                        $this->getUser()->setFlash('workexperience.success', __(TopLevelMessages::SAVE_SUCCESS));
                    } else {
                       $this->getUser()->setFlash('workexperience.warning', __('Form Validation Failed.'));
                    }
                }
            }

            //this is to delete work experience
            if ($request->getParameter('option') == "delete") {
                if ($this->characterReferencePermissions->canDelete()) {
                    $deleteIds = $request->getParameter('delWorkExp');

                    if (count($deleteIds) > 0) {
                        $this->setOperationName('DELETE WORK EXPERIENCE');
                        if ($form->isValid()) {
                            $this->getEmployeeService()->deleteEmployeeCharacterReferenceRecords($empNumber, $request->getParameter('delWorkExp'));
                            $this->getUser()->setFlash('workexperience.success', __(TopLevelMessages::DELETE_SUCCESS));
                        }
                    }
                }
            }
        }
        $this->getUser()->setFlash('qualificationSection', 'workexperience');
        $this->redirect('pim/viewQualifications?empNumber=' . $empNumber . '#workexperience');
    }

    private function getCharacterReference(sfForm $form) {

        $post = $form->getValues();

        $characterReference = $this->getEmployeeService()->getEmployeeCharacterReferences($post['emp_number'], $post['seqno']);

        if (!$characterReference instanceof EmpCharacterReference) {
            $characterReference = new EmpCharacterReference();
        }

        $characterReference->emp_number = $post['emp_number'];
        $characterReference->seqno = $post['seqno'];
        $characterReference->name = $post['name'];
        $characterReference->relation = $post['relation'];
        $characterReference->company = $post['company'];
        $characterReference->position = $post['position'];
        $characterReference->contactno = $post['contact_number'];

        return $characterReference;
    }

}

?>