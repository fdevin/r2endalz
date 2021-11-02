<section class="content donateForm" id="donate">
            <div class="container">


                <div class="row cardsRow">
                    <div class="col-lg-4 ">
                        <div class="smallCard">
                            <div class="cardHead">
                                <img src="<?php bloginfo('template_directory'); ?>/images/ribbon.png" alt="" />
                                <p class="hugeNum"><?php the_sub_field( 'amount_remembrance' ); ?></p>
                                <h3><?php the_sub_field( 'remembrance_title' ); ?></h3>
                            </div>
                            <div class="cardBody">
                            <?php the_sub_field( 'content_list_remembrance' ); ?>
                                <a href="<?php bloginfo('url');?>/donate/" class="btn ghost">Donate Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- /card 1 -->
                    <div class="col-lg-4">
                        <div class="bigCard">
                            <div class="cardHead">
                                <h3>Join the race</h3>
                                <img src="<?php bloginfo('template_directory'); ?>/images/2021-BMW-join-24bit-440px.png" alt="" />

                            </div>

                            <div class="cardBody">
                                <p class="joinRaceNum"><?php the_sub_field( 'amount_join_race' ); ?></p>
                                <p class="joinRaceSmall"><?php the_sub_field( 'join_race_title' ); ?></p>
                                <?php the_sub_field( 'join_race_content' ); ?>
                               <a href="<?php bloginfo('url');?>/donate/" class="btn ghost">Donate Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- /card 2 -->
                    <div class="col-lg-4">
                        <div class="smallCard">
                            <div class="cardHead">
                                <img src="<?php bloginfo('template_directory'); ?>/images/ribbon.png" alt="" />
                                <p class="hugeNum"><?php the_sub_field( 'amount_turbo_sponsorship' ); ?></p>
                                <h3><?php the_sub_field( 'turbo_sponsorship_title' ); ?></h3>
                            </div>
                            <div class="cardBody">
                            <?php the_sub_field( 'turbo_sponsorship_content' ); ?>
                               <a href="<?php bloginfo('url');?>/donate/" class="btn ghost">Donate Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- /card 3 -->
                </div>
                <!-- /cardsRow -->
                <div class="row buttonRow"><a href="<?php bloginfo('url');?>/donate/"  class="btn CTA2 CTA3">Or make a donation in any amount</a></div>
                <!-- /anyAmount -->

            </div>


        </section>