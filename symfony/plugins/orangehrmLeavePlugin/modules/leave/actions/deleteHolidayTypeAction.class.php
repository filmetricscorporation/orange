<?php

class deleteHolidayTypeAction extends baseHolidayAction {

    protected $holidayTypeService;

    /**
     * Executes deleteHolidayType action
     *
     * @param sfRequest $request A request object
     */
    public function execute($request) {
        $this->holidayTypePermissions = $this->getDataGroupPermissions('holiday_types');

        if ($request->isMethod('post')) {

                if (count($request->getParameter('chkSelectRow')) == 0) {
                    $this->getUser()->setFlash('notice', __(TopLevelMessages::SELECT_RECORDS));
                } else {
                    if ($this->holidayTypePermissions->canDelete()) {
                        $form = new DefaultListForm();
                        $form->bind($request->getParameter($form->getName()));
                        if ($form->isValid()) {
                            $holidayTypeService = $this->getHolidayTypeService();

                            $holidayTypeIds = $request->getParameter('chkSelectRow');
                            $holidayTypeService->deleteHolidayType($holidayTypeIds);
                            $this->getUser()->setFlash('success', __(TopLevelMessages::DELETE_SUCCESS));
                        }
                    }
                }

                $this->redirect('holiday/holidayTypeList');
            }
        }

    protected function getHolidayTypeService() {

        if (is_null($this->holidayTypeService)) {
            $this->holidayTypeService = new HolidayTypeService();
        }

        return $this->holidayTypeService;
    }

}
