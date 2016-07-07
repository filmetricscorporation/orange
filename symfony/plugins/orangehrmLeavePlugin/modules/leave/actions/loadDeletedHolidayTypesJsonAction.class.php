<?php

class loadDeletedHolidayTypesJsonAction extends baseCoreHolidayAction {
    public function execute($request) {
        $deletedHolidayTypesList = $this->getHolidayTypeNames();
        $this->getResponse()->setContent(json_encode($deletedHolidayTypesList));
        return sfView::NONE;
    }
    
    protected function getHolidayTypeNames() {
        return $this->getHolidayTypeService()->getDeletedHolidayTypeNamesArray();
    }    
}
