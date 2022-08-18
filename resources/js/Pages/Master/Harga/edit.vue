<template lang="">
    <blankVue>
        <template v-slot:breadcrumbs>
             <ul>
                <li><a>Master</a></li>
                <li><a>harga</a></li>
                <li><a>edit</a></li>
                <li></li>
            </ul>
        </template>
        <template v-slot:konten>
            <form
                class="w-full h-full"
                @submit.prevent="
                    form.put(
                        route('masterharga.update', {
                            harga: this.harga.id,
                        })
                    )
                "
            >
                <h3 class="font-bold text-lg mb-1">Value</h3>
                <input
                    type="text"
                    v-model="form.value"
                    placeholder="Type here"
                    class="input input-bordered w-full"
                />
                <div class="capitalize text-red-400" v-if="errors.value">{{errors.value}}</div>
                <div class="modal-action">
                    <button
                        type="submit"
                        class="btn bg-green-500 text-white hover:bg-green-400 border-0"
                    >
                        Save
                    </button>
                    <Link :href="route('masterharga.index')">
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
        harga:Array,
        errors:Object,
    },
    setup() {
        const form = useForm({
           value:null,
        });

        return { form };
    },
    mounted() {
        this.form.value = this.harga.value
    },
};
</script>
<style lang=""></style>
