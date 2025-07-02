<script setup>

import {onMounted, ref} from "vue";
import axiosClient from "../../../axios.js";
import {Listbox} from "primevue";

const emit = defineEmits(['categoryChanged'])
onMounted(() => {
  getCategories()
})
const categories = ref()
const selected = ref([]);

function getCategories() {
  axiosClient.get('/api/categories')
      .then(res => {
        categories.value = res.data.data
      })
}

function changed(event) {
  emit('categoryChanged', event.value)
}
</script>

<template>
  <div class="col-span-2 flex flex-col">
    <h2 class="text-xl mb-8">Filters</h2>
    <div v-if="categories" class="flex flex-col items-start mb-2">
      <h3 class="mb-2">Category</h3>
      <Listbox @change="changed" v-model="selected" :options="categories" optionValue="id" optionLabel="name"
               class="w-full md:w-56"/>
    </div>
  </div>
</template>

<style scoped>

</style>