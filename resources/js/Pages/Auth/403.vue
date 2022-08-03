<template lang="">
    <div class="w-screen h-screen p-10">
        <div class="flex justify-center items-center flex-col w-full h-full">
            <div class="uppercase text-7xl">akses ditolak!</div>
            <div class="uppercase text-2xl">
                anda telah melanggar hak akses sistem. silahkan login kembali!
            </div>
            <Link :href="route('login.index')">
                <div
                    class="mt-5 w-32 h-16 bg-black flex justify-center items-center uppercase text-white"
                >
                    login
                </div>
            </Link>
        </div>
    </div>
</template>
<script>
export default {};
</script>
<style lang=""></style>
