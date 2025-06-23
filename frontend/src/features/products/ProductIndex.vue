<script setup>
import {onMounted, ref} from "vue";
import axiosClient from "../../axios.js";
import Paginator from 'primevue/paginator';
import {Card} from "primevue";
import Button from "primevue/button";

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
  <div v-if="products" class="w-full grid grid-cols-8 mt-24">
    <div class="col-span-2">
      filters
    </div>
    <div class="col-span-6 grid grid-cols-3 gap-8">
      <Card v-for="product in products" style="overflow: hidden" pt:title:class="truncate">
        <template #header>
          <img class="h-52 w-full object-cover" alt="image" :src="product.image"/>
        </template>
        <template #title>{{ product.name }}</template>
        <template #subtitle>{{ product.price }}</template>
        <template #content>
          <p class="m-0 text-xs min-h-48">
            {{ product.excerpt }}
          </p>
        </template>
        <template #footer>
          <div class="flex justify-between gap-4 mt-1">
            <Button asChild v-slot="slotProps" variant="text" severity="secondary" outlined class="w-full">
              <RouterLink :to="{name: 'ProductShow', params: {id: product.id}}" :class="slotProps.class">See more</RouterLink>
            </Button>
            <Button label="Buy" />
          </div>
        </template>
      </Card>
    </div>
    <Paginator @page="changePage" :totalRecords="totalPages" :rows="perPage" class="col-start-2 col-span-6 mt-8"/>
  </div>

</template>

<style scoped>

</style>