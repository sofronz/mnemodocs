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

// Ambil data users dari Laravel
const page = usePage()
const selectedUser = ref(null)
const auth = computed(() => page.props.auth.user) // <-- ambil isi data paginasi
const users = computed(() => page.props.users.data) // <-- ambil isi data paginasi
const pagination = computed(() => page.props.users.meta) // semua info paginasi

const isModalDangerActive = ref(false)

const openDeleteModal = (user) => {
  selectedUser.value = user
  isModalDangerActive.value = true
}

const handleDelete = () => {
  if (!selectedUser.value) return

  router.delete(route('users.delete', { id: selectedUser.value.id }), {
    onSuccess: () => {
      isModalDangerActive.value = false
      selectedUser.value = null
    },
  })
}
</script>

<template>
  <CardBoxModal v-model="isModalDangerActive" title="Please confirm" button-label="Confirm" button="danger" has-cancel
    @confirm="handleDelete">
    <p>Are you sure to delete this data? <b>{{ selectedUser?.name || 'this item' }}</b></p>
  </CardBoxModal>
  
  <div v-if="users.length === 0">
    <CardBoxComponentEmpty />
  </div>
  <div v-else>
    <table>
      <thead>
        <tr>
          <th />
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Created</th>
          <th />
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td></td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>
            <PillTag :label="user.role.name" color="info"
              :small="true" :outline="false" />
          </td>
          <td>
            <small class="text-gray-500 dark:text-slate-400">
              {{ user.created_at }}
            </small>
          </td>
          <td>
            <BaseButtons type="justify-start lg:justify-end" no-wrap>
              <template v-if="!user.is_deleted">
                <BaseButton color="info" :icon="mdiSquareEditOutline" :to="route('users.edit', { id: user.id })" small />
              </template>
              <template v-if="!user.is_deleted && user.id != auth.id">
                <BaseButton color="danger" :icon="mdiTrashCan" small @click="() => openDeleteModal(user)" />
              </template>
              <template v-if="user.is_deleted">
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
