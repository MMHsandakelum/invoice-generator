<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

let form = ref([]);
let allCustomers = ref([]);
let customer_id = ref([]);
let item = ref([]);
let listCart = ref([]);
const showModal = ref(false);
const hideModal = ref(true);
let allproducts = ref([]);

onMounted(async () => {
    formData();
    Customers();
    allProducts();
});

const formData = async () => {
    let response = await axios.get("/api/new_invoice");
    // console.log("form:", response.data);
    form.value = response.data;
};

const Customers = async () => {
    let response = await axios.get("/api/all_customers");
    // console.log("Customers :", response);
    allCustomers.value = response.data.customers;
};

const addCart = (item) => {
    const itemCart = {
        id: item.id,
        item_code: item.item_code,
        item_name: item.name,
        unit_price: item.unit_price,
        quantity: item.quantity,
    };

    listCart.value.push(itemCart);
    closeModal();
};

const openModal = () => {
    showModal.value = hideModal.value;
};

const closeModal = () => {
    showModal.value = !hideModal.value;
};

const allProducts = async () => {
    let response = await axios.get("/api/get_all_products");
    // console.log("products", response.data);
    allproducts.value = response.data.products;
};

const getTotal = () => {
    let total = 0;
    listCart.value.map((data) => {
        total = total + data.unit_price * data.quantity;
    });
    return total;
};

const Total = (d) => {
    let grand_total = 0;
    grand_total = getTotal() - d;
    return grand_total;
};

const removeProduct = (i) => {
    listCart.value.splice(i, 1);
};
</script>
<template>
    <div class="container" style="margin-top: 0px">
        <div class="container" style="padding: 0px; margin-top: 0px">
            <div class="invoices">
                <div class="card__header">
                    <div>
                        <h2 class="invoice__title">New Invoice</h2>
                    </div>
                    <div></div>
                </div>

                <div class="card__content">
                    <div class="card__content--header">
                        <div>
                            <p class="my-1">Customer</p>
                            <select
                                name=""
                                id=""
                                class="input"
                                v-model="customer_id"
                            >
                                <option disabled>Select Your Customer</option>
                                <option
                                    :value="customer.id"
                                    v-for="customer in allCustomers"
                                    :key="customer.id"
                                >
                                    {{ customer.first_name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <p class="my-1">Date</p>
                            <input
                                id="date"
                                placeholder="dd-mm-yyyy"
                                type="date"
                                class="input"
                                v-model="form.date"
                            />
                            <!---->
                            <p class="my-1">Due Date</p>
                            <input
                                id="due_date"
                                type="date"
                                class="input"
                                v-model="form.due_date"
                            />
                        </div>
                        <div>
                            <p class="my-1">Numero</p>
                            <input
                                type="text"
                                class="input"
                                v-model="form.number"
                            />
                            <p class="my-1">Reference(Optional)</p>
                            <input
                                type="text"
                                class="input"
                                v-model="form.reference"
                            />
                        </div>
                    </div>
                    <br /><br />
                    <div class="table">
                        <div class="table--heading2">
                            <p>Item Description</p>
                            <p>Unit Price</p>
                            <p>Qty</p>
                            <p>Total</p>
                            <p></p>
                        </div>

                        <!-- item 1 -->
                        <div
                            class="table--items2"
                            v-for="(item, i) in listCart"
                            :key="item.id"
                        >
                            <p>#{{ item.item_code }} {{ item.item_name }}</p>
                            <p>
                                <input
                                    type="text"
                                    class="input"
                                    v-model="item.unit_price"
                                />
                            </p>
                            <p>
                                <input
                                    type="text"
                                    class="input"
                                    v-model="item.quantity"
                                />
                            </p>
                            <p v-if="item.quantity">
                                Rs {{ item.unit_price * item.quantity }}
                            </p>
                            <p v-else></p>
                            <p
                                style="
                                    color: red;
                                    font-size: 24px;
                                    cursor: pointer;
                                "
                                @click="removeProduct(i)"
                            >
                                &times;
                            </p>
                        </div>
                        <div style="padding: 10px 30px !important">
                            <button
                                class="btn btn-sm btn__open--modal"
                                @click="openModal()"
                            >
                                Add New Line
                            </button>
                        </div>
                    </div>

                    <div class="table__footer">
                        <div class="document-footer">
                            <p>Terms and Conditions</p>
                            <textarea
                                cols="50"
                                rows="7"
                                class="textarea"
                                v-model="form.term_and_condition"
                            ></textarea>
                        </div>
                        <div>
                            <div class="table__footer--subtotal">
                                <p>Sub Total</p>
                                <span>Rs {{ getTotal() }}</span>
                            </div>
                            <div class="table__footer--discount">
                                <p>Discount</p>
                                <input
                                    type="text"
                                    class="input"
                                    v-model="form.discount"
                                />
                            </div>
                            <div class="table__footer--total">
                                <p>Grand Total</p>
                                <span>Rs {{ Total(form.discount) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card__header" style="margin-top: 40px">
                    <div></div>
                    <div>
                        <a class="btn btn-secondary"> Save </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--==================== add modal items ====================-->
    <div class="modal main__modal" :class="{ show: showModal }">
        <div class="modal__content">
            <span class="modal__close btn__close--modal" @click="closeModal()"
                >×</span
            >
            <h3 class="modal__title">Add Item</h3>
            <hr />
            <br />
            <div class="modal__items">
                <ul>
                    <li
                        v-for="(product, i) in allproducts"
                        :key="product.id"
                        style="
                            display: grid;
                            grid-template-columns: 30px 350px 15px;
                            align-items: center;
                            padding-bottom: 5px;
                        "
                    >
                        <p>{{ i + 1 }}</p>
                        <a href="#"
                            >{{ product.item_code }}{{ product.name }}</a
                        >
                        <button
                            @click="addCart(product)"
                            style="
                                border: 1px solid #e0e0e0;
                                width: 35px;
                                height: 35px;
                                cursor: pointer;
                            "
                        >
                            +
                        </button>
                    </li>
                </ul>
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
                <button class="btn btn-light btn__close--modal">Save</button>
            </div>
        </div>
    </div>
</template>
