for(var control_types=["ajax_select","info","color","text","number","media","media_image","background_image","radio_button","radio_image","radio_icon","select","slider","slider_unit","icon_select","switcher","textarea","typography","css_editor","visual_checkbox","visual_select","visual_radio","repeater","mix_fields"],i=0;i<control_types.length;i++)wp.customize.controlConstructor["ak_"+control_types[i]]=wp.customize.Control.extend({ready:function(){"use strict";var e=this;ak.form.Controls[e.id]&&ak.form.Controls[e.id].onChange(function(t){e.setValue(t)})},setValue:function(t){"use strict";this.setting.set(t)}});