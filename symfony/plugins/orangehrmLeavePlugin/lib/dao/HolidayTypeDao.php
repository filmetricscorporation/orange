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

/**
 * Description of NewHolidayTypeDao
 */
class HolidayTypeDao {
    
    public function getHolidayTypeList($operationalCountryId = null) {
        try {
            $q = Doctrine_Query::create()
                            ->from('HolidayType lt')
                            ->where('lt.deleted = 0')
                            ->orderBy('lt.name');
            
            if (!is_null($operationalCountryId)) {
                if (is_array($operationalCountryId)) {
                    $q->andWhereIn('lt.operational_country_id', $operationalCountryId);
                } else {
                    $q->andWhere('lt.operational_country_id = ? ', $operationalCountryId);
                }
            }
            $holidayTypeList = $q->execute();

            return $holidayTypeList;
        } catch (Exception $e) {
            $this->getLogger()->error("Exception in getHolidayTypeList:" . $e);
            throw new DaoException($e->getMessage(), 0, $e);
        }        
    }    
    
    /**
     * Get Holiday Type by ID
     * @return HolidayType
     */
    public function readHolidayType($id) {
        try {
            return Doctrine::getTable('HolidayType')->find($id);
        } catch (Exception $e) {
            $this->getLogger()->error("Exception in readHolidayType:" . $e);
            throw new DaoException($e->getMessage(), 0, $e);
        }
    }    
    
    /**
     * Get Logger instance. Creates if not already created.
     *
     * @return Logger
     */
    protected function getLogger() {
        if (is_null($this->logger)) {
            $this->logger = Logger::getLogger('holiday.HolidayTypeDao');
        }

        return($this->logger);
    }    
    
    /**
     *
     * @param HolidayType $holidayType
     * @return boolean
     */
    public function saveHolidayType(HolidayType $holidayType) {
        try {
            $holidayType->save();

            return true;
        } catch (Exception $e) {
            $this->getLogger()->error("Exception in saveHolidayType:" . $e);
            throw new DaoException($e->getMessage());
        }
    }

    /**
     * Delete Holiday Type
     * @param array holidayTypeList
     * @returns boolean
     * @throws DaoException
     */
    public function deleteHolidayType($holidayTypeList) {

        try {

            $q = Doctrine_Query::create()
                            ->update('HolidayType lt')
                            ->set('lt.deleted', '?', 1)
                            ->whereIn('lt.id', $holidayTypeList);
            $numDeleted = $q->execute();
            if ($numDeleted > 0) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            $this->getLogger()->error("Exception in deleteHolidayType:" . $e);
            throw new DaoException($e->getMessage());
        }
    }



    public function getDeletedHolidayTypeList($operationalCountryId = null) {
        try {
            $q = Doctrine_Query::create()
                            ->from('HolidayType lt')
                            ->where('lt.deleted = 1')
                            ->orderBy('lt.id');

            if (!is_null($operationalCountryId)) {
                $q->andWhere('lt.operational_country_id = ? ', $operationalCountryId);
            }
            
            $holidayTypeList = $q->execute();

            return $holidayTypeList;
        } catch (Exception $e) {
            $this->getLogger()->error("Exception in getDeletedHolidayTypeList:" . $e);
            throw new DaoException($e->getMessage());
        }
    }

    public function readHolidayTypeByName($holidayTypeName) {
        try {
            $q = Doctrine_Query::create()
                            ->from('HolidayType lt')
                            ->where("lt.name = ?", $holidayTypeName)
                            ->andWhere('lt.deleted = 0');

            $holidayTypeCollection = $q->execute();

            return $holidayTypeCollection[0];
        } catch (Exception $e) {
            $this->getLogger()->error("Exception in readHolidayTypeByName:" . $e);
            throw new DaoException($e->getMessage());
        }
    }

    public function undeleteHolidayType($holidayTypeId) {

        try {

            $q = Doctrine_Query::create()
                            ->update('HolidayType lt')
                            ->set('lt.deleted', 0)
                            ->where("lt.id = ?", $holidayTypeId);

            $numUpdated = $q->execute();

            if ($numUpdated > 0) {
                return true;
            }

            return false;
        } catch (Exception $e) {
            $this->getLogger()->error("Exception in undeleteHolidayType:" . $e);
            throw new DaoException($e->getMessage());
        }
    }    
}
