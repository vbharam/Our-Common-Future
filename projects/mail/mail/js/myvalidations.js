 $.validator.setDefaults({
    submitHandler: function(form) {
      //form.submit();
      alert('submitted');
    }
  });

$().ready(function() {

  // validate signup form on keyup and submit
  $("#signupForm").validate({
    wrapper: "", debug:true,
    errorPlacement: function(label, elem) {
      label.addClass("control-label");
    elem.parent().parent().append(label);
    },

    highlight: function(element) {
      $(element).parent().parent().parent().addClass("has-error");
    },
    unhighlight: function(element) {
        $(element).parent().parent().parent().removeClass("has-error");
    },
    rules: {
      name: {
        required : true,
      },
      email : {
        required : true,
        email : true,
      },
      phone : {
        required : true,
        number : true,
        minlength : 10,
        maxlength : 10
      },
      designation : {
        required : true,
      },
      password : {
        required : true,
      },
      confirm_password : {
        required : true,
        equalTo: "#password"
      },
      agree : {
        required : true
      }


    },
    messages: {
  
      name: "Please enter your name",
      email : "Please enter a valid Email address",
      phone : "Please enter a valid phone number",
      designation : "Please choose your designation",
      password : "Please enter your password",
      confirm_password : "Your passwords doesn't match",
      agree : "You must accept our terms of use"

    }
  });
  });