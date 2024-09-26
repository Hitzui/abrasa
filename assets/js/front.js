
document.addEventListener( 'DOMContentLoaded', function () {

} );

$(function () {

    let main = new Splide( '#main-carousel-view-product', {
        type      : 'fade',
        rewind    : true,
        pagination: false,
        arrows    : false
    } );


    let thumbnails = new Splide( '#thumbnail-carousel-view-product', {
        fixedWidth  : 100,
        fixedHeight : 60,
        gap         : 10,
        rewind      : true,
        pagination  : false,
        isNavigation: true,
        breakpoints : {
            600: {
                fixedWidth : 60,
                fixedHeight: 44,
            },
        },
    } );


    main.sync( thumbnails );
    main.mount();
    thumbnails.mount();

    thumbnails.on( 'move', function (event) {
        console.log( 'move', event );
    } );

    $('.splide__slide').on('click',function(event) {
        let dataValue = $(this).data("value");
        console.log(dataValue);
    });

    // ------------------------------------------------------- //
    // Navbar Sticky
    // ------------------------------------------------------ //
    $(window).on('scroll', function () {
        if ($(window).scrollTop() > ($('.top-bar').outerHeight())) {
            $('header.nav-holder.make-sticky').addClass('sticky');
            $('body').css('padding-top', '' + $('#navbar').outerHeight() + 'px');

        } else {
            $('header.nav-holder.make-sticky').removeClass('sticky');
            $('body').css('padding-top', '0');
        }
    });

    // ------------------------------------------------------- //
    // Multi-level dropdown
    // ------------------------------------------------------ //

    $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function (event) {
        event.preventDefault();
        event.stopPropagation();

        $(this).siblings().toggleClass("show");


        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

    });

    // ------------------------------------------------------- //
    // Scroll To
    // ------------------------------------------------------ //
    $('.scroll-to').on('click', function (e) {

        e.preventDefault();
        var full_url = this.href;
        var parts = full_url.split("#");
        var target = parts[1];
        if ($('header.nav-holder').hasClass('sticky')) {
            var offset = -80;
        } else {
            var offset = -180;
        }

        var offset = $('header.nav-holder').outerHeight();

        $('body').scrollTo($('#' + target), 800, {
            offset: -offset
        });

    });


    // ------------------------------------------------------- //
    // Tooltip Initialization
    // ------------------------------------------------------ //
    $('[data-toggle="tooltip"]').tooltip();


    // ------------------------------------------------------- //
    // Product Gallery Slider
    // ------------------------------------------------------ //
    function productDetailGallery() {
        $('a.thumb').on('click', function (e) {
            e.preventDefault();
            source = $(this).attr('href');
            $('#mainImage').find('img').attr('src', source);
        });

        for (i = 0; i < 3; i++) {
            setTimeout(function () {
                $('a.thumb').eq(i).trigger('click');
            }, 300);
        }
    }

    productDetailGallery();


    // ------------------------------------------------------- //
    // Articulos Slider Index
    // ------------------------------------------------------ //

    $('.articulos').owlCarousel({
        loop: true,
        animateOut: 'slideOutDown',
        animateIn: 'flipInX',
        margin: 15,
        dots: false,
        nav: true,
        navText: [
            "<span style='font-size:18px'><i class='fas fa-arrow-circle-left'></i></span>",
            "<span style='font-size:18px'><i class='fas fa-arrow-circle-right'></i></span>"
        ],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            800: {
                items: 3
            },
            1450: {
                items: 5
            }
        }
    });

    // ------------------------------------------------------- //
    // Customers Slider
    // ------------------------------------------------------ //
    $(".customers").owlCarousel({
        loop: true,
        animateOut: 'slideOutDown',
        animateIn: 'flipInX',
        margin: 0,
        dots: false,
        nav: true,
        navText: [
            "<span style='font-size:28px'><i class='fas fa-arrow-circle-left'></i></span>",
            "<span style='font-size:28px'><i class='fas fa-arrow-circle-right'></i></span>"
        ],
        responsiveClass: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 6
            }
        }
    });


    // ------------------------------------------------------- //
    // Testimonials Slider
    // ------------------------------------------------------ //
    $(".testimonials").owlCarousel({
        items: 4,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });


    // ------------------------------------------------------- //
    // Homepage Slider
    // ------------------------------------------------------ //
    $('.homepage').owlCarousel({
        loop: true,
        margin: 0,
        dots: true,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        addClassActive: true,
        navText: [
            "<i class='fa fa-angle-left' style='font-size:20px'></i>",
            "<i class='fa fa-angle-right' style='font-size:20px'></i>"
        ],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1,
                loop: true
            }
        }
    });


    // ------------------------------------------------------- //
    // Project Caroudel
    // ------------------------------------------------------ //
    $('.project').owlCarousel({
        loop: true,
        margin: 0,
        dots: true,
        nav: true,
        autoplay: true,
        smartSpeed: 1000,
        addClassActive: true,
        lazyload: true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1,
                loop: true
            }
        }
    });


    // ------------------------------------------------------- //
    // click on the box activates the radio
    // ------------------------------------------------------ //
    $('#checkout').on('click', '.box.shipping-method, .box.payment-method', function (e) {
        var radio = $(this).find(':radio');
        radio.prop('checked', true);
    });


    // ------------------------------------------------------- //
    //  Bootstrap Select
    // ------------------------------------------------------ //
    $('.bs-select').selectpicker({
        style: 'btn-light',
        size: 4
    });


    // ------------------------------------------------------- //
    //  Shop Detail Carousel
    // ------------------------------------------------------ //
    $('.shop-detail-carousel').owlCarousel({
        items: 1,
        thumbs: true,
        nav: false,
        dots: false,
        autoplay: true,
        thumbsPrerendered: true
    });


});