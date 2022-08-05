<template lang="">
    <blankVue>
        <template v-slot:breadcrumbs>
            <ul>
                <li><a>warehouse</a></li>
                <li><a>inventory</a></li>
                <li><a>pengeluaran</a></li>
                <li></li></ul
        ></template>
        <template v-slot:konten>
            <form
                class="w-full h-full"
                @submit.prevent="form.put(route('warehouseinventorytransaksi.update',{inventorytransaksi: form.id}))"
            >
                <h3 class="font-bold text-lg mb-1 capitalize">Nama</h3>
                <select
                    class="select select-bordered w-full mb-2"
                    name="kategori"
                    v-model="form.id"
                    required
                >
                    <option :value="item.id" v-for="item in inventory">
                        {{ item.nama }}
                    </option>
                </select>
                <h3 class="font-bold text-lg mb-1">jumlah</h3>
                <input
                    required
                    type="num"
                    v-model="form.jumlah"
                    placeholder="Type here"
                    class="input input-bordered w-full"
                />

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
        inventory: Array,
    },
    setup() {
        const form = useForm({
            id: null,
            jumlah: 0,
        });

        return { form };
    },
};
</script>
<style lang=""></style>
