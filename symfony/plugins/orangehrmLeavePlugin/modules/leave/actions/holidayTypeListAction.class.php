<?php

class holidayTypeListAction extends baseHolidayAction {

    public function execute($request) {

        $message = $this->getUser()->getFlash('templateMessage');
        $this->messageType = (isset($message[0])) ? strtolower($message[0]) : "";
        $this->message = (isset($message[1])) ? $message[1] : "";
        
        $this->holidayTypePermissions = $this->getDataGroupPermissions('holiday_types');
        if ($this->holidayTypePermissions->canRead()) {
            $this->_setListComponent($this->getHolidayTypeList(), $this->holidayTypePermissions);
        }
    }

    protected function getHolidayTypeList() {

        $holidayTypeService = new HolidayTypeService();
        $holidayTypeDao = new HolidayTypeDao();
        $holidayTypeService->setHolidayTypeDao($holidayTypeDao);

        return $holidayTypeService->getHolidayTypeList();
    }

    protected function _setListComponent($holidayTypeList, $permissions) {
        $runtimeDefinitions = array();
        $buttons = array();

        if ($permissions->canCreate()) {
            $buttons['Add'] = array('label' => 'Add');
        }

        if (!$permissions->canDelete()) {
            $runtimeDefinitions['hasSelectableRows'] = false;
        } else if ($permissions->canDelete()) {
            $buttons['Delete'] = array('label' => 'Delete',
                'type' => 'submit',
                'data-toggle' => 'modal',
                'data-target' => '#deleteConfModal',
                'class' => 'delete');
        }
        $runtimeDefinitions['buttons'] = $buttons;
        
        $readOnlyHolidayTypeIds = $this->getUnselectableHolidayTypeIds();

        if (count($readOnlyHolidayTypeIds) > 0) {
            $runtimeDefinitions['unselectableRowIds'] = $readOnlyHolidayTypeIds;
        }
        
        $configurationFactory = $this->getListConfigurationFactory();
        
        $configurationFactory->setRuntimeDefinitions($runtimeDefinitions);
        ohrmListComponent::setActivePlugin('orangehrmLeavePlugin');
        ohrmListComponent::setConfigurationFactory($configurationFactory);
        ohrmListComponent::setListData($holidayTypeList);
        ohrmListComponent::setPageNumber(0);
        $numRecords = count($holidayTypeList);
        ohrmListComponent::setItemsPerPage($numRecords);
        ohrmListComponent::setNumberOfRecords($numRecords);
    }

    protected function getListConfigurationFactory() {
        return new HolidayTypeListConfigurationFactory();
    }
    
    protected function getUnselectableHolidayTypeIds() {
        return array();
    }

}
