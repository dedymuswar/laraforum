<template>
  <div class="md:container mx-auto my-2">
    <div v-if="question">
      <edit-question v-if="editing" :data="question"></edit-question>
      <show-question v-else :data="question"></show-question>
      <replies :question="question" />
      <new-reply :questionSlug="question.slug"></new-reply>
    </div>
  </div>
</template>

<script>
import ShowQuestion from "./ShowQuestion.vue"
import EditQuestion from "./editQuestion.vue"
import Replies from "../reply/replies.vue"
import NewReply from "../reply/newReply.vue"
export default {
  components: { ShowQuestion, EditQuestion, Replies, NewReply },
  data() {
    return {
      question: null,
      editing: false,
      sebelumEditQuestionBody: '',
      sebelumEditQuestionTitle: ''
    }
  },
  created() {
    this.listen()
    this.getQuestion()
  },
  methods: {
    listen() {
      EventBus.$on("startEditing", () => {
        this.editing = true
        this.sebelumEditQuestionBody = this.question.body
        this.sebelumEditQuestionTitle = this.question.title
      })
      EventBus.$on("cancelEditing", (hasil) => {
        this.editing = false
        if (hasil.body !== this.question.body || hasil.title !== this.question.title) {
          this.question.body = this.sebelumEditQuestionBody
          this.question.title = this.sebelumEditQuestionTitle
          this.sebelumEditQuestionBody = ''
          this.sebelumEditQuestionTitle = ''
          // this.$swal.fire({
          //   title: "Success!",
          //   text: "Berhasil mengubah pertanyaan!",
          //   icon: "success",
          //   confirmButtonText: "Close",
          // })
        }

      })
    },
    getQuestion() {
      // console.log(this.$route.params.slug);
      axios
        .get(`/api/question/${this.$route.params.slug}`)
        .then((res) => (this.question = res.data.data))
        .catch((err) => console.log(err.response.data))
    },
  },
}
</script>

<style>
</style>