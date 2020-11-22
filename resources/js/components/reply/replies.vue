<template>
  <div class="mt-4">
    <!-- <h1>Replies</h1> -->
    <reply
      v-for="(reply, index) in content"
      :data="reply"
      :key="reply.id"
      :index="index"
    />
  </div>
</template>

<script>
import Reply from "./reply"
export default {
  components: { Reply },
  props: ["question"],
  data() {
    return {
      content: this.question.replies,
    }
  },
  created() {
    this.listen()
  },
  methods: {
    listen() {
      EventBus.$on("newReply", (reply) => {
        this.content.unshift(reply)
      })

      EventBus.$on("deleteReply", (index) => {
        axios
          .delete(
            `/api/question/${this.question.slug}/reply/${this.content[index].id}`
          )
          .then((res) => {
            this.content.splice(index, 1)
            this.$swal.fire({
              title: "Success!",
              text: "Berhasil menghapus komentar!",
              icon: "success",
              confirmButtonText: "Close",
            })
          })
        // console.log(this.content[index].id);
      })
    },
  },
}
</script>

<style>
</style>