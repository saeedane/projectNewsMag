(function ($) {
	"use strict";
	ak.form.controlConstructor["part_builder"] = ak.form.Control.extend({
		is_customizer: false,
		builder_inited: false,
		builder_container: null,
		builder_wrap: null,
		builder_items_wrap: null,
		_builder_data: null,
		ready: function () {
			"use strict";
			var control = this;
			this.builder_container = this.container.find(".part-builder");
			this.builder_wrap = this.builder_container.find(
				".part-builder-wrapper"
			);
			this.builder_items_wrap = this.builder_container.find(
				".part-builder-items"
			);
			this.is_customizer = $("body").hasClass("wp-customizer");

			var first_part = this.container
				.find(".part-switcher > div")
				.first()
				.data("part");

			this.setCurrentPart(first_part);

			setTimeout(function () {
				control.initBuilder();
			}, 1500);
		},

		initBuilder: function () {
			var control = this;
			if (!this.builder_inited) {
				// init desktop first
				this.init_part_html();

				// switch part
				this.switch_part();

				this.change_event();

				if (this.is_customizer) {
					var part_builder =
						control.container.find(".ak-part-builder");
					part_builder.css(
						"left",
						$("#customize-controls").width() + "px"
					);

					part_builder.prepend(
						'<div class="ak-part-builder-toogle-handler"><i class="fa fa-angle-down"></i></div>'
					);

					$(".ak-part-builder-toogle-handler").on(
						"click",
						function (e) {
							e.preventDefault();
							if ($(part_builder).hasClass("ak-builder-hidden")) {
								part_builder.removeClass("ak-builder-hidden");
								$(this)
									.find(".fa")
									.addClass("fa-angle-down")
									.removeClass("fa-angle-up");
							} else {
								part_builder.addClass("ak-builder-hidden");
								$(this)
									.find(".fa")
									.addClass("fa-angle-up")
									.removeClass("fa-angle-down");
							}
						}
					);
				}

				this.builder_inited = true;
			}
		},

		setCurrentPart: function (part) {
			if (this.is_customizer) {
				if (
					part == "builder_header_mobile" ||
					part == "builder_drawer"
				) {
					$(".preview-mobile").trigger("click");

					if (part == "builder_drawer") {
						// open drawer
					}
				} else {
					$(".preview-desktop").trigger("click");
				}
			}
			this.builder_container.attr("data-part", part);
		},

		getCurrentPart: function () {
			return this.builder_container.attr("data-part");
		},

		getBuilderData: function () {
			return this._builder_data;
		},

		getCurrentBuilderData: function (current_part) {
			if (typeof current_part === "undefined") {
				current_part = this.getCurrentPart();
			}

			var _builder_data = this.get_option(current_part);

			if (_.isEmpty(_builder_data["order"])) {
				_builder_data["order"] =
					newsy_part_builder_loc.part_defaults[current_part]["order"];
			}

			if (
				!_builder_data ||
				_.isEmpty(_builder_data) ||
				_.isEmpty(_builder_data["order"])
			) {
				_builder_data =
					newsy_part_builder_loc.part_defaults[current_part];
			}

			this._builder_data = _builder_data;

			return _builder_data;
		},

		switch_part: function () {
			var control = this;

			control.container
				.find(".part-switcher > div")
				.on("click", function (e) {
					e.preventDefault();
					control.setCurrentPart($(this).data("part"));

					setTimeout(function () {
						control.init_part_html();
						control.change_event();
					}, 500);
				});
		},

		change_event: function () {
			var control = this;
			var setting = this.sanitize_setting(control.getCurrentPart());
			if (ak.form.Controls[setting]) {
				ak.form.Controls[setting].onChange(function (value) {
					control.init_part_html();
				});
			}
		},

		init_part_html: function () {
			var control = this,
				current_part = control.getCurrentPart();

			this.builder_wrap.addClass("loading");

			// reset current view
			this.setCurrentPart(current_part);
			this.builder_wrap.html("");
			this.builder_items_wrap.html("");

			var control_data = this.getCurrentBuilderData(current_part);

			//render rows
			_.each(control_data["order"], function (row_index) {
				var row_data = _.isEmpty(control_data[row_index])
					? newsy_part_builder_loc.part_defaults[current_part][
							row_index
					  ]
					: control_data[row_index];

				control.builder_wrap.append(
					control.get_row_html(row_data, row_index)
				);
			});

			//render items
			this.builder_items_wrap.append(control.get_unused_items_html());

			this.init_sortable_rows();
			this.init_sortable_elements();
			this.init_element_close_clicked();

			// Header setting clicked
			this.init_column_tooltip_setting();

			this.init_go_to_setting();

			this.builder_wrap.removeClass("loading");
		},

		update_column_items: function (element) {
			var control = this,
				current_part = control.getCurrentPart(),
				element = $(element).hasClass("part-builder-drop-zone")
					? element
					: $(element).parents(".part-builder-drop-zone");

			if ($(element).hasClass("part-builder-items")) {
				return null;
			}

			// populate element
			var elements = [];
			$(element)
				.find(".part-element")
				.each(function () {
					elements.push($(this).data("element"));
				});

			var column = $(element)
				.parents(".part-builder-column")
				.data("column");
			var row = $(element).parents(".part-builder-row").data("row");

			var setting = current_part + "[" + row + "][" + column + "][items]";

			control.change_option(setting, elements);
		},

		init_sortable_elements: function () {
			var control = this;
			control.builder_container.find(".part-builder-drop-zone").sortable({
				items: ".part-element",
				connectWith: ".part-builder-drop-zone",
				update: function (event, ui) {
					if (ui.sender !== null) {
						// self column items
						control.update_column_items(ui.sender);
					}
					control.update_column_items(ui.item);
				},
			});
		},

		init_element_close_clicked: function () {
			var control = this;
			control.builder_container
				.find(".part-element-close")
				.on("click", function (e) {
					e.preventDefault();
					var element = $(this).parent();
					var drop_zone = $(element).parent();
					var list = $(".part-builder-items");

					$(element).appendTo(list);
					control.update_column_items(drop_zone);
				});
		},

		update_rows: function () {
			var control = this;
			var rows = [],
				current_part = control.getCurrentPart();

			control.builder_container
				.find(".part-builder-row")
				.each(function () {
					rows.push($(this).data("row"));
				});

			control.change_option(current_part + "[order]", rows);
		},

		init_sortable_rows: function () {
			var control = this;
			control.builder_container.find(".part-builder-wrapper").sortable({
				handle: ".part-builder-row-drag-handle",
				update: function () {
					control.update_rows();
				},
				beforeStop: function (ev, ui) {},
			});
		},

		init_column_tooltip_setting: function () {
			var control = this;
			control.builder_container
				.find(".tooltip-opener")
				.on("mousedown", function (e) {
					var element = $(this);

					if (element.hasClass("tooltip-open")) {
						element.removeClass("tooltip-open");
					} else {
						$(".tooltip-opener").removeClass("tooltip-open");
						element.addClass("tooltip-open");
					}
				});

			$(document).on("mousedown", function (e) {
				var target = e.target;
				var tooltip = $(target).parents(".part-builder-tooltip");
				var setting = $(target).hasClass("tooltip-opener");

				if (tooltip.length === 0 && !setting) {
					$(".part-builder-tooltip").removeClass("tooltip-open");
				}
			});

			control.builder_container
				.find(".part-column-option-align li")
				.on("click", function (e) {
					e.preventDefault();
					var self = $(this),
						align = self.data("align"),
						column_el = self.parents(".part-builder-column"),
						column = column_el.data("column"),
						row = self.parents(".part-builder-row").data("row"),
						current_part = control.getCurrentPart();

					if (!column_el.hasClass(align)) {
						// update elements
						column_el
							.removeClass("left center right")
							.addClass(align);

						// save setting
						var setting =
							current_part +
							"[" +
							row +
							"][" +
							column +
							"][align]";

						// update customizer instance
						control.change_option(setting, align);
					}
				});

			control.builder_container
				.find(".part-column-option-display li")
				.on("click", function (e) {
					e.preventDefault();
					var self = $(this),
						layout = self.data("layout"),
						column_el = self.parents(".part-builder-column"),
						column = column_el.data("column"),
						row = self.parents(".part-builder-row").data("row"),
						current_part = control.getCurrentPart();

					if (!column_el.hasClass(layout)) {
						// update elements
						column_el.removeClass("grow normal").addClass(layout);

						// save setting
						var setting =
							current_part +
							"[" +
							row +
							"][" +
							column +
							"][layout]";

						// update customizer instance
						control.change_option(setting, layout);
					}
				});

			control.builder_container
				.find(".part-row-setting-scheme li")
				.on("click", function (e) {
					e.preventDefault();
					var self = $(this),
						scheme = self.data("scheme"),
						row_el = self.parents(".part-builder-row"),
						row = row_el.data("row"),
						current_part = control.getCurrentPart();

					if (scheme == "") {
						row_el.removeClass("dark");
					} else if (!row_el.hasClass(scheme)) {
						row_el.removeClass("dark").addClass(scheme);
					}
					// save setting
					var setting = current_part + "[" + row + "][scheme]";

					// update customizer instance
					control.change_option(setting, scheme);
				});

			control.builder_container
				.find(".part-row-setting-layout li")
				.on("click", function (e) {
					e.preventDefault();
					var self = $(this),
						layout = self.data("layout"),
						row_el = self.parents(".part-builder-row"),
						row = row_el.data("row"),
						current_part = control.getCurrentPart();

					if (layout == "") {
						row_el.removeClass("stretched boxed");
					} else if (!row_el.hasClass(layout)) {
						row_el.removeClass("stretched boxed").addClass(layout);
					}

					// save setting
					var setting = current_part + "[" + row + "][layout]";

					// update customizer instance
					control.change_option(setting, layout);
				});
		},

		get_unused_items_html: function () {
			var control = this,
				current_part = control.getCurrentPart();
			var items_html = "",
				elements = newsy_part_builder_loc[current_part]["elements"];

			var used_elements = [];
			control.builder_container
				.find(".part-builder-rows")
				.find(".part-element")
				.each(function () {
					used_elements.push($(this).data("element"));
				});

			_.each(elements, function (dimension, index) {
				if (!_.contains(used_elements, index)) {
					items_html += control.get_item_html(index);
				}
			});

			return items_html;
		},

		get_row_html: function (row, row_index) {
			var control = this,
				current_part = control.getCurrentPart();
			var column_html = "";

			_.each(row, function (column, column_index) {
				if (
					column_index == "left" ||
					column_index == "center" ||
					column_index == "right"
				) {
					column_html += control.get_columns_html(
						column,
						column_index
					);
				}
			});

			return (
				'<div class="part-builder-' +
				row_index +
				" ak-flex-row part-builder-row " +
				row.layout +
				" " +
				row.scheme +
				'" data-row="' +
				row_index +
				'">' +
				'<div class="part-builder-row-name" data-go-section="' +
				current_part +
				'">' +
				"" +
				row_index[0].toUpperCase() +
				row_index.substring(1) +
				" Bar" +
				"</div>" +
				column_html +
				'<div class="part-builder-row-actions">' +
				'<div class="part-builder-row-drag-handle"><i class="fa fa-arrows"></i></div>' +
				'<div class="part-builder-row-setting">' +
				'<div class="tooltip-opener"><i class="fa fa-cog"></i></div>' +
				'<div class="part-builder-tooltip">' +
				'<div class="part-row-setting-scheme">' +
				"<h3>Row Scheme</h3>" +
				"<ul>" +
				'<li class="" data-scheme="">Light</li>' +
				'<li class="dark" data-scheme="dark">Dark</li>' +
				"</ul>" +
				"</div>" +
				'<div class="part-row-setting-layout">' +
				"<h3>Row Layout</h3>" +
				"<ul>" +
				'<li class="" data-layout="">Normal</li>' +
				'<li class="stretched" data-layout="stretched">Stretched</li>' +
				'<li class="boxed" data-layout="boxed">Boxed</li>' +
				"</ul>" +
				"</div>" +
				"</div>" +
				"</div>" +
				"</div>" +
				"</div>"
			);
		},

		get_columns_html: function (column, column_index) {
			var control = this;

			var items_html = "";
			if (_.isArray(column.items)) {
				_.each(column.items, function (item, index) {
					if (item.length > 0) {
						items_html += control.get_item_html(item);
					}
				});
			}

			return (
				'<div class="part-builder-column part-builder-' +
				column_index +
				" " +
				column.align +
				" " +
				column.layout +
				'" data-column="' +
				column_index +
				'">' +
				'<div class="part-builder-drop-zone">' +
				items_html +
				"</div>" +
				'<div class="part-setting tooltip-opener"><i class="fa fa-cog"></i></div>' +
				'<div class="part-builder-tooltip">' +
				'<div class="part-column-option-align">' +
				"<h3>Align</h3>" +
				"<ul>" +
				'<li class="left" data-align="left">Left</li>' +
				'<li class="center" data-align="center">Center</li>' +
				'<li class="right" data-align="right">Right</li>' +
				"</ul>" +
				"</div>" +
				'<div class="part-column-option-display">' +
				"<h3>Display</h3>" +
				"<ul>" +
				'<li class="grow" data-layout="grow">Grow</li>' +
				'<li class="normal" data-layout="normal">Normal</li>' +
				"</ul>" +
				"</div>" +
				"</div>" +
				"</div>"
			);
		},

		get_item_html: function (item) {
			var control = this,
				current_part = control.getCurrentPart();

			var item_name =
				newsy_part_builder_loc[current_part]["elements"][item];

			return (
				'<div class="part-element ' +
				item +
				' open-section" data-element="' +
				item +
				'">' +
				'<span class="part-element-title" data-go-section="' +
				item +
				'">' +
				item_name +
				"</span>" +
				'<span class="part-element-close"></span>' +
				"</div>"
			);
		},

		sanitize_setting: function (setting) {
			if (this.is_customizer) {
				var settings = setting.replace(/\[/g, "|").replace(/\]/g, "");
				var split = settings.split("|");
				var final = "newsy-theme-options";
				split.forEach(function (item, index) {
					final += "[" + item + "]";
				});
				return final;
			}

			return setting;
		},

		get_option: function (setting) {
			setting = this.sanitize_setting(setting);

			if (typeof ak.form.Controls[setting] !== "undefined") {
				return ak.form.Controls[setting].getValue();
			}

			return "";
		},

		change_option: function (setting, value) {
			setting = this.sanitize_setting(setting);
			if (typeof ak.form.Controls[setting] !== "undefined") {
				ak.form.Controls[setting].setValue(value);
			}
		},

		init_go_to_setting: function (part) {
			var control = this;

			$("[data-go-section]").on("click", function () {
				var data_section = $(this).data("go-section");

				var section = $("#" + data_section + "_group_start");

				if (section.length > 0) {
					section.removeClass("close").addClass("open");
					section.find(".ak-fields-group-content").slideDown();

					$("html, body").animate(
						{ scrollTop: section.offset().top - 50 },
						1000
					);
				}
			});
		},

		refresh_part: function (part) {
			var control = this;

			setTimeout(function () {
				control.init_part_html();
			}, 500);
		},

		reset_part_builder: function () {
			var control = this;

			setTimeout(function () {
				control.init_part_html();
			}, 500);
		},

		setValue: function (value) {
			var control = this;

			/* reset style options*/
			if (typeof value["builder_header_desktop"] !== "undefined") {
				$.each(
					$("#ak-form-control-builder_header_desktop").find(
						".ak-form-control"
					),
					function () {
						var setting = $(this).data("control-id");
						if (ak.form.Controls[setting]) {
							ak.form.Controls[setting].setDefault();
						}
					}
				);

				$.each(
					$("#header_desktop_style_group_start").find(
						".ak-form-control"
					),
					function () {
						var setting = $(this).data("control-id");
						if (ak.form.Controls[setting]) {
							ak.form.Controls[setting].setDefault();
						}
					}
				);
			}

			/* reset style options*/
			if (typeof value["builder_footer"] !== "undefined") {
				$.each(
					$("#ak-form-control-builder_footer").find(
						".ak-form-control"
					),
					function () {
						var setting = $(this).data("control-id");
						if (ak.form.Controls[setting]) {
							ak.form.Controls[setting].setDefault();
						}
					}
				);
				$.each(
					$("#footer_style_group_start").find(".ak-form-control"),
					function () {
						var setting = $(this).data("control-id");
						if (ak.form.Controls[setting]) {
							ak.form.Controls[setting].setDefault();
						}
					}
				);
			}

			control.reset_part_builder();
		},
	});
})(jQuery);
