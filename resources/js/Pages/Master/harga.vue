<template lang="">
    <blankVue>
        <template v-slot:title>
            <title>Kategori | Point Of Sales</title>
        </template>

        <template v-slot:breadcrumbs>
            <ul>
                <li><a>Master</a></li>
                <li><a>Harga</a></li>
                <li></li>
            </ul>
        </template>

        <template v-slot:alert>
            <div v-if="errors" class="toast toast-start">
                <div
                    v-if="this.alert_success"
                    class="alert alert-success shadow-lg"
                >
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
                        <span>{{ this.alert_success }}</span>
                    </div>
                </div>
                <div
                    v-if="this.alert_warning"
                    class="alert alert-warning shadow-lg"
                >
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
                        <span>{{ this.alert_warning }}</span>
                    </div>
                </div>
                <div
                    v-if="this.alert_danger"
                    class="alert alert-error shadow-lg"
                >
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
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                        <span>{{ this.alert_danger }}</span>
                    </div>
                </div>
            </div>
        </template>

        <!-- <template v-slot:opsibutton>
            <div class="flex justify-end">
                <Link :href="route('mastermeja.create')">
                    <div
                        class="flex justify-center items-center modal-button w-24 bg-green-500 hover:bg-green-400 capitalize h-8 rounded-lg"
                    >
                        <i class="fa-solid fa-plus pr-2"></i>tambah
                    </div>
                </Link>
            </div>
        </template> -->

        <template v-slot:konten>
            <div class="form-control mb-2">
                <div class="input-group">
                    <input
                        type="text"
                        v-model="search.value"
                        placeholder="Search…"
                        class="input input-bordered"
                    />
                    <button class="btn btn-square">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Value</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data, index) in harga" :key="index">
                            <td>{{ data.nama }}</td>
                            <td>{{ data.value }}%</td>
                            <td class="text-white flex flex-row">
                                <a href="#modal-edit">
                                    <label
                                        @click="edit(data.id)"
                                        class="flex justify-center items-center modal-button w-24 bg-blue-500 hover:bg-blue-400 capitalize h-8 rounded-lg mr-2"
                                    >
                                        <i
                                            class="fa-solid fa-pen-to-square pr-2"
                                        ></i
                                        >edit
                                    </label>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>
        <template v-slot:modals>
            <div class="modal" id="modal-edit">
                <div class="modal-box">
                    <h2 class="font-bold text-lg">Edit Harga</h2>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">{{ formedit.nama }}</span>
                        </label>
                        <input
                            v-model="formedit.value"
                            type="text"
                            placeholder="value..."
                            class="input input-bordered"
                        />
                            <span class="label-text text-red-500" v-if="errors.value">{{ errors.value }}</span>
                    </div>
                    <div class="modal-action">
                        <button
                            class="btn bg-green-500 btn-square loading"
                            v-if="formedit.processing"
                        ></button>
                        <a
                            v-else
                            class="btn bg-green-500 hover:bg-green-400 text-white border-0"
                            @click="submitedit"
                            >Save</a
                        >
                        <a href="#" class="btn">Exit</a>
                    </div>
                </div>
            </div>
                        <a href="#" hidden id="submit">Exit</a>
        </template>
    </blankVue>
</template>
<script>
import { useForm } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";
import blankVue from "../Template/blank.vue";

export default {
    components: {
        blankVue,
    },
    props: {
        harga: Array,
        flash: Object,
        errors: Object,
    },
    data() {
        return {
            alert_success: null,
            alert_warning: null,
            alert_danger: null,
        };
    },
    updated() {
        if (this.flash.alert) {
            if (this.flash.alert["type"] == "success") {
                this.alert_success = this.flash.alert["message"];
                setTimeout(() => (this.alert_success = null), 5000);
            }
            if (this.flash.alert["type"] == "warning") {
                this.alert_warning = this.flash.alert["message"];
                setTimeout(() => (this.alert_warning = null), 5000);
            }
            if (this.flash.alert["type"] == "danger") {
                this.alert_danger = this.flash.alert["message"];
                setTimeout(() => (this.alert_danger = null), 5000);
            }
        }
    },
    setup() {
        const formedit = useForm({
            id: null,
            nama: null,
            value: null,
        });
        function klik(){
            document.getElementById('submit').click()
        }
        function submitedit() {
            formedit.put(route("masterharga.update", { harga: formedit.id }),{
                onSuccess : ()=>{
                    klik();formedit.reset();
                }
            });
        }
        const search = reactive({
            value: "",
        });
        return {
            formedit,
            submitedit,
            search,
        };
    },
    methods: {
        edit(id) {
            var data;
            this.harga.filter((items) => {
                if (items.id == id) {
                    data = items;
                }
            });
            this.formedit.id = data.id;
            this.formedit.nama = data.nama;
            this.formedit.value = data.value;
        },
    },
};
</script>
<style lang=""></style>
