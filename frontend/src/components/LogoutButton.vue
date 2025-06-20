<script setup>
import Button from "primevue/button";
import axiosClient from "../axios.js";
import useUserStore from "../stores/user.js";

const userStore = useUserStore()

function logout() {
  axiosClient.post('/logout').then(() => {
    userStore.user = null;
  })
}
</script>

<template>
  <Button @click.prevent="logout" label="Logout" severity="danger" variant="text"/>
</template>

<style scoped>

</style>