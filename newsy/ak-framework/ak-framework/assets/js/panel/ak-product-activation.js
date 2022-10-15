!function(o){"use strict";({$document:o(document),init:function(){var t=this;t.$document.ready(function(){t.purchase_click()})},purchase_click:function(){var e=this;e.$document.on("click",".ak-activate-button",function(t){t.preventDefault(),e.register_purchase()}),e.$document.on("click",".ak-deactivate-button",function(t){t.preventDefault(),e.deregister_purchase()})},register_purchase:function(){var e=this;swal({title:"Verifying Purchase Code...",text:'<div id="purchase_loading"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>',html:!0,timer:2e7,showConfirmButton:!1}),e.ajax({page_action:"activate",data:e._get_panel_data()},function(t){e.show_response(t)})},deregister_purchase:function(){var e=this;swal({title:"",text:'<div id="purchase_loading"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>',html:!0,timer:2e7,showConfirmButton:!1}),e.ajax({page_action:"deactivate",data:e._get_panel_data()},function(t){e.show_response(t)})},_get_panel_data:function(){return o("#ak-activate-form").ak_serialize()},_get_auth_login:function(t){var e=o("#purchase_code").val(),a=window.location+"&purchase="+e;window.location.href=t.auth_url+"?redirectTo="+encodeURIComponent(a)+"&purchase_code="+e},ajax:function(t,e){o.ajax({url:ak_framework_loc.ajax_url,type:"POST",dataType:"json",data:o.extend({action:"ak_admin_ajax",action_id:"product-panel",module_id:"product-activation",nonce:ak_framework_loc.nonce},t)}).done(e).fail(function(t){var e=t.code||t.readyState||"",t=t.message||t.responseText||"";swal({title:"An error occurred",type:"error",text:e+"-"+t,confirmButtonText:"OK",closeOnConfirm:!0,showConfirmButton:!1,showCancelButton:!1,html:!0,timer:5e3})})},show_response:function(t){if(void 0===t&&!t)return console.log("no response"),!1;t&&void 0!==t.success&&t.success?t.result&&void 0!==t.result.status&&"auth"===t.result.status?this._get_auth_login(t.result.data):swal({title:t.result.data.title,text:t.result.data.text,type:"success",confirmButtonText:"OK",closeOnConfirm:!0,showConfirmButton:!0,showCancelButton:!1,html:!0},function(t){t&&(o(".ak-activate-wrap").hide(),location.href=o(".ak-page-top-wrapper").find(".nav-tab").first().attr("href"))}):t.success||(void 0!==t.result&&void 0!==t.result.code&&t.result.code?swal({title:"Cannot complete ajax request.",text:t.result.message,type:"error",confirmButtonText:"OK",closeOnConfirm:!0,showConfirmButton:!0,showCancelButton:!1,html:!0}):swal({title:"An error occurred",type:"error",confirmButtonText:"OK",closeOnConfirm:!0,showConfirmButton:!1,showCancelButton:!1,html:!0,timer:1500}))}}).init()}(jQuery);