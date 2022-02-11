// importo vue
import Vue from "vue";

import VueRouter from "vue-router";

// importo le pages
import Home from './components/pages/Home';
import About from './components/pages/About';
import Contacts from './components/pages/Contacts';
import Posts from './components/pages/Posts';
import PostDetail from './components/pages/PostDetail';
import Error404 from './components/pages/Error404';


// inietto VueRouter dentro Vue 
Vue.use(VueRouter);

// inizializzo la classe del router che conterrà tutte le rotte
const router = new VueRouter({
  // faccio in modo che il browser metterà in memoria le rotte
  mode: 'history',
  
  // riprendo la classe del router-link e lo rinomico con la mia classe
  linkExactActiveClass: 'active',
  
  // insesisco qui le mie rotte di VueRouter
  routes: [
    {
      path: '/',
      name: 'home',
      component:  Home
    },
    {
      path: '/chi-siamo',
      name: 'about',
      component:  About
    },
    {
      path: '/contatti',
      name: 'contacts',
      component:  Contacts
    },
    {
      path: '/blog',
      name: 'blog',
      component:  Posts
    },
    {
      path: '/detail/:slug',
      name: 'detail',
      component:  PostDetail
    },
    {
      path: '*',
      component:  Error404
    }
  ]
});

// facciamo in modo che la classe router possa essere esportata
export default router;