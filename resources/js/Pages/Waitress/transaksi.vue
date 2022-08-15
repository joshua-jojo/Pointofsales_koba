<template lang="">
    <div class="h-screen relative w-screen bg-gradient-to-br from-blue-600 via-cyan-400 to-cyan-500">
        <div class="w-full h-full flex justify-center items-center animate-in fade-in zoom-in duration-1000">
            <div class="h-5/6 w-11/12 p-5 bg-white rounded-3xl flex flex-col">
                <div class="w-full rounded-t-2xl border-b-2 text-3xl flex items-center drop-shadow-md pl-5 h-2/20">
                    Pesanan Waitress
                </div>
                <div class="w-full rounded-t-2xl text-xl flex justify-end items-center drop-shadow-md pl-5 h-2/20">
                    <label for="">Search : </label>
                    <input v-model="search.value" type="text" id="search_transaksi"
                        class="w-1/5 rounded-lg pl-4 ml-4 text-md" />
                </div>
                <div class="w-full h-14/20 overflow-auto scrollbar-default rounded-b-2xl">
                    <table class="table w-full">
                        <thead>
                            <tr class="sticky top-0 z-50 text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Meja</th>
                                <th>Rincian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="tabel_body">
                            <tr v-if="data == null">
                                <td> </td>
                                <td> </td>
                                <td> Mengambil data...</td>
                                <td> </td>
                                <td> </td>
                            </tr>
                            <tr v-if="data == 0">
                                <td> </td>
                                <td> </td>
                                <td> Tidak ada data...</td>
                                <td> </td>
                                <td> </td>
                            </tr>
                            <tr v-for="(item, index) in data" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.nama }}</td>
                                <td>{{ item.meja }}</td>
                                <td>
                                    <div class="dropdown dropdown-right">
                                        <label tabindex="0"
                                            class="btn m-1 text-white bg-blue-500 hover:bg-blue-500 border-0">Detail</label>
                                        <ul tabindex="0"
                                            class="dropdown-content menu p-1 border-2 border-blue-700 shadow bg-base-100 rounded-box max-h-48 h-max w-72 overflow-auto scrollbar-hide">
                                            <li v-for="data in item.pesanan" class="my-1">
                                                <a class="border-2 border-blue-400">
                                                    <div class="w-full h-full text-left grid grid-cols-4">
                                                        <div class="col-span-3">{{data.nama}}</div>
                                                        <div>x{{data.jumlah}}</div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <button @click="update(item.id)"
                                        class="rounded-xl bg-green-500 h-11 w-20 text-white hover:bg-green-400">
                                        Antar
                                    </button>
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
    import {
        useForm
    } from "@inertiajs/inertia-vue3";
    import {
        reactive
    } from "vue";

    export default {
        props: {
            pemesanan_aktif: Array,
            pemesanan_detail: Array,
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
                data: null,
            };
        },
        methods: {
            update(id) {
                axios
                    .post(route("waitressupdate", {
                        waitress: id
                    }))
                    .then((response) => {});
            },
        },
        mounted() {
            setInterval(
                () =>
                axios.get(route("apiwaitress")).then((response) => {
                    this.data = response.data.data
                }),
                10000
            );
        },
    };

</script>
<style lang=""></style>
