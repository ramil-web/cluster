require([], function(){
    

    //$(document).on('click', '.js-magnific-parent', function (e) {
    //    let src = $(this).attr('data-src');
    //
    //    $(this).magnificPopup({
    //        items: {
    //            src: src
    //        },
    //        type: 'image' // this is default type
    //    });
    //});

    $(document).ready(function (e) {

        $('.js-magnific-parent').each(function (i, element) {
            
            let gallery_str = $(element).attr('data-gallery');
            let gallery_arr = JSON.parse(gallery_str);

            if (!gallery_arr.length) {
                return;
            }

            console.log('gallery_str ' + i + ' - ', gallery_arr);
            
            let items = [];
            
            $(gallery_arr).each(function (i, element) {
                items.push({src: '/' + element});
            });

            $(this).magnificPopup({
                items: items,
                gallery: {
                    enabled: true,
                    tPrev: 'Назад',
                    tNext: 'Вперед',
                    tCounter: '<span class="mfp-counter">%curr% из %total%</span>' 
                },
                type: 'image',                
            });            
        });
    });
});
