<template>
  <div>
    <div class="container mx-auto mt-10 h-screen">
      <div class="flex items-center justify-center">
        <div class="w-full max-w-md">
          <form
            method="POST"
            @submit.prevent="login"
            class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4"
          >
            <!-- @csrf -->
            <div
              class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4"
            >
              Silahkan Login
            </div>
            <div v-if="erro"
              class="bg-red-200 border border-red-200 text-red-800 pl-4 pr-8 py-3 rounded relative"
              role="alert"
            >
              <strong class="font-bold">{{ erro }}!, </strong>
              <span class="block sm:inline"
                >email atau password salah</span
              >
            </div>
            <div class="mb-4">
              <label
                class="block text-gray-700 text-sm font-normal mb-2"
                for="username"
              >
                Email
              </label>
              <input
                class="shadow appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-teal-500"
                name="email"
                v-model="form.email"
                type="email"
                required
                autofocus
                placeholder="Email"
              />
              <!-- @error('email')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror -->
            </div>
            <div class="mb-6">
              <label
                class="block text-gray-700 text-sm font-normal mb-2"
                for="password"
              >
                Password
              </label>
              <input
                class="shadow appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:border-teal-500"
                v-model="form.password"
                type="password"
                placeholder="Password"
                name="password"
                required
                autocomplete="current-password"
              />
              <!-- @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror -->
            </div>
            <div class="flex items-center justify-between">
              <div>
                <button
                  class="px-4 py-2 rounded text-white inline-block shadow-lg bg-teal-500 hover:bg-teal-600 focus:bg-teal-700"
                  type="submit"
                >
                  Login
                </button>
                <router-link
                  class="px-4 py-2 rounded text-white inline-block shadow-lg bg-blue-500 hover:bg-blue-600 focus:bg-blue-700"
                  to="/signup"
                  >SignUp</router-link
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
        email: null,
        password: null,
      },
      erro: null,
    }
  },
  created() {
    if (User.loggedIn()) {
      this.$router.push({ name: "forum" })
    }
  },
  methods: {
    // login() {
    //   User.login(this.form)
    //   // this.$router.push({name: 'forum'})
    // },
    login() {
      axios
        .post("/api/auth/login", this.form)
        .then((res) => User.responseAfterLogin(res))
        // .then(res => console.log(res.data))
        .catch((err) => (this.erro = err.response.data.error))
    },
  },
}
</script>

<style>
</style>