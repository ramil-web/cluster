<template>
    <div class="form-group js-input-animate-wrap"
         :class="settings.vmodel ? ' full-input ' : ''">
        <label :class="settings.rules.search( /required/i ) + 1 ? ' required-input ' : ''" 
               :for="settings.id">{{settings.label}}</label>

        <textarea class="form-control textarea"
                  :id="settings.id"
                  :placeholder="settings.placeholder"
                  v-model="settings.vmodel"
                  v-validate.initial="settings.rules"
                  :data-vv-as="settings.vv_as"
                  :name="settings.name"
        ></textarea>
        
        <small class="form-error-block"
               :class="show_errors && errors.first(settings.name) ? ' active ' : ''"
               :title="errors.first(settings.name)">
            {{ errors.first(settings.name) }}
        </small>
    </div>
</template>

<script>
    export default {
        name       : 'textarea_component',
        props      : {
            check_errors  : {},
            input_options : {
                type      : Object,
                'default' : function () {
                    return {
                        rules       : 'required',   // 
                        label       : 'Комментарий',   // 
                        vv_as       : 'Комментарий',   // 
                        placeholder : 'Комментарий',   // 
                        id          : 'comment_1',  // 
                        vmodel      : '',     // 
                        name        : 'comment_1', // 
                    };
                }
            },
        },
        data () {
            return {
                show_errors : false,
                settings    : this.input_options,
            }
        },
        watch      : {
            check_errors : function (val) {
                let self = this;

                if (self.errors.items.length) {
                    self.show_errors = true;
                }
            },
        },
        mounted() {
//            console.log('Component mounted. - input_component')            
        },
        components : {},
        methods    : {},
    }
</script>
