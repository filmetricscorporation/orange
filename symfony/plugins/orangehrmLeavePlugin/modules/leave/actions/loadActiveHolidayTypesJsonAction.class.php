<?php

class loadActiveHolidayTypesJsonAction extends baseCoreHolidayAction {

    public function execute($request) {
        $activeHolidayTypesList = $this->getHolidayTypeNames();
        $this->getResponse()->setContent(json_encode($activeHolidayTypesList));
        return sfView::NONE;
    }
    
    protected function getHolidayTypeNames() {
        return $this->getHolidayTypeService()->getActiveHolidayTypeNamesArray();
    }

}
