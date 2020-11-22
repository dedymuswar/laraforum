<template>
  <div
    class="overflow-hidden shadow-lg border-t-4 bg-white mb-4 rounded-b-lg rounded-t-md border-red-300"
  >
    <div class="px-6 py-4 mb-2 mt-4 mb-8">
      <div class="uppercase tracking-wide text-c2 mb-4">Category</div>
      <div
        class="flex cursor-pointer border px-4 py-2 text-lg text-grey-darkest border-b-0 mb"
        style="border-left: 4px solid #e2624b !important" v-for="category in categories" :key="category.id"
      >
        <div class="pl-2">{{ category.name }}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            categories:{}
        }
    },
    created(){
        axios.get('/api/category')
        .then(res => this.categories = res.data.data)
    }
}
</script>

<style>
</style>