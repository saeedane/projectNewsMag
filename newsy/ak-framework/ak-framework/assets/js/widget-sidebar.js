!function(n){n(window).on("load",function(){n("#widgets-right, #menu-management, #edittag");n(".widget-overlay .close").on("click",function(){n(".widget-overlay").fadeOut()}),n(".addwidgetconfirm").on("click",function(){var e,t,i=n(".textwidgetconfirm").val();""!==i&&(e=i,t=0,n(".widget-content-wrapper li span").each(function(){n(this).text().toLowerCase()===e.toLowerCase()&&t++}),0===t)&&(i="<li><span>"+i+"</span><input type='hidden' name='widgetlist["+i.replace(/<script[^>]*?>.*?<\/script>/gi,"").replace(/<[\/\!]*?[^<>]*?>/gi,"").replace(/<style[^>]*?>.*?<\/style>/gi,"").replace(/<![\s\S]*?--[ \t\n\r]*>/gi,"").replace(/<style[^>]*?>.*?<\/style>/gi,"").replace(" ","-").toLowerCase()+"]' value='"+i+"'><div class='remove fa fa-ban'></div></li>",n(".widget-content-wrapper ul").append(i),n(".textwidgetconfirm").val("")),n(".widget-adding-content").hide(),n(".widget-content-list").show()}),n(".addwidget").on("click",function(){n(".widget-adding-content").show(),n(".widget-content-list").hide(),n(".textwidgetconfirm").val("")}),n(".widget-overlay").on("click",".widget-content-wrapper .remove",function(){var e=n(this).parents("li");n(e).fadeOut(function(){n(e).remove()})}),n(".sidebarwidget").on("click",function(){var e,t;n(".widget-overlay").fadeIn(),0===n(".widget-content-wrapper li").length?(n(".widget-adding-content").show(),n(".widget-content-list").hide()):(n(".widget-adding-content").hide(),n(".widget-content-list").show()),e=n(".widget-overlay-wrapper").height(),t=n(window).height(),n(".widget-overlay-wrapper").css({top:(t-e)/2})}),window.widget_script=function(e){0},n(document).ajaxComplete(function(){widget_script()}),n("#available-widgets-list .widget-tpl").on("click",function(){setTimeout(function(){widget_script()},100)}),widget_script()})}(jQuery);