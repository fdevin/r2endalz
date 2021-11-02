(function($) {

        $(document).ready(function() {






            $("#amout-imput-value").change(function() {

                var inivalh = $("#amout-imput-value").val();

                $('input[name=amount]').val(currencyFormat(inivalh));

            });



            $("input:checkbox").on('click', function() {
                // in the handler, 'this' refers to the box clicked on
                var $box = $(this);
                if ($box.is(":checked")) {
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    $(group).prop("checked", false);
                    $box.prop("checked", true);
                    console.log($box[0]['id']);


                    if ($box[0]['id'] == 'select-amount-1') {
                        var text = $('#label-1').text();

                        console.log(text);
                        var montoFormat = text.replace(/[$.]/g, '');
                        $("input[name='amount']").val(currencyFormat(montoFormat));
                    }


                    if ($box[0]['id'] == 'select-amount-2') {
                        var text = $('#label-2').text();
                        console.log(text);
                        var montoFormat = text.replace(/[$.]/g, '');
                        $("input[name='amount']").val(currencyFormat(montoFormat));
                    }


                    if ($box[0]['id'] == 'select-amount-3') {
                        var text = $('#label-3').text();
                        console.log(text);
                        var montoFormat = text.replace(/[$.]/g, '');
                        $("input[name='amount']").val(currencyFormat(montoFormat));
                    }


                    if ($box[0]['id'] == 'select-amount-4') {
                        var text = document.getElementById("amout-imput-value").value;

                        if (text == "") {
                            $("input[name='amount']").val('0');
                            $("#amout-imput-value").val('0');

                        } else {
                            console.log(text);
                            var montoFormat = text.replace(/[$.]/g, '');
                            $("input[name='amount']").val(currencyFormat(montoFormat));
                        }

                    }



                } else {
                    $box.prop("checked", false);
                }
            });

            var base_url = window.location.origin;



            function currencyFormat(num) {
                console.log(num);
                var newnum = Number(num);
                return '$' + newnum.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            }

            function load_modal() {
                $("div[id^='gallerry-']").each(function() {

                    var currentModal = $(this);

                    //click next
                    currentModal.find('.btn-next').click(function() {

                        currentModal.modal('hide');
                        currentModal.closest("div[id^='gallerry-']").nextAll("div[id^='gallerry-']").first().modal('show');
                        var body = document.body;
                        body.classList.add("modal-class");
                    });

                    //click prev
                    currentModal.find('.btn-prev').click(function() {

                        currentModal.modal('hide');
                        currentModal.closest("div[id^='gallerry-']").prevAll("div[id^='gallerry-']").first().modal('show');
                        var body = document.body;
                        body.classList.add("modal-class");
                    });

                });
            }

            function matchMediaquery(x) {
                if (x.matches) { // If media query matches


                    menu_stiky();

                } else {

                }
            }

            function menu_stiky() {
                var altura = $('.fixed-content').offset().top;

                $(window).on('scroll', function() {
                    if ($(window).scrollTop() > altura) {
                        $('.fixed-content').addClass('menu-fixed');
                    } else {
                        $('.fixed-content').removeClass('menu-fixed');
                    }
                });
            }

            function menu_stiky_movil() {
                var altura = $('.fixed-content').offset().top;

                $(window).on('scroll', function() {
                    if ($(window).scrollTop() > altura) {
                        $('.fixed-content').addClass('menu-fixed');
                    } else {
                        $('.fixed-content').removeClass('menu-fixed');
                    }
                });
            }

            function link_scrolldown() {
                $('a[href*="#"]')
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
                            var target = $(this.hash);
                            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                            // Does a scroll target exist?
                            if (target.length) {
                                // Only prevent default if animation is actually gonna happen
                                event.preventDefault();
                                $('html, body').animate({
                                    scrollTop: target.offset().top - 100
                                }, 1000, function() {
                                    // Callback after animation
                                    // Must change focus!
                                    var $target = $(target);
                                    $target.focus();
                                    if ($target.is(":focus")) { // Checking if the target was focused
                                        return false;
                                    } else {
                                        //$target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                                        $target.focus(); // Set focus again
                                    };
                                });
                            }
                        }
                    });
            }





        }(jQuery));