"use strict";
window.odometerOptions = {
  auto: true, // Don't automatically initialize everything with class 'odometer'
  selector: '.number.animated-element', // Change the selector used to automatically find things to be animated
  format: '(.ddd).dd', // Change how digit groups are formatted, and how many digits are shown after the decimal point
  duration: 2000, // Change how long the javascript expects the CSS animation to take
  theme: 'default', // Specify the theme (if you have more than one theme css file on the page)
  animation: 'count' // Count is a simpler animation method which just increments the value,
                     // use it when you're looking for something more subtle.
};
if(!Date.prototype.toISOString) 
{
    Date.prototype.toISOString = function() 
	{
        function pad(n) {return n < 10 ? '0' + n : n}
        return this.getUTCFullYear() + '-'
            + pad(this.getUTCMonth() + 1) + '-'
                + pad(this.getUTCDate()) + 'T'
                    + pad(this.getUTCHours()) + ':'
                        + pad(this.getUTCMinutes()) + ':'
                            + pad(this.getUTCSeconds()) + 'Z';
    };
}
if(!String.prototype.padStart)
{
    String.prototype.padStart = function padStart(targetLength, padString)
	{
        targetLength = targetLength >> 0; //truncate if number, or convert non-number to 0;
        padString = String(typeof padString !== 'undefined' ? padString : ' ');
        if(this.length >= targetLength)
		{
            return String(this);
        }
		else 
		{
            targetLength = targetLength - this.length;
            if (targetLength > padString.length)
			{
                padString += padString.repeat(targetLength / padString.length); //append to original to ensure we are longer than needed
            }
            return padString.slice(0, targetLength) + String(this);
        }
    };
}
var gb_id = 0;
function gbUniqueId()
{
	return gb_id++;
}
function onAfterSlide(obj)
{
	var currentSlide = obj.items.visible;
	jQuery("#" + jQuery(currentSlide).attr("id") + "_content").fadeIn();
	jQuery(".slider_navigation .more").css("display", "none");
	jQuery("#" + jQuery(currentSlide).attr("id") + "_url").css("display", "block");
}
/*function onAfterSlide(prevSlide, currentSlide)
{
	jQuery("#" + jQuery(currentSlide).attr("id") + "_content").fadeIn();
	jQuery(".slider_navigation .more").css("display", "none");
	jQuery("#" + jQuery(currentSlide).attr("id") + "_url").css("display", "block");
}*/
function onBeforeSlide()
{
	jQuery(".slider_content").fadeOut();
}
var menu_position = null;
var dragging = false;
jQuery(document).ready(function($){
	//mobile devices touchend fix
	$("body").on("touchmove", function(){
		  dragging = true;
	});
	$("body").on("touchstart", function(){
		dragging = false;
	});
	//mobile menu
	$(".mobile-menu-switch").on("click", function(event){
		event.preventDefault();
		if(!$(".mobile-menu-container nav.mobile-menu").is(":animated"))
		{
			$(this).toggleClass("mm-opened");
			$(".mobile-menu-container nav.mobile-menu").slideToggle(200);
		}
	});
	$(".collapsible-mobile-submenus .template-arrow-menu").on("click", function(event){
		event.preventDefault();
		$(this).next().slideToggle(300);
		$(this).toggleClass("template-arrow-expanded");
	});
	
	//home slider
	$("rs-module").each(function(){
		var self = $(this);
		if(self.parent().parent().hasClass("gb-navigation"))
		{
			self.on("revolution.slide.onloaded", function(e){
				var sliderLength = self.revmaxslide();
				var parentUl = $(this).find("rs-slides").first();
				if(parentUl.children().length>1)
				{
					var expando = gbUniqueId();//$(this).get(0)[jQuery.expando];
					self.data("expando", expando);
					var sliderConrolContainer = $("<div class='slider-navigation-container'>");
					var sliderControl = $("<ul class='slider-navigation' id='slider-navigation-" + expando + "'>");
					sliderControl.append("<li class='slider-bar' style='width:" + (100/sliderLength) + "%;'></li>");
					parentUl.children().each(function(index){
						$(this).attr("id", "slide-" + expando + "-" + index);
						sliderControl.append($("<li class='slider-control' style='width:" + (100/sliderLength) + "%;'></li>"));
					});
					sliderConrolContainer.append(sliderControl);
					sliderControl.before("<div class='navigation-prefix'>01</div>");
					sliderControl.after("<div class='navigation-suffix'>" + sliderLength.toString().padStart(2, "0") + "</div>");
					var home_slider_widgets = $(this).closest(".vc_row").next(".vc_row").children().children().children(".for-home-slider").first();
					if(home_slider_widgets.length)
						home_slider_widgets.prepend(sliderConrolContainer);
					else
						$(this).closest(".wpb_wrapper").after(sliderConrolContainer);
				}
			});
			self.on("revolution.slide.onbeforeswap", function(e, data){
				var currentWidth = 100/self.revmaxslide()*(data.nextslide.index()+1);
				var expando = self.data("expando");//$(this).get(0)[jQuery.expando];
				var easing = "easeInOutCubic";
				var duration = 750;
				jQuery("#slider-navigation-" + expando + " .slider-bar").animate({width: currentWidth + "%"}, parseInt(duration, 10), easing);
			});
		}
	});
	
	//slider
	$(".slider").carouFredSel({
		responsive: true,
		prev: {
			button: '#prev',
			onAfter: onAfterSlide,
			onBefore: onBeforeSlide,
			fx: config.slider_effect,
			easing: config.slider_transition,
			duration: parseInt(config.slider_transition_speed, 10)
		},
		next: {
			button: '#next',
			onAfter: onAfterSlide,
			onBefore: onBeforeSlide,
			fx: config.slider_effect,
			easing: config.slider_transition,
			duration: parseInt(config.slider_transition_speed, 10)
		},
		auto: {
			play: config.slider_autoplay=="true" ? true : false,
			pauseDuration: parseInt(config.slide_interval, 10),
			onAfter: onAfterSlide,
			onBefore: onBeforeSlide,
			fx: config.slider_effect,
			easing: config.slider_transition,
			duration: parseInt(config.slider_transition_speed, 10)
		}
	},
	{
		wrapper: {
			classname: "caroufredsel_wrapper caroufredsel_wrapper_slider"
		}
	});
	
	//active feature item
	$(".feature-item-number.active").each(function(){
		$(this).after($(this).clone().addClass("feature-item-clone"));
	});

	//parallax
	if(!navigator.userAgent.match(/(iPod|iPhone|iPad|Android)/))
	{
		$(".moving-parallax").each(function(){
			$(this).parallax({
				speed: -50
			});
		});
	}
	else
		$(".gb-parallax").addClass("attachment-scroll");
	
	//our-clients
	$(".our-clients-list:not('.type-list')").each(function(index){
		$(this).addClass("gb-preloader_" + index);
		$(".gb-preloader_" + index).imagesLoaded(function(instance){
			var self = $(".gb-preloader_" + index);
			var autoplay = 0;
			var elementClasses = self.attr('class').split(' ');
			for(var i=0; i<elementClasses.length; i++)
			{
				if(elementClasses[i].indexOf('id-')!=-1)
					var id = elementClasses[i].replace('id-', '');
				if(elementClasses[i].indexOf('autoplay-')!=-1)
					var autoplay = elementClasses[i].replace('autoplay-', '');
				if(elementClasses[i].indexOf('pause_on_hover-')!=-1)
					var pause_on_hover = elementClasses[i].replace('pause_on_hover-', '');
				if(elementClasses[i].indexOf('scroll-')!=-1)
					var scroll = elementClasses[i].replace('scroll-', '');
				if(elementClasses[i].indexOf('effect-')!=-1)
					var effect = elementClasses[i].replace('effect-', '');
				if(elementClasses[i].indexOf('easing-')!=-1)
					var easing = elementClasses[i].replace('easing-', '');
				if(elementClasses[i].indexOf('duration-')!=-1)
					var duration = elementClasses[i].replace('duration-', '');
			}
			self.carouFredSel({
				items: {
					start: 0
				},
				scroll: {
					items: parseInt(scroll, 10),
					//items: ($(".header").width()>750 ? 5 : ($(".header").width()>462 ? 4 : ($(".header").width()>300 ? 3 : 2))),
					fx: effect,
					easing: easing,
					duration: parseInt(duration, 10),
					pauseOnHover: (parseInt(pause_on_hover, 10) ? true : false)
				},
				prev: {
					items: parseInt(scroll, 10),
					button: $('#' + id + '_prev'),
					fx: effect,
					easing: easing,
					duration: parseInt(duration, 10)
				},
				next: {
					items: parseInt(scroll, 10),
					button: $('#' + id + '_next'),
					fx: effect,
					easing: easing,
					duration: parseInt(duration, 10)
				},
				auto: {
					items: parseInt(scroll, 10),
					play: (parseInt(autoplay, 10) ? true : false),
					fx: effect,
					easing: easing,
					duration: parseInt(duration, 10),
					pauseOnHover: (parseInt(pause_on_hover, 10) ? true : false)
				}
			},
			{
				wrapper: {
					classname: "caroufredsel_wrapper"
				}
			});
		});
	});
	
	//horizontal carousel
	$(".horizontal-carousel").each(function(index){
		$(this).addClass("gb-preloader-hr-carousel_" + index);
		$(".gb-preloader-hr-carousel_" + index).imagesLoaded(function(instance){
			var self = $(".gb-preloader-hr-carousel_" + index);
			var elementClasses = self.attr('class').split(' ');
			var count = self.children().length;
			for(var i=0; i<elementClasses.length; i++)
			{
				if(elementClasses[i].indexOf('id-')!=-1)
					var id = elementClasses[i].replace('id-', '');
				if(elementClasses[i].indexOf('autoplay-')!=-1)
					var autoplay = elementClasses[i].replace('autoplay-', '');
				if(elementClasses[i].indexOf('pause_on_hover-')!=-1)
					var pause_on_hover = elementClasses[i].replace('pause_on_hover-', '');
				if(elementClasses[i].indexOf('scroll-')!=-1)
					var scroll = elementClasses[i].replace('scroll-', '');
				if(elementClasses[i].indexOf('effect-')!=-1)
					var effect = elementClasses[i].replace('effect-', '');
				if(elementClasses[i].indexOf('easing-')!=-1)
					var easing = elementClasses[i].replace('easing-', '');
				if(elementClasses[i].indexOf('duration-')!=-1)
					var duration = elementClasses[i].replace('duration-', '');
				/*if(elementClasses[i].indexOf('threshold-')!=-1)
					var threshold = elementClasses[i].replace('threshold-', '');*/
			}

			var carouselOptions = {
				direction: "left",
				items: {
					start: 0,
					visible: ($(".header").width()>750 ? (self.hasClass("testimonials") ? 1 : (self.hasClass("gallery-3-columns") || self.hasClass("timeline-carousel") ? 3 : (self.hasClass("gallery-2-columns") ? 2: 4))) : ($(".header").width()>462 ? (self.hasClass("testimonials") ? 1 : (self.hasClass("gallery-2-columns") ? 2 : 3)) : 1))
				},
				prev: {
					items: parseInt(scroll),
					button: $('#' + id + '_prev'),
					fx: effect,
					easing: easing,
					duration: parseInt(duration)
				},
				next: {
					items: parseInt(scroll),
					button: $('#' + id + '_next'),
					fx: effect,
					easing: easing,
					duration: parseInt(duration)
				},
				auto: {
					items: parseInt(scroll),
					play: (parseInt(autoplay) ? true : false),
					fx: effect,
					easing: easing,
					duration: parseInt(duration),
					pauseOnHover: (parseInt(pause_on_hover) ? true : false)
				}
			};
			/*if(self.hasClass('ontouch') || self.hasClass('onmouse'))
				carouselOptions.swipe = {
					items: parseInt(scroll),
					onTouch: (self.hasClass('ontouch') ? true : false),
					onMouse: (self.hasClass('onmouse') ? true : false),
					options: {
						allowPageScroll: "none",
						threshold: parseInt(threshold)
					},
					fx: effect,
					easing: easing,
					duration: parseInt(duration)
				};*/
			self.carouFredSel(carouselOptions, {wrapper: {classname: "caroufredsel_wrapper" + (self.hasClass("testimonials") ? " caroufredsel-wrapper-testimonials" : (self.hasClass("timeline-carousel") ? " caroufredsel-wrapper-timeline" : ""))}});
		});
	});
	
	//counters
	var counters = function()
	{
		$(".counters-group").each(function(){
			var groupHeight = $(this).height();
			var topValue = 0, currentValue = 0;
			var counterBoxes = $(this).find(".group-counter-box")
			counterBoxes.each(function(index){
				var self = $(this);
				if(self.find("[data-value]").length)
				{
					currentValue = parseInt(self.find("[data-value]").data("value").toString().replace(" ",""), 10);
					if(currentValue>topValue)
						topValue = currentValue;
				}
			});
			var height = 83/groupHeight*100; //var height = 0/groupHeight*100;
			counterBoxes.each(function(index){
				var self = $(this);
				currentValue = parseInt(self.find("[data-value]").data("value").toString().replace(" ",""), 10);
				height = 83*(1-currentValue/topValue)/groupHeight*100; //height = 0*(1-currentValue/topValue)/groupHeight*100;
				self.find(".progress-container").css("height", "calc(" + (currentValue/topValue*100+height) + "%" + " - 10px)");
			});
		});
		$(".counter-box:not('.group-counter-box')").each(function(){
			var value = $(this).find("[data-value]");
			if(value.length)
				$(this).find(".progress-container").css("height", "calc(" + value.data("value").toString().replace(" ","") + "%" + " - 10px)");
		});
	}
	counters();
	
	//training_classes
	$(".accordion").each(function(){
		var active_tab = !isNaN(jQuery(this).data('active-tab')) && parseInt(jQuery(this).data('active-tab')) >  0 ? parseInt(jQuery(this).data('active-tab'))-1 : false,
		collapsible =  (active_tab===false ? true : false);
		$(this).accordion({
			event: 'change',
			heightStyle: 'content',
			icons: false,
			active: active_tab,
			collapsible: collapsible,
			create: function(event, ui){
				$(window).trigger('resize');
			}
		});
	});
	$(".accordion.classes-accordion").on("accordionactivate", function(event, ui){
		$(window).trigger("refresh");
		var offsetFix = ($(".header-container.sticky").outerHeight()!=null ? $(".header-container.sticky").outerHeight() : 0);
		$("html, body").animate({scrollTop: $("#"+$(ui.newHeader).attr("id")).offset().top-offsetFix}, 400);
	});
	$(".tabs").tabs({
		event: 'change',
		create: function(){
			$("html, body").scrollTop(0);
		},
		activate: function(event, ui){
			$(window).trigger("scroll");
		}
	});
	
	$(".gallery-box, .image-box").on("click touchend", function(event){
		if(dragging)
			return;
		var target = $(event.target);
		if(target.is(".controls [class*='template']"))
			return;
		var details = $(this).find('.open-details');
		var secondary;
		secondary = $(this).find('.open-lightbox,.open-video-lightbox,.open-iframe-lightbox,.open-url-lightbox');
		
		if( !target.is(details) &&
			!target.is(secondary) )
		{
			if(details.attr('href')!==undefined) {					
				details[0].click();
			} else if(secondary.attr('href')!==undefined) {
				secondary[0].click();
			}
		}
	});
	
	//browser history
	$(".tabs .ui-tabs-nav a").on("click", function(){
		if($(this).attr("href").substr(0,4)!="http")
		{
			if($(this).attr("href")==$(location).attr('hash'))
				return;
			$.bbq.pushState($(this).attr("href"));
		}
		else
			window.location.href = $(this).attr("href");
	});
	$(".ui-accordion .ui-accordion-header").on("click", function(){
		$.bbq.pushState("#" + $(this).attr("id").replace("accordion-", ""));
	});
	
	//tabs box navigation
	$(".tabs-box-navigation").mouseover(function(){
		$(this).find("ul").removeClass("tabs-box-navigation-hidden");
	});
	$(".tabs-box-navigation a").on("click", function(){
		$(".tabs-box-navigation-selected .selected").removeClass("selected");
		$(this).parent().addClass("selected");
		$(this).parent().parent().parent().children('span').text($(this).text());
		$(this).parent().parent().addClass("tabs-box-navigation-hidden");
	});
	
	$(".scroll-to-comments").on("click", function(event){
		event.preventDefault();
		var offset = $("#comments-list").offset();
		if(typeof(offset)!="undefined")
			$("html, body").animate({scrollTop: offset.top-90}, 400);
	});
	$(".scroll-to-comment-form").on("click", function(event){
		event.preventDefault();
		var offset = $("#comment-form").offset();
		if(typeof(offset)!="undefined")
			$("html, body").animate({scrollTop: offset.top-90}, 400);
	});
	
	//hashchange
	$(window).on("hashchange", function(event){
		var hashSplit = $.param.fragment().split("-");
		if(hashSplit[0].substr(0,7)!="filter" && hashSplit[0].substr(0,4)!="page")
		{
			$('.ui-accordion .ui-accordion-header#accordion-' + decodeURIComponent($.param.fragment())).trigger("change");
			$(".tabs-box-navigation a[href='#" + decodeURIComponent($.param.fragment()) + "']").trigger("click");
			var hashString = "";
			for(var i=0; i<hashSplit.length-1; i++)
				hashString = hashString + hashSplit[i] + (i+1<hashSplit.length-1 ? "-" : "");
			$('.ui-accordion .ui-accordion-header#accordion-' + decodeURIComponent(hashString)).trigger("change");
		}
		$('.tabs .ui-tabs-nav [href="#' + decodeURIComponent($.param.fragment()) + '"]').trigger("change");
		
		// get options object from hash
		var hashOptions = $.deparam.fragment();
		if(hashSplit[0].substr(0,7)=="filter")
		{
			var filterClass = decodeURIComponent($.param.fragment()).substr(7, decodeURIComponent($.param.fragment()).length);
			// apply options from hash
			$(".isotope-filters a").removeClass("selected");
			if($('.isotope-filters a[href="#filter-' + filterClass + '"]').length)
				$('.isotope-filters a[href="#filter-' + filterClass + '"]').addClass("selected");
			else
				$(".isotope-filters li:first a").addClass("selected");
			
			$(".gb-gallery:not('.horizontal-carousel, .no-isotope')").isotope({filter: (filterClass!="*" ? "." : "") + filterClass, originLeft: true});
			//$(".timetable_isotope").isotope(hashOptions);
		}
		
		if(hashSplit[0].substr(0,7)=="comment")
		{
			if($(location.hash).length)
			{
				var offset = $(location.hash).offset();
				$("html, body").animate({scrollTop: offset.top-90}, 400);
			}
		}
		if(hashSplit[0]=="comments")
		{
			$(".single .scroll-to-comments").trigger("click");
		}
		if(hashSplit[0].substr(0,4)=="page")
		{
			if(parseInt($("#comment-form [name='prevent_scroll']").val(), 10)==1)
			{
				$("#comment-form [name='prevent_scroll']").val(0);
				$("#comment-form [name='paged']").val(parseInt(location.hash.substr(6), 10));
			}
			else
			{
				$.ajax({
					url: config.ajaxurl,
					data: "action=theme_get_comments&post_id=" + $("#comment-form [name='post_id']").val() + "&post_type=" + $("#comment-form [name='post_type']").val() + "&paged="+parseInt(location.hash.substr(6), 10),
					type: "get",
					dataType: "json",
					success: function(json){
						if(typeof(json.html)!="undefined")
						{
							$(".comments-list-container").html(json.html);
							$("abbr.timeago").timeago();
						}
						var hashSplit = location.hash.split("/");
						var offset = null;
						if(hashSplit.length==2 && hashSplit[1]!="")
							offset = $("#" + hashSplit[1]).offset();
						else
							offset = $(".comments-list-container").offset();
						if(offset!=null)
							$("html, body").animate({scrollTop: offset.top-90}, 400);
						$("#comment-form [name='paged']").val(parseInt(location.hash.substr(6), 10));
					}
				});
				return;
			}
		}
		
		//open gallery details
		if(location.hash.substr(1,21)=="gallery-details-close" || hashSplit[0].substr(0,7)=="filter")
		{
			$(".gallery-item-details-list").animate({height:'0'},{duration:200,easing:'easeOutQuint', complete:function(){
				$(this).css("display", "none")
				$(".gallery-item-details-list .gallery-item-details").css("display", "none");
			}
			});
		}
		else if(location.hash.substr(1,15)=="gallery-details")
		{
			var detailsBlock = $('[id="' + location.hash.substr(1) + '"]');
			$(".gallery-item-details-list .gallery-item-details").css("display", "none");
			detailsBlock.css("display", "block");
			var galleryItem = $('[id="gallery-item-' + location.hash.substr(17) + '"]');
			detailsBlock.find(".prev").attr("href", (galleryItem.prevAll(":not('.isotope-hidden')").first().length ? galleryItem.prevAll(":not('.isotope-hidden')").first().find(".open-details").attr("href") : galleryItem.parent().children(":not('.isotope-hidden')").last().find(".open-details").attr("href")));
			detailsBlock.find(".next").attr("href", (galleryItem.nextAll(":not('.isotope-hidden')").first().length ? galleryItem.nextAll(":not('.isotope-hidden')").first().find(".open-details").attr("href") : galleryItem.parent().children(":not('.isotope-hidden')").first().find(".open-details").attr("href")));
			var visible=parseInt($(".gallery-item-details-list").height(), 10)==0 ? false : true;
			var galleryItemDetailsOffset;
			if(!visible)
			{
				$(".gallery-item-details-list").css("display", "block").animate({height:detailsBlock.height()}, 500, 'easeOutQuint', function(){
					$(this).css("height", "100%");
					$(window).trigger("resize");
				});
				galleryItemDetailsOffset = $(".gallery-item-details-list").offset();
				if(typeof(galleryItemDetailsOffset)!="undefined")
				{
					var desktop = ($(".header").width()>750 ? 1 : 0);
					var mobiles = ($(".header").width()>462 ? 0 : 1);
					var offsetFix = (!mobiles ? $(".header-container.sticky").outerHeight()+(desktop ? 50 : 35) : (desktop ? 50 : 35));
					$("html, body").animate({scrollTop: galleryItemDetailsOffset.top-offsetFix}, 400);
				}
			}
			else
			{
				galleryItemDetailsOffset = $(".gallery-item-details-list").offset();
				if(typeof(galleryItemDetailsOffset)!="undefined")
				{
					var desktop = ($(".header").width()>750 ? 1 : 0);
					var mobiles = ($(".header").width()>462 ? 0 : 1);
					var offsetFix = (!mobiles ? $(".header-container.sticky").outerHeight()+(desktop ? 50 : 35) : (desktop ? 50 : 35));
					$("html, body").animate({scrollTop: galleryItemDetailsOffset.top-offsetFix}, 400);
				}
				$(window).trigger("resize");
			}
		}
	}).trigger("hashchange");
	
	//timeago
	/*uncomment and configure timeago strings below if you need
	jQuery.timeago.settings.strings = {
	  prefixAgo: null,
	  prefixFromNow: null,
	  suffixAgo: "ago",
	  suffixFromNow: "from now",
	  seconds: "less than a minute",
	  minute: "about a minute",
	  minutes: "%d minutes",
	  hour: "about an hour",
	  hours: "about %d hours",
	  day: "a day",
	  days: "%d days",
	  month: "about a month",
	  months: "%d months",
	  year: "about a year",
	  years: "%d years",
	  wordSeparator: " ",
	  numbers: []
	};*/
	//$("abbr.timeago").timeago();
	
	//footer recent posts, most commented, most viewed, upcoming classes
	$(".upcoming-classes, .scrolling-list").carouFredSel({
		direction: "up",
		scroll: {
			items: 1,
			easing: "swing",
			pauseOnHover: true,
			height: "variable"
		},
		auto: {
			play: false
		},
		prev: {
			button: function() {
				return $(this).parent().parent().parent().find('.scrolling-list-control-left');
			}
		},
		next: {
			button: function() {
				return $(this).parent().parent().parent().find('.scrolling-list-control-right');
			}
		}
	});
	$(".upcoming-classes").trigger("configuration", {
		items: {
			visible: ($(".upcoming-classes").children().length>2 ? 3 : $(".upcoming-classes").children().length)
		}
	});
	$(".scrolling-list").each(function(){
		var elementClasses = $(this).attr('class').split(' ');
		var visible = 3;
		for(var i=0; i<elementClasses.length; i++)
		{
			if(elementClasses[i].indexOf('visible-')!=-1)
			{
				visible = elementClasses[i].replace('visible-', '');
				break;
			}
		}
		$(this).trigger("configuration", {
			items: {
				visible: ($(this).children().length>2 ? parseInt(visible, 10) : $(this).children().length)
			}
		});
	});
	
	function windowResize()
	{
		$(".accordion").each(function(){
			var $this = $(this);
			if($this.hasClass("ui-accordion")) {
				$this.accordion("refresh");
			}
		});
		$(".slider").trigger('configuration', ['debug', false, true]);
		$(".latest_tweets, .most_commented, .most_viewed, .upcoming-classes, .scrolling-list, .our-clients-list:not('.type-list')").trigger('configuration', ['debug', false, true]);
		$(".horizontal-carousel").each(function(){
			var self = $(this);
			self.trigger("configuration", {
				items: {
					visible: ($(".header").width()>750 ? (self.hasClass("testimonials") ? 1 : (self.hasClass("gallery-3-columns") || self.hasClass("timeline-carousel") ? 3 : (self.hasClass("gallery-2-columns") ? 2: 4))) : ($(".header").width()>462 ? (self.hasClass("testimonials") ? 1 : (self.hasClass("gallery-2-columns") ? 2 : 3)) : 1))
				}
			});
		});
		//isotope
		$(".gb-gallery:not('.horizontal-carousel, .no-isotope')").each(function(index){
			$(this).isotope('layout');
		});
		if($(".sticky").length)
		{
			if($(".header-container").hasClass("sticky"))
				menu_position = ($(".header-container.sticky").length>0 ? $(".header-container.sticky").offset().top : null );
			var topOfWindow = $(window).scrollTop();
			if(menu_position!=null && $(".header-container .sf-menu").is(":visible"))
			{
				if(menu_position<topOfWindow)
				{
					if(!$("#gb-sticky-clone").length)
					{
						$(".header-container").after($(".header-container").clone().attr("id", "gb-sticky-clone").addClass("move"));
						$(".header-container").addClass("transition");
						setTimeout(function(){
							$("#gb-sticky-clone").addClass("transition");
						}, 1);
					}
				}
				else
				{
					$(".header-container").removeClass("transition");
					$("#gb-sticky-clone").remove();
				}
			}
			else
				$("#gb-sticky-clone").remove();
		}
	}
	//window resize
	$(window).resize(windowResize);
	window.addEventListener('orientationchange', windowResize);
	
	//scroll top
	$("a[href='#top']").on("click", function() {
		$("html, body").animate({scrollTop: 0}, "slow");
		return false;
	});
	
	//feature-item
	$(".feature-item-clickable-box[data-url]").on("click", function() {
		window.location.href = $(this).data("url");
		return false;
	});
	
	//hint
	$(".search input[type='text'], .comment_form input[type='text'], .comment_form textarea, .contact_form input[type='text'], .contact_form textarea, .comment-form-comment textarea,.woocommerce .widget_product_search form .search-field").hint();
	
	//tooltip
	$(".tooltip").on("mouseover click", function(){
		var position = $(this).position();
		var tooltip_text = $(this).children(".tooltip-text");
		tooltip_text.css("width", $(this).outerWidth() + "px");
		tooltip_text.css("height", tooltip_text.height() + "px");
		tooltip_text.css({"top": position.top-tooltip_text.innerHeight() + "px", "left": position.left + "px"});
	});
	
	//isotope
	$(".gb-gallery:not('.horizontal-carousel, .no-isotope')").each(function(index){
		var self = $(this);
		self.isotope({
			layoutMode: 'fitRows',
			fitRows: {
				gutter: self.hasClass("layout-type-separate") ? 30 : 0
			}
		});
		// layout Isotope after each image loads
		self.imagesLoaded().progress(function(){
			self.isotope('layout');
		});
	});
	
	//fancybox
	$(".gb-lightbox a, .fancybox, .fancybox-video, .fancybox-iframe").prettyPhoto({
		slideshow: 3000,
		overlay_gallery: true,
		opacity: 0.9,
		social_tools: '',
		deeplinking: false,
		default_width: "800",
		default_height: "600"
	});
	$(".fancybox[rel]").prettyPhoto({
		show_title: false,
		slideshow: 3000,
		overlay_gallery: true,
		opacity: 0.9,
		social_tools: '',
		deeplinking: false
	});
	/*$(".fancybox").attr("rel", "gallery");
	$(".fancybox").fancybox({
		'speedIn': 600, 
		'speedOut': 200,
		'transitionIn': 'elastic'
	});
	$(".fancybox-video").bind('click',function() 
	{
		$.fancybox(
		{
			'autoScale':false,
			'speedIn': 600, 
			'speedOut': 200,
			'transitionIn': 'elastic',
			'width':(this.href.indexOf("vimeo")!=-1 ? 600 : 680),
			'height':(this.href.indexOf("vimeo")!=-1 ? 338 : 495),
			'href':(this.href.indexOf("vimeo")!=-1 ? this.href : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/')),
			'type':(this.href.indexOf("vimeo")!=-1 ? 'iframe' : 'swf'),
			'swf':
			{
				'wmode':'transparent',
				'allowfullscreen':'true'
			}
		});
		return false;
	});
	$(".fancybox-iframe").fancybox({
		'speedIn': 600, 
		'speedOut': 200,
		'transitionIn': 'elastic',
		'width' : '75%',
		'height' : '75%',
		'autoScale' : false,
		'titleShow': false,
		'type' : 'iframe'
	});*/
	
	//comment form
	if($(".gb-comment-form").length)
	{
		$(".gb-comment-form").each(function(){
			var self = $(this);
			self[0].reset();
			self.find(".submit-comment-form").on("click", function(event){
				event.preventDefault();
				self.submit();
			});
		});
	}
	
	$(".prevent-submit").on("submit", function(event){
		event.preventDefault();
		return false;
	});
	//contact form
	if($(".gb-contact-form").length)
	{
		$(".gb-contact-form").each(function(){
			var self = $(this);
			self[0].reset();
			self.find("input[type='hidden']").each(function(){
				if(typeof($(this).data("default"))!="undefined")
					$(this).val($(this).data("default"));
			});
			self.find(".submit-contact-form").on("click", function(event){
				event.preventDefault();
				self.submit();
			});
		});
	}
	$(".gb-comment-form:not('#commentform'):not('.prevent-submit'), .gb-contact-form:not('.prevent-submit')").on("submit", function(event){
		event.preventDefault();
		var data = $(this).serializeArray();
		var self = $(this);
		var id = $(this).attr("id");
		$("#"+id+" [type='checkbox']:not(:checked)").each(function(){
			data.push({name: $(this).attr("name"), value: 0});
		});
		if(parseInt($("#"+id+" [name='name']").data("required"), 10))
			data.push({name: 'name_required', value: 1});
		if(parseInt($("#"+id+" [name='email']").data("required"), 10))
			data.push({name: 'email_required', value: 1});
		if(parseInt($("#"+id+" [name='website']").data("required"), 10))
			data.push({name: 'website_required', value: 1});
		if(parseInt($("#"+id+" [name='message']").data("required"), 10))
			data.push({name: 'message_required', value: 1});
		$("#"+id+" .gb-block:not('.textarea-block')").block({
			message: false,
			overlayCSS: {
				"opacity": "0.3",
				"backgroundColor": "#222224",
				"width": "calc(100% - 2px)",
				"height": "calc(100% - 1px)", 
				"left": "1px",
			}
		});
		$("#"+id+" .textarea-block").block({
			message: false,
			overlayCSS: {
				"opacity": "0.3",
				"backgroundColor": "#222224",
				"width": "calc(100% - 2px)",
				"height": "calc(100% - 9px)", 
				"left": "1px",
			}
		});
		$("#"+id+" .submit-contact-form, #"+id+" .submit-comment-form").off("click");
		$("#"+id+" .submit-contact-form, #"+id+" .submit-comment-form").on("click", function(event){
			event.preventDefault();
		});
		$.ajax({
			url: config.ajaxurl,
			data: data,
			type: "post",
			dataType: "json",
			success: function(json){
				$("#"+id+" .submit-contact-form, #"+id+" .submit-comment-form, #"+id+" [name='name'], #"+id+" [name='email'], #"+id+" [name='website'], #"+id+" [name='message'], #"+id+" .g-recaptcha, #"+id+"terms").qtip('destroy');
				if(typeof(json.isOk)!="undefined" && json.isOk)
				{
					if(typeof(json.submit_message)!="undefined" && json.submit_message!="")
					{
						$("#"+id+" .submit-contact-form, #"+id+" .submit-comment-form").qtip(
						{
							style: {
								classes: 'ui-tooltip-success'
							},
							content: { 
								text: json.submit_message 
							},
							hide: false,
							position: { 
								my: "right center",
								at: "left center" 
							}
						}).qtip('show');
						//close tooltip after 5 sec
						setTimeout(function(){
							$("#"+id+" .submit-contact-form, #"+id+" .submit-comment-form").qtip("api").hide();
						}, 5000);
						if(id=="comment-form" && typeof(json.html)!="undefined")
						{
							$(".comments-list-container").html(json.html);
							$("#comment-form [name='comment_parent_id']").val(0);
							if(typeof(json.comment_id)!="undefined")
							{
								var offset = $("#comment-" + json.comment_id).offset();
								if(typeof(offset)!="undefined")
									$("html, body").animate({scrollTop: offset.top-90}, 400);
								if(typeof(json.change_url)!="undefined" && $.param.fragment()!=json.change_url.replace("#", ""))
									$("#comment-form [name='prevent_scroll']").val(1);
							}
							if(typeof(json.change_url)!="undefined" && $.param.fragment()!=json.change_url.replace("#", ""))
								$.bbq.pushState(json.change_url);
								//window.location.href = json.change_url;
						}
						$("#"+id)[0].reset();
						if(typeof(grecaptcha)!="undefined")
							grecaptcha.reset();
						$("#cancel-comment").css("display", "none");
					}
				}
				else
				{
					if(typeof(json.submit_message)!="undefined" && json.submit_message!="")
					{
						$("#"+id+" .submit-contact-form, #"+id+" .submit-comment-form").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.submit_message 
							},
							position: { 
								my: "right center",
								at: "left center" 
							}
						}).qtip('show');
						if(typeof(grecaptcha)!="undefined" && grecaptcha.getResponse()!="")
							grecaptcha.reset();
					}
					if(typeof(json.error_name)!="undefined" && json.error_name!="")
					{
						$("#"+id+" [name='name']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_name 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_email)!="undefined" && json.error_email!="")
					{
						$("#"+id+" [name='email']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_email 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_website)!="undefined" && json.error_website!="")
					{
						$("#"+id+" [name='website']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_website 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_message)!="undefined" && json.error_message!="")
					{
						$("#"+id+" [name='message']").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_message 
							},
							position: { 
								my: "bottom center",
								at: "top center" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_captcha)!="undefined" && json.error_captcha!="")
					{
						$("#"+id+" .g-recaptcha").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_captcha 
							},
							position: { 
								my: "bottom left",
								at: "top left" 
							}
						}).qtip('show');
					}
					if(typeof(json.error_terms)!="undefined" && json.error_terms!="")
					{
						$("#"+id+"terms").qtip(
						{
							style: {
								classes: 'ui-tooltip-error'
							},
							content: { 
								text: json.error_terms 
							},
							position: { 
								my: "bottom left",
								at: "top left"
							}
						}).qtip('show');
					}
				}
				$("#"+id+" .gb-block").unblock();
				$("#"+id+" .submit-contact-form, #"+id+" .submit-comment-form").on("click", function(event){
					event.preventDefault();
					$("#"+id).submit();
				});
			}
		});
	});
	$(document.body).on("click", ".comments-list-container .reply-button", function(event){
		event.preventDefault();
		var offset = $("#comment-form").offset();
		$("html, body").animate({scrollTop: offset.top-90}, 400);
		$("#comment-form [name='comment_parent_id']").val($(this).attr("href").substr(1));
		$("#cancel-comment").css('display', 'inline-block');
	});
	$(document.body).on("click", "#cancel-comment", function(event){
		event.preventDefault();
		$(this).css('display', 'none');
		$("#comment-form [name='comment_parent_id']").val(0);
	});
	if($(".header-container").hasClass("sticky"))
		menu_position = ($(".header-container.sticky").length>0 ? $(".header-container.sticky").offset().top : null );
	function animateElements()
	{
		$('.animated-element, .sticky, .gb-smart-column').each(function(){
			var elementPos = $(this).offset().top;
			var topOfWindow = $(window).scrollTop();
			var animationStart = (typeof($(this).data("animation-start"))!="undefined" ? parseInt($(this).data("animation-start"), 10) : 0);
			if($(this).hasClass("gb-smart-column"))
			{
				var row = $(this).parent();
				var wrapper = $(this).children().first();
				var childrenHeight = 0;
				wrapper.children().each(function(){
					childrenHeight += $(this).outerHeight(true);
				});
				if(childrenHeight<$(window).height() && row.offset().top-20<topOfWindow && row.offset().top-20+row.outerHeight()-childrenHeight>topOfWindow)
				{
					wrapper.css({"position": "fixed", "bottom": "auto", "top": "20px", "width": $(this).width() + "px"});
					$(this).css({"height": childrenHeight+"px"});
				}
				else if(childrenHeight<$(window).height() && row.offset().top-20+row.outerHeight()-childrenHeight<=topOfWindow && (row.outerHeight()-childrenHeight>0))
				{
					wrapper.css({"position": "absolute", "bottom": "0", "top": (row.outerHeight()-childrenHeight) + "px", "width": "auto"});
					$(this).css({"height": childrenHeight+"px"});
				}
				else if(childrenHeight>=$(window).height() && row.offset().top+20+childrenHeight<topOfWindow+$(window).height() && row.offset().top+20+row.outerHeight()>topOfWindow+$(window).height())
				{	
					wrapper.css({"position": "fixed", "bottom": "20px", "top": "auto", "width": $(this).width() + "px"});
					$(this).css({"height": childrenHeight+"px"});
				}
				else if(childrenHeight>=$(window).height() && row.offset().top+20+row.outerHeight()<=topOfWindow+$(window).height() && (row.outerHeight()-childrenHeight>0))
				{
					wrapper.css({"position": "absolute", "bottom": "0", "top": (row.outerHeight()-childrenHeight) + "px", "width": "auto"});
					$(this).css({"height": childrenHeight+"px"});
				}
				else
				{
					wrapper.css({"position": "static", "bottom": "auto", "top": "auto", "width": "auto"});
					
				}
			}
			else if($(this).hasClass("sticky"))
			{
				if(menu_position!=null && $(".header-container .sf-menu").is(":visible"))
				{
					if(menu_position<topOfWindow)
					{
						//$(this).addClass("move");
						if(!$("#gb-sticky-clone").length)
						{
							$(this).after($(this).clone().attr("id", "gb-sticky-clone").addClass("move"));
							$(this).addClass("transition");
							setTimeout(function(){
								$("#gb-sticky-clone").addClass("transition");
							}, 1);
						}
							
					}
					else
					{
						//$(this).removeClass("move");
						$(this).removeClass("transition");
						$("#gb-sticky-clone").remove();
					}
				}
			}
			else if(elementPos<topOfWindow+$(window).height()-20-animationStart) 
			{
				if($(this).hasClass("number") && !$(this).hasClass("progress") && $(this).is(":visible"))
				{
					var self = $(this);
					self.addClass("progress");
					if(typeof(self.data("value"))!="undefined")
					{
						var value = parseFloat(self.data("value").toString().replace(" ",""));
						self.text(0);
						self.text(value);
					}
				}
				else if($(this).hasClass("counter-box-path") && !$(this).hasClass("progress") && $(this).is(":visible"))
				{
					var self = $(this);
					self.addClass("progress");
					var dashoffset = self.data("dashoffset");
					self.animate({
						"stroke-dashoffset": dashoffset
					}, 2000, "easeInOutQuad");
				}
				else if(!$(this).hasClass("progress"))
				{
					var elementClasses = $(this).attr('class').split(' ');
					var animation = "fadeIn";
					var duration = 600;
					var delay = 0;
					if($(this).hasClass("scroll-top"))
					{
						var height = ($(window).height()>$(document).height()/2 ? $(window).height()/2 : $(document).height()/2);
						if(topOfWindow+80<height)
						{
							if($(this).hasClass("fadeIn") || $(this).hasClass("fadeOut"))
								animation = "fadeOut";
							else
								animation = "";
							$(this).removeClass("fadeIn")
						}
						else
							$(this).removeClass("fadeOut")
					}
					for(var i=0; i<elementClasses.length; i++)
					{
						if(elementClasses[i].indexOf('animation-')!=-1)
							animation = elementClasses[i].replace('animation-', '');
						if(elementClasses[i].indexOf('duration-')!=-1)
							duration = elementClasses[i].replace('duration-', '');
						if(elementClasses[i].indexOf('delay-')!=-1)
							delay = elementClasses[i].replace('delay-', '');
					}
					$(this).addClass(animation);
					$(this).css({"animation-duration": duration + "ms"});
					$(this).css({"animation-delay": delay + "ms"});
					$(this).css({"transition-delay": delay + "ms"});
				}
			}
		});
		$('.box-header.animation-slide, .woocommerce .box-header').each(function(){
			var elementPos = $(this).offset().top;
			var topOfWindow = $(window).scrollTop();
			if(elementPos<topOfWindow+$(window).height()-30) 
			{
				$(this).addClass("slide");
			}
		});
	}
	setTimeout(animateElements, 1);
	$(window).scroll(animateElements);
	
	function refreshGoogleMap() 
	{
		if(typeof(theme_google_maps)!="undefined") 
		{		
			theme_google_maps.forEach(function(elem){
				google.maps.event.trigger(elem.map, "resize");
				elem.map.setCenter(elem.coordinate);
				elem.map.setZoom(elem.map.getZoom());
			});
		}
	}
	refreshGoogleMap();
	$(".accordion").on("accordionactivate", function(event, ui){
		refreshGoogleMap();
	});
	$(".tabs").on("tabsbeforeactivate", function(event, ui){
		refreshGoogleMap();
	});
	//woocommerce
	$(".woocommerce .quantity .plus").on("click", function(){
		var input = $(this).prev();
		input.val(parseInt(input.val(), 10)+1);
		$("input[name='update_cart']").removeAttr("disabled");
	});
	$(".woocommerce .quantity .minus").on("click", function(){
		var input = $(this).next();
		input.val((parseInt(input.val(), 10)-1>0 ? parseInt(input.val(), 10)-1 : 0));
		$("input[name='update_cart']").removeAttr("disabled");
	});
	$(document.body).on("updated_cart_totals", function(){
		$(".woocommerce .quantity .plus").off("click");
		$(".woocommerce .quantity .plus").on("click", function(){
			var input = $(this).prev();
			input.val(parseInt(input.val(), 10)+1);
			$("input[name='update_cart']").removeAttr("disabled");
		});
		$(".woocommerce .quantity .minus").off("click");
		$(".woocommerce .quantity .minus").on("click", function(){
			var input = $(this).next();
			input.val((parseInt(input.val(), 10)-1>0 ? parseInt(input.val(), 10)-1 : 0));
			$("input[name='update_cart']").removeAttr("disabled");
		});
		var sum = 0;
		$(".shop_table.cart .input-text.qty.text").each(function(){
			sum += parseInt($(this).val(), 10);
		});
		if(sum>0)
			$(".cart-items-number").html(sum).removeClass("cart-empty");
	});
	$(document.body).on("added_to_cart", function(event, data){
		var sum = 0;
		$(data["div.widget_shopping_cart_content"]).find(".quantity").each(function(){
			sum += parseInt($(this).html(), 10);
		});
		if(sum>0)
			$(".cart-items-number").html(sum).removeClass("cart-empty");
	});
});