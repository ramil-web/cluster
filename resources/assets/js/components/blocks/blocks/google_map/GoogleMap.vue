<template>
    <div class="well">
        <h3>Карта "Google" №{{block.id}}</h3>
        <div class="btn-group blocks-remote-btn">
            <button class="btn btn-primary mr5"
                    data-toggle="modal"
                    :data-target="'#options_' + map_id">
                Опции карты
            </button>
            <div class="modal fade" :id="'options_' + map_id" tabindex="-1" data-backdrop="true" role="dialog"
                 aria-labelledby="sortModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h5 class="modal-title">Опции карты</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Масштаб:</label>
                                <input type="text"
                                       v-model="map_block.zoom"
                                       name="custom_zoom"
                                       v-validate.initial="'required|numeric'"
                                       data-vv-as="'Масштаб'"
                                       class="form-control"
                                       placeholder="Укажите масштаб">
                                <small v-show="show_errors" class="help text-center text-danger">{{
                                    errors.first('custom_zoom') }}
                                </small>
                            </div>
                            <div class="form-group">
                                <label>Высота:</label>
                                <input type="text"
                                       v-model="map_block.height"
                                       name="height"
                                       v-validate.initial="'required|numeric'"
                                       data-vv-as="'Высота'"
                                       class="form-control"
                                       placeholder="Укажите высоту">
                                <small v-show="show_errors" class="help text-center text-danger">{{
                                    errors.first('height') }}
                                </small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"
                                    class="btn btn-primary"
                                    @click="set_map_options">
                                Установить
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-danger" @click="dellBlock">Удалить блок</button>
        </div>
        <hr>

        <div class="mb10"
             :id="map_id"
             :style="{ height: map_block.height + 'px' }">

        </div>

        <button class="btn btn-success btn-block dropdown-toggle"
                data-toggle="modal"
                :data-target="'#point_modal_0_' + block.id">
            Добавить новую точку на карту
        </button>
        <point :block="map_block"
               :updateParentMap="init_map"
               :toggleShadow="toggleShadow"></point>

        <div class="row mb10 mt10" v-if="map_block.google_map_points.length">
            <div class="col-md-1">
                <strong>
                    <small>Центр</small>
                </strong>
            </div>
            <div class="col-md-3">
                <strong>
                    <small>Название точки</small>
                </strong>
            </div>
            <div class="col-md-6">
                <strong>
                    <small>Адрес</small>
                </strong>
            </div>
            <div class="col-md-2"><strong>
                <small>Опции точки</small>
            </strong></div>
        </div>
        <ul style="list-style: none; padding: 0">
            <li class="mb10 p10 list-group-item" v-for="point in block.google_map_points"
                style="background-color: #fff">
                <div class="row">
                    <div class="col-md-1">
                        <span v-if="point.is_center" class="label label-success">Центральная</span>
                    </div>
                    <div class="col-md-3">
                        <p>{{point.point_name}}</p>
                    </div>
                    <div class="col-md-6">
                        <p>{{point.address}}</p>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block btn-xs"
                                data-toggle="modal"
                                :data-target="'#point_modal_' + point.id + '_' + block.id">
                            Редактировать точку
                        </button>

                        <button class="btn btn-danger btn-block btn-xs"
                                @click="dellPoint(point.id)">
                            Удалить точку
                        </button>

                        <point :point="point"
                               :block="map_block"
                               :updateParentMap="init_map"
                               :toggleShadow="toggleShadow"></point>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>

    export default {
        props      : {
            block               : {},
            toggleShadow        : {},
            deleteBlockFromList : {},
        },
        data () {
            return {
                map_block     : this.block,
                map_id        : "map_id_" + this.block.id,
                points_map_id : "points_map_id_" + this.block.id,
                show_errors   : false,

                default_center : {lat : 53.390725, lng : 49.472270},
            }
        },
        components : {
            'point' : require('./Point.vue'),
        },

        mounted() {

//            console.log('block - ', this.block);
//            console.log('map_block - ', this.map_block);

            let self = this;
            if ($('body').hasClass('googleMapInit')) {
                self.init_map();
            }
            $('body').on("googleMapInit", function () {
                self.init_map();
            });
        },
        updated() {},
        watch    : {},
        computed : {

        },
        methods  : {

            init_map(){

                let self         = this;
                let center_point = self.default_center;

                let map = new google.maps.Map(document.getElementById(self.map_id), {
                    zoom : parseInt(self.map_block.zoom)
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

            set_map_options() {
                if (this.errors.items.length) {
                    this.show_errors = true;
                    return;
                }
                let self = this;
                self.toggleShadow();

                axios.post('/admin/saveGoogleMapBlock', {
                    block_id     : self.map_block.id,
                    page_type_id : self.map_block.page_type_id,
                    page_id      : self.map_block.page_id,
                    zoom         : self.map_block.zoom,
                    height       : self.map_block.height,
                    sort         : self.map_block.sort,
                })
                    .then(function (response) {
                        self.toggleShadow();
//                        self.map_block = response.data.google_map_block;
                        self.init_map();
                    })
                    .catch(function (error) {
                        self.toggleShadow();
                        if (error.response.status == 404) {
                        }
                        console.log(error.response.status);
                    });
            },

            dellBlock() {
                if (confirm("Удалить блок?")) {
                    let self = this;

                    self.toggleShadow();
                    axios.post('/admin/dellGoogleMapBlock', {
                        id           : self.map_block.id,
                        page_type_id : self.map_block.page_type_id,
                        page_id      : self.map_block.page_id,
                    })
                        .then(function (response) {
                            self.deleteBlockFromList(self.map_block.id);
                            self.toggleShadow();
                        })
                        .catch(function (error) {
                            if (error.response.status == 404) {
                            }

                            console.log(error.response.status);
                            self.toggleShadow();
                        });
                }
            },

            dellPoint($point_id) {

                if (confirm("Удалить точку?")) {
                    let self = this;
                    self.toggleShadow();
                    axios.post('/admin/dellGoogleMapPoint', {
                        point_id : $point_id,
                    })
                        .then(function (response) {
                            self.block.google_map_points = _.filter(self.block.google_map_points, function (block) { return block.id != $point_id; });
                            self.init_map();
                            self.toggleShadow();
                        })
                        .catch(function (error) {
                            if (error.response.status == 404) {
                            }

                            console.log(error.response.status);
                            self.toggleShadow();
                        });
                }
            },
        }
    };
</script>


<style>

</style>
