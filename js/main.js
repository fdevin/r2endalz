(function(jQuery) {

    jQuery(document).ready(function() {






        jQuery("#amout-imput-value").change(function() {

            var inivalh = jQuery("#amout-imput-value").val();

            jQuery('input[name=amount]').val(currencyFormat(inivalh));

        });



        jQuery("input:checkbox").on('click', function() {
            // in the handler, 'this' refers to the box clicked on
            var jQuerybox = jQuery(this);
            if (jQuerybox.is(":checked")) {
                var group = "input:checkbox[name='" + jQuerybox.attr("name") + "']";
                jQuery(group).prop("checked", false);
                jQuerybox.prop("checked", true);
                console.log(jQuerybox[0]['id']);


                if (jQuerybox[0]['id'] == 'select-amount-1') {
                    var text = jQuery('#label-1').text();

                    console.log(text);
                    var montoFormat = text.replace(/[jQuery.]/g, '');
                    jQuery("input[name='amount']").val(currencyFormat(montoFormat));
                }


                if (jQuerybox[0]['id'] == 'select-amount-2') {
                    var text = jQuery('#label-2').text();
                    console.log(text);
                    var montoFormat = text.replace(/[jQuery.]/g, '');
                    jQuery("input[name='amount']").val(currencyFormat(montoFormat));
                }


                if (jQuerybox[0]['id'] == 'select-amount-3') {
                    var text = jQuery('#label-3').text();
                    console.log(text);
                    var montoFormat = text.replace(/[jQuery.]/g, '');
                    jQuery("input[name='amount']").val(currencyFormat(montoFormat));
                }


                if (jQuerybox[0]['id'] == 'select-amount-4') {
                    var text = document.getElementById("amout-imput-value").value;

                    if (text == "") {
                        jQuery("input[name='amount']").val('0');
                        jQuery("#amout-imput-value").val('0');

                    } else {
                        console.log(text);
                        var montoFormat = text.replace(/[jQuery.]/g, '');
                        jQuery("input[name='amount']").val(currencyFormat(montoFormat));
                    }

                }



            } else {
                jQuerybox.prop("checked", false);
            }
        });

        var base_url = window.location.origin;



        link_scrolldown();
        if (jQuery(window).width() <= 992) {

            var content = document.getElementById("fixed-content");
            var height = content.clientHeight - 50;
            // console.log(content.clientWidth);
            console.log();
            document.getElementById('content-body-all').style.marginTop = height + "px";

            jQuery('.slider-join').slick({
                dots: true,
                infinite: false,
                speed: 300,
                slidesToShow: 1,
                lidesToScroll: 1,
                centerMode: false,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 2000
            });

            jQuery('.slider-beneficiarios').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                lidesToScroll: 1,
                centerMode: false,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 2000
            });

            jQuery('.slider-about').slick({
                dots: true,
                infinite: false,
                speed: 300,
                slidesToShow: 1,
                lidesToScroll: 1,
                centerMode: false,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 2000
            });

            jQuery('.slider-landing').slick({
                dots: true,
                infinite: false,
                speed: 300,
                slidesToShow: 1,
                lidesToScroll: 1,
                centerMode: false,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 2000
            });
        } else {}



        var x = window.matchMedia("(min-width: 992px)")
        matchMediaquery(x) // Call listener function at run time
        x.addListener(matchMediaquery) // Attach listener function on state changes


        jQuery(window).resize(function() {
            //resized();
        });

        var base_url = window.location.origin;

        jQuery('.mas-populares').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 3,
            lidesToScroll: 3,
            centerMode: false,
            arrows: true,
            nextArrow: '<img class="slick-next" src="' + base_url + '/wp-content/themes/r2endalz-pro/images/arrow-right.svg" alt="" style="height: auto;">',
            prevArrow: '<img class="slick-prev" src="' + base_url + '/wp-content/themes/r2endalz-pro/images/arrow-left.svg" alt="" style="height: auto;">',
            responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: false,
                        arrows: true,
                    }
                }, {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true,
                        arrows: false,
                    }
                }
            ]
        });



        jQuery('.slider-beneficios').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            lidesToScroll: 1,
            centerMode: false,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 2000
        });



        load_modal();

        function testAnim(x) {
            jQuery('.modal .modal-dialog').attr('class', 'modal-dialog  ' + x + '  animated');
        };
        jQuery('.modal').on('show.bs.modal', function(e) {
            jQuery("body").addClass("modal-open");
            // var anim = jQuery('#entrance').val();
            // testAnim(anim);
            // jQuery('.modal .modal-dialog').attr('class', 'modal-dialog modal-xl modal-dialog-centered  fadeInLeft  animated');
        })
        jQuery('.modal').on('hide.bs.modal', function(e) {
            console.log('hide');
            jQuery("body").removeClass("modal-class");
            jQuery("body").removeClass("modal-open");
            jQuery('.modal-backdrop').remove();
            // var anim = jQuery('#exit').val();
            // testAnim(anim);
            // jQuery('.modal .modal-dialog').attr('class', 'modal-dialog modal-xl modal-dialog-centered  fadeOutRight  animated');
        })

    });

    function currencyFormat(num) {
        console.log(num);
        var newnum = Number(num);
        return 'jQuery' + newnum.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, 'jQuery1,');
    }



    function matchMediaquery(x) {
        if (x.matches) { // If media query matches


            menu_stiky();

        } else {

        }
    }

    function menu_stiky() {
        var altura = jQuery('.fixed-content').offset().top;

        jQuery(window).on('scroll', function() {
            if (jQuery(window).scrollTop() > altura) {
                jQuery('.fixed-content').addClass('menu-fixed');
            } else {
                jQuery('.fixed-content').removeClass('menu-fixed');
            }
        });
    }

    function menu_stiky_movil() {
        var altura = jQuery('.fixed-content').offset().top;

        jQuery(window).on('scroll', function() {
            if (jQuery(window).scrollTop() > altura) {
                jQuery('.fixed-content').addClass('menu-fixed');
            } else {
                jQuery('.fixed-content').removeClass('menu-fixed');
            }
        });
    }

    function link_scrolldown() {
        jQuery('a[href*="#"]')
            // Remove links that don't actually link to anything
            .not('[href="#"]')
            .not('[href="#0"]')
            .click(function(event) {
                // On-page links
                if (
                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                    location.hostname == this.hostname
                ) {
                    // Figure out element to scroll to
                    var target = jQuery(this.hash);
                    target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        jQuery('html, body').animate({
                            scrollTop: target.offset().top - 100
                        }, 1000, function() {
                            // Callback after animation
                            // Must change focus!
                            var jQuerytarget = jQuery(target);
                            jQuerytarget.focus();
                            if (jQuerytarget.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                //jQuerytarget.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                                jQuerytarget.focus(); // Set focus again
                            };
                        });
                    }
                }
            });
    }





}(jQuery));