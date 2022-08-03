<template>
    <div id="chart">
        <apexcharts :options="options" :series="series"></apexcharts>
    </div>
</template>

<script>
import VueApexCharts from "vue3-apexcharts";

export default {
    components: {
        apexcharts: VueApexCharts,
    },
    props:['title','datax','datay','keterangan'],
    data: function () {
        return {
            options: {
                chart: {
                    type: "area",
                    height: "auto",
                },
                xaxis: {
                    categories: this.datax,
                },
                title: {
                    text: this.title,
                    align: "left",
                },
            },
            series: [
                {
                    name: this.keterangan,
                    data: this.datay,
                },
            ],
        };
    },
};
</script>
