<template lang="">
    <div class="stats border-2 bg-slate-200">
        <div class="stat">
            <div class="stat-title">{{title}}</div>
            <div class="stat-value">{{data}}</div>
        </div>
    </div>
</template>
<script>
export default {
    props:['title','data']
};
</script>
<style lang=""></style>
