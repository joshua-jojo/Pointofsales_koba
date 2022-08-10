<template lang="">
    <blankVue>
        <template v-slot:breadcrumbs>
            <ul>
                <li><a>Master</a></li>
                <li><a>Produk</a></li>
                <li><a>Tambah</a></li>
                <li></li></ul
        ></template>
        <template v-slot:konten>
            <form
                class="w-full h-full mb-20"
                @submit.prevent="form.post(route('masterproduk.store'))"
            >
                <h3 class="font-bold text-lg mb-1">Nama Produk</h3>
                <input
                    type="text"
                    v-model="form.nama"
                    name="nama"
                    placeholder="Type here"
                    class="input input-bordered w-full mb-2"
                />
                <h3 class="font-bold text-lg mb-1">Keterangan</h3>
                <textarea class="textarea textarea-info w-full" v-model="form.keterangan" placeholder="Bio"></textarea>
                <h3 class="font-bold text-lg mb-1 capitalize">harga</h3>
                <input
                    type="number"
                    v-model="form.harga"
                    name="harga"
                    placeholder="Type here"
                    class="input input-bordered w-full mb-2"
                />
                <h3 class="font-bold text-lg mb-1 capitalize">stok</h3>
                <input
                    type="number"
                    v-model="form.stok"
                    name="stok"
                    placeholder="Type here"
                    class="input input-bordered w-full mb-2"
                />
                <h3 class="font-bold text-lg mb-1 capitalize">kategori</h3>
                <select
                    class="select select-bordered w-full mb-2"
                    name="kategori"
                    v-model="form.kategori"
                    required
                >
                    <option disabled selected>-Pilih Kategori-</option>
                    <option v-for="(item, index) in kategori" :key="index">
                        {{ item.nama }}
                    </option>
                </select>
                <h3 class="font-bold text-lg mb-1 capitalize">satuan</h3>
                <select
                    class="select select-bordered w-full"
                    name="satuan"
                    v-model="form.satuan"
                    required
                >
                    <option disabled selected>-Pilih Satuan-</option>
                    <option v-for="(item, index) in satuan" :key="index">
                        {{ item.nama }}
                    </option>
                </select>
                <div class="form-control w-full mt-2">
                    <label class="input-group w-full">
                        <input
                            type="file"
                            name="gambar"
                            @input="this.form.gambar = $event.target.files[0]"
                            placeholder="Input your image"
                            class="input input-bordered w-full"
                        />
                    </label>
                </div>
                <div class="modal-action">
                    <button
                        type="submit"
                        @click="gambar"
                        class="btn bg-green-500 text-white hover:bg-green-400 border-0"
                    >
                        Save
                    </button>
                    <Link :href="route('masterproduk.index')">
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
        produk: Array,
        kategori: Array,
        satuan: Array,
    },
    setup() {
        const form = useForm({
            nama: null,
            harga: null,
            satuan: null,
            stok: null,
            kategori: null,
            gambar: null,
            keterangan: null,
        });

        return { form };
    },
    methods: {
        gambar() {
            console.log(this.form.gambar);
        },
    },
};
</script>
<style lang=""></style>
