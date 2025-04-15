<script setup>
import { defineProps, ref } from 'vue'
import { mdiAccountGroup } from '@mdi/js'
import SectionMain from '@/Components/SectionMain.vue'
import CardBox from '@/Components/CardBox.vue'
import FormField from '@/Components/FormField.vue'
import FormControl from '@/Components/FormControl.vue'
import BaseDivider from '@/Components/BaseDivider.vue'
import BaseButton from '@/Components/BaseButton.vue'
import BaseButtons from '@/Components/BaseButtons.vue'
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue'
import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue'
import FormCheckRadioGroup from '@/Components/FormCheckRadioGroup.vue'
import TableAudits from '@/Components/TableAudits.vue'
import { useForm, Head } from "@inertiajs/vue3";

const props = defineProps({
  user: {
    type: Object,
    required: false,
  },
  roles: {
    type: Object,
    required: false,
  },
  isEdit: {
    type: Boolean,
    default: false,
  },
  errors: Object
})

// Form Setup
const form = useForm({
  name: props.user?.data?.name || '',
  email: props.user?.data?.email || '',
  password: '',
  role: props.user?.data?.role?.id || ''
})

// Submit handler
const submit = () => {
  if (props.isEdit) {
    form.put(route('users.update', props.user.data.id)) // Update jika mode edit
  } else {
    form.post(route('users.store')) // Create jika mode baru
  }
}
</script>

<template>
  <LayoutAuthenticated>
  
    <Head :title="isEdit ? 'Edit User' : 'Create User'" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiAccountGroup" :title="isEdit ? 'Edit User' : 'Create User'"
        :show-button="false" main />
      <form @submit.prevent="submit">
        <CardBox>
          <FormField label="Name" :help="props.errors?.name ? props.errors?.name : ''">
            <FormControl v-model="form.name" placeholder="Enter the name" />
          </FormField>

          <FormField label="Email" :help="props.errors?.email ? props.errors?.email : ''">
            <FormControl v-model="form.email" type="email" placeholder="Enter the email" />
          </FormField>
  
          <FormField label="Role" :help="props.errors?.role ? props.errors?.role : ''">
            <FormControl v-model="form.role" :options="roles" placeholder="Select Roles" />
          </FormField>
  
          <FormField label="Password" :help="props.errors?.password ? props.errors?.password : ''">
            <FormControl v-model="form.password" type="password" placeholder="Enter the Password" />
          </FormField>
  
          <BaseDivider />
  
          <template #footer>
            <BaseButtons>
              <!-- <button type="submit">Submit</button> -->
              <BaseButton type="submit" color="info" label="Submit" />
              <BaseButton type="reset" color="info" outline label="Reset" />
            </BaseButtons>
          </template>
        </CardBox>
      </form>
  
      <template v-if="isEdit">
        <CardBox class="mt-6" has-table>
          <TableAudits />
        </CardBox>
      </template>
    </SectionMain>
  </LayoutAuthenticated>
</template>