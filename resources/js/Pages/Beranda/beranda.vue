<template lang="">
    <blankVue>
        <template v-slot:title>
            <title>Beranda | Point Of Sales</title>
        </template>
        <template v-slot:breadcrumbs>
            <ul>
                <li><a>Beranda</a></li>
                <li></li>
            </ul>
        </template>
       
        <template v-slot:konten>
            <div class="w-full h-max grid grid-cols-4 gap-4 ">
                <statVue title="Kategori" :data="kategori"></statVue>
                <statVue title="Produk" :data="produk"></statVue>
                <statVue title="Transaksi Pemasukkan" :data="transaksi_pemasukkan"></statVue>
                <statVue title="Transaksi Pengeluaran" :data="transaksi_pengeluaran"></statVue>
            </div>
            <div class="w-full grid grid-cols-2 gap-4">
                <div class="w-full bg-slate-200 rounded-lg p-2 mt-4">
                    <areaVue title="Statistik Pemasukkan" :datax="bulan" :datay="data_pemasukkan" keterangan="Pemasukkan"></areaVue>
                </div>
                <div class="w-full  bg-slate-200 rounded-lg p-2 mt-4">
                    <areaVue title="Statistik Pengeluaran" :datax="bulan" :datay="data_pengeluaran" keterangan="Pengeluaran"></areaVue>
                </div>
            </div>
        </template>
    </blankVue>
</template>
<script>
import areaVue from "../Chart/area.vue";
import statVue from "../Component/stat.vue";
import blankVue from "../Template/blank.vue";


export default {
    components: {
        blankVue,
        areaVue,
        statVue
    },
    setup() {
        var username = null;
        return{
            username
        }
    },
    props:['bulan','indexbulan','data_pemasukkan','data_pengeluaran','kategori','produk','transaksi_pemasukkan','transaksi_pengeluaran','user'],
    mounted() {
        localStorage.setItem('username', this.user)
    },
};
</script>
<style lang=""></style>
