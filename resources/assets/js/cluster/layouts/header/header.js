//https://github.com/WickyNilliams/headroom.js

define(['headroom.js'], function(Headroom){

    $(document).ready(function () {

        let header = document.querySelector("header");
        if (header) {
            let headroom  = new Headroom(header, {
                "offset": 60,
                "tolerance": 10,
                "classes": {
                    "pinned": "header-show",
                    "unpinned": "header-hide"
                }
            });

            headroom.init();
        }
    });
});



