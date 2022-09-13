<template lang="">
    <label
        :for="'my-modal' + id"
        class="btn btn-ghost btn-sm btn-info modal-button w-full h-full"
        >Detail</label
    >
    <div>
        <!-- The button to open modal -->

        <!-- Put this part before </body> tag -->
        <Teleport to="#modal_stage">
            <input type="checkbox" :id="'my-modal' + id" class="modal-toggle" />
            <div class="modal">
                <div class="modal-box scrollbar-hide">
                    <h3 class="font-bold text-lg">
                        {{ produk.nama }}
                    </h3>
                    <div class="justify-center w-full flex p-5">
                        <img
                            :src="produk.gambar"
                            class="rounded-xl w-3/4 desktop:w-10/20 tablet:w-9/20"
                        />
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table w-full table-compact">
                            <!-- head -->
                            <thead>
                                <tr></tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <tr class="active">
                                    <th>Nama</th>
                                    <td>{{ produk.nama }}</td>
                                </tr>
                                <tr class="active">
                                    <th>Harga</th>
                                    <td>Rp. {{ produk.harga }}</td>
                                </tr>
                                <tr class="active">
                                    <th>Keterangan</th>
                                    <td v-if="produk.keterangan">
                                        {{ produk.keterangan }}
                                    </td>
                                    <td v-else>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-action">
                        <slot name="action"></slot>
                        <label :for="'my-modal' + id" class="btn">Close</label>
                    </div>
                </div>
            </div>
        </Teleport>
    </div>
</template>
<script>
export default {
    props: {
        id: Number,
        produk: Object,
    },
};
</script>
<style lang=""></style>
