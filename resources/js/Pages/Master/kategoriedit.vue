<template lang="">
    <blankVue>
        <template v-slot:title>
            <title>Edit Kategori | Point Of Sales</title>
        </template>
        <template v-slot:breadcrumbs>
            <ul>
                <li><a>Master</a></li>
                <li><a>kategori</a></li>
                <li><a>edit</a></li>
                <li></li>
            </ul>
        </template>
        <template v-slot:alert>
            <div v-if="success" class="alert alert-success shadow-lg mb-2">
                <div>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="stroke-current flex-shrink-0 h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <span class="capitalize">{{ success }}</span>
                </div>
            </div>
        </template>
        <template v-slot:opsibutton>
            <div class="flex justify-end">
                <label
                    for="my-modal-6"
                    class="flex justify-center items-center modal-button w-24 bg-green-500 hover:bg-green-400 capitalize h-8 rounded-lg"
                    ><i class="fa-solid fa-plus pr-2"></i>tambah</label
                >
            </div>
        </template>
        <template v-slot:konten>
            <form class="w-full h-full" @submit.prevent="form.put(route('masterkategori.update',{kategori:this.kategori.id}))">
                <h3 class="font-bold text-lg mb-1">Nama Kategori</h3>
                <input
                    type="text"
                    v-model="form.nama"
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
                   <Link :href="route('masterkategori.index')"> <label for="my-modal-6" class="btn">cancel</label></Link>
                </div>
            </form>
        </template>
    </blankVue>
</template>
<script>
import blankVue from "../Template/blank.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        blankVue,
    },
    props: {
        kategori: Object,
        success: String,
        warning: String,
        danger: String,
    },
    setup() {
        const form = useForm({
           nama:null,
        });

        return { form };
    },
    mounted() {
        this.form.nama = this.kategori.nama
    },
};
</script>
<style lang=""></style>
