<script setup>
import { computed, ref } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import { mdiSquareEditOutline, mdiTrashCan } from '@mdi/js'
import CardBoxModal from '@/Components/CardBoxModal.vue'
import BaseLevel from '@/Components/BaseLevel.vue'
import BaseButtons from '@/Components/BaseButtons.vue'
import BaseButton from '@/Components/BaseButton.vue'
import PillTag from '@/Components/PillTag.vue'
import CardBoxComponentEmpty from '@/Components/CardBoxComponentEmpty.vue'

const props = defineProps({
  checkable: Boolean,
})

// Ambil data roles dari Laravel
const page = usePage()
const selectedRole = ref(null)
const roles = computed(() => page.props.roles.data) // <-- ambil isi data paginasi
const pagination = computed(() => page.props.roles.meta) // semua info paginasi

const isModalDangerActive = ref(false)

const openDeleteModal = (role) => {
  selectedRole.value = role
  isModalDangerActive.value = true
}

const handleDelete = () => {
  if (!selectedRole.value) return

  router.delete(route('roles.delete', { id: selectedRole.value.id }), {
    onSuccess: () => {
      isModalDangerActive.value = false
      selectedRole.value = null
    },
  })
}
</script>

<template>
  <CardBoxModal v-model="isModalDangerActive" title="Please confirm" button-label="Confirm" button="danger" has-cancel
    @confirm="handleDelete">
    <p>Are you sure to delete this data? <b>{{ selectedRole?.name || 'this item' }}</b></p>
  </CardBoxModal>
  
  <div v-if="roles.length === 0">
    <CardBoxComponentEmpty />
  </div>
  <div v-else>
    <table>
      <thead>
        <tr>
          <th />
          <th>Name</th>
          <th>Description</th>
          <th>Status</th>
          <th>Created</th>
          <th />
        </tr>
      </thead>
      <tbody>
        <tr v-for="role in roles" :key="role.id">
          <td></td>
          <td>{{ role.name }}</td>
          <td>{{ role.description }}</td>
          <td>
            <PillTag :label="role.status == 1 ? 'active' : 'inactive'" :color="role.status == 1 ? 'success' : 'danger'"
              :small="true" :outline="false" />
          </td>
          <td>
            <small class="text-gray-500 dark:text-slate-400">
              {{ role.created_at }}
            </small>
          </td>
          <td>
            <BaseButtons type="justify-start lg:justify-end" no-wrap>
              <template v-if="!role.is_deleted">
                <BaseButton color="info" :icon="mdiSquareEditOutline" :to="route('roles.edit', { id: role.id })" small />
                <BaseButton color="danger" :icon="mdiTrashCan" small @click="() => openDeleteModal(role)" />
              </template>
              <template v-if="role.is_deleted">
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
          <BaseButton v-for="(link, index) in pagination.links" :key="index" :label="link.label" :disabled="!link.url"
            :color="link.active ? 'lightDark' : 'whiteDark'" @click="$inertia.visit(link.url)" small />
        </BaseButtons>
        <small>
          Page {{ pagination.current_page }} of {{ pagination.last_page }}
        </small>
      </BaseLevel>
    </div>
  </div>
</template>
