<?php

/**
 * @package WordPress
 * @subpackage R2Endalz
 */
?>

<footer>
    <div class="container">

        <div class="row mainFooter">

            <?php include(get_template_directory() . '/includes/socialBlock.php'); ?>

        </div>

    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<?php if (is_page_template(array('donate-template.php', 'donate-alt-template.php'))) { ?> <script src="<?php bloginfo('template_directory'); ?>/js/main.js"></script><?php } ?>
<?php if (is_page('wall-of-champions')) { ?>
    <script>
        var exampleModal = document.getElementById('gal')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var recipient = button.getAttribute('data-bs-name')
            var img = button.getAttribute('data-bs-img')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var modalTitle = gal.querySelector('.modal-title')
            var modalImg = gal.querySelector('.theImg')

            modalTitle.textContent = recipient
            modalImg.src = img
        })
      
    </script>
<?php } ?>
<script>
    function naturalRound(e) {

        let dec = e.target.value.indexOf(".")
        let tooLong = e.target.value.length > dec + 3
        let invalidNum = isNaN(parseFloat(e.target.value))

        if ((dec >= 0 && tooLong) || invalidNum) {
            e.target.value = e.target.value.slice(0, -1)
        }
    }

    function getDate() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        today = yyyy + "-" + mm + "-" + dd;
        console.log(today);
        jQuery('input[name=date]').val(today);
        //document.getElementById("date").value = today;
    }

    //call getDate() when loading the page
    getDate();

    // LET'S USE VARIABLES IN URL
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

    var comingFrom = getUrlParameter('sourceForm');

    if (comingFrom != null) {
        document.getElementById('sourceForm').value = comingFrom;
    }
</script>
<?php wp_footer(); ?>

</body>

</html>