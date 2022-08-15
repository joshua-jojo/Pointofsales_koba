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
            <table
                v-if="this.pemberitahuan.length > 0"
                class="table mt-6 w-full"
            >
                <!-- head -->
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr v-for="data in pemberitahuan">
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
                        var data = [];
                        var validate = 0;
                        this.datas.forEach((element, index, arr) => {
                            if (arr[index].status == "habis") {
                                data.push(element);
                                validate++;
                                // axios
                                //         .get(
                                //             route("delete_data", {
                                //                 id: arr[index].id,
                                //             })
                                //         )
                                //         .then((response) => {});
                            }
                        });
                        if (validate > 0) {
                            if (this.pemberitahuan.length == 0) {
                                this.pemberitahuan.push(data);
                            }
                            this.pemberitahuan.forEach(
                                (data_pemberitahuan) => {
                                    data.forEach((data_terupdate)=>{
                                        data_pemberitahuan.forEach((data_sekarang)=>{
                                            console.log(data_sekarang.id == data_terupdate.id);
                                        })
                                    })
                                }
                            );
                        }
                    }),
            10000
        );
    },
};
</script>
<style lang=""></style>
