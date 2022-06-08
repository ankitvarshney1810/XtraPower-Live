var master;
const allowedExtensions = ['jpg', 'jpeg', 'pdf'];
const formNumberRegEx = new RegExp("^[a-zA-Z0-9-_/]+$");

$(document).ready(function(){
    console.log("inside doucment ready function");
    $.getJSON(webUrl+'assets/master-data.json', function( data ) {
        master = data;
        $.each(data, function(key, val) {
            console.log(key);
        });
        category_list();
        constitution_list();

    });
    $('#customFile').attr('accept', '.' + allowedExtensions.toString().replace(/,/g, ', .'));
});

const today = function() {
    var currdate = new Date();
    var dd = String(currdate.getDate()).padStart(2, '0');
    var mm = String(currdate.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = currdate.getFullYear();

    return yyyy + '-' + mm + '-' + dd;
};

const month_minus = function(count) {
    var currdate = new Date();
    currdate.setMonth(currdate.getMonth() - count);
    var dd = String(currdate.getDate()).padStart(2, '0');
    var mm = String(currdate.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = currdate.getFullYear();

    return yyyy + '-' + mm + '-' + dd;
};

$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

//category
var category_list = function (){
    $('#category').find('.radio').remove();
    $.each(master.category, function(key, value) {
        if(value.status == 1)
            $('#category').append('<div class="radio"><label><input type="radio" name="categoryradio" value="'+value.Name+'"> '+value.Name+'</label></div>');
    });
};

//customerTypes
//locationTypeMapping
//SO
//constitutionTypes
var constitution_list = function (){
console.log("inside constitution list data ");
    $.each(master.constitutionTypes, function(key, value) {
        if(value.groupId == 16)
            $('#constitution').append('<option value="'+value.itemId+'">'+value.itemName+'</option>');
    });
};  

//masterData
$('#category').on('click', 'input[type=radio][name=categoryradio]', function() {
    var category = $(this).val();
    // show customer types
    $('#customerTypes').css('display', 'block');
    $('#customerTypes').find('.radio').remove();
    var customerTypes = master.customerTypes.filter(c => c.status == 1 && c.category == category);
    $.each(customerTypes, function(key, value) {
        $('#customerTypes').append('<div class="radio"><label><input type="radio" name="customerTypesradio" value="'+value.customerTypeId+'" data-src="'+value.customerType+'"> '+value.customerType+'</label></div>');
    });
});

$('#openCustomerForm1').on('click', function() {
    console.log($('input[type=radio][name=customerTypesradio]:checked').val());
    if($('input[type=radio][name=customerTypesradio]:checked').val() == undefined) {
        alert('Choose customer type...');
        return false;
    }

    $('#customerForm1').css('display', 'block');
    $('#customerForm1').find('#SO').find('option').not(':first').remove();

    $.each(master.SO, function(key, value) {
        if(value.status == 1)
            $('#SO').append('<option value="'+value.id+'">'+value.name+'</option>');
    });
    var category = $('input[type=radio][name=categoryradio]:checked').val();
    var subCategory = $('input[type=radio][name=customerTypesradio]:checked').attr('data-src');
    console.log(category + ' ' + subCategory);
    $('#form-category').val(category);
    $('#form-sub-category').val(subCategory);

    $('#form-date').val(today);
    $('#form-date').attr('max', today);
    $('#form-date').attr('min', month_minus(3));
});

$('#customerForm1').on('change', '#SO', function() {
    console.log($(this).val());
    var so = $(this).val();
    $('#customerForm1').find('#DO, #HUB').val('-1');
    $('#customerForm1').find('#DO').find('option').not(':first').remove();
    $('#customerForm1').find('#HUB').find('option').not(':first').remove();
    if(so == -1) 
        return false;
    
    var doLocationTypeId = master.locationTypeMapping.filter(l => l.name == 'DO');
    // console.log(so + ' & ' + doLocationTypeId[0].locationTypeId); 
    var doList = master.masterData.filter(m => m.parentLocationId == so && m.locationTypeId == doLocationTypeId[0].locationTypeId);
    // console.log(doList.length);
    $.each(doList, function(key, value) {
        $('#DO').append('<option value="'+value.locationId+'">'+value.locationName+'</option>');
    });

    var hubLocationTypeId = master.locationTypeMapping.filter(l => l.name == 'HUB');
    // console.log(so + ' & ' + hubLocationTypeId[0].locationTypeId);
    var hubList = master.masterData.filter(m => m.parentLocationId == so && m.locationTypeId == hubLocationTypeId[0].locationTypeId);
    // console.log(hubList.length);
    $.each(hubList, function(key, value) {
        $('#HUB').append('<option value="'+value.locationId+'">'+value.locationName+'</option>');
    });
});

$('#form-number').keypress(function (e) {
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (formNumberRegEx.test(str)) {
        return true;
    } else {
        e.preventDefault();
        invalid_field('form-number');
        return false;
    }
});

$('#customerForm1Submit').on('click', function() {
    $('#SO, #DO, #HUB, #form-category, #form-sub-category, #form-date, #form-number, #customFile').removeClass('is-invalid');

    var so = $('#SO').val();
    var do1 = $('#DO').val();
    var hub = $('#HUB').val();
    var category = $('#form-category').val();
    var subCategory = $('#form-sub-category').val();
    var formDate = $('#form-date').val();
    var formNumber = $('#form-number').val();
    var customFile = $('#customFile');

    if(so == -1) {
        invalid_field('SO');    return false;
    } else if(do1 == -1) {
        invalid_field('DO');    return false;
    } else if(hub == -1) {
        invalid_field('HUB');    return false;
    } 
    if(formDate == '') {
        invalid_field('form-date');    return false;
    } else {
        var form_date = new Date(formDate);
        if(form_date > new Date() || form_date < new Date(month_minus(3))) {
            invalid_field('form-date');    return false;
        }
    } 
    if(formNumber == '' || !formNumberRegEx.test(formNumber)) {
        invalid_field('form-number');    return false;
    } else if(customFile.val() == '' || file_validation(customFile) === false) {
        invalid_field('customFile');    return false;
    }
    
    console.log(so+' ' + do1 + ' ' + hub + ' ' + category + ' ' + subCategory + ' ' + formDate + ' ' + formNumber + ' ' + customFile);

    // form number validation


});

var invalid_field = function(id) {
    $('#'+id).addClass('is-invalid');
    $('#'+id).trigger('focus');
}

var file_validation = function(element) {
    var res_field = $(element).val();   
    var extension = res_field.substr(res_field.lastIndexOf('.') + 1).toLowerCase();
    if (res_field.length > 0) {
        if (allowedExtensions.indexOf(extension) === -1) {
            return false;
        }
    }
    return true;
}



