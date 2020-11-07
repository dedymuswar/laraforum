<template>
  <div class="border-b py-4">
    <div class="header mb-4">
      <h3 class="text-3xl subpixel-antialiased text-gray-700">
          <router-link :to="data.path" class="hover:text-gray-600">{{ data.title }}</router-link>
      </h3>
      <div class="text-gray-700 font-sans antialiased text-xs leading-normal">
        {{ data.user }} saide
        {{ data.created_at }}
      </div>
    </div>
    <div class="body">
        <div class="text-gray-700 font-sans antialiased text-base leading-normal">{{data.body}}</div>
    </div>
    
  </div>
</template>

<script>
export default {
    props:['data']
}
</script>

<style>
</style>