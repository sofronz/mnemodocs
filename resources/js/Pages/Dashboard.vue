<script setup>
import { computed, ref, onMounted } from 'vue'
import { Head } from '@inertiajs/vue3'
import { useMainStore } from '@/Stores/main'
import * as chartConfig from '@/Components/Charts/chart.config.js'
import SectionMain from '@/Components/SectionMain.vue'
import CardBoxWidget from '@/Components/CardBoxWidget.vue'
import BaseButton from '@/Components/BaseButton.vue'
import CardBoxTransaction from '@/Components/CardBoxTransaction.vue'
import CardBoxClient from '@/Components/CardBoxClient.vue'
import TableExports from '@/Components/TableExports.vue'
import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue'
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue'
import { mdiMonitor } from '@mdi/js'
import FlashMessage from '@/Components/FlashMessage.vue'
import CardBox from '@/Components/CardBox.vue'

const chartData = ref(null)

const fillChartData = () => {
  chartData.value = chartConfig.sampleChartData()
}

onMounted(() => {
  fillChartData()
})

const mainStore = useMainStore()

const clientBarItems = computed(() => mainStore.clients.slice(0, 4))

const transactionBarItems = computed(() => mainStore.history)
</script>

<template>
    <LayoutAuthenticated>
        <Head title="Dashboard" />
    
        <SectionMain>
            <FlashMessage />

            <SectionTitleLineWithButton :icon="mdiMonitor" title="Dashboard" :show-button="false" main />
    
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 mb-6">
                <CardBoxWidget trend="12%" trend-type="up" color="text-emerald-500" :icon="mdiAccountMultiple" :number="512"
                    label="Clients" />
                <CardBoxWidget trend="12%" trend-type="down" color="text-blue-500" :icon="mdiCartOutline" :number="7770"
                    prefix="$" label="Sales" />
                <CardBoxWidget trend="Overflow" trend-type="alert" color="text-red-500" :icon="mdiChartTimelineVariant"
                    :number="256" suffix="%" label="Performance" />
            </div>
    
            <CardBox class="mt-6 mb-6" has-table>
                <TableExports />
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>