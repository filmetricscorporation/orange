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
 *
 */

class CharacterReferenceForm extends BaseForm {
    
    private $characterReferenceService;
    
    public function getCharacterReferenceService() {
        
        if (!($this->characterReferenceService instanceof CharacterReferenceService)) {
            $this->characterReferenceService = new CharacterReferenceService();
        }
        
        return $this->characterReferenceService;
    }

    public function setCharacterReferenceService($characterReferenceService) {
        $this->characterReferenceService = $characterReferenceService;
    }

    public function configure() {

        $this->setWidgets(array(
            'seqno' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'relation' => new sfWidgetFormInputText(),
            'company' => new sfWidgetFormInputText(),
            'position' => new sfWidgetFormInputText(),
            'contact_number' => new sfWidgetFormInputText(),            
        ));

        $this->setValidators(array(
            'seqno' => new sfValidatorNumber(array('required' => false)),
            'name' => new sfValidatorString(array('required' => true, 'max_length' => 150)),
            'relation' => new sfValidatorString(array('required' => false, 'max_length' => 50)),
            'company' => new sfValidatorString(array('required' => true, 'max_length' => 100)),
            'position' => new sfValidatorString(array('required' => false, 'max_length' => 50)),
            'contact_number' => new sfValidatorString(array('required' => false, 'max_length' => 50)),
        ));

        $this->widgetSchema->setNameFormat('characterReference[%s]');

        $this->setDefault('id', '');
	}
    
    public function save() {
        
        $seqno = $this->getValue('seqno');
        
        if (empty($seqno)) {
            $characterReference = new CharacterReference();
            $message = array('messageType' => 'success', 'message' => __(TopLevelMessages::SAVE_SUCCESS));
        } else {
            $characterReference = $this->getCharacterReferenceService()->getCharacterReferenceById($seqno);
            $message = array('messageType' => 'success', 'message' => __(TopLevelMessages::UPDATE_SUCCESS));
        }
        
        $characterReference->setSeqno($this->getValue('seqno'));
        $characterReference->setName($this->getValue('name'));
        $characterReference->setRelation($this->getValue('relation'));
        $characterReference->setCompany($this->getValue('company'));
        $characterReference->setPosition($this->getValue('position'));
        $characterReference->setContactNumber($this->getValue('contact_number'));
                   
        $this->getCharacterReferenceService()->saveCharacterReference($characterReference);        
        
        return $message;
        
    }
    
    public function getCharacterReferenceListAsJson() {

        $list = array();
        $characterReferenceList = $this->getCharacterReferenceService()->getCharacterReferenceList();
        foreach ($characterReferenceList as $characterReference) {
            $list[] = array('id' => $characterReference->getId(), 'name' => $characterReference->getName());
        }
        return json_encode($list);
    }

}

?>
