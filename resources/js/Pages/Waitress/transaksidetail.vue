<template lang="">
    <div
        class="h-screen relative w-screen bg-gradient-to-br from-blue-600 via-cyan-400 to-cyan-500"
    >
        <div class="w-full h-full flex justify-center items-center " data-aos="zoom-in" data-aos-duration="1000">
            <div class="h-5/6 w-11/12 p-5 bg-white rounded-3xl flex flex-col">
                <div
                    class="w-full rounded-t-2xl border-b-2 text-3xl flex items-center drop-shadow-md pl-5 h-2/20"
                >
                    Pesanan Waitress
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
                                <th>Produk</th>
                                <th>Jumlah</th>
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
                                <td>{{ item.status }}</td>
                               
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="w-full rounded-t-2xl flex items-center drop-shadow-md pl-5 h-2/20 justify-end"
                >
                    <Link :href="route('waitress.index')">
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
import { useForm } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";

export default {
    props: {
        pemesanandetail: Array,
    },
    setup() {
        var no = 1;
        const search = reactive({
            value: "",
        });
        const form = useForm({
            bayar: 0,
            id: 0,
        });
        return {
            form,
            no,
            search,
        };
    },
    computed: {
        filteredItems() {
            return this.pemesanandetail.filter((item) => {
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
