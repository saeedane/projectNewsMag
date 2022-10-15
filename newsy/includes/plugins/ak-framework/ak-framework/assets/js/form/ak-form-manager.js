!function(c){"use strict";class e{constructor(){this.events={}}on(e,n){return"object"!=typeof this.events[e]&&(this.events[e]=[]),this.events[e].push(n),()=>this.removeListener(e,n)}removeListener(e,n){"object"!=typeof this.events[e]||-1<(n=this.events[e].indexOf(n))&&this.events[e].splice(n,1)}emit(e,...n){"object"==typeof this.events[e]&&this.events[e].forEach(e=>e(...n))}once(e,n){const t=this.on(e,(...e)=>{t(),n(...e)})}}class n{constructor(){this.value="",this.event=new e}get(){return this.value}set(e){this.value=e,this.trigger()}trigger(){this.event.emit("change",this.value)}reset(){this.value=""}}function l(e){e="object"==typeof ak.form.controlConstructor[e]?c.extend(!0,{},ak.form.controlConstructor[e]):c.extend(!0,{},ak.form.Control);return e}function a(e){(e=void 0===e?c(".ak-elementor-control-field"):e).each(function(){var e,n,t,i;c(this).hasClass("control_initialized")||(n=(e=c(this)).data("param_name"),i=e.data("param_type"),t=e.data("default"),(i=l(i)).init({container:e,id:n,param_name:n,default:t}),i.onChange(function(e,n){n.container.find('[data-setting="'+n.param_name+'"]').trigger("input")}),c(this).addClass("control_initialized"))})}window.ak=window.ak||{},window.ak.form=window.ak.form||{},window.ak.form.controlConstructor={},window.ak.form.Controls={},window.ak.form.Control={container:null,init:function(e){this.container=e.container,this.id=e.id,this.param_name=e.param_name,this.default=e.default||"",this.presets=e.presets,this.dependency=e.dependency,this.setting=new n,this.setup()},setup:function(){this.setting.set(this.getInputValue()||this.default),this.initDependency(),this.initPresets(),this.ready(),this.setting.event.emit("ready",this)},ready:function(){var e=this,n=e.container.find(".ak-form-field-main-input");n.on("keyup paste",function(){e.setting.set(n.val())})},getInputValue:function(){return this.container.find(".ak-form-field-main-input").val()},getValue:function(){return this.setting.get()},setValue:function(e){this.container.find(".ak-form-field-main-input").val(e),this.setting.set(e)},setDefault:function(e){this.default=e},getDefault:function(){return this.default||""},onChange:function(n){var t=this;this.setting.event.on("change",e=>n(e,t))},onReady:function(e){this.setting.event.on("ready",e)},extend:function(e){var n=c.extend({},this);return c.extend({},n,e)},isActive:function(){var e=this.dependency;if(!e)return!0;void 0!==e.not_empty&&(e.value="",e.operator="!=");var n=!0,t=ak.form.Controls[e.element];return n=(n=t.dependency?t.isActive():n)&&ak_value_compare(e.value,t.getValue(),e.operator||"in")},checkContainerIsActive:function(){var e=this;e.isActive()?(e.container.removeClass("control-inactive"),e.container.slideDown("fast")):(e.container.addClass("control-inactive"),e.container.slideUp("fast"))},initDependency:function(){var e=this.dependency;e&&void 0!==ak.form.Controls[e.element]&&(this.checkContainerIsActive(),function e(t,n){!n||(n=ak.form.Controls[n.element])&&(n.onChange(function(e,n){t.checkContainerIsActive()}),e(t,n.dependency))}(this,this.dependency))},initPresets:function(){var e=this.presets;e&&this.onChange(function(t){c.each(e,function(e,n){t==e&&c.each(n,function(e,n){ak.form.Controls[e]&&ak.form.Controls[e].setValue(n)})})})}},c.fn.Ak_Form_Control=function(){return c(this).each(function(e,n){var t,i,a,o,s,r;c(this).hasClass("control_initialized")||(t=(n=c(n)).data("control-id"),r=n.data("control-type"),i=n.data("control-param-name"),a=n.data("dependency"),o=n.data("default"),s=n.data("presets"),(r=l(r)).init({container:n,id:t,param_name:i,default:o,dependency:a,presets:s}),ak.form.Controls[t]=r,c(this).addClass("control_initialized"))})},c.fn.Ak_Form_Section=function(){return c(this).each(function(e,n){var t,n=c(n);n.hasClass("section_initialized")||(n.find(".ak-form-control").Ak_Form_Control(),0<(t=c(".ak-fields-group-title-container",n)).length&&t.on("click",function(e){e.preventDefault();var e=c(this).parent(),n=e.find(".ak-fields-group-title-container .collapse-button");e.hasClass("open")?(e.find(".ak-fields-group-content").slideUp(300),e.removeClass("open").addClass("close"),n.find(".fa").removeClass("fa-chevron-up").addClass("fa-chevron-down")):(e.removeClass("close").addClass("open"),n.find(".fa").removeClass("fa-chevron-down").addClass("fa-chevron-up"),e.find(".ak-fields-group-content").slideDown(300))}),n.addClass("section_initialized"))})},c.fn.Ak_Form_Panel=function(a){var e={panelSelector:".ak-panel-main",panelmenuSelector:".ak-panel-menu",panelcontentSelector:".ak-panel-content"};return a=a?c.extend(e,a):c.extend(e),c(this).each(function(e,n){var t,i,n=c(n);n.hasClass("panel_initialized")||(t=n.find(a.panelmenuSelector),i=n.find(a.panelcontentSelector),t.on("click","li a",function(e){var n;e.preventDefault(),c(this).parent().hasClass("ak-menu-active")||(e=c(this).parent().data("section"),c("li",t).removeClass("ak-menu-active"),c("li.ak-menu-section-"+e,t).addClass("ak-menu-active"),c(">.ak-panel-section",i).hide(),(n=c(".ak-panel-section-"+e,i)).show(),setTimeout(function(){n.Ak_Form_Section()},50))}),t.find("li:first a").trigger("click"),n.addClass("panel_initialized"))})},c(document).on("ready",function(){if("object"==typeof ak_framework_loc)switch(ak_framework_loc.type){case"menus":case"widgets":case"customizer":c(".menu-item-handle").on("click",function(e){e.preventDefault(),c(this).closest(".menu-item").find(".ak-panel-main").Ak_Form_Panel()}),c(".widget-top",c("#widgets-right, #wp_inactive_widgets")).on("click",function(e){e.preventDefault(),c(this).parents(".widget").find(".ak-panel-main").Ak_Form_Panel()}),c(document).on("widget-updated",function(e,n){n.find(".ak-panel-main").Ak_Form_Panel()}),c(document).on("widget-added",function(e,n){n.find(".ak-panel-main").Ak_Form_Panel()});break;default:c(".ak-panel-main").Ak_Form_Panel()}}),c(document).ajaxSuccess(function(e,n,t){var i,t=c.ak_unserialize(t.data);"elementor_ajax"===t.action?a():"wpb_show_edit_form"===t.action||"vc_edit_form"===t.action?(i=void 0===i?c(".vc_shortcode-param"):i).each(function(){var e,n,t,i;c(this).hasClass("control_initialized")||(n=(e=c(this)).data("vc-shortcode-param-name"),t=e.data("param_type").replace("ak_vc_",""),i=e.data("default"),"css_editor"!=t&&"info"!=t&&(l(t).init({container:e,id:n,param_name:n,default:i}),c(this).addClass("control_initialized")))}):"add-menu-item"===t.action&&c(".ak-menu-options").Ak_Form_Panel()}),window.ak_init_control=function(e){a(c(e).parents(".ak-elementor-control-field"))},c(document).on("ready",function(){"undefined"!=typeof elementor&&elementor&&elementor.hooks.addAction("panel/open_editor/widget",function(e){a(c(e.$el).find(".ak-elementor-control-field"))})})}(jQuery);