<script setup>
import { defineProps, ref } from 'vue'
import { useForm, Head } from "@inertiajs/vue3";
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
import FormFilePicker from '@/Components/FormFilePicker.vue'

const props = defineProps({
  document: {
    type: Object,
    required: false,
  },
  categories: {
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
  title: props.document?.data?.title || '',
  description: props.document?.data?.description || '',
  status: props.isEdit ? ref(props.document.data.status) : ref(true),
  file: null,
  category: props.document?.data?.category?.id || ''
})

// Submit handler
const submit = () => {
  form.transform((data) => {
    const formData = new FormData()

    formData.append('title', data.title)
    formData.append('description', data.description)
    formData.append('status', data.status ? 1 : 0)
    formData.append('category', data.category)

    if (data.file instanceof File) {
      formData.append('file', data.file)
    }

    // Spoofing method PUT agar Laravel bisa terima
    if (props.isEdit) {
      formData.append('_method', 'PUT')
    }

    return formData
  })

  form.post(
    props.isEdit
      ? route('documents.update', props.document.data.id)
      : route('documents.store'),
    {
      forceFormData: true,
      preserveScroll: true,
    }
  )
}
</script>

<template>
  <LayoutAuthenticated>
  
    <Head :title="isEdit ? 'Edit Document' : 'Create Document'" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiAccountGroup" :title="isEdit ? 'Edit Document' : 'Create Document'"
        :show-button="false" main />
      <form @submit.prevent="submit">
        <CardBox>
          <FormField label="Title" :help="props.errors?.title ? props.errors?.title : ''">
            <FormControl v-model="form.title" placeholder="Enter the title" />
          </FormField>
  
          <FormField label="Description" :help="props.errors?.description ? props.errors?.description : ''">
            <FormControl type="textarea" v-model="form.description" placeholder="Enter the description" />
          </FormField>
  
          <FormField label="Category" :help="props.errors?.category ? props.errors?.category : ''">
            <FormControl v-model="form.category" :options="categories" placeholder="Select Categories" />
            <FormCheckRadioGroup v-model="form.status" name="status-switch" type="switch"
              :options="{ active: 'Active' }" />
          </FormField>
  
          <FormField label="File" :help="props.errors?.file ? props.errors?.file : ''">
            <FormFilePicker v-model="form.file" label="Upload" accept="application/pdf"
              :fileName="props.isEdit ? props.document.data.file.name : null" />
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