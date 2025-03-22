$( document ).ready(function() {
    app.init();
});
var table_data ;
var active_form_ele = '';
if($("body .dashboard-block").length == 0){
$(document).ajaxStart(function(e) {
  if($(e.target.activeElement).parents(".modal").length || $(e.target.activeElement).parents(".filter-popup-block").length == 0 && ($(e.target.activeElement).parents("form").length || $(e.target.activeElement).attr("href") != "")){
    if($(e.target.activeElement).attr("href") != "" && $(e.target.activeElement).attr("href") != undefined && $(e.target.activeElement).attr("href") != null){
        $(e.target.activeElement).addClass("disable-btn")
    }
    
    if(!$(e.target.activeElement.localName).hasClass("serarch-filter-input") || $(e.target.activeElement).parents(".modal").length){
      active_form_ele = e.target.activeElement;
      $(active_form_ele).prop('disabled', true);
      setTimeout(function(){
        $(active_form_ele).prop('disabled', false);
        if($(e.target.activeElement).attr("href") != "" ){
            $(active_form_ele).removeClass("disable-btn")
        }
      },5000)
    }
  }

  if($("body").hasClass("modal-open")){
     setTimeout(function(){
       $(".main-loader-box").show();
       $("body").addClass("loader-show");
      },100)
  }else{
    $(".main-loader-box").show();
       $("body").addClass("loader-show");
  }
});
$(document).ajaxStop(function() {
  if($("body").hasClass("modal-open")){
    setTimeout(function(){
      $(".main-loader-box").hide();
      $("body").removeClass("loader-show");
    },1500)
  }else{
    $(".main-loader-box").hide();
      $("body").removeClass("loader-show");
  }
   
});
var ajaxResponses = [];
$(document).ajaxComplete(function(event, xhr, settings) {
  // console.log(event)
  $(event.target.activeElement).prop('disabled', false); 
  // console.log(event.target.activeElement)
    // Store the response from the request
    ajaxResponses.push(xhr.responseJSON || xhr.responseText);
    var res = xhr.responseJSON || xhr.responseText;

// if(res.indexOf("success") != -1){
  try {
      var response = JSON.parse(xhr.responseJSON || xhr.responseText);
      if(response.success == 0){
          setTimeout(function(){
               $(event.target.activeElement).prop('disabled', false);
          },5000);
      }else{
        $(event.target.activeElement).prop('disabled', false); 
      }
      if($(e.target.activeElement).attr("href") != "" ){
            $(active_form_ele).removeClass("disable-btn")
        }
  } catch (error) {
      // console.error("Error parsing JSON response:", error);
      // responseData = { error: "Invalid JSON response", raw: xhr.responseText };
  }
    
    
// }
    
});
}
const app = {
  init: function(){


      $(document).on("click",'.layout-menu-toggle',function(){
          if($(this).find('i').hasClass("bx-chevron-right")){
              $(this).find('i').removeClass("bx-chevron-right").addClass("bx-chevron-left")
              $('html').addClass("layout-compact").removeClass("layout-menu-collapsed").removeClass("layout-menu-hover")
          }else{
              $('html').removeClass("layout-compact").addClass("layout-menu-collapsed")
              $(this).find('i').removeClass("bx-chevron-left").addClass("bx-chevron-right")
              $(this).addClass("hide")
          }
      })
      $("#layout-menu").on("mouseover",function(){
        if(!$('html').hasClass("layout-compact")){
          $('html').addClass("layout-menu-hover")

        }
          // $(this).find('i').removeClass("bx-chevron-right").addClass("bx-chevron-left")
      })
      $('#layout-menu').on('mouseleave',function(){
        if(!$('html').hasClass("layout-compact")){
            $('html').removeClass("layout-menu-hover")
        }
        
        // $(this).find('i').removeClass("bx-chevron-left").addClass("bx-chevron-right")
      });
      $(".menu-item").on("click",function(){
        
         if(!$(this).hasClass("open-menu")){
            $(this).addClass("open-menu")
         }else{
            $(this).removeClass("open-menu")
         }
         $(this).find('.menu-sub').slideToggle('slow')
      })

      $(".filter-icon,.close-filter-btn").on('click',function(){
        if($(".filter-popup-block").hasClass("show")){
          $(".filter-popup-block").removeClass("show")
          $(".filter-popup-block").animate({
            width: 0
          },100)
        }else{
          let width = 330;
          var viewportWidth = $(window).width();
          if( viewportWidth < 700){
              width = 253;
          }
          $(".filter-popup-block").addClass("show")
          $(".filter-popup-block").animate({
            width: width
          },100)
        }
        
      })
      $(".filter-row .search-show-hide").on("click",function(){
         var element = $(this).parents(".filter-row");
         var cursor_element = $(this).find("i.ti-minus");
         if(cursor_element.length > 0){
          $(this).html("<i class='ti ti-plus'></i>")
         }else{
          $(this).html("<i class='ti ti-minus'></i>")
         }
         $(element).find(".sidebar-item").toggle()
      })
      $("#downloadPDFBtn").on("click",function(){
          $(".buttons-pdf").trigger("click");
      })
      $("#downloadCSVBtn").on("click",function(){
          $(".buttons-csv").trigger("click");
      })
      // $('.select2').select2('disable_search_thresholdy');
      $(".select2-init,.select2").select2();
    //   $(".select2-init, .select2").chosen({
    //     width: "auto",
    //     disable_search_threshold: 0,  // Always show search box, even if options are less than 10
    //     dropdownAutoWidth: true,
    //     search_contains: true
    // });

      $(".breadcrumb .backlisting-link").attr("href","javascript:void(0)");
      $(".breadcrumb .backlisting-link").attr("title","");
      this.allowNumber();
      this.removeValidationMessage();
      this.initResponsive();
      $(".quick-menu-bar").on("click",function(){
        if($(this).hasClass("active")){
          $("#menu_overlay").removeClass("open");
          $(this).removeClass("active");
          $("body").removeClass("loader-show")
        }else{
          $("#menu_overlay").addClass("open");
          $(this).addClass("active");
          $("body").addClass("loader-show")
        }
        
      })
      $('.dropdown-submenu > a').on('click', function (e) {
        if ($(window).width() <= 768) {
        e.preventDefault();
                e.stopPropagation();
        if($(this).parents(".dropdown-submenu").find(".dropdown-menu").hasClass("show")){
            var nextMenu = $(this).next('.dropdown-menu').removeClass("show");
            var nextMenu = $(this).next('.dropdown-menu');
            $(this).parents(".dropdown-menu").addClass("show222");
            nextMenu.addClass('hide');
        }else{
            // Only for mobile view
                
               
                var nextMenu = $(this).next('.dropdown-menu');
                nextMenu.removeClass('hide');
                if (nextMenu.length) {
                    // Toggle the clicked submenu
                    nextMenu.toggleClass('show');
                }
           
        }
    }
        
    });
  },
  allowNumber:function(){
    $('.onlyNumericInput').on('keypress', function(event) {
      var charCode = (event.which) ? event.which : event.keyCode;

      var value = $(this).val();
      if (value.includes('.')  && charCode == 46 ) {
          event.preventDefault();
      }
        // Allow only digits (0-9) and some specific control keys
      if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 46) {
              event.preventDefault();
      }
      $(this).val(this.value.replace(/[^0-9.]/g, ''));
      console.log(this.value.replace(/[^0-9.]/g, ''));
        
    });
    $('.onlyNumericInput').on('input', function(event) {
      var charCode = (event.which) ? event.which : event.keyCode;

      var value = $(this).val();
      if (value.includes('.')  && charCode == 46 ) {
          event.preventDefault();
      }
        // Allow only digits (0-9) and some specific control keys
      if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 46) {
              event.preventDefault();
      }
      $(this).val(this.value.replace(/[^0-9.]/g, ''));
      console.log(this.value.replace(/[^0-9.]/g, ''));
        
    });
  },
  removeValidationMessage: function(){
    $(".modal").attr("tabindex","n")
    $(document).on("change input",".custom-form .required-input",function(){
        var value = $(this).val();
        if (value !=''){
          $(this).parents(".form-group").find("label.error").remove()
        }
    })
  },
  initResponsive: function(){
    var viewportWidth = $(window).width();
    // console.log(viewportWidth)
    // if(viewportWidth > 400 && viewportWidth < 500){
    //     var $element = $('.paginate_button.last');
            
    //       // Get the absolute position of the element
    //     var offset = $element.offset();
            
    //     // Get the current scroll position
    //     var scrollTop = $(window).scrollTop();
    //     var scrollLeft = $(window).scrollLeft();
            
    //         // Calculate the position relative to the viewport
    //     var relativeTop = offset.top - scrollTop;
    //     var relativeLeft = offset.left - scrollLeft;
    //     var elementWidth = $element.outerWidth();
    //     var elementHeight = $element.outerHeight();
    //     var relativeBottom = relativeTop + elementHeight;
    //     var relativeRight = relativeLeft + elementWidth;
    //     $(".dataTables_length label").attr("style","left:"+relativeLeft+"px")
    // }
    if( viewportWidth < 700){
        let that= this;
        $('.modal').on('shown.bs.modal', function () {
          if($(this).find(".dataTable.scrollable").length == 0){
            let element = $(this).find(".table.scrollable");
            that.initiateDataTableRes(element);
            $(this).find(".table-responsive").attr("style","width:96% !important");
          }
        });
        // this.initiateDataTableRes(".table.scrollable");
        $("#dropdownUser").on("click",function(){
            $("#dropdownUserNav").toggleClass("show-nav")
        })
    }
    this.initiateDataTableRes(".table.scrollable.scrollable-seachable");
  }, 
  initiateDataTableRes: function(calss_val =""){
    // console.log(calss_val)
      var $targetElement = $('.table.scrollable');
      $($targetElement).addClass("w-100")
      var $previousElement = $targetElement.parent("div");
      $previousElement.addClass('table-responsive text-nowrap w-100');
        table_data = $(calss_val).DataTable({
            dom: "",
            searching: true,
            scrollX: true,
            scrollY: true,
            "ordering": false,
            "paging":false
           
        });
        
        $('#serarch-filter-input').on('keyup', function() {
            table_data.search(this.value).draw();
        });
      }
  
}