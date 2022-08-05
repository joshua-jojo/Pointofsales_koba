<template lang="">
    <div
        class="h-screen relative w-screen bg-gradient-to-br from-blue-600 via-cyan-400 to-cyan-500 p-2"
    >
        <div class="w-full h-full flex flex-col">
            <div
                class="h-13/20 w-full bg-cyan-50 mb-2 rounded-lg overflow-hidden flex flex-col"
            >
                <div
                    class="w-full bg-blue-400 h-3/20 flex flex-row items-center justify-center"
                >
                    <input
                        type="text"
                        v-model="search.value"
                        placeholder="Search.."
                        class="input input-bordered w-40"
                    />
                    <select
                        v-model="search.kategori"
                        @change="filteredItems"
                        class="select w-40 ml-3"
                    >
                        <option selected>All</option>
                        <option v-for="item in kategori">
                            {{ item.nama }}
                        </option>
                    </select>
                </div>
                <div
                    class="w-full h-17/20 overflow-hidden p-3 flex justify-center"
                >
                    <div
                        class="w-max h-full overflow-auto grid grid-cols-2 gap-3 scrollbar-hide"
                    >
                        <div
                            v-for="item in filteredItems"
                            @click="add(item.id)"
                            class="w-40 h-40 bg-red-200 rounded-xl relative overflow-hidden flex items-end"
                        >
                            <img
                                src="https://picsum.photos/200"
                                class="bg-cover z-0"
                            />
                            <div
                                class="absolute z-10 flex justify-center items-center h-2/6 w-full bg-white"
                            >
                                {{ item.nama }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form class="h-7/20 w-full" @submit.prevent="submit">
                <div
                    class="h-full w-full bg-blue-500 rounded-lg overflow-hidden flex flex-col"
                >
                    <div class="w-full h-4/20 flex justify-center items-center">
                        <button
                        type="submit"
                            class="btn bg-blue-600 text-white border-0 hover:bg-blue-700 font-semibold"
                        >
                            Pesan
                        </button>
                    </div>
                    <div class="w-full h-16/20 bg-blue-300 p-2 overflow-hidden">
                        <div class="h-full w-full overflow-auto scrollbar-hide">
                            <div
                                :id="'row' + items.id"
                                class="flex flex-row w-full py-3"
                                v-for="items in this.search.pesanan"
                            >
                                <div class="w-full text-center">
                                    {{ items.nama }}
                                     <input
                                        name="nama"
                                        hidden
                                        :value="items.nama"
                                        type="text"
                                    />
                                    <input
                                        name="kategori_produk"
                                        hidden
                                        :value="items.id_kategori"
                                        type="text"
                                    /><input
                                        name="id"
                                        hidden
                                        :value="items.id"
                                        type="text"
                                    />
                                </div>
                                <div class="w-full text-center">
                                    <input
                                        class="w-10 text-center"
                                        name="jumlah"
                                        required
                                        @input="cek(items.id)"
                                    />
                                </div>
                                <div class="w-full text-center">
                                    <input
                                        class="w-10 text-center"
                                        name="harga"
                                        :value="items.harga"
                                        hidden
                                    />
                                    {{ items.harga }}
                                </div>
                                <div class="w-full text-center">
                                    <input
                                        class="w-10 text-center"
                                        readonly
                                        name="total"
                                    />
                                </div>
                                <div class="w-full text-center">
                                    <button
                                        @click="hapus(items.id)"
                                        class="btn bg-blue-500 text-white border-0 hover:bg-blue-600 font-semibold"
                                    >
                                        hapus
                                    </button>
                                </div>
                            </div>
                            <div v-if="search.totalharga !=0" class="flex justify-center items-center font-semibold text-lg w-full py-3">
                                Total Rp. {{ search.totalharga
                                }}<input
                                    v-model="form.totalfinal"
                                    id="totalharga"
                                    :value="search.totalharga"
                                    hidden
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";

export default {
    props: {
        produk: Array,
        kategori: Array,
        id_pembelian: String,
    },
    mounted() {
        setInterval(() =>this.form.meja = this.meja, 3000);
        
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
        });
        const form = useForm({
            id: [],
            kategori: [],
            nama: [],
            jumlah: [],
            total: [],
            harga: [],
            totalfinal: null,
            namapemesan: null,
            meja: 0,
        });
        function submit() {
            console.log(id_penjualan);
            var total = 0;
            let jumlah = document.getElementsByName("jumlah");
            let jumlah_array = [];
            let kategori = document.getElementsByName("kategori_produk");
            let kategori_array = [];
            let harga = document.getElementsByName("harga");
            let harga_array = [];
            let total_value = document.getElementsByName("total");
            let total_value_array = [];
            let nama = document.getElementsByName("nama");
            let nama_array = [];
            let id = document.getElementsByName("id");
            let rows = document.getElementsByName("rows");
            let id_array = [];
            let totalharga = document.getElementById("totalharga");

            jumlah.forEach(function (item, index, arr) {
                harga_array.push(harga[index].value);
                id_array.push(id[index].value);
                jumlah_array.push(jumlah[index].value);
                total_value_array.push(total_value[index].value);
                nama_array.push(nama[index].value);
                kategori_array.push(kategori[index].value);
            });
            this.form.harga.push(harga_array);
            this.form.id.push(id_array);
            this.form.jumlah.push(jumlah_array);
            this.form.total.push(total_value_array);
            this.form.nama.push(nama_array);
            this.form.kategori.push(kategori_array);
            this.form.totalfinal = totalharga.value;
            Inertia.post(route("updatepesan",{ id: 1}), form);

            this.form.harga = [];
            this.form.harga = [];
            this.form.id = [];
            this.form.jumlah = [];
            this.form.total = [];
            this.form.nama = [];
            this.form.kategori = [];

            this.form.totalfinal = 0;
            this.search.totalharga = 0;
            this.form.namapemesan = null;
            this.form.meja = this.meja;

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
                    return (
                        item.nama
                            .toLowerCase()
                            .indexOf(this.search.value.toLowerCase()) > -1,
                        this.search.pesanan.push(item)
                    );
                }
            });
        },
        cek(id) {
            var total = 0;
            let jumlah = document.getElementsByName("jumlah");
            let harga = document.getElementsByName("harga");
            let harga_array = [];
            let total_value = document.getElementsByName("total");
            jumlah.forEach(function (item, index, arr) {
                var a = jumlah[index].value;
                var b = harga[index].value;

                if (jumlah[index].value == "") {
                    a = 0;
                }
                if (harga[index].value == "") {
                    b = 0;
                }

                total = total + a * b;
                total_value[index].value = a * b;
                harga_array.push(harga[index].value);
            });
            this.search.jumlah = total;
            this.search.nama = total;
            this.search.totalharga = total;
        },
        hapus(id) {
            document.getElementById("row" + id).remove();
            this.cek(id);
        },
    },
    computed: {
        getdata(data) {},
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
