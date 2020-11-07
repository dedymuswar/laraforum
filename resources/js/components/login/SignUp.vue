<template>
  <div>
    <div class="container mx-auto mt-10 h-screen">
      <div class="flex items-center justify-center">
        <div class="w-full max-w-md">
          <form
            method="POST"
            @submit.prevent="signup"
            class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4"
          >
            <!-- @csrf -->
            <div
              class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4"
            >
              Register
            </div>
            <div class="mb-4">
              <label
                class="block text-gray-700 text-sm font-normal mb-2"
                for="username"
              >
                Username
              </label>
              <input
                class="shadow appearance-none border-2 rounded w-full py-2 px-3 mb-1 text-gray-700 leading-tight focus:outline-none focus:border-teal-500"
                name="email"
                v-model="form.name"
                type="text"
                autofocus
                placeholder="Username"
              />
              <p class="text-red-500 text-xs italic" v-if="errors.name">
                {{ errors.name[0] }}
              </p>
            </div>
            <div class="mb-4">
              <label
                class="block text-gray-700 text-sm font-normal mb-2"
                for="username"
              >
                Email
              </label>
              <input
                class="shadow appearance-none border-2 rounded w-full mb-1 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-teal-500"
                name="email"
                v-model="form.email"
                type="email"
                autofocus
                placeholder="Email"
              />
              <p class="text-red-500 text-xs italic" v-if="errors.email">
                {{ errors.email[0] }}
              </p>
            </div>
            <div class="mb-4">
              <label
                class="block text-gray-700 text-sm font-normal mb-2"
                for="password"
              >
                Password
              </label>
              <input
                class="shadow appearance-none border-2 rounded mb-1 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-teal-500"
                v-model="form.password"
                type="password"
                placeholder="Password"
                name="password"
                autocomplete="current-password"
              />
              <p class="text-red-500 text-xs italic" v-if="errors.password">
                {{ errors.password[0] }}
              </p>
            </div>
            <div class="mb-6">
              <label
                class="block text-gray-700 text-sm font-normal mb-2"
                for="password"
              >
                Confirm Password
              </label>
              <input
                class="shadow appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:border-teal-500"
                v-model="form.password_confirmation"
                name="confirm_password"
                id="confirm_password"
                type="password"
                placeholder="Password"
                autocomplete="confirm password"
              />
            </div>
            <div class="flex items-center justify-between">
              <div>
                <button
                  class="px-4 py-2 rounded text-white inline-block shadow-lg bg-blue-500 hover:bg-blue-600 focus:bg-blue-700"
                  type="submit"
                >
                  Sign Up
                </button>
                <router-link
                  class="px-4 py-2 rounded text-white inline-block shadow-lg bg-teal-500 hover:bg-teal-600 focus:bg-teal-700"
                  to="/login"
                  >Login</router-link
                >
              </div>
              <a
                class="inline-block align-baseline font-normal text-sm text-blue-500 hover:text-blue-800"
                href="#"
              >
                Forgot Password?
              </a>
            </div>
          </form>
          <p class="text-center text-gray-500 text-xs">
            &copy;2020 Gau Corp. All rights reserved.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      },
      errors: {},
    }
  },
  created() {
    if (User.loggedIn()) {
      this.$router.push({ name: "forum" })
    }
  },
  methods: {
    signup() {
      axios
        .post("/api/auth/signup", this.form)
        .then((res) => {
          User.responseAfterLogin(res)
          this.$router.push({ name: "forum" })
        })
        .catch((err) => (this.errors = err.response.data.errors))
    },
  },
}
</script>

<style>
</style>