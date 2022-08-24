<template lang="">
    <div
        class="flex items-center w-full h-full font-semibold text-3xl ml-8 text-white drop-shadow-lg" data-aos="fade-in" data-aos-duration="300"
    >
        {{ title.nama }}
    </div>
</template>
<script>
import axios from "axios";
import { reactive } from "vue";

export default {
    setup() {
        const title = reactive({
            nama: null,
        });
        axios.get(route("apisettings")).then((data) => {
            title.nama = data["data"][0].nama;
        });
        return {
            title,
        };
    },
    updated() {
        axios.get(route("apisettings")).then((data) => {
            this.title.nama = data["data"][0].nama;
        });
    },
    mounted() {
        axios.get(route("apisettings")).then((data) => {
            this.title.nama = data["data"][0].nama;
        });
    },
};
</script>
<style lang=""></style>
