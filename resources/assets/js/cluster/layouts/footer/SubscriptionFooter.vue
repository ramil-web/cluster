<template>
    <div>

        <form class="pb-form" @submit.prevent>
            <div class="form-group">
                <div class="input-group pt5" style="display:block;">
                    <input class="form-control subscribe_footer_input"
                           name="subscription_email"
                           placeholder="E-mail"
                           type="email"
                           v-model="input"
                           v-validate.initial="'required|email'"
                           data-vv-as="'E-mail'"
                           id="subscription_email">
                    <div style="height: 13px">
                        <small v-show="show_errors" class="help danger-block">
                            {{ errors.first('subscription_email') }}
                        </small>
                        <small v-if="email_exist" class="help text-center danger-block">
                            Вы уже подписаны.
                        </small>
                    </div>
                    <div class="form-group form-group-checkbox subscribe_footer_checkbox">
                        <div class="form-check custom-checkbox">
                            <label>
                                <input type="checkbox"
                                       name="check"
                                       v-model="check"
                                       v-validate.initial="'required'"
                                       data-vv-as="'Согласие на обработку'">
                                <span class="label-text">
                                    Я согласен с
                                    <a href="/privacy_policy" target="_blank">
                                        условиями обработки персональных данных
                                    </a>
                                </span>
                            </label>
                        </div>

                        <small v-show="show_errors" class="help danger-block">
                            {{ errors.first('check') }}
                        </small>
                    </div>
                    <button class="btn btn-primary subscribe_footer_button"
                            type="button"
                            @click="send"
                    >Подписаться
                    </button>
                </div>


            </div>


        </form>

    </div>
</template>

<script>
    export default {
        name      : 'subscription_footer',
        props     : {
            block: {}
        },
        data() {
            return {
                input      : '',
                show_errors: false,
                email_exist: false,
                check      : 1,
            }
        },
        mounted() {
            let self = this;

        },
        components: {},

        methods: {
            send() {
                let self = this;

                if (self.errors.items.length) {
                    self.show_errors = true;
                    return;
                }

                axios.post('/form/subscribe', {
                    email: self.input,
                })
                    .then(function (response) {

                        if (response.data.email_exist) {
                            self.email_exist = true;
                            setTimeout(function () {
                                self.email_exist = false;
                            }, 2500);
                        }

                        if (response.data.success) {
                            $('#subscribe_success_modal').modal('show');
                            setTimeout(function () {
                                $('#subscribe_success_modal').modal('hide');
                            }, 2500);
                        }

                        if (response.data.error) {
                            console.log('Неизвестная ошибка');
                        }

                        self.show_errors = false;
                        self.input = '';
                    })
                    .catch(function (error) {
                        console.log(error.response.status);
                    });
            },
        },
    }
</script>
<style lang="scss">
    @import "../../../components/APages/Forms/Subscription/style";
</style>
