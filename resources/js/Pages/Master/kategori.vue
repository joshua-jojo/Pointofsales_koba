<template lang="">
    <blankVue>
        <template v-slot:title>
            <title>Kategori | Point Of Sales</title>
        </template>
        <template v-slot:breadcrumbs>
            <ul>
                <li><a>Master</a></li>
                <li><a>kategori</a></li>
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
            <div class="flex justify-end">
                <a
                    href="#modal-tambah"
                    class="flex justify-center items-center modal-button w-24 bg-green-500 hover:bg-green-400 capitalize h-8 rounded-lg"
                    ><i class="fa-solid fa-plus pr-2"></i>tambah</a
                >
            </div>
        </template>
        <template v-slot:konten>
            <div class="form-control mb-2">
                <div class="input-group">
                    <input
                        type="text"
                        v-model="search.value"
                        @input="cari"
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
            <table id="dataTable" class="table w-full table-zebra">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Taking Order</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->

                    <tr v-for="(data, index) in filteredItems">
                        <td>{{ data.nama }}</td>
                        <td>{{ data.taking_order }}</td>
                        <td class="text-white flex flex-row">
                            <a href="#modal-edit" @click="edit(data.id)">
                                <label
                                    class="flex justify-center items-center modal-button w-24 bg-blue-500 hover:bg-blue-400 capitalize h-8 rounded-lg mr-2"
                                >
                                    <i
                                        class="fa-solid fa-pen-to-square pr-2"
                                    ></i
                                    >edit
                                </label>
                            </a>
                            <a href="#modal-hapus" @click="edit(data.id)">
                                <label
                                    @click="hapus(data.id)"
                                    class="flex justify-center items-center modal-button w-24 bg-red-500 hover:bg-red-400 capitalize h-8 rounded-lg"
                                >
                                    <i class="fa-solid fa-trash pr-2"></i>hapus
                                </label>
                            </a>
                        </td>
                    </tr>

                    <!-- row 2 -->
                </tbody>
            </table>
        </template>
        <template v-slot:modals>
            <div class="modal modal-middle sm:modal-middle" id="modal-tambah">
                <div class="modal-box">
                    <form class="w-full h-full" @submit.prevent="submit">
                        <h3 class="font-bold text-lg mb-1">Nama Kategori</h3>
                        <input
                            type="text"
                            v-model="form.nama"
                            placeholder="Type here"
                            required
                            class="input input-bordered w-full"
                        />
                        <h3 class="font-bold text-lg mb-1 capitalize">
                            Taking Order
                        </h3>
                        <select
                            class="select select-bordered w-full mb-2"
                            name="kategori"
                            v-model="form.taking_order"
                            required
                        >
                            <option value="barista">barista</option>
                            <option value="cook">cook</option>
                        </select>
                        <div class="modal-action">
                            <a
                                v-if="
                                    form.nama != null &&
                                    form.taking_order != null
                                "
                                href="#"
                                @click="add"
                                class="btn bg-green-500 text-white hover:bg-green-400 border-0"
                            >
                                Save
                            </a>
                            <a href="#" class="btn">Exit</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal modal-middle sm:modal-middle" id="modal-edit">
                <div class="modal-box">
                    <h3 class="font-bold text-lg mb-1">Nama Kategori</h3>
                    <input
                        type="text"
                        v-model="formedit.id"
                        placeholder="Type here"
                        required
                        hidden
                        class="input input-bordered w-full"
                    />
                    <input
                        type="text"
                        v-model="formedit.nama"
                        placeholder="Type here"
                        required
                        class="input input-bordered w-full"
                    />
                    <h3 class="font-bold text-lg mb-1 capitalize">
                        Taking Order
                    </h3>
                    <select
                        class="select select-bordered w-full mb-2"
                        name="kategori"
                        v-model="formedit.taking_order"
                        required
                    >
                        <option value="barista">barista</option>
                        <option value="cook">cook</option>
                    </select>
                    <div class="modal-action">
                        <a
                            v-if="
                                formedit.nama != null &&
                                formedit.taking_order != null
                            "
                            href="#"
                            @click="submitedit"
                            class="btn bg-green-500 text-white hover:bg-green-400 border-0"
                        >
                            Save
                        </a>
                        <a href="#" class="btn">Exit</a>
                    </div>
                </div>
            </div>
            <div class="modal modal-middle sm:modal-middle" id="modal-hapus">
                <div class="modal-box">
                    <h3 class="font-bold text-lg mb-1">
                        Konfirmasi Penghapusan Kategori {{formhapus.nama}}
                    </h3>
                    <div class="modal-action">
                        <a
                            v-if="
                                formhapus.nama != null &&
                                formhapus.id != null
                            "
                            href="#"
                            @click="submithapus"
                            class="btn bg-red-500 text-white hover:bg-red-400 border-0"
                        >
                            Hapus
                        </a>
                        <a href="#" class="btn">Exit</a>
                    </div>
                </div>
            </div>
        </template>
    </blankVue>
</template>
<script>
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import blankVue from "../Template/blank.vue";
import route from "../../../../vendor/tightenco/ziggy/src/js";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        blankVue,
    },
    props: {
        kategori: Array,
        success: String,
        warning: String,
        danger: String,
    },
    mounted() {},
    setup() {
        const form = reactive({
            nama: null,
            taking_order: null,
        });
        function submit() {
            Inertia.post(route("masterkategori.store"), form);
        }

        const formedit = useForm({
            id: null,
            nama: null,
            taking_order: null,
        });
        function submitedit() {
            this.formedit.put(
                route("masterkategori.update", { kategori: this.formedit.id })
            );
        }

        const formhapus = useForm({
            id: null,
            nama: null,
        });
        function submithapus() {
            this.formedit.delete(
                route("masterkategori.destroy", { kategori: this.formedit.id })
            );
        }

        const search = reactive({
            value: "",
        });

        return {
            formhapus,
            submithapus,
            formedit,
            submitedit,
            form,
            submit,
            search,
        };
    },
    computed: {
        filteredItems() {
            return this.kategori.filter((item) => {
                return (
                    item.nama
                        .toLowerCase()
                        .indexOf(this.search.value.toLowerCase()) > -1
                );
            });
        },
    },
    methods: {
        add() {
            Inertia.post(route("masterkategori.store"), this.form);
        },
        edit(id) {
            var data;
            this.kategori.filter((items) => {
                if (items.id == id) {
                    data = items;
                }
            });
            this.formedit.id = data.id;
            this.formedit.nama = data.nama;
            this.formedit.taking_order = data.taking_order;
        },
        hapus(id) {
            var data;
            this.kategori.filter((items) => {
                if (items.id == id) {
                    data = items;
                }
            });
            this.formhapus.id = data.id;
            this.formhapus.nama = data.nama;
        },
    },
    updated() {},
};
</script>
<style lang=""></style>
