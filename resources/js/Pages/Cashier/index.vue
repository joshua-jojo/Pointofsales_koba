<template lang="">
    <div
        class="h-screen relative w-screen bg-gradient-to-br from-blue-600 via-cyan-400 to-cyan-500"
    >
        <div
            class="flex flex-row w-full h-full animate-in fade-in zoom-in duration-1000"
        >
            <div class="w-13/20 h-full p-3">
                <div
                    class="w-full h-full rounded-xl flex flex-col overflow-hidden border-2"
                >
                    <div
                        class="w-full h-2/20 bg-blue-400 flex items-center px-4"
                    >
                        <input
                            v-model="search.value"
                            type="text"
                            placeholder="Search.."
                            class="input input-bordered w-56"
                        />
                        <select
                            @change="filteredItems"
                            class="select w-40 ml-3"
                            v-model="search.kategori"
                        >
                            <option selected>All</option>
                            <option v-for="item in kategori">
                                {{ item.nama }}
                            </option>
                        </select>
                        <div
                            class="w-full h-full flex justify-end items-center"
                        >
                            <div class="indicator relative">
                                <span
                                    v-if="transaksi_api"
                                    class="indicator-item animate-in fade-in zoom-in duration-300 border-0 z-20 indicator-middle indicator-start badge bg-red-600 text-white"
                                    >{{ transaksi_api }}</span
                                >
                                <Link :href="route('cashiertransaksi.index')">
                                    <button
                                        class="btn bg-blue-600 border-0 text-white font-semibold hover:bg-blue-700"
                                    >
                                        Transaksi
                                    </button>
                                </Link>
                            </div>
                        </div>
                    </div>
                    <div
                        class="w-full h-18/20 bg-cyan-100 flex justify-center item-center"
                    >
                        <div
                            v-if="filteredItems.length <= 8"
                            class="w-max h-max p-3 grid grid-cols-4 gap-3 overflow-auto scrollbar-hide"
                        >
                            <div
                                v-for="item in filteredItems"
                                @click="add(item.id)"
                                class="bg-black w-40 h-40 flex border-2 items-end rounded-xl overflow-hidden relative"
                            >
                                <img
                                    src="https://picsum.photos/200"
                                    class="bg-cover absolute z-0"
                                />
                                <div
                                    class="absolute z-10 flex justify-center items-center h-5/20 w-full bg-white"
                                >
                                    {{ item.nama }}
                                </div>
                            </div>
                        </div>
                        <div
                            v-if="filteredItems.length > 8"
                            class="w-max h-auto p-3 grid grid-cols-4 gap-3 overflow-auto scrollbar-hide"
                        >
                            <div
                                v-for="item in filteredItems"
                                @click="add(item.id)"
                                class="bg-black w-40 h-40 flex border-2 items-end rounded-xl overflow-hidden relative"
                            >
                                <img
                                    src="https://picsum.photos/200"
                                    class="bg-cover absolute z-0"
                                />
                                <div
                                    class="absolute z-10 flex justify-center items-center h-5/20 w-full bg-white"
                                >
                                    {{ item.nama }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-7/20 h-full py-3 pr-3">
                <div
                    class="w-full h-full bg-cyan-100 rounded-xl flex flex-col overflow-hidden border-2"
                >
                    <div
                        class="w-full h-2/20 bg-blue-400 flex justify-center items-center capitalize font-semibold text-2xl text-white"
                    >
                        Daftar Pesanan
                    </div>
                    <form @submit.prevent="submit" class="w-full h-18/20">
                        <div
                            class="w-full h-3/20 flex items-center flex-row border-b-4 border-blue-600"
                        >
                            <select
                                required
                                class="select w-32 ml-3"
                                v-model="form.meja"
                            >
                                <option selected>Pilih Meja</option>
                                <option :value="item.id" v-for="item in meja">
                                    {{ item.nama }}
                                </option>
                            </select>
                            <input
                                required
                                v-model="form.namapemesan"
                                type="text"
                                placeholder="Nama Pemesan.."
                                class="input input-bordered w-44 ml-1"
                            />
                            <div class="flex justify-end w-full pr-3">
                                <button
                                    v-if="
                                        search.jumlah == 0 ||
                                        search.nama == 0 ||
                                        form.namapemesan == '' ||
                                        form.namapemesan == null ||
                                        form.meja == null ||
                                        form.meja == 'Pilih Meja'
                                    "
                                    type="submit"
                                    class="btn bg-blue-400 btn-disabled text-white font-semibold"
                                >
                                    Pesan
                                </button>
                                <button
                                    v-else-if="
                                        form.namapemesan != null &&
                                        form.meja != null
                                    "
                                    type="submit"
                                    class="btn bg-blue-500 text-white border-0 hover:bg-blue-600"
                                >
                                    Pesan
                                </button>
                            </div>
                        </div>
                        <div class="w-full h-1/20 px-1">
                            <div
                                class="w-full h-max my-1 flex flex-row border-b-2 border-blue-400"
                            >
                                <div
                                    class="w-full flex justify-start items-center"
                                >
                                    Nama
                                </div>
                                <div
                                    class="w-full flex justify-center items-center"
                                >
                                    Jumlah
                                </div>
                                <div
                                    class="w-full flex justify-center items-center"
                                >
                                    Harga
                                </div>
                                <div
                                    class="w-full flex justify-center items-center"
                                >
                                    Total
                                </div>
                                <div
                                    class="w-full flex justify-center items-center"
                                >
                                    Opsi
                                </div>
                            </div>
                        </div>
                        <div
                            class="w-full h-14/20 px-1 overflow-auto scrollbar-hide"
                        >
                            <div
                                v-for="items in this.search.pesanan"
                                :id="'row' + items.id"
                                name="rows"
                                class="w-full my-1 flex flex-row border-b-2"
                            >
                                <div
                                    class="w-full flex justify-start items-center"
                                >
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
                                <div
                                    class="w-full flex justify-center items-center"
                                >
                                    <input
                                        required
                                        class="w-12 rounded text-center"
                                        name="jumlah"
                                        min="1"
                                        type="number"
                                        :id="items.id"
                                        @input="cek(items.id)"
                                    />
                                </div>
                                <div
                                    class="w-full flex justify-center items-center"
                                >
                                    {{ items.harga }}
                                    <input
                                        :value="items.harga"
                                        name="harga"
                                        hidden
                                        :id="'harga' + items.id"
                                    />
                                </div>
                                <div
                                    class="w-full flex justify-center items-center"
                                >
                                    <input name="total" class="w-20" readonly />
                                </div>
                                <div
                                    class="w-full flex justify-center items-center"
                                >
                                    <div
                                        @click="hapus(items.id)"
                                        class="w-full p-2 h-full bg-blue-500 text-white text-center font-semibold rounded-lg"
                                    >
                                        Hapus
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="w-full h-2/20 flex justify-center items-center font-semibold bg-blue-500 text-white text-2xl"
                        >
                            Rp. {{ search.totalharga
                            }}<input
                                v-model="form.totalfinal"
                                id="totalharga"
                                hidden
                            />
                        </div>
                    </form>
                </div>
            </div>
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
            meja: "Pilih Meja",
        });
        function submit() {
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
            Inertia.post(route("cashier.store"), form);

            this.form.harga = [];
            this.form.id = [];
            this.form.jumlah = [];
            this.form.total = [];
            this.form.nama = [];
            this.form.kategori = [];

            this.form.totalfinal = 0;
            this.search.totalharga = 0;
            this.form.namapemesan = null;
            this.form.meja = "Pilih Meja";

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
            this.form.totalfinal = total;
            this.search.totalharga = total;
        },
        hapus(id) {
            document.getElementById("row" + id).remove();
            this.cek(id);
        },
    },
    data() {
        return {
            transaksi_api: 0,
        };
    },
    mounted() {
        setInterval(
            () =>
                axios.get(route("apipemesanan")).then((response) => {
                    this.transaksi_api = response.data.data;
                }),
            5000
        );
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
