<?php

/**
 * @package WordPress
 * @subpackage R2Endalz

 */
get_header(); ?>


<!-- ***************************** START CONTENT ZONE ********************************* -->

    <main class="p404">
      <section class="container titleRow">
        <div class="row">
          <div class="col-12">
            <h1>Oops! Something went wrong. (404 error) </h1>
          </div>
         
        </div>
       
      </section>

      <section class="container-fluid pageSection">
    <div class="container content">
        <div class="row">
		
							

							<div class="col" id="p404">
                                <img class="img404" src="<?php bloginfo('template_directory'); ?>/images/404.svg" alt="404" />

								<p>I&#8217;m sorry, but the page or file
								<?php
								#some variables for the script to use
								#if you have some reason to change these, do.  but wordpress can handle it


									  if (!isset($_SERVER['HTTP_REFERER'])) {
										#politely blames the user for all the problems they caused
											echo "you were looking for at "; #starts assembling an output paragraph
										$casemessage = "could not be found.";
									  } elseif (isset($_SERVER['HTTP_REFERER'])) {
										#this will help the user find what they want, and email me of a bad link
										echo "you were looking for at"; #now the message says I'm sorry, but the page or file you were looking for at...
											#setup a message to be sent to me
										$failuremess = "Someone, probably a legitimate user, tried to go to $website"
											.$_SERVER['REQUEST_URI']." and received a 404 (file not found) error. ";
										$failuremess .= "It likely wasn't the visitor's fault, so please try to fix this as soon as possible.  
											They came from ".$_SERVER['HTTP_REFERER'];
										mail($adminemail, "404 Error Notice For ".$_SERVER['REQUEST_URI'],
											$failuremess, "From: $websitename <noreply@".(str_replace("www.", "", str_replace("http://", "", $website))).">"); #email you about problem
										$casemessage = "The site administrator has been emailed about this problem and will try to fix it as soon as possible."; #set a friendly message
									  }
									  echo " ".$website.$_SERVER['REQUEST_URI']; ?> 
								<?php echo $casemessage; ?>
									</p>
									<h3>You may not be able to find the page or file because of:</h3>
									<ol>
										<li><h4>An out-of-date bookmark/favorite.</h4></li>
										<li><h4>A search engine that has an out-of-date listing for this site.</h4></li>
										<li><h4>A mis-typed address.</h4></li>
									</ol><br>
									<h4>You can search for what you&#8217;re looking for using the search form below</h4>
									
									<?php get_search_form(); ?> 
					
						</div><!-- /404 -->
        </div>
      </div>
  </section>
    </main>


<?php get_footer(); ?>