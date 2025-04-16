<script setup>
import { computed, ref } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import { mdiFileExport, mdiFileDownload } from '@mdi/js'
import CardBoxModal from '@/Components/CardBoxModal.vue'
import BaseLevel from '@/Components/BaseLevel.vue'
import BaseButtons from '@/Components/BaseButtons.vue'
import BaseButton from '@/Components/BaseButton.vue'
import PillTag from '@/Components/PillTag.vue'
import CardBoxComponentEmpty from '@/Components/CardBoxComponentEmpty.vue'

const props = defineProps({
  checkable: Boolean,
})

// Ambil data dataExports dari Laravel
const page = usePage()
const dataExports = computed(() => page.props.dataExports.data)
const selectedData = ref(null)
const isModalExport = ref(false)

const openExportModal = (dataExport) => {
  selectedData.value = dataExport
  isModalExport.value = true
}

const handleExport = () => {
  if (!selectedData.value) return

  router.post(route('dashboard.request'), {
    type: selectedData.value.type,
  }, {
    onSuccess: () => {
      isModalExport.value = false
      selectedData.value = null
    },
  })
}
</script>

<template>
  <CardBoxModal v-model="isModalExport" title="Please confirm" button-label="Confirm" button="info" has-cancel
    @confirm="handleExport">
    <p>Are you sure to export this data? <b>{{ selectedData?.name || 'this item' }}</b></p>
  </CardBoxModal>
  
  <div v-if="dataExports.length === 0">
    <CardBoxComponentEmpty />
  </div>
  <div v-else>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th />
        </tr>
      </thead>
      <tbody>
        <tr v-for="dataExport in dataExports" :key="dataExport.id">
          <td>
            <span>
              {{ dataExport.name }}
            </span>
            <PillTag v-if="dataExport.status == 'PROGRESS'" label="procesing.." class="ms-3" color="info" :small="true"
              :outline="false" />
          </td>
          <td>
            <BaseButtons type="justify-start lg:justify-end" no-wrap>
              <BaseButton v-if="dataExport.status == 'NONE' || dataExport.status == 'DONE'" color="info"
                :icon="mdiFileExport" small @click="() => openExportModal(dataExport)" />
              <BaseButton v-if="dataExport.status == 'DONE'" :href="dataExport.download" color="success" :icon="mdiFileDownload"
                small />
            </BaseButtons>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
