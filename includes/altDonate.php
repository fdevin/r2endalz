<section class="content donateFormPage donateAltFormPage">
    <div class="container" style="background:<?php the_sub_field('form_background_color'); ?>;">


        <div class="row titleRow">
            <div class="box-header col">
                <label for="">Step 1</label> <span>Confirm your donation amount</span>
                <hr>
            </div>
        </div>
        <div class="row cardsRow">
            <?php if (get_sub_field('add_card_1') == 1) {
                include(get_template_directory() . '/includes/card1.php');
            } else {
                // echo 'false'; 
            } ?>
            <?php if (get_sub_field('add_card_2') == 1) {
                include(get_template_directory() . '/includes/card2.php');
            } else {
                // echo 'false'; 
            } ?>
            <?php if (get_sub_field('add_card_3') == 1) {
                include(get_template_directory() . '/includes/card3.php');
            } else {
                // echo 'false'; 
            } ?>
        </div>
        <!-- /cardsRow -->
        <?php if (get_sub_field('any_amount_row') == 1) {
            include(get_template_directory() . '/includes/anyAmount.php');
        } else {
            echo '<div class="spacer4"></div>';
        } ?>


        <script>
            (function($) {
                $(document).ready(function() {


                    const queryString = window.location.search;
                    console.log(queryString);

                    const urlParams = new URLSearchParams(queryString);

                    const donate_column = urlParams.get('donate-column')
                    console.log(donate_column);

                    const donate_amount = urlParams.get('donate-amount')
                    console.log(donate_amount);

                    if (donate_amount == null) {
                        var montoFormat = '0';
                    } else {
                        var monto = donate_amount;
                        var montoFormat = monto.replace(/[$.]/g, '');
                    }

                    if (donate_column == 1) {

                        document.getElementById("select-amount-1").checked = true;
                        $("input[name='amount']").val(currencyFormat(montoFormat));

                    }
                    if (donate_column == 2) {
                        document.getElementById("select-amount-2").checked = true;
                        $("input[name='amount']").val(currencyFormat(montoFormat));
                    }
                    if (donate_column == 3) {

                        document.getElementById("select-amount-3").checked = true;
                        $("input[name='amount']").val(currencyFormat(montoFormat));
                    }
                    if (donate_column == 4) {

                        document.getElementById("select-amount-4").checked = true;
                        $("input[name='amount']").val('0');
                    }




                });

                function currencyFormat(num) {
                    console.log(num);
                    var newnum = Number(num);
                    return '$' + newnum.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                }

            }(jQuery));
        </script>

        <?php $campaign = get_field('campaign'); ?>
        <?php if (get_sub_field('use_short_form') == 1) {
            echo do_shortcode('[contact-form-7 id="2328" campaign="' . $campaign . '" iprefertosupport="' . $campaign . '"]');
        } else {
            echo do_shortcode('[contact-form-7 id="1120" campaign="' . $campaign . '"]');
        } ?>




    </div>
</section>