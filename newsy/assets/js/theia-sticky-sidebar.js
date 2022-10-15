!function(h){h.fn.theiaStickySidebar=function(i){var t;function o(i,t){if(!0===i.initialized)return!0;if(h("body").width()<i.minWidth)return!1;var b=i,i=t;return b.initialized=!0,0===h("#theia-sticky-sidebar-stylesheet-"+b.namespace).length&&h("head").append(h('<style id="theia-sticky-sidebar-stylesheet-'+b.namespace+'">.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>')),i.each(function(){var e,i,t,o,a={},n=(a.sidebar=h(this),a.options=b||{},a.container=h(a.options.containerSelector),0==a.container.length&&(a.container=a.sidebar.parent()),a.sidebar.parents().css("-webkit-transform","none"),a.sidebar.css({position:a.options.defaultPosition,overflow:"visible","-webkit-box-sizing":"border-box","-moz-box-sizing":"border-box","box-sizing":"border-box"}),a.stickySidebar=a.sidebar.find(".theiaStickySidebar"),0==a.stickySidebar.length&&(e=/(?:text|application)\/(?:x-)?(?:javascript|ecmascript)/i,a.sidebar.find("script").filter(function(i,t){return 0===t.type.length||t.type.match(e)}).remove(),a.stickySidebar=h("<div>").addClass("theiaStickySidebar").append(a.sidebar.children()),a.sidebar.append(a.stickySidebar)),a.marginBottom=parseInt(a.sidebar.css("margin-bottom")),a.paddingTop=parseInt(a.sidebar.css("padding-top")),a.paddingBottom=parseInt(a.sidebar.css("padding-bottom")),a.stickySidebar.offset().top),s=a.stickySidebar.outerHeight();function p(){a.fixedScrollTop=0,a.sidebar.css({"min-height":"1px"}),a.stickySidebar.css({position:"static",width:"",transform:"none"})}a.stickySidebar.css("padding-top",1),a.stickySidebar.css("padding-bottom",1),n-=a.stickySidebar.offset().top,s=a.stickySidebar.outerHeight()-s-n,0==n?(a.stickySidebar.css("padding-top",0),a.stickySidebarPaddingTop=0):a.stickySidebarPaddingTop=1,0==s?(a.stickySidebar.css("padding-bottom",0),a.stickySidebarPaddingBottom=0):a.stickySidebarPaddingBottom=1,a.previousScrollTop=null,a.fixedScrollTop=0,p(),a.onScroll=function(i){if(i.stickySidebar.is(":visible"))if(h("body").width()<i.options.minWidth)p();else{if(i.options.disableOnResponsiveLayouts)if(i.sidebar.outerWidth("none"==i.sidebar.css("float"))+50>i.container.width())return void p();var t,e,o,a,n,s,d,r=h(document).scrollTop(),c="static";r>=i.sidebar.offset().top+(i.paddingTop-i.options.additionalMarginTop)&&(e=i.paddingTop+b.additionalMarginTop,s=i.paddingBottom+i.marginBottom+b.additionalMarginBottom,d=i.sidebar.offset().top,a=i.sidebar.offset().top+(a=i.container,n=a.height(),a.children().each(function(){n=Math.max(n,h(this).height())}),n),t=0+b.additionalMarginTop,e=i.stickySidebar.outerHeight()+e+s<h(window).height()?t+i.stickySidebar.outerHeight():h(window).height()-i.marginBottom-i.paddingBottom-b.additionalMarginBottom,s=d-r+i.paddingTop,d=a-r-i.paddingBottom-i.marginBottom,a=i.stickySidebar.offset().top-r,o=i.previousScrollTop-r,"fixed"==i.stickySidebar.css("position")&&"modern"==i.options.sidebarBehavior&&(a+=o),"stick-to-top"==i.options.sidebarBehavior&&(a=b.additionalMarginTop),"stick-to-bottom"==i.options.sidebarBehavior&&(a=e-i.stickySidebar.outerHeight()),a=0<o?Math.min(a,t):Math.max(a,e-i.stickySidebar.outerHeight()),a=Math.max(a,s),a=Math.min(a,d-i.stickySidebar.outerHeight()),c=((o=i.container.height()==i.stickySidebar.outerHeight())||a!=t)&&(o||a!=e-i.stickySidebar.outerHeight())?r+a-i.sidebar.offset().top-i.paddingTop<=b.additionalMarginTop?"static":"absolute":"fixed"),"fixed"==c?(s=h(document).scrollLeft(),i.stickySidebar.css({position:"fixed",width:l(i.stickySidebar)+"px",transform:"translateY("+a+"px)",left:i.sidebar.offset().left+parseInt(i.sidebar.css("padding-left"))-s+"px",top:"0px"})):"absolute"==c?(d={},"absolute"!=i.stickySidebar.css("position")&&(d.position="absolute",d.transform="translateY("+(r+a-i.sidebar.offset().top-i.stickySidebarPaddingTop-i.stickySidebarPaddingBottom)+"px)",d.top="0px"),d.width=l(i.stickySidebar)+"px",d.left="",i.stickySidebar.css(d)):"static"==c&&p(),"static"!=c&&1==i.options.updateSidebarHeight&&i.sidebar.css({"min-height":i.stickySidebar.outerHeight()+i.stickySidebar.offset().top-i.sidebar.offset().top+i.paddingBottom}),i.previousScrollTop=r}},a.onScroll(a),h(document).on("scroll."+a.options.namespace,(i=a,function(){i.onScroll(i)})),h(window).on("resize."+a.options.namespace,(t=a,function(){t.stickySidebar.css({position:"static"}),t.onScroll(t)})),"undefined"!=typeof ResizeSensor&&new ResizeSensor(a.stickySidebar[0],(o=a,function(){o.onScroll(o)}))}),!0}function l(i){var t;try{t=i[0].getBoundingClientRect().width}catch(i){}return t=void 0===t?i.width():t}return(i=h.extend({containerSelector:"",additionalMarginTop:0,additionalMarginBottom:0,updateSidebarHeight:!0,minWidth:0,disableOnResponsiveLayouts:!0,sidebarBehavior:"modern",defaultPosition:"relative",namespace:"TSS"},i)).additionalMarginTop=parseInt(i.additionalMarginTop)||0,i.additionalMarginBottom=parseInt(i.additionalMarginBottom)||0,o(i=i,t=this)||(console.log("TSS: Body width smaller than options.minWidth. Init is delayed."),h(document).on("scroll."+i.namespace,function(t,e){return function(i){o(t,e)&&h(this).unbind(i)}}(i,t)),h(window).on("resize."+i.namespace,function(t,e){return function(i){o(t,e)&&h(this).unbind(i)}}(i,t))),this}}(jQuery);