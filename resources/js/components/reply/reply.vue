<template>
  <div
    class="p-4 overflow-hidden shadow-lg border-l-4 mx-4 bg-white mb-4 rounded-b-lg rounded-t-md border-red-300"
  >
    <div class="pb-4">
      <div class="header mb-4">
        <div class="flex justify-between">
          <div class="border-b border-gray-300 w-full inline-flex">
            <div class="text-sm subpixel-antialiased text-gray-700">
              {{ data.user }}
            </div>
            <div class="text-gray-700 font-sans antialiased ml-2 text-xs">
              {{ data.created_at }}
            </div>
          </div>

          <div v-if="!editing">
            <div class="inline-flex" v-if="own">
              <div
                id="edit"
                @click="edit"
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
                @click="destroy"
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
      <div class="body">
        <edit-reply v-if="editing" :reply="data"/>
        <div
          class="text-gray-700 font-sans antialiased text-base leading-normal"
          v-else
          v-html="reply"
        ></div>
      </div>
    </div>
  </div>
</template>

<script>
import md from "marked"
import editReply from "./editReply.vue"
export default {
  components: { editReply },
  props: ["data", "index"],
  data() {
    return {
      editing: false,
      sebelumEditReplyBody: ''
    }
  },
  created(){
    this.listen()
  },
  methods: {
    edit() {
      this.editing = true
      this.sebelumEditReplyBody = this.data.reply
    },
    destroy() {
      EventBus.$emit("deleteReply", this.index)
    },
    listen(){
      EventBus.$on('cancelEditingReply', (reply) => {
        this.editing = false
        
        if (reply !== this.data.reply) {
          this.data.reply = this.sebelumEditReplyBody
          this.sebelumEditReplyBody = ''
        }
      })
    }
  },
  computed: {
    own() {
      return User.own(this.data.user_id)
    },
    reply() {
      return md.parse(this.data.reply)
    },
  },
}
</script>

<style>
</style>