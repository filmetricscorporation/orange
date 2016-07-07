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

class undeleteHolidayTypeAction extends orangehrmAction {

    protected $holidayTypeService;
    
    public function execute($request) {
        $this->form = $this->getForm();

        if ($request->isMethod('post')) {

            $this->form->bind($request->getParameter($this->form->getName()));

            if ($this->form->isValid()) {
                $undeleteId = $this->form->getValue('undeleteId');
                
                $this->undeleteHolidayType($undeleteId);
            } else {
                // Since this form does not have any user data entry fields,
                // this is a error.
                $this->getLoggerInstance()->error($this->form);
            }
        }
        $this->redirect("holiday/holidayTypeList");        
    }



    protected function undeleteHolidayType($holidayTypeId) {
        $holidayTypeService = $this->getHolidayTypeService();
        $holidayTypeService->undeleteHolidayType($holidayTypeId);

        $holidayType = $holidayTypeService->readHolidayType($holidayTypeId);
        $holidayTypeName = $holidayType->getName();
        
        $message = __('Successfully Undeleted');
        $this->getUser()->setFlash('success', $message);
    }


    protected function getForm() {
        $form = new UndeleteHolidayTypeForm(array(), array(), true);
        return $form;
    }

    protected function getHolidayTypeService() {

        if (is_null($this->holidayTypeService)) {
            $this->holidayTypeService = new HolidayTypeService();
        }

        return $this->holidayTypeService;
    }
    
    /**
     * Get Logger instance. Creates if not already created.
     *
     * @return Logger
     */
    protected function getLoggerInstance() {
        if (is_null($this->logger)) {
            $this->logger = Logger::getLogger('holiday.undeleteHolidayTypeAction');
        }

        return($this->logger);
    }    

}
