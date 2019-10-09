<?php

/**
 * BaseHoliday
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $recurring
 * @property string $description
 * @property date $date
 * @property integer $length
 * @property integer $operational_country_id
 * @property OperationalCountry $OperationalCountry
 * 
 * @method integer            getId()                     Returns the current record's "id" value
 * @method integer            getRecurring()              Returns the current record's "recurring" value
 * @method integer            getHolidayTypeId()                   Returns the current record's "holiday type" value
 * @method string             getDescription()            Returns the current record's "description" value
 * @method date               getDate()                   Returns the current record's "date" value
 * @method integer            getLength()                 Returns the current record's "length" value
 * @method integer            getOperationalCountryId()   Returns the current record's "operational_country_id" value
 * @method integer            getHolidayTypeId()          
 * @method OperationalCountry getOperationalCountry()     Returns the current record's "OperationalCountry" value
 * @method Holiday            setId()                     Sets the current record's "id" value
 * @method Holiday            setRecurring()              Sets the current record's "recurring" value
 * @method Holiday            setHolidayTypeId()          Sets the current record's "holiday type" value
 * @method Holiday            setDescription()            Sets the current record's "description" value
 * @method Holiday            setDate()                   Sets the current record's "date" value
 * @method Holiday            setLength()                 Sets the current record's "length" value
 * @method Holiday            setOperationalCountryId()   Sets the current record's "operational_country_id" value
 * @method Holiday            setOperationalCountry()     Sets the current record's "OperationalCountry" value
 * @method Holiday            setHolidayTypeId()
 * 
 * @package    orangehrm
 * @subpackage model\leave\base
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseHoliday extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ohrm_holiday');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('recurring', 'integer', 1, array(
             'type' => 'integer',
             'default' => '0',
             'length' => 1,
             ));
        $this->hasColumn('description', 'string', 2147483647, array(
             'type' => 'string',
             'length' => 2147483647,
             ));
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'length' => 25,
             ));
        $this->hasColumn('length', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('operational_country_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('holiday_type_id', 'integer', 2, array(
             'type' => 'integer',
             'length' => 2,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('OperationalCountry', array(
             'local' => 'operational_country_id',
             'foreign' => 'id'));
    }
}