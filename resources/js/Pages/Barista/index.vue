<template lang="">
    <div
        class="h-screen relative w-screen bg-gradient-to-br from-blue-600 via-cyan-400 to-cyan-500"
    >
        <div
            class="w-full h-full flex justify-center items-center " data-aos="zoom-in" data-aos-duration="1000"
        >
            <div class="h-5/6 w-11/12 p-5 bg-white rounded-3xl flex flex-col">
                <div
                    class="w-full rounded-t-2xl border-b-2 text-3xl flex items-center drop-shadow-md pl-5 h-2/20"
                >
                    Daftar Pesan Minuman
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
                                 <th>Keterangan</th>
                                <th>Status</th>
                                <th>Rincian</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="tabel_body">
                            <tr
                                data-aos="fade-right" data-aos-duration="1000"
                                v-for="(item, index) in filteredItems"
                                :key="index"
                            >
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.nama }}</td>
                                <td>{{ item.meja }}</td>
                                <td>
                                    <textarea class="textarea textarea-bordered">{{item.keterangan}}</textarea>
                                </td>
                                <td>{{ item.status }}</td>
                                <td>
                                    <div class="flex flex-row">
                                        <button @click="antri(item.id)"
                                            class="rounded-xl ml-2 bg-gray-500 h-11 w-20 text-white hover:bg-gray-400">
                                            ANTRI
                                        </button>
                                        <button v-if="item.status == 'antri'" @click="proses(item.id)"
                                            class="rounded-xl ml-2 bg-yellow-500 h-11 w-20 text-white hover:bg-yellow-400">
                                            PROSES
                                        </button>
                                        <button v-if="item.status == 'diproses'" @click="selesai(item.id)"
                                            class="rounded-xl ml-2 bg-green-500 h-11 w-20 text-white hover:bg-green-400">
                                            SELESAI
                                        </button>
                                        <button @click="habis(item.id)"
                                            class="rounded-xl ml-2 bg-red-500 h-11 w-24 text-white hover:bg-red-400">
                                            STOK HABIS
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <div
                    class="w-full rounded-t-2xl flex items-center drop-shadow-md pl-5 h-2/20 justify-end"
                >
                    <Link :href="route('cashier.index')">
                        <button
                            class="rounded-xl bg-blue-500 h-11 w-20 text-white hover:bg-blue-400"
                        >
                            Home
                        </button></Link
                    >
                </div> -->
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
    data() {
        return {
            data: this.pemesanan_aktif,
        };
    },
    methods: {
        antri(id) {
            axios
                .post(route("cookstatus", { id: id, data: "antri" }))
                .then((response) => {});
        },
        proses(id) {
            axios
                .post(route("cookstatus", { id: id, data: "diproses" }))
                .then((response) => {});
        },
        selesai(id) {
            axios
                .post(route("cookstatus", { id: id, data: "selesai" }))
                .then((response) => {});
        },
        habis(id) {
            axios
                .post(route("cookstatus", { id: id, data: "habis" }))
                .then((response) => {});
        },
    },
    mounted() {
        setInterval(
            () =>
                axios.get(route("apibarista")).then((response) => {
                    this.data = [];
                    this.data = response.data.data;
                }),
            2000
        );
    },
    computed: {
        filteredItems() {
            return this.data.filter((item) => {
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
