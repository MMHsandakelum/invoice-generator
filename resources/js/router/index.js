import { createRouter, createWebHistory } from "vue-router";
import invoiceIndex from '../component/invoice/index.vue';
import newInvoice from '../component/invoice/new.vue';
import NotFound from "../component/NotFound.vue";


const routes = [
    {
        path: '/',
        component: invoiceIndex
    },

    {
        path: '/invoice/new',
        component: newInvoice
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