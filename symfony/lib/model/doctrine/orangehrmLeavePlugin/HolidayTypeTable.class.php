<?php

/**
 * HolidayTypeTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class HolidayTypeTable extends PluginHolidayTypeTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object HolidayTypeTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('HolidayType');
    }
}