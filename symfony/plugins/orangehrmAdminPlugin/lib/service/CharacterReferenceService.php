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
class CharacterReferenceService extends BaseService {
    
    private $characterReferenceDao;
    
    /**
     * @ignore
     */
    public function getCharacterReferenceDao() {
        
        if (!($this->characterReferenceDao instanceof CharacterReferenceDao)) {
            $this->characterReferenceDao = new CharacterReferenceDao();
        }
        
        return $this->characterReferenceDao;
    }

    /**
     * @ignore
     */
    public function setCharacterReferenceDao($characterReferenceDao) {
        $this->characterReferenceDao = $characterReferenceDao;
    }
    
    /**
     * Saves a characterReference
     * 
     * Can be used for a new record or updating.
     * 
     * @version 2.6.12 
     * @param CharacterReference $characterReference 
     * @return NULL Doesn't return a value
     */
    public function saveCharacterReference(CharacterReference $characterReference) {        
        $this->getCharacterReferenceDao()->saveCharacterReference($characterReference);        
    }
    
    /**
     * Retrieves a characterReference by ID
     * 
     * @version 2.6.12 
     * @param int $id 
     * @return CharacterReference An instance of CharacterReference or NULL
     */    
    public function getCharacterReferenceById($id) {
        return $this->getCharacterReferenceDao()->getCharacterReferenceById($id);
    }
    
    /**
     * Retrieves a characterReference by name
     * 
     * Case insensitive
     * 
     * @version 2.6.12 
     * @param string $name 
     * @return CharacterReference An instance of CharacterReference or false
     */    
    public function getCharacterReferenceByName($name) {
        return $this->getCharacterReferenceDao()->getCharacterReferenceByName($name);
    }    
  
    /**
     * Retrieves all characterReferences ordered by name
     * 
     * @version 2.6.12 
     * @return Doctrine_Collection A doctrine collection of CharacterReference objects 
     */        
    public function getCharacterReferenceList() {
        return $this->getCharacterReferenceDao()->getCharacterReferenceList();
    }
    
    /**
     * Deletes characterReferences
     * 
     * @version 2.6.12 
     * @param array $toDeleteIds An array of IDs to be deleted
     * @return int Number of records deleted
     */    
    public function deleteCharacterReferences($toDeleteIds) {
        return $this->getCharacterReferenceDao()->deleteCharacterReferences($toDeleteIds);
    }

    /**
     * Checks whether the given characterReference name exists
     * 
     * Case insensitive
     * 
     * @version 2.6.12 
     * @param string $characterReferenceName CharacterReference name that needs to be checked
     * @return boolean
     */    
    public function isExistingCharacterReferenceName($characterReferenceName) {
        return $this->getCharacterReferenceDao()->isExistingCharacterReferenceName($characterReferenceName);
    }
    

}