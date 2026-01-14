import { createRouter, createWebHistory } from 'vue-router'

import LoginView from '../views/loginView.vue'
import AppLayout from '../views/AppLayout.vue'
import CodeBlocksView from '../components/codeblockView.vue'
import axios from 'axios'
import AddRevisionView from '../views/RevisionView.vue'
import RevisionView from '../views/RevisionView.vue'
import HomeView from '../views/homeView.vue'


const routes = [
  {
    path : '/',
    name : 'home',
    component : HomeView,

  },
  {
    path: '/login',
    name: 'login',
    component: LoginView,
    meta: { guestOnly: true },
  },
  {
    path: '/app',
    component: AppLayout,
    meta: { requiresAuth: true },
    children: [
      {
        path: 'codeblocks/:id?',
        name: 'codeblocks',
        component: CodeBlocksView,
        
      },
      
      {
            path: 'codeblocks/:id?/revision/:revisionId?',
            name: 'viewRevision',
            component: RevisionView,
      },

      {
        path: 'codeblocks/new?',
        name: 'newCodeblock',
        component: CodeBlocksView,
      },
    ],
  },

]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

// Navigation Guard
router.beforeEach(async (to, from, next) => {
  let isAuthenticated = false;

  try {
    // Attempt to fetch the user
    const response = await axios.get('/api/user');
    isAuthenticated = !!response.data;
  } catch (error) {
    isAuthenticated = false;
  }

  // If the route requires auth and user is not logged in
  if (to.meta.requiresAuth && !isAuthenticated) {
    next('/login');
  } 
  // If user is logged in and tries to go to Login page
  else if (to.meta.guestOnly && isAuthenticated) {
    next('/app');
  } 
  else {
    next();
  }
});

export default router
