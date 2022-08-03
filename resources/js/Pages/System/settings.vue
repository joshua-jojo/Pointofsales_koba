<template lang="">
    <blankVue>
        <template v-slot:title>
            <title>Settings | Point Of Sales</title>
        </template>
        <template v-slot:breadcrumbs>
            <ul>
                <li><a>System</a></li>
                <li><a>Settings</a></li>
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
            <div v-if="warning" class="alert bg-yellow-400 shadow-lg mb-2">
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
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                        />
                    </svg>
                    <span class="capitalize">{{ warning }}</span>
                </div>
            </div>
            <div v-if="danger" class="alert bg-red-400 shadow-lg mb-2">
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
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                        />
                    </svg>
                    <span class="capitalize">{{ danger }}</span>
                </div>
            </div>
        </template>

        <template v-slot:konten>
            <form
                class="w-full h-full"
                @submit.prevent="
                    form.put(route('systemsettings.update', { setting: 1 }))
                "
            >
                <h3 class="font-bold text-lg mb-1">Nama Perusahaan</h3>
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
import blankVue from "../Template/blank.vue";

export default {
    components: {
        blankVue,
    },
    props: {
        settings:Array,
        warning:String,
        danger:String,
        success:String,
    },
    setup() {
        const form = useForm({
            nama: null,
        });

        return { form };
    },
    mounted() {
        this.form.nama = this.settings[0].nama;
    },
};
</script>
<style lang=""></style>
