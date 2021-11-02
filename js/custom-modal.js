var page = 2;
jQuery(function($) {
    $('body').on('click', '.loadmore', function() {
        const queryString = window.location.search;
        console.log(queryString);
        const urlParams = new URLSearchParams(queryString);

        const param = urlParams.get('param')
        console.log(param);

        var data_modal = {
            'action': 'load_modal_posts_by_ajax',
            'page': page,
            'param': param,
            'security': modal.security
        };



        $.post(modal.ajaxurl, data_modal, function(response) {

            if ($.trim(response) != '') {

                $('.modal-div').append(response);
                load_modal();
                page++;
            } else {}
        });

    });
    $(document).ready(function() {
        load_modal();
    });

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


        $('.modal').on('hide.bs.modal', function(e) {
            console.log('hide');
            $("body").removeClass("modal-class");
            $("body").removeClass("modal-open");
            $('.modal-backdrop').remove();
            // var anim = $('#exit').val();
            // testAnim(anim);
            // $('.modal .modal-dialog').attr('class', 'modal-dialog modal-xl modal-dialog-centered  fadeOutRight  animated');
        })
    }




    $('.modal').on('hide.bs.modal', function(e) {
        console.log('hide');
        $("body").removeClass("modal-class");
        $("body").removeClass("modal-open");
        $('.modal-backdrop').remove();
        // var anim = $('#exit').val();
        // testAnim(anim);
        // $('.modal .modal-dialog').attr('class', 'modal-dialog modal-xl modal-dialog-centered  fadeOutRight  animated');
    })
});