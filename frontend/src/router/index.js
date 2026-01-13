import { createRouter, createWebHistory } from 'vue-router'

import LoginView from '../views/loginView.vue'
import AppLayout from '../views/AppLayout.vue'
import CodeBlocksView from '../components/codeblockView.vue'


const routes = [
  {
    path: '/login',
    name: 'login',
    component: LoginView,
    meta: { guest: true },
  },
  {
    path: '/app',
    component: AppLayout,
    meta: { guest: true },
    children: [
      {
        path: 'codeblocks',
        name: 'codeblocks',
        component: CodeBlocksView,
      },
    ],
  },

]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
