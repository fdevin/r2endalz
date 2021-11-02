<section class="pop-up">
   <div class="container">
       <div class="row">
           <div class="col-lg-12">
               <div class="box-popup" id="pop-up">
                   <img src="<?php echo get_template_directory_uri(); ?>/images/img-modal.png" alt="" style="border-radius: 4px;    width: 100%;">
                    <a  onclick="close_modalito();" class="cerrar"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-close.png" alt=""></a>
             
                   <br>
                    <span> <strong><?php the_field('amount','options-en') ?></strong> </span>

                    <p><?php the_field('description_modal','options-en') ?></p>
              
                    <br>
                        <a class="btn-add" href="<?php the_field('btn_url_modal','options-en') ?>"><?php the_field('btn_name_modal','options-en') ?></a>

                    <br>
                    <br>
               </div>
           </div>
       </div>
   </div>
</section>
<script>

    $( document ).ready(function() {
        setTimeout(function(){ 
            $('.box-popup').fadeIn();
        }, 3000);
    });

    function close_modalito() {
        document.getElementById("pop-up").style.display = "none";
    }
    $(document).scroll(function () {
    });
</script>