!function(){"use strict";ak.form.controlConstructor.media=ak.form.Control.extend({ready:function(){var n=this,o=n.container.find(".ak-media-upload-btn");o.on("click",function(){var e,t=o.data("media-type"),a=o.data("media-title"),i=o.data("media-button-text"),a={title:a,multiple:!1,date:!1};t&&(a.library=wp.media.query({type:t})),(e=wp.media.frames.file_frame=wp.media({button:{text:i},states:[new wp.media.controller.Library(a)]})).open(),e.on("select",function(){var t=e.state().get("selection").first().toJSON();n.setValue(ak_sanitize_protocol(t.url)),e.state().get("selection").each(function(t,e){})})})},setValue:function(t){this.container.find(".ak-form-field-main-input").val(t),this.setting.set(t)}})}(jQuery);