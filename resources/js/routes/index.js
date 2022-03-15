
import ExampleComponent from "../components/ExampleComponent";
import Welcome from "../pages/Welcome"
import Sellers from "../pages/Sellers"
import Sales from "../pages/Sales"

export default {
    mode: 'history',
    linkActiveClass:'active-menu',

    routes:[
        {
            path:'/',
            name: 'welcome',
            component: Welcome
        },
        {
            path:'/vendedores',
            name:'sellers',
            component: Sellers
        },
        {
            path:'/vendas',
            name:'sales',
            component: Sales
        },
    ]
}
