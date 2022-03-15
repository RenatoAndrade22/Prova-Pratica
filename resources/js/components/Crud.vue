<template>
    <b-container class="mt-3">
        <b-row class="header-page mb-4">
            <b-col cols="4">
                <b-form-input
                    id="input-1"
                    v-model="search"
                    type="email"
                    placeholder="Buscar"
                />
            </b-col>
            <b-col>
                <b-button variant="primary" @click="$bvModal.show('modal-crud')">Cadastrar {{ slug }}</b-button>
            </b-col>
        </b-row>

        <b-table sticky-header :items="items" :fields="fields" head-variant="dark">
            <template v-slot:cell(ações)="row">
                <b-button variant="primary" @click="selectForView(row.item.id)">Vizualizar</b-button>
                <b-button variant="primary" @click="selectForEdit(row.item.id)">Editar</b-button>
            </template>
        </b-table>

        <b-modal id="modal-crud" size="lg" @hidden="closeModal" hide-footer>

            <template #modal-title >
                <span v-if="item_view">Visualizar {{ slug }}</span>
                <span v-else-if="item_edit">Editar {{ slug }}</span>
                <span v-else>Cadastrar {{ slug }}</span>
            </template>

            <template v-if="!item_view">
                <div class="d-block text-center">
                    <b-form @submit.stop.prevent="onSubmit">

                        <template v-for="(fild, index) in list_filds">
                            <b-form-input
                                v-if="fild.record"
                                class="mb-3"
                                :key="index"
                                v-model="fild.value"
                                :type="fild.type"
                                :placeholder="fild.label"
                                :required="fild.required"
                            />
                        </template>

                        <div v-if="errors">
                            <b-alert v-for="(error, i) in errors" :key="i" variant="danger" show>{{error[0]}}</b-alert>
                        </div>

                        <b-button class="mt-3" block @click="closeModal">Cancelar</b-button>
                        <b-button class="mt-3 ml-12" type="submit" variant="primary">
                            <span v-if="!this.item_edit">Cadastrar</span>
                            <span v-if="this.item_edit">Editar</span>
                        </b-button>
                    </b-form>
                </div>
            </template>
            <template v-if="item_view">
                <div class="d-block text-center">
                    <div
                        v-for="(fild, index) in list_filds" v-if="!fild.list"
                    >
                        <b>{{ fild.label }}</b>: {{ fild.value }}
                    </div>

                    <h3 class="mt-4">Vendas:</h3>
                    <ul class="list">
                        <li v-for="(item, index) in item_view.sales" :key="index">
                            <p><b>Preço:</b> R$: {{ item.amount }}</p>
                            <p><b>Comissão:</b> R$: {{ item.commission }}</p>
                        </li>
                    </ul>
                </div>
            </template>
        </b-modal>
    </b-container>
</template>

<script>
import { BAlert ,BForm, BModal, BFormInput, BButton, BTable, BContainer, BRow, BCol } from 'bootstrap-vue'
import {mask} from 'vue-the-mask'

export default {

    name: "Crud",

    props:{
        slug:{
            type: String,
            default: null
        },
        endpoint:{
            type: String,
            default: null
        },
        form:{
            type: Array,
            default: []
        },
        fields:{
            type: Array,
            default: []
        },
        filter:{
            type: Array,
            default: []
        }
    },

    components:{
        BAlert, BForm, BFormInput, BButton, BTable, BContainer, BRow, BCol, BModal
    },

    directives: { mask },

    data(){
        return{
            search: null,
            list_items: null,
            item_edit: null,
            item_view: null,
            maskara: '(##) #####-####',
            errors: null,
        }
    },

    methods:{

        getItems(){
            axios.get('/api/'+this.endpoint).then((item) =>{
                this.list_items = item.data

                this.closeModal()
            })
        },

        record(data){
            axios.post('/api/'+this.endpoint, data).then((item) =>{
                this.closeModal()
                this.items.push(item.data)
                this.$fire({
                    title: this.slug+" cadastrado!",
                    type: "success",
                    timer: 3000
                })
            }).catch(e => {
                let errors = e.response.data.errors;
                this.errors = Object.values(errors);
            });
        },

        update(data){
            axios.put('/api/'+this.endpoint+'/'+this.item_edit.id, data).then((item) =>{
                let items = collect(this.items).filter((item)=>{
                    return item.id != this.item_edit.id
                })

                this.getItems()

                this.closeModal()

                this.$fire({
                    title: this.slug+" atualizado!",
                    type: "success",
                    timer: 3000
                })

            }).catch(e => {
                let errors = e.response.data.errors;
                this.errors = Object.values(errors);
            });
        },

        onSubmit() {
            let data = this.list_filds.reduce(
                (obj, item) => Object.assign(obj, { [item.name]: item.value }), {});

            if(!this.item_edit)
                this.record(data)
            else
                this.update(data)
        },

        selectForView(id){
            this.item_view = collect(this.items).where('id', id).first()
            this.openModal()
        },

        selectForEdit(id){
            this.item_edit = collect(this.items).where('id', id).first()
            this.openModal()
        },

        insertInForm(data){
            if (this.item_edit){
                let form = collect(Object.keys(this.item_edit)).map((item) => {

                    const i = collect(this.form).where('name', item).first();

                    if (i && this.item_edit){
                        i.value = this.item_edit[i.name];
                    }
                    return i;
                })
                form = collect(form.items).filter(n => n);
                return form.items
            }

            if (this.item_view){
                let form = collect(Object.keys(this.item_view)).map((item) => {

                    const i = collect(this.form).where('name', item).first();

                    if (i && this.item_view){
                        i.value = this.item_view[i.name];
                    }
                    return i;
                })
                form = collect(form.items).filter(n => n);
                return form.items
            }

        },

        closeModal(){
            this.resetForm()
            this.$bvModal.hide('modal-crud')
        },
        openModal(){
            this.$bvModal.show('modal-crud')
        },

        resetForm(){
            this.item_edit = null
            this.item_view = null
            let form = collect(this.list_filds).map((item)=>{
                item.value = null
                return item
            })
            this.list_filds = form.items
        },

        filter_list(list_items){
            list_items = collect(list_items).filter((item)=>{
                let i =  false
                collect(this.filter).each((filter)=>{
                    if (item[filter].search(this.search) >= 0)
                        i = true
                })
                return i
            })
            return list_items.items
        }
    },

    computed:{
        list_filds(){
            let form = this.form

            if (this.item_edit){
                form = this.insertInForm()
            }

            if (this.item_view){
                form = this.insertInForm()
            }

            return form
        },
        items(){
            let list_items = this.list_items

            if (this.search){
                list_items = this.filter_list(list_items)
            }

            return list_items
        }
    },

    created() {
        this.getItems()
    }
}
</script>

<style scoped>
.header-page{
    background: #efeeee;
    padding: 20px;
}
.list{
    padding: 0;
}
.list li{
    list-style: none;
    background: #efeeee;
    padding: 10px;
    margin-bottom: 5px;
}
.list p {
    margin: 0;
}
</style>
