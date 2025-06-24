<script setup>
import {onMounted, ref} from "vue";
import axiosClient from "../../axios.js";
import Paginator from 'primevue/paginator';
import {Card} from "primevue";
import Button from "primevue/button";
import {Select} from "primevue";
import ProductFilters from "./components/ProductFilters.vue";

const orderOptions = ref([
  { name: 'latest' },
  { name: 'cheap' },
  { name: 'expensive' },
])

const order = ref()
const products = ref()
const totalPages = ref()
const perPage = ref(9)

onMounted(() => {
  getProducts()
})
const filters = ref({
  page: 1,
  order: null,
  category: null
})
function getProducts() {
  axiosClient.get(`/api/products`, { params: filters.value})
      .then(res => {
        products.value = res.data.data
        totalPages.value = res.data.meta.total
        perPage.value = res.data.meta.per_page
      })
}
function changeOrder() {
  filters.value.order = order.value.name
  filters.value.page = 1
  getProducts()
}

function changePage(event) {
  filters.value.page = event.page + 1
  getProducts()
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  })
}

function changeCategory(id){
  filters.value.category = id
  getProducts()
}
</script>

<template>
  <div v-if="products" class="w-full grid grid-cols-8 mt-24">
    <ProductFilters @categoryChanged="changeCategory"/>
    <div class="col-span-6 grid grid-cols-3 gap-8">
      <div class="flex justify-between items-baseline col-span-3 mb-8">
        <span>Page: {{ filters.page }}</span>
        <Select @change="changeOrder" v-model="order" :options="orderOptions" optionLabel="name" placeholder="default" class="w-full md:w-56" />
      </div>
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
    <Paginator @page="changePage" :totalRecords="totalPages" :rows="perPage" :first="(filters.page - 1) * perPage" class="col-start-2 col-span-6 mt-8"/>
  </div>

</template>

<style scoped>

</style>