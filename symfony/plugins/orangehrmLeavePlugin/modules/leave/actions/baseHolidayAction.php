<?php

abstract class baseHolidayAction extends orangehrmAction {

    protected $holidayTypeService;

    /**
     *
     * @return HolidayTypeService
     */
    protected function getHolidayTypeService() {
        if (!($this->holidayTypeService instanceof HolidayTypeService)) {
            $this->holidayTypeService = new HolidayTypeService();
        }
        return $this->holidayTypeService;
    }

    /**
     *
     * @param HolidayTypeService $service 
     */
    protected function setHolidayTypeService(HolidayTypeService $service) {
        $this->holidayTypeService = $service;
    }
    
    /**
     * 
     * @param type $dataGroups
     * @return type
     */
    public function getDataGroupPermissions($dataGroups, $self = false) {
        return $this->getContext()->getUserRoleManager()->getDataGroupPermissions($dataGroups, array(), array(), $self, array());
    }
}