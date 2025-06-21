<script setup>
import MainMenu from "./MainMenu.vue";

</script>

<template>
  <div class="grid grid-cols-7">
    <div class="col-span-5 col-start-2 flex flex-col mx-auto w-full items-center">
      <MainMenu/>
      <RouterView/>
    </div>
  </div>
</template>

<style scoped>

</style>