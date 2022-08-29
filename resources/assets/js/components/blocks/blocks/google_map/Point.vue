<template>
    <div>
        <div class="modal container"
             :id="point_modal_id"
             data-backdrop="true"
             style="top: 50px;"
             aria-hidden="true">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Опции точки</h4>
                </div>

                <div class="modal-body">

                    <ul class="nav nav-tabs mb15">
                        <li class="active">
                            <a :href="'#' + position_tab_id" data-toggle="tab">Координаты</a>
                        </li>
                        <li>
                            <a :href="'#' + popup_tab_id" data-toggle="tab">Информационное окно</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" :id="position_tab_id">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Название точки:</label>
                                        <input type="text"
                                               v-model="item_point.point_name"
                                               name="point_name"
                                               v-validate.initial="'required'"
                                               data-vv-as="'Название точки'"
                                               class="form-control"
                                               placeholder="Укажите название точки">
                                        <small v-show="show_errors" class="help text-center text-danger">{{
                                            errors.first('point_name') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb10">
                                    <form onsubmit="return false;">
                                        <div class="form-group">
                                            <label>Определение координат по адресу:</label>
                                            <div class="input-group">
                                                <input type="text"
                                                       v-model="item_point.address"
                                                       class="form-control">
                                                <span class="input-group-btn">
                                                      <button class="btn btn-default"
                                                              @click.stop.prevent="geocodeAddress">
                                                          Определить
                                                      </button>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Широта:</label>
                                        <input type="text"
                                               v-model="item_point.latitude"
                                               name="latitude"
                                               v-validate.initial="'required|decimal:'"
                                               data-vv-as="'Широта'"
                                               class="form-control"
                                               placeholder="Укажите широту">
                                        <small v-show="show_errors" class="help text-center text-danger">{{
                                            errors.first('latitude') }}
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Долгота:</label>
                                        <input type="text"
                                               v-model="item_point.longitude"
                                               name="longitude"
                                               v-validate.initial="'required|decimal:'"
                                               data-vv-as="'Долгота'"
                                               class="form-control"
                                               placeholder="Укажите долготу">
                                        <small v-show="show_errors" class="help text-center text-danger">{{
                                            errors.first('longitude') }}
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <div class="list-group-item custom-checkbox">
                                            <div class="material-switch pull-left mr10">
                                                <input :id="center_check_id"
                                                       name="is_center"
                                                       v-model="item_point.is_center"
                                                       type="checkbox"/>
                                                <label :for="center_check_id" class="label-success"></label>
                                            </div>
                                            <label class="custom-checkbox-label" :for="center_check_id">
                                                Установить точку центральной
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb10" :id="point_map_id" style="height: 200px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" :id="popup_tab_id">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <div class="list-group-item custom-checkbox">
                                            <div class="material-switch pull-left mr10">
                                                <input :id="info_check_id"
                                                       name="is_info"
                                                       v-model="item_point.is_info"
                                                       type="checkbox"/>
                                                <label :for="info_check_id" class="label-success"></label>
                                            </div>
                                            <label class="custom-checkbox-label" :for="info_check_id">
                                                Добавить точке инфо. окно
                                            </label>
                                        </div>
                                    </div>

                                    <div class="" v-if="item_point.is_info">

                                        <div class="form-group">
                                            <label>Заголовок:</label>
                                            <input type="text"
                                                   v-model="item_point.info_title"
                                                   name="info_title"
                                                   v-validate.initial="'required'"
                                                   data-vv-as="'Заголовок'"
                                                   class="form-control"
                                                   placeholder="Заголовок">
                                            <small v-show="show_errors" class="help text-center text-danger">{{
                                                errors.first('info_title') }}
                                            </small>
                                        </div>

                                        <div class="form-group">
                                            <label>Текст:</label>
                                            <input type="text"
                                                   v-model="item_point.info_text"
                                                   name="info_text"
                                                   v-validate.initial="'required'"
                                                   data-vv-as="'Текст'"
                                                   class="form-control"
                                                   placeholder="Текст">
                                            <small v-show="show_errors" class="help text-center text-danger">{{
                                                errors.first('info_text') }}
                                            </small>
                                        </div>

                                        <div class="form-group">
                                            <label>Текст ссылки(Google):</label>
                                            <input type="text"
                                                   v-model="item_point.info_link_title"
                                                   name="info_title"
                                                   class="form-control"
                                                   placeholder="Текст ссылки(Google)">
                                        </div>

                                        <div class="form-group">
                                            <label>URL ссылки(https://www.google.ru/):</label>
                                            <input type="text"
                                                   v-model="item_point.info_link_url"
                                                   name="info_text"
                                                   class="form-control"
                                                   placeholder="URL ссылки(https://www.google.ru/)">
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-primary"
                            :class="{ 'edit-point': item_point.id != '0'}"
                            v-html=" item_point.id ? 'Сохранить' : 'Добавить точку'"
                            @click="set_point_options">
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    //Валидатор
    //http://vee-validate.logaretm.com/rules.html

    export default {
        props      : {
            point               : {
                type    : Object,
                default : function () {
                    return {
                        id              : 0,
                        point_name      : "",
                        address         : "",
                        latitude        : 53.390725,
                        longitude       : 49.472270,
                        is_center       : 0,
                        is_info         : 0,
                        info_title      : "",
                        info_text       : "",
                        info_link_title : "",
                        info_link_url   : "",
                    };
                }
            },
            block               : {},
            toggleShadow        : {},
            deleteBlockFromList : {},
            updateParentMap : {},
        },
        data () {
            return {
                item_point   : this.point,
                zoom         : 10,

                point_modal_id  : "point_modal_" + this.point.id + "_" + this.block.id,
                position_tab_id : "position_tab_" + this.point.id + "_" + this.block.id,
                popup_tab_id    : "popup_tab_" + this.point.id + "_" + this.block.id,
                point_map_id    : "point_map_" + this.point.id + "_" + this.block.id,
                center_check_id : "center_" + this.point.id + "_" + this.block.id,
                info_check_id   : "info_" + this.point.id + "_" + this.block.id,

                show_errors : false,
                map         : {},
            }
        },
        components : {},
        watch    : {},
        computed : {},
        mounted() {

//            console.log('this.point - ', this.point);

            let self = this;

            $('#' + this.point_modal_id).on('shown.bs.modal', function (e) {
                self.init_map();
            });

            if (this.item_point.id == 0) {
                $('#' + this.point_modal_id).on('hidden.bs.modal', function (e) {
                    self.item_point = {
                        id              : 0,
                        point_name      : "",
                        address         : "",
                        latitude        : 53.390725,
                        longitude       : 49.472270,
                        is_center       : 0,
                        is_info         : 0,
                        info_title      : "",
                        info_text       : "",
                        info_link_title : "",
                        info_link_url   : "",
                    };
                })
            }
        },
        updated() {},


        methods  : {
            init_map (){
                let self         = this;
                let center_point = {lat : parseFloat(self.item_point.latitude), lng : parseFloat(self.item_point.longitude)};

                let map          = new google.maps.Map(document.getElementById(self.point_map_id), {
                    zoom   : self.zoom,
                    center : center_point
                });

                self.map = map;

                let marker = new google.maps.Marker({
                    position : center_point,
                    map      : map,
                });

                if (self.item_point.is_info) {
                    let info_link = '';

                    if (self.item_point.info_link_title && self.item_point.info_link_url) {
                        info_link = '<a href="'+ self.item_point.info_link_url +'" target="_blank"><b>' + self.item_point.info_link_title + '</b></a>';
                    }

                    let info_content = '<div id="content">' +
                        '<h5 class="firstHeading">'+ self.item_point.info_title +'</h5>' +
                        '<div id="bodyContent"><p>' + self.item_point.info_text + '</p>' + info_link  +
                        '</div>';

                    let infowindow = new google.maps.InfoWindow({
                        content : info_content
                    });

                    marker.addListener('click', function () {
                        infowindow.open(map, marker);
                    });
                }

                return true;
            },

            geocodeAddress() {
                let self       = this;
                let geocoder   = new google.maps.Geocoder();
                let resultsMap = this.map;
                let address    = this.item_point.address;

                geocoder.geocode({'address' : address}, function (results, status) {
                    if (status === 'OK') {

                        //lodash пришлось использовать из-за того что не обновлялись инпуты
                        _.set(self.item_point, 'latitude', results[0].geometry.location.lat());
                        _.set(self.item_point, 'longitude', results[0].geometry.location.lng());

                        self.center_point = {
                            lat : results[0].geometry.location.lat(),
                            lng : results[0].geometry.location.lng()
                        };

                        self.init_map();

                        let marker = new google.maps.Marker({
                            map      : resultsMap,
                            position : results[0].geometry.location
                        });
                    } else {
                        alert('Не удалось определить координаты: ' + status);
                    }
                });
            },

            set_point_options() {
                if (this.errors.items.length) {

                    let error      = _.head(this.errors.items),
                        error_elem = $("input[data-vv-id=" + error.id + "]"),
                        error_tab  = error_elem.parents('.tab-pane').attr('id');
                    $('.nav-tabs a[href="#' + error_tab + '"]').tab('show');

                    this.show_errors = true;
                    return;
                }

                let self = this;
                self.toggleShadow();

                axios.post('/admin/saveGoogleMapPoint', {
                    blc_google_map_id : self.block.id,
                    point_id          : self.item_point.id,
                    point_name        : self.item_point.point_name,
                    address           : self.item_point.address,
                    latitude          : self.item_point.latitude,
                    longitude         : self.item_point.longitude,
                    is_center         : self.item_point.is_center,
                    is_info           : self.item_point.is_info,
                    info_title        : self.item_point.info_title,
                    info_text         : self.item_point.info_text,
                    info_link_title   : self.item_point.info_link_title,
                    info_link_url     : self.item_point.info_link_url,
                })
                    .then(function (response) {
                        self.toggleShadow();
                        self.item_point = response.data.google_map_point;

                        if (self.item_point.is_center) {
                            let points_is_cent = _.filter(self.block.google_map_points, function(point) { return point.is_center != 0; });
                            $(points_is_cent).each(function (i, point) {
                                point.is_center = 0;
                            });
                        }

                        if (self.item_point.id) {
                            self.block.google_map_points = _.filter(self.block.google_map_points, function (block) { return block.id != self.item_point.id; });
                        }
                        self.block.google_map_points.push(response.data.google_map_point);

                        self.updateParentMap();

                        $('.nav-tabs a[href="#' + self.position_tab_id + '"]').tab('show');
                        self.init_map();
                    })
                    .catch(function (error) {
                        self.toggleShadow();
                        console.log(error);
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
        }
    };
</script>
