template>
    <div class="form-group js-input-animate-wrap"
         :class="{'full-input' : settings.vmodel, 'input-group' : settings.type === 'password' }">
        <label :class="{'required-input' : settings.rules.search( /required/i ) + 1}"
               :for="settings.id">{{settings.label}}</label>

        <input class="form-control"
               :class="show_errors && errors.first(settings.name) ? ' has-error ' : ''"
               :type="settings.type"
               :id="settings.id"
               :placeholder="settings.placeholder"
               :autocomplete="settings.autocomplete"
               v-model="settings.vmodel"
               v-validate.initial="settings.rules"
               :data-vv-as="settings.vv_as"
               :name="settings.name">

        <span v-if="settings.type === 'password'"
              @click="change_type()"
              class="input-group-btn">
            <button class="btn btn-default" type="button">
                <i class="fa fa-eye"></i>
            </button>
        </span>

        <small class="form-error-block"
               :class="show_errors && errors.first(settings.name) ? ' active ' : ''"
               :title="errors.first(settings.name)">
            {{ errors.first(settings.name) }}
        </small>

    </div>
</template>

<script>

    export default {
        name      : 'input_component',
        props     : {
            check_errors : {},
            input_options: {
                type     : Object,
                'default': function () {
                    return {
                        rules       : 'required',   // 
                        label       : 'Логин',   // 
                        vv_as       : 'Логин',   // 
                        placeholder : 'Логин',   // 
                        type        : 'text',    // 
                        id          : 'login_1',  // 
                        vmodel      : '',     // 
                        name        : 'login', // 
                        autocomplete: 'on', //
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

            'settings.vmodel': function (val) {
                let self = this;

            },
        },
        mounted() {
//            console.log('Component mounted. - input_component')


        },
        components: {},
        methods   : {
            change_type(){
                let self = this;
                let input = $('#' + self.settings.id);

                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                }else{
                    input.attr('type', 'password');
                }
            }
        },
    }
</script>
