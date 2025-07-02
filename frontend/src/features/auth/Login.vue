<script setup>
import AuthLayout from "../../components/AuthLayout.vue";
import {InputText} from "primevue";
import Button from "primevue/button";
import {Message} from "primevue";
import {ref} from "vue";
import axiosClient from "../../axios.js";
import router from "../../router.js";

const formData = ref({
  email: '',
  password: ''
})
const errors = ref({})

function login() {
  axiosClient.get('/sanctum/csrf-cookie').then(() => {
    axiosClient.post('/login', formData.value)
        .then(() => {
          router.push({name: 'Home'})
        })
        .catch(err => {
          errors.value = err.response.data.errors
        })
  })
}
</script>

<template>
  <AuthLayout>
    <h1 class="text-xl mb-8">Login</h1>
    <div class="flex flex-col align-middle items-center space-y-4 mb-8">
      <div class="flex flex-col gap-1">
        <InputText v-model="formData.email" name="email" type="email" placeholder="Email" fluid/>
        <Message v-if="errors.email" severity="error" size="small" variant="simple">
          {{ errors.email[0] }}
        </Message>
      </div>
      <div class="flex flex-col gap-1">
        <InputText v-model="formData.password" name="password" type="password" placeholder="Password" fluid/>
        <Message v-if="errors.password" severity="error" size="small" variant="simple">
          {{ errors.password[0] }}
        </Message>
      </div>
      <Button @click.prevent="login" type="submit" severity="secondary" label="Submit">Login</Button>
    </div>
    <span class="text-sm text-gray-600">Don't have an account? <a href="/register" class="underline">Register</a></span>
  </AuthLayout>
</template>

<style scoped>

</style>