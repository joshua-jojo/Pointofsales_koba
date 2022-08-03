<template lang="">
    <div class="modal modal-middle sm:modal-middle" id="{{id}}">
        <div class="modal-box">
            <form class="w-full h-full">
                <h3 class="font-bold text-lg mb-1">{{title}}</h3>
                <input
                    type="text"
                    placeholder="Type here"
                    class="input input-bordered w-full"
                />
                <div class="modal-action">
                    <a
                        href="#"
                        class="btn bg-green-500 text-white hover:bg-green-400 border-0"
                    >
                        Save
                    </a>
                    <a href="#" class="btn">Exit</a>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    props:['title','id']
};
</script>
<style lang=""></style>
