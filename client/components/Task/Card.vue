<script setup lang="ts">
import dayjs from 'dayjs';
import BaseButton from '../Base/Button.vue';
import TaskBadge from './Badge.vue';
import { CheckIcon } from "@heroicons/vue/24/outline";

const model = defineModel('task', {
  type: Object,
  required: true
});

const emit = defineEmits(['markComplete']);

function formatPriority(priority: string): string {
  switch (priority) {
    case 'high':
      return 'Vysoká';
    case 'medium':
      return 'Střední';
    case 'low':
      return 'Nízká';
    default:
      return 'Neznámá';
  }
}
</script>

<template>
  <div class="bg-white shadow rounded-lg p-4 grid grid-cols-1 lg:grid-cols-3 items-center">
    <div class="col-span-1">
      <h2 class="text xl lg:text-2xl font-semibold mb-2 text-primary">{{ task.title }}</h2>
      <p v-if="task.due_date" class="text-gray-700 text-xs lg:text-base mb-4 lg:mb-0">Úkol je třeba vyřešit do: <span class="text-red-700 font-medium">{{ dayjs(task.due_date).format('D. M. YYYY') }}</span></p>
    </div>
    <div class="col-span-1 lg:text-center">
      <TaskBadge :color="task.priority">{{ formatPriority(task.priority) }}</TaskBadge>
    </div>
    <div class="col-span-1 text-right">
      <BaseButton @click="emit('markComplete', task)" class="inline-flex justify-center items-center h-full" ><CheckIcon class="h-4 lg:h-6"></CheckIcon></BaseButton>
    </div>
  </div>
</template>
