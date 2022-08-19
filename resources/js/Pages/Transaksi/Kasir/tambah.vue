<template lang="">
    <blankVue>
        <template v-slot:breadcrumbs>
            <ul>
                <li><a>Transaksi</a></li>
                <li><a>Pemasukkan</a></li>
                <li><a>Tambah</a></li>
                <li></li></ul
        ></template>
        <template v-slot:konten>
            <form
                class="w-full h-full mb-20"
                @submit.prevent="form.post(route('transaksipemasukkan.store'))"
            >
                <h3 class="font-bold text-lg mb-1">Nama Produk</h3>
                <input
                    type="text"
                    v-model="form.nama"
                    name="nama"
                    placeholder="Type here"
                    class="input input-bordered w-full mb-2"
                />
                
                <h3 class="font-bold text-lg mb-1 capitalize">harga</h3>
                <input
                    type="number"
                    v-model="form.harga"
                    name="harga"
                    placeholder="Type here"
                    class="input input-bordered w-full mb-2"
                />
                <h3 class="font-bold text-lg mb-1 capitalize">jumlah</h3>
                <input
                    type="number"
                    v-model="form.jumlah"
                    name="jumlah"
                    placeholder="Type here"
                    class="input input-bordered w-full mb-2"
                />
                <h3 class="font-bold text-lg mb-1 capitalize">total</h3>
                <input
                    type="number"
                    v-model="form.total"
                    name="total"
                    placeholder="Type here"
                    class="input input-bordered w-full mb-2"
                />
                <div class="modal-action">
                    <button
                        type="submit"
                        class="btn bg-green-500 text-white hover:bg-green-400 border-0"
                    >
                        Save
                    </button>
                    <Link :href="route('transaksipemasukkan.index')">
                        <label for="my-modal-6" class="btn">cancel</label></Link
                    >
                </div>
            </form>
        </template>
    </blankVue>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import blankVue from "../../Template/blank.vue";

export default {
    components: {
        blankVue,
    },
    props: {
        pemasukkan: Array,
        kategori: Array,
        satuan: Array,
    },
    setup() {
        const form = useForm({
            nama: null,
            harga: null,
            jumlah: 0,
            total: 0,
        });

        return { form };
    },
};
</script>
<style lang=""></style>
