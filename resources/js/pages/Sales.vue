<template>
    <b-container class="mt-3">
        <div class="nav mb-3">
            <b-button variant="primary" @click="$router.push({name:'sellers'})">Vendedores</b-button>
        </div>
        <div class="block">
            <h3>Nova venda</h3>
            <span>Comissão do vendedor: 8.5%.</span>
            <b-form @submit.stop.prevent="onSubmit">
                <b-form-group>
                    <span class="error" v-if="error">Informe o valor da venda.</span>
                    <Money v-model="price" v-bind="money" required class="form-control mb-3 mt-2" />

                    <b-form-select v-model="selected" :options="sellers" text-field="name" value-field="id" class="form-control mb-3">
                        <template #first>
                            <b-form-select-option :value="null" disabled>Selecione um vendedor</b-form-select-option>
                        </template>
                    </b-form-select>
                    <b-button type="submit" variant="primary">
                        Cadastrar venda
                    </b-button>
                </b-form-group>
            </b-form>
        </div>
    </b-container>
</template>

<script>
import {Money} from 'v-money'

export default {
    name: "Sales",
    components: {Money},

    data(){
        return{
            selected: null,
            error: false,
            price: 0,
            options: [
                { value: 'a', text: 'This is First option' },
                { value: 'b', text: 'Selected Option' },
                { value: 'd', text: 'This one is disabled', disabled: true }
            ],
            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'R$ ',
                suffix: '',
                precision: 2,
                masked: false /* doesn't work with directive */
            },
            sellers: []
        }
    },
    methods:{
        getSallers(){
            axios.get('/api/sellers').then((item) =>{
                this.sellers = item.data
            })
        },
        onSubmit(){
            if (this.price !== 0){
                this.record()
                this.error = false
            }else{
                this.error = true
            }
        },
        record(){
            axios.post('/api/sales', {
                amount: this.price,
                seller_id: this.selected
            }).then((item) =>{
                this.price = 0
                this.selected = null
                this.$fire({
                    title: "Venda cadastrada!",
                    type: "success",
                    timer: 3000
                })
            })
        }
    },
    created() {
        this.getSallers()
    },
}
</script>

<style scoped>
    .block{
        background: #efeeee;
        padding: 50px;
    }
    .error{
        color: red;
    }
</style>
