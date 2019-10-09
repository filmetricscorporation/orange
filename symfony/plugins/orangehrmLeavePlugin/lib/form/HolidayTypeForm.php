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
class HolidayTypeForm extends orangehrmForm {

    protected $holidayTypePermissions;
    private $updateMode = false;
    private $holidayTypeService;

    public function configure() {
        $this->holidayTypePermissions = $this->getOption('holidayTypePermissions');
        $id = $this->getOption('holidayTypeId');

        sfContext::getInstance()->getConfiguration()->loadHelpers('I18N');

        $widgets = array(
            'txtHolidayTypeName' => new sfWidgetFormInput(array(), array('size' => 30)),
            //'excludeIfNoEntitlement' => new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1)),
            'hdnOriginalHolidayTypeName' => new sfWidgetFormInputHidden(),
            'hdnHolidayTypeId' => new sfWidgetFormInputHidden()
        );

        $validators = array(
            'txtHolidayTypeName' =>
            new sfValidatorString(array(
                'required' => true,
                'max_length' => 50
                    ),
                    array(
                        'required' => __('Required'),
                        'max_length' => __('Leave type name should be 50 characters or less in length')
            )),
            //'excludeIfNoEntitlement' => new sfValidatorBoolean(),
            'hdnOriginalHolidayTypeName' => new sfValidatorString(array('required' => false)),
            'hdnHolidayTypeId' => new sfValidatorString(array('required' => false))
        );

        if (!(($this->holidayTypePermissions->canCreate() && empty($id)) || ($this->holidayTypePermissions->canUpdate() && $id > 0))) {
            foreach ($widgets as $widgetName => $widget) {
                $widget->setAttribute('disabled', 'disabled');
            }
        }

        $this->setWidgets($widgets);

        $this->getWidgetSchema()->setLabel('txtHolidayTypeName', __('Name') . ' <em>*</em>');
        //$this->getWidgetSchema()->setLabel('excludeIfNoEntitlement', '<a id="exclude_link" href="#">' . __('Is entitlement situational') . '</a>');

        $this->setValidators($validators);
        $this->widgetSchema->setNameFormat('holidayType[%s]');
    }

    public function setDefaultValues($holidayTypeId) {

        $holidayTypeService = $this->getHolidayTypeService();
        $holidayTypeObject = $holidayTypeService->readHolidayType($holidayTypeId);

        if ($holidayTypeObject instanceof HolidayType) {

            $this->setDefault('hdnHolidayTypeId', $holidayTypeObject->getId());
            $this->setDefault('txtHolidayTypeName', $holidayTypeObject->getName());
            //$this->setDefault('excludeIfNoEntitlement', $holidayTypeObject->getExcludeInReportsIfNoEntitlement());
            $this->setDefault('hdnOriginalHolidayTypeName', $holidayTypeObject->getName());
        }
    }

    public function setUpdateMode() {
        $this->updateMode = true;
    }

    public function isUpdateMode() {
        return $this->updateMode;
    }

    public function getHolidayTypeObject() {

        $holidayTypeId = $this->getValue('hdnHolidayTypeId');

        if (!empty($holidayTypeId)) {
            $holidayType = $this->getHolidayTypeService()->readHolidayType($holidayTypeId);
        } else {
            $holidayType = new HolidayType();
            $holidayType->setDeleted(0);
        }

        $holidayType->setName($this->getValue('txtHolidayTypeName'));
        //$holidayType->setExcludeInReportsIfNoEntitlement($this->getValue('excludeIfNoEntitlement'));

        return $holidayType;
    }

    public function getDeletedHolidayTypesJsonArray() {

        $holidayTypeService = $this->getHolidayTypeService();
        $deletedHolidayTypes = $holidayTypeService->getDeletedHolidayTypeList();

        $deletedTypesArray = array();

        foreach ($deletedHolidayTypes as $deletedHolidayType) {
            $deletedTypesArray[] = array('id' => $deletedHolidayType->getId(),
                'name' => $deletedHolidayType->getName());
        }

        return json_encode($deletedTypesArray);
    }

    public function getHolidayTypeService() {

        if (is_null($this->holidayTypeService)) {
            $this->holidayTypeService = new HolidayTypeService();
        }

        return $this->holidayTypeService;
    }

    public function setHolidayTypeService($holidayTypeService) {
        $this->holidayTypeService = $holidayTypeService;
    }

    public function getJavaScripts() {
        $javaScripts = parent::getJavaScripts();
        $javaScripts[] = plugin_web_path('orangehrmLeavePlugin', 'js/defineHolidayTypeSuccess.js');

        return $javaScripts;
    }

    public function getStylesheets() {
        $styleSheets = parent::getStylesheets();
        return $styleSheets;
    }

    public function getActionButtons($holidayTypeId) {

        $actionButtons = array();
        if (($this->holidayTypePermissions->canCreate() && empty($holidayTypeId)) || ($this->holidayTypePermissions->canUpdate() && $holidayTypeId > 0 )) {
            $actionButtons['saveButton'] = new ohrmWidgetButton('saveButton', "Save", array());
        }
        $actionButtons['backButton'] = new ohrmWidgetButton('backButton', "Cancel", array('class' => 'cancel'));

        return $actionButtons;
    }

}

