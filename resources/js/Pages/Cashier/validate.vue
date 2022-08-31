<template lang="">
    <div
        class="h-screen relative w-screen bg-gradient-to-br from-blue-600 via-cyan-400 to-cyan-500"
    >
        <div
            class="w-full h-full flex justify-center items-center"
            data-aos="zoom-in"
            data-aos-duration="1000"
        >
            <div class="h-5/6 w-11/12 p-5 bg-white rounded-3xl flex flex-col">
                <div
                    class="w-full rounded-t-2xl border-b-2 text-3xl flex items-center drop-shadow-md pl-5 h-2/20"
                >
                    Transaksi Detail
                </div>
                <div
                    class="w-max rounded-t-2xl text-xl drop-shadow-md grid pl-5 h-10/20 mb-1"
                >
                    <div class="grid grid-cols-2">
                        <div class="w-max">
                            <label for="">Total</label>
                        </div>
                        <div class="w-max">
                            : Rp. {{ pemesanandetail.total }}
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <label for="">Bayar</label>
                        <div class="flex flex-row w-max">:
                            <input
                                v-model="form.bayar"
                                @input="kembalian(pemesanandetail.total)"
                                type="number"
                                min="1"
                                id="bayar"
                                class="w-44 rounded-lg text-md ml-2 pl-2"
                            />
                            <button
                                type="button"
                                class="btn btn-sm h-full ml-4"
                                @click="uang_pas"
                            >
                                Uang Pas
                            </button>
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <label class="" for="">Kembalian</label>
                        <div>: Rp. {{ form.kembalian }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <label class="" for="">Ref</label>
                        <div class="">
                            :<input
                                v-model="form.ref"
                                type="text"
                                placeholder="Optional..."
                                min="1"
                                class="w-44 rounded-lg pl-4 ml-2 text-md p-1"
                            />
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <label class="text-md" for="">Search</label>
                        <div class="">
                            :<input
                                v-model="search.value"
                                type="text"
                                id="search_transaksi"
                                class="w-44 rounded-lg px-4 text-md ml-2"
                            />
                        </div>
                    </div>
                </div>
                <div
                    class="w-full h-10/20 overflow-auto scrollbar-default rounded-b-2xl"
                >
                    <table class="table w-full">
                        <thead>
                            <tr class="sticky top-0 text-center">
                                <th>No</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="tabel_body">
                            <tr
                                v-for="(item, index) in filteredItems"
                                :key="index"
                            >
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.nama }}</td>
                                <td>{{ item.jumlah }}</td>
                                <td>{{ item.harga }}</td>
                                <td>{{ item.total }}</td>
                                <td>{{ item.status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="w-full rounded-t-2xl flex items-center drop-shadow-md pl-5 h-2/20 justify-end"
                >
                    <button
                        v-if="search.kembalian > 0"
                        @click="submit()"
                        class="rounded-xl bg-green-500 h-11 w-20 text-white hover:bg-green-400 mr-2"
                    >
                        Accept
                    </button>
                    <Link :href="route('cashiertransaksi.index')">
                        <button
                            class="rounded-xl bg-blue-500 h-11 w-20 text-white hover:bg-blue-400"
                        >
                            back
                        </button></Link
                    >
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
        pemesanandetail: Object,
        total: Number,
    },
    setup() {
        var no = 1;
        const search = reactive({
            value: "",
            kembalian: 0,
        });
        const form = useForm({
            pemesanan: null,
            bayar: null,
            kembalian: 0,
            ref: null,
        });

        return {
            form,
            no,
            search,
        };
    },
    methods: {
        submit() {
            this.form.pemesanan = this.pemesanandetail;
            return Inertia.post(route("cetak"), this.form);
        },
        uang_pas() {
            this.form.bayar = this.pemesanandetail.total;
            this.kembalian(this.pemesanandetail.total);
        },
        kembalian(total) {
            var kembalian = 0;
            var bayar = this.form.bayar;
            kembalian = bayar - total;
            if (kembalian >= 0) {
                this.search.kembalian = 1;
                this.form.kembalian = kembalian;
            } else {
                this.search.kembalian = 0;
                this.form.kembalian = 0;
            }
        },
    },
    computed: {
        filteredItems() {
            return this.pemesanandetail.data_pemesanan.filter((item) => {
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
