(function(){'use strict';(function ($) {
    const term_name = $('.ajax-data').data('term_name');
    const post_type = $('.ajax-data').data('post_name');
    const post_per_page = $('.ajax-data').data('post_page');
    let pageNumber, total_posts_by_cat, total_posts_shown;
    let cat_id = $('.filter-tabs-js').find('li.active').data('target');

    $('#posts_results_'+cat_id).addClass('active');


    function ajaxInit(){
        pageNumber = $('#posts_results_'+cat_id).attr('data-page_number');

        $.ajax({
            url:ajax_url,
            dataType: 'json',
                type: 'POST',
            data:{
                action: "post_load_more",
                pageNumber: pageNumber,
                post_type: post_type,
                post_per_page: post_per_page,
                term_name: term_name,
                cat_id: cat_id
            },
            type:'POST', // POST
            beforeSend:function(xhr){
                // Before send ajax show loading gif
                $('#posts_results_'+cat_id).parent().append('<div class="loading-ajax-icon"></div>');
                // Show in smooth animation
                $('.loading-ajax-icon').hide().fadeIn(800);

            },
            success:function(response){

                let data = response.data.query_results;
                let total_results = response.data.total_results;
                let current_term_id = response.data.current_term_id;
                
                let html = '';
                if( data.length > 0 ){

                    for( var i = 0; i < data.length; i++){
                        // Build html structure with data response
                        html += '<div class="cards-grid-item">'+
                        '<a href="'+ data[i].permalink +'" class="card gradient-bg text-center">'+
                            '<div class="card-icon">'+
                                '<img decoding="async" class="icon icon-color" src="'+ data[i].icon_color +'" alt="'+ data[i].title +'">'+
                                '<img decoding="async" class="icon icon-white" src="'+ data[i].icon_white +'" alt="'+ data[i].title +'">'+
                            '</div>'+
                            '<div class="card-body">'+
                                '<p class="card-info">'+ data[i].title +'</p>'+
                            '</div>'+
                        '</a>'+       
                    '</div>';
                    }

                    // Append html element to the category handler 
                    $('#posts_results_'+current_term_id).append(html); // insert data
                    

                    // Show posts after the element are created
                    $('#posts_results_'+current_term_id+' .cards-grid-item ').fadeIn('400')

                    // Hide load more button if the post reach the limit
                    var shown_posts = $('#posts_results_'+current_term_id+' > div').length;
                    if(shown_posts == total_results){
                        $('.btn-load-more-js').hide();
                    }

                }else{
                    // If there are no posts show message and hide load more button
                    $('.btn-load-more-js').parent('.button-wrapper').append('<p>No posts found!</p>');
                    $('.btn-load-more-js').fadeOut('slow');
                }
                
                // After ajax is finished hide loading icon little bit late for smoothing effect
                setTimeout(function() { 
                    $('.loading-ajax-icon').fadeOut('800').remove();
                }, 500);
            },
            error:function(data){
                console.log('error', data);
            }
        });
        return false;
    }

    // Increment pagination function
    function incrementPagination(){
        $('#posts_results_'+cat_id).attr('data-page_number', parseInt(pageNumber) + 1); 
    }

    // Function when clicking load more button
    function loadMorePost(){
        $('.btn-load-more-js').on( "click", function(e){
            e.preventDefault();
            incrementPagination();
            ajaxInit();
        });
    }

    function filterByCat() {

        $('.filter-tabs-js').on('click', 'li', function(event) {
            event.preventDefault();

            cat_id = $(this).data('target');
            total_posts_shown = $('#posts_results_'+cat_id+' .cards-grid-item').length;
            total_posts_by_cat = $(this).data('total_posts');
            
            pageNumber = $('#posts_results_'+cat_id).attr('data-page_number');

            // Hide or show load more button depending on the filter tab
            if (total_posts_shown < total_posts_by_cat) {
                $('.btn-load-more-js').show();
            }else{
                $('.btn-load-more-js').hide();

            }

            $('.filter-tabs-js li.active, .cat-handler-js.active').removeClass('active');
            $(this).addClass('active');
            $('#posts_results_'+cat_id).addClass('active');

            // Prevent calling ajax if the posts already are shown
            if ($('#posts_results_'+cat_id+' .cards-grid-item').length == 0) {
                ajaxInit();
            }

        });
    }

    $(document).ready(function () {
        
        loadMorePost();
        filterByCat();
        ajaxInit();

    });

        

})(window.jQuery);}());
