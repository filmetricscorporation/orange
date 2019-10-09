<?php  
$haveCharacterReferences = count($form->empCharacterReferenceList)>0;
?>
       
<a name="characterReference"></a>
<?php if ($characterReferencePermissions->canCreate() || ($haveCharacterReferences && $characterReferencePermissions->canUpdate())) { ?>
<div id="changeCharacterReference">
    <div class="head">
        <h1 id="headChangeCharacterReference"><?php echo __('Add Character Reference'); ?></h1>
    </div>
                
    <div class="inner">
        <form id="frmCharacterReference" action="<?php echo url_for('pim/saveDeleteCharacterReference?empNumber=' . 
                $empNumber . "&option=save"); ?>" method="post">
            <?php echo $form['_csrf_token']; ?>
            <?php echo $form['emp_number']->render(); ?>
            <fieldset>
                <ol>
                    <li>
                        <?php echo $form['name']->renderLabel(__('Name') . ' <em>*</em>'); ?>
                        <?php echo $form['name']->render(array("class" => "formInputText", "maxlength" => 150)); ?>
                    </li>
                    <li>
                        <?php echo $form['relation']->renderLabel(__('Relation')); ?>
                        <?php echo $form['relation']->render(array("class" => "formInputText", "maxlength" => 50)); ?>
                    </li>
                   <li>
                        <?php echo $form['company']->renderLabel(__('Company') . ' <em>*</em>'); ?>
                        <?php echo $form['company']->render(array("class" => "formInputText", "maxlength" => 100)); ?>
                    </li>
                    <li>
                        <?php echo $form['position']->renderLabel(__('Position') . ' <em>*</em>'); ?>
                        <?php echo $form['position']->render(array("class" => "formInputText", "maxlength" => 50)); ?>
                    </li>
                    <li>
                        <?php echo $form['contact_number']->renderLabel(__('Contact Number') . ' <em>*</em>'); ?>
                        <?php echo $form['contact_number']->render(array("class" => "formInputText", "maxlength" => 30)); ?>
                    </li>
                    <li class="required">
                        <em>*</em> <?php echo __(CommonMessages::REQUIRED_FIELD); ?>
                    </li>
                </ol>
                <p>
                    <input type="button" class="" id="btnCharacterReferenceSave" value="<?php echo __("Save"); ?>" />
                    <?php if ((!$haveCharacterReferences) || ($haveCharacterReferences && $characterReferencePermissions->canCreate()) || 
                            ($characterReferencePermissions && $characterReferencePermissions->canUpdate())) { ?>
                    <input type="button" class="reset" id="btnCharacterReferenceCancel" value="<?php echo __("Cancel"); ?>" />
                    <?php } ?>
                </p>
            </fieldset>
        </form>
    </div>
</div> <!-- changeCharacterReference -->
<?php } ?>
        
<div class="miniList" id="tblCharacterReference">
    <div class="head">
        <h1><?php echo __("Character References"); ?></h1>
    </div>
            
    <div class="inner">

        <?php if ($characterReferencePermissions->canRead()) : ?>
        <?php include_partial('global/flash_messages', array('prefix' => 'characterReference')); ?>

        <form id="frmDelCharacterReference" action="<?php echo url_for('pim/saveDeleteCharacterReference?empNumber=' . 
                $empNumber . "&option=delete"); ?>" method="post">
            <?php echo $listForm ?>
            <p id="actionCharacterReference">
                <?php if ($characterReferencePermissions->canCreate() ) { ?>
                <input type="button" value="<?php echo __("Add");?>" class="" id="addCharacterReference" />
                <?php } ?>
                <?php if ($characterReferencePermissions->canDelete() ) { ?>
                <input type="button" value="<?php echo __("Delete");?>" class="delete" id="delCharacterReference" />
                <?php } ?>
            </p>
            <table id="" cellpadding="0" cellspacing="0" width="100%" class="table tablesorter">
                <thead>
                    <tr>
                        <?php if ($characterReferencePermissions->canDelete()) { ?>
                        <th class="check" width="2%"><input type="checkbox" id="characterReferenceCheckAll" /></th>
                        <?php } ?>
                        <th><?php echo __('Name'); ?></th>
                        <th><?php echo __('Company'); ?></th>
                        <th><?php echo __('Position'); ?></th>
                        <th><?php echo __('Contact Number'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$haveCharacterReferences) { ?>
                    <tr>
                        <?php if ($characterReferencePermissions->canDelete()) { ?>
                        <td class="check"></td>
                        <?php } ?>
                        <td><?php echo __(TopLevelMessages::NO_RECORDS_FOUND); ?></td>
                        <td></td>
                    </tr>
                    <?php } else { ?>                        
                    <?php                    
                    $characterReferences = $form->empCharacterReferenceList;

                    $row = 0;
                    foreach ($characterReferences as $characterReference) :
                        $cssClass = ($row % 2) ? 'even' : 'odd';
                        //$characterReferenceName = $characterReference->getCharacterReference()->getName();
                        
                        //var_dump($characterReference->contact_number . "|" . $characterReference->seqno);

                        ?>
                        <tr class="<?php echo $cssClass; ?>">
                            <td class="check">
                                <input type="hidden" id="code_<?php echo $characterReference->seqno; ?>" 
                                       value="<?php echo htmlspecialchars($characterReference->seqno); ?>" />
                                <input type="hidden" id="name_<?php echo $characterReference->seqno; ?>" 
                                       value="<?php echo htmlspecialchars($characterReferenceName->name); ?>" />
                                <input type="hidden" id="relation_<?php echo $characterReference->seqno; ?>" 
                                       value="<?php echo htmlspecialchars($characterReference->relation); ?>" />
                                <input type="hidden" id="company_<?php echo $characterReference->seqno; ?>" 
                                       value="<?php echo htmlspecialchars($characterReference->company); ?>" />
                                <input type="hidden" id="position_<?php echo $characterReference->seqno; ?>" 
                                       value="<?php echo htmlspecialchars($characterReference->position); ?>" />
                                <input type="hidden" id="contact_number_<?php echo $characterReference->seqno; ?>" 
                                       value="<?php echo htmlspecialchars($characterReference->contact_number); ?>" />              
                                <?php if ($characterReferencePermissions->canDelete()) { ?>
                                <input type="checkbox" class="chkbox" value="<?php echo $characterReference->seqno; ?>" 
                                       name="delCharacterReference[]"/>
                                <?php } else { ?>
                                <input type="hidden" class="chkbox" value="<?php echo $characterReference->seqno; ?>" 
                                       name="delCharacterReference[]"/>
                                <?php } ?>
                            </td>
                            <td class="name">
                                <?php if ($characterReferencePermissions->canUpdate()) { ?>
                                <a href="#" class="edit"><?php echo htmlspecialchars($characterReference->name); ?></a>
                                <?php
                                } else {
                                    echo htmlspecialchars($characterReference->name);
                                }
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($characterReference->company); ?></td>
                            <td><?php echo htmlspecialchars($characterReference->position); ?></td>
                            <td><?php echo htmlspecialchars($characterReference->contact_number); ?></td>
                        </tr>
                        <?php
                        $row++;
                    endforeach;
                    }
                    ?>
                </tbody>
            </table>
        </form>

        <?php else : ?>
            <div><?php echo __(CommonMessages::RESTRICTED_SECTION); ?></div>
        <?php endif; ?>

    </div>
</div> <!-- miniList-tblCharacterReference -->

<script type="text/javascript">
    //<![CDATA[
    var fileModified = 0;
    var lang_addCharacterReference = "<?php echo __('Add Character Reference'); ?>";
    var lang_editCharacterReference = "<?php echo __('Edit CharacterReference'); ?>";
    var lang_characterReferenceRequired = '<?php echo __(ValidationMessages::REQUIRED); ?>';
    var lang_selectCharacterReferenceToDelete = "<?php echo __(TopLevelMessages::SELECT_RECORDS); ?>";
    var lang_commentsMaxLength = "<?php echo __(ValidationMessages::TEXT_LENGTH_EXCEEDS, array('%amount%' => 100)); ?>";
    var lang_yearsOfExpShouldBeNumber = "<?php echo __('Should be a number'); ?>";
    var lang_yearsOfExpMax = "<?php echo __("Should be less than %amount%", array("%amount%" => '100')); ?>";
    var canUpdate = '<?php echo $characterReferencePermissions->canUpdate(); ?>';
    //]]>
</script>

<script type="text/javascript">
    //<![CDATA[
    
    $(document).ready(function() {
        //To hide unchanged element into hide and show the value in span while editing
        $('#characterReference_code').after('<span id="static_characterReference_code" style="display:none;"></span>');

        function addEditLinks() {
            // called here to avoid double adding links - When in edit mode and cancel is pressed.
            removeEditLinks();
            $('form#frmDelCharacterReference table tbody td.name').wrapInner('<a class="edit" href="#"/>');
        }
        
        function removeEditLinks() {
            $('form#frmDelCharacterReference table tbody td.name a').each(function(index) {
                $(this).parent().text($(this).text());
            });
        }
        
        //hide add section
        $("#changeCharacterReference").hide();
        $("#characterReferenceRequiredNote").hide();
        
        //hiding the data table if records are not available
        if($("div#tblCharacterReference .chkbox").length == 0) {
            //$("#tblCharacterReference").hide();
            $('div#tblCharacterReference .check').hide();
            $("#editCharacterReference").hide();
            $("#delCharacterReference").hide();
        }
        
        //if check all button clicked
        $("#characterReferenceCheckAll").click(function() {
            $("div#tblCharacterReference .chkbox").removeAttr("checked");
            if($("#characterReferenceCheckAll").attr("checked")) {
                $("div#tblCharacterReference .chkbox").attr("checked", "checked");
            }
        });
        
        //remove tick from the all button if any checkbox unchecked
        $("div#tblCharacterReference .chkbox").click(function() {
            $("#characterReferenceCheckAll").removeAttr('checked');
            if($("div#tblCharacterReference .chkbox").length == $("div#tblCharacterReference .chkbox:checked").length) {
                $("#characterReferenceCheckAll").attr('checked', 'checked');
            }
        });
        
        $("#addCharacterReference").click(function() {
            
            removeEditLinks();
            clearMessageBar();
            $('div#changeCharacterReference label.error').hide();        
            
            //changing the headings
            $("#headChangeCharacterReference").text(lang_addCharacterReference);
            $("div#tblCharacterReference .chkbox").hide();
            $("#characterReferenceCheckAll").hide();
            
            //hiding action button section
            $("#actionCharacterReference").hide();
            
            $('#static_characterReference_code').hide().val("");
            $("#characterReference_code").show().val("");
            $("#characterReference_code option[class='added']").remove();
            $("#characterReference_major").val("");
            $("#characterReference_year").val("");
            $("#characterReference_gpa").val("");
            
            //show add form
            $("#changeCharacterReference").show();
            $("#characterReferenceRequiredNote").show();
        });
        
        //clicking of delete button
        $("#delCharacterReference").click(function(){
            
            clearMessageBar();
            
            if ($("div#tblCharacterReference .chkbox:checked").length > 0) {
                $("#frmDelCharacterReference").submit();
            } else {
                $("#characterReferenceMessagebar").attr('class', 'messageBalloon_notice').text(lang_selectCharacterReferenceToDelete);
            }
            
        });
        
        $("#btnCharacterReferenceSave").click(function() {
            clearMessageBar();
            
            $("#frmCharacterReference").submit();
        });
        
        //form validation
        var characterReferenceValidator =
            $("#frmCharacterReference").validate({
            rules: {
                'characterReference[name]': {required: true},
                'characterReference[relation]': {required: true},
                'characterReference[company]': {required: true},
                'characterReference[position]': {required: true},
                'characterReference[contact_number]': {required: true},
            },
            messages: {
                'characterReference[name]': {required: lang_characterReferenceRequired},
                'characterReference[relation]': {maxlength: lang_commentsMaxLength},
                'characterReference[company]': {maxlength: lang_commentsMaxLength},
                'characterReference[position]': {maxlength: lang_commentsMaxLength},
                'characterReference[contact_number]': {maxlength: lang_commentsMaxLength}
            }
        });
        
        $("#btnCharacterReferenceCancel").click(function() {
            clearMessageBar();
            if(canUpdate){
                addEditLinks();
            }
            
            characterReferenceValidator.resetForm();
            
            $('div#changeCharacterReference label.error').hide();
            
            $("div#tblCharacterReference .chkbox").removeAttr("checked").show();
            
            //hiding action button section
            $("#actionCharacterReference").show();
            $("#changeCharacterReference").hide();
            $("#characterReferenceRequiredNote").hide();        
            $("#characterReferenceCheckAll").show();
            
            // remove any options already in use
            $("#characterReference_code option[class='added']").remove();
            $('#static_characterReference_code').hide().val("");
            
            //remove if disabled while edit
            $('#characterReference_code').removeAttr('disabled');
        });
        
        $('form#frmDelCharacterReference a.edit').live('click', function(event) {
            event.preventDefault();
            clearMessageBar();
        
            alert($("#name_1").val());

            //changing the headings
            $("#headChangeCharacterReference").text(lang_editCharacterReference);
            
            characterReferenceValidator.resetForm();
            
            $('div#changeCharacterReference label.error').hide();
            
            //hiding action button section
            $("#actionCharacterReference").hide();
            
            //show add form
            $("#changeCharacterReference").show();
            var code = $(this).closest("tr").find('input.chkbox:first').val();
            

            $('#static_characterReference_code').text($("#characterReference_name_" + code).val()).show();
            
            alert(code + "|" + $("#name_" + code).val());
            
            //// remove any options already in use
            //$("#characterReference_code option[class='added']").remove();
            
            //$('#characterReference_code').
            //    append($("<option class='added'></option>").
            //    attr("value", code).
            //    text($("#characterReference_name_" + code).val())); 
            $('#characterReference_code').val(code).hide();
            
            $("#characterReference_name").val($("#name_" + code).val());
            $("#characterReference_comments").val($("#comments_" + code).val());
            
            $("#characterReferenceRequiredNote").show();
            
            $("div#tblCharacterReference .chkbox").hide();
            $("#characterReferenceCheckAll").hide();        

        });
    });



    
    //]]>
</script>