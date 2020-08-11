define([
  "jquery",
  "jquery/ui",
  "slick",
  "jquery-ui-modules/widget"
  ], function ($) {
    'use strict';
    $.widget('mage.magepowRelated', {
      _create: function () {
	     $(".regular").slick({
	       speed: 300,
	       dots: true,
	       autoplay: true,
	       infinite: true,
	       slidesToShow: 5,
	       slidesToScroll: 1,
	       responsive: [
	            {
	                breakpoint: 1280,
	                settings: {
	                    slidesToShow: 3,
	                    slidesToScroll: 3
	                }
	            },
	            {
	                breakpoint: 768,
	                settings: {
	                    slidesToShow: 2,
	                    slidesToScroll: 2
	                }
	            },
	            {
	                breakpoint: 600,
	                settings: {
	                    slidesToShow: 1,
	                    slidesToScroll: 1
	                }
	            }
	        ]
	     });
      }
    });
  return $.mage.magepowRelated;
});