<script setup>

import {onMounted, ref} from "vue";
import axiosClient from "../../axios.js";
import Paginator from 'primevue/paginator';

const products = ref()
const totalPages = ref()
const currentPage = ref()
const perPage = ref(10)

onMounted(() => {
  getProducts()
})

function getProducts(page = 1) {
  axiosClient.get(`/api/products?page=${page}`)
      .then(res => {
        products.value = res.data.data
        totalPages.value = res.data.meta.total
        currentPage.value = res.data.meta.current_page
        perPage.value = res.data.meta.per_page
        console.log(res.data)
      })
}
function changePage(event) {
  console.log('current: ' + currentPage.value)
  console.log(event.page)
  getProducts(event.page + 1)
}
</script>

<template>
<div v-if="products" class="grid">
  <div v-for="product in products">{{ product.name }}</div>
  <Paginator @page="changePage" :totalRecords="totalPages" :rows="perPage"/>
</div>
</template>

<style scoped>

</style>