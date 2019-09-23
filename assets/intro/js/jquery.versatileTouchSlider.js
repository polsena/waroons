/*
Versatile Touch Slider - jQuery Plugin - v 1.6
Author: Sergio Valle
http://codecanyon.net/user/srvalle
*/

(function($) {

    $.versatileTouchSlider = function(selector, settings) {
		// settings
		var config = {
			slideWidth: 550, // number or '100%'
			slideHeight: 208, // number or 'auto'
			showPreviousNext: true,
			currentSlide: 0,
			scrollSpeed: 500,
			autoSlide: false,
			autoSlideDelay: 5000,
			showPlayPause: true,
			showPagination: true,
			alignPagination: 'left',
			alignMenu: 'left',
			swipeDrag: true,
			sliderType: 'image_shelf', // image_shelf, image_banner, image_text, image_gallery
			pageStyle: 'numbers', // numbers, bullets, thumbnails
			orientation: 'horizontal', // horizontal, vertical
			onScrollEvent: function() {},
			ajaxEvent: function() {}
		};
		//parameters
		if ( settings ){$.extend(config, settings);}
		
		var slideWidth = config.slideWidth, slideHeight = config.slideHeight, showPreviousNext = config.showPreviousNext, 
			currentSlide = config.currentSlide, scrollSpeed = config.scrollSpeed, autoSlide = config.autoSlide, 
			autoSlideDelay = config.autoSlideDelay, showPlayPause = config.showPlayPause, showPagination = config.showPagination,
			alignPagination = config.alignPagination, alignMenu = config.alignMenu, swipeDrag = config.swipeDrag, sliderType = config.sliderType,
			pageStyle = config.pageStyle, orientation = config.orientation;
		
		var $sti_slider = $(selector + ' .sti_slider'),
			$sti_slide = $(selector + ' .sti_slide'),
			$totalSlides = $sti_slide.length,
			$sti_page = $(selector + ' .sti_page'),
			$sti_control = $(selector + ' .sti_control'),
			$sti_paginate = $(selector + ' .sti_paginate'),
			$sti_menu = $(selector + ' .sti_menu'),
			$sti_items = $(selector + " .sti_items"),
			$prod = $(selector + ' .sti_prod');
		
		var valueGlobal = 0;
		var dragging = false;
		if (navigator.userAgent.match(/msie/i) && navigator.userAgent.match(/7/)) { var is_ie7 = true; }
		if (navigator.userAgent.match(/msie/i) && navigator.userAgent.match(/8/)) { var is_ie8 = true; }
		
		//$sti_slider.find('img.main_image').css( { visibility: 'hidden' } );
		//$sti_slider.find('img.main_image').css( { display: 'none' } );
		$sti_items.show();
		
		
		var suppTrans = supportsTransitions();
		var touchSupport = 'ontouchstart' in window;					
		
		// ------------------------------------------------------------
		// set width / height
		// ------------------------------------------------------------

		var is_100 = false;
		if (slideWidth == '100%') { 
			slideWidth = $(selector).parent().width();
			is_100 = true;
		}	
		
		$(selector).width(slideWidth); //sti_container
		$sti_slider.width(slideWidth);
		$sti_slide.width(slideWidth);
		
		if (slideHeight != 'auto') {
			$sti_slider.height(slideHeight);	
		}
		
		$sti_slide.height(slideHeight);
		
		if (orientation == 'vertical') {
			$sti_slide.css({ float: 'none'});
			$sti_items.css({ width: slideWidth});
		}
		
		
		// ------------------------------------------------------------
		// preload images
		// ------------------------------------------------------------
		
		if ($totalSlides > 0) {
				
			var slideHeightArr = Array();

			if (sliderType == 'image_shelf') { 
				$sti_slider.css({background: '#000 url(img/texture_01_dark.jpg)' });
			}
			if (sliderType == 'image_banner') {
				$sti_slide.css({background: 'none'});
			}
			if (sliderType == 'image_gallery') {
				$sti_slide.css({background: 'none'});
				$sti_slider.css({background: '#fff'});
			}
			
			setTimeout( function() { config.onScrollEvent.call(this, currentSlide) }, scrollSpeed);
			
			$sti_slide.children('img').css({opacity:0})
			$sti_slide.children('.banner_title').hide();
			
			var countSlide = 0;
			var sld = $sti_slide.eq(countSlide);
			var intervalSlide;
			
			function preloadSlide() {
				
				sldNewHeight = ( sld.height() == 0 ) ? 100 : sld.height();
				
				//add icon preload
				$sti_slide.append('<div class="preload_32"></div>');
				$sti_slide.children('.preload_32').css( { 
					left: (sld.width() / 2) - 21, 
					top: (sldNewHeight / 2) - 21
				} );

				if (sliderType == 'image_banner') { 
					$sti_slide.children('.preload_32').css( 
						{ background:'url(img/preload_32.gif) center no-repeat', boxShadow:'none', border:'none' }) 
				}
				if (sliderType == 'image_gallery') { $sti_slide.children('.preload_32').css( { top: 20 }) }

				function nextPreloadSlide() {

					sld.imagesLoaded( function( $images, $proper, $broken ) {
						
						if ($proper.height() != null) {
							
							//console.log( $proper.height() )
							
							$(this).children('.preload_32').remove();
							
							$(this).children('img').css({display:'block', opacity:0}).stop().animate({ opacity:1 }, { duration: 400 });
							$(this).children('.banner_title').css({display:'block', opacity:0}).stop().delay(300).animate({ opacity:.8 }, { duration: 400 });
														
							var firstHeight;
							if (sliderType == 'image_shelf' || sliderType == 'image_text' || sliderType == 'image_gallery') {
								firstHeight = this.height();
								slideHeightArr.push(this.height()); //total slide height (shelf image group)
							} else if (sliderType == 'image_banner') { //&& slideHeight != 'auto'
								firstHeight = slideHeight;
								slideHeightArr.push(slideHeight);
							} else {
								firstHeight = $proper.height();
								slideHeightArr.push($proper.height()); //image only
							}
							
							if (countSlide == 0) {
								//$sti_slider.find('img.main_image').css( { display: 'block' } );
								$sti_slider.stop().animate({ height: firstHeight }, { duration: 600 });
								$(selector).trigger('resize');
								if (autoSlide) initAutoSlide();
							}

							countSlide++;
							sld = $sti_slide.eq(countSlide);
							if (preloadSlideTimeout) clearTimeout(preloadSlideTimeout);
							preloadSlideTimeout = setTimeout(nextPreloadSlide, 100); //500
						}
					});
			
					if (countSlide > $totalSlides-1) {
						clearTimeout(preloadSlideTimeout);
						$(selector + ' .preload_32').remove();
						$sti_slide.children('img').show();
						//$(selector).trigger('resize');					
					}
				}//nextPreloadSlide
			
				preloadSlideTimeout = setTimeout(nextPreloadSlide, 100);
			}//preloadSlide

			var preloadSlideTimeout;
			preloadSlide();
			productsSetup();
			
		} else {
			return false;	
		}
		
		
		// ------------------------------------------------------------
		// products
		// ------------------------------------------------------------
		
		function productsSetup() {
			
			$prod.css({ opacity:0 });			
			var strAppend = '';
			
			for (var i=0; i < $prod.length; i++) {
				//animate
				var p = $prod.eq(i);
				var pLink = $prod.eq(i).children('.link');
				p.stop().delay(140*i).animate({ opacity: 1 }, { duration: 500 } );
				pLink.stop().delay(240*i).animate({ opacity: .8 }, { duration: 1000 } );					
				
				//link mouseover
				pLink.mouseover(function(e) {
					$(this).fadeTo("fast",.5);
					
					//tooltip for mobile device only
					if (touchSupport) {
						var tt = $(this).attr('title');
						if (tt != undefined) {
							$(selector).append('<div class="sti_tooltip">' + tt + '</div>');
							$('.sti_tooltip').css({ 
								top: $(this).offset().top - $('.sti_tooltip').height() - $(this).height() + 7,  
								left: $(this).offset().left - ($('.sti_tooltip').width() / 2) + 4,
								opacity: 0
							});
							$('.sti_tooltip').stop().animate({ opacity: .9 }, { duration: 500 });
						}
					}
				}).mouseout(function() {
					$(this).fadeTo("fast",.8);
					
					if (touchSupport) {
						$('.sti_tooltip').remove();
					}
				});

				
				//shadow/side effects
				var imgHeight = p.children('img').height();
				p.height(imgHeight);
				var imgWidth = p.children('img').width();
				p.width(imgWidth);
				pLink.css({ 
					bottom: (imgHeight/2) - 16, 
					left: (imgWidth/2) - 16  
				});
				
				if (navigator.userAgent.match(/opera/i)) {
					p.css({ 'margin-bottom': -6});
				}
				
				//add effects for thumbnails (shadow and cover light)
				var data_effects = p.attr('data-effects');

				if (data_effects == 'true' || data_effects == undefined) {
					var idShadowFx = $(selector).attr('id') + '_shd_' + i;
					var idLeftsideFx = $(selector).attr('id') + '_leftside_' + i;

					strAppend += '<img class="fx_shadow" id="' + idShadowFx + '" src="img/fx_shadow.png">';
					strAppend += '<img class="fx_leftside" id="' + idLeftsideFx + '" src="img/fx_leftside.png">';
					
					p.append(strAppend);
					strAppend = '';
					
					if (imgHeight != null) {
						$('#'+idShadowFx).height( parseInt(imgHeight) );
						$('#'+idLeftsideFx).height( parseInt(imgHeight) );
					}
				}//if
				
				if (sliderType == 'image_gallery') {
					p.addClass("sti_thumb_gallery");
					var borderWidth = parseInt(p.children('img').css("border-left-width"));
					var paddingWidth = parseInt(p.children('img').css("padding-left"));
					var totalWidth = (paddingWidth*2) + borderWidth;
					//console.log(paddingWidth)
					
					p.children('.ribbon').css({ top: -totalWidth - 6, right: -totalWidth - 6 });
					pLink.css({ 
					   bottom: (imgHeight/2) - 16 + paddingWidth + borderWidth, 
				    	left: (imgWidth/2) - 16 + paddingWidth + borderWidth 
				    });
				}
				
			}//for
		}//productsSetup
	

		// ------------------------------------------------------------
		// nav prev/next, play/pause, pagination
		// ------------------------------------------------------------

		if (showPreviousNext) {
			var idPrev = "prev_" + $(selector).attr('id');
			var idNext = "next_" + $(selector).attr('id');
			$sti_slider.append('<div class="sti_previous" id="' + idPrev + '"></div><div class="sti_next" id="' + idNext + '"></div>');
			
			//prevNextAlign();
			changeStyles(currentSlide);
		}
		
		function prevNextAlign() {
			$('#'+idPrev).css( { top: ($sti_slider.height() - $('#'+idPrev).height()) / 2 } );
			$('#'+idNext).css( { top: ($sti_slider.height() - $('#'+idNext).height()) / 2  } );
		}
		
		if (swipeDrag && !touchSupport) {
			$sti_slider.mouseover(function(e) {
				//grab cursor
				$(this).addClass('grab_cursor');
				
				$(this).mousedown(function() {
					$(this).removeClass('grab_cursor').addClass('grabbing_cursor');
				}).mouseup(function() {
					$(this).removeClass('grabbing_cursor').addClass('grab_cursor');
				});
			}).mouseout(function() {
				$(this).removeClass('grab_cursor');
			});
		}
		
		//play/pause
		var $play = $(selector + ' .sti_control .sti_play');
		var $pause = $(selector + ' .sti_control .sti_pause');
		$pause.hide();
		
		if (!showPlayPause) {
			$sti_control.hide();
		} else {
			if (autoSlide) {
				$pause.show(); 
				$play.hide();
			} else {
				$pause.hide();
				$play.show();
			}
			$sti_control.css("display",'none').fadeTo("slow",1);
		}
		
		//pagination
		if (!showPagination) {
			$sti_page.hide();
			
			//change style in $sti_control
			$sti_control.css({ border:'none', marginLeft:0, paddingLeft:0 });
			$pause.css({ margin:0 });
			$play.css({ margin:0 });
		} else {
		
			//create pages
			var pageAppend = '';
			for (var i=0; i < $totalSlides; i++) {
				
				//if ($totalSlides > 1) {
					if (pageStyle == 'numbers') {
						var num = i+1;
						if (currentSlide == i) {
							pageAppend += '<a href="#" class="sti_btn active">' + num + '</a>';
						} else {
							pageAppend += '<a href="#" class="sti_btn">' + num + '</a>';
						}
					} else if (pageStyle == 'bullets') {
						if (currentSlide == i) {
							pageAppend += '<a href="#" class="bullets_page_active"></a>';
						} else {
							pageAppend += '<a href="#" class="bullets_page"></a>';
						}
					} else if (pageStyle == 'thumbnails') {
						var getImgSrc = $sti_page.children('img').eq(i).attr('src');
											
						if (currentSlide == i) {
							pageAppend += '<a href="#" class="thumbnails_page_active">' + '<img src="' + getImgSrc + '" alt="">' + '</a>';
						} else {
							pageAppend += '<a href="#" class="thumbnails_page">' + '<img src="' + getImgSrc + '" alt="">' + '</a>';
						}					
					}
				//}
			}
			$sti_page.children('img').remove();
			$sti_page.fadeTo("fast",0).append(pageAppend).fadeTo("normal",1);
			
			//pagination align
			alignPaginationConfig();
		}
		
		function alignPaginationConfig() {
			if (alignPagination == 'left') {
				$sti_paginate.css({ float: 'left' });
			} else if (alignPagination == 'right') {
				$sti_paginate.css({ float: 'right' });
			} else {
				$sti_paginate.css({ left: ($sti_slider.width() - $sti_paginate.width()) / 2 });
			}
		}
		

		// ------------------------------------------------------------
		// SWIPE
		// ------------------------------------------------------------
		
		var swipeOptions =
		{
			triggerOnTouchEnd : true,	
			swipeStatus : swipeStatus,
			allowPageScroll: (orientation == 'vertical') ? "horizontal" : "vertical",
			fallbackToMouseEvents: (swipeDrag) ? true : false,
			threshold: 20
		}

		$sti_items.swipe( swipeOptions );

		// ------------------------------------------------------------
		// move > drag the div
		// cancel > animate back
		// end > animate to the next slide
		// ------------------------------------------------------------
				
		function swipeStatus(event, phase, direction, distance) {
		
			if ( phase == "move" && (direction == "left" || direction == "right" || direction == "up" || direction == "down") ) {
				
				dragging = true;
								
				if ($('.sti_tooltip').length > 0) $('.sti_tooltip').remove();
				
				if (orientation == 'vertical' && (direction == "left" || direction == "right")) return false;
				if (orientation == 'horizontal' && (direction == "up" || direction == "down")) return false;
				
				var duration = 0;
				
				if (orientation == 'vertical') {
					var posY = -valueGlobal;
					$sti_items.css({ top:-posY, position: 'absolute' });
				} else {
					var posX = -valueGlobal;
					$sti_items.css({ left:-posX, position: 'absolute' });
				}
				
				if (direction == "left") {
					scrollSlides((slideWidth * currentSlide) + distance, duration);
				} else if (direction == "right") {
					scrollSlides((slideWidth * currentSlide) - distance, duration);
				} else if (direction == "up") {
					scrollSlides((slideHeight * currentSlide) + distance, duration);
				} else if (direction == "down") {
					scrollSlides((slideHeight * currentSlide) - distance, duration);
				}
				
			} else if ( phase == "cancel") {
				
				//important delay, 50 milliseconds. Then click is enabled.
				setTimeout(function() {
					dragging = false;
				},50);
				
				if (orientation == 'vertical') {
					if (!suppTrans) {
						setTimeout(function() {
							$sti_items.stop().animate({ top: valueGlobal }, { duration: scrollSpeed/2.5 } );
						},10);
					}
						
					scrollSlides(slideHeight * currentSlide, scrollSpeed);
					
				} else {
					
					if (!suppTrans) {
						setTimeout(function() {
							$sti_items.stop().animate({ left: valueGlobal }, { duration: scrollSpeed/2.5 } );
						},10);
					}
						
					scrollSlides(slideWidth * currentSlide, scrollSpeed);
					
				}
			
			} else if ( phase == "end" ) {
				
				//important delay, 50 milliseconds. Then click is enabled.
				setTimeout(function() {
					dragging = false;
				},50);
		
				pauseAutoSlide();
				
				if (!suppTrans) {
					if (orientation == 'vertical') {
						setTimeout(function() {
							$sti_items.stop().animate({ top: valueGlobal }, { duration: scrollSpeed } );
						},10);
					} else {
						setTimeout(function() {
							$sti_items.stop().animate({ left: valueGlobal }, { duration: scrollSpeed } );
						},10);
					}
				}
				
				if (orientation == 'vertical') {
					
					if (direction == "down") {
						previousSlide(dragging);
					} else if (direction == "up")	{	
						nextSlide(dragging);
					}
					
				} else {
				
					if (direction == "right") {
						previousSlide(dragging);
					} else if (direction == "left")	{	
						nextSlide(dragging);
					}
				}
			}//end
		}
		
		
		function previousSlide(dragging) {
			currentSlide = Math.max(currentSlide-1, 0);
			
			console.log(dragging)
			
			if (orientation == 'vertical') {
				scrollSlides( slideHeight * currentSlide, scrollSpeed);
				
				if (!suppTrans && !dragging) {
					$sti_items.css({ position:'absolute' });
					setTimeout(function() {
						$sti_items.stop().animate({ top: valueGlobal }, { duration: scrollSpeed } );
					},10);
				}
				
			} else {

				scrollSlides( slideWidth * currentSlide, scrollSpeed);
				
				if (!suppTrans && !dragging) {
					$sti_items.css({ position:'absolute' });
					setTimeout(function() {
						$sti_items.stop().animate({ left: valueGlobal }, { duration: scrollSpeed } );
					},10);
				}
			}
			
			setTimeout( function() { config.onScrollEvent.call(this, currentSlide) }, scrollSpeed);
			changeStyles(currentSlide);		
		}
		
		function nextSlide(dragging) {
			currentSlide = Math.min(currentSlide+1, $totalSlides-1);
			
			if (orientation == 'vertical') {
				scrollSlides( slideHeight * currentSlide, scrollSpeed);

				if (!suppTrans && !dragging) {
					$sti_items.css({ position:'absolute' });
					setTimeout(function() {
						$sti_items.stop().animate({ top: valueGlobal }, { duration: scrollSpeed } );
					},10);
				}

			} else {
				
				scrollSlides( slideWidth * currentSlide, scrollSpeed);

				if (!suppTrans && !dragging) {
					$sti_items.css({ position:'absolute' });
					setTimeout(function() {
						$sti_items.stop().animate({ left: valueGlobal }, { duration: scrollSpeed } );
					},10);
				}
			}
			
			setTimeout( function() { config.onScrollEvent.call(this, currentSlide) }, scrollSpeed);
			changeStyles(currentSlide);		
		}
		
		// call external
		$.versatileTouchSlider.gotoSlideNum = function(slideNum) {
			if (slideNum > $totalSlides-1) slideNum = $totalSlides-1;
			gotoSlide(slideNum);
		}
		
		function gotoSlide(slideNum, dragging) {		
			currentSlide = slideNum;
			
			if (orientation == 'vertical') {
				scrollSlides( slideHeight * currentSlide, scrollSpeed);
				
				if (!suppTrans && !dragging) {
					$sti_items.css({ position:'absolute' });
					setTimeout(function() {
						$sti_items.stop().animate({ top: valueGlobal }, { duration: scrollSpeed } );
					},10);
				}
				
			} else {
				
				scrollSlides( slideWidth * currentSlide, scrollSpeed);
				
				if (!suppTrans && !dragging) {
					$sti_items.css({ position:'absolute' });
					setTimeout(function() {
						$sti_items.stop().animate({ left: valueGlobal }, { duration: scrollSpeed } );
					},10);
				}
			}
			
			setTimeout( function() { config.onScrollEvent.call(this, currentSlide) }, scrollSpeed);
			changeStyles(currentSlide);		
		}
		
		function changeStyles(slideNum) {
			
			if (pageStyle == 'numbers') {
				$sti_page.children("a").removeClass('active');
				$sti_page.children("a").eq(slideNum).addClass('active');
			} else if (pageStyle == 'bullets') {
				$sti_page.children("a").removeClass('bullets_page_active').addClass('bullets_page');
				$sti_page.children("a").eq(slideNum).addClass('bullets_page_active');
			} else if (pageStyle == 'thumbnails') {
				$sti_page.children("a").removeClass('thumbnails_page_active').addClass('thumbnails_page');
				$sti_page.children("a").eq(slideNum).addClass('thumbnails_page_active');
			}
			
			if (slideNum == $totalSlides-1) {
				$(selector + ' .sti_next').css({ opacity: .3 });
			} else {
				$(selector + ' .sti_next').css({ opacity: .8 });
			}
			
			if (slideNum == 0) {
				$(selector + ' .sti_previous').css({ opacity: .3 });
			} else {
				$(selector + ' .sti_previous').css({ opacity: .8 });
			}
		}


		// Update the position of the $sti_items on drag
		function scrollSlides(distance, duration) {
			
			//alert(distance)
			
			if ($('.sti_tooltip').length > 0) $('.sti_tooltip').remove();			
			$sti_slider.stop().animate({ height: slideHeightArr[currentSlide] }, { duration: 400 });
			
			if (suppTrans) {

				$sti_items.css(
				{
					"-webkit-transition-duration": (duration/1000).toFixed(1) + "s", 
					"-moz-transition-duration": (duration/1000).toFixed(1) + "s",
					"-o-transition-duration": (duration/1000).toFixed(1) + "s",
					"-ms-transition-duration": (duration/1000).toFixed(1) + "s",
					"transition-duration": (duration/1000).toFixed(1) + "s"
				});
				
				var valueLocal = (distance < 0 ? "" : "-") + Math.abs(distance).toString();
				
				if (orientation == 'vertical') {
					
					// ie9- and opera not support translate3d
					if (navigator.userAgent.match(/msie/i) || navigator.userAgent.match(/opera/i)) {
						$sti_items.css(
						{
							"-webkit-transform": "translate(0px,"+ valueLocal +"px)",
							"-moz-transform": "translate(0px,"+ valueLocal +"px)",
							"-o-transform": "translate(0px,"+ valueLocal +"px)",
							"-ms-transform": "translate(0px,"+ valueLocal +"px)",
							"transform": "translate(0px,"+ valueLocal +"px)"
						});
					} else {
						$sti_items.css(
						{
							"-webkit-transform": "translate3d(0px,"+ valueLocal +"px,0px)",
							"-moz-transform": "translate3d(0px,"+ valueLocal +"px,0px)",
							"-o-transform": "translate3d(0px,"+ valueLocal +"px,0px)",
							"-ms-transform": "translate3d(0px,"+ valueLocal +"px,0px)",
							"transform": "translate3d(0px,"+ valueLocal +"px,0px)"
						});
					}
					
				} else {
					
					// ie9- and opera not support translate3d
					if (navigator.userAgent.match(/msie/i) || navigator.userAgent.match(/opera/i)) {
						$sti_items.css(
						{
							"-webkit-transform": "translate("+ valueLocal +"px,0px)",
							"-moz-transform": "translate("+ valueLocal +"px,0px)",
							"-o-transform": "translate("+ valueLocal +"px,0px)",
							"-ms-transform": "translate("+ valueLocal +"px,0px)",
							"transform": "translate("+ valueLocal +"px,0px)"
						});
					} else {
						$sti_items.css(
						{
							"-webkit-transform": "translate3d("+ valueLocal +"px,0px,0px)",
							"-moz-transform": "translate3d("+ valueLocal +"px,0px,0px)",
							"-o-transform": "translate3d("+ valueLocal +"px,0px,0px)",
							"-ms-transform": "translate3d("+ valueLocal +"px,0px,0px)",
							"transform": "translate3d("+ valueLocal +"px,0px,0px)"
						});
					}
				}
		
			} else {

				valueGlobal = (distance < 0 ? "" : "-") + Math.abs(distance).toString();
				
			}//suppTrans
		}
		
		
		// ------------------------------------------------------------
		//  Paginate / Control
		// ------------------------------------------------------------
		
		//cancel click when dragging
		$sti_slide.on("click", function(e) {
			if(dragging) return false;
		});
		
		//previous slide
		$(selector + ' .sti_previous').on("click", function(e) {
			e.preventDefault();
			previousSlide();
			pauseAutoSlide();
		});
		
		//next slide
		$(selector + ' .sti_next').on("click", function(e) {
			e.preventDefault();
			nextSlide();
			pauseAutoSlide();
		});
		
		//goto slide
		$sti_page.children('a').on("click", function(e) {
			e.preventDefault();
			gotoSlide( $(this).index() );
			pauseAutoSlide();
		});
		
		//current slide different of 0
		if (currentSlide > 0 && currentSlide < $totalSlides) {
			setTimeout(function() {
				gotoSlide(currentSlide);
			},500);
		}
		
		//play / pause button
		$play.on("click", function(e) {
			e.preventDefault();
			
			initAutoSlide();
			$(this).hide();
			$pause.show();
			$pause.css({ opacity:0 }).stop().animate({ opacity: 1 }, { duration: 500 } );
		});

		$pause.on("click", function(e) {
			e.preventDefault();
			
			pauseAutoSlide();
			$(this).hide();
			$play.show();
			$play.css({ opacity:0 }).stop().animate({ opacity: 1 }, { duration: 500 } );
		});
		
		
		// ------------------------------------------------------------
		// menu
		// ------------------------------------------------------------
		
		$sti_menu.children('a').on("click", function(e) {
			e.preventDefault();
			
			if( ($(this).index() == stiMenuCurrent) || (autoSlide == true && typeof interval == "undefined") ) return false;
			
			$sti_menu.children('a').off("click");
			
			var menuLink = $(this).attr('data-url');
			config.ajaxEvent.call(undefined, menuLink, autoSlide);
			changeMenu( $(this).index() );
			pauseAutoSlide();
		});
		
		
		function changeMenu(num) {
			$sti_menu.children('a').removeClass('active');
			$sti_menu.children('a').eq(num).addClass('active')
		}
		
		//menu align
		function alignMenuConfig() {
			if (alignMenu == 'left') {
				$sti_menu.css({ float: 'left' });
			} else if (alignMenu == 'right') {
				$sti_menu.css({ float: 'right' });
			} else {
				$sti_menu.css({ left: ($sti_slider.width() - $sti_menu.width()) / 2 });
			}
		}
		alignMenuConfig();

		// ------------------------------------------------------------
		// auto slide
		// ------------------------------------------------------------
		
		var interval;
		var stiMenuLen = $sti_menu.children('a').length;
		
		for (var i=0; i < stiMenuLen; i++ ) {
			if( $sti_menu.children('a').eq(i).hasClass('active') ) {
				var stiMenuCurrent = i;
				break;
			}
		}
		
		function initAutoSlide() {
			autoSlide = true;

			function next() {
				if (currentSlide >= $totalSlides-1) {
					
					if ( stiMenuLen > 0 && stiMenuCurrent < stiMenuLen) {
						
						if(stiMenuCurrent == stiMenuLen-1) stiMenuCurrent = -1;
						
						var menuIndex = $sti_menu.children('a').eq(stiMenuCurrent+1);
						var menuLink = menuIndex.attr('data-url');
						
						clearInterval(interval);
						$sti_menu.children('a').off("click");
						config.ajaxEvent.call(undefined, menuLink, autoSlide);
						changeMenu(stiMenuCurrent+1);
						stiMenuCurrent++;

					} else {

						gotoSlide(0);
					}
					
				} else {
					nextSlide();
				}
			}//next
			
			interval = setInterval(next, autoSlideDelay);
		}//initAutoSlide
		
		//if (autoSlide) initAutoSlide();
		
		
		function pauseAutoSlide() {
			//console.log('pauseAutoSlide > ' +  interval);
			clearInterval(interval);
			autoSlide = false;
			
			if (showPlayPause) {
				$play.show();
				$pause.hide();
			}
		}
		
		
		// ------------------------------------------------------------
		// sti lightbox
		// ------------------------------------------------------------
		
		var $lightbox = $(selector + ' .sti_lightbox');
		var $popupMaxWidth;
		
		$lightbox.on("click", function(e) {
			
			e.preventDefault();
			//var $p = $(this);
			
			/////
			if ( $('#popup_lightbox').length > 0 || $('#mask_lightbox').length > 0 ) {
				return false;
			}
			
			if(dragging) return false;
			
			if ( $('#mask_lightbox').length > 0 ) { $('#mask_lightbox').remove(); }
			if ( $('#popup_lightbox').length > 0 ) { $('#popup_lightbox').remove(); }
			
			//add mask_lightbox
			$('body').append('<div id="mask_lightbox"></div>');
			$('body').append('<div id="popup_lightbox"></div>');
			$('#popup_lightbox').append("<div id='preload_lightbox'></div>");
			
			var $mask = $('#mask_lightbox');
			var $popup = $('#popup_lightbox');
		
			//Get width / height
			var winWidth = $(window).width();
			var winHeight = $(window).height();
			var docHeight = $(document).height();

			$mask.css({'width': winWidth,'height': docHeight});
			$mask.fadeIn(400);	
			$mask.fadeTo("normal",0.7);

			//popup
			$popup.css({
				top: winHeight / 2 - $popup.height() / 2,
			 	left: winWidth / 2 - $popup.width() / 2
			});
			
						
			lightboxData( $(this) );
			
			function lightboxData( currentProd ) {
				
				winWidth = $(window).width();
				winHeight = $(window).height();
				docHeight = $(document).height();
				
				var $p = currentProd;
				var data_href = $p.attr('href');
				
				if ($p.attr('data-type') != undefined ) {
					var data_type = $p.attr('data-type');
				}
				
				if ($p.attr('data-poster') != undefined ) {
					var data_poster = $p.attr('data-poster');
				} else {
					data_poster = '';
				}
				
				if ($p.attr('data-size') != undefined) {
					var data_size = $p.attr('data-size').split('x');
				} else {
					//default value
					var data_size = [640,360];
				}
				$popupMaxWidth = data_size[0];
				
				var is_img = ( data_href.indexOf('.jpg') != -1 || data_href.indexOf('.gif') != -1 || data_href.indexOf('.png') != -1 ) || data_type == 'image' ? true : false;
				
				if (is_img) {
					var this_item = $p;
					
					if ( is_ie7 || is_ie8 ) {
						var img = $("<img />").attr('src', data_href + "?" + new Date().getTime());
					} else {
						var img = $("<img />").attr('src', data_href);
					}
						
					img.load(function() {
						
						var img_width = this.width;
						var img_height = this.height;
						
						if (this.width > winWidth) { 
	
							var a = winWidth - 80;
							var b = this.width;
							
							var percentA = (a/b) * 100;
	
							this.height = (percentA / 100) * this.height;
							this.width = a;
						}
						
						$popupMaxWidth = this.width;
						
						popupCenterAnimate(this.width, this.height, img, this_item);
						$(img).hide();
					});
					
				} else if (data_type == 'video-youtube') {
					
					//screen resolution
					var w = parseInt(data_size[0]), h = parseInt(data_size[1]);
					if (w > winWidth) { w = winWidth - 80; }
					
					var str_id = data_href.split("?v=");
					var str_params = "?autohide=2&amp;autoplay=0&amp;controls=1&amp;disablekb=0&amp;fs=1&amp;hd=0&amp;loop=0&amp;rel=0&amp;showinfo=0&amp;showsearch=1&amp;wmode=transparent&amp;enablejsapi=1";
					var str_iframe = '<iframe class="video_player" width="' + w + '" height="' + h + '" frameborder="0" src="http://www.youtube.com/embed/' + str_id[1] + str_params + '"></iframe>';
					
					popupCenterAnimate(w, h, str_iframe, $p);
					
				} else if (data_type == 'video-vimeo') {
					
					var w = parseInt(data_size[0]), h = parseInt(data_size[1]);
					if (w > winWidth) { w = winWidth - 80; }
	
					var str_id = data_href.split("/").pop();
					var str_iframe = '<iframe class="video_player" src="http://player.vimeo.com/video/' + str_id +  '?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=0" width="' + w + '" height="' + h + '" frameborder="0"></iframe>';
					
					popupCenterAnimate(w, h, str_iframe, $p);
					
				} else if (data_type == 'html-content') {
					
					var w = parseInt(data_size[0]), h = parseInt(data_size[1]);
					if (w > winWidth) { w = winWidth - 80; }
					
					//data_href
					var str_iframe = '<iframe id="html_content_lightbox" src="' + data_href +  '" width="' + w + '" height="' + h + '" frameborder="0"><div id="preload_lightbox"></div></iframe>';
					popupCenterAnimate(w, h, str_iframe, $p);
					
				} else {
					
					//open mediaelement plugin script if not exist
					
					if ( $('#script_media_element').length < 1) {
						var js = document.createElement("script");
						js.type = "text/javascript";
						js.src = "mep/player/mediaelement-and-player.min.js";
						js.id = "script_media_element";
						document.body.appendChild(js);
					}
	
					//screen resolution
					var w = parseInt(data_size[0]), h = parseInt(data_size[1]);
					if (w > winWidth) { w = winWidth - 80; }
					
					if (data_type == 'video') {
						//type='video/flv' or 'video/mp4'
						var str_div = '<div class="video_player"><video src="' + data_href +'" width="' + w  + '" height="' + h + '" poster="' + data_poster + '"></video></div>';
						popupCenterAnimate(w, h, str_div, $p);
					} else if (data_type == 'audio') {
						var str_div = '<div id="audio_player"><audio src="' + data_href +'" width="' + w  + '" height="' + h + '" poster="' + data_poster + '" type="audio/mp3" controls="controls"></audio></div>';
						popupCenterAnimate(w, h, str_div, $p);
					}
					
				}//if
				
	
				// ------------------------------------
				// navigation lightbox
				// ------------------------------------
				
				$popup.append('<div id="sti_previous_lightbox"></div><div id="sti_next_lightbox"></div>');
				var lightboxLength = $sti_slide.eq(currentSlide).children($prod).find('.sti_lightbox').length;

				$('#sti_previous_lightbox').css({ opacity: 0, display: 'none'});
				$('#sti_next_lightbox').css({ opacity: 0, display: 'none'});
								
				$('#sti_previous_lightbox').on("click", function(e) {
					//$p =  $p.parent().prev().find('.sti_lightbox'); //in sequence only
					$p = $p.parent().prevAll(':has(.sti_lightbox):first').find('.sti_lightbox');
					
					if ($p.length > 0) {
						if (!touchSupport) { $('audio').each(function() { $(this)[0].player.pause(); }); }
						$popup.html('');
						lightboxData( $p );
					} else {
						if (!touchSupport) { $('audio').each(function() { $(this)[0].player.pause(); }); }
						$popup.html('');
						lightboxData( $sti_slide.eq(currentSlide).children($prod).find('.sti_lightbox').eq( lightboxLength - 1 ) );
					}
					$('#popup_lightbox').append("<div id='preload_lightbox'></div>");
				});
	
				$('#sti_next_lightbox').on("click", function(e) {		
					//$p = $p.parent().next().find('.sti_lightbox'); //in sequence only
					$p = $p.parent().nextAll(':has(.sti_lightbox):first').find('.sti_lightbox');
					
					if ($p.length > 0) {
						if (!touchSupport) { $('audio').each(function() { $(this)[0].player.pause(); }); }
						$popup.html('');
						lightboxData( $p );
					} else {
						if (!touchSupport) { $('audio').each(function() { $(this)[0].player.pause(); }); }
						$popup.html('');
						lightboxData( $sti_slide.eq(currentSlide).children($prod).find('.sti_lightbox').eq(0) );					
					}
					$('#popup_lightbox').append("<div id='preload_lightbox'></div>");
				});
				
				$popup.mouseover(function(e) {
					$('#sti_previous_lightbox').css({display: 'block'}).stop().animate({ opacity: .5 }, { duration: 400 });
					$('#sti_next_lightbox').css({display: 'block'}).stop().animate({ opacity: .5 }, { duration: 400 });
				}).mouseout(function() {
					$('#sti_previous_lightbox').stop().animate({ opacity: 0 }, { duration: 400 });
					$('#sti_next_lightbox').stop().animate({ opacity: 0 }, { duration: 400 });
				});

			}//lightboxData
			

			// ------------------------------------
			// popup center animate / append item
			// ------------------------------------
			
			function popupCenterAnimate(w,h,str,this_elem) {
				
				if (w > winWidth) {
					w = winWidth - 80;
				}
				
				var $popup = $('#popup_lightbox');

				$popup.stop().delay(100).animate({ 
					'top': winHeight / 2 - $popup.height() / 2,  
					'left': winWidth / 2 - $popup.width() / 2 
				}, 400, function() {
					$('#preload_lightbox').remove();
				});

				var posX = (winWidth / 2 - w / 2);
				var posY = (winHeight / 2 - h / 2);
				
				$popup.stop().delay(100).animate({'height': h, 'width': w, 'top': posY,  'left': posX }, 400, function() {
					
					//add img/video/audio
					$popup.append(str);
					$(str).fadeIn(500);
					
					//title
					if ($(this_elem).attr("title") != "" && $(this_elem).attr("title") != "undefined") {
						var prod_title = $(this_elem).attr("title");
					} else {
						var prod_title = '';
					}

					$popup.append("<div id='sti_bar_lightbox'><div id='close_btn_lightbox'></div>" + prod_title + "</div>");
					var padd = parseInt($popup.css('padding-left'));
					$("#sti_bar_lightbox").css({ 'width': w + padd, 'bottom': -(padd*2) - 31 , 'left': 0});
					
					//popup fade
					$("#sti_bar_lightbox").fadeIn(400);	
					$("#sti_bar_lightbox").fadeTo("normal",1);
		
					//btn close
					$('#close_btn_lightbox').click(function () {
						closeLightbox();
					});

					//execut script if video or audio
					if (this_elem.attr('data-type') == 'video') {
						$('video').mediaelementplayer({
							videoWidth: '100%',
							videoHeight: '100%',
							startVolume: 0.6,
							enableAutosize: true,
							features: ['playpause','current','progress','duration','volume','fullscreen'],
							videoVolume: 'horizontal'
						});	
					} else if (this_elem.attr('data-type') == 'audio') { 
						$('audio').mediaelementplayer({
							startVolume: 0.6,
							loop: true,
							audioWidth: '95%',
							features: ['playpause','current','progress','duration','volume','fullscreen'],
							videoVolume: 'horizontal'
						});
					}
				});
			}//popupCenterAnimate
			
	
			// -------------------------------
			// click mask_lightbox
			// -------------------------------
			
			$('#mask_lightbox').click(function () {
				closeLightbox();
			});

			$(document).keydown(function(e) {
				//escape key
				if (e.keyCode == 27) {
					closeLightbox();
				}
			});
			
			function closeLightbox() {
				
				if (!touchSupport) {
					$('video, audio').each(function() {
						$(this)[0].player.pause();        
					});
				}
				
				$popupMaxWidth = undefined;
				
				$('#mask_lightbox').hide();
				$('#mask_lightbox').remove();
				$('#popup_lightbox').remove();
				
				$(selector).trigger('resize'); 
			}

		});//sti lightbox
		

		// -------------------------------
		// resize event
		// -------------------------------
		
		function resizeEnd() {
				
			// image_banner
			if (sliderType == 'image_banner') {
				for(var i=0; i < $sti_slide.length; i++) {
					var sld = $sti_slide.eq(i);
					slideHeightArr[i] = sld.height();
					
					//////////////////
					var img = sld.find('img.main_image');
					sld.width( img.width() );
					slideWidth = img.width(); //new width to be calculated
					
					
					var posLeft = i * slideWidth;
					sld.css( { left: posLeft, position: 'absolute'  } );
					//console.log ( img.offset().left )
					
					gotoSlide(currentSlide);
				}
				if (orientation == 'vertical') slideHeight = slideHeightArr[0];
				
				gotoSlide(currentSlide);
			}
			
			// image_text
			if (sliderType == 'image_text') {
				for(var i=0; i < $sti_slide.length; i++) {
					var sld = $sti_slide.eq(i);
					slideHeightArr[i] = sld.height();
				}
				if (orientation == 'vertical') {
					//slideHeight = slideHeightArr[0];
					slideHeight = slideHeightArr[0];
				}
				
				gotoSlide(currentSlide);
			}
			
			// image_gallery
			if (sliderType == 'image_gallery') {
				
				$(selector).find('.sti_clear').remove();
				
				for (var i=0; i < $sti_slide.length; i++) {
					
					var sld = $sti_slide.eq(i);						
					var sldLength = sld.find($prod).length;
					
					for (var j=0; j < sldLength; j++) {
						var p = sld.find($prod).eq(j);
						var pFirst = sld.find($prod).eq(0);
						var pPosX = parseInt(p.position().left) + p.width() + parseInt(p.css('margin-left'), 10) + 11; //11=shadow
						var pPosXFirst = parseInt(pFirst.position().left) + pFirst.width() + parseInt(pFirst.css('margin-left'), 10) + 11;

						if ( pPosX > $sti_slider.width() || pPosX == pPosXFirst ) {
							$( p ).before('<div class="sti_clear"></div>');
						}
					}//for j
					
					$sti_slider.height( sld.height() );
					slideHeightArr[i] = sld.height();
					gotoSlide(currentSlide);

				}//for i
				
				if (orientation == 'vertical') slideHeight = slideHeightArr[0];
			}

			//image_shelf
			if (sliderType == 'image_shelf') {
				
				$(selector).find('.sti_shelf_divider').remove();
				//$(selector).find('.sti_shelf_divider_bottom').remove();
				
				for (var i=0; i < $sti_slide.length; i++) {
					
					var sld = $sti_slide.eq(i);						
					var sldLength = sld.find($prod).length;
					//$( sld.find($prod).eq(sldLength-1) ).after('<div class="sti_shelf_divider_bottom"></div>');
					
					for (var j=0; j < sldLength; j++) {
						var p = sld.find($prod).eq(j);
						var pFirst = sld.find($prod).eq(0);
						var pPosX = parseInt(p.position().left) + p.width() + parseInt(p.css('margin-left'), 10) + 11; //11=shadow
						var pPosXFirst = parseInt(pFirst.position().left) + pFirst.width() + parseInt(pFirst.css('margin-left'), 10) + 11;

						if ( pPosX > $sti_slider.width() || pPosX == pPosXFirst ) {
							$( p ).before('<div class="sti_shelf_divider"></div>');
						}
					
					}//for j
					
					$sti_slider.height( sld.height() );
					slideHeightArr[i] = sld.height();
					gotoSlide(currentSlide);
					
					
					if (is_100) {
						$sti_slider.width( $(selector).width() );
						sld.width( $(selector).width() );
						slideWidth = sld.width(); //new width to be calculated
					}

				}//for i
				
				if (orientation == 'vertical') slideHeight = slideHeightArr[0];		
			}//image_shelf
			
			$('#mask_lightbox').width( $(window).width() );
			$('#mask_lightbox').height( $(document).height() );
			
		}//resizeEnd
		
		
		var maxWidth = (slideWidth);
		var maxHeight = parseFloat(slideHeight);
		var resizeTimer = 0;
		var currentHeight, currentWidth;
		var lastWindowWidth = $(window).width();

		$(window).on("resize", function(e) {
			
			var windowHeight = $(window).height();
  			var windowWidth = $(window).width();
			
			if (currentHeight == undefined || currentHeight != windowHeight || currentWidth == undefined || currentWidth != windowWidth) {
		  
				if (sliderType == 'image_banner') {
					
					if (is_100) {

						if ($(window).width() !== lastWindowWidth) {
							
							var imgTmp = $sti_slider.find('img.main_image');
							$(selector).width( $(window).width() );
							imgTmp.css( { width: $(selector).width() } );
							$sti_slider.css( { width: $(selector).width(), height: imgTmp.height() } );
							//$sti_slide.css( { height: imgTmp.height() } );
							alignPaginationConfig();
							alignMenuConfig();										
							lastWindowWidth = $(window).width();
						}

					} else {

						var imgTmp = $sti_slider.find('img.main_image');
						$(selector).width("100%");
						imgTmp.css( { width: $(selector).width() } );
						
						if ($(selector).width() > maxWidth) {
							$(selector).css("width", maxWidth);
						}
						
						if ($(selector).width() < maxWidth) {
							imgTmp.css( { width: $(selector).width() } );				
							$sti_slider.css( { width: $(selector).width(), height: imgTmp.height() } );
							$sti_slide.css( { height: imgTmp.height() } );
							alignPaginationConfig();
							alignMenuConfig();
						}
						
						if ( $(window).width() > maxWidth ) {
							$(selector).width(maxWidth);
							$sti_slider.width(maxWidth);
							imgTmp.css( { width: maxWidth } );
							
							if (orientation == 'vertical' && slideHeight < maxHeight) {
								$sti_slider.height(maxHeight);
								$sti_slide.height(maxHeight);
							}
						}
					}

					
					//resizeend
					if (resizeTimer) clearTimeout(resizeTimer);
					resizeTimer = setTimeout(resizeEnd, 300);
					
				}//image_banner
				
				if (sliderType == 'image_shelf') {
					
					if (is_100) {

						if ($(window).width() !== lastWindowWidth) {
							$(selector).width( $(window).width() );
							$sti_slider.width( $(selector).width() );
							$sti_slide.width( $(selector).width() );
							alignPaginationConfig();
							alignMenuConfig();			
							lastWindowWidth = $(window).width();
						}

					} else { 
					
						$(selector).width("100%");
						
						if ($(selector).width() > maxWidth) {
							$(selector).width(maxWidth);
						}
						
						if ($(selector).width() < maxWidth) {
							$sti_slider.width( $(selector).width() );
							
							alignPaginationConfig();
							alignMenuConfig();
						}
						
						if ( $(window).width() > maxWidth ) {
							$(selector).width(maxWidth);
							$sti_slider.width(maxWidth);
							
							if (orientation == 'vertical' && slideHeight < maxHeight) {
								$sti_slider.height(maxHeight);
								$sti_slide.height(maxHeight);
							}
						}
					}
					
					//resizeend
					if (resizeTimer) clearTimeout(resizeTimer);
					resizeTimer = setTimeout(resizeEnd, 300);
	
				}//image_shelf
				
				if (sliderType == 'image_text') {
					
					var $content_in = $(selector + ' .sti_content_inner');
					var imgTmp = $sti_slider.find('img.main_image');
					
					$(selector).width("100%");
					
					if ($(selector).width() > maxWidth) {
						$(selector).css("width", maxWidth);
					}
					
					if ($(selector).width() < maxWidth) {
						$sti_slider.css( { width: $(selector).width() } );
						
						imgTmp.css( { width: $(selector).width(), height: 'auto' } );
						
						$content_in.css( { width: $(selector).width(), height: '100%' } );
						alignPaginationConfig();
						alignMenuConfig();
					}
					
					if ( $(window).width() > maxWidth ) {
						$(selector).width(maxWidth);
						$sti_slider.width(maxWidth);
						imgTmp.css( { width: maxWidth, height: 'auto' } );
						
						if (orientation == 'vertical' && slideHeight < maxHeight) {
							$sti_slider.height(maxHeight);
							$sti_slide.height(maxHeight);
						}
					}
					
					//resizeend
					if (resizeTimer) clearTimeout(resizeTimer);
					resizeTimer = setTimeout(resizeEnd, 300);
	
				}//image_text
				
				if (sliderType == 'image_gallery') {
				
					$(selector).width("100%");
					
					if ($(selector).width() > maxWidth) {
						$(selector).width(maxWidth);
					}
					
					if ($(selector).width() < maxWidth) {
						$sti_slider.width( $(selector).width() );
						alignPaginationConfig();
						alignMenuConfig();
					}
					
					if ( $(window).width() > maxWidth ) {
						$(selector).width(maxWidth);
						$sti_slider.width(maxWidth);
						
						if (orientation == 'vertical' && slideHeight < maxHeight) {
							$sti_slider.height(maxHeight);
							$sti_slide.height(maxHeight);
						}
					}
					
					//resizeend
					if (resizeTimer) clearTimeout(resizeTimer);
					resizeTimer = setTimeout(resizeEnd, 300);
	
				}//image_gallery
				
				//popup lightbox resize
				if ( $('#popup_lightbox').length > 0 ) {
					
					var $popup = $('#popup_lightbox');
	
					$popup.css({
						'top': $(window).height() / 2 - $popup.height() / 2, 
						'left': $(window).width() / 2 - $popup.width() / 2
					});
					
					var $mask = $('#mask_lightbox');
					$mask.css({'width': $(window).width(),'height': $(document).height() });
					
					if ( $(window).width() < $popup.width() ) {
						
						$popup.css({ width:'100%', height: 'auto' });
						$('.video_player').css( { width:'100%' } );
						$('#sti_bar_lightbox').css({ width:'100%' });
						
						$popup.find('img').css( { width:'100%' } );
						$popup.find('object').css( { width:'100%' } );
					}
					
					if ( $(window).width() > $popupMaxWidth ) {
						$popup.css( { width: $popupMaxWidth } );
																
						var img = $popup.find('img');
						if (img) {
							img.css( { width:$popupMaxWidth } );
							//$popup.css( { width: $popupMaxWidth, height: 'auto' } );
						}
					}
					
					//resizeend
					if (resizeTimer) clearTimeout(resizeTimer);
					resizeTimer = setTimeout(resizeEnd, 300);
	
				}//lightbox
				
				currentHeight = windowHeight;
     			currentWidth = windowWidth;
	  
			}//currentHeight, currentWidth;
	
		});//resize

		return this;
	};
	
})(jQuery);


// ----------------------------------------------------
// Support css3 transitions
// ----------------------------------------------------
		
function supportsTransitions() {
	var b = document.body || document.documentElement;
	var s = b.style;
	var p = 'transition';
	if(typeof s[p] == 'string') { return true; }

	// Tests for vendor specific prop
	v = ['Moz', 'Webkit', 'Khtml', 'O', 'ms'],
	p = p.charAt(0).toUpperCase() + p.substr(1);
	for(var i=0; i<v.length; i++) {
	  if(typeof s[v[i] + p] == 'string') { return true; }
	}
	return false;
}

//------------------------------------
// images loaded plugin
// MIT License. by Paul Irish et al.
//------------------------------------

(function(c,q){var m="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";c.fn.imagesLoaded=function(f){function n(){var b=c(j),a=c(h);d&&(h.length?d.reject(e,b,a):d.resolve(e));c.isFunction(f)&&f.call(g,e,b,a)}function p(b){k(b.target,"error"===b.type)}function k(b,a){b.src===m||-1!==c.inArray(b,l)||(l.push(b),a?h.push(b):j.push(b),c.data(b,"imagesLoaded",{isBroken:a,src:b.src}),r&&d.notifyWith(c(b),[a,e,c(j),c(h)]),e.length===l.length&&(setTimeout(n),e.unbind(".imagesLoaded",
p)))}var g=this,d=c.isFunction(c.Deferred)?c.Deferred():0,r=c.isFunction(d.notify),e=g.find("img").add(g.filter("img")),l=[],j=[],h=[];c.isPlainObject(f)&&c.each(f,function(b,a){if("callback"===b)f=a;else if(d)d[b](a)});e.length?e.bind("load.imagesLoaded error.imagesLoaded",p).each(function(b,a){var d=a.src,e=c.data(a,"imagesLoaded");if(e&&e.src===d)k(a,e.isBroken);else if(a.complete&&a.naturalWidth!==q)k(a,0===a.naturalWidth||0===a.naturalHeight);else if(a.readyState||a.complete)a.src=m,a.src=d}):
n();return d?d.promise(g):g}})(jQuery);