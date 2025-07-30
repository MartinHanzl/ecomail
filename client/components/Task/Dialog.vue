<script setup lang="ts">
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import BaseButton from '../Base/Button.vue'
import BaseInput from '../Form/Input.vue'
import BaseSelect from '../Form/Select.vue'
import { Form } from 'vee-validate';

import 'vue3-toastify/dist/index.css';

const open = defineModel('open', {
  type: Boolean,
  default: false
})

const task = defineModel('task', {
  type: Object,
  default: () => ({
    title: '',
    priority: 'medium',
    due_date: ''
  })
})

const emit = defineEmits(['saveTask']);
</script>

<template>
  <div>
    <TransitionRoot as="template" :show="open">
      <Dialog class="relative z-10" @close="open = false">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-500/75 transition-opacity" />
        </TransitionChild>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
          <Form class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0" @submit="emit('saveTask', task)">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
              <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <div>
                  <div class="mt-3 text-center sm:mt-5">
                    <DialogTitle as="h3" class="text-lg font-semibold text-gray-900">Přidat úkol</DialogTitle>
                    <div class="mt-2 space-y-4">
                      <BaseInput v-model="task.title" label="Název úkolu" name="title" />
                      <BaseSelect v-model="task.priority" label="Priorita" name="priority" />
                      <BaseInput v-model="task.due_date" label="Datum splnění" name="dueDate" type="date" />
                    </div>
                  </div>
                </div>
                <div class="mt-5 sm:mt-6 sm:flex gap-x-4">
                  <BaseButton class="col-span-1 w-full" type="submit">
                    Přidat úkol
                  </BaseButton>
                  <BaseButton class="col-span-1 w-full" color="secondary" @click="open=false">
                    Zrušit
                  </BaseButton>
                </div>
              </DialogPanel>
            </TransitionChild>
          </Form>
        </div>
      </Dialog>
    </TransitionRoot>
  </div>
</template>
