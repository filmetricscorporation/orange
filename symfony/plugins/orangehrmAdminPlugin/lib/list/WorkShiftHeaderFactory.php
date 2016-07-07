<?php

class WorkShiftHeaderFactory extends ohrmListConfigurationFactory {
	
	protected function init() {

		$header1 = new ListHeader();
		$header2 = new ListHeader();
		$header3 = new ListHeader();
		$header4 = new ListHeader();
		$header5 = new ListHeader();
		$header6 = new ListHeader();
                
		$header1->populateFromArray(array(
		    'name' => 'Shift Name',
		    'elementType' => 'link',
		    'elementProperty' => array(
			'labelGetter' => 'getName',
			'urlPattern' => 'javascript:'),
		));
		
		$header2->populateFromArray(array(
		    'name' => 'From',
		    'elementType' => 'label',
                    'filters' => array('TimeFormatCellFilter' => array()
                              ),                    
		    'elementProperty' => array('getter' => 'getStartTime'),
		));
                
		$header3->populateFromArray(array(
		    'name' => 'To',
		    'elementType' => 'label',
                    'filters' => array('TimeFormatCellFilter' => array()
                              ),                    
		    'elementProperty' => array('getter' => 'getEndTime'),
		));
                
		$header4->populateFromArray(array(
		    'name' => 'Hours Per Day',
		    'elementType' => 'label',
		    'elementProperty' => array('getter' => 'getHoursPerDay'),
		));

		$header5->populateFromArray(array(
		    'name' => 'First Half End Time',
		    'elementType' => 'label',
		    'elementProperty' => array('getter' => 'getFirstHalfEndTime'),
		));

		$header6->populateFromArray(array(
		    'name' => 'Second Half Start Time',
		    'elementType' => 'label',
		    'elementProperty' => array('getter' => 'getSecondHalfStartTime'),
		));

		
		$this->headers = array($header1, $header2, $header3, $header4, $header5, $header6);
	}

	public function getClassName() {
		return 'WorkShift';
	}
}

?>
