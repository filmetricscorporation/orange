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
 *
 */
?>
<?php use_javascripts_for_form($form); ?>
<?php use_stylesheets_for_form($form); ?>

<?php
$numFamilyMembers = count($familymembers);
$haveFamilyMembers = $numFamilyMembers > 0;
?>

<?php if ($form->hasErrors()): ?>
<span class="error">
<?php
echo $form->renderGlobalErrors();

foreach($form->getWidgetSchema()->getPositions() as $widgetName) {
  echo $form[$widgetName]->renderError();
}
?>
</span>
<?php endif; ?>

<div class="box pimPane">
    
    <?php echo include_component('pim', 'pimLeftMenu', array('empNumber'=>$empNumber, 'form' => $form));?>
    
    <?php if ($familymemberPermissions->canCreate() || ($haveFamilyMembers && $familymemberPermissions->canUpdate())) { ?>
    <div id="addPaneFamilyMember">
        <div class="head">
            <h1 id="heading"><?php echo __('Add Family Member'); ?></h1>
        </div>
        
        <div class="inner">
            <form name="frmEmpFamilyMember" id="frmEmpFamilyMember" method="post" action="<?php echo url_for('pim/updateFamilyMember?empNumber=' . $empNumber); ?>">
                <?php echo $form['_csrf_token']; ?>
                <?php echo $form["empNumber"]->render(); ?>
                <?php echo $form["seqNo"]->render(); ?>
                <fieldset>
                    <ol>
                        <li>
                            <?php echo $form['name']->renderLabel(__('Name') . ' <em>*</em>'); ?>
                            <?php echo $form['name']->render(array("class" => "formInputText", "maxlength" => 50)); ?>
                        </li>
                        <li>
                            <?php echo $form['relationshipType']->renderLabel(__('Relationship') . ' <em>*</em>'); ?>
                            <?php echo $form['relationshipType']->render(array("class" => "formSelect")); ?>
                        </li>
                        <li id="relationshipDesc">
                            <?php echo $form['relationship']->renderLabel(__('Please Specify') . ' <em>*</em>'); ?>
                            <?php echo $form['relationship']->render(array("class" => "formInputText", "maxlength" => 50)); ?>
                        </li>
                        <li>
                            <?php echo $form['dateOfBirth']->renderLabel(__('Date of Birth')); ?>
                            <?php echo $form['dateOfBirth']->render(array("class" => "formDateInput")); ?>    
                        </li>
                         <li>
                            <?php echo $form['occupation']->renderLabel(__('Occupation')); ?>
                            <?php echo $form['occupation']->render(array("class" => "formDateInput")); ?>    
                        </li>
                        <li class="required">
                            <em>*</em><?php echo __(CommonMessages::REQUIRED_FIELD); ?>
                        </li>
                    </ol>
                    <p>
                        <input type="button" class="" name="btnSaveFamilyMember" id="btnSaveFamilyMember" value="<?php echo __("Save"); ?>"/>
                        <input type="button" id="btnCancel" class="reset" value="<?php echo __("Cancel"); ?>"/>
                    </p>
                </fieldset>
            </form>
        </div>
    </div> <!-- addPaneFamilyMember -->
    <?php } ?>
    
    <div class="miniList" id="listing">
        <div class="head">
            <h1><?php echo __("Assigned Family Members"); ?></h1>
        </div>
        
        <div class="inner">
            <?php if ($familymemberPermissions->canRead()) : ?>
            
            <?php include_partial('global/flash_messages', array('prefix' => 'viewFamilyMembers')); ?>
            
            <form name="frmEmpDelFamilyMembers" id="frmEmpDelFamilyMembers" method="post" action="<?php echo url_for('pim/deleteFamilyMembers?empNumber=' . $empNumber); ?>">
                <?php echo $deleteForm['_csrf_token']->render(); ?>
                <?php echo $deleteForm['empNumber']->render(); ?>
                <p id="listActions">
                    <?php if ($familymemberPermissions->canCreate()) { ?>
                    <input type="button" class="" id="btnAddFamilyMember" value="<?php echo __("Add"); ?>"/>
                    <?php } ?>
                    <?php if ($familymemberPermissions->canDelete()) { ?>
                    <input type="button" class="delete" id="delFamilyMemberBtn" value="<?php echo __("Delete"); ?>"/>
                    <?php } ?>
                </p>
                <table id="familymember_list" class="table hover">
                    <thead>
                        <tr><?php if ($familymemberPermissions->canDelete()) { ?>
                            <th class="check" style="width:2%"><input type='checkbox' id='checkAll' class="checkbox" /></th>
                            <?php } ?>
                            <th class="familymemberName"><?php echo __("Name"); ?></th>
                            <th><?php echo __("Relationship"); ?></th>
                            <th><?php echo __("Date of Birth"); ?></th>
                            <th><?php echo __("Occupation"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!$haveFamilyMembers) { ?>
                        <tr>
                            <?php if ($familymemberPermissions->canDelete()) { ?>
                            <td class="check"></td>
                            <?php } ?>
                            <td><?php echo __(TopLevelMessages::NO_RECORDS_FOUND); ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php } else { ?>                        
                        <?php
                        $row = 0;
                        foreach ($familymembers as $familymember) :
                            $cssClass = ($row % 2) ? 'even' : 'odd';
                            echo '<tr class="' . $cssClass . '">';
                            if ($familymemberPermissions->canDelete()) {
                            echo "<td class='check'><input type='checkbox' class='checkbox' name='chkfamilymemberdel[]' value='" . $familymember->seqno . "'/></td>";
                            } else {
                            ?>
                            <input type='hidden' class='checkbox' value="<?php echo $familymember->seqno; ?>"/>
                            <?php
                            }
                            ?>
                            <td class="familymemberName">
                                <?php if ($familymemberPermissions->canUpdate()) { ?>
                                <a href="#"><?php echo $familymember->name; ?></a>
                                <?php
                                } else {
                                echo $familymember->name;
                                }
                                ?>
                            </td>
                            <input type="hidden" id="relationType_<?php echo $familymember->seqno; ?>" value="<?php echo $familymember->relationship_type; ?>" />
                            <input type="hidden" id="relationship_<?php echo $familymember->seqno; ?>" value="<?php echo $familymember->relationship; ?>" />
                            <input type="hidden" id="dateOfBirth_<?php echo $familymember->seqno; ?>" value="<?php echo set_datepicker_date_format($familymember->date_of_birth); ?>" />
                            <input type="hidden" id="occupation_<?php echo $familymember->seqno; ?>" value="<?php echo $familymember->occupation; ?>" />
                            <td>
                                <?php if ($familymember->relationship_type != 'other') {
                                echo __($familymember->relationship_type); ?>
                                <?php } else {
                                echo $familymember->relationship;
                                } ?>
                            </td>
                            <?php
                            echo '<td>' . set_datepicker_date_format($familymember->date_of_birth) . '</td>';
                            echo '<td>' . $familymember->occupation . '</td>';
                            echo '</tr>';
                            $row++;
                        endforeach;
                        ?>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
            <?php else : ?>
            <div><?php echo __(CommonMessages::RESTRICTED_SECTION); ?></div>
            <?php endif; ?>
        </div>
    </div> <!-- miniList -->
    
    <!-- Attachments & Custom Fields -->
    <?php
    echo include_component('pim', 'customFields', array('empNumber'=>$empNumber, 'screen' => CustomField::SCREEN_DEPENDENTS));
    echo include_component('pim', 'attachments', array('empNumber'=>$empNumber, 'screen' => EmployeeAttachment::SCREEN_DEPENDENTS));
    ?>
    
</div> <!-- Box -->

<script type="text/javascript">
    //<![CDATA[
    // Move to separate js after completing initial work
    var datepickerDateFormat = '<?php echo get_datepicker_date_format($sf_user->getDateFormat()); ?>';
    var lang_validDateMsg = '<?php echo __(ValidationMessages::DATE_FORMAT_INVALID, array('%format%' => str_replace('yy', 'yyyy', get_datepicker_date_format($sf_user->getDateFormat())))); ?>'

    $('#delFamilyMemberBtn').attr('disabled', 'disabled');

    function clearAddForm() {
        $('#familymember_seqNo').val('');
        $('#familymember_name').val('');
        $('#familymember_relationshipType').val('');
        $('#familymember_relationship').val('');
        $('#familymember_occupation').val('');
        $('#familymember_dateOfBirth').val(displayDateFormat);
        $('div#addPaneFamilyMember label.error').hide();
        $('div#messagebar').hide();
    }

    function addEditLinks() {
        removeEditLinks();
        $('#familymember_list tbody td.familymemberName').wrapInner('<a href="#"/>');
    }

    function removeEditLinks() {
        $('#familymember_list tbody td.familymemberName a').each(function(index) {
            $(this).parent().text($(this).text());
        });
    }

    /*function hideShowRelationshipOther() {
        if ($('#familymember_relationshipType').val() == 'child' || $('#familymember_relationshipType').val() == '') {
            $('#relationshipDesc').hide();
        } else {
            $('#relationshipDesc').show();
        }
    }*/

    function hideShowRelationshipOther() {
        if ($('#familymember_relationshipType').val() == 'other') {
            $('#relationshipDesc').show();
        } else {
            $('#relationshipDesc').hide();
        }
    }

    $(document).ready(function() {
        
        $('#addPaneFamilyMember').hide();
        <?php  if (!$haveFamilyMembers){?>
        $(".check").hide();
        <?php } ?>
        
        $("#checkAll").click(function(){
            if($("#checkAll:checked").attr('value') == 'on') {
                $(".checkbox").attr('checked', 'checked');
            } else {
                $(".checkbox").removeAttr('checked');
            }
            
            if($('.checkbox:checkbox:checked').length > 0) {
                $('#delFamilyMemberBtn').removeAttr('disabled');
            } else {
                $('#delFamilyMemberBtn').attr('disabled', 'disabled');
            }
        });

        $(".checkbox").click(function() {
            $("#checkAll").removeAttr('checked');
            if(($(".checkbox").length - 1) == $(".checkbox:checked").length) {
                $("#checkAll").attr('checked', 'checked');
            }
            
            if($('.checkbox:checkbox:checked').length > 0) {
                $('#delFamilyMemberBtn').removeAttr('disabled');
            } else {
                $('#delFamilyMemberBtn').attr('disabled', 'disabled');
            }
        });

        hideShowRelationshipOther();
        
        // Edit a emergency contact in the list
        $('#frmEmpDelFamilyMembers a').live('click', function() {
            $("#heading").text("<?php echo __("Edit Family Member");?>");
            var row = $(this).closest("tr");
            var seqNo = row.find('input.checkbox:first').val();
            var name = $(this).text();

            var relationshipType = $("#relationType_" + seqNo).val();
            var relationship = $("#relationship_" + seqNo).val();
            var dateOfBirth = $("#dateOfBirth_" + seqNo).val();
            var occupation = $("#occupation_" + seqNo).val();

            $('#familymember_seqNo').val(seqNo);
            $('#familymember_name').val(name);
            $('#familymember_relationshipType').val(relationshipType);
            $('#familymember_relationship').val(relationship);
            $('#familymember_occupation').val(occupation);

            if ($.trim(dateOfBirth) == '') {
                dateOfBirth = displayDateFormat;
            }
            $('#familymember_dateOfBirth').val(dateOfBirth);

            $('div#messagebar').hide();
            hideShowRelationshipOther();
            // hide validation error messages

            $('#listActions').hide();
            $('#familymember_list .check').hide();
            $('#addPaneFamilyMember').css('display', 'block');

            $(".paddingLeftRequired").show();
            $('#btnCancel').show();

        });

        $('#familymember_relationshipType').change(function() {
            hideShowRelationshipOther();
        });

        // Cancel in add pane
        $('#btnCancel').click(function() {
            clearAddForm();
            $('#addPaneFamilyMember').css('display', 'none');
            $('#listActions').show();
            $('#familymember_list .check').show();
            <?php if ($familymemberPermissions->canUpdate()){?>
            addEditLinks();
            <?php }?>
            $('div#messagebar').hide();
            $(".paddingLeftRequired").hide();
        });

        // Add a emergency contact
        $('#btnAddFamilyMember').click(function() {
            $("#heading").text("<?php echo __("Add Family Member");?>");
            clearAddForm();

            // Hide list action buttons and checkbox
            $('#listActions').hide();
            $('#familymember_list .check').hide();
            removeEditLinks();
            $('div#messagebar').hide();
            
            hideShowRelationshipOther();

            $('#addPaneFamilyMember').css('display', 'block');

            $(".paddingLeftRequired").show();

        });

        /* Valid Contact Phone */
        $.validator.addMethod("validContactPhone", function(value, element) {

            if ( $('#familymember_homePhone').val() == '' && $('#familymember_mobilePhone').val() == '' &&
                    $('#familymember_workPhone').val() == '' )
                return false;
            else
                return true
        });
        
        $("#frmEmpFamilyMember").validate({

            rules: {
                'familymember[name]' : {required:true, maxlength:100},
                'familymember[relationshipType]' : {required: true},
                'familymember[relationship]' : {required: function(element) {
                    return $('#familymember_relationshipType').val() == 'other';
                }},
                'familymember[dateOfBirth]' : {valid_date: function() {
                        return {format:datepickerDateFormat, required:false, displayFormat:displayDateFormat}
                    }
                },
                maxlength:100
            },
            messages: {
                'familymember[name]': {
                    required:'<?php echo __(ValidationMessages::REQUIRED) ?>',
                    maxlength: '<?php echo __(ValidationMessages::TEXT_LENGTH_EXCEEDS,array('%amount%' => 100)) ?>'
                },
                'familymember[relationshipType]': {
                    required:'<?php echo __(ValidationMessages::REQUIRED) ?>'
                },
                'familymember[relationship]': {
                    required:'<?php echo __(ValidationMessages::REQUIRED) ?>',
                    maxlength:'<?php echo __(ValidationMessages::TEXT_LENGTH_EXCEEDS,array('%amount%' => 100));?>'
                },
                'familymember[dateOfBirth]' : {
                    valid_date: lang_validDateMsg
                }
            }
        });

        
        $('#delFamilyMemberBtn').click(function() {
            var checked = $('#frmEmpDelFamilyMembers input:checked').length;

            if (checked == 0) {
                $('div#messagebar').show();
                $("#messagebar").attr('class', "messageBalloon_notice");
                $("#messagebar").text('<?php echo __(TopLevelMessages::SELECT_RECORDS); ?>');
            } else {
                $('#frmEmpDelFamilyMembers').submit();
            }
        });

        $('#btnSaveFamilyMember').click(function() {
            $('#frmEmpFamilyMember').submit();
        });
});
//]]>
</script>

