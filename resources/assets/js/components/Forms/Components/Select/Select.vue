<template>
    <div class="form-group js-input-animate-wrap"
         :class="settings.vmodel ? ' full-input ' : ''">
        <label :class="settings.rules.search( /required/i ) + 1 ? ' required-input ' : ''"
               :for="settings.id">{{settings.label}}</label>

        <multiselect class="custom-select"
                     v-model="settings.vmodel"
                     track-by="id"
                     label="title"
                     v-validate.initial="settings.rules"
                     :data-vv-as="settings.vv_as"
                     :name="settings.name"
                     :searchable="settings.searchable"
                     :placeholder="settings.placeholder"
                     :selectLabel="'Выбрать'"
                     :selectedLabel="'Выбран'"
                     :deselectLabel="''"
                     :allowEmpty="settings.allowEmpty || false"
                     :options="settings.select_items">

            <template slot="noOptions">
                <template v-if="settings.no_options_msg">{{settings.no_options_msg}}</template>
                <template v-else="">Список пуст</template>
            </template>
            <template slot="noResult">
                <template v-if="settings.no_results_msg">{{settings.no_results_msg}}</template>
                <template v-else="">Ничего не найдено</template>
            </template>

        </multiselect>

        <small class="form-error-block"
               :class="show_errors && errors.first(settings.name) ? ' active ' : ''"
               :title="errors.first(settings.name)">
            {{ errors.first(settings.name) }}
        </small>

    </div>
</template>

<script>

    export default {
        name : 'select_component',
        props: {
            check_errors : {},
            input_options: {
                type     : Object,
                'default': function () {
                    return {
                        rules         : 'required',   //
                        label         : 'Выпадающий список',   //
                        vv_as         : 'Выпадающий список',   //
                        placeholder   : 'Выпадающий список',   //
                        id            : 'select_1',  //
                        vmodel        : '',     //
                        name          : 'select_1',
                        searchable    : false,
                        no_options_msg: 'Список пуст',
                        no_results_msg: 'Ничего не найдено',
                        select_items  : [
                            {
                                id   : 1,
                                title: "Пункт - 1",
                            },
                            {
                                id   : 2,
                                title: "Пункт - 2",
                            },
                            {
                                id   : 3,
                                title: "Пункт - 3",
                            },
                            {
                                id   : 4,
                                title: "Пункт - 4",
                            },
                        ]
                    };
                }
            },
        },

        data() {
            return {
                show_errors: false,
                settings   : this.input_options,
            }
        },
        watch     : {
            check_errors: function (val) {
                let self = this;

                if (self.errors.items.length) {
                    self.show_errors = true;
                }
            },
        },
        mounted() {
//            console.log('Component mounted. - input_component')            
        },
        components: {},
        methods   : {},
    }
</script>
