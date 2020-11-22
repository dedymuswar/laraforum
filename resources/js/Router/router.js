import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import Login from '../components/login/Login'
import Logout from '../components/login/Logout'
import SignUp from '../components/login/SignUp'
import Forum from '../components/forum/Forum'
import Read from '../components/forum/Read'
import Create from '../components/forum/Create'
import CreateCategory from '../components/forum/category/CreateCategory'
const routes = [
    { path: '/login', component: Login },
    { path: '/logout', component: Logout},
    { path: '/signup', component: SignUp },
    { path: '/category', component: CreateCategory },
    { path: '/forum', component: Forum, name: 'forum' },
    { path: '/question/:slug', component: Read, name: 'read' },
    { path: '/create', component: Create, name:'create' },
  ]

  
  const router = new VueRouter({
    routes,  // short for `routes: routes`,
    hasbang : false, //menghilangkan tanda hastag pada url
    mode: 'history'
  })

  export default router