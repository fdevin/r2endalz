<?php if ( have_rows( 'card_1' ) ) : ?>
<?php while ( have_rows( 'card_1' ) ) : the_row(); ?>

<div class="col-md-4 ">
    <div class="smallCard">
        <div class="cardHead">
            <img src="<?php bloginfo('template_directory'); ?>/images/ribbon.png" alt="" />
            <h3><?php the_sub_field( 'card_title' ); ?></h3>
        </div>
        <div class="cardBody">
            <?php if ( have_rows( 'card_list' ) ) : ?>
            <ul>
                <?php while ( have_rows( 'card_list' ) ) : the_row(); ?>
                <li><?php the_sub_field( 'list_item' ); ?></li>
                <?php endwhile; ?>
            </ul>
            <?php else : ?>
            <?php // no rows found ?>
            <?php endif; ?>

            <div class="amount">
                <p>Amount</p>
                <p id="label-1" class="amounNum"><?php the_sub_field( 'card_amount' ); ?></p>
                <label class="content-check">Select
                    <input type="checkbox" id="select-amount-1" name="amount-checkbox" value="option-1">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>
<?php endif; ?>
<!-- /card 1 -->