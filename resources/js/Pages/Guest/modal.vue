<template lang="">
    <div>
        <input type="checkbox" :id="idmodal" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box scrollbar-hide">
                <h3 class="font-bold text-lg">
                    {{titlemodal}}
                </h3>
                <p class="py-4">
                   <slot name="bodymodal"></slot>
                </p>
                <div class="modal-action">
                    <slot name="actionmodal"></slot>
                    <label :for="idmodal" class="btn btn-outline">Close</label>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props : {
        idmodal: String,
        titlemodal: String,
        classbutton: String,
    }
};
</script>
<style lang=""></style>
