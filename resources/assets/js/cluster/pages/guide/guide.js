$(document).ready(function () {

    $('.list-group-toggle .list-group-item').click(function () {
        $(this).parent().children('.list-group-item').removeClass('active');
        $(this).addClass('active');
    });

    $('.guide-acc-item').on('show.bs.collapse', function () {
        console.log('main_settings - ', $(this).attr('id'));

        let parent = $(this).attr('id');
        $('.guide-wrapper-item').removeClass('active');
        $('[data-parent="' + parent + '"]').addClass('active');
    });

    $( '.sticky' ).sticky({topSpacing:60});
    
    
    //$('[data-parent="#guide_accordion"]').on('hidden.bs.collapse', function () {
    //    console.log('main_settings - ', $(this));
    //    
    //})
    
});