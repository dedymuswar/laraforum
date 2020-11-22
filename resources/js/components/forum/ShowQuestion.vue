<template>
  <div class="bg-white p-4 rounded border-red-300 border-t-4">
    <div class="header mb-4">
      <div class="flex justify-between">
        <h3 class="text-3xl subpixel-antialiased text-gray-700">
          {{ data.title }}
        </h3>
        <button class="btn btn-teal">{{data.reply_count}} Replies</button>
      </div>
      <div class="text-gray-700 font-sans antialiased text-xs leading-normal">
        {{ data.user }} said
        {{ data.created_at }}
      </div>
    </div>
    <div class="body">
      <div class="text-gray-700 leading-normal" v-html="body"></div>
    </div>
    <div class="my-4 flex inline-flex" v-if="own">
      <div id="edit" @click="edit"
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
      <div id="delete" @click="destroy"
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
</template>

<script>
import md from "marked"
export default {
  props: ["data"],
    data(){
      return {
        own : User.own(this.data.user_id)
      }
    },
  computed: {
    body() {
      return md.parse(this.data.body)
    },
  },
  methods:{
    edit(){
      EventBus.$emit('startEditing')
    },
    destroy(){
      axios.delete(`/api/question/${this.data.slug}`)
      .then(res => this.$router.push('/forum'))
      .catch(err => console.log(err.response.data))
    }
  }
}
</script>

<style>
</style>