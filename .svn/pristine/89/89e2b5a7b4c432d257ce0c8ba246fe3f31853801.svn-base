<?php

class JobTitleHeaderFactory extends ohrmListConfigurationFactory {
//    protected $allowEdit;

    protected function init() {

        $header1 = new ListHeader();
        $header2 = new ListHeader();
        // 20160318 - add new header list
        $header3 = new ListHeader();

        $header1->populateFromArray(array(
            'name' => 'Job Title',
            'width' => '45%',
            'isSortable' => true,
            'sortField' => 'jobTitleName',
            'elementType' => 'link',
            'elementProperty' => array(
                //'linkable' => $this->allowEdit,
                'labelGetter' => 'getJobTitleName',
                'placeholderGetters' => array('id' => 'getId'),
                'urlPattern' => 'index.php/admin/saveJobTitle?jobTitleId={id}'),
        ));

        $header2->populateFromArray(array(
            'name' => 'Job Description',
            'width' => '45%',
            'elementType' => 'label',
            'elementProperty' => array('getter' => 'getJobDescription'),
        ));

        // 20160318 - add approval_signatory field
         $header3->populateFromArray(array(
            'name' => 'No. of Signatories',
            'width' => '10%',
            'elementType' => 'label',
            'elementProperty' => array('getter' => 'getApprovalSignatory'),
        ));

        // 20160318 - add $header3 
        //$this->headers = array($header1, $header2);
        $this->headers = array($header1, $header2, $header3);
    }

    public function getClassName() {
        return 'JobTitle';
    }

//    public function getAllowEdit() {
//        return $this->allowEdit;
//    }
//
//    public function setAllowEdit($allowEdit) {
//        $this->allowEdit = $allowEdit;
//    }

}

