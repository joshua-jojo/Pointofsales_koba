<template lang="">
    <blankVue>
        <template v-slot:title>
            <title>Produk | Point Of Sales</title>
        </template>
        <template v-slot:breadcrumbs>
            <ul>
                <li><a>Master</a></li>
                <li><a>Produk</a></li>
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
                <div class="modal-box scrollbar-hide">
                    <h3 class="font-bold text-lg">Tambah Produk</h3>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama</span>
                        </label>
                        <input
                            type="text"
                            v-model="formtambah.nama"
                            placeholder="nama..."
                            class="input input-bordered"
                        />
                        <span
                            v-if="errors.nama"
                            class="label-text text-red-500"
                            >{{ errors.nama }}</span
                        >
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Harga</span>
                        </label>
                        <input
                            type="number"
                            v-model="formtambah.harga"
                            min="0"
                            placeholder="harga..."
                            class="input input-bordered"
                        />
                        <span
                            v-if="errors.harga"
                            class="label-text text-red-500"
                            >{{ errors.harga }}</span
                        >
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Diskon %</span>
                        </label>
                        <input
                            type="number"
                            v-model="formtambah.diskon"
                            min="0"
                            max="100"
                            placeholder="diskon..."
                            class="input input-bordered"
                        />
                        <span
                            v-if="errors.diskon"
                            class="label-text text-red-500"
                            >{{ errors.diskon }}</span
                        >
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Keterangan</span>
                        </label>
                        <textarea
                            v-model="formtambah.keterangan"
                            class="textarea textarea-bordered"
                            placeholder="keterangan..."
                        ></textarea>
                        <span
                            v-if="errors.keterangan"
                            class="label-text text-red-500"
                            >{{ errors.keterangan }}</span
                        >
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Kategori</span>
                        </label>
                        <select
                            class="select select-bordered w-full"
                            v-model="formtambah.kategori"
                        >
                            <option
                                v-for="(item, index) in kategori"
                                :key="index"
                            >
                                {{ item.nama }}
                            </option>
                        </select>
                        <span
                            v-if="errors.kategori"
                            class="label-text text-red-500"
                            >{{ errors.kategori }}</span
                        >
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Satuan</span>
                        </label>
                        <select
                            class="select select-bordered w-full"
                            v-model="formtambah.satuan"
                        >
                            <option
                                v-for="(item, index) in satuan"
                                :key="index"
                            >
                                {{ item.nama }}
                            </option>
                        </select>
                        <span
                            v-if="errors.satuan"
                            class="label-text text-red-500"
                            >{{ errors.satuan }}</span
                        >
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Gambar</span>
                        </label>
                        <input
                            type="file"
                            class="border"
                            @input="formtambah.gambar = $event.target.files[0]"
                        />
                        <span
                            v-if="errors.gambar"
                            class="label-text text-red-500"
                            >{{ errors.gambar }}</span
                        >
                    </div>
                    <div class="form-control" v-if="formtambah.progress">
                        <label class="label">
                            <span class="label-text">Upload Gambar</span>
                        </label>
                        <progress
                            class="progress progress-primary w-full"
                            :value="formtambah.progress.percentage"
                            max="100"
                        ></progress>
                    </div>
                    <div class="modal-action">
                        <a
                            ><button
                                @click="submittambah"
                                :disabled="formtambah.processing"
                                class="btn bg-green-500 text-white border-0"
                            >
                                Save
                            </button></a
                        >
                        <a href="#" class="btn">Exit</a>
                    </div>
                </div>
            </div>
            <div class="modal" id="modal-edit">
                <div class="modal-box scrollbar-hide">
                    <h3 class="font-bold text-lg">Edit Produk</h3>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama</span>
                        </label>
                        <input
                            type="text"
                            v-model="formedit.nama"
                            placeholder="nama..."
                            class="input input-bordered"
                        />
                        <span
                            v-if="errors.nama"
                            class="label-text text-red-500"
                            >{{ errors.nama }}</span
                        >
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Harga</span>
                        </label>
                        <input
                            type="number"
                            v-model="formedit.harga"
                            min="0"
                            placeholder="harga..."
                            class="input input-bordered"
                        />
                        <span
                            v-if="errors.harga"
                            class="label-text text-red-500"
                            >{{ errors.harga }}</span
                        >
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Diskon %</span>
                        </label>
                        <input
                            type="number"
                            v-model="formedit.diskon"
                            min="0"
                            max="100"
                            placeholder="diskon..."
                            class="input input-bordered"
                        />
                        <span
                            v-if="errors.diskon"
                            class="label-text text-red-500"
                            >{{ errors.diskon }}</span
                        >
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Keterangan</span>
                        </label>
                        <textarea
                            v-model="formedit.keterangan"
                            class="textarea textarea-bordered"
                            placeholder="keterangan..."
                        ></textarea>
                        <span
                            v-if="errors.keterangan"
                            class="label-text text-red-500"
                            >{{ errors.keterangan }}</span
                        >
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Kategori</span>
                        </label>
                        <select
                            class="select select-bordered w-full"
                            v-model="formedit.kategori"
                        >
                            <option
                                v-for="(item, index) in kategori"
                                :key="index"
                            >
                                {{ item.nama }}
                            </option>
                        </select>
                        <span
                            v-if="errors.kategori"
                            class="label-text text-red-500"
                            >{{ errors.kategori }}</span
                        >
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Satuan</span>
                        </label>
                        <select
                            class="select select-bordered w-full"
                            v-model="formedit.satuan"
                        >
                            <option
                                v-for="(item, index) in satuan"
                                :key="index"
                            >
                                {{ item.nama }}
                            </option>
                        </select>
                        <span
                            v-if="errors.satuan"
                            class="label-text text-red-500"
                            >{{ errors.satuan }}</span
                        >
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Gambar</span>
                        </label>
                        <input
                            type="file"
                            class="border"
                            @input="formedit.gambar = $event.target.files[0]"
                        />
                        <span
                            v-if="errors.gambar"
                            class="label-text text-red-500"
                            >{{ errors.gambar }}</span
                        >
                    </div>
                    <div class="form-control" v-if="formedit.progress">
                        <label class="label">
                            <span class="label-text">Upload Gambar</span>
                        </label>
                        <progress
                            class="progress progress-primary w-full"
                            :value="formedit.progress.percentage"
                            max="100"
                        ></progress>
                    </div>
                    <div class="modal-action">
                        <a href="#"
                            ><button
                                @click="submitedit"
                                :disabled="formedit.processing"
                                class="btn bg-green-500 text-white border-0"
                            >
                                Save
                            </button></a
                        >
                        <a href="#" class="btn">Exit</a>
                    </div>
                </div>
            </div>
            <div class="modal" id="modal-hapus">
                <div class="modal-box scrollbar-hide">
                    <h3 class="font-bold text-lg">
                        Konfirmasi penghapusan {{ formhapus.nama }}
                    </h3>
                    <div class="modal-action">
                        <a href="#"
                            ><button
                                @click="submithapus"
                                :disabled="formhapus.processing"
                                class="btn bg-red-500 text-white border-0"
                            >
                                Hapus
                            </button></a
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
                            <th></th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <!-- <th>Stok</th> -->
                            <th>Satuan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr v-for="(item, index) in filteredItems">
                            <td class="flex justify-center">
                                <div class="avatar">
                                    <div class="mask mask-squircle w-20 h-20">
                                        <img
                                            :src="item.gambar"
                                            alt="Avatar Tailwind CSS Component"
                                        />
                                    </div>
                                </div>
                            </td>
                            <td>{{ item.nama }}</td>
                            <td>{{ item.harga }}</td>
                            <td>{{ item.kategori }}</td>
                            <td>{{ item.satuan }}</td>
                            <td class="text-white">
                                <div class="grid grid-cols-2 gap-1 w-max">
                                     <a href="#modal-edit">
                                    <label
                                        @click="edit(item.id)"
                                        class="flex justify-center items-center modal-button w-24 bg-blue-500 hover:bg-blue-400 capitalize h-8 rounded-lg"
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
                                            <i
                                                class="fa-solid fa-trash pr-2"
                                            ></i
                                            >hapus
                                        </label>
                                    </a>
                                </div>
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
import blankVue from "../../Template/blank.vue";

export default {
    components: {
        blankVue,
    },
    data() {
        return {
            alert_success: null,
            alert_warning: null,
            alert_danger: null,
        };
    },
    updated() {
        if (this.success) {
            this.alert_success = this.success;
            setTimeout(() => (this.alert_success = null), 5000);
        } else if (this.warning) {
            this.alert_warning = this.warning;
            console.log(this.alert_warning);
            setTimeout(
                () => (
                    (this.alert_warning = null), console.log(this.alert_warning)
                ),
                5000
            );
        } else if (this.danger) {
            this.alert_danger = this.danger;
            setTimeout(() => (this.alert_danger = null), 5000);
        }
    },
    mounted() {},
    setup(props,context) {
        const formtambah = useForm({
            nama: null,
            harga: null,
            diskon: null,
            keterangan: null,
            kategori: null,
            satuan: null,
            gambar: null,
        });
        function submittambah() {
            this.formtambah.post(route("masterproduk.store"));
            formtambah.nama = null;
            formtambah.harga = null;
            formtambah.diskon = null;
            formtambah.keterangan = null;
            formtambah.kategori = null;
            formtambah.satuan = null;
            formtambah.gambar = null;
        }
        const formedit = useForm({
            id: null,
            nama: null,
            harga: null,
            diskon: null,
            keterangan: null,
            kategori: null,
            satuan: null,
            gambar: null,
        });
        function submitedit() {
            Inertia.post(route("masterproduk.update",{produk:this.formedit.id}),{
                _method:'put',
                formedit,
            });
            formtambah.nama = null;
            formtambah.harga = null;
            formtambah.diskon = null;
            formtambah.keterangan = null;
            formtambah.kategori = null;
            formtambah.satuan = null;
            formtambah.gambar = null;
        }
        const formhapus = useForm({
            id: null,
            nama: null,
        });
        function submithapus() {
            this.formhapus.delete(
                route("masterproduk.destroy", { produk: this.formhapus.id })
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
        produk: Array,
        kategori: Array,
        satuan: Array,
        success: String,
        warning: String,
        danger: String,
        errors: Object,
    },
    methods: {
        edit(id) {
            Inertia.get(
                route("masterproduk.edit", {
                    produk: id,
                })
            );
        },
        edit(id) {
            var data;
            this.produk.filter((items) => {
                if (items.id == id) {
                    data = items;
                }
            });
            this.formedit.id = data.id;
            this.formedit.nama = data.nama;
            this.formedit.harga = data.harga;
            this.formedit.diskon = data.diskon;
            this.formedit.keterangan = data.keterangan;
            this.formedit.kategori = data.kategori;
            this.formedit.satuan = data.satuan;
        },
        hapus(id) {
            var data;
            this.produk.filter((items) => {
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
            return this.produk.filter((item) => {
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
