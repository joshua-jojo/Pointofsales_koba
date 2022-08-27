<template lang="">
    <blankVue>
        <template v-slot:title>
            <title>Pemasukkan | Point Of Sales</title>
        </template>
        <template v-slot:breadcrumbs>
            <ul>
                <li><a>Transaksi</a></li>
                <li><a>Pemasukkan</a></li>
                <li></li>
            </ul>
        </template>
        <template v-slot:alert>
            <div v-if="errors" class="toast toast-start">
                <div
                    v-if="this.alert_success"
                    class="alert alert-success shadow-lg"
                >
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
                        <span>{{ this.alert_success }}</span>
                    </div>
                </div>
                <div
                    v-if="this.alert_warning"
                    class="alert alert-warning shadow-lg"
                >
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
                        <span>{{ this.alert_warning }}</span>
                    </div>
                </div>
                <div
                    v-if="this.alert_danger"
                    class="alert alert-error shadow-lg"
                >
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
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                        <span>{{ this.alert_danger }}</span>
                    </div>
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
                    <h2 class="font-bold text-lg">Tambah Pemasukkan</h2>
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
                            <span class="label-text">harga</span>
                        </label>
                        <input
                            v-model="formtambah.harga"
                            @input="hitungtambah"
                            type="text"
                            placeholder="harga..."
                            class="input input-bordered"
                        />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Jumlah</span>
                        </label>
                        <input
                            v-model="formtambah.jumlah"
                            @input="hitungtambah"
                            type="text"
                            placeholder="jumlah..."
                            class="input input-bordered"
                        />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">total</span>
                        </label>
                        <input
                            readonly
                            v-model="formtambah.total"
                            type="text"
                            placeholder="total..."
                            class="input input-bordered"
                        />
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
                    <h2 class="font-bold text-lg">Tambah Pemasukkan</h2>
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
                            <span class="label-text">harga</span>
                        </label>
                        <input
                            v-model="formedit.harga"
                            type="text"
                            @input="hitungedit"
                            placeholder="harga..."
                            class="input input-bordered"
                        />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Jumlah</span>
                        </label>
                        <input
                            v-model="formedit.jumlah"
                            @input="hitungedit"
                            type="text"
                            placeholder="jumlah..."
                            class="input input-bordered"
                        />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">total</span>
                        </label>
                        <input
                            readonly
                            v-model="formedit.total"
                            type="text"
                            placeholder="total..."
                            class="input input-bordered"
                        />
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
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr v-for="(item, index) in filteredItems">
                            <td>{{ item.nama }}</td>
                            <td>{{ item.jumlah }}</td>
                            <td>{{ item.harga }}</td>
                            <td>{{ item.total }}</td>
                            <td class="text-white flex flex-row">
                                <a href="#modal-edit">
                                    <label
                                        @click="edit(item.id)"
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
                                        @click="hapus(item.id)"
                                        class="flex justify-center items-center modal-button w-24 bg-red-500 hover:bg-red-400 capitalize h-8 rounded-lg"
                                    >
                                        <i class="fa-solid fa-trash pr-2"></i
                                        >hapus
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
import { useForm } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";
import blankVue from "../../Template/blank.vue";

export default {
    components: {
        blankVue,
    },
    setup() {
        const formtambah = useForm({
            nama: null,
            harga: null,
            jumlah: null,
            total: null,
        });
        function submittambah() {
            this.formtambah.post(route("transaksipemasukkan.store"));
        }
        const formedit = useForm({
            id: null,
            nama: null,
            harga: null,
            jumlah: null,
            total: null,
        });
        function submitedit() {
            this.formedit.put(
                route("transaksipemasukkan.update", {
                    pemasukkan: this.formedit.id,
                })
            );
        }
        const formhapus = useForm({
            id: null,
            nama: null,
        });
        function submithapus() {
            this.formhapus.delete(
                route("transaksipemasukkan.destroy", {
                    pemasukkan: this.formhapus.id,
                })
            );
        }
        const search = reactive({
            value: "",
        });
        return {
            formtambah,
            submittambah,
            formedit,
            submitedit,
            formhapus,
            submithapus,
            search,
        };
    },
    props: {
        pemasukkan: Array,
        success: String,
        warning: String,
        danger: String,
        errors: Object,
    },
    data() {
        return {
            alert_success: null,
            alert_warning: null,
            alert_danger: null,
        };
    },
    updated() {
        console.log({
            success: this.success,
            warning: this.warning,
            danger: this.danger,
        });
        if (this.success) {
            this.alert_success = this.success;
            setTimeout(() => (this.alert_success = null), 5000);
        } else if (this.warning) {
            this.alert_warning = this.warning;
            setTimeout(() => (this.alert_warning = null), 5000);
        } else if (this.danger) {
            this.alert_danger = this.danger;
            setTimeout(() => (this.alert_danger = null), 5000);
        }
    },
    mounted() {},
    methods: {
        edit(id) {
            var data;
            this.pemasukkan.filter((items) => {
                if (items.id == id) {
                    data = items;
                }
            });
            this.formedit.id = data.id;
            this.formedit.nama = data.nama;
            this.formedit.harga = data.harga;
            this.formedit.total = data.total;
            this.formedit.jumlah = data.jumlah;
        },
        hapus(id) {
            var data;
            this.pemasukkan.filter((items) => {
                if (items.id == id) {
                    data = items;
                }
            });
            this.formhapus.id = data.id;
            this.formhapus.nama = data.nama;
        },
        hitungedit() {
            this.formedit.total = this.formedit.harga * this.formedit.jumlah;
        },
        hitungtambah() {
            this.formtambah.total =
                this.formtambah.harga * this.formtambah.jumlah;
        },
    },
    computed: {
        filteredItems() {
            return this.pemasukkan.filter((item) => {
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
