/**
 * Theme Name: Renato
 * @description: jQuery global init.
 * @version: 1.0.0
 */

(function($){
    var MYFUNCTION = window.MYFUNCTION || {};

    MYFUNCTION.Constants = {
        windowHeight:0,
        windowWidth: 0,
        scrollTop: 0,
        didScroll: 'end',
        delta: 50,
        introHeight: 0,
        mobileSwitch: false,
        navTarget: 0
    };

    // Create cross browser requestAnimationFrame method:
    window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame || function(f) {
        setTimeout(f, 1000 / 60);
    };

    MYFUNCTION.DOMInfo = {};
    MYFUNCTION.DOMInfo = {

        usingMobileBrowser: (navigator.userAgent.match(/(Android|iPod|iPhone|iPad|BlackBerry|IEMobile|Opera Mini)/)) ? true : false,
        usingMobileBrowser: (navigator.userAgent.match(/(Android|iPod|iPhone|iPad|BlackBerry|IEMobile|Opera Mini)/)) ? true : false,

        getWindowSize: function() {

            MYFUNCTION.Constants.windowHeight = window.innerHeight;
            MYFUNCTION.Constants.windowWidth = window.innerWidth;

            if (MYFUNCTION.Constants.windowWidth < 768) {
                MYFUNCTION.Constants.mobileSwitch = true;
            }else{
                MYFUNCTION.Constants.mobileSwitch = false;
            }
            // fire resized event;
            MYFUNCTION.resized();
        },

        isTouchDevice() {
          return (('ontouchstart' in window) ||
             (navigator.maxTouchPoints > 0) ||
             (navigator.msMaxTouchPoints > 0));
        },

        scrollPosMouse: function() {
            return $(window).scrollTop();
        },

        scrollPosRAF: function() {
            MYFUNCTION.Constants.scrollTop = $(window).scrollTop();
            requestAnimationFrame(MYFUNCTION.DOMInfo.scrollPosRAF);
        },

        bindEvents: function() {
            if (!this.usingMobileBrowser) {
                $(window).on('scroll', function() {
                    MYFUNCTION.Constants.scrollTop = MYFUNCTION.DOMInfo.scrollPosMouse();
                });
            }

            let timer;
            window.onresize = function(){
              clearTimeout(timer);
              timer = setTimeout(MYFUNCTION.DOMInfo.getWindowSize, 400);
            };
        },
    };

    MYFUNCTION.onScrollEvent = function() {
        var offsetIntro = $( 'body' ).position().top;
        var heightIntro = $( 'body' ).height();
        var offsetTop = offsetIntro + heightIntro;
        if (offsetTop < 174){
            $('.header').addClass('in');
        } else {
            $('.header').removeClass('in');
        }
    };

    MYFUNCTION.scrollPointer = function(){
        var body = document.body, timer;

        /*
        * Listen for a scroll and use that to remove
        * the possibility of hover effects
        */
        window.addEventListener('scroll', function() {

            if (timer) {
                clearTimeout(timer);
            }

            /**
            * Removes the hover class from the body. Hover styles
            * are reliant on this class being present
            */
            body.classList.add('disable-hover')

            /**
            * Adds the hover class to the body. Hover styles
            * are reliant on this class being present
            */
            timer = setTimeout(function(){
                body.classList.remove('disable-hover');
                body.classList.remove('navigation-scrolling');
   
            }, 420);

        }, {passive: true});
    };

    // Call function on resized screen
    MYFUNCTION.resized = function() {
    };

    MYFUNCTION.removeLoader = function() {
       
        $('body').find('.preloader-page').fadeOut('slow', function() {

            $('#loading-screen').remove();

        });
    }

    MYFUNCTION.mobileMenu = function () {
        // $('.menu-toggle').on('click', function (e) {
        //     e.preventDefault();
        //     $(this).toggleClass('back-toggle');
        //     $('.main-navigation').toggleClass('open-menu');
        // })
    }

    MYFUNCTION.navSubMenu = function (argument) {
        let isOpen = false;
        if ($(window).width() < 1023) {

            if ($('body .has-submenu .click-arrow').length == 0) {

                $('body').find('.has-submenu .nav-link-wrapper').append('<span class="click-arrow"></span>');

            }
        }else{

            $('.has-submenu').each(function(){

                $(this).find('.click-arrow').remove();

            });
        }
        $(document).on("click", function(event){
            console.log(isOpen);
            if(!$(event.target).closest(".submenu-container.active").length && isOpen == true){
                $(".submenu-container.active, .has-submenu.active").removeClass("active");
                 setTimeout(function(){
                    isOpen = false;
                }, 100);
            }
        });

        // Desktop js
        $('.nav-menu').on('click', '.has-submenu', function(event) {
            event.preventDefault();
            /* Act on the event */
            let left_position = $(this).position().left;
            let half_of_element = $(this).width() / 2;
            let triangel_position = left_position + half_of_element;
         
            $('.triangle-position-js').css('left', triangel_position);
            $(this).addClass('active');
            $(this).children('.submenu-container').addClass('active');
            setTimeout(function(){
                isOpen = true;
            }, 100);

        });

        // Mobile js
        // $('.main-navigation').on('click', '.menu-item-has-children .click-arrow', function(event) {
        //     event.preventDefault();
        //     /* Act on the event */
        //     $('.main-navigation').addClass('sub-menu-open');
        //     $('.menu-toggle-back').addClass('menu-toggle-back-open');
        //     $('.open-toggle').hide();
        //     // $(this).parents('.menu-item').toggleClass('nav-children-open');
        //     $(this).parents('.menu-item').find('.sub-menu').clone().appendTo("#mobile-menu-handle");
        // });


        

        $('body').on('click', '.menu-back-js', function(event) {
            event.preventDefault();

            $('.main-navigation').removeClass('sub-menu-open');
            $('.menu-toggle-back').removeClass('menu-toggle-back-open');
            $('.open-toggle').show();
            setTimeout(function(){
                $('body').find("#mobile-menu-handle").empty();
            }, 400);
            

        });
    }

    MYFUNCTION.swiperInit = function() {

        const swiperReviewInit = new Swiper('.swiper-review-init', {
            // Optional parameters
            loop: true,
            slidesPerView: 1,
            spaceBetween: 10,
            breakpoints: {
                // when window width is >= 580px
                580: {
                  slidesPerView: 2,
                  spaceBetween: 10
                },
                // when window width is >= 676px
                992: {
                  slidesPerView: 3,
                  spaceBetween: 24
                }
            },
            navigation: {
                nextEl: '.section-review-slider .swiper-button-next',
                prevEl: '.section-review-slider .swiper-button-prev',
            },

        });

    }



     // DOCUMENT READY //
    $(document).ready(function() {
        "use strict"; 
 
        MYFUNCTION.DOMInfo.getWindowSize();
        MYFUNCTION.scrollPointer();

        // menu scroll effect
        MYFUNCTION.onScrollEvent();

        // Init Doom Info
        MYFUNCTION.DOMInfo.bindEvents();

        if (MYFUNCTION.DOMInfo.isTouchDevice()) {
            $('body').addClass('touch');
        } else {
            $('body').addClass('no-touch');
        }

        // MYFUNCTION.mobileMenu();
  
        MYFUNCTION.navSubMenu();

        MYFUNCTION.swiperInit(); 

        setTimeout(MYFUNCTION.removeLoader(), 400);

    });
    window.addEventListener('scroll', MYFUNCTION.onScrollEvent, {passive: true});


})(jQuery);


    