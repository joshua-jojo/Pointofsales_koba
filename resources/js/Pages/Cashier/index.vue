<template lang="">
    <div class="h-screen relative w-screen bg-gradient-to-br from-blue-600 via-cyan-400 to-cyan-500">
        <div class="flex flex-row w-full h-full " data-aos="zoom-in" data-aos-duration="1000">
            <div class="w-13/20 h-full p-3">
                <div class="w-full h-full rounded-xl flex flex-col overflow-hidden border-2">
                    <div class="w-full h-2/20 bg-blue-400 flex items-center px-4">
                        <input v-model="search.value" type="text" placeholder="Search.."
                            class="input input-bordered w-56" />
                        <select @change="filteredItems" class="select w-40 ml-3" v-model="search.kategori">
                            <option selected>All</option>
                            <option v-for="item in kategori">
                                {{ item.nama }}
                            </option>
                        </select>
                        <div class="w-full h-full flex justify-end items-center">
                            <div class="indicator relative grid grid-cols-1 w-max gap-3">
                                <span v-if="transaksi_api"
                                    class="indicator-item animate-in fade-in zoom-in duration-300 border-0 z-20 indicator-middle indicator-start badge bg-red-600 text-white">{{ transaksi_api }}</span>
                                <Link :href="route('cashiertransaksi.index')">
                                <button class="btn bg-blue-600 border-0 text-white font-semibold hover:bg-blue-700">
                                    Transaksi
                                </button>
                                </Link>
                                <!-- <Link :href="route('cashiertransaksi.index')">
                                <button class="btn bg-blue-600 border-0 text-white font-semibold hover:bg-blue-700">
                                    Takeaway
                                </button>
                                </Link> -->
                            </div>
                        </div>
                    </div>
                    <div class="w-full h-18/20 bg-cyan-100 flex justify-center item-center">
                        <div v-if="filteredItems.length <= 8"
                            class="w-max h-max p-3 grid grid-cols-4 gap-3 overflow-auto scrollbar-hide">
                            <div v-for="item in filteredItems" @click="add(item.id)"
                                class="bg-black w-40 h-40 flex border-2 items-end rounded-xl overflow-hidden relative">
                                <img :src="item.gambar" class="bg-cover absolute z-0" />
                                <div class="absolute z-10 flex justify-center items-center h-5/20 w-full bg-white">
                                    {{ item.nama }}
                                </div>
                            </div>
                        </div>
                        <div v-if="filteredItems.length > 8"
                            class="w-max h-auto p-3 grid grid-cols-4 gap-3 overflow-auto scrollbar-hide">
                            <div v-for="item in filteredItems" @click="add(item.id)"
                                class="bg-black w-40 h-40 flex border-2 items-end rounded-xl overflow-hidden relative">
                                <img :src="item.gambar" class="bg-cover absolute z-0" />
                                <div class="absolute z-10 flex justify-center items-center h-5/20 w-full bg-white">
                                    {{ item.nama }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-7/20 h-full py-3 pr-3">
                <div class="w-full h-full bg-cyan-100 rounded-xl flex flex-col overflow-hidden border-2">
                    <div
                        class="w-full h-2/20 bg-blue-400 flex justify-center items-center capitalize font-semibold text-2xl text-white">
                        Daftar Pesanan
                    </div>
                    <form @submit.prevent="submit" class="w-full h-18/20">
                        <div class="w-full h-3/20 flex items-center flex-row border-b-4 border-blue-600">
                            <select required class="select w-32 ml-3" v-model="form.meja">
                                <option value="0" selected>Pilih Meja</option>
                                <option :value="item.id" v-for="item in meja">
                                    {{ item.nama }}
                                </option>
                            </select>
                            <input required v-model="form.namapemesan" type="text" placeholder="Nama Pemesan.."
                                class="input input-bordered w-44 ml-1" />
                            <div class="flex justify-end w-full pr-3">
                                <button
                                    v-if="search.totalhargaitem < 1 || form.namapemesan == null || form.namapemesan == '' || form.meja == '0'"
                                    type="submit" class="btn bg-blue-400 btn-disabled text-white font-semibold">
                                    Pesan
                                </button>
                                <button v-else-if="
                                        form.namapemesan != null &&
                                        form.meja != null
                                    " type="submit" class="btn bg-blue-500 text-white border-0 hover:bg-blue-600">
                                    Pesan
                                </button>
                            </div>
                        </div>
                        <div class="w-full h-1/20 px-1">
                            <div class="w-full h-max my-1 flex flex-row border-b-2 border-blue-400">
                                <div class="w-full flex justify-start items-center">
                                    Nama
                                </div>
                                <div class="w-full flex justify-center items-center">
                                    Jumlah
                                </div>
                                <div class="w-full flex justify-center items-center">
                                    Harga
                                </div>
                                <div class="w-full flex justify-center items-center">
                                    Total
                                </div>
                                <div class="w-full flex justify-center items-center">
                                    Opsi
                                </div>
                            </div>
                        </div>
                        <div class="w-full h-14/20 px-1 overflow-auto scrollbar-hide">
                            <div v-for="items in this.search.pesanan" :id="'row' + items.id" name="rows"
                                class="w-full my-1 flex flex-row border-b-2">
                                <div class="grid grid-cols-5 w-full">
                                    <div class="w-full flex justify-start items-center">
                                        {{ items.nama }}
                                    </div>
                                    <div class="w-full flex justify-center items-center">
                                        {{items.jumlah}}
                                    </div>
                                    <div class="w-full flex justify-center items-center">
                                        Rp. {{ items.harga }}
                                    </div>
                                    <div class="w-full flex justify-center items-center">
                                        Rp. {{items.total}}
                                    </div>
                                    <div class="w-full grid grid-cols-2 gap-1 text-center">
                                        <button @click="tambah(items.id)" type="button"
                                            class="btn btn-sm bg-green-500 text-white border-0 hover:bg-green-600 font-semibold w-full">
                                            +
                                        </button>
                                        <button @click="kurang(items.id)" type="button"
                                            class="btn btn-sm bg-yellow-500 text-white border-0 hover:bg-yellow-600 font-semibold w-full">
                                            -
                                        </button>
                                        <button type="button" @click="hapus(items.id)"
                                            class="btn btn-sm col-span-2 bg-blue-500 text-white border-0 hover:bg-blue-600 font-semibold">
                                            hapus
                                        </button>
                                    </div>
                                    <div class="col-span-5 p-1"> <textarea class="textarea w-full textarea-bordered"
                                            name="keterangan" :id="'keterangan' + items.id"
                                            placeholder="Keterangan.."></textarea></div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="w-full h-2/20 flex justify-center items-center font-semibold bg-blue-500 text-white text-2xl">
                            Total Rp. {{ search.totalhargaitem }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {
        Inertia
    } from "@inertiajs/inertia";
    import {
        useForm
    } from "@inertiajs/inertia-vue3";
    import {
        reactive
    } from "vue";

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
                namapemesan: null,
                meja: 0,
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
                this.form.meja = 0;

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
                var total = 0;
                this.search.pesanan.forEach((element) => {
                    total += element.total;
                });
                this.search.totalhargaitem = total
                this.search.ceksubmit = this.search.pesanan.length;
            },
            hapus(id) {
                var set = [];
                this.search.pesanan.filter((data) => {
                    if (data.id != id) {
                        set.push(data);
                    } else {}
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
