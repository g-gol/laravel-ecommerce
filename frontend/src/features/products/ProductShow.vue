<script setup>

import {onMounted, ref} from "vue";
import {useRoute} from "vue-router";
import axiosClient from "../../axios.js";

const product = ref()

onMounted(() => {
  getProduct()
})
const route = useRoute()

function getProduct() {
  axiosClient.get(`/api/products/${route.params.id}`)
      .then(res => {
        product.value = res.data.data
      })
}
</script>

<template>
  <div v-if="product" class="flex flex-col my-16 space-y-8 mx-auto rounded-sm w-3/4">
    <div class="flex text-3xl justify-between">
      <h1 class="">{{ product.name }}</h1>
    </div>
    <div class="p-2">
      <div class="rounded max-w-1/2">
        <img :src="product.image" alt="main image" class="h-96 object-fill rounded">
      </div>
    </div>
    <div class="flex justify-between">
      <span>Price: {{ product.price }}</span>
    </div>
    <p>{{ product.description }}</p>
    <span>Reviews</span>
  </div>
</template>

<style scoped>

</style>