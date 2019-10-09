<?php use_javascripts_for_form($form); ?>
<?php use_stylesheets_for_form($form); ?>

<?php if($holidayTypePermissions->canRead()){ ?>
<?php if ($form->hasErrors()): ?>
    <div class="messagebar">
        <?php include_partial('global/form_errors', array('form' => $form)); ?>
    </div>
<?php endif; ?>

<div class="box" id="add-holiday-type">
    <div class="head">
        <h1><?php echo $title; ?></h1>
    </div>
    <div class="inner">
        <?php include_partial('global/flash_messages'); ?>
        <form id="frmHolidayType" name="frmHolidayType" method="post" action="<?php echo url_for('leave/defineHolidayType'); ?>">

            <fieldset>                
                    <ol>
                        <?php echo $form;?>                                              
                        <li class="required">
                            <em>*</em> <?php echo __(CommonMessages::REQUIRED_FIELD); ?>
                        </li> 
                    </ol>
            </fieldset>



            <?php include_component('core', 'ohrmPluginPannel', array('location' => 'define-holiday-type-extra-fields')); ?>

            <p>
                <?php
                $actionButtons = $form->getActionButtons($holidayTypeId);

                foreach ($actionButtons as $button) {
                    echo $button->render(null), "\n";
                }
                ?>                    
            </p>                

        </form>

    </div> <!-- inner -->

</div> <!-- add-holiday-type -->


<!-- Undelete Dialog: Begins -->
<div class="modal hide" id="undeleteDialog">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3><?php echo __('OrangeHRM - Confirmation Required'); ?></h3>
    </div>
    <div class="modal-body">
        <p><?php echo __('This is a deleted holiday type. Reactivate it?'); ?><br /><br />
            <strong><?php echo __('Yes'); ?></strong> - <?php echo __('Holiday type will be undeleted'); ?><br />
            <strong><?php echo __('No'); ?></strong> - 
            <?php
            echo $form->isUpdateMode() ? __('This holiday type will be renamed to the same name as the deleted holiday type') :
                    __('A new holiday type will be created with same name');
            ?>
            <br />
            <strong><?php echo __('Cancel'); ?></strong> - <?php echo __('Will take no action'); ?><br /><br />    
        </p>
    </div>
    <div class="modal-footer">
        <input type="button" class="btn" data-dismiss="modal" id="undeleteYes" value="<?php echo __('Yes'); ?>" />
        <input type="button" class="btn" data-dismiss="modal" id="undeleteNo" value="<?php echo __('No'); ?>" />
        <input type="button" class="btn reset" data-dismiss="modal" value="<?php echo __('Cancel'); ?>" />
    </div>
</div>
<!-- Undelete Dialog: Ends -->
<!-- Exclude Info Dialog: Begins -->
<div class="modal hide" id="excludeInfoDialog">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3><?php echo __('OrangeHRM'); ?></h3>
    </div>
    <div class="modal-body">
        <p><strong><?php echo __('Is entitlement situational'); ?>:</strong><br/><br/>
            <?php echo __('These holiday will be excluded from reports unless there\'s some activity. E.g. maternity holiday, jury duty holiday.'); ?>
        </p>
    </div>
    <div class="modal-footer">
        <input type="button" class="btn" data-dismiss="modal" value="<?php echo __('OK'); ?>" />
    </div>
</div>
<!-- Undelete Dialog: Ends -->

<form name="frmUndeleteHolidayType" id="frmUndeleteHolidayType" 
      action="<?php echo url_for('holiday/undeleteHolidayType'); ?>" method="post">
          <?php echo $undeleteForm; ?>
</form>
<?php }?>
<script type="text/javascript">
    //<![CDATA[

    var activeHolidayTypes = [];
    var deletedHolidayTypes = [];

    var lang_HolidayTypeNameRequired = '<?php echo __(ValidationMessages::REQUIRED); ?>';
    var lang_HolidayTypeExists = '<?php echo __(ValidationMessages::ALREADY_EXISTS); ?>';
    var lang_HolidayTypeNameTooLong = '<?php echo __(ValidationMessages::TEXT_LENGTH_EXCEEDS, array('%amount%' => 50)); ?>'; 
    
    var backButtonUrl = '<?php echo url_for('leave/holidayTypeList'); ?>';

    //]]>
</script>
