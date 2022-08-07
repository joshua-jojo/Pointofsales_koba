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
                                <th></th>
                                <th>Nama</th>
                                <th>Meja</th>
                                <th>Total</th>
                                <th>Rincian</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="tabel_body">
                            <tr
                                v-for="(item, index) in filteredItems"
                                :key="index"
                            >
                                <td>
                                    <input
                                        @change="cekbox()"
                                        type="checkbox"
                                        name="checkbox"
                                        :value="item.id"
                                        class="checkbox"
                                    />
                                </td>
                                <td>{{ item.nama }}</td>
                                <td>{{ item.meja }}</td>
                                <td>{{ item.total }}</td>
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
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="w-full rounded-t-2xl flex items-center drop-shadow-md pl-5 h-2/20 justify-end"
                >
                    <button v-if="form.id.length > 0"
                        @click="submit"
                        class="rounded-xl bg-green-500 h-11 w-20 text-white hover:bg-green-400 mr-2"
                    >
                        Bayar
                    </button>

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
    component: {},
    props: {
        pemesanan_aktif: Array,
    },
    setup() {
        var no = 1;
        const search = reactive({
            value: "",
        });
        const form = useForm({
            id: 0,
        });
        return {
            form,
            no,
            search,
        };
    },
    methods: {
        cekbox() {
            var a = document.getElementsByName("checkbox");
            var b = [];

            a.forEach((element, index, arr) => {
                if (a[index].checked) {
                    b.push(a[index].value);
                }
            });
            this.form.id = b;
        },
        submit(index, id) {
            Inertia.post(route("cashiertransaksi.store"), this.form);
        },
    },
    mounted() {},
    computed: {
        filteredItems() {
            return this.pemesanan_aktif.filter((item) => {
                return (
                    item.meja
                        .toLowerCase()
                        .indexOf(this.search.value.toLowerCase()) > -1
                );
            });
        },
    },
};
</script>
<style lang=""></style>
