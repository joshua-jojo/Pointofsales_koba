<template lang="">
    <blankVue>
        <template v-slot:title>
            <title>Data User | Point Of Sales</title>
        </template>
        <template v-slot:breadcrumbs>
            <ul>
                <li><a>System</a></li>
                <li><a>Data User</a></li>
                <li></li>
            </ul>
        </template>
        <template v-slot:konten>defaultcontent</template>
    </blankVue>
</template>
<script>
import blankVue from "../Template/blank.vue";

export default {
    components: {
        blankVue,
    },
};
</script>
<style lang=""></style>
