<template>
    <el-container>

            <el-aside>
                <el-menu>

                    <el-submenu index="1">
                        <template #title>
                            <i class="el-icon-user"></i>
                            <span>账户设置</span>
                        </template>
                        <el-menu-item-group>
                            <el-menu-item index="1-1">
                                <i class="el-icon-edit"></i>
                                <router-link :to="{name:'password'}">修改密码</router-link>
                            </el-menu-item>
                        </el-menu-item-group>
                    </el-submenu>

                    <el-submenu index="2">
                        <template #title>
                            <i class="el-icon-s-home"></i>
                            <span>网站首页编辑</span>
                        </template>
                        <el-menu-item-group>
                            <el-menu-item index="2-1">
                                <i class="el-icon-edit"></i>
                                <router-link :to="{name:'lbt-index'}">轮播图编辑</router-link>
                            </el-menu-item>
                            <el-menu-item index="2-2">
                                <i class="el-icon-edit"></i>
                                <router-link :to="{name:'show-index'}">展示区域编辑</router-link>
                            </el-menu-item>
                            <el-menu-item index="2-3">
                                <i class="el-icon-edit"></i>
                                <router-link :to="{name:'more-index'}">多余内容编辑</router-link>
                            </el-menu-item>
                        </el-menu-item-group>
                    </el-submenu>

                    <el-submenu index="3">
                        <template #title>
                            <i class="el-icon-thumb"></i>
                            <span slot="title">服务</span>
                        </template>
                        <el-menu-item-group>
                            <el-menu-item index="3-1">
                                <i class="el-icon-edit"></i>
                                <router-link :to="{name:'serve-lbt'}">服务页轮播图编辑</router-link>
                            </el-menu-item>
                            <el-menu-item index="3-2">
                                <i class="el-icon-edit"></i>
                                <router-link :to="{name:'serve-order'}">焕新服务订单</router-link>
                            </el-menu-item>
                        </el-menu-item-group>
                    </el-submenu>

                    <el-submenu index="4">
                        <template #title>
                            <i class="el-icon-shopping-cart-2"></i>
                            <span slot="title">商城</span>
                        </template>
                        <el-menu-item-group>
                            <el-menu-item index="4-1">
                                <i class="el-icon-edit"></i>
                                <router-link :to="{name:'paint-in'}">室内漆</router-link>
                            </el-menu-item>
                            <el-menu-item index="4-2">
                                <i class="el-icon-edit"></i>
                                <router-link :to="{name:'paint-out'}">室外漆</router-link>
                            </el-menu-item>
                            <el-menu-item index="4-3">
                                <i class="el-icon-edit"></i>
                                <router-link :to="{name:'paint-wood'}">木器漆</router-link>
                            </el-menu-item>
                            <el-menu-item index="4-4">
                                <i class="el-icon-edit"></i>
                                <router-link :to="{name:'paint-brush'}">涂刷配件</router-link>
                            </el-menu-item>
                        </el-menu-item-group>
                    </el-submenu>

                    <el-menu-item index="/main/borrow">
                        <i class="el-icon-table-lamp"></i>
                        <span slot="title">借用归还</span>
                    </el-menu-item>

                    <el-menu-item index="/main/message">
                        <i class="el-icon-data-analysis"></i>
                        <span slot="title">信息修改</span>
                    </el-menu-item>

                    <el-menu-item index="/main/repaire">
                        <i class="el-icon-guide"></i>
                        <span slot="title">维修管理</span>
                    </el-menu-item>

                    <el-menu-item index="/main/scrap">
                        <i class="el-icon-location"></i>
                        <span slot="title">报废管理</span>
                    </el-menu-item>

                    <el-submenu index="8">
                        <template slot="title">
                            <i class="el-icon-s-promotion"></i>
                            <span>资产统计</span>
                        </template>
                        <el-menu-item-group>
                            <el-menu-item index="/main/form">
                                <i class="el-icon-headset"></i>
                                <span>资产清单</span>
                            </el-menu-item>
                        </el-menu-item-group>
                    </el-submenu>


                </el-menu>
            </el-aside>
            <el-main>
                <el-menu>
                    <el-menu-item index="1" style="float:right" @click="signOut" mode="horizontal">退出登录</el-menu-item>
                </el-menu>
                <router-view></router-view>
            </el-main>

    </el-container>
</template>

<script>
    export default {
        name: "Main",
        data: () => ({}),
        methods: {
            signOut(){
                sessionStorage.removeItem("login")
                // sessionStorage.removeItem("route")
                location.reload();
                this.$router.push("login")
            }
        },
        mounted() {
        }
    }
</script>

<style scoped lang="scss">
.container{
    height: 100%;
}
</style>