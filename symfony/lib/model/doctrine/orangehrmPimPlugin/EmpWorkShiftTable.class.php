<?php

/**
 * EmpWorkShiftTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class EmpWorkShiftTable extends PluginEmpWorkShiftTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object EmpWorkShiftTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('EmpWorkShift');
    }
}