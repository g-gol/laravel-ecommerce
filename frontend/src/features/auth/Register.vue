<script setup>
import AuthLayout from "../../components/AuthLayout.vue";
import {InputText} from "primevue";
import Button from "primevue/button";
import {Message} from "primevue";
import axiosClient from "../../axios.js";
import {ref} from "vue";
import router from "../../router.js";

const formData = ref({
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
})
const errors = ref({})

function register() {
  axiosClient.get('/sanctum/csrf-cookie').then(() => {
    axiosClient.post('/register', formData.value)
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
    <h1 class="text-xl mb-8">Register</h1>
    <div class="flex flex-col align-middle items-center space-y-4 mb-8">
      <div class="flex flex-col gap-1">
        <InputText v-model="formData.username" name="username" type="text" placeholder="Username" fluid/>
        <Message v-if="errors.username" severity="error" size="small" variant="simple">
          {{ errors.username[0] }}
        </Message>
      </div>
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
      <div class="flex flex-col gap-1">
        <InputText v-model="formData.password_confirmation" name="password_confirmation" type="password"
                   placeholder="Repeat password" fluid/>
      </div>

      <Button @click.prevent="register" type="submit" severity="secondary" label="Submit">Register</Button>
      <span class="text-sm text-gray-600">already have an account? <a href="/login" class="underline">Login</a></span>
    </div>
  </AuthLayout>
</template>

<style scoped>

</style>