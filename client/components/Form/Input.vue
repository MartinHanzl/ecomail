<script setup lang="ts">
import { Field } from 'vee-validate';
const model = defineModel( {
  type: String,
  required: true
});

defineProps({
  label: {
    type: String,
    default: 'Název úkolu'
  },
  type: {
    type: String,
    default: 'text'
  },
  name: {
    type: String,
    default: 'email'
  }
})
</script>
<template>
  <div>
    <label for="email" class="block text-sm/6 text-left font-medium text-gray-900">{{ label }}</label>
    <div class="mt-2">
      <Field v-model="model" :type="type" :name="name" :id="name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-green-600 sm:text-sm/6" />
    </div>
  </div>
</template>
