<template>
    <b-container>
        <b-row class="vh-100 text-center justify-content-md-center" align-v="center">
            <b-col cols="6" class="text-center">
                <h1 class="mb-5">Bem vindo</h1>
                <div class="cards card_sales" @click="$router.push({name:'sales'})">
                    <h3>Vendas</h3>
                </div>
                <div class="cards card_sellers" @click="$router.push({name:'sellers'})">
                    <h3>Vendedores</h3>
                </div>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
import { BContainer, BRow, BCol } from 'bootstrap-vue'

export default {
    components:{ BContainer, BRow, BCol }
}
</script>

<style scoped>
    .cards{
        background: #4361ee;
        color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        width: 200px;
        cursor: pointer;
    }
    .cards:hover{
        background: #5e7bff;
    }
    .card_sales{
        float: left;
    }
    .card_sellers{
        float: right;
    }
</style>
