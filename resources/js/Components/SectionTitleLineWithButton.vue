<script setup>
import { mdiCog } from '@mdi/js'
import { useSlots, computed } from 'vue'
import BaseIcon from '@/Components/BaseIcon.vue'
import BaseButton from '@/Components/BaseButton.vue'
import IconRounded from '@/Components/IconRounded.vue'

defineProps({
  icon: {
    type: String,
    default: null,
  },
  title: {
    type: String,
    required: true,
  },
  labelButton: {
    type: String,
    required: true,
  },
  route: {
    type: String,
    required: true,
  },
  showButton: {
    type: Boolean,
    default: true, // default tetap muncul
  },
  main: Boolean,
})

const hasSlot = computed(() => useSlots().default)
</script>

<template>
  <section :class="{ 'pt-6': !main }" class="mb-6 flex items-center justify-between">
    <div class="flex items-center justify-start">
      <IconRounded v-if="icon && main" :icon="icon" color="light" class="mr-3" bg />
      <BaseIcon v-else-if="icon" :path="icon" class="mr-2" size="20" />
      <h1 :class="main ? 'text-3xl' : 'text-2xl'" class="leading-tight">
        {{ title }}
      </h1>
    </div>
    <slot v-if="hasSlot" />
    <BaseButton v-else-if="showButton" :label="labelButton" :to="route" :icon="icon" color="whiteDark" />
  </section>
</template>
