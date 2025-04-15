<script setup>
import { mdiMonitorCellphone, mdiPalette, } from '@mdi/js'
import { ref } from 'vue'
import { router, Head } from '@inertiajs/vue3'
import SectionMain from '@/Components/SectionMain.vue'
import FlashMessage from '@/Components/FlashMessage.vue'
import TableCategories from '@/Components/TableCategories.vue'
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
  router.get(route('categories.index'), {
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
  
    <Head title="Categories" />
  
    <SectionMain>
      <FlashMessage />
  
      <SectionTitleLineWithButton :icon="mdiPalette" :label-button="'Create Category'" :route="route('categories.create')"
        :show-button="true" title="Categories" main>
      </SectionTitleLineWithButton>
  
      <div class="flex justify-end gap-4 mb-5">
        <FormControl v-model="search" type="text" placeholder="Search by name" />
        <FormCheckRadioGroup v-model="status" name="sample-switch" type="switch" :options="{ status: 'Active' }" />
        <FormCheckRadioGroup v-model="trashed" name="sample-switch" type="switch" :options="{ trashed: 'Deleted' }" />
        <BaseButton label="Filter" color="info" @click="applyFilter" />
      </div>
  
      <CardBox class="mb-6" has-table>
        <TableCategories />
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
