import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import axios from "./api/methods";
import api from "./api/api"

Vue.prototype.$axios=axios;
Vue.prototype.$api=api;
Vue.config.productionTip = false

//login检测
router.beforeEach((to,from,next)=>{
    if(to.name!=="login"&&!sessionStorage.getItem("login")&&to.name!=="shopsign"){
        next({name:"login"});
    }else{
        next();
    }

});

Vue.use(ElementUI);
new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
