<?php

/*
 *
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

class HolidayTypeService extends BaseService {

    private $holidayTypeDao;

    public function getHolidayTypeDao() {
        if (!($this->holidayTypeDao instanceof HolidayTypeDao)) {
            $this->holidayTypeDao = new HolidayTypeDao();
        }
        return $this->holidayTypeDao;
    }

    public function setHolidayTypeDao(HolidayTypeDao $holidayTypeDao) {
        $this->holidayTypeDao = $holidayTypeDao;
    }

    /**
     *
     * @param HolidayType $holidayType
     * @return boolean
     */
    public function saveHolidayType(HolidayType $holidayType) {

        $this->getHolidayTypeDao()->saveHolidayType($holidayType);

        return true;
    }

    /**
     * Delete Holiday Type
     * @param array $holidayTypeList
     * @returns boolean
     * @throws HolidayServiceException
     */
    public function deleteHolidayType($holidayTypeList) {

        return $this->getHolidayTypeDao()->deleteHolidayType($holidayTypeList);
    }

    /**
     *
     * @return HolidayType Collection
     */
    public function getHolidayTypeList($operationalCountryId = null) {

        return $this->getHolidayTypeDao()->getHolidayTypeList($operationalCountryId);
    }

    /**
     *
     * @return HolidayType
     */
    public function readHolidayType($holidayTypeId) {

        return $this->getHolidayTypeDao()->readHolidayType($holidayTypeId);
    }

    public function readHolidayTypeByName($holidayTypeName) {

        return $this->getHolidayTypeDao()->readHolidayTypeByName($holidayTypeName);
    }

    public function undeleteHolidayType($holidayTypeId) {

        return $this->getHolidayTypeDao()->undeleteHolidayType($holidayTypeId);
    }

    public function getDeletedHolidayTypeList($operationalCountryId = null) {

        return $this->getHolidayTypeDao()->getDeletedHolidayTypeList($operationalCountryId);
    }
    
    /**
     *
     * @return array
     */
    public function getActiveHolidayTypeNamesArray($operationalCountryId = null) {

        $activeHolidayTypes = $this->getHolidayTypeList($operationalCountryId);

        $activeTypeNamesArray = array();

        foreach ($activeHolidayTypes as $activeHolidayType) {
            $activeTypeNamesArray[] = $activeHolidayType->getName();
        }

        return $activeTypeNamesArray;
    }
    
    public function getDeletedHolidayTypeNamesArray($operationalCountryId = null) {

        $deletedHolidayTypes = $this->getDeletedHolidayTypeList($operationalCountryId);

        $deletedTypeNamesArray = array();

        foreach ($deletedHolidayTypes as $deletedHolidayType) {

            $deletedHolidayTypeObject = new stdClass();
            $deletedHolidayTypeObject->id = $deletedHolidayType->getId();
            $deletedHolidayTypeObject->name = $deletedHolidayType->getName();
            $deletedTypeNamesArray[] = $deletedHolidayTypeObject;
        }

        return $deletedTypeNamesArray;
    }

}