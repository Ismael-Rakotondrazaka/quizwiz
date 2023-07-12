<template>
    <div>
        <Doughnut
            :options="chartOptions"
            :data="chartData"
            chart-id="custom-pie-chart"
            dataset-id-key="label"
            css-classes="!w-1/3"
        />
    </div>
</template>

<script setup>
import { Doughnut } from "vue-chartjs";
import { computed, ref } from "vue";

import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    PieController,
    ArcElement,
} from "chart.js";

ChartJS.register(Title, Tooltip, Legend, PieController, ArcElement);

const props = defineProps({
    easyCount: {
        type: Number,
        required: false,
        default: 0,
    },
    mediumCount: {
        type: Number,
        required: false,
        default: 0,
    },
    hardCount: {
        type: Number,
        required: false,
        default: 0,
    },
});

const chartOptions = ref({
    responsive: true,
});

const chartData = computed(() => {
    let result;

    if (props.easyCount + props.mediumCount + props.hardCount > 0) {
        result = {
            labels: ["Easy", "Medium", "Hard"],
            datasets: [
                {
                    backgroundColor: [
                        "rgb(0, 197, 105)",
                        "rgb(253 224 71)",
                        "rgb(255, 10, 84)",
                    ],
                    borderColor: ["white"],
                    data: [props.easyCount, props.mediumCount, props.hardCount],
                },
            ],
        };
    } else {
        result = {
            labels: ["Empty"],
            datasets: [
                {
                    backgroundColor: ["white"],
                    borderColor: ["black"],
                    data: [1],
                },
            ],
        };
    }

    return result;
});
</script>

<style lang="scss" scoped></style>
