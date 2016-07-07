$(document).ready(function(){

    //$("form#frmHolidayType :input:visible:enabled:first").focus();
    $('#exclude_link').click(function(){
        $("#excludeInfoDialog").modal();
    });
    
    $('#saveButton').click(function(){
        $('#frmHolidayType').submit();
    });
    
    $.validator.addMethod("uniqueHolidayType", function(value) {
        
        var valid = true;        
        var originalName  = $.trim($("#holidayType_hdnOriginalHolidayTypeName").val()).toLowerCase();
        
        value = $.trim(value).toLowerCase();
        
        if (value != originalName) {
            for (var i = 0; i < activeHolidayTypes.length; i++) {
                if (value == activeHolidayTypes[i].toLowerCase()) {
                    valid = false;
                    break;
                }
            }
        }
        
        return valid;
    });
    
    var validator = 
    $("#frmHolidayType").validate({
        rules: {
            'holidayType[txtHolidayTypeName]': {
                required: true, 
                maxlength: 50,
                uniqueHolidayType: true
            }
        },
        messages: {
            'holidayType[txtHolidayTypeName]': {
                required: lang_HolidayTypeNameRequired,
                maxlength: lang_HolidayTypeNameTooLong,
                uniqueHolidayType: lang_HolidayTypeExists
            }
        },
        submitHandler: function(form) {
            
            var deletedId = isDeletedHolidayType();
            if (deletedId) {
                $('#undeleteHolidayType_undeleteId').val(deletedId);               
                $("#undeleteDialog").modal();
            } else {
                form.submit();
            }
        }
    });

    $('#backButton').click(function(){
        window.location.href = backButtonUrl;
    });

    $("#undeleteYes").click(function(){
        $('#frmUndeleteHolidayType').submit();
    });

    $("#undeleteNo").click(function(){
        $(this).attr('disabled', true);
        $('#holidayType_txtHolidayTypeName').attr('disabled', false);
        $('#frmHolidayType').get(0).submit();
    });


    loadActiveHolidayTypes();
    loadDeletedHolidayTypes();
});

/**
 * Checks if current holiday type name value matches a deleted holiday type.
 * 
 * @return Holiday Type ID if it matches a deleted holiday type else false.
 */
function isDeletedHolidayType() {

    if ($.trim($("#holidayType_hdnOriginalHolidayTypeName").val()) ==
        $.trim($("#holidayType_txtHolidayTypeName").val())) {
        return false;
    }

    for (var i = 0; i < deletedHolidayTypes.length; i++) {
        if (deletedHolidayTypes[i].name.toLowerCase() == 
            $.trim($('#holidayType_txtHolidayTypeName').val()).toLowerCase()) {
            return deletedHolidayTypes[i].id;
        }
    }
    return false;
}

function loadActiveHolidayTypes() {
    var url = './loadActiveHolidayTypesJson';

    $.getJSON(url, function(data) {
        activeHolidayTypes = data;
    });
}

function loadDeletedHolidayTypes() {
    var url = './loadDeletedHolidayTypesJson';
    
    $.getJSON(url, function(data) {
        deletedHolidayTypes = data;
    });
}