<script setup lang="ts">
import dayjs from 'dayjs';
import BaseButton from '../Base/Button.vue';
import TaskBadge from './Badge.vue';
import { CheckIcon } from "@heroicons/vue/24/outline";

const model = defineModel('task', {
  type: Object,
  required: true
});

const emit = defineEmits(['delete', 'markComplete']);

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
  <div class="bg-white shadow rounded-lg p-4 flex flex-row justify-between items-center">
    <div>
      <h2 class="text-2xl font-semibold mb-2">{{ task.title }}</h2>
      <p v-if="task.due_date" class="text-gray-700">Úkol je třeba vyřešit do: <span class="text-red-700 font-medium">{{ dayjs(task.due_date).format('d. m. YYYY') }}</span></p>
    </div>
    <TaskBadge :color="task.priority">{{ formatPriority(task.priority) }}</TaskBadge>
    <BaseButton @click="emit('markComplete', task)" class="inline-flex justify-center items-center h-full" ><CheckIcon class="h-6"></CheckIcon></BaseButton>
  </div>
</template>
