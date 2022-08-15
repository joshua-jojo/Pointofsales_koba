<template lang="">
    <div v-if="search.validasi.length > 0" class="absolute z-20 w-screen h-screen bg-gray-500 bg-opacity-50 flex justify-center items-center">
        <div class="w-18/20 h-15/20 bg-white p-2 grid grid-rows-1 rounded-xl animate-in zoom-in duration-300 overflow-auto scrollbar-hide">
            <form class="h-full w-full" @submit.prevent="submit">
                <div class="w-full h-full">
                    <input required type="text" v-model="form.namapemesan" placeholder="Nama Pemesan.."
                        class="input input-bordered w-full mb-2" />
                    <div class="h-max w-full border-2 mb-10" v-for="(item, index) in search.validasi" :key="index">
                        <div class="border-b-2 h-max p-2 capitalize">
                            Nama : {{ item.nama }}
                        </div>
                        <div class="border-b-2 h-max p-2 capitalize">
                            Jumlah: {{ item.jumlah }}
                        </div>
                        <div class="border-b-2 h-max p-2 capitalize">
                            Harga: {{ item.harga }}
                        </div>
                        <div class="border-b-2 h-max p-2 capitalize">
                            Total: {{ item.total }}
                        </div>
                        <div class="border-b-2 h-max p-2 capitalize flex items-center">
                            Keterangan:
                            <textarea class="textarea ml-2 w-full textarea-bordered" name="keterangan"
                                :id="'keterangan'+item.id" placeholder="Keterangan ">{{ item.keterangan }}</textarea>
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
                                v-for="items in this.search.pesanan">
                                <div class="w-full text-xs text-center">
                                    {{ items.nama }}
                                    <input name="nama" hidden :value="items.nama" type="text" />
                                    <input name="kategori_produk" hidden :value="items.id_kategori" type="text" /><input
                                        name="id" hidden :value="items.id" type="text" />
                                </div>
                                <div class="w-full text-center">
                                    x {{ items.jumlah }}
                                </div>
                                <div class="w-full text-center">
                                    <input class="w-10 text-center" name="harga" :id="'harga' + items.id"
                                        :value="items.harga" hidden />
                                    Rp. {{ items.harga }}
                                </div>
                                <div class="w-full px-2 text-center">
                                    Rp. {{ items.total }}
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
        setup(props) {
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
            const meja = props.meja;

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
                    var keterangan = document.getElementById('keterangan' + item.id).value

                    harga_array.push(item.harga)
                    id_array.push(item.id)
                    jumlah_array.push(item.jumlah)
                    total_value_array.push(item.total)
                    kategori_array.push(item.kategori)
                    nama_array.push(item.nama)
                    keterangan_array.push(keterangan)
                    totalfinal = totalfinal + item.total
                })
                this.form.harga.push(harga_array);
                this.form.id.push(id_array);
                this.form.jumlah.push(jumlah_array);
                this.form.total.push(total_value_array);
                this.form.nama.push(nama_array);
                this.form.kategori.push(kategori_array);
                this.form.keterangan = keterangan_array;
                this.form.meja = this.meja;
                this.form.totalfinal = totalfinal;
                Inertia.post(route("pesan.store"), form);
                console.log(this.form);

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
                meja,
                form,
                search,
            };
        },
        methods: {
            tambah(id) {
                this.search.pesanan.forEach((items, index) => {
                    if (items.id == id) {
                        items.jumlah++;
                        items.total = items.jumlah * items.harga;
                        this.search.pesanan[index] = items;
                    }
                });
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
                this.search.pesanan.forEach((items, index) => {
                    items["keterangan"] = "-";
                    this.search.pesanan[index] = items;
                });
                this.search.validasi = this.search.pesanan;
            },
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
        },
        mounted() {

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
