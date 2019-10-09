<?php

class defineHolidayTypeAction extends baseHolidayAction {

    protected $holidayTypeService;

    public function execute($request) {

        $this->holidayTypePermissions = $this->getDataGroupPermissions('holiday_types');
        
        $holidayTypeId = $request->getParameter('id'); // This comes as a GET request from Holiday Type List page
        
        $valuesForForm = array('holidayTypePermissions' => $this->holidayTypePermissions, 'holidayTypeId' => $holidayTypeId);

        /* For highlighting corresponding menu item */
        $request->setParameter('initialActionName', 'holidayTypeList');

        $this->form = $this->getForm($valuesForForm);

        if ($request->isMethod('post')) {
            if ($this->holidayTypePermissions->canCreate() || $this->holidayTypePermissions->canUpdate()) {
                $this->form->bind($request->getParameter($this->form->getName()));

                if ($this->form->isValid()) {
                    $holidayType = $this->form->getHolidayTypeObject();
                    $this->saveHolidayType($holidayType);


                    //$eventType = ( $this->form->getValue('hdnHolidayTypeId') > 0) ? HolidayEvents::LEAVE_TYPE_UPDATE : HolidayEvents::LEAVE_TYPE_ADD;
                    //$this->dispatcher->notify(new sfEvent($this, $eventType,
                    //                array('holidayType' => $holidayType)));

                    $this->redirect("leave/holidayTypeList");
                }
            }
        } else {            
                    
            if (!$this->holidayTypePermissions->canRead() || 
                    (empty($holidayTypeId) && !$this->holidayTypePermissions->canCreate())) {
               $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));   
            }
            
            if ($this->holidayTypePermissions->canCreate()) {
                $this->undeleteForm = $this->getUndeleteForm();
            }

            $this->holidayTypeId = $holidayTypeId;

            if (!empty($holidayTypeId)) {
                $this->form->setDefaultValues($holidayTypeId);
                $this->form->setUpdateMode();
            }
        }
        
        $title = __('View Holiday Type');
        if ($this->form->isUpdateMode()) {
            if ($this->holidayTypePermissions->canUpdate()) {
                $title = __('Edit Holiday Type');
            }
        } else {
            $title = __('Add Holiday Type');
        }
        
        $this->title = $title;
    }

    protected function saveHolidayType(HolidayType $holidayType) {
        $this->getHolidayTypeService()->saveHolidayType($holidayType);
        $message = __(TopLevelMessages::SAVE_SUCCESS);
        $this->getUser()->setFlash('success', $message);
    }

    protected function getForm($valuesForForm) {
        $form = new HolidayTypeForm(array(), $valuesForForm, true);
        $form->setHolidayTypeService($this->getHolidayTypeService());
        return $form;
    }

    protected function getUndeleteForm() {
        return new UndeleteHolidayTypeForm(array(), array(), true);
    }

    protected function getHolidayTypeService() {

        if (is_null($this->holidayTypeService)) {
            $this->holidayTypeService = new HolidayTypeService();
        }

        return $this->holidayTypeService;
    }

}
