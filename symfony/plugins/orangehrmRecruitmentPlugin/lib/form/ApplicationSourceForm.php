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

class ApplicationSourceForm extends BaseForm {
    
    private $applicationSourceService;
    
    public function getApplicationSourceService() {
        
        if (!($this->applicationSourceService instanceof ApplicationSourceService)) {
            $this->applicationSourceService = new ApplicationSourceService();
        }
        
        return $this->applicationSourceService;
    }

    public function setApplicationSourceService($applicationSourceService) {
        $this->applicationSourceService = $applicationSourceService;
    }

    public function configure() {

        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'description' => new sfWidgetFormTextArea(array(),array('rows'=>5,'cols'=>10)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorNumber(array('required' => false)),
            'name' => new sfValidatorString(array('required' => true, 'max_length' => 120)),
            'description' => new sfValidatorString(array('required' => false, 'max_length' => 250)),
        ));

        $this->widgetSchema->setNameFormat('applicationSource[%s]');

        $this->setDefault('id', '');
	}
    
    public function save() {
        
        $id = $this->getValue('id');
  
        if (empty($id)) {
            $applicationSource = new ApplicationSource();
            $message = array('messageType' => 'success', 'message' => __(TopLevelMessages::SAVE_SUCCESS));
        } else {
            $applicationSource = $this->getApplicationSourceService()->getApplicationSourceById($id);
            $message = array('messageType' => 'success', 'message' => __(TopLevelMessages::UPDATE_SUCCESS));
        }
        
        $applicationSource->setName($this->getValue('name'));
        $applicationSource->setDescription($this->getValue('description'));            
        $this->getApplicationSourceService()->saveApplicationSource($applicationSource);        
        
        return $message;
        
    }
    
    public function getApplicationSourceListAsJson() {

        $list = array();
        $applicationSourceList = $this->getApplicationSourceService()->getApplicationSourceList();
        foreach ($applicationSourceList as $applicationSource) {
            $list[] = array('id' => $applicationSource->getId(), 'name' => $applicationSource->getName());
        }
        return json_encode($list);
    }

}

?>
