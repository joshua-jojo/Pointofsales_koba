<template lang="">
    <!-- The button to open modal -->
    <label :for="modal_id" class="btn btn-ghost modal-button w-full h-full">{{
        modal_button
    }}</label>

    <!-- Put this part before </body> tag -->
    <Teleport to="#modal_stage">
        <input type="checkbox" :id="modal_id" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box w-11/12 max-w-5xl">
                <div class="flex justify-between">
                    <h2 class="font-bold text-lg">{{ modal_title }}</h2>
                    <div class=" flex flex-row gap-2 justify-end">
                        <slot name="modal_action"></slot>
                        <label :for="modal_id" class="btn">Close</label>
                    </div>
                </div>
                <slot name="modal_body"></slot>
            </div>
        </div>
    </Teleport>
</template>
<script>
export default {
    props: {
        modal_id: String,
        modal_title: String,
        modal_button: String,
    },
};
</script>
<style lang=""></style>
