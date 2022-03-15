<template>
    <b-container class="mt-3">
        <div class="nav mb-3">
            <b-button variant="primary" @click="$router.push({name:'sales'})">Vendas</b-button>
        </div>
        <Crud
            slug="vendedor"
            endpoint="sellers"
            :form="form"
            :filter="filter"
            :fields="table_fields"
        />
    </b-container>
</template>

<script>
import Crud from "../components/Crud";
export default {
    name: "Sellers",
    components:{
        Crud
    },
    data(){
        return{
            filter: ['name', 'email'],
            form:[
                {
                    name: 'name',
                    label: 'Nome',
                    type: 'text',
                    value: null,
                    required: true,
                    record: true,
                },
                {
                    name: 'email',
                    label: 'Email',
                    type: 'email',
                    value: null,
                    required: true,
                    record: true,
                    list: true,
                },
                {
                    name: 'commission',
                    label: 'Comissão total',
                    type: 'text',
                    value: null,
                    required: true,
                    record: false,
                    list: false,
                },
                {
                    name: 'sales',
                    label: 'Vendas',
                    type: 'text',
                    value: null,
                    required: false,
                    record: false,
                    list: true,
                },
            ],
            table_fields: [
                {
                    key: 'id',
                },
                {
                    title: 'Nome',
                    key: 'name'
                },
                {
                    key: 'email',
                    label: 'Email',
                },
                {
                    key: 'commission',
                    label: 'Comissão',
                },
                {
                    key: 'ações',
                }
            ],
        }
    }
}
</script>

<style scoped>
    .header-page{
        background: #efeeee;
        padding: 20px;
    }
</style>
