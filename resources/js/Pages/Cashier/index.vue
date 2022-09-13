<template lang="">
    <div class="h-screen w-full p-2 bg-slate-200">
        <div class="h-full w-full flex flex-row gap-2">
            <div class="w-2/3 h-full min-h-full flex flex-col gap-1">
                <div class="h-2/20 overflow-hidden items-center flex py-1">
                    <input
                        v-model="this.search.value"
                        type="text"
                        placeholder="Cari..."
                        class="input input-bordered w-full input-sm"
                    />
                </div>
                <div
                    class="h-18/20 flex flex-col bg-white rounded-2xl border-2"
                >
                    <div
                        class="h-2/20 flex flex-row items-center border-b-2 justify-between p-3"
                    >
                        <div class="flex-row flex gap-2">
                            <article class="prose prose-sm">
                                <h2>Kategori</h2>
                            </article>
                            <select
                                class="select select-sm select-bordered w-32"
                            >
                                <option value="">All</option>
                                <option
                                    v-for="item in kategori"
                                    :value="item.nama"
                                >
                                    {{ item.nama }}
                                </option>
                            </select>
                        </div>
                        <div class="">
                            <div
                                class="indicator"
                                v-if="this.transaksi_api"
                                @click="
                                    this.transaksi_show = !this.transaksi_show
                                "
                            >
                                <span
                                    class="indicator-item z-10 indicator-start badge badge-error"
                                    >{{ this.transaksi_api }}</span
                                >
                                <button class="btn btn-info btn-sm">
                                    Transaksi
                                </button>
                            </div>
                            <div class="indicator" v-else>
                                <button class="btn btn-info btn-sm">
                                    Transaksi
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                        class="h-18/20 p-2 overflow-auto justify-center flex scrollbar-hide"
                    >
                        <div class="w-max h-max grid grid-cols-4 gap-2">
                            <div
                                class="w-44 h-max border shadow rounded-lg p-1 flex flex-col gap-2"
                                v-for="(item, index) in filteredItems"
                                :key="index"
                            >
                                <img
                                    :src="item.gambar"
                                    alt=""
                                    srcset=""
                                    class="rounded-lg"
                                />
                                <div class="w-full">
                                    <article
                                        class="prose text-center prose-sm w-full break-words flex-col capitalize"
                                    >
                                        <h4>
                                            {{ item.nama }}
                                        </h4>
                                        <h5>rp {{ item.harga }}</h5>
                                    </article>
                                </div>
                                <div class="w-full flex-row flex">
                                    <button
                                        @click="add(item.id)"
                                        class="btn btn-sm w-1/2 btn-success rounded-l-lg rounded-r-none"
                                    >
                                        Tambah
                                    </button>
                                    <div class="w-1/2 bg-info rounded-r-lg">
                                        <modalVue :produk="item" :id="item.id">
                                            <template v-slot:action>
                                                <label
                                                    class="btn btn-success"
                                                    @click="add(item.id)"
                                                    >Tambah</label
                                                >
                                            </template>
                                        </modalVue>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="shadow bg-white rounded-lg w-1/3 min-h-full flex flex-col"
            >
                <div
                    class="h-2/20 border flex justify-between items-center p-1"
                >
                    <div class="">
                        <select
                            class="select select-bordered select-sm"
                            name=""
                            id=""
                            v-model="this.form.meja"
                        >
                            <option value="">Pilih Meja</option>
                            <option v-for="item in meja" :value="item.id">
                                {{ item.nama }}
                            </option>
                        </select>
                    </div>
                    <div class="">
                        <input
                            v-model="this.form.namapemesan"
                            type="text"
                            class="input input-bordered input-sm text-center w-32"
                            placeholder="Nama pemesan..."
                        />
                    </div>
                    <div class="">
                        <button
                            :disabled="
                                this.form.namapemesan == '' ||
                                this.form.meja == '' ||
                                this.search.pesanan.length == 0
                            "
                            @click="submit"
                            class="btn btn-sm btn-info"
                        >
                            Pesan
                        </button>
                    </div>
                </div>
                <div class="h-full overflow-auto scrollbar-hide">
                    <div
                        v-if="this.transaksi_show"
                        v-for="item in this.transaksi"
                        tabindex="0"
                        class="collapse collapse-arrow border border-base-300 bg-base-100 animate-in fade-in-0 duration-75"
                    >
                        <input type="checkbox" />
                        <div class="collapse-title text-xl font-medium">
                            {{ item.nama }}
                        </div>
                        <div class="collapse-content flex flex-col gap-2">
                            <div class="overflow-x-auto border">
                                <table class="table table-zebra table-compact w-full">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Produk</th>
                                            <th >jumlah</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- row 1 -->
                                        <tr v-for="data in item.produk">
                                            <td>{{data.nama}}</td>
                                            <td class="text-center">{{data.jumlah}}</td>
                                            <td class="text-center">Rp. {{data.harga}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="overflow-x-auto border">
                                <table class="table table-zebra table-compact w-full">
                                    <tbody>
                                        <!-- row 1 -->
                                        <tr>
                                            <td>total</td>
                                            <td>Rp {{item.total}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div
                        class="collapse border collapse-arrow"
                        v-for="item in this.search.pesanan"
                        v-else
                    >
                        <input type="checkbox" />
                        <div
                            class="collapse-title text-xl font-medium flex flex-row gap-2"
                        >
                            <div class="h-10">
                                <img
                                    :src="item.gambar"
                                    alt=""
                                    srcset=""
                                    class="rounded-lg h-full"
                                />
                            </div>
                            <div class="flex items-center">
                                <article class="prose">
                                    <h4>{{ item.nama }}</h4>
                                </article>
                            </div>
                        </div>
                        <div class="collapse-content">
                            <article class="prose">
                                <div class="grid grid-cols-2 w-1/2 gap-4">
                                    <h5>Harga</h5>
                                    <h5>Rp {{ item.harga }}</h5>
                                </div>
                                <div class="grid grid-cols-2 w-1/2 gap-4">
                                    <h5>Jumlah</h5>
                                    <h5>
                                        {{ item.jumlah }} {{ item.satuan.nama }}
                                    </h5>
                                </div>
                                <div class="grid grid-cols-2 w-1/2 gap-4">
                                    <h5>Total</h5>
                                    <h5>Rp {{ item.total }}</h5>
                                </div>
                                <div class="">
                                    <textarea
                                        class="textarea textarea-bordered w-full"
                                        placeholder="keterangan"
                                        :id="'keterangan' + item.id"
                                    ></textarea>
                                </div>
                                <div class="grid grid-cols-3 w-full gap-4">
                                    <button
                                        @click="tambah(item.id)"
                                        class="btn btn-sm btn-success"
                                    >
                                        +
                                    </button>
                                    <button
                                        @click="kurang(item.id)"
                                        class="btn btn-sm btn-info"
                                    >
                                        -
                                    </button>
                                    <button
                                        @click="hapus(item.id)"
                                        class="btn btn-sm btn-error"
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
                <div class="h-2/20 border flex items-center justify-center" v-if="!this.transaksi_show">
                    <article
                        class="prose capitalize text-center"
                        
                    >
                        <h2>rp {{ this.search.totalhargaitem }}</h2>
                    </article>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";
import modalVue from "./modal.vue";

export default {
    components: {
        modalVue,
    },
    props: {
        produk: Array,
        kategori: Array,
        meja: Array,
    },
    setup() {
        const search = reactive({
            value: "",
            kategori: "All",
            meja: "Pilih Meja",
            nama: 0,
            jumlah: 0,
            pesanan: [],
            totalharga: 0,
            totalhargaitem: 0,
        });

        const form = useForm({
            id: [],
            kategori: [],
            nama: [],
            jumlah: [],
            total: [],
            harga: [],
            totalfinal: null,
            namapemesan: "",
            meja: "",
        });

        function submit() {
            var harga_array = [];
            var id_array = [];
            var jumlah_array = [];
            var total_value_array = [];
            var kategori_array = [];
            var nama_array = [];
            var harga_array = [];
            var keterangan_array = [];
            var totalfinal = 0;
            this.search.pesanan.forEach((item, index) => {
                var keterangan = document.getElementById(
                    "keterangan" + item.id
                ).value;

                harga_array.push(item.harga);
                id_array.push(item.id);
                jumlah_array.push(item.jumlah);
                total_value_array.push(item.total);
                kategori_array.push(item.kategori);
                nama_array.push(item.nama);
                keterangan_array.push(keterangan);
                totalfinal = totalfinal + item.total;
            });
            this.form.harga.push(harga_array);
            this.form.id.push(id_array);
            this.form.jumlah.push(jumlah_array);
            this.form.total.push(total_value_array);
            this.form.nama.push(nama_array);
            this.form.kategori.push(kategori_array);
            this.form.keterangan = keterangan_array;
            this.form.totalfinal = totalfinal;
            Inertia.post(route("cashier.store"), form);
            this.form.harga = [];
            this.form.id = [];
            this.form.jumlah = [];
            this.form.total = [];
            this.form.nama = [];
            this.form.kategori = [];
            this.form.keterangan = [];

            this.form.totalfinal = 0;
            this.search.totalharga = 0;
            this.search.totalhargaitem = 0;
            this.form.namapemesan = null;
            this.form.meja = "";

            this.search.pesanan = [];
        }
        return {
            submit,
            form,
            search,
        };
    },
    methods: {
        add(id) {
            this.search.nama = id;
            return this.produk.filter((item) => {
                if (item.id == id) {
                    if (this.search.pesanan.length < 1) {
                        item["jumlah"] = 1;
                        item["total"] = item.harga;
                        this.search.pesanan.push(item);
                    } else {
                        var no = 0;
                        this.search.pesanan.forEach((element) => {
                            if (element.id == item.id) {
                                no++;
                            }
                        });
                        if (no < 1) {
                            item["jumlah"] = 1;
                            item["total"] = item.harga;
                            this.search.pesanan.push(item);
                        }
                    }
                }
                this.cek();
            });
        },
        cek() {
            this.transaksi_show = false;
            var total = 0;
            this.search.pesanan.forEach((element) => {
                total += element.total;
            });
            this.search.totalhargaitem = total;
            this.search.ceksubmit = this.search.pesanan.length;
        },
        hapus(id) {
            var set = [];
            this.search.pesanan.filter((data) => {
                if (data.id != id) {
                    set.push(data);
                } else {
                }
            });
            // document.getElementById("row" + id).remove();
            console.log();
            this.search.pesanan = set;
            this.cek();
        },
        tambah(id) {
            this.search.pesanan.forEach((items, index) => {
                if (items.id == id) {
                    items.jumlah++;
                    items.total = items.jumlah * items.harga;
                    this.search.pesanan[index] = items;
                }
            });
            this.cek();
        },
        kurang(id) {
            this.search.pesanan.forEach((items, index) => {
                if (items.id == id) {
                    items.jumlah--;
                    if (items.jumlah <= 1) {
                        items.jumlah = 1;
                        items.total = items.jumlah * items.harga;
                        this.search.pesanan[index] = items;
                    } else {
                        items.total = items.jumlah * items.harga;
                        this.search.pesanan[index] = items;
                    }
                }
            });
            this.cek();
        },
    },
    data() {
        return {
            transaksi_api: 0,
            transaksi_show: false,
            transaksi: [],
        };
    },
    mounted() {
        setInterval(
            () =>
                axios.get(route("apipemesanan")).then((response) => {
                    this.transaksi_api = response.data.data.jumlah;
                    this.transaksi = response.data.data.data;
                }),
            5000
        );
    },
    computed: {
        filteredItems() {
            if (this.search.kategori == "All") {
                return this.produk.filter((item) => {
                    return (
                        item.nama
                            .toLowerCase()
                            .indexOf(this.search.value.toLowerCase()) > -1
                    );
                });
            } else {
                return this.produk.filter((item) => {
                    if (item.id_kategori == this.search.kategori) {
                        return (
                            item.nama
                                .toLowerCase()
                                .indexOf(this.search.value.toLowerCase()) > -1
                        );
                    }
                });
            }
        },
    },
};
</script>
<style lang=""></style>
