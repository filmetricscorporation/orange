<?php 
use_stylesheet(plugin_web_path('orangehrmPimPlugin', 'css/viewPersonalDetailsSuccess.css'));
?>

<div class="box pimPane" id="employee-details">
    
    <?php echo include_component('pim', 'pimLeftMenu', array('empNumber'=>$empNumber, 'form' => $form));?>
    
    <div class="personalDetails" id="pdMainContainer">
        
        <div class="head">
            <h1><?php echo __('Personal Details'); ?></h1>
        </div> <!-- head -->
    
        <div class="inner">

            <?php if ($personalInformationPermission->canRead()) : ?>

            <?php include_partial('global/flash_messages', array('prefix' => 'personaldetails')); ?>

            <form id="frmEmpPersonalDetails" method="post" action="<?php echo url_for('pim/viewPersonalDetails'); ?>">

                <?php echo $form['_csrf_token']; ?>
                <?php echo $form['txtEmpID']->render(); ?>

                <fieldset>
                    <!--
                    <div class="helpLabelContainer">
                        <div><label>First Name</label></div>
                        <div><label>Middle Name</label></div>
                        <div><label>Last Name</label></div>
                    </div>
                    -->
                    <?php
                    // 20160427 START
                    //var_dump(sfContext::getInstance()->getUser()->getAttribute('user')->getUserId() . "|" . sfContext::getInstance()->getUser()->getAttribute('user')->getAllowAccessConfidential());
                    $userAAC = sfContext::getInstance()->getUser()->getAttribute('auth.allowAccessConfidential');

                    if ($userAAC == 1) {
                    ?>
                    <ol>
                        <li>
                           <label for="personal_chkIsConfidential"><?php echo __('Is Confidential?'); ?></label>
                            <?php echo $form['chkIsConfidential']->render(array("class" => "editable")); ?>
                        </li>  
                    </ol>
                    <?php
                    }
                    // END
                    ?>
                    
                    <ol>
                        <li class="line nameContainer">                             
                            <label for="Full_Name" class="hasTopFieldHelp"><?php echo __('Full Name'); ?></label>
                            <ol class="fieldsInLine">                                
                                <li>
                                    <div class="fieldDescription"><em>*</em> <?php echo __('First Name'); ?></div>
                                    <?php echo $form['txtEmpFirstName']->render(array("class" => "block default editable", "maxlength" => 30, "title" => __('First Name'))); ?>
                                </li>
                                <li>
                                    <div class="fieldDescription"><?php echo __('Middle Name'); ?></div>
                                    <?php echo $form['txtEmpMiddleName']->render(array("class" => "block default editable", "maxlength" => 30, "title" => __('Middle Name'))); ?>
                                </li>
                                <li>
                                    <div class="fieldDescription"><em>*</em> <?php echo __('Last Name'); ?></div>
                                    <?php echo $form['txtEmpLastName']->render(array("class" => "block default editable", "maxlength" => 30, "title" => __('Last Name'))); ?>
                                </li>
                            </ol>                            
                        </li>
                    </ol>
                    <ol>
                        <li>
                            <label for="personal_txtEmployeeId"><?php echo __('Employee Id'); ?></label>
                            <?php  
                                // 20160314 changed maxlength from 10 to 20
                                echo $form['txtEmployeeId']->render(array("maxlength" => 20, "class" => "editable", "trim" => true)); ?>
                        </li>
                        <li>
                            <label for="personal_txtOtherID"><?php echo __('Other Id'); ?></label>
                            <?php echo $form['txtOtherID']->render(array("maxlength" => 30, "class" => "editable")); ?>
                        </li>
                        <li class="long">
                            <label for="personal_txtLicenNo"><?php echo __("Driver's License Number"); ?></label>
                            <?php echo $form['txtLicenNo']->render(array("maxlength" => 30, "class" => "editable")); ?>
                        </li>
                        <li>
                            <label for="personal_txtLicExpDate"><?php echo __('License Expiry Date'); ?></label>
                            <?php echo $form['txtLicExpDate']->render(array("class"=>"calendar editable")); ?>
                        </li>
                        <?php if ($showSSN) : ?>
                        <li class="new">
                            <label for="personal_txtNICNo"><?php echo __('SSN Number'); ?></label>
                            <?php echo $form['txtNICNo']->render(array("class" => "editable", "maxlength" => 30)); ?>
                        </li>                    
                        <?php endif; ?>
                        <?php if ($showSIN) : ?>
                        <li class="<?php echo !($showSSN)?'new':''; ?>">
                            <label for="personal_txtSINNo"><?php echo __('SIN Number'); ?></label>
                            <?php echo $form['txtSINNo']->render(array("class" => "editable", "maxlength" => 30)); ?>
                        </li>                    
                        <?php endif; ?>                    
                    </ol>                    
                    <ol>
                        <li class="radio">
                            <label for="personal_optGender"><?php echo __("Gender"); ?></label>
                            <?php echo $form['optGender']->render(array("class"=>"editable")); ?>
                        </li>
                        <li>
                            <label for="personal_cmbMarital"><?php echo __('Marital Status'); ?></label>
                            <?php echo $form['cmbMarital']->render(array("class"=>"editable")); ?>
                        </li>
                        <li class="new">
                            <label for="personal_cmbNation"><?php echo __("Nationality"); ?></label>
                            <?php echo $form['cmbNation']->render(array("class"=>"editable")); ?>
                        </li>
                        <li>
                            <label for="personal_DOB"><?php echo __("Date of Birth"); ?></label>
                            <?php echo $form['DOB']->render(array("class"=>"editable")); ?>
                        </li>
                        <li>
                            <label for="personal_txtHeight"><?php echo __("Height"); ?></label>

                            <ol style="border-bottom:0px;margin-bottom:-20px;">
                                <li>
                                    <?php echo $form['txtHeightFt']->render(array("id"=>"heightft", "class"=>"editable", "style"=>"width:15px;", "maxlength"=>"3")); ?>
                                     <?php echo $form['txtHeightInch']->render(array("id"=>"heightinch", "class"=>"editable", "style"=>"width:15px;margin-left:5px;", "maxlength"=>"3")); ?>
                                     <label style="margin-left:5px;">feet / inches</label>
                                </li>
                                <li>
                                    <?php echo $form['txtHeight']->render(array("class"=>"editable", "style"=>"width:40px;", "maxlength"=>"6")); ?>
                            <label style="margin-left:5px;">inches</label>
                                </li>
                            </ol>
                        </li>
                        <li>                            
                            <label for="personal_txtWeight"><?php echo __("Weight"); ?></label>
                            
                            <ol style="border-bottom:0px;margin-bottom:-20px;">
                                <li>
                                    <?php echo $form['txtWeightLbs']->render(array("id"=>"weightlbs", "class"=>"editable", "style"=>"width:40px;", "maxlength"=>"6")); ?>
                                     <label style="margin-left:5px;">pounds</label>
                                </li>
                                <li>
                                    <?php echo $form['txtWeight']->render(array("class"=>"editable", "style"=>"width:40px;", "maxlength"=>"6")); ?>
                                    <label style="margin-left:5px;">kilograms</label>
                                </li>
                            </ol>
                        </li>

                        <?php if(!$showDeprecatedFields) : ?>
                        <li class="required new">
                            <em>*</em> <?php echo __(CommonMessages::REQUIRED_FIELD); ?>
                        </li>
                        <?php endif; ?>
                    </ol>
                     <ol>
                        <li>
                            <label for="personal_txtSssNumber"><?php echo __('SSS Number'); ?></label>
                            <?php echo $form['txtSssNumber']->render(array("maxlength" => 50, "class" => "editable")); ?>
                        </li>
                        <li>
                            <label for="personal_txtPhilhealthNumber"><?php echo __('Philhealth Number'); ?></label>
                            <?php echo $form['txtPhilhealthNumber']->render(array("maxlength" => 50, "class" => "editable")); ?>
                        </li>
                        <li>
                            <label for="personal_txtPagibigNumber"><?php echo __('Pag-ibig Number'); ?></label>
                            <?php echo $form['txtPagibigNumber']->render(array("maxlength" => 50, "class" => "editable")); ?>
                        </li>
                        <li>
                            <label for="personal_txtTin"><?php echo __('T.I.N.'); ?></label>
                            <?php echo $form['txtTin']->render(array("maxlength" => 50, "class" => "editable")); ?>
                        </li>
                       
                    </ol>    
                    <?php if($showDeprecatedFields) : ?>    
                    <ol>
                        <li>
                            <label for="personal_txtEmpNickName"><?php echo __("Nick Name"); ?></label>
                            <?php echo $form['txtEmpNickName']->render(array("maxlength" => 30, "class" => "editable")); ?>
                        </li>
                        <li>
                            <label for="personal_chkSmokeFlag"><?php echo __('Smoker'); ?></label>
                            <?php echo $form['chkSmokeFlag']->render(array("class" => "editable")); ?>
                        </li>
                        <li class="new">
                            <label for="personal_txtMilitarySer"><?php echo __("Military Service"); ?></label>
                            <?php echo $form['txtMilitarySer']->render(array("maxlength" => 30, "class" => "editable")); ?>
                        </li>
                        <li class="required new">
                            <em>*</em> <?php echo __(CommonMessages::REQUIRED_FIELD); ?>
                        </li>                    
                    </ol>
                    <?php endif; ?>                        

                    <?php  if ($personalInformationPermission->canUpdate()) : ?>
                    <p><input type="button" id="btnSave" value="<?php echo __("Edit"); ?>" /></p>
                    <?php endif; ?>

                </fieldset>
            </form>

            <?php else : ?>
            <div><?php echo __(CommonMessages::RESTRICTED_SECTION); ?></div>
            <?php endif; ?>

        </div> <!-- inner -->
        
    </div> <!-- pdMainContainer -->

    
    <?php echo include_component('pim', 'customFields', array('empNumber'=>$empNumber, 'screen' => CustomField::SCREEN_PERSONAL_DETAILS));?>
    <?php echo include_component('pim', 'attachments', array('empNumber'=>$empNumber, 'screen' => EmployeeAttachment::SCREEN_PERSONAL_DETAILS));?>
    
</div> <!-- employee-details -->
 
<?php //echo stylesheet_tag('orangehrm.datepicker.css') ?>
<?php //echo javascript_include_tag('orangehrm.datepicker.js')?>

<script type="text/javascript">
    //<![CDATA[
    //we write javascript related stuff here, but if the logic gets lengthy should use a seperate js file
    var edit = "<?php echo __("Edit"); ?>";
    var save = "<?php echo __("Save"); ?>";
    var lang_firstNameRequired = "<?php echo __(ValidationMessages::REQUIRED); ?>";
    var lang_lastNameRequired = "<?php echo __(ValidationMessages::REQUIRED); ?>";
    var lang_selectGender = "<?php echo __(ValidationMessages::REQUIRED); ?>";
    var lang_processing = '<?php echo __(CommonMessages::LABEL_PROCESSING);?>';
    var lang_invalidDate = '<?php echo __(ValidationMessages::DATE_FORMAT_INVALID, array('%format%' => str_replace('yy', 'yyyy', get_datepicker_date_format($sf_user->getDateFormat())))) ?>';
    var datepickerDateFormat = '<?php echo get_datepicker_date_format($sf_user->getDateFormat()); ?>';

    var fileModified = 0;
    
    var readOnlyFields = <?php echo json_encode($form->getReadOnlyWidgetNames());?>
 

    $("#weightlbs").keyup(function(e){
        var kgsval = 0;

        kgsval = Math.round(lbsToKgs($("#weightlbs").val()) * 100) / 100;

        $("#personal_txtWeight").val(kgsval);
    })   

    $("#personal_txtWeight").keyup(function(e){
        var lbsval = 0;

        lbsval = Math.round(KgsToLbs($("#personal_txtWeight").val()) * 100) / 100;

        $("#weightlbs").val(lbsval);
    })   

    $("#heightinch").keyup(function(e){
        
        var ftinchval = 0;

        ftinchval = ftToInches($("#heightft").val(), $("#heightinch").val());

        $("#personal_txtHeight").val(ftinchval);
    })

    function lbsToKgs(lbsvar) {
        return lbsvar * 0.45359237;
    }

    function KgsToLbs(kgsvar) {
        return kgsvar / 0.45359237;
    }

    function ftToInches(ftvar, inchvar) {

        return ((ftvar * 12) + (inchvar * 1));
    }
 
    //]]>
</script>

<?php echo javascript_include_tag(plugin_web_path('orangehrmPimPlugin', 'js/viewPersonalDetailsSuccess')); ?>
