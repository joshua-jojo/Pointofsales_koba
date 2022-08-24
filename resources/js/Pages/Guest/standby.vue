<template lang="">
    <div
        class="w-screen h-max bg-gradient-to-br from-blue-600 via-cyan-400 to-cyan-500 p-2"
    >
        <Link :href="route('tambahpesan', { id: this.id })">
            <button class="w-max p-2 bg-blue-300 rounded-xl mb-2">
                Tambah Pesanan
            </button>
        </Link>
        <div class="overflow-x-auto">
            <table class="table w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th></th>
                        <th>Nama</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr v-for="data in datas" :key="data.id">
                        <th>
                            <img
                                :src="data.gambar"
                                class="w-16 h-16 mask mask-squircle"
                            />
                        </th>
                        <th>{{ data.nama }}</th>
                        <td>
                            <div
                                class="badge bg-red-500 border-0 text-white w-20"
                                v-if="data.status == 'habis'"
                            >
                                {{ data.status }}
                            </div>
                            <div
                                class="badge bg-green-500 border-0 text-white w-20"
                                v-if="data.status == 'selesai'"
                            >
                                {{ data.status }}
                            </div>
                            <div
                                class="badge bg-yellow-500 border-0 text-white w-20"
                                v-if="data.status == 'diproses'"
                            >
                                {{ data.status }}
                            </div>
                            <div
                                class="badge bg-gray-500 border-0 text-white w-20"
                                v-if="data.status == 'antri'"
                            >
                                {{ data.status }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        pemesanan: Array,
        id: String,
    },
    setup() {
        const pemberitahuan = [];
        return {
            pemberitahuan,
        };
    },
    data() {
        return {
            datas: this.pemesanan,
        };
    },
    mounted() {
        setInterval(
            () =>
                axios
                    .get(route("guestupdate", { guest: this.id }))
                    .then((response) => {
                        this.datas = [];
                        this.datas = response.data.data;
                    }),
            10000
        );
    },
};
</script>
<style lang=""></style>
