<script setup lang="ts">
defineProps({
  color: {
    type: String,
    default: 'primary'
  },
})
</script>

<template>
<button type="button" :class="[color === 'primary' ? 'bg-green-600 text-white shadow-xs hover:bg-green-500 focus-visible:outline-green-600' : 'bg-white hover:bg-green-500 focus-visible:outline-green-600', 'inline-flex justify-center cursor-pointer rounded-md px-3 py-2 text-sm font-semibold focus-visible:outline-2 focus-visible:outline-offset-2 sm:col-start-2 border border-green-500']">
  <slot />
</button>
</template>
