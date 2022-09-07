<template lang="">
    <div class="bg-white w-screen h-screen flex flex-col" data-theme="winter">
        <div class="h-2/20 sticky z-10 flex flex-row px-2 items-center bg-white top-0 w-full shadow-lg">
            <div class="indicator absolute z-10">
                <modal :idmodal="'modal-keranjang'" classbutton="btn-sm btn-outline">
                    <template v-slot:bodymodal>
                        <div class="p-2 flex bg-white justify-center z-10 sticky top-0">
                            <div class="w-full justify-center flex flex-col shadow-lg">
                                <input v-model="form_pesanan.pemesan" type="text" class="input input-bordered text-center w-full"
                                name="" id="" placeholder="nama pemesan" />
                            <div class="text-red-400 text-center" v-if="errors.pemesan">{{errors.pemesan}}</div>
                            </div>
                        </div>
                        <div tabindex="0" class="collapse z-0 collapse-arrow border border-base-300 bg-base-100 rounded-box"
                            v-for="item in list_pesanan">
                            <input type="checkbox" />
                            <div class="collapse-title text-xl font-medium flex flex-row gap-2 items-center">
                                <div class="">
                                    <img :src="item.gambar" alt="" class="w-12 rounded-lg" />
                                </div>
                                <div class="">
                                    <article class="prose">
                                        <h3>{{ item.nama }}</h3>
                                    </article>
                                </div>
                            </div>
                            <div class="collapse-content">
                                <table class="table w-full">
                                    <tbody>
                                        <tr class="active">
                                            <td>Nama</td>
                                            <td>{{ item.nama }}</td>
                                        </tr>
                                        <tr class="active">
                                            <td>Harga</td>
                                            <td>Rp. {{ item.harga }}</td>
                                        </tr>
                                        <tr class="active">
                                            <td>jumlah</td>
                                            <td>
                                                {{ item.jumlah }}
                                                {{ item.satuan }}
                                            </td>
                                        </tr>
                                        <tr class="active">
                                            <td>total</td>
                                            <td>Rp {{ item.total }}</td>
                                        </tr>
                                        <tr class="active">
                                            <td>Keterangan</td>
                                            <td>
                                                <textarea v-model="item.keterangan_pesan"
                                                    class="textarea textarea-bordered w-full"
                                                    placeholder="Keterangan..."></textarea>
                                            </td>
                                        </tr>
                                        <tr class="active">
                                            <td colspan="2" class="">
                                                <div class="grid grid-cols-3 gap-2">
                                                    <button class="btn btn-primary" @click="add(item.id)">
                                                        +
                                                    </button>
                                                    <button class="btn btn-secondary" @click="kurang(item.id)">
                                                        -
                                                    </button>
                                                    <button class="btn btn-outline" @click="hapus(item.id)">
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-center capitalize prose" v-if="form_pesanan.totalfinal >0">
                            <h3 class="font-semibold">Total Rp. {{form_pesanan.totalfinal}}</h3>
                        </div>
                        <div class="text-center capitalize prose" v-if="list_pesanan.length < 1">
                            <h3 class="font-semibold">Tidak ada pesanan</h3>
                        </div>
                    </template>
                    <template v-slot:actionmodal><button class="btn btn-primary"
                            v-if="list_pesanan.length && form_pesanan.pemesan" @click="submit">
                            Pesan
                        </button></template>
                </modal>
                <span class="indicator-item indicator-top indicator-end badge badge-secondary">{{ keranjang }}</span>
                <label for="modal-keranjang">
                    <div class="items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-9">
                            <path
                                d="M24 0C10.7 0 0 10.7 0 24S10.7 48 24 48H76.1l60.3 316.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24-10.7 24-24s-10.7-24-24-24H179.9l-9.1-48h317c14.3 0 26.9-9.5 30.8-23.3l54-192C578.3 52.3 563 32 541.8 32H122l-2.4-12.5C117.4 8.2 107.5 0 96 0H24zM176 512c26.5 0 48-21.5 48-48s-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48zm336-48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48z" />
                        </svg>
                    </div>
                </label>
            </div>
            <div class="text-black flex justify-center w-full z-0 uppercase">
                <article class="prose">
                    <h2>{{meja.nama}}</h2>
                </article>
            </div>
        </div>
        <div class="h-3/20 flex flex-col p-2 z-0">
            <div class="prose">
                <h3 class="capitalize font-bold">kategori</h3>
            </div>
            <div class="w-full h-full overflow-auto scrollbar-hide flex-row flex items-center gap-2">
                <div class="border-2 w-max h-max px-4 py-1 rounded-lg capitalize shadow-md font-semibold"
                    @click="this.filter_kategori = 'all'">
                    All
                </div>
                <div class="border-2 w-max h-max px-4 py-1 rounded-lg capitalize shadow-md font-semibold">
                    Popular
                </div>
                <div class="border-2 w-max h-max px-4 py-1 rounded-lg capitalize shadow-md font-semibold"
                    v-for="item in kategori" @click="this.filter_kategori = item.nama">
                    {{ item.nama }}
                </div>
            </div>
        </div>
        <div class="h-15/20 flex flex-col p-2">
            <div class="p-1 flex justify-between">
                <div class="prose">
                    <h3 class="capitalize font-bold">
                        {{ this.filter_kategori }}
                    </h3>
                </div>
                <div class="" v-if="this.filter_kategori == 'all'">
                    <input v-model="this.filter_search" type="text" class="input input-bordered input-sm"
                        placeholder="cari..." />
                </div>
            </div>
            <div class="flex h-full border-2 rounded-lg shadow-lg p-2 grid-cols-2 justify-center">
                <div
                    class="w-max overflow-auto scrollbar-hide grid grid-cols-2 desktop:grid-cols-6 tablet:grid-cols-4 gap-4">
                    <div class="h-max w-40 border rounded-xl flex flex-col overflow-hidden gap-2 shadow-lg"
                        v-for="(item, index) in data_produk" :key="index">
                        <img :src="item.gambar" alt="" class="rounded-2xl p-2" />
                        <div class="prose flex flex-col px-2">
                            <h4 class="text-sm">{{ item.nama }}</h4>
                            <h5 class="text-xs">Rp. {{ item.harga }}</h5>
                        </div>
                        <div class="items-center w-full">
                            <div class="btn-group w-full">
                                <button class="btn w-1/2 btn-primary" @click="add(item.id)">
                                    add
                                </button>
                                <button class="btn w-1/2 btn-primary btn-outline">
                                    <label :for="item.nama + item.index" class="modal-button w-full h-full flex items-center">
                                        Detail
                                    </label>
                                </button>
                            </div>
                            <modal :idmodal="item.nama + item.index" :titlemodal="item.nama" classbutton="btn-sm">
                                <template v-slot:buttonmodal>detail</template>
                                <template v-slot:bodymodal>
                                    <div class="justify-center w-full flex p-5">
                                        <img :src="item.gambar"
                                            class="rounded-xl w-3/4 desktop:w-10/20 tablet:w-9/20" />
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="table w-full table-compact">
                                            <!-- head -->
                                            <thead>
                                                <tr></tr>
                                            </thead>
                                            <tbody>
                                                <!-- row 1 -->
                                                <tr class="active">
                                                    <th>Nama</th>
                                                    <td>{{ item.nama }}</td>
                                                </tr>
                                                <tr class="active">
                                                    <th>Harga</th>
                                                    <td>
                                                       Rp. {{ item.harga }}
                                                    </td>
                                                </tr>
                                                <tr class="active">
                                                    <th>Keterangan</th>
                                                    <td v-if="item.keterangan">
                                                        {{ item.keterangan }}
                                                    </td>
                                                    <td v-else>-</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </template>
                                <template v-slot:actionmodal>
                                    <div class="btn btn-primary" @click="add(item.id)">
                                        add
                                    </div>
                                </template>
                            </modal>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {
        useForm
    } from '@inertiajs/inertia-vue3';

    export default {
        component: {},
        setup(props) {
            const form_pesanan = useForm({
                pemesan: null,
                pesanan: null,
                meja: null,
                totalfinal: null,
            })
            return {
                form_pesanan
            }
        },
        props: {
            produk: Array,
            kategori: Array,
            meja: Object,
            errors: Object,
        },
        data() {
            return {
                filter_kategori: "all",
                filter_search: "",
                list_pesanan: [],
            };
        },
        methods: {
            add(id) {
                if (this.list_pesanan.length < 1) {
                    this.produk.filter((items) => {
                        if (items.id == id) {
                            items.jumlah = 1;
                            items.keterangan_pesan = '';
                            items.total = 1 * items.harga;
                            this.list_pesanan.push(items);
                        }
                    });
                } else {
                    var cek = 0;
                    this.list_pesanan.filter((items) => {
                        if (items.id == id) {
                            cek++;
                        }
                    });
                    if (cek == 0) {
                        this.produk.filter((items) => {
                            if (items.id == id) {
                                items.jumlah = 1;
                                items.keterangan_pesan = '';
                                items.total = 1 * items.harga;
                                this.list_pesanan.push(items);
                            }
                        });
                    } else {
                        this.list_pesanan.filter((items) => {
                            if (items.id == id) {
                                items.jumlah += 1;
                                items.total = items.jumlah * items.harga;
                            }
                        });
                    }
                }
                this.total()
            },
            kurang(id) {
                this.list_pesanan = this.list_pesanan.filter((items) => {
                    if (items.id == id) {
                        items.jumlah -= 1;
                        if (items.jumlah <= 1) {
                            items.jumlah = 1;
                        }
                        items.total = items.jumlah * items.harga;
                    }
                    return items;
                });
                this.total()
            },
            hapus(id) {
                this.list_pesanan = this.list_pesanan.filter((items) => {
                    if (items.id != id) {
                        return items;
                    }
                });
                this.total()
            },
            total() {
                var total = 0
                this.list_pesanan.filter(items => {
                    total += items.total
                })
                this.form_pesanan.totalfinal = total
            },
            submit() {
                this.total()
                this.form_pesanan.meja = this.meja.id
                this.form_pesanan.pesanan = this.list_pesanan
                this.form_pesanan.post(route("pesan.store"))
            }
        },
        mounted() {},
        computed: {
            keranjang() {
                var jumlah = 0;
                this.list_pesanan.filter((items) => {
                    jumlah += items.jumlah;
                    return jumlah;
                });
                return jumlah;
            },
            data_produk() {
                if (this.filter_kategori.toLowerCase() == "all") {
                    return this.produk.filter((item) => {
                        return item.nama
                            .toLowerCase()
                            .includes(this.filter_search.toLowerCase());
                    });
                } else {
                    return this.produk.filter((item) => {
                        var text = item.kategori.toLowerCase();
                        if (text.indexOf(this.filter_kategori.toLowerCase()) == 0) {
                            return item;
                        }
                    });
                }
            },
        },
    };

</script>
<style lang=""></style>
