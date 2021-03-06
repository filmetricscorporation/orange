<?php

/**
 * BaseHolidayType
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property integer $deleted
 * 
 * @method integer             getId()                                   Returns the current record's "id" value
 * @method string              getName()                                 Returns the current record's "name" value
 * @method integer             getDeleted()                              Returns the current record's "deleted" value
 * @method HolidayType         setId()                                   Sets the current record's "id" value
 * @method HolidayType         setName()                                 Sets the current record's "name" value
 * @method HolidayType         setDeleted()                              Sets the current record's "deleted" value
 * 
 * @package    orangehrm
 * @subpackage model\holiday\base
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseHolidayType extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ohrm_holiday_type');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('deleted', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
    }
}