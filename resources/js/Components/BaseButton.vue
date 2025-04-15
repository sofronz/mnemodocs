<script setup>
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'
import { getButtonColor } from '@/colors.js'
import BaseIcon from '@/Components/BaseIcon.vue'

const props = defineProps({
  label: [String, Number],
  icon: String,
  iconSize: [String, Number],
  href: String,
  target: String,
  to: [String, Object],
  type: String,
  color: {
    type: String,
    default: 'white',
  },
  as: String,
  small: Boolean,
  outline: Boolean,
  active: Boolean,
  disabled: Boolean,
  roundedFull: Boolean,
})

const emit = defineEmits(['click']) // <-- Penting: biar bisa emit ke luar

const is = computed(() => {
  if (props.type === 'submit' || props.type === 'reset') return 'button'
  if (props.as) return props.as
  return 'a'
})

const computedType = computed(() => (is.value === 'button' ? props.type ?? 'button' : null))

const labelClass = computed(() => (props.small && props.icon ? 'px-1' : 'px-2'))

const componentClass = computed(() => {
  const base = [
    'inline-flex',
    'justify-center',
    'items-center',
    'whitespace-nowrap',
    'focus:outline-hidden',
    'transition-colors',
    'focus:ring-3',
    'duration-150',
    'border',
    props.disabled ? 'cursor-not-allowed' : 'cursor-pointer',
    props.roundedFull ? 'rounded-full' : 'rounded-sm',
    getButtonColor(props.color, props.outline, !props.disabled, props.active),
  ]

  if (!props.label && props.icon) {
    base.push('p-1')
  } else if (props.small) {
    base.push('text-sm', props.roundedFull ? 'px-3 py-1' : 'p-1')
  } else {
    base.push('py-2', props.roundedFull ? 'px-6' : 'px-3')
  }

  if (props.disabled) {
    base.push(props.outline ? 'opacity-50' : 'opacity-70')
  }

  return base
})

function handleClick(e) {
  if (props.disabled) {
    e.preventDefault()
    return
  }

  if (props.to && computedType.value !== 'submit' && computedType.value !== 'reset') {
    e.preventDefault()
    router.visit(props.to)
  }

  emit('click', e) // <-- Emit ke luar, biar @click di luar tetap kepanggil
}
</script>

<template>
  <component
    :is="is"
    :class="componentClass"
    :href="href || (typeof to === 'string' ? to : null)"
    :type="computedType"
    :target="target"
    :disabled="disabled"
    @click="handleClick"
    v-bind="$attrs"
  >
    <BaseIcon v-if="icon" :path="icon" :size="iconSize" />
    <span v-if="label" :class="labelClass" v-html="label" />
  </component>
</template>