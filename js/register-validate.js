jQuery(function(){
	jQuery.validator.addMethod("validate_email", function(value, element) {

	    if (/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value)) {
	        return true;
	    } else {
	        return false;
	    }
	}, "Please enter a valid Email.");

	$("#form-register").validate({
        rules:{
            fullName: {
                required: true,
                minlength: 10,
                maxlength: 100
            },
            oldpassword: {
                required: true,
                minlength: 7,
                maxlength: 100
            },
            password: {
                required: true,
                minlength: 7,
                maxlength: 100
            },
            cpassword: {
                required: true,
                minlength: 7,
                maxlength: 100,
                equalTo: "#password"
            },
            email:{
            	required: true,
            	validate_email: true
            },
            phoneNumber:{
            	required: true,
            	digits: true,
            	minlength: 10,
            	maxlength: 11
            }
            
        },
        messages:{
            fullName: {
                required :"Please enter your Name",
                minlength:"Name must be at least 10 characters",
                maxlength:"Name limit 100 characters"
            },
            email:{
            	required:"Please enter your email",
            },
            oldpassword: {
            	required:"Please enter your oldpassword",
            	minlength: "Oldpassword must be at least 7 characters",
            	maxlength: "Oldpassword limit 100 characters"
            },
            password: {
                required :"Please enter your password",
                minlength:"Password must be at least 7 characters",
                maxlength:"Password limit 100 characters"
            },
            cpassword: {
                required :"Please re-enter your password",
                minlength:"Password must be at least 7 characters",
                maxlength:"Password limit 100 characters"
            },
            phoneNumber:{
            	required: "Please enter your phone",
            	digits: "Please enter only digits",
            	minlength: "Length of String has range from 10 digits to 11 digits",
            	maxlength: "Length of String has range from 10 digits to 11 digits"
            }
        }
    });
});