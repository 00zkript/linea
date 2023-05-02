// window.addEventListener("resize", function() {
//     "use strict"; window.location.reload();
// });
document.addEventListener("DOMContentLoaded", function(){
    // make it as accordion for smaller screens
    if (window.innerWidth > 992) {
        document.querySelectorAll('.navbar .dropdown').forEach(function(everyitem){
            everyitem.addEventListener('mouseover', function(e){
                let el_link = this.querySelector('a[data-bs-toggle]');
                if(el_link != null){
                    let nextEl = el_link.nextElementSibling;
                    el_link.classList.add('show');
                    nextEl.classList.add('show');
                }
            });
            everyitem.addEventListener('mouseleave', function(e){
                let el_link = this.querySelector('a[data-bs-toggle]');
                if(el_link != null){
                    let nextEl = el_link.nextElementSibling;
                    el_link.classList.remove('show');
                    nextEl.classList.remove('show');
                }
            })
        });
    }
    // end if innerWidth

    // make it as accordion for smaller screens
    if (window.innerWidth < 992) {
        /////// Prevent closing from click inside dropdown
        document.querySelectorAll('.dropdown-menu').forEach(function(element){
            element.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        });

        // close all inner dropdowns when parent is closed
        document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
            everydropdown.addEventListener('hidden.bs.dropdown', function () {
                // after dropdown is hidden, then find all submenus
                this.querySelectorAll('.submenu').forEach(function(everysubmenu){
                    let claseAnt = everysubmenu.previousElementSibling;
                    // hide every submenu as well
                    everysubmenu.style.display = 'none';
                    claseAnt.classList.remove('show');
                });
            })
        });

        document.querySelectorAll('.dropdown-menu a').forEach(function(element){
            element.addEventListener('click', function (e) {

                let nextEl = this.nextElementSibling;
                let claseAnt = nextEl.previousElementSibling;
                if(nextEl && nextEl.classList.contains('submenu')) {
                    // prevent opening link if link needs to open dropdown
                    e.preventDefault();

                    // console.log(nextEl);
                    // console.log(claseAnt);
                    if(nextEl.style.display == 'block'){
                        nextEl.style.display = 'none';

                        claseAnt.classList.remove('show');
                    } else {
                        nextEl.style.display = 'block';
                        claseAnt.classList.add('show');
                    }

                }
            });
        })
    }
    // end if innerWidth

});
// DOMContentLoaded  end


/*menu interactivo simple*/
window.onscroll = function() {scrollFunction()};
const body = document.body;
const triggerMenu = document.querySelector(".menu-efecto");
function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("header").classList.add("menu-on");
        const paddingBodySuma = (triggerMenu.offsetHeight+(triggerMenu.offsetHeight/2));
        const paddingBody = (paddingBodySuma+'px');

        body.style.paddingTop = paddingBody;
    } else {
        document.getElementById("header").classList.remove("menu-on");
        body.style.paddingTop = "0";
    }
}
/*fin menu interactivo simple*/
/* Página preloader */
$(window).on('load', function(){
    $('#loader-wrapper').delay(900).fadeOut();
    /*$( '#loader-wrapper' ).fadeOut( 1000, function() {
        $( this ).fadeOut();
    });*/
});
/* Fin Página preloader */
$(document).ready(function () {

    /* $("html").niceScroll({
        cursorcolor:        "#009fa1",
        cursorwidth:        "10px",
        cursorborder:       "0px solid #000",
        cursorborderradius: "0px",
        // scrollspeed:        60,
        autohidemode:       false,
        // background:         '#ddd',
        // hidecursordelay:    400,
        cursorfixedheight:  false,
        cursorminheight:    20,
        enablekeyboard:     true,
        horizrailenabled:   false,
        bouncescroll:       false,
        smoothscroll:       true,
        iframeautoresize:   true,
        touchbehavior:      false,
        zindex: 999
    }); */
    $('.navbar-toggler').click(function(){
        if($(this).hasClass('collapsed')){
            $('body').removeClass("fullwidth");
        }else{
            $('body').addClass("fullwidth");
        }
    });


    /*slider slick*/
    $('.popup-home').slick({
        dots: false,
        arrows: true,
        infinite: true,
        adaptiveHeight: true,
        speed: 800,
        slidesToShow: 1,
        lazyLoad: "progressive"
    });
    $('.banner-home').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 1000,
        slidesToShow: 1,
        adaptiveHeight: true,
        autoplaySpeed: 5000,
        lazyLoad: 'ondemand',
        // fade: true,
        // cssEase: 'linear',
        autoplay: {
            delay: 8500,
            disableOnInteraction: false,
        }
    });
    $('#slick0').slick({
        dots: false,
        infinite: true,
        speed: 900,
        slidesToShow: 4,
        slidesToScroll: 4,
        centerPadding: '40px',
        adaptiveHeight: true,
        lazyLoad: 'ondemand',
        autoplay: {
            delay: 1500,
            disableOnInteraction: false,
        },
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    centerPadding: '20px',
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            }
        ]
    });
    $('#slick1').slick({
        dots: false,
        infinite: true,
        speed: 900,
        slidesToShow: 4,
        slidesToScroll: 4,
        centerPadding: '40px',
        adaptiveHeight: true,
        lazyLoad: 'ondemand',
        autoplay: {
            delay: 1500,
            disableOnInteraction: false,
        },
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    centerPadding: '20px',
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            }
        ]
    });
    $('#slick2').slick({
        dots: false,
        infinite: true,
        speed: 900,
        slidesToShow: 4,
        slidesToScroll: 4,
        centerPadding: '40px',
        adaptiveHeight: true,
        lazyLoad: 'ondemand',
        autoplay: {
            delay: 1500,
            disableOnInteraction: false,
        },
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    centerPadding: '20px',
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            }
        ]
    });
    $('#slick3').slick({
        dots: false,
        infinite: true,
        speed: 900,
        slidesToShow: 4,
        slidesToScroll: 4,
        centerPadding: '40px',
        adaptiveHeight: true,
        lazyLoad: 'ondemand',
        autoplay: {
            delay: 1500,
            disableOnInteraction: false,
        },
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    centerPadding: '20px',
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            }
        ]
    });
    $('#slick4').slick({
        dots: false,
        infinite: true,
        speed: 900,
        slidesToShow: 4,
        slidesToScroll: 4,
        centerPadding: '40px',
        adaptiveHeight: true,
        lazyLoad: 'ondemand',
        autoplay: {
            delay: 1500,
            disableOnInteraction: false,
        },
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    centerPadding: '20px',
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            }
        ]
    });
    $('#slick5').slick({
        dots: false,
        infinite: true,
        speed: 900,
        slidesToShow: 4,
        slidesToScroll: 4,
        centerPadding: '40px',
        adaptiveHeight: true,
        lazyLoad: 'ondemand',
        autoplay: {
            delay: 1500,
            disableOnInteraction: false,
        },
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    centerPadding: '20px',
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            }
        ]
    });
    $('#slick6').slick({
        dots: false,
        infinite: true,
        speed: 900,
        slidesToShow: 4,
        slidesToScroll: 4,
        centerPadding: '40px',
        adaptiveHeight: true,
        lazyLoad: 'ondemand',
        autoplay: {
            delay: 1500,
            disableOnInteraction: false,
        },
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    centerPadding: '20px',
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            }
        ]
    });
    $('#slickMarcas').slick({
        dots: false,
        infinite: true,
        speed: 900,
        slidesToShow: 6,
        slidesToScroll: 6,
        centerPadding: '40px',
        adaptiveHeight: true,
        lazyLoad: 'ondemand',
        autoplaySpeed: 7000,
        autoplay: {
            delay: 1500,
            disableOnInteraction: false,
        },
        responsive: [
            {
                breakpoint: 1082,
                settings: {
                    centerPadding: '20px',
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            },
            {
                breakpoint: 767,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    arrows: true,
                    speed: 300,
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            }
        ]
    });
    $('#slickBlog').slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 600,
        slidesToShow: 3,
        slidesToScroll: 3,
        centerPadding: '40px',
        adaptiveHeight: true,
        lazyLoad: 'ondemand',
        autoplay: {
            delay: 1500,
            disableOnInteraction: false,
        },
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    centerPadding: '20px',
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    arrows: false,
                    speed: 300,
                    dots: true,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    speed: 300,
                    variableWidth: true,
                    slidesToShow: 1,
                    infinite: true,
                    centerMode: true,
                    centerPadding: '5rem',
                    dots: true
                }
            }
        ]
    });



    var winWidth = $(window).width();
    if (winWidth > 991) {
        $('a[href*="#"]').on("click",function() {
          // $('a[href*="#"]').removeClass('active');
          // $(this).addClass('active');
           if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
               && location.hostname == this.hostname) {
                   var $target = $(this.hash);
                   $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
                   if ($target.length) {
                       var targetOffset = $target.offset().top-140;
                       $('html,body').animate({scrollTop: targetOffset}, 1000);
                       return false;
                  }
             }
         });

        /*wow efecto*/
        wow = new WOW({
            animateClass: 'animated',
            offset: 100
        });
        wow.init();
        /*fin wow efecto*/
    }
    if (winWidth < 991) {
       $('a[href*="#"]').on("click",function() {
          // $('a[href*="#"]').removeClass('active');
          // $(this).addClass('active');
           if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
               && location.hostname == this.hostname) {
                   var $target = $(this.hash);
                   $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
                   if ($target.length) {
                       var targetOffset = $target.offset().top-128;
                       $('html,body').animate({scrollTop: targetOffset}, 1000);
                       return false;
                  }
             }
         });
    }
    if(winWidth > 767) {
        /*Alto dinámico*/
        setTimeout(function () {
            let max = 0;
            let max2 = 0;
            var max3 = 0;

            $('.alto-dinamico').each(function(){
                const textAlto = $(this).outerHeight();
                const num = parseInt(textAlto);
                if (num > max) {
                    max = num;
                }
            }).next($('.alto-dinamico').css({"height": +max+"px"}));
            $('.alto-dinamico2').each(function(){
                const textAlto = $(this).outerHeight();
                const num = parseInt(textAlto);
                if (num > max2) {
                    max2 = num;
                }
            }).next($('.alto-dinamico2').css({"height": +max2+"px"}));
            $('.alto-dinamico3').each(function(){
                const textAlto = $(this).outerHeight();
                const num = parseInt(textAlto);
                if (num > max3) {
                    max3 = num;
                }
            }).next($('.alto-dinamico3').css({"height": +max3+"px"}));
        }, 2000);
        /*Alto dinámico*/
    }

    /*Tabulador*/
    $("#content article").hide();
    $("#tabs li:first").attr("id", "current");
    $("#content article:first").fadeIn();

    $('#tabs a').click(function(e) {
        e.preventDefault();
        $("#content article").hide();
        $("#tabs li").attr("id", "");
        $(this).parent().attr("id", "current");
        $('#' + $(this).attr('title')).fadeIn();

    });

    if (winWidth < 767) {
        $("#content article").hide();
        $("#tabs li:first").attr("id", "current");
        $("#tabs li").children('a').children('span').show();
        $("#tabs li:first").children('a').children('span').hide();
//        $("#tabs li").children('a').children('b').hide();
//        $("#tabs li:first").children('a').children('b').show();

        $("#content article:first").fadeIn();

        $('#tabs a').click(function(e) {
            e.preventDefault();
            $("#content article").hide();
            $("#tabs li").children('a').children('span').show();
//            $("#tabs li").children('a').children('b').hide();
            $("#tabs li").attr("id", "");
            $(this).parent().attr("id", "current");
            $(this).parent().children('a').children('span').hide();
//            $(this).parent().children('a').children('b').show();
            $('#' + $(this).attr('title')).fadeIn();
        });

        $('a[href*="#"]').on("click",function() {
          // $('a[href*="#"]').removeClass('active');
          // $(this).addClass('active');
           if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
               && location.hostname == this.hostname) {
                   var $target = $(this.hash);
                   $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
                   if ($target.length) {
                       var targetOffset = $target.offset().top-125;
                       $('html,body').animate({scrollTop: targetOffset}, 1000);
                       return false;
                  }
             }
         });

    }

    /*Flecha de regreso*/
    $(window).scroll(function () {
        if ($(this).scrollTop() > 600) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });
    $('.scrollup').click(function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });
    /*Fin Flecha de regreso*/
});
