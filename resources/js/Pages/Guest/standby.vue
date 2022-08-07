<template lang="">
    <div
        class="w-screen h-max bg-gradient-to-br from-blue-600 via-cyan-400 to-cyan-500 p-2"
    >
        <Link :href="route('tambahpesan',{id:this.id})">
            <button class="w-max p-2 bg-blue-400 rounded-xl mb-2">
                Tambah Pesanan
            </button>
        </Link>
        <div class="overflow-x-auto">
            <table class="table w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr v-for="data in datas">
                        <th>{{ data.nama }}</th>
                        <td>{{ data.status }}</td>
                    </tr>
                </tbody>
            </table>

            <table class="table w-full mt-3">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr v-for="data in datas">
                        <th>{{ data.nama }}</th>
                        <td>{{ data.status }}</td>
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
    data() {
        return {
            datas: this.pemesanan,
        };
    },
    mounted() {
        console.log(this.id);
        setInterval(
            () =>
                axios
                    .get(route("guestupdate", { guest: this.id }))
                    .then((response) => {
                        this.datas = [];
                        this.datas = response.data.data;
                    }),
            4000
        );
    },
};
</script>
<style lang=""></style>
