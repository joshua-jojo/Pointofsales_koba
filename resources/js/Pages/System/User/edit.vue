<template lang="">
    <blankVue>
        <template v-slot:breadcrumbs>
            <ul>
                <li><a>System</a></li>
                <li><a>User</a></li>
                <li><a>Edit</a></li>
                <li></li></ul
        ></template>
        <template v-slot:konten>
            <form
                class="w-full h-full mb-5"
                @submit.prevent.submit="submit(this.user.id)"
            >
                <h3 class="font-bold text-lg mb-1">Nama</h3>
                <input
                    type="text"
                    v-model="form.nama"
                    placeholder="Type here"
                    class="input input-bordered w-full"
                />
                <h3 class="font-bold text-lg mb-1">Username</h3>
                <input
                    type="text"
                    v-model="form.username"
                    placeholder="Type here"
                    class="input input-bordered w-full"
                />
                <div class="capitalize text-red-400" v-if="errors.username">{{ errors.username }}</div>
                <h3 class="font-bold text-lg mb-1">Email</h3>
                <input
                    type="text"
                    v-model="form.email"
                    placeholder="Type here"
                    class="input input-bordered w-full"
                />
                <div class="capitalize text-red-400" v-if="errors.email">{{ errors.email }}</div>
                <h3 class="font-bold text-lg mb-1">Password</h3>
                <input
                    type="text"
                    v-model="form.password"
                    placeholder="Type here"
                    class="input input-bordered w-full"
                />
                <h3 class="font-bold text-lg mb-1 capitalize">Role</h3>
                <select
                    class="select select-bordered w-full mb-2"
                    name="kategori"
                    v-model="form.role"
                >
                    <option value="admin">admin</option>
                    <option value="waitress">waitress</option>
                    <option value="cashier">cashier</option>
                    <option value="barista">barista</option>
                    <option value="cook">cook</option>
                </select>
                <div class="modal-action">
                    <button
                        :disabled="form.processing"
                        type="submit"
                        class="btn bg-green-500 text-white hover:bg-green-400 border-0"
                    >
                        Save
                    </button>
                    <Link :href="route('systemuser.index')">
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
        errors: Object,
        user: Object,
    },
    setup() {
        const form = useForm({
            nama: null,
            email: null,
            username: null,
            role: null,
            password: null,
        });

        function submit(id){
            form.put(route('systemuser.update',{user:id}))
        }

        return { form, submit };
    },
    mounted() {
        this.form.nama = this.user.nama
        this.form.username = this.user.username
        this.form.password = this.user.password
        this.form.email = this.user.email
        this.form.role = this.user.role
    },
};
</script>
<style lang=""></style>
