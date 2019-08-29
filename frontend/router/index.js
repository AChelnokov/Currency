import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);


/* Клиенты */
const Page404 = () =>  import ('../components/pages/Page404.vue');
const Index = () =>  import ('../components/pages/Index.vue');
const Orders = () =>  import ('../components/pages/Orders.vue');





const router = new VueRouter({
	// mode: 'history',
	routes: [
	  {path: '*', component: Page404},
	  {path: '/404', name: '404', component: Page404}, 

	  {path: '/', name: 'index', component: Index},
	  {path: '/orders', name: 'orders', component: Orders},
    ]
})

export default router;