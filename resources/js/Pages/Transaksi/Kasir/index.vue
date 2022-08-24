<template lang="">
    <blankVue>
        <template v-slot:title>
            <title>Pemasukkan | Point Of Sales</title>
        </template>
        <template v-slot:breadcrumbs>
            <ul>
                <li><a>Transaksi</a></li>
                <li><a>Kasir</a></li>
                <li></li>
            </ul>
        </template>
        <template v-slot:alert>
            <div v-if="success" class="alert alert-success shadow-lg mb-2">
                <div>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="stroke-current flex-shrink-0 h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <span class="capitalize">{{ success }}</span>
                </div>
            </div>
            <div v-if="warning" class="alert bg-yellow-400 shadow-lg mb-2">
                <div>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="stroke-current flex-shrink-0 h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                        />
                    </svg>
                    <span class="capitalize">{{ warning }}</span>
                </div>
            </div>
            <div v-if="danger" class="alert bg-red-400 shadow-lg mb-2">
                <div>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="stroke-current flex-shrink-0 h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                        />
                    </svg>
                    <span class="capitalize">{{ danger }}</span>
                </div>
            </div>
        </template>
        <!-- <template v-slot:opsibutton>
            <div class="flex justify-end">
                <Link :href="route('transaksipemasukkan.create')">
                    <div
                        class="flex justify-center items-center modal-button w-24 bg-green-500 hover:bg-green-400 capitalize h-8 rounded-lg"
                    >
                        <i class="fa-solid fa-plus pr-2"></i>tambah
                    </div>
                </Link>
            </div>
        </template> -->
        <template v-slot:konten>
            <div class="form-control mb-2">
                <div class="input-group">
                    <select
                        v-model="search.searchField"
                        class="select select-bordered"
                    >
                        <option value="">Select</option>
                        <option
                            v-for="(item, index) in headers"
                            :key="index"
                            :value="item.value"
                        >
                            {{ item.text }}
                        </option>
                    </select>
                    <input
                        v-model="search.searchValue"
                        type="text"
                        placeholder="Search..."
                        class="input input-bordered w-full max-w-xs"
                    />
                </div>
            </div>
            <DataTable
                :headers="headers"
                :items="items"
                :search-field="search.searchField"
                :search-value="search.searchValue"
                buttons-pagination
                show-index
            >
                <template #item-total="item">
                    Rp. {{ item.total }}
                </template>
                <template #expand="item">
                    <ul class="menu bg-gray-100">
                        <li>
                            <a
                                ><div class="grid grid-cols-4 gap-2">
                                    <div
                                        v-for="(pesanan, index) in item.pesanan"
                                        :key="index"
                                    >
                                        Nama : "{{ pesanan.nama }}"<br />
                                        Jumlah: "{{ pesanan.jumlah }}"<br />
                                        Harga: "{{ pesanan.harga }}" <br />
                                        Total: "{{ pesanan.total }}"
                                    </div>
                                </div></a
                            >
                        </li>
                    </ul>
                </template>
            </DataTable>
        </template>
    </blankVue>
</template>
<script>
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "vue";
import blankVue from "../../Template/blank.vue";

export default {
    data() {
        return {
            headers: [
                { text: "ID", value: "id" },
                { text: "Nama", value: "nama" },
                { text: "Meja", value: "meja" },
                { text: "Total", value: "total" },
                { text: "Cashier", value: "cashier" },
            ],
            items: this.pemesanan,
        };
    },
    components: {
        blankVue,
    },
    setup() {
        const search = reactive({
            searchField: "",
            searchValue: "",
        });
        return {
            search,
        };
    },
    props: {
        pemesanan: Array,
        success: String,
        warning: String,
        danger: String,
    },
    methods: {
        edit(id) {
            Inertia.get(
                route("transaksipemasukkan.edit", {
                    pemasukkan: id,
                })
            );
        },
        hapus(id) {
            Inertia.delete(
                route("transaksipemasukkan.destroy", {
                    pemasukkan: id,
                })
            );
        },
    },
    mounted() {
        console.log(this.items);
    },
    computed: {
        filteredItems() {
            return this.pemesanan.filter((item) => {
                return (
                    item.nama
                        .toLowerCase()
                        .indexOf(this.search.value.toLowerCase()) > -1
                );
            });
        },
    },
};
</script>
<style lang=""></style>
