<?php

/**
 * @package WordPress
 * @subpackage R2Endalz
 * Template Name: Donate
 */
get_header(); ?>
<!-- ***************************** START CONTENT ZONE ********************************* -->


<main>
    <section class=" donateHero" style="background:<?php the_field('hero_background_color'); ?> url(<?php the_post_thumbnail_url('full'); ?>) no-repeat top center; background-size:cover">
        <div class="container">
            <div class="row">
                <div class="col-12 ">

                    <h1><?php the_field('heading'); ?></h1>
                    <p class="strongest"><?php the_field('sub-heading'); ?></p>

                </div>

            </div>
        </div>
    </section>
    <section class="subHero">
        <div class="container ">
            <div class="row">
                <div class="col-12 col-md-4">
                    <?php the_field('top_left_column'); ?>
                </div>
                <div class="col-12 col-md-4">
                    <?php the_field('top_right_column'); ?>
                </div>
            </div>
        </div>
    </section>

    <?php if (get_field('enable_default_editor') == 1) {
        include(get_template_directory() . '/includes/default.php');
    } else {
        // echo 'nooo'; 
    } ?>
    <section class="content donateFormPage" style="background:<?php the_field('page_background_color'); ?>;">
        <div class="container" style="background:<?php the_field('form_background_color'); ?>;">


            <div class="row titleRow">
                <div class="box-header col">
                    <label for="">Step 1</label> <span>Confirm your donation amount</span>
                    <hr>
                </div>
            </div>
            <div class="row cardsRow">

                <?php if (get_field('add_card_1') == 1) {
                    include(get_template_directory() . '/includes/card1.php');
                } else {
                    // echo 'false'; 
                } ?>
                <?php if (get_field('add_card_2') == 1) {
                    include(get_template_directory() . '/includes/card2.php');
                } else {
                    // echo 'false'; 
                } ?>
                <?php if (get_field('add_card_3') == 1) {
                    include(get_template_directory() . '/includes/card3.php');
                } else {
                    // echo 'false'; 
                } ?>

            </div>
            <!-- /cardsRow -->
            <?php if (get_field('any_amount_row') == 1) {
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

            <?php echo do_shortcode('[contact-form-7 id="1120" campaign="' . $campaign . '"]'); ?>
        </div>
    </section>


    <?php $content = get_field('content_block'); ?>

    <section class="finalContent">
        <div class="container defaultContent">
            <div class="row">
                <div class="col">
                    <?php echo ($content); ?>
                </div>
            </div>
        </div>
    </section>

</main>



<?php get_footer(); ?>