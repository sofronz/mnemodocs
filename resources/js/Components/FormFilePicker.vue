<script setup>
import { mdiUpload } from '@mdi/js'
import { computed, ref, watch } from 'vue'
import BaseButton from '@/Components/BaseButton.vue'

const props = defineProps({
  modelValue: {
    type: [Object, File, Array],
    default: null,
  },
  label: {
    type: String,
    default: null,
  },
  icon: {
    type: String,
    default: mdiUpload,
  },
  accept: {
    type: String,
    default: null,
  },
  color: {
    type: String,
    default: 'info',
  },
  fileName: {
    type: String,
    default: null,
  },
  isRoundIcon: Boolean,
})

const emit = defineEmits(['update:modelValue'])

const root = ref(null)
const selectedFile = ref(props.modelValue) // local preview file

// Sync perubahan dari luar ke dalam komponen
watch(() => props.modelValue, (value) => {
  selectedFile.value = value

  // reset input jika file dihapus dari parent
  if (!value && root.value?.input) {
    root.value.input.value = null
  }
})

// Upload handler
const upload = (event) => {
  const value = event.target.files || event.dataTransfer.files
  const file = value[0]

  selectedFile.value = file
  emit('update:modelValue', file)
}

const showFilename = computed(() => {
  return !props.isRoundIcon && (selectedFile.value || props.fileName)
})
</script>

<template>
  <div class="flex items-stretch justify-start relative">
    <label class="inline-flex">
      <BaseButton as="a" :class="{ 'w-12 h-12': isRoundIcon, 'rounded-r-none': showFilename }"
        :icon-size="isRoundIcon ? 24 : undefined" :label="isRoundIcon ? null : label" :icon="icon" :color="color"
        :rounded-full="isRoundIcon" />
      <input ref="root" type="file"
        class="absolute top-0 left-0 w-full h-full opacity-0 outline-hidden cursor-pointer -z-1" :accept="accept"
        @input="upload" />
    </label>
  
    <div v-if="showFilename"
      class="px-4 py-2 bg-gray-100 dark:bg-slate-800 border-gray-200 dark:border-slate-700 border rounded-r">
      <span class="text-ellipsis line-clamp-1">
        {{ props.fileName && !selectedFile ? props.fileName : selectedFile?.name }}
      </span>
    </div>
  </div>
</template>