<script setup>
import useUserStore from "../stores/user.js";
import {computed, onMounted, ref} from "vue";
import {InputText} from "primevue";
import Button from "primevue/button";
import {MegaMenu} from "primevue";
import useCartStore from "../stores/cart.js";

const userStore = useUserStore()
const user = computed(() => userStore.user)
const cartStore = useCartStore()

onMounted(() => {
  if (user) cartStore.fetchCart()
})

const isVisible = ref(false)
</script>

<template>
  <MegaMenu class="fixed w-full px-28 py-4 bg-surface-0 z-10" style="border-radius: 3rem"
            pt:start:class="w-2/3 space-x-8">
    <template #start>
      <a href="/" class="text-3xl">Home</a>
      <InputText label="Search" name="search" placeholder="Search" class="w-full"/>
    </template>
    <template #end>

      <div v-if="cartStore.items" @mouseout="isVisible = false" @mouseover="isVisible = true">
        <Button :label="'Cart ' + (cartStore.count === null ? '' : cartStore.count)" variant="text"
                icon="pi pi-cart-arrow-down" class="relative"/>
        <div v-show="isVisible" class="absolute flex flex-col border bg-white">
          <div v-for="item in cartStore.items" class="flex justify-between items-center space-x-8 border-b pr-4">
            <Button variant="text" icon="pi pi-trash" class="text-red-500 w-1/5"/>
            <a :href="`/products/${item.product.id}`"
               class="text-xs w-2/3 hover:text-amber-900">{{ item.product.name + ': ' + item.quantity }}</a>
            <span class="font-bold">{{ item.price }}</span>
          </div>
          <div class="flex justify-between items-center space-x-8 border-b p-4">
            <span class="text-lg">Total: {{ cartStore.total }}</span>
            <Button asChild v-slot="slotProps" severity="primary" class="w-full">
              <RouterLink :to="{name: 'CartShow'}" :class="slotProps.class">Cart
              </RouterLink>
            </Button>
          </div>
        </div>

      </div>

      <Button v-if="user" :label="'Hi, ' + user.username" variant="text" icon="pi pi-user"/>
      <Button v-else asChild v-slot="slotProps" variant="text">
        <RouterLink :to="{name: 'Login'}" :class="slotProps.class">Login</RouterLink>
      </Button>
    </template>
  </MegaMenu>
</template>

<style scoped>

</style>