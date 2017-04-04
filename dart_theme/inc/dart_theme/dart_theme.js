/* Ajax functions */
jQuery(document).ready(function($) {

    $(document).on('click', '.dart-theme-load-more', function () {

        var that = $(this);
        var page = $(this).data('page');
        var newPage = page+1;
        var ajaxurl = that.data('url');

        $.ajax({

            url: ajaxurl,
            type: 'post',
            data: {
                page: page,
                action: 'dart_theme_load_more'
            },
            error: function( response ){
                console.log( response )
            },
            success: function ( response ) {

                that.data('page', newPage);
                if( response == 0 ){

                    $('.dart-theme-posts-container').append( '<div class="text-center"><h3>You reached the end of the line!</h3><p>No more posts to load</p></div>' );
                    that.slideUp(320);

                }else {

                    $('.dart-theme-posts-container').append(response);

                }

            }
        });

    });



});
