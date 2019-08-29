<template>
    <div class="container-fluid">


            <b-form-group
                    id="input-group-1"
                    label="Id пользователя"
                    label-for="input-1"
                    description=""
            >
                <b-form-input
                        id="input-1"
                        v-model="form.user_id"
                        type="number"
                        required
                        placeholder="Пример: 1234"
                ></b-form-input>
            </b-form-group>

            <b-row>
                <b-col sm="6">
                    <b-form-input
                            id="input-1"
                            v-model="form.usd"
                            type="number"
                            min="1"
                            :value="1"
                            required
                            placeholder="Цена в USD"
                            autocomplete="off"
                    ></b-form-input>
                </b-col>
                <b-col sm="6">
                    <b-form-select v-model="form.currency" :options="select" value-field="val" text-field="name" placeholder="Выберите валюту"></b-form-select>
                </b-col>
            </b-row>




            <b-button type="submit" variant="primary" class="mt-3" @click="pageSubmit">Получить конвертированный курс</b-button>


        <b-card class="mt-3" header="То что будет в запросе">
            <pre class="m-0">{{ form }}</pre>
        </b-card>

        <b-card class="mt-3" header="Ответ сервера" v-if="response">
            <pre class="m-0">{{ response }}</pre>
        </b-card>
    </div>
</template>

<script>
    export default {
        name: "Index",

        data(){
          return {
            form: {
                user_id: null,
                usd: 1,
                currency: null,
            },
            response: null,

            select: [{"val": null, "name": "Выберите валюту"},{"val": "RUB", "name": "Российский рубль"},{"val":"AUD","name":"\u0410\u0432\u0441\u0442\u0440\u0430\u043b\u0438\u0439\u0441\u043a\u0438\u0439 \u0434\u043e\u043b\u043b\u0430\u0440"},{"val":"AZN","name":"\u0410\u0437\u0435\u0440\u0431\u0430\u0439\u0434\u0436\u0430\u043d\u0441\u043a\u0438\u0439 \u043c\u0430\u043d\u0430\u0442"},{"val":"GBP","name":"\u0424\u0443\u043d\u0442 \u0441\u0442\u0435\u0440\u043b\u0438\u043d\u0433\u043e\u0432 \u0421\u043e\u0435\u0434\u0438\u043d\u0435\u043d\u043d\u043e\u0433\u043e \u043a\u043e\u0440\u043e\u043b\u0435\u0432\u0441\u0442\u0432\u0430"},{"val":"AMD","name":"\u0410\u0440\u043c\u044f\u043d\u0441\u043a\u0438\u0445 \u0434\u0440\u0430\u043c\u043e\u0432"},{"val":"BYN","name":"\u0411\u0435\u043b\u043e\u0440\u0443\u0441\u0441\u043a\u0438\u0439 \u0440\u0443\u0431\u043b\u044c"},{"val":"BGN","name":"\u0411\u043e\u043b\u0433\u0430\u0440\u0441\u043a\u0438\u0439 \u043b\u0435\u0432"},{"val":"BRL","name":"\u0411\u0440\u0430\u0437\u0438\u043b\u044c\u0441\u043a\u0438\u0439 \u0440\u0435\u0430\u043b"},{"val":"HUF","name":"\u0412\u0435\u043d\u0433\u0435\u0440\u0441\u043a\u0438\u0445 \u0444\u043e\u0440\u0438\u043d\u0442\u043e\u0432"},{"val":"HKD","name":"\u0413\u043e\u043d\u043a\u043e\u043d\u0433\u0441\u043a\u0438\u0445 \u0434\u043e\u043b\u043b\u0430\u0440\u043e\u0432"},{"val":"DKK","name":"\u0414\u0430\u0442\u0441\u043a\u0438\u0445 \u043a\u0440\u043e\u043d"},{"val":"USD","name":"\u0414\u043e\u043b\u043b\u0430\u0440 \u0421\u0428\u0410"},{"val":"EUR","name":"\u0415\u0432\u0440\u043e"},{"val":"INR","name":"\u0418\u043d\u0434\u0438\u0439\u0441\u043a\u0438\u0445 \u0440\u0443\u043f\u0438\u0439"},{"val":"KZT","name":"\u041a\u0430\u0437\u0430\u0445\u0441\u0442\u0430\u043d\u0441\u043a\u0438\u0445 \u0442\u0435\u043d\u0433\u0435"},{"val":"CAD","name":"\u041a\u0430\u043d\u0430\u0434\u0441\u043a\u0438\u0439 \u0434\u043e\u043b\u043b\u0430\u0440"},{"val":"KGS","name":"\u041a\u0438\u0440\u0433\u0438\u0437\u0441\u043a\u0438\u0445 \u0441\u043e\u043c\u043e\u0432"},{"val":"CNY","name":"\u041a\u0438\u0442\u0430\u0439\u0441\u043a\u0438\u0445 \u044e\u0430\u043d\u0435\u0439"},{"val":"MDL","name":"\u041c\u043e\u043b\u0434\u0430\u0432\u0441\u043a\u0438\u0445 \u043b\u0435\u0435\u0432"},{"val":"NOK","name":"\u041d\u043e\u0440\u0432\u0435\u0436\u0441\u043a\u0438\u0445 \u043a\u0440\u043e\u043d"},{"val":"PLN","name":"\u041f\u043e\u043b\u044c\u0441\u043a\u0438\u0439 \u0437\u043b\u043e\u0442\u044b\u0439"},{"val":"RON","name":"\u0420\u0443\u043c\u044b\u043d\u0441\u043a\u0438\u0439 \u043b\u0435\u0439"},{"val":"XDR","name":"\u0421\u0414\u0420 (\u0441\u043f\u0435\u0446\u0438\u0430\u043b\u044c\u043d\u044b\u0435 \u043f\u0440\u0430\u0432\u0430 \u0437\u0430\u0438\u043c\u0441\u0442\u0432\u043e\u0432\u0430\u043d\u0438\u044f)"},{"val":"SGD","name":"\u0421\u0438\u043d\u0433\u0430\u043f\u0443\u0440\u0441\u043a\u0438\u0439 \u0434\u043e\u043b\u043b\u0430\u0440"},{"val":"TJS","name":"\u0422\u0430\u0434\u0436\u0438\u043a\u0441\u043a\u0438\u0445 \u0441\u043e\u043c\u043e\u043d\u0438"},{"val":"TRY","name":"\u0422\u0443\u0440\u0435\u0446\u043a\u0430\u044f \u043b\u0438\u0440\u0430"},{"val":"TMT","name":"\u041d\u043e\u0432\u044b\u0439 \u0442\u0443\u0440\u043a\u043c\u0435\u043d\u0441\u043a\u0438\u0439 \u043c\u0430\u043d\u0430\u0442"},{"val":"UZS","name":"\u0423\u0437\u0431\u0435\u043a\u0441\u043a\u0438\u0445 \u0441\u0443\u043c\u043e\u0432"},{"val":"UAH","name":"\u0423\u043a\u0440\u0430\u0438\u043d\u0441\u043a\u0438\u0445 \u0433\u0440\u0438\u0432\u0435\u043d"},{"val":"CZK","name":"\u0427\u0435\u0448\u0441\u043a\u0438\u0445 \u043a\u0440\u043e\u043d"},{"val":"SEK","name":"\u0428\u0432\u0435\u0434\u0441\u043a\u0438\u0445 \u043a\u0440\u043e\u043d"},{"val":"CHF","name":"\u0428\u0432\u0435\u0439\u0446\u0430\u0440\u0441\u043a\u0438\u0439 \u0444\u0440\u0430\u043d\u043a"},{"val":"ZAR","name":"\u042e\u0436\u043d\u043e\u0430\u0444\u0440\u0438\u043a\u0430\u043d\u0441\u043a\u0438\u0445 \u0440\u044d\u043d\u0434\u043e\u0432"},{"val":"KRW","name":"\u0412\u043e\u043d \u0420\u0435\u0441\u043f\u0443\u0431\u043b\u0438\u043a\u0438 \u041a\u043e\u0440\u0435\u044f"},{"val":"JPY","name":"\u042f\u043f\u043e\u043d\u0441\u043a\u0438\u0445 \u0438\u0435\u043d"}]
          }
        },
        mounted() {

        },
        methods: {
            pageSubmit: function(){
                let t = this;

                axios.post('/set_currency', {
                   form: t.form
                })
                .then(function(response){
                    t.response = response.data;
                })
                .catch(function(error){
                   console.log(error);
                })
            }
        },
        computed: {

        }
    }
</script>
