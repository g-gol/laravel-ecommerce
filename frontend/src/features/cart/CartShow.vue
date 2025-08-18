<script setup>

import { onMounted, ref } from "vue";
import axiosClient from "../../axios.js";
import { DataView } from "primevue";
import { InputNumber } from "primevue";
import Button from "primevue/button";
import useCartStore from "../../stores/cart.js";
import { computed } from "vue";

const cartStore = useCartStore()
const cart = ref();
onMounted(() => {
  fetchCart()
})

function fetchCart() {
  axiosClient.get(`/api/cart`).then(res => {
    res.data.data.items.forEach(item => {
      item.selected = true
    })

    cart.value = res.data.data
  })
}

const totalPrice = computed(() => {
  if (!cart.value || !cart.value.items) return 0


  const selected = cart.value.items.filter(item => {
    return item.selected
  })

  return selected.reduce((acc, item) => {
    return acc + (item.price * item.quantity)
  }, 0)
})

function removeItem(id) {
  cartStore.removeItem(id)
    .then(() => {
      fetchCart()
    })
}

function addItem(productId) {
  cartStore.addToCart(productId)
    .then(() => {
      fetchCart()
    })
}
function decrease(productId) {
  cartStore.addToCart(productId, -1)
    .then(() => {
      fetchCart()
    })
}

</script>

<template>
  <div class="w-full grid grid-cols-8 mt-24">
    <div class="col-span-6 px-8">
      <DataView v-if="cart" :value="cart.items">
        {{ cart.items }}
        <template #list="slotProps">
          <div class="flex flex-col">
            <div v-for="(item, index) in slotProps.items" :key="index">
              <div class="flex flex-col sm:flex-row sm:items-center p-6 gap-4"
                :class="{ 'border-t border-surface-200 dark:border-surface-700': index !== 0 }">
                <div class="md:w-40 relative">
                  <img class="block xl:block mx-auto rounded w-full" :src="item.product.image"
                    :alt="item.product.name" />
                  <div class="absolute bg-black/70 rounded-border" style="left: 4px; top: 4px">
                    <span class="text-white">Status</span>
                  </div>
                </div>
                <div class="flex flex-col md:flex-row justify-between md:items-center flex-1 gap-6">
                  <div class="flex flex-row md:flex-col justify-between items-start gap-2">
                    <div>
                      <span class="font-medium text-surface-500 dark:text-surface-400 text-sm">Category</span>
                      <div class="text-lg font-medium mt-2">{{ item.product.name }}</div>
                    </div>
                    <div class="bg-surface-100 p-1" style="border-radius: 30px">
                      <div class="bg-surface-0 flex items-center gap-2 justify-center py-1 px-2"
                        style="border-radius: 30px; box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.04), 0px 1px 2px 0px rgba(0, 0, 0, 0.06)">
                        <Button icon="pi pi-minus" variant="text" @click="decrease(item.product.id)" class="p-1 w-6 h-6"
                          :disabled="item.quantity <= 1" />

                        <InputNumber v-model="item.quantity" :inputId="'horizontal-buttons' + item.id"
                          buttonLayout="horizontal" fluid style="width: 3rem" :step="1" mode="decimal" :min="1"
                          :max="item.product.amount" size="small">

                          <div class="p-inputnumber-button p-inputnumber-increment-button">
                            <span class="pi pi-plus" />
                          </div>

                        </InputNumber>
                        <Button icon="pi pi-plus" variant="text" @click="addItem(item.product.id)" class="p-1 w-6 h-6"
                          :disabled="item.product.amount <= item.quantity" />
                      </div>
                    </div>
                  </div>
                  <div class="flex flex-col md:items-end gap-8">
                    <span class="text-xl font-semibold">${{ item.price }}</span>
                    <div class="flex items-center flex-row-reverse md:flex-row gap-2">
                      <input type="checkbox" v-model="item.selected" :id="'item-' + item.id" class="w-4 h-4" />
                      <Button @click.prevent="removeItem(item.id)" variant="text" icon="pi pi-trash"
                        class="text-red-500" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </template>
      </DataView>
    </div>

    <div class="col-span-2 flex flex-col space-y-8 px-8 border-l border-l-gray-300">
      <h1 class="font-bold text-xl">Order</h1>

      <h2>Total Price: <span class="font-bold">{{ totalPrice }}</span></h2>


      <Button :disabled="totalPrice <= 0">Checkout</Button>
    </div>
  </div>
</template>

<style scoped></style>
