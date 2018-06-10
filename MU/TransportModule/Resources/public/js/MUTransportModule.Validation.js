'use strict';

var lastDatabaseDbName = '';

/**
 * Performs a duplicate check for unique fields
 */
function mUTransportUniqueCheck(elem, excludeId) {
    var objectType, fieldName, fieldValue, result, params;

    objectType = elem.attr('id').split('_')[1];
    fieldName = elem.attr('id').split('_')[2];
    fieldValue = elem.val();
    if (fieldValue == window['last' + mUTransportCapitaliseFirstLetter(objectType) + mUTransportCapitaliseFirstLetter(fieldName)]) {
        return true;
    }

    window['last' + mUTransportCapitaliseFirstLetter(objectType) + mUTransportCapitaliseFirstLetter(fieldName)] = fieldValue;

    result = true;
    params = {
        ot: encodeURIComponent(objectType),
        fn: encodeURIComponent(fieldName),
        v: encodeURIComponent(fieldValue),
        ex: excludeId
    };

    jQuery.ajax({
        url: Routing.generate('mutransportmodule_ajax_checkforduplicate'),
        method: 'GET',
        dataType: 'json',
        async: false,
        data: params,
        success: function (data) {
            if (null == data || true === data.isDuplicate) {
                result = false;
            }
        }
    });

    return result;
}

function mUTransportValidateNoSpace(val) {
    var valStr;
    valStr = new String(val);

    return (valStr.indexOf(' ') === -1);
}

/**
 * Runs special validation rules.
 */
function mUTransportExecuteCustomValidationConstraints(objectType, currentEntityId) {
    jQuery('.validate-unique').each(function () {
        if (!mUTransportUniqueCheck(jQuery(this), currentEntityId)) {
            document.getElementById(jQuery(this).attr('id')).setCustomValidity(Translator.__('This value is already assigned, but must be unique. Please change it.'));
        } else {
            document.getElementById(jQuery(this).attr('id')).setCustomValidity('');
        }
    });
}
