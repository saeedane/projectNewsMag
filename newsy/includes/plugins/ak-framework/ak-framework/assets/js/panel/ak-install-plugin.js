!function(n){"use strict";({$document:n(document),plugin_id:!1,$current_el:!1,$current_item_el:!1,$current_action:"",$progress_min:10,set_plugin_id:function(t){this.plugin_id=t},get_plugin_id:function(){return this.plugin_id},init:function(){var t=this;t.$document.ready(function(){t.actions()})},actions:function(){var e=this;n(".ak_plugin_action_btn").on("click",function(t){t.preventDefault(),e.$current_el=this,e.$current_item_el=n(e.$current_el).parents(".ak-install-plugin-page-item"),e.plugin_id=e.$current_item_el.data("id"),e.plugin_title=e.$current_item_el.find(".ak-plugin-title").text(),e.$current_item_el.hasClass("installed")?e.$current_action="activate":e.$current_item_el.hasClass("activated")?e.$current_action="deactivate":e.$current_item_el.hasClass("not-installed")?e.$current_action="install":e.$current_item_el.hasClass("need-update")&&(e.$current_action="update"),swal({title:ak_install_plugin_loc.pop_title[e.$current_action].replace("%s",e.plugin_title),text:'<div class="ak-progress-bar"><div class="ak-progress"></div></div>',html:!0,timer:2e6,showConfirmButton:!1}),setTimeout(function(){n(".ak-progress").css("width","90%")},1500),e.ajax({import_action:e.$current_action,import_id:e.plugin_id},function(t){"install"!=e.$current_action&&"update"!=e.$current_action||"object"!=typeof t&&(t=t.match(/\{"(?:[^{}]|)*\"}/),t=JSON.parse(t[0])),t&&t.success?(e.$current_item_el.removeClass("installed activated not-installed need-update"),"activate"==e.$current_action?e.$current_item_el.addClass("activated"):"deactivate"==e.$current_action?e.$current_item_el.addClass("installed"):"install"!=e.$current_action&&"update"!=e.$current_action||(e.$current_item_el.addClass("installed"),t.version_html&&e.$current_item_el.find(".ak-plugin-version").html(t.version_html)),swal({title:"Success",type:"success",showConfirmButton:!1,timer:1e3})):swal({title:t.result.code,text:t.result.message,type:"error",confirmButtonText:"Ok",closeOnConfirm:!0,showCancelButton:!1,html:!0},function(t){})})})},ajax:function(t,e){n.ajax({url:ak_framework_loc.ajax_url,type:"POST",data:n.extend({action:"ak_admin_ajax",action_id:"product-panel",module_id:"install-plugin",nonce:ak_framework_loc.nonce},t)}).done(e).fail(function(t){swal({title:"",timer:1})})}}).init()}(jQuery);