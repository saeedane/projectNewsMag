!function(e){"use strict";ak.form.controlConstructor.radio_image=ak.form.Control.extend({ready:function(){var t=this;t.container.on("click","li",function(){t.setValue(e(this).data("value"))}),t.container.find('[data-toggle="tooltip"]').tooltip()},setValue:function(t){var e=this,n=e.container.find("ul"),a=e.container.find("input");0!==n.find('[data-value="'+t+'"]').length&&(n.find("li").removeClass("selected"),n.find('[data-value="'+t+'"]').addClass("selected"),a.val(t).trigger("change"),e.setting.set(t))}})}(jQuery);