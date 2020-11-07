<template>
  <div class="md:container mx-auto my-2">
    <div class="bg-white rounded">
      <form
        method="POST"
        @submit.prevent="update"
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
        <vue-simplemde v-model="form.body" ref="markdownEditor" />
        <div class="flex items-center justify-between">
          <div>
            <button class="btn btn-teal" type="submit">Submit</button>
            <button class="btn btn-danger" @click="cancel">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import VueSimplemde from "vue-simplemde"
export default {
  components: { VueSimplemde },
  props: ["data"],
  data() {
    return {
      form: {
        title: null,
        body: null,
      },
      categories: {},
      errors: {},
    }
  },
  methods: {
    update() {
      axios.patch(`/api/question/${this.form.slug}`, this.form)
      .then(res => this.cancel())
    },
    cancel() {
      EventBus.$emit("cancelEditing")
    },
  },
  mounted() {
    this.form = this.data
  },
}
</script>

<style>
</style>