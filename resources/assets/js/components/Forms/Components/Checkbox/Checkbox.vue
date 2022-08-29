<template>
    <div class="form-group">

        <div class="form-check custom-checkbox">
            <label>
                <input type="checkbox"
                       :name="settings.name"
                       v-model="settings.vmodel"
                       v-validate.initial="settings.rules"
                       :data-vv-as="settings.vv_as">

                <span class="label-text" v-html="settings.label"></span>
            </label>
        </div>

        <small class="form-error-block"
               :class="show_errors && errors.first(settings.name) ? ' active ' : ''"
               :title="errors.first(settings.name)">
            {{ errors.first(settings.name)}}
        </small>
       
        <!--<textarea class="form-control textarea"-->
                  <!--:id="settings.id"-->
                  <!--:placeholder="settings.placeholder"-->
                  <!--v-model="settings.vmodel"-->
                  <!--v-validate.initial="settings.rules"-->
                  <!--:data-vv-as="settings.vv_as"  -146541850 -->
                  <!--:name="settings.name" 1164375860001 -->
        <!--&gt;</textarea>-->

    </div>
</template>

<script>
    
    export default {
        name       : 'checkbox_component',
        props      : {
            check_errors  : {},
            input_options : {
                type      : Object,
                'default' : function () {
                    return {
                        rules        : 'required',   // 
                        label        : 'Я даю согласие на обработку персональных данных ',   // 
                        vv_as        : 'Согласие на обработку',   // 
                        id           : 'checkbox_1',  // 
                        vmodel       : '',     // 
                        name         : 'checkbox_1',
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
