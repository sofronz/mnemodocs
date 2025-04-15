<script setup>
import { computed, ref } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import CardBoxComponentEmpty from '@/Components/CardBoxComponentEmpty.vue'

const props = defineProps({
  checkable: Boolean,
})

// Ambil data audits dari Laravel
const page = usePage()
const audits = computed(() => page.props.audits.data) 
</script>

<template>
  
  <div v-if="audits.length === 0">
    <CardBoxComponentEmpty />
  </div>
  <div v-else>
    <table>
      <thead>
        <tr>
          <th>User</th>
          <th>Event</th>
          <th>Old Values</th>
          <th>New Values</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="audit in audits" :key="audit.id">
          <td>{{ audit.user }}</td>
          <td>{{ audit.event }}</td>
          <td><pre>{{ JSON.stringify(audit.old_values, null, 2) }}</pre></td>
          <td><pre>{{ JSON.stringify(audit.new_values, null, 2) }}</pre></td>
          <td>
            <small class="text-gray-500 dark:text-slate-400">
              {{ audit.created_at }}
            </small>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
