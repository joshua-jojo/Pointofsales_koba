<template lang="">
    <blankVue>
        <template v-slot:title>
            <title>Kategori | Point Of Sales</title>
        </template>

        <template v-slot:breadcrumbs>
            <ul>
                <li><a>warehouse</a></li>
                <li><a>inventory</a></li>
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

        <template v-slot:opsibutton>
            <div class="flex justify-end w-full">
                <Link :href="route('warehouseinventory.create')">
                    <div
                        class="flex justify-center mr-3 items-center modal-button w-24 bg-green-500 hover:bg-green-400 capitalize h-8 rounded-lg"
                    >
                        <i class="fa-solid fa-plus pr-2"></i>tambah
                    </div>
                </Link>
                <Link :href="route('warehouseinventorytransaksi.index')">
                    <div
                        class="flex justify-center mr-3 items-center modal-button w-32 bg-blue-500 hover:bg-blue-400 capitalize h-8 rounded-lg"
                    >
                        <i class="fa-solid fa-plus pr-2"></i>pemasukkan
                    </div>
                </Link>
                <Link :href="route('warehouseinventorytransaksi.create')">
                    <div
                        class="flex justify-center items-center modal-button w-32 bg-red-500 hover:bg-red-400 capitalize h-8 rounded-lg"
                    >
                        <i class="fa-solid fa-plus pr-2"></i>pengeluaran
                    </div>
                </Link>
            </div>
        </template>

        <template v-slot:konten>
            <div class="form-control mb-2">
                <div class="input-group">
                    <input
                        type="text"
                        v-model="search.value"
                        placeholder="Search…"
                        class="input input-bordered"
                    />
                    <button class="btn btn-square">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data, index) in filteredItems" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ data.id }}</td>
                            <td>{{ data.nama }}</td>
                            <td>{{ data.stok }}</td>
                            <td>{{ data.satuan }}</td>
                            <td>{{ data.harga }}</td>
                            <td class="text-white flex flex-row">
                                <label
                                    @click="edit(data.id)"
                                    class="flex justify-center items-center modal-button w-24 bg-blue-500 hover:bg-blue-400 capitalize h-8 rounded-lg mr-2"
                                >
                                    <i
                                        class="fa-solid fa-pen-to-square pr-2"
                                    ></i
                                    >edit
                                </label>
                                <label
                                    @click="hapus(data.id)"
                                    class="flex justify-center items-center modal-button w-24 bg-red-500 hover:bg-red-400 capitalize h-8 rounded-lg"
                                >
                                    <i class="fa-solid fa-trash pr-2"></i>hapus
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>
    </blankVue>
</template>
<script>
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "vue";
import blankVue from "../../Template/blank.vue";

export default {
    components: {
        blankVue,
    },
    props: {
        inventory: Array,
        success: String,
        warning: String,
        danger: String,
    },
    setup() {
        const search = reactive({
            value: "",
        });
        return {
            search,
        };
    },
    methods: {
        edit(id) {
            Inertia.get(
                route("warehouseinventory.edit", {
                    inventory: id,
                })
            );
        },
        hapus(id) {
            Inertia.delete(
                route("warehouseinventory.destroy", {
                    inventory: id,
                })
            );
        },
    },
    computed: {
        filteredItems() {
            return this.inventory.filter((item) => {
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
