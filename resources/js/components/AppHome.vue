<template>
  <div class="bg-gray-300">
    <toolbar-ku />
    <router-view></router-view>
    <footerku />
  </div>
</template>

<script>
import ToolbarKu from "./Toolbar"
import AppFooter from "./AppFooter"
import Login from "./login/Login"
export default {
  name: "AppHome",
  components: {
    "toolbar-ku": ToolbarKu,
    footerku: AppFooter,
    Login,
  },
}
</script>
