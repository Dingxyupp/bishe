import Vue from 'vue'
import Router from 'vue-router'
import Login from './views/Login'
import Main from './views/Main'
import Admin from './views/Admin/Admin'
import PassChange from './views/Admin/PassChange'
import WebIndex from './views/WebIndex/WebIndex'
import LbtEd from './views/WebIndex/LbtEd'
import ShowEd from './views/WebIndex/ShowEd'
import MoreEd from './views/WebIndex/MoreEd'
import Serve from './views/Serve/Serve'
import ServeLbt from './views/Serve/ServeLbt'
import NewServeOrder from './views/Serve/NewServeOrder'
import Mall from './views/Mall/Mall'
import PaintIn from './views/Mall/PaintIn'
import PaintOut from './views/Mall/PaintOut'
import PaintWood from './views/Mall/PaintWood'
import PaintBrush from './views/Mall/PaintBrush'




Vue.use(Router)
export default new Router({
    routes: [
        {
            path:"/login",
            name:"login",
            component: Login
        },
        {
            path:"/main",
            name:"main",
            component: Main,
            children:[
                {
                    path:"admin",
                    name:"admin",
                    component: Admin,
                    children:[
                        {
                            path:"password",
                            name:"password",
                            component: PassChange
                        }
                    ]
                },
                {
                    path:"index",
                    name:"index",
                    component: WebIndex,
                    children:[
                        {
                            path:"lbt-index",
                            name:"lbt-index",
                            component: LbtEd,
                        },
                        {
                            path:"show-index",
                            name:"show-index",
                            component: ShowEd,
                        },
                        {
                            path:"more-index",
                            name:"more-index",
                            component: MoreEd,
                        }
                    ]
                },
                {
                    path:"serve",
                    name:"serve",
                    component: Serve,
                    children:[
                        {
                            path:"serve-lbt",
                            name:"serve-lbt",
                            component: ServeLbt
                        },
                        {
                            path:"serve-order",
                            name:"serve-order",
                            component: NewServeOrder
                        }
                    ]
                },
                {
                    path:"mall",
                    name:"mall",
                    component: Mall,
                    children:[
                        {
                            path:"paint-in",
                            name:"paint-in",
                            component: PaintIn
                        },
                        {
                            path:"paint-out",
                            name:"paint-out",
                            component: PaintOut
                        },
                        {
                            path:"paint-wood",
                            name:"paint-wood",
                            component: PaintWood
                        },
                        {
                            path:"paint-brush",
                            name:"paint-brush",
                            component: PaintBrush
                        }
                    ]
                }

            ]
        }
    ]
})