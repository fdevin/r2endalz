<?php
/**
 * @package WordPress
 * @subpackage R2Endalz
  */
?>
<h3>Comments</h3>
	<div id="comments">
	    <?php if($comments) : ?>  
        <ul>  
        <?php foreach($comments as $comment) : ?>  
            <li id="comment-<?php comment_ID(); ?>">  
                <?php if ($comment->comment_approved == '0') : ?>  
                    <p>Your comment is awaiting approval</p>  
                <?php endif; ?>  
                
                <p class="commauthor"><?php comment_author_link(); ?></p>  
				<?php comment_text(); ?>  
				<hr/>
				<p class="commdate"><?php comment_date(); ?></p>
            </li>  
        <?php endforeach; ?>  
        </ul>  
    <?php else : ?>  
        <p>No comments yet</p>  
    <?php endif; ?>  

	<div id="comments-form">
	    <?php if(comments_open()) : ?>  
        <?php if(get_option('comment_registration') && !$user_ID) : ?>  
            <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p><?php else : ?>  
            <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">  
                <?php if($user_ID) : ?>  
                    <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>  
                <?php else : ?>  
                    
					<div class="commlabel"><label for="author">Name</label></div>
					<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />  
                   
                   
					<div class="commlabel"><label for="email">Mail</label></div>
					<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />  
                   
                    
                <?php endif; ?>  
                <p><textarea name="comment" id="comment" cols="60" rows="10" tabindex="4"></textarea></p>  
                <p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />  
                <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>  
                <?php do_action('comment_form', $post->ID); ?>  
            </form>  
        <?php endif; ?>  
    <?php else : ?>  
        <p>The comments are closed.</p>  
    <?php endif; ?>  
	</div>

</div><!-- #comments -->
