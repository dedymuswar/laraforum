<template>
  <div class="my-4">
    <vue-simplemde ref="markdownEditor" v-model="reply.reply" />
    <div class="inline-flex">
      <div
        id="update"
        @click="update"
        class="btn rounded-full h-8 w-8 flex p-2 items-center justify-center bg-blue-500 hover:bg-blue-600 mr-2"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>
      </div>
      <div
        id="cancel"
        @click="cancel"
        class="btn rounded-full h-8 w-8 flex p-2 items-center justify-center bg-red-500 hover:bg-red-600"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["reply"],
  methods:{
      update(){
          axios.patch(`/api/question/${this.reply.question_slug}/reply/${this.reply.id}`, {
            body:this.reply.reply
          })
          .then(res => this.cancel(this.reply.reply))
      },
      cancel(reply){
          EventBus.$emit('cancelEditingReply', reply)
      }
  }
}
</script>

<style>
</style>