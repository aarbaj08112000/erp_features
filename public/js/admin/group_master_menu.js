var table = '';
var file_name = "process";
var pdf_title = "Process";

$(document).ready(function() {
	// alert("ok");
    $('#updateGroupMenuRight').validate({
        rules: {
            namess: {
                // required: true
            }
        },
        messages: {
            namess: {
                // required: "Please enter the process name."
            }
        },
        submitHandler: function(form) {
            // Submit the form via AJAX
            $.ajax({
                url: base_url+"GlobalConfigController/updateGroupMenuRight", // Use the form's action attribute as the URL
                type: 'POST',
                data: new FormData(form), // Send the form data
                processData: false,
                contentType: false,
                success: function(response) {
                    // Parse the JSON response
                    let res = JSON.parse(response);
                    if(res.success == 1){
                        // Show success message
                        toastr.success(res.message);
                        setTimeout(() => {
                            window.location.href = base_url+"/group_master";
                            // window.location.reload();
                        }, 1000);
                    } else {
                        // Show error message
                        toastr.error(res.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle the error
                    toastr.error('An error occurred: ' + errorThrown);
                }
            });
            return false; // Prevent the default form submission
        }
    });

    $(".expand-icon").on("click",function(){
        $(this).parents(".menu-form-row .sub-menu-block").find(".form-right-div").slideToggle();
        $(this).toggleClass("active");
    })
    $(".expand-category-icon").on("click",function(){
        $(this).parents(".menu-form-row").find(".category-wise-menu").slideToggle();
        $(this).toggleClass("active");
    })

    $(".common-check-category-box").on("change",function(){
        if(this.checked) {
            $(this).parents(".menu-form-row").find("[type='checkbox']").prop("checked", true);
        }else{
            $(this).parents(".menu-form-row").find("[type='checkbox']").prop("checked", false);
        }
        
    })
    $(".common-check-box").on("change",function(){
        if(this.checked) {
            $(this).parents(".sub-menu-block ").find("[type='checkbox']").prop("checked", true);
        }else{
            $(this).parents(".sub-menu-block").find("[type='checkbox']").prop("checked", false);
        }
        
    })
    $(".category-row-block ").each(function(){
        var flag = true;
        $(this).find(".common-check-box").each(function(){
            if(!$(this).prop("checked")){
                flag = false;
            }
            console.log($(this).prop("checked"))
        })

        if(flag){
            $(this).find(".common-check-category-box").prop("checked",true);
        }
        
    })
    $(".main-item-check-box").on("change",function(){
        var flag = true;
            $(this).parents(".sub-menu-block").find(".main-item-check-box").each(function(){
                if(!$(this).prop("checked")){
                    flag = false;
                }
            })

        $(this).parents(".sub-menu-block").find(".common-check-box").prop("checked",flag);   
    })
    $(".common-check-box").on("change",function(){
        var flag = true;
            $(this).parents(".category-row-block").find(".common-check-box").each(function(){
                if(!$(this).prop("checked")){
                    flag = false;
                }
            })

        $(this).parents(".category-row-block").find(".common-check-category-box").prop("checked",flag);   
    })
    // Custom search filter event
  
   



});
