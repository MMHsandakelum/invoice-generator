import { createRouter, createWebHistory } from "vue-router";
import invoiceIndex from '../component/invoice/index.vue';
import NotFound from "../component/NotFound.vue";

const routes = [
    {
        path: '/',
        component: invoiceIndex
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