<template lang="">
    <div class="h-screen w-screen bg-cyan-600 flex justify-center items-center">
        <div
            class="
            hp:h-4/6
            hp:w-10/12 
            tablet:h-4/6
            tablet:w-10/12 
            desktop:h-5/6
            desktop:w-9/12
            relative  bg-white bg-opacity-95 rounded-3xl shadow-xl overflow-hidden"
            data-aos="zoom-in" data-aos-duration="1000"
        >
            <div class="absolute z-0 h-full w-full justify-end flex">
                <div class="
                hp:w-5/6
                tablet:w-4/6
                desktop:w-1/2
                h-full  flex justify-center items-center">
                    <form class="
                    hp:scale-75
                    hp:w-11/12
                    tablet:scale-75
                    tablet:w-7/12
                    desktop:scale-100
                    desktop:w-8/12
                    ">
                        <label
                            for=""
                            class="text-3xl border-b-2 text-center flex text-slate-600 justify-center w-full flex-col"
                        >
                            <p class="font-semibold uppercase w-full p-3">
                                sign up
                            </p>
                            <p
                                class="text-sm uppercase text-slate-300 font-semibold"
                            >
                                sign up your account
                            </p>
                        </label>
                        <div class="-mt-3">
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
                                    type="text"
                                    placeholder="example@example.com"
                                    class="input h-9 w-full text-black input-bordered placeholder:text-slate-400 bg-white"
                                />
                            </div>
                        </div>
                        <div class="-mt-5">
                            <label class="pl-2 text-md">
                                <p
                                    class="drop-shadow-md shadow-slate-400 w-max text-slate-500 font-semibold"
                                >
                                    Email
                                </p>
                            </label>
                            <div
                                class="form-control my-2 text-black shadow-md shadow-slate-400 rounded-lg"
                            >
                                <input
                                    type="email"
                                    placeholder="example@example.com"
                                    class="input h-9 w-full text-black input-bordered placeholder:text-slate-400 bg-white"
                                />
                            </div>
                        </div>
                        <div class="-mt-5">
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
                                Already have an account ?
                                <Link class="ml-1 hover:text-cyan-400 text-cyan-500" :href="route('login')">Sign in</Link>
                            </div>
                        </div>

                        <div class="w-full flex justify-center">
                            <button
                                class="capitalize bg-cyan-400 text-white h-10 w-28 rounded-2xl"
                            >
                                register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="
            hp:-translate-x-2/4
            tablet:-translate-x-1/3
            desktop:-translate-x-1/3
            h-full w-full">
                <div
                    class=" absolute z-10 bg-cyan-500 shadow-lg shadow-slate-500 h-full w-3/4 rounded-full bg-opacity-70" data-aos="fade-right" data-aos-duration="1000"
                >
                    <div
                        class="bg-cyan-600 shadow-md shadow-slate-600 h-full w-11/12 rounded-full bg-opacity-50"
                        data-aos="fade-right" data-aos-duration="1000"
                    ></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    components: { 
    },
    props: {
        
    },
};
</script>
<style lang=""></style>
