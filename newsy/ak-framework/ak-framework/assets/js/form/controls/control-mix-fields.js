!function(e){"use strict";ak.form.controlConstructor.mix_fields=ak.form.Control.extend({ready:function(){this.initMixFields()},initMixFields:function(){var i=this,t=i.container.find(".ak-mixed-field"),n=0<i.container.parents(".ak-mixed-field").length;this.return_string=t.hasClass("ak-mixed-string-field"),n||(t.find(".ak-form-control").Ak_Form_Control(),this.onReady(function(){var n=ak_debounce(function(){var t=i.getMixValues();i.setValue(t)},10);t.find(".ak-form-control").each(function(){var t=e(this).data("control-id");ak.form.Controls[t]&&ak.form.Controls[t].onChange(n)})}))},getInputValue:function(){return this.getValue()},getValue:function(){return this.return_string?this.container.find("input.ak-form-field-"+this.param_name).val():this.getMixValues()},setValue:function(n){var t,i;void 0!==n&&(this.return_string?(t=this.container.find("input.ak-form-field-"+this.param_name),i=n?Object.keys(n).filter(function(t){return void 0!==n[t]&&""!==n[t]&&null!==n[t]}).map(function(t){return t+"="+n[t]}).join("&"):"",t.val(i),this.setting.set(i)):this.setting.set(n))},getMixValues:function(t){var n={flatList:"flat"===t,arrayify:"flat"!==t},n=FormDataJson.toJson(this.container.find(".ak-mixed-field"),n);return"flat"===t?n:ak_find_key_value_in_array(this.param_name,n)}})}(jQuery);