<template lang="">
    <blankVue>
        <template v-slot:breadcrumbs>
             <ul>
                <li><a>Master</a></li>
                <li><a>meja</a></li>
                <li><a>edit</a></li>
                <li></li>
            </ul>
        </template>
        <template v-slot:konten>
            <form
                class="w-full h-full"
                @submit.prevent="
                    form.put(
                        route('mastermeja.update', {
                            meja: this.meja.id,
                        })
                    )
                "
            >
                <h3 class="font-bold text-lg mb-1">Nama Meja</h3>
                <input
                    type="text"
                    v-model="form.nama"
                    placeholder="Type here"
                    class="input input-bordered w-full"
                />
                 <h3 class="font-bold text-lg mb-1 capitalize">status</h3>
                <select class="select select-bordered w-full mb-2" name="kategori" v-model="form.status" required>
                    <option value="1" >Aktif</option>
                    <option value="0" selected>Tidak Aktif</option>
                </select>
                <div class="modal-action">
                    <button
                        type="submit"
                        class="btn bg-green-500 text-white hover:bg-green-400 border-0"
                    >
                        Save
                    </button>
                    <Link :href="route('mastersatuan.index')">
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
    props:{
        meja:Array,
    },
    setup() {
        const form = useForm({
           nama:null,
           status:null,
        });

        return { form };
    },
    mounted() {
        this.form.nama = this.meja.nama
        this.form.status = this.meja.status
    },
};
</script>
<style lang=""></style>
