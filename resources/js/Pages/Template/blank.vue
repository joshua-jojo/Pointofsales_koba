<template lang="">
    <div class="z-50 absolute">
        <slot name="alert"></slot>
    </div>
    <div
        class="h-screen w-screen bg-gradient-to-br from-blue-600 via-cyan-400 to-cyan-500 overflow-auto scrollbar-hide"
    >
        <slot name="title"></slot>
        <div
            class="flex flex-row w-full p-2 pb-20 h-full"
            data-aos="fade-in"
            data-aos-duration="1000"
        >
            <div
                class="bg-white w-full h-full rounded-3xl bg-opacity-30 backdrop-blur-md flex flex-row shadow-lg shadow-cyan-600"
            >
                <div class="h-full w-1/20 flex pl-2 flex-col z-10">
                    <div
                        class="h-3/20 w-full flex justify-center items-center"
                    ></div>
                    <div
                        class="h-14/20 w-full flex items-center flex-col justify-start"
                        data-aos="fade-in"
                        data-aos-duration="1000"
                    >
                        <div class="dropdown dropdown-right">
                            <label
                                tabindex="0"
                                class="btn m-1 bg-opacity-0 hover:bg-white hover:bg-opacity-40 hover:text-black border-0 text-white"
                            >
                                <i
                                    class="fa-solid fa-house text-xl opacity-80"
                                ></i
                            ></label>
                            <ul
                                tabindex="0"
                                class="dropdown-content menu p-2 shadow-lg bg-white text-black rounded-box w-52"
                            >
                                <li class="menu-title">
                                    <span>Desktop</span>
                                </li>
                                <li class="opacity-70">
                                    <Link :href="route('beranda.index')"
                                        ><a>Beranda</a></Link
                                    >
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown dropdown-right">
                            <label
                                tabindex="0"
                                class="btn m-1 bg-opacity-0 hover:bg-white hover:bg-opacity-40 hover:text-black border-0 text-white"
                            >
                                <i
                                    class="fa-solid fa-desktop text-xl opacity-80"
                                ></i
                            ></label>
                            <ul
                                tabindex="0"
                                class="dropdown-content menu p-2 shadow-lg bg-white text-black rounded-box w-52"
                            >
                                <li class="menu-title">
                                    <span>Master</span>
                                </li>
                                <li class="opacity-70">
                                    <Link :href="route('masterkategori.index')"
                                        ><a>Kategori</a></Link
                                    >
                                </li>
                                <li class="opacity-70">
                                    <Link :href="route('mastermeja.index')"
                                        ><a>Meja</a></Link
                                    >
                                </li>
                                <li class="opacity-70">
                                    <Link :href="route('masterproduk.index')"
                                        ><a>Produk</a></Link
                                    >
                                </li>
                                <li class="opacity-70">
                                    <Link :href="route('mastersatuan.index')"
                                        ><a>Satuan</a></Link
                                    >
                                </li>
                                <li class="opacity-70">
                                    <Link :href="route('masterharga.index')"
                                        ><a>Harga</a></Link
                                    >
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown dropdown-right">
                            <label
                                tabindex="0"
                                class="btn m-1 bg-opacity-0 hover:bg-white hover:bg-opacity-40 hover:text-black border-0 text-white"
                                ><i
                                    class="fa-solid fa-money-bill-transfer text-xl opacity-80"
                                ></i
                            ></label>
                            <ul
                                tabindex="0"
                                class="dropdown-content menu p-2 shadow-lg bg-white text-black rounded-box w-52"
                            >
                                <li class="menu-title">
                                    <span>Transaksi</span>
                                </li>
                                <li class="opacity-70">
                                    <Link
                                        :href="
                                            route('transaksipemasukkan.index')
                                        "
                                        ><a>Pemasukkan</a></Link
                                    >
                                </li>
                                <li class="opacity-70">
                                    <Link
                                        :href="
                                            route('transaksipengeluaran.index')
                                        "
                                        ><a>Pengeluaran</a></Link
                                    >
                                </li>
                                <li class="opacity-70">
                                    <Link :href="route('transaksikasir.index')"
                                        ><a>Kasir</a></Link
                                    >
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown dropdown-right">
                            <label
                                tabindex="0"
                                class="btn m-1 bg-opacity-0 hover:bg-white hover:bg-opacity-40 hover:text-black border-0 text-white"
                                ><i
                                    class="fa-solid fa-box text-xl opacity-80"
                                ></i
                            ></label>
                            <ul
                                tabindex="0"
                                class="dropdown-content menu p-2 shadow-lg bg-white text-black rounded-box w-52"
                            >
                                <li class="menu-title">
                                    <span>Warehouse</span>
                                </li>
                                <li class="opacity-70">
                                    <Link
                                        :href="
                                            route('warehouseinventory.index')
                                        "
                                        ><a>Inventory</a></Link
                                    >
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown dropdown-right">
                            <label
                                tabindex="0"
                                class="btn m-1 bg-opacity-0 hover:bg-white hover:bg-opacity-40 hover:text-black border-0 text-white"
                                ><i
                                    class="fa-solid fa-gear text-xl opacity-80"
                                ></i
                            ></label>
                            <ul
                                tabindex="0"
                                class="dropdown-content menu p-2 shadow-lg bg-white text-black rounded-box w-52"
                            >
                                <li class="menu-title">
                                    <span>System</span>
                                </li>
                                <li class="opacity-70">
                                    <Link :href="route('systemuser.index')"
                                        ><a>Data User</a></Link
                                    >
                                </li>
                                <li class="opacity-70">
                                    <Link :href="route('systemsettings.index')"
                                        ><a>Settings</a></Link
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="h-full w-full flex flex-col relative">
                    <div class="w-full h-2/20">
                        <div
                            class="flex justify-start capitalize h-full w-full flex-row"
                        >
                            <titleVue></titleVue>
                            <div class="flex items-center mr-5">
                                <div class="dropdown dropdown-end">
                                    <label
                                        tabindex="0"
                                        class="btn w-max m-1 bg-opacity-0 hover:bg-white hover:bg-opacity-40 hover:text-black border-0 text-white flex flex-row"
                                    >
                                        <!-- <img
                                            src="https://picsum.photos/170/170"
                                            class="h-2/3 w-max rounded-full shadow-md shadow-cyan-600"
                                        /> -->
                                        <label class="text-md ml-2">
                                            {{ this.username }}
                                        </label>
                                    </label>
                                    <ul
                                        tabindex="0"
                                        class="dropdown-content menu p-2 shadow-lg bg-white text-black rounded-box w-52"
                                    >
                                        <li class="menu-title">
                                            <span>User</span>
                                        </li>
                                        <li class="opacity-70">
                                            <Link
                                                :href="route('login.create')"
                                                @click="logout()"
                                                ><a
                                                    ><i
                                                        class="fa-solid fa-arrow-right-from-bracket opacity-80"
                                                    ></i
                                                    >Logout</a
                                                ></Link
                                            >
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full h-2/20 pl-9">
                        <div
                            class="text-md capitalize font-semibold breadcrumbs text-white drop-shadow-md shadow-cyan-600 flex justify-between pr-4"
                            data-aos="fade-right"
                            data-aos-duration="1000"
                        >
                            <slot name="breadcrumbs"></slot>
                            <div></div>

                            <slot name="opsibutton"></slot>
                        </div>
                    </div>
                    <div
                        class="w-full h-full absolute translate-y-3/20 mt-2 pl-9 pr-4 pt-2"
                    >
                        <div
                            class="w-full h-19/20 bg-white rounded-3xl shadow-cyan-600 p-4 overflow-auto mt-2 scrollbar-hide scroll-smooth"
                            data-aos="fade-right"
                            data-aos-duration="1000"
                        >
                            <slot name="konten"></slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <slot name="modals"></slot>
</template>
<script>
import titleVue from "./title.vue";
export default {
    components: {
        titleVue,
    },
    setup() {
        const username = localStorage.getItem("username");
        return {
            username,
        };
    },
    methods: {
        logout() {
            localStorage.setItem("username", "");
        },
    },
};
</script>
<style lang=""></style>
