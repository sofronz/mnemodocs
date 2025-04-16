<script setup>
import { computed, ref } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import { mdiSquareEditOutline, mdiTrashCan, mdiFilePdfBox } from '@mdi/js'
import CardBoxModal from '@/Components/CardBoxModal.vue'
import BaseLevel from '@/Components/BaseLevel.vue'
import BaseButtons from '@/Components/BaseButtons.vue'
import BaseButton from '@/Components/BaseButton.vue'
import PillTag from '@/Components/PillTag.vue'
import CardBoxComponentEmpty from '@/Components/CardBoxComponentEmpty.vue'

const props = defineProps({
  checkable: Boolean,
})

// Ambil data documents dari Laravel
const page = usePage()
const selectedDocument = ref(null)
const documents = computed(() => page.props.documents.data) // <-- ambil isi data paginasi
const pagination = computed(() => page.props.documents.meta) // semua info paginasi

const isModalDangerActive = ref(false)

const openDeleteModal = (document) => {
  selectedDocument.value = document
  isModalDangerActive.value = true
}

const handleDelete = () => {
  if (!selectedDocument.value) return

  router.delete(route('documents.delete', { id: selectedDocument.value.id }), {
    onSuccess: () => {
      isModalDangerActive.value = false
      selectedDocument.value = null
    },
  })
}
</script>

<template>
    <CardBoxModal v-model="isModalDangerActive" title="Please confirm" button-label="Confirm" button="danger" has-cancel
        @confirm="handleDelete">
        <p>Are you sure to delete this data? <b>{{ selectedDocument?.title || 'this item' }}</b></p>
    </CardBoxModal>
    
    <div v-if="documents.length === 0">
        <CardBoxComponentEmpty />
    </div>
    <div v-else>
        <table>
            <thead>
                <tr>
                    <th />
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th />
                </tr>
            </thead>
            <tbody>
                <tr v-for="document in documents" :key="document.id">
                    <td></td>
                    <td>{{ document.title }}</td>
                    <td>{{ document.description }}</td>
                    <td>{{ document.category.name }}</td>
                    <td>
                        <PillTag :label="document.status == 1 ? 'active' : 'inactive'"
                            :color="document.status == 1 ? 'success' : 'danger'" :small="true" :outline="false" />
                    </td>
                    <td>
                        <small class="text-gray-500 dark:text-slate-400">
                            {{ document.created_at }}
                        </small>
                    </td>
                    <td>
                        <BaseButtons type="justify-start lg:justify-end" no-wrap>
                            <template v-if="!document.is_deleted">
                                <BaseButton color="warning" target="_blank" :icon="mdiFilePdfBox"
                                    :href="document.file.url" small />
                                <BaseButton color="info" :icon="mdiSquareEditOutline"
                                    :to="route('documents.edit', { id: document.id })" small />
                                <BaseButton color="danger" :icon="mdiTrashCan" small
                                    @click="() => openDeleteModal(document)" />
                            </template>
                            <template v-if="document.is_deleted">
                                <PillTag label="Deleted" color="danger" :small="true" :outline="false" />
                            </template>
                        </BaseButtons>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="p-3 lg:px-6 border-t border-gray-100 dark:border-slate-800">
            <BaseLevel>
                <BaseButtons>
                    <BaseButton v-for="(link, index) in pagination.links" :key="index" :label="link.label"
                        :disabled="!link.url" :color="link.active ? 'lightDark' : 'whiteDark'"
                        @click="$inertia.visit(link.url)" small />
                </BaseButtons>
                <small>
                    Page {{ pagination.current_page }} of {{ pagination.last_page }}
                </small>
            </BaseLevel>
        </div>
    </div>
</template>