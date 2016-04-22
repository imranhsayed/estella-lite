(function($){


	window.estella = {

		init: function(){
			this.createMainSlider();
			this.backtoTop();
			this.animateSearchBox();
			this.showNavigation();
			this.showHeaderIcons();
			this.hoverCss();
			$(window).on('load',function(){
				$('.flexslider').css('visibility', 'visible').hide().fadeIn();
			});
		},
		showHeaderNavigation: function(){

		},
		showHeaderIcons: function(){
			$('#head-container').on('click', '.share-button', function(){
				$('.header-icons-2').fadeToggle();


			});
			$(window).on('resize', function(){
				$('.header-icons-2').hide();
			});
		},
		createMainSlider: function(){
			$('#estella-slider').slick({
				infinite       : true,
				slidesToShow   : 4,
				slidesToScroll : 2,
				prevArrow: '<i id="estella-prevslide" class="fa fa-angle-left estella-prev"></i>',
				nextArrow: '<i id="estella-nextslide" class="fa fa-angle-right estella-next"></i>',
				dots : false,
				autoplay: true,
				responsive     : [
								    {
										breakpoint : 1024,
										settings   : {
											slidesToShow   : 3,
											slidesToScroll : 3,
								    	}
								    },
								    {
										breakpoint : 720,
										settings   : {
											slidesToShow   : 2,
											slidesToScroll : 2,
								        }
								    },
								    {
										breakpoint : 480,
										settings   : {
											slidesToShow   : 1,
											slidesToScroll : 1,
								        }
								    }
		        ]
			});
		},

		backtoTop: function()
		{
			var $icon = $( '.footer-scroll' );
			$icon.on( 'click' , function () {
				  $("body,html").animate( { scrollTop: 0 }, 600);
				  return false;
			});
		},

		showNavigation: function(){

			$('#masthead').on('click','.navicon', function(){
				// $('.estella-navigation-one').toggle();
				$("#masthead").toggleClass("estella-head-color");
				$("#head-container").toggleClass("estella-head-color");
				$(".social-media-icons").show();
				$(".estella-header-icon-button li").toggleClass('estella-display-none');
				});

		},

		animateSearchBox: function(){
			var $searchBox = $('.header-icons').find('.search-box');

			$('.header-icons').on( 'click' , '.search-icon', function (e) {

				var $this = $(this);

				if( $(this).hasClass('shown') ){
					$searchBox.animate( {width : '0'} , 400 , function(){
						$(this).hide();
						$this.removeClass('shown');
					} );
				}
				else{
					$searchBox.show().animate( {width: '250px'}, 400, function(){
						$this.addClass('shown');
					} );

				}
		     		e.stopPropagation();
		   	 });

			$searchBox.find('input').on( 'click' , function(e){
				e.stopPropagation();
			} );

			$('body').on('click', function(){
				$searchBox.animate( {width : '40px'} , 400 ).hide();

			});

		},

		hoverCss : function() {
			var tagCloudHover = $(".tagcloud a"),
				tagLinks     = $(".tags-links a"),
				socialIconFooter = $("#custom-footer .social-media-icons a"),
				socialIconSidebar = $(".widget-area .social-media-icons a"),
				menuHover = $(".main-navigation ul li a"),
				widgetPageHover = $(".widget_pages ul li a"),
				widgetRecentPostHover = $(".widget_recent_entries ul li a"),
				widgetMetaHover = $(".widget_meta ul li a"),
				widgetCalendarHover = $(".estella-slider-content h2"),
				widgetArchiveHover = $(".widget_archive ul li a"),
				widgetRecentPostImageHover = $(".aside-post-img img");


			tagCloudHover.addClass('hvr-shutter-out-horizontal');
			tagLinks.addClass('hvr-shutter-out-horizontal');
			socialIconFooter.addClass('hvr-sweep-to-right');
			socialIconSidebar.addClass('hvr-sweep-to-right');
			menuHover.addClass('hvr-underline-from-center');
			// widgetPageHover.addClass('hvr-wobble-horizontal');
			widgetRecentPostHover.addClass('<div class="hvr-sin"></div>k');
			// widgetMetaHover.addClass('hvr-wobble-horizontal');
			widgetCalendarHover.addClass('hvr-grow-shadow');
			// widgetArchiveHover.addClass('hvr-wobble-horizontal');
			widgetRecentPostImageHover.addClass('hvr-grow-shadow');

		}


	};


	window.estella.init();

})(jQuery);
