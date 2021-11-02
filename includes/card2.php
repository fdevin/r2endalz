<?php if ( have_rows( 'card_2b' ) ) : ?>
<div class="col-md-4 ">
    <?php while ( have_rows( 'card_2b' ) ) : the_row(); ?>
    <div class="bigCard">
        <div class="cardHead">
            <h3><?php the_sub_field( 'card_title2' ); ?></h3>
            <img src="<?php bloginfo('template_directory'); ?>/images/join-race.png" alt="" />

        </div>
        <div class="cardBody">
            <?php if ( have_rows( 'card_list2' ) ) : ?>
            <ul>
                <?php while ( have_rows( 'card_list2' ) ) : the_row(); ?>
                <li><?php the_sub_field( 'list_item2' ); ?></li>
                <?php endwhile; ?>
            </ul>
            <?php else : ?>
            <?php // no rows found ?>
            <?php endif; ?>

            <div class="amount">
                <p>Amount</p>
                <p id="label-2" class="amounNum"><?php the_sub_field( 'card_amount2b' ); ?></p>
                <label class="content-check">Select
                    <input type="checkbox" id="select-amount-2" name="amount-checkbox" value="option-2">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>
<?php endif; ?>
<!-- /card 2 -->