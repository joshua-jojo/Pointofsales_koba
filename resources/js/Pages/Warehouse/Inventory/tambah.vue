<template lang="">
    <blankVue>
        <template v-slot:breadcrumbs>
            <ul>
                <li><a>warehouse</a></li>
                <li><a>inventory</a></li>
                <li><a>Tambah</a></li>
                <li></li></ul
        ></template>
        <template v-slot:konten>
            <form
                class="w-full h-full"
                @submit.prevent="
                    form.post(
                        route('warehouseinventory.store')
                    )
                "
            >
                <h3 class="font-bold text-lg mb-1">Nama</h3>
                <input
                required
                    type="text"
                    v-model="form.nama"
                    placeholder="Type here"
                    class="input input-bordered w-full"
                />
                <h3 class="font-bold text-lg mb-1">Harga</h3>
                <input
                required
                    type="num"
                    v-model="form.harga"
                    placeholder="Type here"
                    class="input input-bordered w-full"
                />
                <h3 class="font-bold text-lg mb-1 capitalize">Satuan</h3>
                <select class="select select-bordered w-full mb-2" name="kategori" v-model="form.satuan" required>
                    <option :value="item.id" v-for="item in satuan" >{{item.nama}}</option>
                </select>

                <div class="modal-action">
                    <button
                        type="submit"
                        class="btn bg-green-500 text-white hover:bg-green-400 border-0"
                    >
                        Save
                    </button>
                    <Link :href="route('warehouseinventory.index')">
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
        satuan: Array,
    },
    setup() {
        const form = useForm({
            nama: null,
            harga: 0,
            satuan: null,
        });

        return { form };
    },
};
</script>
<style lang=""></style>
