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
                    required
                    placeholder="Type here"
                    class="input input-bordered w-full mb-2"
                />
                <div class="capitalize text-red-400" v-if="errors.nama">
                    {{ errors.nama }}
                </div>
                <h3 class="font-bold text-lg mb-1">Keterangan</h3>
                <textarea
                    class="textarea textarea-info w-full"
                    required
                    v-model="form.keterangan"
                    placeholder="Keterangan"
                ></textarea>
                <div class="capitalize text-red-400" v-if="errors.keterangan">
                    {{ errors.keterangan }}
                </div>
                <h3 class="font-bold text-lg mb-1 capitalize">harga</h3>
                <input
                    type="number"
                    v-model="form.harga"
                    name="harga"
                    required
                    placeholder="Type here"
                    class="input input-bordered w-full mb-2"
                />
                 <div class="capitalize text-red-400" v-if="errors.harga">{{ errors.harga }}</div>
                <h3 class="font-bold text-lg mb-1 capitalize">diskon %</h3>
                <input
                    type="number"
                    v-model="form.diskon"
                    name="harga"
                    min="0"
                    max="100"
                    placeholder="Type here"
                    class="input input-bordered w-full mb-2"
                    required
                />
                 <div class="capitalize text-red-400" v-if="errors.diskon">{{ errors.diskon }}</div>
                <!-- <h3 class="font-bold text-lg mb-1 capitalize">stok</h3>
                <input
                    type="number"
                    v-model="form.stok"
                    name="stok"
                    required
                    placeholder="Type here"
                    class="input input-bordered w-full mb-2"
                /> -->
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
                            required
                        />
                    </label>
                    <div class="capitalize text-red-400" v-if="errors.gambar">{{ errors.gambar }}</div>
                </div>
                <div class="modal-action">
                    <button
                        type="submit"
                        :disabled="form.processing"
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
        errors: Object,
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
            diskon: null,
        });

        return { form };
    },
    methods: {
        gambar() {
            // console.log(this.form.gambar);
        },
    },
};
</script>
<style lang=""></style>
