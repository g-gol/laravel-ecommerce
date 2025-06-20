<script setup>
import Button from "primevue/button";
import {InputText} from "primevue";
import useUserStore from "../stores/user.js";
import {computed} from "vue";

const userStore = useUserStore()
const user = computed(() => userStore.user)
</script>

<template>
  <div class="grid grid-cols-7">
    <div class="col-span-5 col-start-2 flex flex-col mx-auto w-full items-center">
      <div class="w-full flex justify-between px-4 py-2">
        <div class="flex justify-between space-x-20 w-2/3 items-center align-middle">
          <a href="/" class="text-3xl">Home</a>
          <InputText label="Search" name="search" placeholder="Search" class="w-full"/>
        </div>

        <div class="flex justify-between space-x-2 items-end align-middle">
          <Button :label="'Hi, ' + user.username" variant="text" icon="pi pi-user"/>
          <Button label="Cart" variant="text" icon="pi pi-user"/>
        </div>
      </div>
      <slot/>
    </div>
  </div>
</template>

<style scoped>

</style>