var master;
var mobileNumber;
var formNumber;
var divClasses = [];
var opendivId = 's1';
const timerInSecs = 30;

const allowedExtensions = ['.jpg', '.jpeg', '.pdf'];
const formNumberRegEx = new RegExp("^[a-zA-Z0-9-_]+$");
const mobileRegEx = /^[6-9]{1}[0-9]{9}$/;
const emailRegEx = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;
const otpRegEx = /^[0-9]{4}$/;
const panRegEx = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
const gstRegEx = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;

const divTitle = {
    '#s1': 'Mobile Verification',
    '#s2': 'Customer Details',
    '#s3': 'Customer Card Details',
    '#s4': 'Customer Address',
    '#s5': 'Key Official Contact Details',
    '#s6': 'Application Form',
    '#s7': 'Card Creation',
    '#s8': 'Status'
};

$(document).ready(function(){
    $.getJSON(webUrl+'assets/master-data.json', function(data) {
        master = data;
        constitution_list();
    });
    $('#panNumberImg, #gstNumberImg').attr('accept', allowedExtensions.toString());
});

$('.getOTP').on('click', function(){
    var mobile = $('#mobile_no').val().trim();
    if(mobile == '' || mobileRegEx.test(mobile) === false) {
        $('#otpMessage1').css('display', 'block');
        $('#otpMessage1').find('.alert-msg').html('Please enter valid mobile number!');
        return false;
    } 
    mobileNumber = mobile;

    $.ajax({
        type: "POST",
        data: { action: 'send-otp', mobile: mobile },
        url: 'api-contoller.php',
        success: function(data){
            if(data == 'success') {
                $('#mobileDiv, #mobileButton, #otpMessage1').css('display', 'none');
                $('#otpMessage, #verifyOtp, #verifyOtpBtn').css('display', 'block');
                timer(timerInSecs);
            } else {
                $('#otpMessage1').css('display', 'block');
                $('#otpMessage1').find('.alert-msg').html('Failed to send otp. Reason: ' + data);
                return false;
            }
        }, 
        error: function() {
            $('#otpMessage1').css('display', 'block');
            $('#otpMessage1').find('.alert-msg').html('some problem occured in sending otp, Please try again after some time!');
            return false;
        }
    });
});

$('.verifyOTP').on('click', function(){
    var mobile = $('#mobile_no').val().trim();
    var otp = $('#otp').val().trim();
    
    if(otp == '' || otpRegEx.test(otp) === false) {
        $('#otpMessage').find('.alert-msg').find('span').html('Please enter valid otp!');
        return false;
    } 
    
    $.ajax({
        type: "POST",
        data: { action: 'verify-otp', mobile: mobile, otp: otp },
        url: 'api-contoller.php',
        success: function(data){
            if(data == 'success') {
                mobileNumber = mobile;
                // check if user is already exist in table
                $.ajax({
                    type: "POST",
                    data: { action: 'enroll-now-information', mobile: mobile},
                    url: 'api-contoller.php',
                    async: false,
                    success: function(data) {
                        console.log(data);
                        var obj = JSON.parse(data);
                        if(obj.status === 'success') {
                            var isOpen = false;
                            // customer_details
                            if(isEmptyObject(obj.customer_details) === false) {
                                $('#s2').removeClass('open').addClass('completed');

                                formNumber = obj.customer_details.form_number;
                                
                                $('#formnumber').val(obj.customer_details.form_number);
                                $('#appdate1').val(obj.customer_details.application_date);
                                $('input[type=radio][name=card][value="'+obj.customer_details.customer_requirement+'"]').attr('checked', 'checked');
                            } else {
                                $('#s2').addClass('open');
                                $('.wizard').find('.title').html(divTitle['#s2']);
                                isOpen = true;
                            }
                            // customer_card_details
                            if(isEmptyObject(obj.customer_card_details) === false) {
                                $('#s3').removeClass('open').addClass('completed');

                                $('#entityName').val(obj.customer_card_details.entity_name);
                                $('#nameOnCard').val(obj.customer_card_details.name_on_card);
                                $('#constitution').val(obj.customer_card_details.constitution);
                                $('#panNumber').val(obj.customer_card_details.pan_number);
                                $('#gstNumber').val(obj.customer_card_details.gst_number);
                                $('#panNumberAnchor, #gstNumberAnchor').css('display', 'block');
                                $('#panNumberAnchor').find('a').attr('href', webUrl + obj.customer_card_details.pan_file);
                                $('#gstNumberAnchor').find('a').attr('href', webUrl + obj.customer_card_details.gst_file);
                            } else {
                                if(isOpen === false){
                                    $('#s3').addClass('open');
                                    $('.wizard').find('.title').html(divTitle['#s3']);
                                    isOpen = true;
                                }
                            }
                            // customer_address
                            if(isEmptyObject(obj.customer_address) === false){
                                $('#s4').removeClass('open').addClass('completed');

                                $('#permanent_pincode').val(obj.customer_address.permanent.pincode);
                                $('#permanent_location').val(obj.customer_address.permanent.location);
                                $('#permanent_add').val(obj.customer_address.permanent.address);
                                $('#permanent_city').val(obj.customer_address.permanent.city);
                                $('#permanent_district').val(obj.customer_address.permanent.district);
                                $('#permanent_state').val(obj.customer_address.permanent.state);
                                
                                $('#comm_pincode').val(obj.customer_address.communication.pincode);
                                $('#comm_location').val(obj.customer_address.communication.location);
                                $('#comm_add').val(obj.customer_address.communication.address);
                                $('#comm_city').val(obj.customer_address.communication.city);
                                $('#comm_district').val(obj.customer_address.communication.district);
                                $('#comm_state').val(obj.customer_address.communication.state);
                            } else {
                                if(isOpen === false){
                                    $('#s4').addClass('open');
                                    $('.wizard').find('.title').html(divTitle['#s4']);
                                    isOpen = true;
                                }
                            }
                            // key_official_contact_details
                            if(isEmptyObject(obj.key_official_contact_details) === false){
                                $('#s5').removeClass('open').addClass('completed');

                                $('#title').val(obj.key_official_contact_details.title);
                                $('#name').val(obj.key_official_contact_details.name);
                                $('#mobile').val(obj.key_official_contact_details.mobile);
                                $('#email_add').val(obj.key_official_contact_details.email_add);
                                $('#fleet_size').val(obj.key_official_contact_details.fleet_size);
                                $('#area').val(obj.key_official_contact_details.area);
                                $('#nominee').val(obj.key_official_contact_details.nominee);
                            } else {
                                if(isOpen === false){
                                    $('#s5').addClass('open');
                                    $('.wizard').find('.title').html(divTitle['#s5']);
                                    isOpen = true;
                                }
                            }

                            if(isEmptyObject(obj.application_form) === false){
                                $('#s6').removeClass('open').addClass('completed');
                                $('#signedApplicationForm1').val(obj.application_form.application_form);
                                $('#isUploadDone').val('1');
                            } else {
                                if(isOpen === false){
                                    $('#s6').addClass('open');
                                    $('.wizard').find('.title').html(divTitle['#s6']);
                                    isOpen = true;
                                }
                            }

                            // card_creation
                            if(isEmptyObject(obj.card_creation) === false){
                                $('#s7').removeClass('open').addClass('completed');

                                $('#no_card').val(obj.card_creation.cards);
                                
                                var i = 0;
                                $.each(obj.card_creation.card_details, function(key, value) {
                                    var element = card_details_div().replace('{COUNT}', i+1);
                                    element = element.replace('{vehicle_number}', obj.card_creation.card_details[i].vehicle_number)
                                        .replace('{vehicle_make}', obj.card_creation.card_details[i].vehicle_make)
                                        .replace('{vehicle_type}', obj.card_creation.card_details[i].vehicle_type)
                                        .replace('{year_of_reg}', obj.card_creation.card_details[i].year_of_reg)
                                        .replace('{vehicle_rc_url}', webUrl + obj.card_creation.card_details[i].rc_doc)
                                        .replace('{url_style}', 'block');
                                    
                                    $('.card-details').append(element);
                                    i++;
                                });
                            } else {
                                if(isOpen === false){
                                    $('#s7').addClass('open');
                                    $('.wizard').find('.title').html(divTitle['#s7']);
                                    isOpen = true;
                                }
                            }
                        }
                        else {
                            // generate application form number
                            $.ajax({
                                type: "POST",
                                data: { action: 'generate-form-number' },
                                url: 'api-contoller.php',
                                async: false,
                                success: function(data) {
                                    $('#formnumber').val(data);
                                }, 
                                error: function() {
                                    alert('Some network issue occured, please retry after some!');
                                }
                            });
                            $('#appdate1').val(today);
                            $('#s2').addClass('open');
                            $('.wizard').find('.title').html(divTitle['#s2']);
                        }
                        $('#s1').removeClass('open').addClass('completed');
                        $('#otpMessage').find('.alert-msg').find('span').html('Otp verified successfully!');
                    }, 
                    error: function() {
                        alert('Some network issue occured, please retry after some!');
                    }
                });
                opendivId = $('.open').attr('id');
                console.log(opendivId);
                if(opendivId != 's1' && opendivId != 's2') {
                    $('#next').prop('disabled', true);
                    $('#previous').prop('disabled', false);
                }
            } else {
                $('#otpMessage').find('.alert-msg').find('span').html('Failed to verify otp. Reason: ' + data);
                return false;
            }
        }, 
        error: function() {
            $('#otpMessage').find('.alert-msg').find('span').html('some problem occured in sending otp, Please try again after some time!');
            return false;
        }
    });
});

const today = function() {
    var currdate = new Date();
    var dd = String(currdate.getDate()).padStart(2, '0');
    var mm = String(currdate.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = currdate.getFullYear();

    return yyyy + '-' + mm + '-' + dd;
};

//customer details with formid and appp date

$('#form2submit').on('click', function(){
    var formnumber = $('#formnumber').val().trim();
    var appdate1 = $('#appdate1').val().trim();
    //var requirementCard=$('#cardid').val();
    var requirementCard = $('input[type=radio][name=card]:checked').val();
    console.log('mobile:'+mobileNumber + ', formnumber:'+formnumber+', appdate1:'+appdate1+', requirementCard:'+requirementCard);
    
    if(formnumber == '' || !formNumberRegEx.test(formnumber)) {
        $('#customerMessage').find('.alert-msg').html('Form Number is not Valid!');
        return false;
    } else if(appdate1 == '') {
        $('#customerMessage').find('.alert-msg').html('Please choose Application date!');
        return false;
    } else if(requirementCard == undefined) {
        $('#customerMessage').find('.alert-msg').html('Please choose one option in requirement!');
        return false;
    }
    formNumber = formnumber;

    $.ajax({
        type: "POST",
        data: { 
            action: 'submit-customer-details',
            mobile: mobileNumber,
            formnumber: formnumber, 
            appdate: appdate1, 
            requirementCard: requirementCard 
        },
        url: 'api-contoller.php',
        success: function(data){
            console.log("value of data is : "+data);
            if(data == 'success') {
                $('#customerMessage').find('.alert-msg').html('Customer details saved successfully!');
                $('#s2').removeClass('open').addClass('completed');
                $('#s3').addClass('open');
                $('.wizard').find('.title').html(divTitle['#s3']);
                opendivId = $('.open').attr('id');
                
                $('#previous').prop('disabled', false);
            } else {
                $('#customerMessage').find('.alert-msg').html('Failed to save data. Please try again');
                return false;
            }
        }, 
        error: function() {
            $('#customerMessage').find('.alert-msg').html('some problem occured in saving customer details, Please try again after some time!');
            return false;
        }
    });
});

//customer card details with all value
$('#customerCardSubmit').on('click', function() {

    var entityName = $('#entityName').val();
    var nameOnCard = $('#nameOnCard').val();
    var constitution = $('#constitution').val();
    var panNumber = $('#panNumber').val().toUpperCase();
    var gstNumber = $('#gstNumber').val().toUpperCase();
    var panNumberImg = $('#panNumberImg').val() != '' ? $('#panNumberImg').val() : $('#panNumberAnchor').find('a').attr('href').replace(webUrl, '');
    var gstNumberImg = $('#gstNumberImg').val() != '' ? $('#gstNumberImg').val() : $('#gstNumberAnchor').find('a').attr('href').replace(webUrl, '');

    console.log('entityName:'+entityName+', nameOnCard:'+nameOnCard+', constitution:'+constitution+', panNumber:'+panNumber+', gstNumber:'+gstNumber+', panNumberImg:'+panNumberImg+', gstNumberImg:'+gstNumberImg);
    
    if(entityName == '') {
        $('#customerCardMessage').find('.alert-msg').html('Please enter Entity Name!');
        return false;
    } else if(nameOnCard == '') {
        $('#customerCardMessage').find('.alert-msg').html('Please enter Name on Card!');
        return false;
    } else if(constitution == -1) {
        $('#customerCardMessage').find('.alert-msg').html('Please Choose consitution value!');
        return false;
    } else if(panNumber == '' || panRegEx.test(panNumber) === false) {
        $('#customerCardMessage').find('.alert-msg').html('Please Enter Valid PAN Number!');
        return false;
    } else if(gstNumber == '' || gstRegEx.test(gstNumber) === false) {
        $('#customerCardMessage').find('.alert-msg').html('Please Enter Valid GST Number!');
        return false;
    }
    if(panNumberImg == '') {
        $('#customerCardMessage').find('.alert-msg').html('PAN Doc is missing!');
        return false;
    } else {
        var panExt = panNumberImg.split('.').pop().toLowerCase();
        if($.inArray(panExt, allowedExtensions) == -1) {
            $('#customerCardMessage').find('.alert-msg').html('Only '+allowedExtensions.toString()+' files allowed in PAN!');
        }
    }
    if(gstNumberImg == '') {
        $('#customerCardMessage').find('.alert-msg').html('GST Doc is missing!');
        return false;
    } else {
        var gstExt = gstNumberImg.split('.').pop().toLowerCase();
        if($.inArray(gstExt, allowedExtensions) == -1) {
            $('#customerCardMessage').find('.alert-msg').html('Only '+allowedExtensions.toString()+' files allowed in GST!');
        }
    }

    var dataParams = new FormData();
    dataParams.append('action', 'customer-card-details');
    dataParams.append('mobile', mobileNumber);
    dataParams.append('formNumber', formNumber);
    dataParams.append('entityName', entityName);
    dataParams.append('nameOnCard', nameOnCard);
    dataParams.append('constitution', constitution);
    dataParams.append('panNumber', panNumber);
    dataParams.append('gstNumber', gstNumber);
    if($('#panNumberAnchor').find('a').attr('href') != '')
        dataParams.append('panNumberImgUrl', $('#panNumberAnchor').find('a').attr('href').replace(webUrl, ''));
    else
        dataParams.append('panNumberImg', $('#panNumberImg')[0].files[0]);

    if($('#gstNumberAnchor').find('a').attr('href') != '')
        dataParams.append('gstNumberImgUrl', $('#gstNumberAnchor').find('a').attr('href').replace(webUrl, ''));
    else
        dataParams.append('gstNumberImg', $('#gstNumberImg')[0].files[0]);

    // customer card details
    $.ajax({
        type: 'POST',
        url: 'api-contoller.php',
        data: dataParams,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log("value of data is : "+data);
            if(data == 'success') {
                $('#customerCardMessage').find('.alert-msg').html('Information saved successfully!');
                $('#s3').removeClass('open').addClass('completed');
                $('#s4').addClass('open');
                $('.wizard').find('.title').html(divTitle['#s4']);
                opendivId = $('.open').attr('id');
                $('#previous').prop('disabled', false);
            } else {
                $('#customerCardMessage').find('.alert-msg').html('Failed to save customer card detials. Reason: ' + data);
                return false;
            }
        },
        error: function (jqXHR, exception) {
            $('#customerCardMessage').find('.alert-msg').html('Error in connecting to server. Please check your internet or wait for sometime...');
        },
        beforeSend: function (xhr) {
            $('#customerCardMessage').find('.alert-msg').html('');
        }
    });
});

//customer address submit

$('#customerAddresSubmit').on('click', function(){
    var permanent_pincode = $('#permanent_pincode').val().trim();
    var permanent_location = $('#permanent_location').val().trim();
    var permanent_add = $('#permanent_add').val().trim();
    var permanent_city = $('#permanent_city').val().trim();
    var permanent_district = $('#permanent_district').val().trim();
    var permanent_state = $('#permanent_state').val().trim();

    var comm_pincode = $('#comm_pincode').val().trim();
    var comm_location = $('#comm_location').val().trim();
    var comm_add = $('#comm_add').val().trim();
    var comm_city = $('#comm_city').val().trim();
    var comm_district = $('#comm_district').val().trim();
    var comm_state = $('#comm_state').val().trim();

    if(permanent_pincode == '' || isNaN(permanent_pincode)) {
        $('#customerAddressMessage').find('.alert-msg').html('Pincode is missing or not valid in Permanent Address!');
        return false;
    } else if(permanent_location == '') {
        $('#customerAddressMessage').find('.alert-msg').html('Location is missing in Permanent Address!');
        return false;
    } else if(permanent_add == '') {
        $('#customerAddressMessage').find('.alert-msg').html('Address is missing in Permanent Address!');
        return false;
    } else if(permanent_city == '') {
        $('#customerAddressMessage').find('.alert-msg').html('City is missing in Permanent Address!');
        return false;
    } else if(permanent_district == '') {
        $('#customerAddressMessage').find('.alert-msg').html('Distict is missing in Permanent Address!');
        return false;
    } else if(permanent_state == '') {
        $('#customerAddressMessage').find('.alert-msg').html('State is missing in Permanent Address!');
        return false;
    } if(comm_pincode == '' || isNaN(comm_pincode)) {
        $('#customerAddressMessage').find('.alert-msg').html('Pincode is missing or not valid in Communication Address!');
        return false;
    } else if(comm_location == '') {
        $('#customerAddressMessage').find('.alert-msg').html('Location is missing in Communication Address!');
        return false;
    } else if(comm_add == '') {
        $('#customerAddressMessage').find('.alert-msg').html('Address is missing in Communication Address!');
        return false;
    } else if(comm_city == '') {
        $('#customerAddressMessage').find('.alert-msg').html('City is missing in Communication Address!');
        return false;
    } else if(comm_district == '') {
        $('#customerAddressMessage').find('.alert-msg').html('Distict is missing in Communication Address!');
        return false;
    } else if(comm_state == '') {
        $('#customerAddressMessage').find('.alert-msg').html('State is missing in Communication Address!');
        return false;
    }

    $.ajax({
        type: "POST",
        data: { 
            action: 'customer-address',
            mobile: mobileNumber,
            formNumber: formNumber,

            permanent_pincode: permanent_pincode, 
            permanent_location: permanent_location,
            permanent_add: permanent_add,
            permanent_city: permanent_city, 
            permanent_district: permanent_district, 
            permanent_state: permanent_state,

            comm_pincode: comm_pincode, 
            comm_location: comm_location,
            comm_add: comm_add,
            comm_city: comm_city, 
            comm_district: comm_district, 
            comm_state: comm_state
        },
        url: 'api-contoller.php',
        success: function(data){
            console.log("value of data is : "+data);
            if(data == 'success') {
                $('#customerAddressMessage').find('.alert-msg').html('Otp verified successfully!');
                $('#s4').removeClass('open').addClass('completed');
                $('#s5').addClass('open');
                $('.wizard').find('.title').html(divTitle['#s5']);
                opendivId = $('.open').attr('id');
                $('#previous').prop('disabled', false);
            } else {
                $('#customerAddressMessage').find('.alert-msg').html('Failed to save address details. Reason: ' + data);
                return false;
            }
        }, 
        error: function() {
            $('#customerAddressMessage').find('.alert-msg').html('some problem occured in saving address, Please try again after some time!');
            return false;
        }
    });
});

// add communication address as permenent adddress
$('#chkSameAdd').on('click', function(){
    if($(this).prop("checked") == true){
        $('#comm_pincode').val($('#permanent_pincode').val());
        $('#comm_location').val($('#permanent_location').val());
        $('#comm_add').val($('#permanent_add').val());
        $('#comm_city').val($('#permanent_city').val());
        $('#comm_district').val($('#permanent_district').val());
        $('#comm_state').val($('#permanent_state').val());
    }else{
        $('#comm_pincode, #comm_location, #comm_add, #comm_city, #comm_district, #comm_state').val('');
    }
});

//find full state,city,district by pincode

$("#permanent_pincode, #comm_pincode").on("input", function(event) {
    var id = $(this).attr('id');
    var pincode = $('#'+id).val().trim();
    if(pincode.length == 6){
        console.log("inside pincode function");
        $.ajax({
            type: "GET",
            url: 'https://api.postalpincode.in/pincode/' + pincode,
            success: function(data){
                console.log(data[0]);
                if(data[0].Status == 'Success' && data[0].PostOffice.length > 0) {
                    console.log("value of data is : "+data.status);
                    var PostOffice = (data[0].PostOffice)[0];
                    console.log(PostOffice);
                    $(id == 'permanent_pincode' ? '#permanent_city' : '#comm_city').val(PostOffice.Division);
                    $(id == 'permanent_pincode' ? '#permanent_district' : '#comm_district').val(PostOffice.District);
                    $(id == 'permanent_pincode' ? '#permanent_state' : '#comm_state').val(PostOffice.State);
                } else {
                    $('#customerAddressMessage').find('.alert-msg').html('Failed to fetch location details. Reason: ' + data);
                    return false;
                }
            }, 
            error: function() {
                $('#customerAddressMessage').find('.alert-msg').html('some problem occured in getting server details, Please try again after some time!');
                return false;
            }
        });
    }
});


//customer contact details with id s5
$('#customerContactDetials').on('click', function(){

    var title = $('#title').val();
    var name = $('#name').val().trim();
    var mobile = $('#mobile').val().trim();
    var email_add = $('#email_add').val().trim();
    var fleet_size = $('#fleet_size').val().trim();
    var area = $('#area').val().trim();
    var nominee = $('#nominee').val();

    if(title == '-1') {
        $('#customerContactMessage').find('.alert-msg').html('Choose Salutation ');
        return false;
    } else if(name == '') {
        $('#customerContactMessage').find('.alert-msg').html('Please enter your full name!');
        return false;
    } else if(mobile == '' || mobileRegEx.test(mobile) === false) {
        $('#customerContactMessage').find('.alert-msg').html('Please enter valid mobile number!');
        return false;
    } else if(email_add == '' || emailRegEx.test(email_add) === false) {
        $('#customerContactMessage').find('.alert-msg').html('Please enter valid email address!');
        return false;
    } else if(fleet_size == '' || parseInt(fleet_size) == 0) {
        $('#customerContactMessage').find('.alert-msg').html('Please enter valid fleet size!');
        return false;
    } else if(area == '') {
        $('#customerContactMessage').find('.alert-msg').html('Please enter your area!');
        return false;
    } else if(nominee == '') {
        $('#customerContactMessage').find('.alert-msg').html('Please enter your Nominee Name!');
        return false;
    } 

    $.ajax({
        type: "POST",
        data: { 
            action: 'customer-contact-details',
            mobile: mobileNumber,
            formNumber: formNumber,

            title: title, 
            name: name,
            mobile1: mobile,
            email_add: email_add, 
            fleet_size: fleet_size, 
            area: area, 
            nominee: nominee
        },
        url: 'api-contoller.php',
        success: function(data){
            console.log("value of data is : "+data);
            if(data == 'success') {
                $('#customerContactMessage').find('.alert-msg').html('Contact details saved successfully!');
                $('#s5').removeClass('open').addClass('completed');
                $('#s6').addClass('open');
                $('.wizard').find('.title').html(divTitle['#s6']);
                opendivId = $('.open').attr('id');
                $('#previous').prop('disabled', false);
            } else {
                $('#customerContactMessage').find('.alert-msg').html('Failed to save contact details. Reason: ' + data);
                return false;
            }
        }, 
        error: function() {
            $('#customerContactMessage').find('.alert-msg').html('some problem occured in saving addres details, Please try again after some time!');
            return false;
        }
    });
});


var constitution_list = function (){
    $.each(master.constitutionTypes, function(key, value) {
        $('#constitution').append('<option value="'+value.itemId+'">'+value.itemName+'</option>');
    });
};

$('#applicationFormSubmit').on('click', function() {
    if($('#isUploadDone').val() == '1') {
        // call xtrapower apis
        $.ajax({
            type: "POST",
            data: { 
                action: 'xp-apis-call',
                mobile: mobileNumber,
                formNumber: formNumber
            },
            url: 'api-contoller.php',
            success: function(response){
                if(response == 'success') {
                    $('#applicationFormMessage').find('.alert-msg').html('Form submission done successfully!');
                    $('#s6').removeClass('open').addClass('completed');
                    $('#s7').addClass('open');
                    $('.wizard').find('.title').html(divTitle['#s7']);
                    opendivId = $('.open').attr('id');
                    $('#previous').prop('disabled', false);
                    return false;
                } else {
                    $('#applicationFormMessage').find('.alert-msg').html('some problem occured in processing application form, Please try again after some time!');
                    return false;
                }
            }, error: function() {
                $('#applicationFormMessage').find('.alert-msg').html('some problem occured in processing application form, Please try again after some time!');
                return false;
            }, beforeSend: function (xhr) {
                $('#applicationFormMessage').find('.alert-msg').html('');
            }
        });
    } else {
        $('#applicationFormMessage').find('.alert-msg').html('Please upload the signed form before continuing!');
    }
});

$('#no_card').on('input', function(){
    $('.card-details').find('.cards').remove();
    $('#cardSubmitMessage').find('.alert-msg').html('');
    
    var requirementCard = $('input[type=radio][name=card]:checked').val();
    if(requirementCard == 'Fleet') {
        // add card blocks
        var cards = $('#no_card').val();
        if(cards == '' || parseInt(cards) == 0) {
            $('#cardSubmitMessage').find('.alert-msg').html('Please enter number of cards!');
            return false;
        }
        for(var temp = 0; temp < parseInt(cards); temp++) {
            var div = card_details_div().replace('{COUNT}', temp+1);
            div = div.replace('{vehicle_number}', '').replace('{vehicle_make}', '').replace('{vehicle_type}', '').replace('{year_of_reg}', '').replace('{vehicle_rc_url}', '').replace('{url_style}', 'none');
            $('.card-details').append(div);
        }
    }
});

var card_details_div = function() {
    var div =   `<div class="cards">
                    <p class="mb-3">Card {COUNT}</p>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="inputGroup">
                                <label for="vehicle_number">Vehicle Number</label>
                                <input type="text" id="vehicle_number" value="{vehicle_number}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="inputGroup">
                                <label for="vehicle_make">Make</label>
                                <input type="text" id="vehicle_make" value="{vehicle_make}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="inputGroup">
                                <label for="vehicle_type">Vehicle Type</label>
                                <input type="text" id="vehicle_type" value="{vehicle_type}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="inputGroup">
                                <label for="year_of_reg">Year of Registration</label>
                                <input type="text" id="year_of_reg" value="{year_of_reg}">
                            </div>
                        </div>
                        <div class="col-sm-11 col-md-5">
                            <div class="inputGroup">
                                <label for="vehicle_rc">Upload RC(Registration Certificate) Copy</label>
                                <input type="file" id="vehicle_rc">
                            </div>
                        </div>
                        <div class="col-sm-1 col-md-1" style="display:{url_style}" id="rcDocAnchor">
                            <div class="inputGroup">
                                <a href="{vehicle_rc_url}" target="_blank">View</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>`;
    return div;
}

$('#cardSubmit').on('click', function(){
    var cards = $('#no_card').val();
    var requirementCard = $('input[type=radio][name=card]:checked').val();

    console.log(cards + ' ' + requirementCard);
    if(cards == '' || parseInt(cards) == 0) {
        $('#cardSubmitMessage').find('.alert-msg').html('Please enter number of cards!');
        return false;
    }

    if(requirementCard == 'Fleet') {
        var elements = $('.card-details').find('.cards');
        for(var i = 0; i < parseInt(cards); i++) {
            var element = elements[i];
            var vehicle_number = $(element).find('#vehicle_number').val();
            var vehicle_make = $(element).find('#vehicle_make').val();
            var vehicle_type = $(element).find('#vehicle_type').val();
            var year_of_reg = $(element).find('#year_of_reg').val();
            var vehicle_rcImg = $(element).find('#vehicle_rc').val() != '' ? $(element).find('#vehicle_rc').val() : $(element).find('#rcDocAnchor').find('a').attr('href').replace(webUrl, '');
            
            if(vehicle_number == '') {
                $('#cardSubmitMessage').find('.alert-msg').html('Please enter Vehicle number!');
                $(element).find('#vehicle_number').trigger('focus');
                return false;
            } else if(vehicle_make == '') {
                $('#cardSubmitMessage').find('.alert-msg').html('Please enter Vehicle Make!');
                $(element).find('#vehicle_make').trigger('focus');
                return false;
            } else if(vehicle_type == '') {
                $('#cardSubmitMessage').find('.alert-msg').html('Please enter Vehicle Type!');
                $(element).find('#vehicle_type').trigger('focus');
                return false;
            } else if(year_of_reg == '') {
                $('#cardSubmitMessage').find('.alert-msg').html('Please enter Vehicle Year of Registeration!');
                $(element).find('#year_of_reg').trigger('focus');
                return false;
            } else if(vehicle_rcImg == '') {
                $('#cardSubmitMessage').find('.alert-msg').html('Please upload RC document!');
                $(element).find('#year_of_reg').trigger('focus');
                return false;
            } 
            
            var dataParams = new FormData();
            dataParams.append('action', 'card-creation-submit');
            dataParams.append('mobile', mobileNumber);
            dataParams.append('formNumber', formNumber);

            dataParams.append('cards', cards);

            dataParams.append('count', i);
            dataParams.append('vehicle_number', vehicle_number);
            dataParams.append('vehicle_make', vehicle_make);
            dataParams.append('vehicle_type', vehicle_type);
            dataParams.append('year_of_reg', year_of_reg);

            if($('#vehicle_rc').val() != '') {
                dataParams.append('vehicle_rc', $(element).find('#vehicle_rc')[0].files[0]);
            } else {
                dataParams.append('vehicle_rc_url', $(element).find('#rcDocAnchor').find('a').attr('href').replace(webUrl, ''));
            }
            
            
            $.ajax({
                type: 'POST',
                url: 'api-contoller.php',
                data: dataParams,
                contentType: false,
                processData: false,
                async: false,
                success: function (data) {
                    console.log('in ajax ' + data);
                    if(data == 'success') {
                        $('#cardSubmitMessage').find('.alert-msg').html('Card '+(i+1)+' Details saved successfully!');
                        if(i == (parseInt(cards) - 1)) {
                            $('#s7').removeClass('open').addClass('completed');
                            $('#s8').addClass('open');
                            $('.wizard').find('.title').html(divTitle['#s8']);
                            opendivId = $('.open').attr('id');
                            $('#previous').prop('disabled', false);
                        }
                    } else {
                        $('#cardSubmitMessage').find('.alert-msg').html('Failed to save Card '+(i+1)+' details. Reason: ' + data);
                        return false;
                    }
                },
                error: function (jqXHR, exception) {
                    $('#cardSubmitMessage').find('.alert-msg').html('Error in connecting to server. Please check your internet or wait for sometime...');
                },
                beforeSend: function (xhr) {
                    $('#cardSubmitMessage').find('.alert-msg').html('');
                }
            });
        }
    } else {
        $.ajax({
            type: "POST",
            data: { 
                action: 'card-creation-submit',
                mobile: mobileNumber,
                formNumber: formNumber,
                cards: cards,
                isFleetCard: 'No'
            },
            url: 'api-contoller.php',
            success: function(data){
                // var data = JSON.parse(response);
                console.log(data);
                if(data == 'success') {
                    $('#cardSubmitMessage').find('.alert-msg').html('Card Details saved successfully!');
                    $('#s7').removeClass('open').addClass('completed');
                    $('#s8').addClass('open');
                    $('.wizard').find('.title').html(divTitle['#s8']);
                    opendivId = $('.open').attr('id');
                    
                    $('#s8').addClass('submitted');
                    $('#s8').find('.heading').html('Submitted');
                    $('#s8').find('.text').html('Your request has been submitted successfully. Our team will verify the details and update you soon!');
                } else {
                    $('#cardSubmitMessage').find('.alert-msg').html('Failed to save details. Reason: ' + data);
                    return false;
                }
            }, error: function() {
                $('#cardSubmitMessage').find('.alert-msg').html('some problem occured in submitting details, Please try again after some time!');
                return false;
            }, beforeSend: function (xhr) {
                $('#cardSubmitMessage').find('.alert-msg').html('');
            }
        });
    }
});

var isEmptyObject = function(value) {
    return value == null || (Object.keys(value).length === 0 && value.constructor === Object);
}

$('.icon').on('click', function() {
    var div = $(this).closest('[id^="s"]');
    console.log($(div).attr('class'));
    var classes = $(div).attr('class');
    var id = $(div).attr('id');
    if(classes.indexOf('completed') || classes.indexOf('open')) {
        for(var i = 0; i < divClasses.length; i++) {
            if(id == 's'+(i+1)) {
                $('#'+id).removeClass('completed').addClass('open');
                $('.wizard').find('.title').html(divTitle['#'+id]);
            } else {
                $('#s'+(i+1)).removeClass('completed open').addClass(divClasses[i] != 'open' ? divClasses[i] : '');
            }
        }
    }
    console.log(divClasses);
});

$('#previous, #next').on('click', function() {
    console.log($(this).html());
    var currentOpenDivId = $('.open').attr('id');
    console.log(opendivId + ' : ' + currentOpenDivId);
    if($(this).html() == 'Previous')
        var newid = 's' + (parseInt(currentOpenDivId.replace('s', ''))-1);
    else
        var newid = 's' + (parseInt(currentOpenDivId.replace('s', ''))+1);
    $('#'+currentOpenDivId).removeClass('completed open');
    $('#'+newid).addClass('open');
    $('.wizard').find('.title').html(divTitle[newid]);


    if(opendivId == 's1') {
        $('#previous, #next').prop('disabled', true);
    } else if(newid == 's2') {
        $('#next').prop('disabled', false);
        $('#previous').prop('disabled', true);
    } else if(opendivId == newid) {
        $('#next').prop('disabled', true);
        $('#previous').prop('disabled', false);
    } else {
        $('#previous, #next').prop('disabled', false);
    }
});

$('#applicationFormDownload').on('click', function() {
    $.ajax({
        type: "POST",
        data: { 
            action: 'application-form-creation',
            mobile: mobileNumber,
            formnumber: formNumber
        },
        url: 'api-contoller.php',
        success: function(response){
            var data = JSON.parse(response);
            console.log(data);
            if(data.status == 'success') {
                var link = document.createElement('a');
                link.href = data.application_form_url;
                link.download = formNumber+'.pdf';
                link.dispatchEvent(new MouseEvent('click'));

                $('#applicationFormMessage').find('.alert-msg').html('Application form has been generated and downloaded successfully. Please upload the form with your signature on each page in pdf format!');
                return false;
            } else {
                $('#applicationFormMessage').find('.alert-msg').html('some problem occured in downloading application form, Please try again after some time!');
                return false;
            }
        }, error: function() {
            $('#applicationFormMessage').find('.alert-msg').html('some problem occured in downloading application form, Please try again after some time!');
            return false;
        }, beforeSend: function (xhr) {
            $('#applicationFormMessage').find('.alert-msg').html('');
        }
    });
});

$('#applicationFormUpload').on('click', function() {
    if($('#signedApplicationForm').val() == '' && $('#signedApplicationForm1').val() == '') {
        $('#applicationFormMessage').find('.alert-msg').html('Please choose signed application form!');
        return false;
    }
    var dataParams = new FormData();
    dataParams.append('action', 'application-form-upload');
    dataParams.append('mobile', mobileNumber);
    dataParams.append('formNumber', formNumber);
    if($('#signedApplicationForm').val() != '') {
        dataParams.append('signedApplicationForm', $('#signedApplicationForm')[0].files[0]);
    } else {
        dataParams.append('signedApplicationForm1', $('#signedApplicationForm1').val());
    }
    
    // customer card details
    $.ajax({
        type: 'POST',
        url: 'api-contoller.php',
        data: dataParams,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log("value of data is : "+data);
            if(data == 'success') {
                $('#customerCardMessage').find('.alert-msg').html('Information saved successfully!');
                $('#isUploadDone').val('1');
                $('#applicationFormSubmit').prop('disabled', false);
                $('#applicationFormMessage').find('.alert-msg').html('Application Form uploaded successfully. Click Continue to proceed!');
            } else {
                $('#applicationFormMessage').find('.alert-msg').html('Failed to upload Application Form. Reason: ' + data);
                return false;
            }
        },
        error: function (jqXHR, exception) {
            $('#applicationFormMessage').find('.alert-msg').html('Error in connecting to server. Please check your internet or wait for sometime...');
        },
        beforeSend: function (xhr) {
            $('#applicationFormMessage').find('.alert-msg').html('');
        }
    });
});

let timerOn = true;
var timer = function(remaining) {
    $('.btnResend').attr('style', 'display: none !important');
    var m = Math.floor(remaining / 60);
    var s = remaining % 60;
    
    m = m < 10 ? '0' + m : m;
    s = s < 10 ? '0' + s : s;
    
    document.getElementById('timer').innerHTML = m + ':' + s;
    remaining -= 1;
    
    if(remaining >= 0 && timerOn) {
        setTimeout(function() {
            timer(remaining);
        }, 1000);
        return;
    }
    if(!timerOn)
        return;
    
    $('.btnResend').attr('style', 'display: inline-block !important');
}

$('.btnResend').on('click', function() {
    $.ajax({
        type: "POST",
        data: { action: 'send-otp', mobile: mobileNumber },
        url: 'api-contoller.php',
        success: function(data){
            if(data == 'success') {
                $('#mobileDiv, #mobileButton, #otpMessage1').css('display', 'none');
                $('#otpMessage, #verifyOtp, #verifyOtpBtn').css('display', 'block');
                timer(timerInSecs);
            } else {
                $('#otpMessage1').css('display', 'block');
                $('#otpMessage1').find('.alert-msg').html('Failed to send otp. Reason: ' + data);
                return false;
            }
        }, 
        error: function() {
            $('#otpMessage1').css('display', 'block');
            $('#otpMessage1').find('.alert-msg').html('some problem occured in sending otp, Please try again after some time!');
            return false;
        }
    });
});