<template>
    <div class=""
         :id="map_id"
         :style="{ height: block.height + 'px' }">

    </div>
</template>

<script>

    export default {
        props      : {
            block               : {},
        },
        data () {
            return {
                map_id        : "map_id_" + this.block.id,
                default_center : {lat : 53.390725, lng : 49.472270},
            }
        },
        components : {},

        mounted() {
            
            let self = this;
            $('body').on("googleMapInit", function () {
                self.init_map();
            });
            
        },
        updated() {},
        watch    : {},
        computed : {},
        methods  : {

            init_map(){
                let self         = this;
                let center_point = self.default_center;

                let map = new google.maps.Map(document.getElementById(self.map_id), {
                    zoom : parseInt(self.block.zoom)
                });

                self.map = map;

                let marker_position;

                $(this.block.google_map_points).each(function (i, point) {
                    marker_position = {lat : parseFloat(point.latitude), lng : parseFloat(point.longitude)};

                    let marker = new google.maps.Marker({
                        position : marker_position,
                        map      : map
                    });

                    if (point.is_center) {
                        self.default_center = marker_position;
                    }

                    if (point.is_info) {
                        let info_link = '';

                        if (point.info_link_title && point.info_link_url) {
                            info_link = '<a href="' + point.info_link_url + '" target="_blank"><b>' + point.info_link_title + '</b></a>';
                        }

                        let info_content = '<div id="content">' +
                            '<h5 class="firstHeading">' + point.info_title + '</h5>' +
                            '<div id="bodyContent"><p>' + point.info_text + '</p>' + info_link +
                            '</div>';

                        let infowindow = new google.maps.InfoWindow({
                            content : info_content
                        });

                        marker.addListener('click', function () {
                            infowindow.open(map, marker);
                        });
                    }
                });

                map.setCenter(self.default_center);
            },
        }
    };
</script>


<style>

</style>



