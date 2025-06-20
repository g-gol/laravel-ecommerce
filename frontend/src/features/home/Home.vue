<script setup>
import useUserStore from "../../stores/user.js";
import {computed} from "vue";
import LogoutButton from "../../components/LogoutButton.vue";

const userStore = useUserStore()
const user = computed(() => userStore.user)
</script>

<template>
  <h1 class="text-xl">Hi, {{ user ? user.username : 'anon' }}</h1>
  <a href="/register">Register</a>
  <LogoutButton/>
</template>

<style scoped>

</style>