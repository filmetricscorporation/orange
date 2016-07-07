
<div class="box pimPane">
    
    <?php echo include_component('pim', 'pimLeftMenu', array('empNumber'=>$empNumber, 'form' => $form));?>
    
    <?php if ($workshiftPermissions->canCreate() || (count($workshiftList) > 0 && $workshiftPermissions->canUpdate())) { ?>
    <div id="changeWorkShift">
        <div class="head">
            <h1 id="headchangeWorkShift"><?php echo __('Add WorkShift Component'); ?></h1>
        </div>
        
        <div class="inner">
            <form id="frmWorkShift" action="<?php echo url_for('pim/viewWorkShiftList?empNumber=' . $empNumber); ?>" method="post" class="longLabels">
                <fieldset>
                    <?php echo $form['_csrf_token']; ?>
                    <?php echo $form['id']->render(); ?>
                    <?php echo $form['emp_number']->render(); ?>
                    <ol>
                        <li>
                            <?php echo $form['work_shift_code']->renderLabel(__('Work Shift') . ' <em>*</em>'); ?>
                            <?php
                            if ($form->havePayGrades) {
                                echo $form['work_shift_code']->render(array("class" => "formSelect"));
                            } else {
                                echo $form['work_shift_code']->render();
                            ?>
                                <label id="noWorkShiftGrade" for="work_shift_code"><?php echo __("Not Defined"); ?></label>
                            <?php } ?>
                        </li>
                        <li>
                            <?php echo $form['dayperiod_code']->renderLabel(__('Day') . ' <em>*</em>'); ?>
                            <?php echo $form['dayperiod_code']->render(array("class" => "formSelect")); ?>
                        </li>
                        <li>
                            <input name="" disabled="disabled" id="minWorkShift" type="hidden" value=""/>
                            <input name="" disabled="disabled" id="maxWorkShift" type="hidden" value=""/>                            
                            <label for="minWorkShift" id="minMaxSalaryLbl" class="fieldHelpRight"></label>
                        </li>
                      
                        <li class="required" id="notDirectDebitSection">
                            <em>*</em> <?php echo __(CommonMessages::REQUIRED_FIELD); ?>
                        </li>
                    </ol>
                    <p>
                        <input type="button" class="" id="btnWorkShiftSave" value="<?php echo __("Save"); ?>" />
                        <?php if (
                                (count($workshiftList) > 0) || 
                                (count($workshiftList) > 0 && $workshiftPermissions->canCreate()) || 
                                (count($workshiftList) > 0 && $workshiftPermissions->canUpdate())
                                ) { ?>
                        <input type="button" class="reset" id="btnWorkShiftCancel" value="<?php echo __("Cancel"); ?>" />
                        <?php } ?>
                    </p>
                </fieldset>
            </form>
        </div> <!-- inner -->
    </div> <!-- changeWorkShift-Add-or-Edit-workshift -->
    <?php } ?>
    
    <div class="miniList" id="workshiftMiniList">
        <div class="head">
            <h1><?php echo __("Assigned Work Shifts"); ?></h1>
        </div>
        
        <div class="inner">
            <?php if ($workshiftPermissions->canRead()) : ?>
            
            <?php include_partial('global/flash_messages', array('prefix' => 'workshift')); ?>
            
            <form id="frmDelWorkShift" action="<?php echo url_for('pim/deleteWorkShift?empNumber=' . $empNumber); ?>" method="post" class="longLabels">
                <?php echo $listForm ?>
                <p id="actionWorkShift">
                    <?php if ($workshiftPermissions->canCreate()) { ?>
                    <input type="button" value="<?php echo __("Add"); ?>" class="" id="addWorkShift" />
                    <?php } ?>
                    <?php if ($workshiftPermissions->canDelete() && count($workshiftList) > 0) { ?>
                    <input type="button" value="<?php echo __("Delete"); ?>" class="delete" id="delWorkShift" />
                    <?php } ?>
                </p>
                <table id="tblWorkShift" class="table hover">
                    <thead>
                        <tr>
                            <?php if ($workshiftPermissions->canDelete() && count($workshiftList) > 0) { ?>
                            <th class="check" style="width:2%"><input type="checkbox" id="workshiftCheckAll" /></th>
                            <?php } ?>
                            <th class="component"><?php echo __('Day'); ?></th>
                            <th class="payperiod"><?php echo __('Work Shift Name'); ?></th>
                            <th class="currency"><?php echo __('Start Time'); ?></th>
                            <th class="amount"><?php echo __('End Time'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        var_dump($workshiftList);

                        if (!(count($workshiftList) > 0)) { ?>
                        <tr>
                            <td><?php echo __(TopLevelMessages::NO_RECORDS_FOUND); ?></td>
                            <td colspan="5"></td>
                        </tr>
                        <?php } else { ?>                        
                        <?php
                        $row = 0;
                        foreach ($workshiftList as $workshift) :
                            $cssClass = ($row % 2) ? 'even' : 'odd';
                            //empty($workshift->from_date)
                            $component = $workshift->getWorkShiftName();
                            $period = $workshift->getPayperiod();
                            $payPeriodName = empty($period) ? '' : htmlspecialchars($period->getName());
                            $payPeriodCode = empty($period) ? '' : htmlspecialchars($period->getCode());
                            $currency = $workshift->getCurrencyType();
                            $currencyName = empty($currency) ? '' : __(htmlspecialchars($currency->getCurrencyName()));
                            $currencyId = empty($currency) ? '' : htmlspecialchars($currency->getCurrencyId());
                            $amount = $workshift->getAmount();
                            $comments = $workshift->getNotes();
                            $workshiftGrade = $workshift->getPayGradeId();
                            $directDeposit = $workshift->getDirectDebit();
                            $hasDirectDeposit = !empty($directDeposit->id);
                            $accountType = $directDeposit->account_type;
                            $otherType = "";
                            if ($hasDirectDeposit) {
                                if (($directDeposit->account_type != EmployeeDirectDepositForm::ACCOUNT_TYPE_SAVINGS) && 
                                        ($directDeposit->account_type != EmployeeDirectDepositForm::ACCOUNT_TYPE_CHECKING)) {
                                    $accountType = EmployeeDirectDepositForm::ACCOUNT_TYPE_OTHER;
                                    $otherType = $directDeposit->account_type;
                                }
                            }
                            ?>
                            <tr class="<?php echo $cssClass; ?>">
                                <?php if (!$essUserMode && $workshiftPermissions->canDelete()) { ?>

                                <td class="check">
                                    <input type="checkbox" class="chkbox" value="<?php echo $workshift->id; ?>" name="delWorkShift[]"/>
                                </td>
                                <?php } ?>
                                <td class="component">
                                    <input type="hidden" id="code_<?php echo $workshift->id; ?>" value="<?php echo $workshift->id; ?>" />                                      <?php if($workshiftPermissions->canUpdate()) {?>
                                    <a href="#" class="edit"><?php echo $component;?></a>
                                    <?php }else{ 
                                    echo $component;
                                    }?>
                                </td>
                                <td><?php echo __($payPeriodName); ?></td>
                                <td class="currency"><?php echo $currencyName; ?></td>
                                <td class="amount"><?php echo $amount; ?></td>
                                <td class="comments"><?php echo $comments; ?></td>
                                <td>
                                    <?php if ($hasDirectDeposit) { ?>
                                    <input type="checkbox" class="chkbox displayDirectDeposit" value="<?php echo $workshift->id; ?>"/>
                                    <input type="hidden" id="dd_id_<?php echo $workshift->id; ?>" value="<?php echo $directDeposit->id; ?>" />
                                    <input type="hidden" id="dd_account_type_<?php echo $workshift->id; ?>" value="<?php echo $accountType; ?>" />
                                    <input type="hidden" id="dd_other_<?php echo $workshift->id; ?>" value="<?php echo $otherType; ?>" />
                                    <input type="hidden" id="dd_account_<?php echo $workshift->id; ?>" value="<?php echo $directDeposit->account; ?>" />
                                    <input type="hidden" id="dd_routing_num_<?php echo $workshift->id; ?>" value="<?php echo $directDeposit->routing_num; ?>" />
                                    <input type="hidden" id="dd_amount_<?php echo $workshift->id; ?>" value="<?php echo $directDeposit->amount; ?>" />
                                    <?php } ?>
                                    <input type="hidden" id="sal_grd_code_<?php echo $workshift->id; ?>" value="<?php echo htmlspecialchars($workshiftGrade); ?>" />
                                    <input type="hidden" id="currency_id_<?php echo $workshift->id; ?>" value="<?php echo htmlspecialchars($currencyId); ?>" />
                                    <input type="hidden" id="payperiod_code_<?php echo $workshift->id; ?>" value="<?php echo htmlspecialchars($payPeriodCode); ?>" />
                                    <input type="hidden" id="have_dd_<?php echo $workshift->id; ?>" value="<?php echo $hasDirectDeposit ? "1" : "0" ?>" />
                                </td>
                            </tr>
                            <?php
                            if ($hasDirectDeposit) {
                                $accountTypeStr = "";
                                if ($accountType == EmployeeDirectDepositForm::ACCOUNT_TYPE_OTHER) {
                                    $accountTypeStr = $otherType;
                                } else {
                                    $accountTypeStr = $directDepositForm->getAccountTypeDescription($accountType);
                                }
                                ?>
                                <tr class="directDepositRow <?php echo $cssClass; ?>" style="display:none;">
                                    <td colspan="<?php echo $essUserMode || !$workshiftPermissions->canDelete() ? '6' : '7'?>" class="<?php echo $cssClass; ?>" >
                                        <span class="directDepositHeading"><h3><?php echo __("Direct Deposit Details"); ?></h3></span>
                                        <table class="table hover" style="width:60%">
                                            <thead>
                                                <tr>
                                                    <th><?php echo __("Account Number"); ?></th>
                                                    <th><?php echo __("Account Type"); ?></th>
                                                    <th><?php echo __("Routing Number"); ?></th>
                                                    <th><?php echo __("Amount"); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $directDeposit->account; ?></td>
                                                    <td><?php echo $accountTypeStr; ?></td>
                                                    <td><?php echo $directDeposit->routing_num; ?></td>
                                                    <td><?php echo $directDeposit->amount; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            <?php
                            }
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
    </div> <!-- miniList-workshiftMiniList -->
    
    <?php 
    echo include_component('pim', 'customFields', array('empNumber' => $empNumber, 'screen' => CustomField::SCREEN_SALARY));
    //echo include_component('pim', 'attachments', array('empNumber' => $empNumber, 'screen' => EmployeeAttachment::SCREEN_SALARY)); 
    ?>
</div> <!-- Box -->

<script type="text/javascript">
//<![CDATA[

    var canUpdate = '<?php echo $workshiftPermissions->canUpdate(); ?>';
    var fileModified = 0;
    var lang_addWorkShift = "<?php echo __('Add Work Shift'); ?>";
    var lang_editWorkShift = "<?php echo __('Edit Work Shift'); ?>";
    var lang_payPeriodRequired = "<?php echo __(ValidationMessages::REQUIRED); ?>";
    var lang_currencyRequired = "<?php echo __(ValidationMessages::REQUIRED); ?>";
    var lang_componentRequired = "<?php echo __(ValidationMessages::REQUIRED); ?>";
    var lang_amountRequired = "<?php echo __(ValidationMessages::REQUIRED); ?>";
    var lang_invalidAmount = "<?php echo __("Should be within Min/Max values"); ?>";
    var lang_negativeAmount = "<?php echo __("Should be a positive number"); ?>";
    var lang_tooLargeAmount = "<?php echo __("Should be less than %amount%", array("%amount%" => '1000,000,000')); ?>";
    var lang_amountShouldBeNumber = "<?php echo __("Should be a number"); ?>";
    var lang_commentsLength = "<?php echo __(ValidationMessages::TEXT_LENGTH_EXCEEDS, array('%amount%' => 250)) ?>";
    var lang_componentLength = "<?php echo __(ValidationMessages::TEXT_LENGTH_EXCEEDS, array('%amount%' => 100)); ?>";
    var lang_selectWorkShiftToDelete = "<?php echo __(TopLevelMessages::SELECT_RECORDS); ?>";
    var lang_accountRequired = "<?php echo __(ValidationMessages::REQUIRED); ?>";
    var lang_accountMaxLength = "<?php echo __(ValidationMessages::TEXT_LENGTH_EXCEEDS, array('%amount%' => 100)); ?>";
    var lang_accountTypeRequired = "<?php echo __(ValidationMessages::REQUIRED); ?>";
    var lang_routingNumRequired = "<?php echo __(ValidationMessages::REQUIRED); ?>";
    var lang_routingNumInteger = "<?php echo __('Should be a number'); ?>";
    var lang_depositAmountRequired=  "<?php echo __(ValidationMessages::REQUIRED); ?>";
    var lang_depositAmountShouldBeNumber = "<?php echo __('Should be a number'); ?>";
    var lang_otherRequired = "<?php echo __(ValidationMessages::REQUIRED); ?>";
    var lang_otherMaxLength = "<?php echo __(ValidationMessages::TEXT_LENGTH_EXCEEDS, array('%amount%' => 20)); ?>";
    var essMode = '<?php echo $essUserMode; ?>';
//]]>
</script>

<script type="text/javascript">
//<![CDATA[

    $('#delWorkShift').attr('disabled', 'disabled');

    function clearMessageBar() {
        $("#messagebar").text("").attr('class', "");
    }
    
    function clearMinMax() {
        $("#minWorkShift").val('--');
        $("#maxWorkShift").val('--');
        $('#minMaxWorkShiftLbl').text('');
    }

    function getMinMax(workshiftGrade, currency) {
        var notApplicable = '<?php echo __("N/A"); ?>';

        if (workshiftGrade == '') {
            $("#minWorkShift").val('');
            $("#maxWorkShift").val('');
            $('#minMaxWorkShiftLbl').text('');
        }
        else {
            var url = '<?php echo url_for('admin/getMinMaxWorkShiftJson'); ?>' + '/workshiftGrade/' + workshiftGrade + "/currency/" + currency;

            $.getJSON(url, function(data) {

                var minWorkShift = false;
                var maxWorkShift = false;
                var minVal = "";
                var maxVal = "";
                var minMaxLbl = "";

                if (data) {
                    if (data.min) {
                        minWorkShift = data.min;
                        minVal = minWorkShift;
                        minMaxLbl = '<?php echo __("Min"); ?>' + " : " + minWorkShift + " ";
                    }

                    if (data.max) {
                        maxWorkShift = data.max;
                        maxVal = maxWorkShift;
                        minMaxLbl = minMaxLbl + '<?php echo __("Max"); ?>' + " : " + maxWorkShift;
                    }
                }

                $("#minWorkShift").val(minVal);
                $("#maxWorkShift").val(maxVal);
                $('#minMaxWorkShiftLbl').text(minMaxLbl);
            });

        }
    }

    function updateCurrencyList(payGrade, currencyId, currencyName) {

        var url = '<?php echo url_for('pim/getAvailableCurrenciesJson?empNumber=' . $empNumber . '&paygrade='); ?>' + payGrade;

        $.getJSON(url, function(data) {

            var numOptions = data.length;
            var optionHtml = '<option value="">-- <?php echo __("Select") ?> --</option>';

            for (var i = 0; i < numOptions; i++) {
                optionHtml += '<option value="' + data[i].currency_id + '">' + data[i].currency_name + '</option>';
            }

            $("#workshift_currency_id").html(optionHtml);

            // If editing a currency, add that currency to list
            if (currencyId && currencyName) {
                $('#workshift_currency_id').val(currencyId);
                getMinMax(payGrade, currencyId);
            } else {
                $('#workshift_currency_id').val('');
                clearMinMax();
            }

        })
    }

    function clearDirectDepositFields() {
        $("#workshift_set_direct_debit").removeAttr('checked');
        $("#directdeposit_id").val('');
        $("#directdeposit_account").val('');
        $("#directdeposit_account_type").val('');
        $("#directdeposit_routing_num").val('');
        $("#directdeposit_amount").val('');
    }

    $(document).ready(function() {

    $("#changeWorkShift").hide();

    //if check all button clicked
    $("#workshiftCheckAll").click(function() {
        $(".check .chkbox").removeAttr("checked");
        if ($("#workshiftCheckAll").attr("checked")) {
            $(".check .chkbox").attr("checked", "checked");
        }
        
        if($('.check .chkbox:checkbox:checked').length > 0) {
            $('#delWorkShift').removeAttr('disabled');
        } else {
            $('#delWorkShift').attr('disabled', 'disabled');
        }
    });

    //remove tick from the all button if any checkbox unchecked
    $(".check .chkbox").click(function() {
        $("#workshiftCheckAll").removeAttr('checked');
        if ($(".check .chkbox").length == $(".check .chkbox:checked").length) {
            $("#workshiftCheckAll").attr('checked', 'checked');
        }
        
        if($('.check .chkbox:checkbox:checked').length > 0) {
            $('#delWorkShift').removeAttr('disabled');
        } else {
            $('#delWorkShift').attr('disabled', 'disabled');
        }
    });

    $("#workshift_set_direct_debit").click(function() {
        
        if ($(this).attr('checked')) {
            $('#directDebitSection').show();
            $('#notDirectDebitSection').hide();
        } else {
            $('#directDebitSection').hide();
            $('#notDirectDebitSection').show();
        }
        
    });

    $("input.displayDirectDeposit").click(function() {
        
        // find row with direct deposit details
        var directDepositRow = $(this).closest("tr").next();
        
        if ($(this).attr('checked')) {
            directDepositRow.show();
        } else {
            directDepositRow.hide();
        }
    });

    $("#directdeposit_account_type").change(function() {
        if ($(this).val() == '<?php echo EmployeeDirectDepositForm::ACCOUNT_TYPE_OTHER; ?>') {
            $('#accountTypeOther').show();
        } else {
            $('#accountTypeOther').hide();
        }
    });
    
    $("#addWorkShift").click(function() {

        removeEditLinks();
        clearMessageBar();
        $('div#changeWorkShift label.error').hide();
        $('#actionClearBr').hide();


        //changing the headings
        $("#headchangeWorkShift").text(lang_addWorkShift);
        $('.check').hide();

        //hiding action button section
        $("#actionWorkShift").hide();

        $('#workshift_id').val("");
        $('#workshift_sal_grd_code').val("");
        updateCurrencyList('', false, false);
        $('#workshift_currency_id').val("");

        clearMinMax();

        $("#workshift_basic_workshift").val("");
        $("#workshift_payperiod_code").val("");
        $("#workshift_component").val("");
        $("#workshift_comments").val("");

        //show add form
        $("#changeWorkShift").show();

        // hide direct deposit section
        $('#directDebitSection').hide();
        $('#notDirectDebitSection').show();
        clearDirectDepositFields();
        $("#workshift_set_direct_debit").removeAttr('checked');

    });

    //clicking of delete button
    $("#delWorkShift").click(function(){
        if ($(".check .chkbox:checked").length > 0) {
            $("#frmDelWorkShift").submit();
        }
    });

    $("#btnWorkShiftSave").click(function() {
        clearMessageBar();
        
        $("#frmWorkShift").submit();
    });

    /* Valid From Date */
    $.validator.addMethod("validateAmount", function(value, element) {
        
        var valid = true;
        
        var min = parseFloat($('#minWorkShift').val());
        var max = parseFloat($('#maxWorkShift').val());
        var amount = parseFloat($('#workshift_basic_workshift').val().trim());
        
        if (!isNaN(amount) && (min != 0 || max != 0)) {
            
            if (!isNaN(min) && (amount < min)) {
                valid = false;
            }
            
            if (!isNaN(max) && max != 0 && (amount > max)) {
                valid = false;
            }
        }
        return valid;
        
    });

    //form validation
    var workshiftValidator =
        $("#frmWorkShift").validate({
        rules: {
            'workshift[sal_grd_code]': {required: false},
            'workshift[currency_id]': {required: true},
            'workshift[workshift_component]': {required: true, maxlength: 100},
            'workshift[comments]': {required: false, maxlength: 250},
            'workshift[basic_workshift]': {number:true, validateAmount:true, required: true, min: 0, max:999999999.99},
            'directdeposit[account]': {required: "#workshift_set_direct_debit:checked", maxlength:100},
            'directdeposit[account_type]': {required: "#workshift_set_direct_debit:checked"},
            'directdeposit[account_type_other]': {
                required: function(element) {
                    if ( $('#workshift_set_direct_debit:checked').length &&
                        $('#directdeposit_account_type').val() == "OTHER" ) {
                        return true;
                    } else {
                        return false;
                    }
                },
                maxlength:20},
            'directdeposit[routing_num]': {required: "#workshift_set_direct_debit:checked", digits:true},
            'directdeposit[amount]': {required: "#workshift_set_direct_debit:checked", number:true, min: 0, max:1000000000.00}
        },
        messages: {
            'workshift[currency_id]': {required: lang_currencyRequired},
            'workshift[workshift_component]': {required: lang_componentRequired, maxlength: lang_componentLength},
            'workshift[comments]': {maxlength: lang_commentsLength},
            'workshift[basic_workshift]': {number: lang_amountShouldBeNumber, validateAmount: lang_invalidAmount, required: lang_amountRequired, min: lang_negativeAmount, max:lang_tooLargeAmount},
            'directdeposit[account]': {required: lang_accountRequired, maxlength: lang_accountMaxLength},
            'directdeposit[account_type]': {required: lang_accountTypeRequired},
            'directdeposit[account_type_other]': {required: lang_otherRequired, maxlength: lang_otherMaxLength},
            'directdeposit[routing_num]': {required: lang_routingNumRequired, digits: lang_routingNumInteger},
            'directdeposit[amount]': {required: lang_amountRequired, number: lang_depositAmountShouldBeNumber, min: lang_negativeAmount, max:lang_tooLargeAmount}
            
        }
    });
    
    function addEditLinks() {
        if (canUpdate) {
            // called here to avoid double adding links - When in edit mode and cancel is pressed.
            removeEditLinks();
            $('td.component').wrapInner('<a class="edit" href="#"/>');
        }
    }
    $('#accountTypeOther').hide();
    function removeEditLinks() {
        $('td.component a').each(function(index) {
            $(this).parent().text($(this).text());
        });
    }

    $("#btnWorkShiftCancel").click(function() {
        clearMessageBar();

        addEditLinks();
        workshiftValidator.resetForm();
        $('#actionClearBr').show();

        $('div#changeWorkShift label.error').hide();

        $(".chkbox").removeAttr("checked");
        $('.check').show();
        $('td.component').attr('colspan', 1);

        //hiding action button section
        $("#actionWorkShift").show();
        $("#changeWorkShift").hide();

        $('#workshift_id').val('');

        // remove any options already in use
        $("#workshift_code option[class='added']").remove();
        clearDirectDepositFields();
        $('#static_workshift_code').hide().val("");

    });

    $('form#frmDelWorkShift a.edit').live('click', function(event) {
        event.preventDefault();
        clearMessageBar();
        $('#actionClearBr').hide();
        
        //changing the headings
        $("#headchangeWorkShift").text(lang_editWorkShift);
        
        workshiftValidator.resetForm();
        
        $('div#changeWorkShift label.error').hide();
        
        //hiding action button section
        $("#actionWorkShift").hide();
        
        //show add form
        $("#changeWorkShift").show();
        
        var id = $(this).closest("tr").find('input.chkbox:first').val();
        
        $('#workshift_id').val(id);
        
        var salGrdCode = $("#sal_grd_code_" + id).val();
        $("#workshift_sal_grd_code").val(salGrdCode);
        
        var currencyId = $("#currency_id_" + id).val();
        $("#workshift_currency_id").val(currencyId);
        var currencyName = $(this).closest("tr").find('td.currency').text();
        
        var basicWorkShift =  $(this).closest("tr").find('td.amount').text();
        $("#workshift_basic_workshift").val(basicWorkShift);
        
        $("#workshift_payperiod_code").val($("#payperiod_code_" + id).val());
        
        var component =  $(this).closest("tr").find('td.component').text().trim();
        
        $("#workshift_workshift_component").val(component);
        
        var comments =  $(this).closest("tr").find('td.comments').text();
        $("#workshift_comments").val(comments);
        
        // Direct Deposit
        
        var haveDirectDeposit = $("#have_dd_" + id).val() == "1";
        
        if (haveDirectDeposit) {
            $("#workshift_set_direct_debit").attr('checked', 'checked');
            $("#directdeposit_id").val($("#dd_id_" + id).val());
            $("#directdeposit_account").val($("#dd_account_" + id).val());
            $("#directdeposit_account_type").val($("#dd_account_type_" + id).val());
            $("#directdeposit_account_type_other").val($("#dd_other_" + id).val());
            $("#directdeposit_routing_num").val($("#dd_routing_num_" + id).val());
            $("#directdeposit_amount").val($("#dd_amount_" + id).val());
            $('#directDebitSection').show();
            $('#notDirectDebitSection').hide();
            
            
            if ($("#directdeposit_account_type_other").val() == '') {
                $('#accountTypeOther').hide();
            } else {
                $('#accountTypeOther').show();
            }
            
        } else {
            $("#workshift_set_direct_debit").removeAttr('checked');
            $('#directDebitSection').hide();
            $('#notDirectDebitSection').show();
            clearDirectDepositFields();
        }
        
        $("#workshift_payperiod_code").val($("#payperiod_code_" + id).val());
        
        updateCurrencyList(salGrdCode, currencyId, currencyName);
        
        $(".check").hide();
        
    });
    
    /*
     * Ajax call to fetch unassigned currencies for selected pay grade
     */
    $("#workshift_sal_grd_code").change(function() {
        
        var payGrade = this.options[this.selectedIndex].value;
        updateCurrencyList(payGrade, false, false);
    });
    

    /*
     * Ajax call to fetch min/max workshift
     */
    $("#workshift_currency_id").change(function() {
        
        var currencyCode = this.options[this.selectedIndex].value;
        var workshiftGrade = $("#workshift_sal_grd_code").val();
        
        $('#workshift_currency_id').val(currencyCode);
        
        // don't check if not selected
        if (currencyCode == '0') {
            clearMinMax();
            return;
        }
        getMinMax(workshiftGrade, currencyCode);
    });

    //$("#workshift_work_shift_code").click(function(){
    //    alert("test");
    //});


});
//]]>
</script>
