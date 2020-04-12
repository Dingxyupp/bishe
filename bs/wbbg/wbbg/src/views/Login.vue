<template>
    <el-container>
        <el-row type="flex" justify="center" align="middle">
            <el-col :span="7">
                <el-form  class="box" label-width="80px" :model="form" :rules="rules" ref="loginForm">
                    <h3 style="margin-bottom: 10px">油漆商城后台管理系统</h3>

                    <el-form-item label="用户名" prop="username">
                        <el-input v-model="form.username"></el-input>
                    </el-form-item>


                    <el-form-item label="密码" prop="password">
                        <el-input type="password" v-model="form.password"></el-input>
                    </el-form-item>


                    <el-form-item label="验证码" prop="captcha">
                        <el-row>
                            <el-col :span="16">
                                <el-input v-model="form.captcha"></el-input>
                            </el-col>
                            <el-col :span="8">
                                <img :src="src" class="img" @click="handleCaptcha">
                            </el-col>
                        </el-row>
                    </el-form-item>


                    <el-form-item>
                        <el-button type="primary" style="display: block;width: 100%" @click="handleClick">登陆</el-button>
                    </el-form-item>
                </el-form>

            </el-col>
        </el-row>
    </el-container>
</template>

<script>
    export default {
        name: "Login",
        data: () => ({
            src:"/api/admin/captcha",
            id:"",
            form:{
                username:"",
                password:"",
                captcha:"",
            },
            rules:{
                username:{required:true,message:"请输入姓名",trigger:"blur"},
                password:{required:true,message:"请输入密码",trigger:"blur"},
                captcha:{required:true,message:"请输入验证码",trigger:"blur"},
            },
        }),
        methods: {
            handleCaptcha(){
                this.src="/api/admin/captcha?"+Date.now()//图片的地址发生变化会重新请求，验证码发生改变
            },
            handleClick(){
                this.$refs.loginForm.validate(validate=>{
                    if(validate){
                        this.$axios.post(this.$api.LOGIN,this.form).then(res=>{
                            if(res.data.code===200){
                                this.$message.success("登陆成功")
                                this.id=res.data.id;
                                sessionStorage.setItem("login",this.id)
                                this.$router.push({path:"/main"})
                                // this.$store.commit("updateRoute",res.data.route);
                            }else{
                                return false
                            }
                        })
                    }else{
                        return false
                    }

                })
                this.src="/api/admin/captcha?"+Date.now()
            },
        },
        mounted(){
        }
    }
</script>

<style scoped lang="scss">
    .el-container{
        width: 100%;
        height: 100%;
        background: url("../static/th.jpg") no-repeat center/cover;
        .el-row{
            width: 100%;
            height: 100%;
            .box{
                height: 300px;
                background: #fff;
                opacity: 0.7;
                border-radius: 10px;
            }
        }
        .box{
            padding: 20px;
        }
        .img{
            width: 100%;
            height: 100%;
            background: #2c3e50;
        }

    }
</style>