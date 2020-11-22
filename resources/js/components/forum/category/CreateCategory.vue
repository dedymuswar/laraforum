<template>
  <div>
    <div class="md:container mx-auto">
      <div class="bg-white rounded-md p-4 my-4">
        <form class="mb-4" method="post" @submit.prevent="simpan">
          <div class="mb-4">
            <label
              class="block text-gray-700 text-sm font-normal mb-2"
              for="username"
            >
              Add Category
            </label>
            <input
              class="shadow appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-teal-500"
              name="category"
              type="category"
              v-model="form.name"
              required
              autofocus
              placeholder="category"
            />
          </div>
          <button type="submit" class="btn btn-warning" v-if="editSlug">
            Update
          </button>
          <button type="submit" class="btn btn-primary" v-else>Create</button>
        </form>
        <div class="border-b my-4 pb-2 text-gray-700">
          <h2>Category</h2>
        </div>
        <div class="text-gray-700">
          <div
            class="rounded-t-md bg-gray-300 p-2 mb-2 flex justify-between items-center"
            v-for="(category, index) in categories"
            :key="category.id"
          >
            <div>{{ category.name }}</div>
            <div class="inline-flex">
              <div
                id="edit"
                @click="edit(index)"
                class="btn rounded-full h-8 w-8 flex p-2 items-center justify-center bg-yellow-500 hover:bg-yellow-600 mr-2"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  class="h-6 w-6 text-white"
                  fill="currentColor"
                >
                  <path
                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                  />
                </svg>
              </div>
              <div
                id="delete"
                @click="destroy(category.slug, index)"
                class="btn rounded-full h-8 w-8 flex p-2 items-center justify-center bg-red-500 hover:bg-red-600"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  class="h-6 w-6 text-white"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd"
                  />
                </svg>
              </div>
            </div>
          </div>
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
      },
      categories: {},
      editSlug: null,
    }
  },
  methods: {
    simpan() {
      this.editSlug ? this.update() : this.create()
    },
    edit(index) {
      this.form.name = this.categories[index].name
      this.editSlug = this.categories[index].slug
      this.categories.splice(index, 1)
    },
    destroy(slug, index) {
      axios
        .delete(`/api/category/${slug}`)
        .then((res) => this.categories.splice(index, 1))
        .catch((err) => console.log(err))
    },
    update() {
      axios
        .patch(`/api/category/${this.editSlug}`, this.form)
        .then((res) => {
          this.categories.unshift(res.data)
          this.form.name = null
        })
        .catch((err) => console.log(err.response.data))
    },
    create() {
      axios
        .post("/api/category", this.form)
        .then((res) => {
          this.categories.unshift(res.data)
          this.form.name = null
        })
        .catch((err) => console.log(err.response.data))
    },
  },
  created() {
    if (!User.admin()) {
      this.$router.push("/forum")
    }
    axios.get("/api/category").then((res) => (this.categories = res.data.data))
  },
}
</script>

<style>
</style>