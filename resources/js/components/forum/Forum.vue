<template>
  <div class="md:container mx-auto">
    <div class="grid grid-cols-3 gap-4 my-2 ">
      <div class="col-span-2 bg-white p-4 rounded">
        <question v-for="question in questions" :key="question.path" :data="question"/>
      </div>
      <div class="col-span-1 bg-white p-4 rounded">
        <p>sidebar area</p>
      </div>
    </div>
  </div>
</template>

<script>
import question from "./Question";
export default {
  data(){
    return{
      questions:{}
    }
  },
  components:{question},
  created(){
    axios.get('/api/question')
    .then(res => this.questions = res.data.data)
    .catch(err => console.log(err.response.data))
  }
}
</script>

<style>
</style>