<template lang="">
    <div class="h-screen w-screen bg-cyan-600 flex justify-center items-center">
        <div
            class="hp:h-4/6 hp:w-10/12 tablet:h-4/6 tablet:w-10/12 desktop:h-5/6 desktop:w-9/12  duration-1000 relative bg-white bg-opacity-95 rounded-3xl shadow-xl overflow-hidden"
            data-aos="zoom-in" data-aos-duration="1000"
        >
            <div class="absolute z-0 h-full w-full justify-end flex">
                <div
                    class="hp:w-5/6 tablet:w-4/6 desktop:w-1/2 h-full flex justify-center items-center"
                >
                    <form
                        @submit.prevent="form.post(route('login.store'))"
                        class="hp:scale-75 hp:w-10/12 tablet:scale-90 tablet:w-7/12 desktop:scale-100 desktop:w-8/12"
                    >
                        <label
                            for=""
                            class="text-3xl border-b-2 text-center flex text-slate-600 justify-center w-full flex-col"
                        >
                            <p class="font-semibold uppercase w-full p-3">
                                sign in
                            </p>
                            <p
                                class="text-sm uppercase text-slate-300 font-semibold"
                            >
                                sign in your account
                            </p>
                        </label>
                        <div class="">
                            <div
                                v-if="danger"
                                class="alert bg-red-400 shadow-lg mb-2"
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
                                    <span class="capitalize">{{
                                        danger
                                    }}</span>
                                </div>
                            </div>
                            <label class="pl-2 text-md">
                                <p
                                    class="drop-shadow-md shadow-slate-400 w-max text-slate-500 font-semibold"
                                >
                                    Username
                                </p>
                            </label>
                            <div
                                class="form-control my-2 text-black shadow-md shadow-slate-400 rounded-lg"
                            >
                                <input
                                    v-model="form.username"
                                    type="text"
                                    placeholder="Username..."
                                    class="input h-9 w-full text-black input-bordered placeholder:text-slate-400 bg-white"
                                />
                            </div>
                        </div>
                        <div class="">
                            <label class="pl-2 text-md">
                                <p
                                    class="drop-shadow-md shadow-slate-400 w-max text-slate-500 font-semibold"
                                >
                                    Password
                                </p>
                            </label>
                            <div
                                class="form-control my-2 text-black shadow-md shadow-slate-400 rounded-lg"
                            >
                                <input
                                    v-model="form.password"
                                    type="password"
                                    placeholder="Input your password..."
                                    class="input h-9 w-full text-black input-bordered placeholder:text-slate-400 bg-white"
                                />
                            </div>
                        </div>
                        <div class="border-b-2 pb-5 mb-5 mt-9">
                            <div
                                class="flex justify-center text-xs w-full text-slate-500 font-semibold"
                            >
                                Don't have a account?
                                <Link
                                    class="ml-1 hover:text-cyan-400 text-cyan-500"
                                    :href="route('register')"
                                    >Sign up</Link
                                >
                            </div>
                        </div>

                        <div class="w-full flex justify-center">
                            <button
                                type="submit"
                                class="capitalize bg-cyan-400 text-white h-10 w-28 rounded-2xl"
                            >
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div
                class="hp:-translate-x-2/4 tablet:-translate-x-1/3 desktop:-translate-x-1/2 h-full w-full"
            >
                <div
                    class=" absolute z-10 bg-cyan-500 shadow-lg shadow-slate-500 h-full w-11/12 rounded-full bg-opacity-70"
                    data-aos="fade-right" data-aos-duration="2000"
                >
                    <div
                        class="bg-cyan-600 shadow-md shadow-slate-600 h-full w-11/12 rounded-full bg-opacity-50"
                        data-aos="fade-right" data-aos-duration="2000"
                    ></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {},
    props: ['danger'],
    setup() {
        const form = useForm({
            password: null,
            username: null,
        });

        return { form };
    },
};
</script>
<style lang=""></style>
