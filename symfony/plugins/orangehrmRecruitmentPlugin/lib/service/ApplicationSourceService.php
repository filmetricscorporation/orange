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
class ApplicationSourceService extends BaseService {
    
    private $applicationSourceDao;
    
    /**
     * @ignore
     */
    public function getApplicationSourceDao() {
        
        if (!($this->applicationSourceDao instanceof ApplicationSourceDao)) {
            $this->applicationSourceDao = new ApplicationSourceDao();
        }
        
        return $this->applicationSourceDao;
    }

    /**
     * @ignore
     */
    public function setApplicationSourceDao($applicationSourceDao) {
        $this->applicationSourceDao = $applicationSourceDao;
    }
    
    /**
     * Saves an applicationSource object
     * 
     * Can be used for a new record or updating.
     * 
     * @version 2.6.12 
     * @param ApplicationSource $applicationSource 
     * @return NULL Doesn't return a value
     */
    public function saveApplicationSource(ApplicationSource $applicationSource) {        
        $this->getApplicationSourceDao()->saveApplicationSource($applicationSource);        
    }
    
    /**
     * Retrieves an applicationSource object by ID
     * 
     * @version 2.6.12 
     * @param int $id 
     * @return ApplicationSource An instance of ApplicationSource or NULL
     */    
    public function getApplicationSourceById($id) {
        return $this->getApplicationSourceDao()->getApplicationSourceById($id);
    }
    
    /**
     * Retrieves an applicationSource object by name
     * 
     * Case insensitive
     * 
     * @version 2.6.12 
     * @param string $name 
     * @return ApplicationSource An instance of ApplicationSource or false
     */    
    public function getApplicationSourceByName($name) {
        return $this->getApplicationSourceDao()->getApplicationSourceByName($name);
    }    
  
    /**
     * Retrieves all applicationSource records ordered by name
     * 
     * @version 2.6.12 
     * @return Doctrine_Collection A doctrine collection of ApplicationSource objects 
     */        
    public function getApplicationSourceList() {
        return $this->getApplicationSourceDao()->getApplicationSourceList();
    }
    
    /**
     * Deletes applicationSource records
     * 
     * @version 2.6.12 
     * @param array $toDeleteIds An array of IDs to be deleted
     * @return int Number of records deleted
     */    
    public function deleteApplicationSources($toDeleteIds) {
        return $this->getApplicationSourceDao()->deleteApplicationSources($toDeleteIds);
    }

    /**
     * Checks whether the given applicationSource name exists
     *
     * Case insensitive
     *
     * @version 2.6.12
     * @param string $applicationSourceName ApplicationSource name that needs to be checked
     * @return boolean
     */
    public function isExistingApplicationSourceName($applicationSourceName) {
        return $this->getApplicationSourceDao()->isExistingApplicationSourceName($applicationSourceName);
    }
    
}       