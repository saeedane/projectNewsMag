!function(d){"use strict";function s(t,e){var s,a,i,e=d.extend({},e),o=d(t);if(!o.hasClass(e.loadedClass))return"string"==typeof(e=this.filter_data(e,o)).container&&(e.container=t.querySelector(e.container)),"string"==typeof e.navContainer&&(e.navContainer=t.querySelector(e.navContainer)),"string"==typeof e.controlsContainer&&(e.controlsContainer=t.querySelector(e.controlsContainer)),"inside"==e.navPosition&&(s=e.onInit,e.onInit=function(t){o.find(".tns-controls").prependTo(o.find(".tns-ovh")),s&&s(t)},e.navPositiona=null),e.rtl&&(e.textDirection="rtl"),e.onSettingsInit&&(e=e.onSettingsInit(e,t)),a=tns(e),o.addClass(e.loadedClass),e.navAsThumbnails&&(i=tns({items:e.items,speed:e.speed,autoplay:!1,nav:!1,controls:!1,loop:!1,rewind:!1,mouseDrag:!0,swipeAngle:!1,...e.navSettings,container:e.navContainer}),a.events.on("indexChanged",function(t){var t=a.getInfo(),e=i.getInfo();t.displayIndex+1>e.items?i.goTo(t.displayIndex-2):i.goTo("first")})),a}s.prototype.filter_data=function(t,e){if(t.slider_data_var_prefix){e=this.get_data(t.slider_data_var_prefix+"_"+e.attr("id"));if(!e)return t;void 0!==e.atts.slider_nav&&""!==e.atts.slider_nav&&(t.controls="disabled"!==e.atts.slider_nav,t.controls&&"enabled"!==e.atts.slider_nav&&(t.loadedClass+=" ak-slider-nav-enabled"),t.loadedClass+=" ak-slider-nav-"+e.atts.slider_nav),void 0!==e.atts.slider_dots&&""!==e.atts.slider_dots&&(t.nav="disabled"!==e.atts.slider_dots,t.nav&&"enabled"!==e.atts.slider_dots&&(t.loadedClass+=" ak-slider-dots-enabled"),t.loadedClass+=" ak-slider-dots-"+e.atts.slider_dots),void 0!==e.atts.slider_loop&&""!==e.atts.slider_loop&&(t.loop="enabled"==e.atts.slider_loop),void 0!==e.atts.slider_autoplay&&""!==e.atts.slider_autoplay&&(t.autoplay="enabled"===e.atts.slider_autoplay),void 0!==e.atts.slider_autoplay_speed&&""!==e.atts.slider_autoplay_speed&&(t.autoplaySpeed=parseInt(e.atts.slider_autoplay_speed)),void 0!==e.atts.slider_autoplay_timeout&&""!==e.atts.slider_autoplay_timeout&&(t.autoplayTimeout=parseInt(e.atts.slider_autoplay_timeout)),void 0!==e.atts.slider_items&&""!==e.atts.slider_items&&(t.items=parseInt(e.atts.slider_items)),void 0!==e.atts.slider_scroll_items&&""!==e.atts.slider_scroll_items&&(t.slideBy=parseInt(e.atts.slider_scroll_items)),void 0!==e.atts.slider_speed&&""!==e.atts.slider_speed&&(t.speed=parseInt(e.atts.slider_speed)),void 0!==e.atts.slider_item_margin&&""!==e.atts.slider_item_margin&&(t.gutter=parseInt(e.atts.slider_item_margin)),void 0!==e.atts.slider_stage_padding&&""!==e.atts.slider_stage_padding&&(t.edgePadding=parseInt(e.atts.slider_stage_padding)),void 0!==e.atts.slider_center&&""!==e.atts.slider_center&&(t.center="on"===e.atts.slider_center),void 0!==e.atts.slider_axis&&""!==e.atts.slider_axis&&(t.axis=e.atts.slider_axis),(void 0===e.atts.autoWidth||!e.atts.autoWidth&&e.atts.slide_count_mobile)&&(t.responsive={0:{items:1},380:{items:e.atts.slide_count_mobile||1},768:{items:e.atts.slide_count_tablet||2},1024:{items:e.atts.slide_count_notebook||3},1400:{items:e.atts.slide_count_desktop||3}})}return t},s.prototype.get_data=function(t){var e;return void 0!==window[t]?e=window[t]:console.log("error:"+t),e},d.fn.Ak_Slider=function(t){var e={container:".ak-slider-wrapper",slider_data_var_prefix:"ak_slider_data",items:1,slideBy:"page",gutter:15,center:!1,loop:!1,nav:!1,navContainer:!1,navPosition:"inside",controls:!1,controlsText:["<",">"],controlsPosition:"bottom",loadedClass:"ak-slider-loaded",speed:250,autoplay:!1,autoplayButtonOutput:!1,autoplayTimeout:3e3,autoplaySpeed:1e3,edgePadding:0,lazyLoad:!0,lazyloadSelector:".lazyload",rtl:!1,onSettingsInit:null};return t=t?d.extend(e,t):d.extend(e),d(this).each(function(){return new s(this,t)})}}(jQuery);