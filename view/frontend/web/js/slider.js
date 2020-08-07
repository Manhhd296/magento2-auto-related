define([
  "jquery",
  "magepow/owl"
  ], function ($) {
    'use strict';
    $.widget('mage.magepowAutorelated', {
      _create: function () {
        $(".magepow_autorelated .owl-carousel").owlCarousel({
		    loop:true,
		    margin:10,
		    responsiveClass:true,
		    responsive:{
		        0:{
		            items:1,
		            nav:true
		        },
		        600:{
		            items:3,
		            nav:false
		        },
		        1000:{
		            items:5,
		            nav:true,
		            loop:false
		        }
		    }
        });
      }
    });
  return $.mage.magepowAutorelated;
});