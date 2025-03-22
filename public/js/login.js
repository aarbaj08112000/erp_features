$(document).ready(function($) {

  $("#formAuthentication").validate({
    rules: {
     email: {
       required: true,
       email: true
     },
     password: {
       required: true,
       // minlength: 8,
       // strongPassword: true
     },
     clientUnit:{
       required: true,
     }
   },
   messages: {
     email: {
       required: "Please enter your email",
       email: "Please enter a valid email address"
     },
     password: {
       required: "Please enter your password",
       // minlength: "Your password must be 8 characters",
       // strongPassword: "Your password must be strong (include at least one uppercase letter, one lowercase letter, one digit, and one special character)"
     },
     clientUnit:{
       required: "Please select client unit.",
     }
   },
    errorPlacement: function(error, element)
    {
      console.log(element[0].localName)
      if(element[0].localName == "select"){
        $(element).parents("div").find(".select2-container").append(error);
      }else{
        error.insertAfter( element );
      }
    },
    submitHandler: function(form) {
      var formdata = new FormData(form);
      $.ajax({
        url: "LogonDashboard/signin",
        data:formdata,
        processData:false,
        contentType:false,
        cache:false,
        type:"post",
        success: function(result){
          var data = JSON.parse(result);
          if (data.success == 1) {
              toastr.success(data.messages);
              setTimeout(function () {
                window.location.href = base_url+data.redirect_url;
            }, 2000);
          }else{
            toastr.error(data.messages);
          }

        }
      });
    }

  });

  $.validator.addMethod("strongPassword", function(value, element) {
   return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
 }, "Your password must include at least one uppercase letter, one lowercase letter, one digit, and one special character");
 $("#clientId").select2({
  minimumResultsForSearch: Infinity
 })
});
