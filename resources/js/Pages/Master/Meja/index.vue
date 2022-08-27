<template lang="">
    <blankVue>
        <template v-slot:title>
            <title>Kategori | Point Of Sales</title>
        </template>

        <template v-slot:breadcrumbs>
            <ul>
                <li><a>Master</a></li>
                <li><a>meja</a></li>
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
                <a href="#modal-tambah">
                    <div
                        class="flex justify-center items-center modal-button w-24 bg-green-500 hover:bg-green-400 capitalize h-8 rounded-lg"
                    >
                        <i class="fa-solid fa-plus pr-2"></i>tambah
                    </div>
                </a>
            </div>
        </template>
        <template v-slot:modals>
            <div class="modal" id="modal-tambah">
                <div class="modal-box">
                    <h2 class="font-bold text-lg">Tambah Meja</h2>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama</span>
                        </label>
                        <input
                            v-model="formtambah.nama"
                            type="text"
                            placeholder="Nama..."
                            class="input input-bordered"
                        />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Status</span>
                        </label>
                        <select
                            v-model="formtambah.status"
                            class="select select-bordered w-full"
                        >
                            <option value="1" class="capitalize">aktif</option>
                            <option selected value="0" class="capitalize">
                                tidak aktif
                            </option>
                        </select>
                    </div>
                    <div class="modal-action">
                        <a
                            href="#"
                            class="btn bg-green-500 hover:bg-green-400 text-white border-0"
                            @click="submittambah"
                            >Save</a
                        >
                        <a href="#" class="btn">Exit</a>
                    </div>
                </div>
            </div>
            <div class="modal" id="modal-edit">
                <div class="modal-box">
                    <h2 class="font-bold text-lg">Edit Meja</h2>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama</span>
                        </label>
                        <input
                            v-model="formedit.nama"
                            type="text"
                            placeholder="Nama..."
                            class="input input-bordered"
                        />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Status</span>
                        </label>
                        <select
                            v-model="formedit.status"
                            class="select select-bordered w-full"
                        >
                            <option value="1" class="capitalize">aktif</option>
                            <option selected value="0" class="capitalize">
                                tidak aktif
                            </option>
                        </select>
                    </div>
                    <div class="modal-action">
                        <a
                            href="#"
                            class="btn bg-green-500 hover:bg-green-400 text-white border-0"
                            @click="submitedit"
                            >Save</a
                        >
                        <a href="#" class="btn">Exit</a>
                    </div>
                </div>
            </div>
            <div class="modal" id="modal-hapus">
                <div class="modal-box">
                    <h2 class="font-bold text-lg">
                        Konfirmasi penghapusan {{ formhapus.nama }}
                    </h2>
                    <div class="modal-action">
                        <a
                            href="#"
                            class="btn bg-red-500 hover:bg-red-400 text-white border-0"
                            @click="submithapus"
                            >Delete</a
                        >
                        <a href="#" class="btn">Exit</a>
                    </div>
                </div>
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
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data, index) in filteredItems" :key="index">
                            <td>{{ data.nama }}</td>
                            <td v-if="data.status == 0">Tidak Aktif</td>
                            <td v-if="data.status == 1">Aktif</td>
                            <td class="text-white flex flex-row">
                                <a href="#modal-edit">
                                    <label
                                        @click="edit(data.id)"
                                        class="flex justify-center items-center modal-button w-24 bg-blue-500 hover:bg-blue-400 capitalize h-8 rounded-lg mr-2"
                                    >
                                        <i
                                            class="fa-solid fa-pen-to-square pr-2"
                                        ></i
                                        >edit
                                    </label>
                                </a>
                                <a href="#modal-hapus">
                                <label
                                    @click="hapus(data.id)"
                                    class="flex justify-center items-center modal-button w-24 bg-red-500 hover:bg-red-400 capitalize h-8 rounded-lg"
                                >
                                    <i class="fa-solid fa-trash pr-2"></i>hapus
                                </label>
                                </a>
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
import { useForm } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";
import route from "../../../../../vendor/tightenco/ziggy/src/js";
import blankVue from "../../Template/blank.vue";

export default {
    components: {
        blankVue,
    },
    props: {
        meja: Array,
        success: String,
        warning: String,
        danger: String,
    },
    setup() {
        const formtambah = useForm({
            nama: null,
            status: 0,
        });
        function submittambah() {
            this.formtambah.post(route("mastermeja.store"));
        }

        const formedit = useForm({
            id: null,
            nama: null,
            status: 0,
        });
        function submitedit() {
            this.formedit.put(
                route("mastermeja.update", { meja: this.formedit.id })
            );
        }

        const formhapus = useForm({
            id: null,
            nama: null,
        });
        function submithapus() {
            this.formedit.delete(
                route("mastermeja.destroy", { meja: this.formhapus.id })
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
            formtambah,
            submittambah,
            search,
        };
    },
    methods: {
        edit(id) {
            var data;
            this.meja.filter((items) => {
                if (items.id == id) {
                    data = items;
                }
            });
            this.formedit.id = data.id;
            this.formedit.nama = data.nama;
            this.formedit.status = data.status;
        },
        hapus(id) {
            var data;
            this.meja.filter((items) => {
                if (items.id == id) {
                    data = items;
                }
            });
            this.formhapus.id = data.id;
            this.formhapus.nama = data.nama;
        },
    },
    computed: {
        filteredItems() {
            return this.meja.filter((item) => {
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
