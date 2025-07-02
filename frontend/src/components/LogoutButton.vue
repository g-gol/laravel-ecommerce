<script setup>
import Button from "primevue/button";
import axiosClient from "../axios.js";
import useUserStore from "../stores/user.js";
import useCartStore from "../stores/cart.js";

const userStore = useUserStore()
const cartStore = useCartStore()

function logout() {
  axiosClient.post('/logout').then(() => {
    userStore.user = null;
    cartStore.unsetCart()
  })
}
</script>

<template>
  <Button @click.prevent="logout" label="Logout" severity="danger" variant="text"/>
</template>

<style scoped>

</style>