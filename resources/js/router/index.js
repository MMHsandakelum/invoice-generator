import { createRouter, createWebHistory } from "vue-router";
import invoiceIndex from '../component/invoice/index.vue';
import newInvoice from '../component/invoice/new.vue';
import showInvoice from "../component/invoice/show.vue";
import homePage from "../component/invoice/home.vue";
import products from "../component/product/index.vue";
import NotFound from "../component/NotFound.vue";


const routes = [
    {
        path: '/',
        component: homePage
    },

    {
        path: '/invoices',
        component: invoiceIndex
    },

    {
        path: '/invoice/new',
        component: newInvoice
    },

    {
        path: '/products',
        component: products
    },

    {
        path: '/invoice/show/:id',
        component: showInvoice,
        props: true
    },

    {
        path: '/:pathMatch(.*)*',
        component: NotFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router