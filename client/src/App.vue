<script setup>
import { onMounted } from 'vue';
import { ref } from 'vue'
import BaseHeading from './../components/Base/Heading.vue'
import TaskDialog from './../components/Task/Dialog.vue'
import BaseButton from './../components/Base/Button.vue'
import TaskCard from './../components/Task/Card.vue'
import { toast } from 'vue3-toastify';

const isDialogOpen = ref(false);
const tasks = ref([]);

function loadTasks() {
  fetch('http://localhost:8000/api/task')
    .then(response => response.json())
    .then(data => {
      tasks.value = data;
      // Here you would typically set the tasks to a reactive variable
    })
    .catch(error => {
      toast("Nepodařilo se načíst úkoly.", {
        autoClose: 5000,
        type: 'error',
      });
    });
}

function saveTask(task) {
  fetch('http://localhost:8000/api/task', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(task)
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      toast("Úkol byl úspěšně uložen.", {
        autoClose: 5000,
        type: 'success',
      });
      loadTasks();
      isDialogOpen.value = false; // Close the dialog after saving
    })
    .catch(error => {
      toast("Nepodařilo se uložit úkol.", {
        autoClose: 5000,
        type: 'error',
      });
    });
}
onMounted(() => {
  loadTasks();
});
</script>
<template>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
      <BaseHeading>TODO List</BaseHeading>
      <BaseButton @click="isDialogOpen=true" class="mt-4">Přidat úkol</BaseButton>
      <TaskDialog v-model:open="isDialogOpen" @save-task="saveTask($event)"/>
      <div class="mt-8 space-y-4">
        <TaskCard v-if="tasks && tasks.length > 0" v-for="task in tasks" :key="task.id" :task="task" />
      </div>
    </div>
</template>
