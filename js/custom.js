var page = 2;
var modal_page = page;




jQuery(function($) {
    $('body').on('click', '.loadmore', function() {


        const queryString = window.location.search;
        console.log(queryString);
        const urlParams = new URLSearchParams(queryString);

        const param = urlParams.get('param')
        console.log(param);




        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'param': param,
            'security': blog.security
        };

        $.post(blog.ajaxurl, data, function(response) {

            if ($.trim(response) != '') {
                $('.blog-posts').append(response);
                page++;
            } else {
                $('.loadmore').hide();
                $('.alert-post').show();

            }
        });
    });
});



// jQuery(window).scroll(function($) {
//     if (jQuery(window).scrollTop() + jQuery(window).height() > jQuery(document).height()) {
//         var data = {
//             'action': 'load_posts_by_ajax',
//             'page': page,
//             'security': blog.security
//         };

//         $.post(blog.ajaxurl, data, function(response) {
//             if($.trim(response) != '') {
//                 $('.blog-posts').append(response);
//                 page++;
//             } else {
//                 $('.loadmore').hide();
//             }
//         });
//     }
// });