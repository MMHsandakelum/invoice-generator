<script setup>
import router from "../../router";

const invoices = () => {
    router.push("/invoices");
};

const newInvoices = () => {
    router.push("/invoice/new");
};

const products = () => {
    router.push("/products");
};
</script>
<template>
    <div class="container">
        <h1 style="color: black; font-weight: bold; text-align: center">
            INVOICE GENERATOR
        </h1>
        <div style="color: black; margin-top: 100px">
            <div class="row">
                <div class="col-6">
                    <button
                        class="btn btn-primary"
                        style="width: 100%; height: 100px"
                        @click="invoices()"
                    >
                        Invoices
                    </button>
                </div>
                <div class="col-6">
                    <button
                        class="btn btn-success"
                        style="width: 100%; height: 100px"
                        @click="newInvoices()"
                    >
                        Create New Invoice
                    </button>
                </div>
            </div>
            <div class="row" style="margin-top: 50px">
                <div class="col-6">
                    <button
                        class="btn btn-danger"
                        style="width: 100%; height: 100px"
                        @click="products()"
                    >
                        Products
                    </button>
                </div>
                <div class="col-6">
                    <button
                        class="btn btn-dark"
                        style="width: 100%; height: 100px"
                    >
                        Soon
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
