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
            <div class="toast toast-start">
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
        <template v-slot:modals>
            <div class="modal" id="modal-tambah">
                <div class="modal-box scrollbar-hide">
                    <h2 class="font-bold text-lg">Tambah Inventory</h2>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama</span>
                        </label>
                        <input
                            v-model="forminventorytambah.nama"
                            type="text"
                            placeholder="Nama..."
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
                            v-model="forminventorytambah.harga"
                            type="text"
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
                            <span class="label-text">Satuan</span>
                        </label>
                        <select
                            v-model="forminventorytambah.satuan"
                            class="select select-bordered w-full"
                        >
                            <option
                                v-for="(item, index) in satuan"
                                :key="index"
                                :value="item.id"
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
                    <div class="modal-action">
                        <a
                            class="btn bg-green-500 hover:bg-green-400 text-white border-0"
                            @click="submitinventorytambah"
                            >Save</a
                        >
                        <a href="#" class="btn">Exit</a>
                    </div>
                    <a href="#" hidden id="submit"></a>
                </div>
            </div>
            <div class="modal" id="modal-edit">
                <div class="modal-box scrollbar-hide">
                    <h2 class="font-bold text-lg">Edit Inventory</h2>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama</span>
                        </label>
                        <input
                            v-model="forminventoryedit.nama"
                            readonly
                            type="text"
                            placeholder="Nama..."
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
                            v-model="forminventoryedit.harga"
                            type="text"
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
                            <span class="label-text">Satuan</span>
                        </label>
                        <select
                            v-model="forminventoryedit.satuan"
                            class="select select-bordered w-full"
                        >
                            <option
                                v-for="(item, index) in satuan"
                                :key="index"
                                :value="item.id"
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
                    <div class="modal-action">
                        <a
                            class="btn bg-green-500 hover:bg-green-400 text-white border-0"
                            @click="submitinventoryedit"
                            >Save</a
                        >
                        <a href="#" class="btn">Exit</a>
                    </div>
                    <a href="#" hidden id="submit"></a>
                </div>
            </div>

            <div class="modal" id="modal-hapus">
                <div class="modal-box scrollbar-hide">
                    <h2 class="font-bold text-lg">
                        Konfirmasi penghapusan {{ forminventoryhapus.nama }}
                    </h2>
                    <div class="modal-action">
                        <a
                            class="btn bg-red-500 hover:bg-red-400 text-white border-0"
                            @click="submitinventoryhapus"
                            >Delete</a
                        >
                        <a href="#" class="btn">Exit</a>
                    </div>
                    <a href="#" hidden id="submit"></a>
                </div>
            </div>
            <div class="modal" id="modal-pemasukkan">
                <div class="modal-box scrollbar-hide">
                    <h2 class="font-bold text-lg">Pemasukkan Inventory</h2>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama</span>
                        </label>
                        <select
                            v-model="formpemasukkan.id"
                            class="select select-bordered w-full"
                        >
                            <option
                                v-for="(item, index) in inventory"
                                :key="index"
                                :value="item.id"
                            >
                                {{ item.nama }}
                            </option>
                        </select>
                        <span
                            v-if="errors.id"
                            class="label-text text-red-500"
                            >{{ errors.id }}</span
                        >
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Jumlah</span>
                        </label>
                        <input
                            v-model="formpemasukkan.jumlah"
                            type="text"
                            placeholder="jumlah..."
                            class="input input-bordered"
                        />
                        <span
                            v-if="errors.jumlah"
                            class="label-text text-red-500"
                            >{{ errors.jumlah }}</span
                        >
                    </div>

                    <div class="modal-action">
                        <a
                            class="btn bg-green-500 hover:bg-green-400 text-white border-0"
                            @click="submitpemasukkan"
                            >Save</a
                        >
                        <a href="#" class="btn">Exit</a>
                    </div>
                    <a href="#" hidden id="submit"></a>
                </div>
            </div>
            <div class="modal" id="modal-pengeluaran">
                <div class="modal-box scrollbar-hide">
                    <h2 class="font-bold text-lg">Pengeluaran Inventory</h2>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama</span>
                        </label>
                        <select
                            v-model="formpengeluaran.id"
                            class="select select-bordered w-full"
                        >
                            <option
                                v-for="(item, index) in inventory"
                                :key="index"
                                :value="item.id"
                            >
                                {{ item.nama }}
                            </option>
                        </select>
                        <span
                            v-if="errors.id"
                            class="label-text text-red-500"
                            >{{ errors.id }}</span
                        >
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Jumlah</span>
                        </label>
                        <input
                            v-model="formpengeluaran.jumlah"
                            type="text"
                            placeholder="jumlah..."
                            class="input input-bordered"
                        />
                        <span
                            v-if="errors.jumlah"
                            class="label-text text-red-500"
                            >{{ errors.jumlah }}</span
                        >
                    </div>

                    <div class="modal-action">
                        <a
                            class="btn bg-green-500 hover:bg-green-400 text-white border-0"
                            @click="submitpengeluaran"
                            >Save</a
                        >
                        <a href="#" class="btn">Exit</a>
                    </div>
                    <a href="#" hidden id="submit"></a>
                </div>
            </div>
        </template>

        <template v-slot:opsibutton>
            <div class="flex justify-end w-full">
                <a href="#modal-tambah">
                    <div
                        class="flex justify-center mr-3 items-center modal-button w-24 bg-green-500 hover:bg-green-400 capitalize h-8 rounded-lg"
                    >
                        <i class="fa-solid fa-plus pr-2"></i>tambah
                    </div>
                </a>
                <a href="#modal-pemasukkan">
                    <div
                        class="flex justify-center mr-3 items-center modal-button w-32 bg-blue-500 hover:bg-blue-400 capitalize h-8 rounded-lg"
                    >
                        <i class="fa-solid fa-plus pr-2"></i>pemasukkan
                    </div>
                </a>
                <a href="#modal-pengeluaran">
                    <div
                        class="flex justify-center items-center modal-button w-32 bg-red-500 hover:bg-red-400 capitalize h-8 rounded-lg"
                    >
                        <i class="fa-solid fa-plus pr-2"></i>pengeluaran
                    </div>
                </a>
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
                                <a
                                    href="#modal-edit"
                                    @click="edit(data.id)"
                                    class="flex justify-center items-center modal-button w-24 bg-blue-500 hover:bg-blue-400 capitalize h-8 rounded-lg mr-2"
                                >
                                    <i
                                        class="fa-solid fa-pen-to-square pr-2"
                                    ></i
                                    >edit
                                </a>
                                <a
                                    href="#modal-hapus"
                                    @click="hapus(data.id)"
                                    class="flex justify-center items-center modal-button w-24 bg-red-500 hover:bg-red-400 capitalize h-8 rounded-lg"
                                >
                                    <i class="fa-solid fa-trash pr-2"></i>hapus
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
import route from "../../../../vendor/tightenco/ziggy/src/js";
import blankVue from "../Template/blank.vue";

export default {
    components: {
        blankVue,
    },
    props: {
        satuan: Array,
        inventory: Array,
        flash: Object,
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
        if (this.flash.alert) {
            if (this.flash.alert["type"] == "success") {
                this.alert_success = this.flash.alert["message"];
                setTimeout(() => (this.alert_success = null), 5000);
            }
            if (this.flash.alert["type"] == "warning") {
                this.alert_warning = this.flash.alert["message"];
                setTimeout(() => (this.alert_warning = null), 5000);
            }
            if (this.flash.alert["type"] == "danger") {
                this.alert_danger = this.flash.alert["message"];
                setTimeout(() => (this.alert_danger = null), 5000);
            }
        }
    },
    setup() {
        function klik() {
            document.getElementById("submit").click();
        }
        const forminventorytambah = useForm({
            nama: null,
            harga: null,
            satuan: null,
        });
        function submitinventorytambah() {
            forminventorytambah.post(route("warehouseinventory.store"), {
                onSuccess: () => {
                    forminventorytambah.reset(), klik();
                },
            });
        }
        const forminventoryedit = useForm({
            id: null,
            nama: null,
            harga: null,
            satuan: null,
        });
        function submitinventoryedit() {
            forminventoryedit.put(
                route("warehouseinventory.update", {
                    inventory: forminventoryedit.id,
                }),
                {
                    onSuccess: () => {
                        forminventoryedit.reset(), klik();
                    },
                }
            );
        }
        const forminventoryhapus = useForm({
            id: null,
            nama: null,
        });
        function submitinventoryhapus() {
            forminventoryhapus.delete(
                route("warehouseinventory.destroy", {
                    inventory: forminventoryhapus.id,
                }),
                {
                    onSuccess: () => {
                        forminventoryhapus.reset(), klik();
                    },
                }
            );
        }
        const formpemasukkan = useForm({
            id: null,
            jumlah: 1,
            type: "pemasukkan",
        });
        function submitpemasukkan() {
            formpemasukkan.post(route("warehouseinventorytransaksi.store"),{
                onSuccess:()=>{
                    formpemasukkan.reset();klik();
                }
            });
        }
        const formpengeluaran = useForm({
            id: null,
            jumlah: 1,
            type: "pengeluaran",
        });
        function submitpengeluaran() {
            formpengeluaran.post(route("warehouseinventorytransaksi.store"),{
                onSuccess:()=>{
                    formpengeluaran.reset();klik();
                }
            });
        }
        const search = reactive({
            value: "",
        });
        return {
            forminventorytambah,
            submitinventorytambah,
            forminventoryedit,
            submitinventoryedit,
            forminventoryhapus,
            submitinventoryhapus,
            formpemasukkan,
            submitpemasukkan,
            formpengeluaran,
            submitpengeluaran,
            search,
        };
    },
    methods: {
        edit(id) {
            var data;
            this.inventory.filter((items) => {
                if (items.id == id) {
                    data = items;
                }
            });
            this.forminventoryedit.id = data.id;
            this.forminventoryedit.nama = data.nama;
            this.forminventoryedit.harga = data.harga;
            var satuan;
            this.satuan.filter((items) => {
                if (data.satuan == items.nama) {
                    satuan = items;
                }
            });
            this.forminventoryedit.satuan = satuan.id;
        },
        hapus(id) {
            var data;
            this.inventory.filter((items) => {
                if (items.id == id) {
                    data = items;
                }
            });
            this.forminventoryhapus.id = data.id;
            this.forminventoryhapus.nama = data.nama;
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
