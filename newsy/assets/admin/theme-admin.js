var Newsy_Theme_Admin = (function ($) {
	"use strict";

	return {
		init: function () {
			this.mailchimp();
			this.facebook_access_token();
		},

		mailchimp: function () {
			var self = this;

			// widget
			$(document).on(
				"change",
				".widget-mailchimp-code-field textarea",
				function (e, target) {
					var match = $(this)
						.val()
						.match(/action="([^"]*?)"/i);

					if (match != undefined && match[1] !== undefined) {
						$(this)
							.closest(".widget-mailchimp-code-field")
							.siblings(".widget-mailchimp-url-field")
							.find("input")
							.val(match[1]);
					}
				}
			);

			// Visual Composer
			$(document).on(
				"change",
				'.wpb_el_type_textarea_raw_html textarea[name="mailchimp-code"]',
				function () {
					var match = $(this)
						.val()
						.match(/action="([^"]*?)"/i);

					if (match != undefined && match[1] !== undefined) {
						$(this)
							.closest(".wpb_el_type_textarea_raw_html")
							.siblings(
								'div[data-vc-shortcode-param-name="mailchimp-url"]'
							)
							.find('textarea[name="mailchimp-url"]')
							.val(match[1]);
					}
				}
			);
		},

		facebook_access_token: function () {
			var self = this;

			$(".newsy_access_token.facebook").on("click", function (e) {
				e.preventDefault();

				var $this = $(this),
					control = $this.parents(".ak-panel-section"),
					app_url = "https://graph.facebook.com/oauth/access_token",
					access_token,
					parameter = {
						client_id: control
							.find('input[name="facebook_app_id"]')
							.val(),
						client_secret: control
							.find('input[name="facebook_security_key"]')
							.val(),
						grant_type: "client_credentials",
					};

				$.ajax({
					url: app_url,
					data: parameter,
					dataType: "json",
					type: "POST",
					beforeSend: function (jqXHR) {},
				})
					.done(function (data, textStatus, jqXHR) {
						access_token = data.access_token;

						control
							.find('input[name="facebook_access_token"]')
							.val(access_token);
					})
					.fail(function (jqXHR, textStatus, errorThrown) {
						window.alert(
							"Info Message: " + jqXHR.responseJSON.error.message
						);
					})
					.always(function (data, textStatus, jqXHR) {});
			});
		},
	}; // /return
})(jQuery);

// Load when ready
jQuery(document).ready(function () {
	Newsy_Theme_Admin.init();
});
