<template lang="">
    <div
        class="h-screen relative w-screen bg-gradient-to-br from-blue-600 via-cyan-400 to-cyan-500"
    >
        <div
            class="w-full h-full flex justify-center items-center animate-in fade-in zoom-in duration-1000"
        >
            <div class="h-5/6 w-11/12 p-5 bg-white rounded-3xl flex flex-col">
                <div
                    class="w-full rounded-t-2xl border-b-2 text-3xl flex items-center drop-shadow-md pl-5 h-2/20"
                >
                    Transaksi Aktif
                </div>
                <div
                    class="w-full rounded-t-2xl text-xl flex justify-end items-center drop-shadow-md pl-5 h-2/20"
                >
                    <label for="">Search : </label>
                    <input
                        v-model="search.value"
                        type="text"
                        id="search_transaksi"
                        class="w-1/5 rounded-lg pl-4 ml-4 text-md"
                    />
                </div>
                <div
                    class="w-full h-14/20 overflow-auto scrollbar-default rounded-b-2xl"
                >
                    <table class="table w-full">
                        <thead>
                            <tr class="sticky top-0 text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Meja</th>
                                <th>Rincian</th>
                                <th>Total Bayar</th>
                                <th>Uang Ditermia</th>
                                <th>Kembalian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="tabel_body">
                            <tr
                                v-for="(item, index) in filteredItems"
                                :key="index"
                            >
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.nama }}</td>
                                <td>{{ item.meja }}</td>
                                <td>
                                    <Link
                                        :href="
                                            route('cashiertransaksi.show', {
                                                cashiertransaksi: item.id,
                                            })
                                        "
                                        ><button
                                            class="rounded-xl bg-blue-500 h-11 w-20 text-white hover:bg-blue-400"
                                        >
                                            Detail
                                        </button></Link
                                    >
                                </td>
                                <td>{{ item.total }}</td>
                                <td>
                                    <input
                                        type="number"
                                        value=""
                                        name="bayar"
                                        @input="accept(index, item.total)"
                                        :id="'bayar' + index"
                                        placeholder="Type here"
                                        class="input w-full bg-blue-100"
                                    />
                                </td>
                                <td>
                                    <input
                                        type="number"
                                        value="0"
                                        :id="'kembalian' + index"
                                        readonly
                                        class="input w-full bg-blue-100"
                                    />
                                </td>
                                <td :id="'buttonblock' + index">
                                    <button
                                        class="btn bg-blue-500 btn-disabled hover:bg-blue-500 text-white border-0"
                                    >
                                        Accept
                                    </button>
                                </td>
                                <td :id="'button' + index">
                                    <button
                                        @click="submit(index, item.id)"
                                        class="btn bg-blue-700 hover:bg-blue-500 text-white border-0"
                                    >
                                        Accept
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="w-full rounded-t-2xl flex items-center drop-shadow-md pl-5 h-2/20 justify-end"
                >
                    <Link :href="route('cashier.index')">
                        <button
                            class="rounded-xl bg-blue-500 h-11 w-20 text-white hover:bg-blue-400"
                        >
                            Home
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
        pemesanan_aktif: Array,
    },
    setup() {
        var no = 1;
        const search = reactive({
            value: "",
        });
        const form = useForm({
            bayar: 0,
            kembalian: 0,
            id: 0,
        });
        return {
            form,
            no,
            search,
        };
    },
    methods: {
        accept(index, total) {
            var bayar = document.getElementById("bayar" + index).value;
            document.getElementById('kembalian' + index).value = bayar - total;
            this.pemesanan_aktif.forEach((item, index, arr) => {
                var data = document.getElementById("bayar" + index).value;
                if (data == "") {
                    document.getElementById(
                        "buttonblock" + index
                    ).hidden = false;
                    document.getElementById("button" + index).hidden = true;
                } else {
                    document.getElementById(
                        "buttonblock" + index
                    ).hidden = true;
                    document.getElementById("button" + index).hidden = false;
                }
            });
        },
        submit(index, id) {
            var bayar = document.getElementById("bayar" + index).value;
            var kembalian = document.getElementById("kembalian" + index).value;
            this.form.bayar = bayar;
            this.form.kembalian = kembalian;
            this.form.id = id;
            document.getElementById("bayar" + index).value = "";
            Inertia.post(route("cashiertransaksi.store"), this.form);
        },
    },
    mounted() {
        var bayar = document.getElementsByName("bayar");
        bayar.forEach((items, index, arr) => {
            arr[index].value = "";
        });
        this.pemesanan_aktif.forEach((item, index, arr) => {
            var data = document.getElementById("bayar" + index).value;
            if (data == "") {
                document.getElementById("buttonblock" + index).hidden = false;
                document.getElementById("button" + index).hidden = true;
            } else {
                document.getElementById("buttonblock" + index).hidden = true;
                document.getElementById("button" + index).hidden = false;
            }
        });
    },
    computed: {
        filteredItems() {
            return this.pemesanan_aktif.filter((item) => {
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
