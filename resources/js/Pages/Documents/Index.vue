<script setup>
import { mdiMonitorCellphone, mdiFileDocumentCheckOutline, } from '@mdi/js'
import { ref } from 'vue'
import { router, Head } from '@inertiajs/vue3'
import SectionMain from '@/Components/SectionMain.vue'
import FlashMessage from '@/Components/FlashMessage.vue'
import TableDocuments from '@/Components/TableDocuments.vue'
import CardBox from '@/Components/CardBox.vue'
import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue'
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue'
import FormControl from '@/Components/FormControl.vue'
import FormCheckRadioGroup from '@/Components/FormCheckRadioGroup.vue'
import BaseButton from '@/Components/BaseButton.vue'

const search = ref('')
const status = ref(true)
const trashed = ref(false)

const applyFilter = () => {
  router.get(route('documents.index'), {
    search: search.value,
    status: status.value ? 1 : 0,
    trashed: trashed.value ? 1 : 0,
  }, {
    preserveState: true,
    replace: true
  })
}
</script>

<template>
  <LayoutAuthenticated>
  
    <Head title="Documents" />
  
    <SectionMain>
      <FlashMessage />
  
      <SectionTitleLineWithButton :icon="mdiFileDocumentCheckOutline" :label-button="'Create Document'" :route="route('documents.create')"
        :show-button="true" title="Documents" main>
      </SectionTitleLineWithButton>
  
      <div class="flex justify-end gap-4 mb-5">
        <FormControl v-model="search" type="text" placeholder="Search by title" />
        <FormCheckRadioGroup v-model="trashed" name="sample-switch" type="switch" :options="{ trashed: 'Deleted' }" />
        <BaseButton label="Filter" color="info" @click="applyFilter" />
      </div>
  
      <CardBox class="mb-6" has-table>
        <TableDocuments />
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
