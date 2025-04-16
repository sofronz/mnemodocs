<script setup>
import { defineProps, computed, ref, onMounted } from 'vue'
import { Head } from '@inertiajs/vue3'
import SectionMain from '@/Components/SectionMain.vue'
import CardBoxWidget from '@/Components/CardBoxWidget.vue'
import TableExports from '@/Components/TableExports.vue'
import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue'
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue'
import { mdiMonitor, mdiViewList,mdiAccountGroup, mdiFileDocumentCheckOutline, mdiPalette } from '@mdi/js'
import FlashMessage from '@/Components/FlashMessage.vue'
import CardBox from '@/Components/CardBox.vue'

const props = defineProps({
  counter: {
    type: Object,
    required: false,
  },
  errors: Object
})

</script>

<template>
    <LayoutAuthenticated>
        <Head title="Dashboard" />
    
        <SectionMain>
            <FlashMessage />

            <SectionTitleLineWithButton :icon="mdiMonitor" title="Dashboard" :show-button="false" main />
    
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-4 mb-6">
                <CardBoxWidget trend="Users" trend-type="alert" icon-color="text-blue-500" color="info" :icon="mdiAccountGroup"
                    :number="props.counter.users" :show-button="false" label="Users" />
                <CardBoxWidget trend="Roles" trend-type="alert" icon-color="text-red-500" color="danger" :icon="mdiViewList"
                    :number="props.counter.roles" :show-button="false" label="Roles" />
                <CardBoxWidget trend="Documents" trend-type="alert" icon-color="text-green-500" color="success" :icon="mdiFileDocumentCheckOutline"
                    :number="props.counter.documents" :show-button="false" label="Documents" />
                <CardBoxWidget trend="Categories" trend-type="alert" icon-color="text-yellow-500" color="warning" :icon="mdiPalette"
                    :number="props.counter.categories" :show-button="false" label="Categories" />
            </div>
    
            <CardBox class="mt-6 mb-6" has-table>
                <TableExports />
            </CardBox>
        </SectionMain>
    </LayoutAuthenticated>
</template>