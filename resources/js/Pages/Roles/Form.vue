<script setup>
import { defineProps, ref } from 'vue'
import { mdiViewList } from '@mdi/js'
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
import { useForm, Head } from "@inertiajs/vue3";

const props = defineProps({
  role: {
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
  name: props.role?.data?.name || '',
  description: props.role?.data?.description || '',
  status: props.isEdit ? ref(props.role.data.status) : ref(true),
})

// Submit handler
const submit = () => {
  if (props.isEdit) {
    form.put(route('roles.update', props.role.data.id)) // Update jika mode edit
  } else {
    form.post(route('roles.store')) // Create jika mode baru
  }
}
</script>

<template>
    <LayoutAuthenticated>
        <Head :title="isEdit ? 'Edit Role' : 'Create Role'" />
        <SectionMain>
            <SectionTitleLineWithButton 
                :icon="mdiViewList" 
                :title="isEdit ? 'Edit Role' : 'Create Role'"
                :show-button="false" 
                main 
            />
            <form @submit.prevent="submit">
                <CardBox>
                    <FormField label="Name" :help="props.errors?.name ? props.errors?.name : ''">
                        <FormControl v-model="form.name" placeholder="Enter the name" />
                        <FormCheckRadioGroup 
                            v-model="form.status" 
                            name="status-switch" 
                            type="switch" 
                            :options="{ active: 'Active' }" 
                        />
                    </FormField>

                    <BaseDivider />

                    <FormField label="Description" :help="props.errors?.description ? props.errors?.description : ''">
                        <FormControl 
                            type="textarea" 
                            v-model="form.description" 
                            placeholder="Enter the description" 
                        />
                    </FormField>

                    <template #footer>
                        <BaseButtons>
                            <!-- <button type="submit">Submit</button> -->
                            <BaseButton type="submit" color="info" label="Submit" />
                            <BaseButton type="reset" color="info" outline label="Reset" />
                        </BaseButtons>
                    </template>
                </CardBox>
            </form>
        </SectionMain>
    </LayoutAuthenticated>
</template>