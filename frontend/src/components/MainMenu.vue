<script setup>
import useUserStore from "../stores/user.js";
import {computed} from "vue";
import {InputText} from "primevue";
import Button from "primevue/button";
import {MegaMenu} from "primevue";

const userStore = useUserStore()
const user = computed(() => userStore.user)
</script>

<template>
  <MegaMenu class="w-full p-4 bg-surface-0" style="border-radius: 3rem" pt:start:class="w-2/3 space-x-8" >
    <template #start>
      <a href="/" class="text-3xl">Home</a>
      <InputText label="Search" name="search" placeholder="Search" class="w-full"/>
    </template>
    <template #end>
      <Button v-if="user" :label="'Hi, ' + user.username" variant="text" icon="pi pi-user"/>
      <Button v-else asChild v-slot="slotProps" variant="text">
        <RouterLink :to="{name: 'Login'}" :class="slotProps.class">Login</RouterLink>
      </Button>
      <Button label="Cart" variant="text" icon="pi pi-cart-arrow-down"/>
    </template>
  </MegaMenu>
</template>

<style scoped>

</style>