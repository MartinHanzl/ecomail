<script setup lang="ts">
import {computed} from "vue";

const props = defineProps({
  color: {
    type: String,
    default: 'gray'
  }
});

const baseClasse = 'inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset';

const colorClass = computed(() => {
  switch (props.color) {
    case 'high':
      return 'bg-red-50 text-red-700 ring-red-600/10';
    case 'medium':
      return 'bg-yellow-50 text-yellow-800 ring-yellow-600/20';
    case 'low':
      return 'bg-green-50 text-green-700 ring-green-600/20';
    default:
      return 'bg-gray-50 text-gray-600 ring-gray-500/10';
  }
});

const fullClass = computed(() => {
  return `${baseClasse} ${colorClass.value}`;
});
</script>
<template>
  <span :class="fullClass"><slot/></span>
</template>
