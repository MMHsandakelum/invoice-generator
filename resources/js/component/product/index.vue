<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

let items = ref([]);
const hideModal = ref(true);
const showModal = ref(false);
let form = ref([]);

onMounted(async () => {
    getProducts();
    get_form_data();
});

const getProducts = async () => {
    let response = await axios.get("/api/get_all_products");
    // console.log("response", response);
    items.value = response.data.products;
};

const closeModal = () => {
    showModal.value = !hideModal.value;
};
const openModal = () => {
    showModal.value = hideModal.value;
};

const get_form_data = async () => {
    let response = await axios.get("/api/add_new_product");
    // console.log("response", response);
    form.value = response.data.formData;
};

const add_product = () => {
    const formData = new FormData();
    formData.append("item_code", form.value.item_code);
    formData.append("name", form.value.name);
    formData.append("description", form.value.description);
    formData.append("unit_price", form.value.unit_price);
    formData.append("stoke_count", form.value.stoke_count);

    axios.post("/api/add_product", formData);
    closeModal();
    getProducts();
};
</script>
<template>
    <div class="container" style="color: black">
        <div class="invoices">
            <div class="card__header">
                <div>
                    <h2 class="invoice__title">Products</h2>
                </div>
                <div>
                    <button class="btn btn-primary" @click="openModal()">
                        Add new product
                    </button>
                </div>
            </div>

            <div class="table card__content">
                <div class="table--search">
                    <div class="table--search--wrapper">
                        <select class="table--search--select" name="" id="">
                            <option value="">Filter</option>
                        </select>
                    </div>
                    <div class="relative">
                        <i class="table--search--input--icon fas fa-search"></i>
                        <input
                            class="table--search--input"
                            type="text"
                            placeholder="Search invoice"
                        />
                    </div>
                </div>

                <div class="table--heading">
                    <p>ID</p>
                    <p>Item Code</p>
                    <p>Name</p>
                    <p>Unit Price</p>
                    <p>Stokes</p>
                </div>

                <!-- item 1 -->
                <div
                    class="table--items"
                    v-for="(item, i) in items"
                    :key="item.id"
                    v-if="items"
                >
                    <a href="" class="table--items--transactionId"
                        >#{{ item.id }}</a
                    >
                    <p>{{ item.item_code }}</p>
                    <p>{{ item.name }}</p>
                    <p>{{ item.unit_price }}</p>
                    <p>{{ item.stoke_count }}</p>
                </div>
                <div class="table--items" v-else>
                    <p>Invoices Not Found</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal main__modal" :class="{ show: showModal }">
        <div class="modal__content">
            <span class="modal__close btn__close--modal" @click="closeModal()"
                >×</span
            >
            <h3 class="modal__title">Add Customer</h3>
            <hr />
            <br />
            <div
                class="modal__items"
                style="display: flex; flex-direction: column"
            >
                <div class="row form-row">
                    <div class="col-4">
                        <label for="" class="form-label">Item Code</label>
                    </div>
                    <div class="col-8">
                        <input
                            type="text"
                            class="form-control"
                            id=""
                            v-model="form.item_code"
                            required
                        />
                    </div>
                </div>
                <div class="row form-row">
                    <div class="col-4">
                        <label for="" class="form-label">Name</label>
                    </div>
                    <div class="col-8">
                        <input
                            type="text"
                            class="form-control"
                            id=""
                            v-model="form.name"
                            required
                        />
                    </div>
                </div>
                <div class="row form-row">
                    <div class="col-4">
                        <label for="" class="form-label">Description</label>
                    </div>
                    <div class="col-8">
                        <textarea
                            id="w3review"
                            name="w3review"
                            rows="4"
                            cols="20"
                            class="form-control"
                            v-model="form.description"
                        ></textarea>
                    </div>
                </div>
                <div class="row form-row">
                    <div class="col-4">
                        <label for="" class="form-label">Unit price</label>
                    </div>
                    <div class="col-8">
                        <input
                            type="double"
                            class="form-control"
                            id=""
                            v-model="form.unit_price"
                            required
                        />
                    </div>
                </div>
                <div class="row form-row">
                    <div class="col-4">
                        <label for="" class="form-label">In stoke</label>
                    </div>
                    <div class="col-8">
                        <input
                            type="number"
                            class="form-control"
                            id=""
                            v-model="form.stoke_count"
                            required
                        />
                    </div>
                </div>
            </div>
            <br />
            <hr />
            <div class="model__footer">
                <button
                    class="btn btn-light mr-2 btn__close--modal"
                    @click="closeModal()"
                >
                    Cancel
                </button>
                <button
                    class="btn btn-light btn__close--modal"
                    @click="add_product()"
                >
                    Save
                </button>
            </div>
        </div>
    </div>
</template>
