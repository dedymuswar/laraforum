<template>
  <div class="bg-white rounded-md border-red-300 border-t-4 p-4">
    <vue-simplemde ref="markdownEditor" v-model="body" />
    <button type="submit" @click="submit" class="btn btn-primary">Reply</button>
  </div>
</template>

<script>
export default {
  props: ["questionSlug"],
  data() {
    return {
      body: null,
    }
  },
  methods: {
    submit() {
      axios
        .post(`/api/question/${this.questionSlug}/reply`, { body: this.body })
        .then((result) => {
          this.body = ""
          EventBus.$emit("newReply", result.data.reply)
          window.scrollTo(0, 0)
          this.$swal.fire({
            title: "Success!",
            text: "Berhasil menambahkan komentar!",
            icon: "success",
            confirmButtonText: "Close",
          })
        })
    },
  },
}
</script>

<style>
</style>