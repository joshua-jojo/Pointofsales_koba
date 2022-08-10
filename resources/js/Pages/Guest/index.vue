<template lang="">
    <!-- <div v-if="search.validasi.length > 0"
        class="absolute z-20 w-screen h-screen bg-gray-500 bg-opacity-50 flex justify-center items-center">
        <div v-for="(item, index) in search.validasi[0].nama.length" :key="index"
            class="w-18/20 h-max bg-white p-2 grid grid-rows-1 rounded-xl animate-in zoom-in duration-300">
            <div class="border-b-2 h-max p-2 capitalize">{{ search.validasi[0].nama[index] }}</div>
        </div>
    </div> -->
    <div v-if="search.validasi.length > 0"
        class="absolute z-20 w-screen h-screen bg-gray-500 bg-opacity-50 flex justify-center items-center">
        <div
            class="w-18/20 h-15/20 bg-white p-2 grid grid-rows-1 rounded-xl animate-in zoom-in duration-300 overflow-auto scrollbar-hide">
            <form class="h-full w-full" @submit.prevent="submit">
                <div class="w-full h-full">
                    <input required type="text" v-model="form.namapemesan" placeholder="Nama Pemesan.."
                        class="input input-bordered w-full mb-2"/>
                    <div class="h-max w-full border-2 mb-10" v-for="(item, index) in search.validasi[0].nama.length"
                        :key="index">
                        <div class="border-b-2 h-max p-2 capitalize">Nama : {{search.validasi[0].nama[index]}}</div>
                        <div class="border-b-2 h-max p-2 capitalize">Jumlah: {{search.validasi[0].jumlah[index]}}</div>
                        <div class="border-b-2 h-max p-2 capitalize">Harga: {{search.validasi[0].harga[index]}}</div>
                        <div class="border-b-2 h-max p-2 capitalize">Total: {{search.validasi[0].total[index]}}</div>
                        <div class="border-b-2 h-max p-2 capitalize flex items-center">Keterangan:
                            <textarea class="textarea ml-2 w-full textarea-bordered" name="keterangan"
                                placeholder="Keterangan "></textarea>
                        </div>
                    </div>
                    <div class="w-full h-max mb-10 flex justify-end items-end p-2">
                        <div class="grid grid-cols-2 gap-1">
                            <button @click="" type="submit"
                                class="btn btn-sm bg-green-500 text-white border-0 hover:bg-green-600 font-semibold w-max">
                                Pesan
                            </button>
                            <button @click="search.validasi = []" type="button"
                                class="btn btn-sm bg-gray-500 text-white border-0 hover:bg-gray-600 font-semibold w-max">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div v-if="search.modal.length > 0"
        class="absolute z-20 w-screen h-screen bg-gray-500 bg-opacity-50 flex justify-center items-center">
        <div v-for="item in search.modal"
            class="w-18/20 h-max bg-white p-2 grid grid-rows-1 rounded-xl animate-in zoom-in duration-300">
            <div class="border-b-2 h-max p-2 capitalize">{{ item.nama }}</div>
            <div class="border-b-2 h-max w-full p-2 capitalize">
                <img :src="item.gambar" alt="" srcset="" />
            </div>
            <div class="border-b-2 h-max p-2 capitalize">
                Harga : {{ item.harga }}
            </div>
            <div class="border-b-2 h-max p-2 capitalize text-xs">
                {{ item.keterangan }}
            </div>
            <div class="w-full flex justify-end p-5 item-center">
                <div class="grid w-max grid-cols-2 gap-1">
                    <button @click="add(item.id)" type="button"
                        class="btn bg-green-400 text-white border-0 hover:bg-green-500 font-semibold">
                        ADD
                    </button>
                    <button @click="close()" type="button"
                        class="btn bg-gray-600 text-white border-0 hover:bg-gray-700 font-semibold">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="h-screen relative w-screen bg-gradient-to-br from-blue-600 via-cyan-400 to-cyan-500 p-2">
        <div class="w-full h-full flex flex-col">
            <div class="h-13/20 w-full bg-cyan-50 mb-2 rounded-lg overflow-hidden flex flex-col">
                <div class="w-full bg-blue-400 h-3/20 flex flex-row items-center justify-center">
                    <input type="text" v-model="search.value" placeholder="Search.."
                        class="input input-bordered w-40" />
                    <select v-model="search.kategori" @change="filteredItems" class="select w-40 ml-3">
                        <option selected>All</option>
                        <option v-for="item in kategori">
                            {{ item.nama }}
                        </option>
                    </select>
                </div>
                <div class="w-full h-17/20 overflow-hidden p-3 flex justify-center">
                    <div class="w-max h-full overflow-auto grid grid-cols-2 gap-3 scrollbar-hide">
                        <div v-for="item in filteredItems"
                            class="w-40 h-max flex flex-col bg-red-200 rounded-xl overflow-hidden">
                            <img v-bind:src="`${item.gambar}`" class="bg-cover w-full" />
                            <div class="text-xs grid grid-rows-2 h-max w-full bg-white">
                                <div class="h-full w-full flex justify-center items-center">
                                    <div class="w-full h-full px-2 break-words text-center">
                                        {{ item.nama }}
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 p-1 gap-1 h-max w-full pb-1">
                                    <button @click="add(item.id)" type="button"
                                        class="btn btn-sm bg-green-500 text-white border-0 hover:bg-green-600 font-semibold w-full">
                                        ADD
                                    </button>
                                    <button type="button" @click="modal(item.id)"
                                        class="btn btn-sm bg-blue-500 text-white border-0 hover:bg-blue-600 font-semibold w-full">
                                        Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form class="h-7/20 w-full" @submit.prevent="submit">
                <div class="h-full w-full bg-blue-500 rounded-lg overflow-hidden flex flex-col">
                    <div class="w-full h-4/20 flex justify-center items-center">
                        <button v-if="search.ceksubmit > 0" type="button" @click="validasi"
                            class="btn bg-blue-600 text-white border-0 hover:bg-blue-700 font-semibold">
                            Cek
                        </button>
                    </div>
                    <div class="w-full h-16/20 bg-blue-300 p-2 overflow-hidden">
                        <div class="h-full w-full overflow-auto scrollbar-hide">
                            <div :id="'row' + items.id" class="flex flex-row justify-center items-center w-full py-3"
                                v-for="items in this.search.pesanan" @load="alert('oke')">
                                <div class="w-full text-xs text-center">
                                    {{ items.nama }}
                                    <input name="nama" hidden :value="items.nama" type="text" />
                                    <input name="kategori_produk" hidden :value="items.id_kategori" type="text" /><input
                                        name="id" hidden :value="items.id" type="text" />
                                </div>
                                <div class="w-full text-center">
                                    <input class="w-11 h-5 text-center rounded-lg" name="jumlah" type="number"
                                        :id="'jumlah' + items.id" value="0" min="1" readonly required
                                        @input="cek(items.id)" />
                                </div>
                                <div class="w-full text-center">
                                    <input class="w-10 text-center" name="harga" :value="items.harga" hidden />
                                    {{ items.harga }}
                                </div>
                                <div class="w-full px-2 text-center">
                                    <input class="w-24 h-5 rounded-lg text-center" readonly type="number" name="total"
                                        value="0" :id="'total' + items.id" />
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
                            </div>
                            <div v-if="search.totalharga != 0"
                                class="flex justify-center items-center font-semibold text-lg w-full py-3">
                                Total Rp. {{ search.totalharga
                                }}<input v-model="form.totalfinal" id="totalharga" hidden />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
            meja: String,
        },
        mounted() {
            setInterval(() => (this.form.meja = this.meja), 3000);
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
                ceksubmit: 0,
                modal: [],
                validasi: [],
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
                keterangan: [],
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
                let keterangan = document.getElementsByName("keterangan");
                let keterangan_array= [];
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
                    keterangan_array.push(keterangan[index].value);
                });
                this.form.harga.push(harga_array);
                this.form.id.push(id_array);
                this.form.jumlah.push(jumlah_array);
                this.form.total.push(total_value_array);
                this.form.nama.push(nama_array);
                this.form.kategori.push(kategori_array);
                this.form.totalfinal = totalharga.value;
                this.form.keterangan = keterangan_array;
                Inertia.post(route("pesan.store"), form);

                this.form.harga = [];
                this.form.id = [];
                this.form.jumlah = [];
                this.form.total = [];
                this.form.nama = [];
                this.form.kategori = [];
                this.form.keterangan = [];

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
            tambah(id) {
                let jumlah = document.getElementById("jumlah" + id);
                jumlah.value = parseInt(jumlah.value) + 1;
                this.cek(id);
            },
            kurang(id) {
                let jumlah = document.getElementById("jumlah" + id);
                let a = parseInt(jumlah.value) - 1;
                jumlah.value = a;
                if (a < 1) {
                    jumlah.value = 1;
                }
                this.cek(id);
            },
            close() {
                this.search.modal = [];
            },
            modal(id) {
                this.produk.filter((item) => {
                    if (item.id == id) {
                        if (this.search.modal.length < 1) {
                            this.search.modal.push(item);
                        }
                    }
                });
            },
            validasi() {
                var jumlah = document.getElementsByName('jumlah');
                var data_jumlah = []
                var nama = document.getElementsByName('nama');
                var data_nama = []
                var harga = document.getElementsByName('harga');
                var data_harga = []
                var total = document.getElementsByName('total');
                var data_total = []
                var id = document.getElementsByName('id');
                var data_id = []
                jumlah.forEach(element => {
                    data_jumlah.push(element.value);
                });
                nama.forEach(element => {
                    data_nama.push(element.value);
                });
                harga.forEach(element => {
                    data_harga.push(element.value);
                });
                total.forEach(element => {
                    data_total.push(element.value);
                });
                id.forEach(element => {
                    data_id.push(element.value);
                });
                var master = [];

                master['nama'] = data_nama
                master['id'] = data_id
                master['jumlah'] = data_jumlah
                master['harga'] = data_harga
                master['total'] = data_total

                this.search.validasi.push(master);
                console.log();
            },
            add(id) {
                this.search.nama = id;
                return this.produk.filter((item) => {
                    if (item.id == id) {
                        if (this.search.pesanan.length < 1) {
                            this.search.pesanan.push(item);
                        } else {
                            var no = 0;
                            this.search.pesanan.forEach((element) => {
                                if (element.id == item.id) {
                                    no++;
                                }
                            });
                            if (no < 1) {
                                this.search.pesanan.push(item);
                            }
                        }
                    }
                    this.search.modal = [];
                });
            },
            cek(id) {
                var total = 0;
                var ceksubmit = 0;
                var totalfinal = 0;
                let jumlah = document.getElementsByName("jumlah");
                let harga = document.getElementsByName("harga");
                let harga_array = [];
                let total_value = document.getElementsByName("total");
                jumlah.forEach(function (item, index, arr) {
                    var a = jumlah[index].value;
                    var b = harga[index].value;

                    if (jumlah[index].value == "0") {
                        ceksubmit++;
                    }
                    if (jumlah[index].value == "") {
                        a = 0;
                    }
                    if (harga[index].value == "") {
                        b = 0;
                    }

                    total = total + a * b;
                    totalfinal = totalfinal + total;
                    total_value[index].value = a * b;
                    harga_array.push(harga[index].value);
                });
                if (ceksubmit < 1) {
                    this.search.ceksubmit = 1;
                } else {
                    this.search.ceksubmit = 0;
                }
                this.form.totalfinal = totalfinal;
                this.search.jumlah = total;
                this.search.nama = total;
                this.search.totalharga = total;
            },
            hapus(id) {
                document.getElementById("row" + id).remove();
                var set = [];
                this.search.pesanan.filter((data) => {
                    if (data.id != id) {
                        set.push(data);
                    }
                });
                this.search.pesanan = set;
                this.cek(id);
            },
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
