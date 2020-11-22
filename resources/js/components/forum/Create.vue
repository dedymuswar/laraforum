<template>
  <div class="md:container mx-auto my-2">
    <div class="bg-white rounded">
      <form
        method="POST"
        @submit.prevent="create"
        class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4"
      >
        <div class="mb-4">
          <label
            class="block text-gray-700 text-sm font-normal mb-2"
            for="username"
          >
            Title
          </label>
          <input
            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="title"
            v-model="form.title"
            type="text"
            required
            autofocus
            placeholder="Title"
          />
        </div>
        <div class="mb-4">
          <label
            class="block text-gray-700 text-sm font-normal mb-2"
            for="username"
          >
            Category
          </label>
          <div class="relative">
            <select
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              id="grid-state"
              v-model="form.category_id"
            >
              <option
                v-for="category in categories"
                :key="category.id"
                v-bind:value="category.id"
              >
                {{ category.name }}
              </option>
            </select>
            <div
              class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
            >
              <svg
                class="fill-current h-4 w-4"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
              >
                <path
                  d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                />
              </svg>
            </div>
          </div>
        </div>
        <vue-simplemde v-model="form.body" ref="markdownEditor"/>
        <div class="flex items-center justify-between">
          <div>
            <button
              class="px-4 py-2 rounded text-white inline-block shadow-lg bg-teal-500 hover:bg-teal-600 focus:bg-teal-700"
              type="submit"
            >
              Submit
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
// import VueSimplemde from "vue-simplemde"
export default {
  // components: { VueSimplemde },
  data() {
    return {
      form: {
        title: null,
        category_id: null,
        body: null
      },
      categories: {},
      errors:{}
    }
  },
  created() {
    axios.get("/api/category").then((res) => (this.categories = res.data.data))
  },
  methods: {
    create() {
      axios.post('/api/question', this.form)
      .then(res => this.$router.push(res.data.path))
      .catch(err => this.errors = err.response.data.error)
    },
  },
}
</script>

<style>
@import '~simplemde/dist/simplemde.min.css';
</style>