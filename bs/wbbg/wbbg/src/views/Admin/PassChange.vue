<template>
    <el-row>
        <el-breadcrumb separator=">" class="bread_header">
            <el-breadcrumb-item :to="{ path: '/main' }">账户设置</el-breadcrumb-item>
            <el-breadcrumb-item>修改密码</el-breadcrumb-item>
        </el-breadcrumb>
        <el-col :span="12">

            <el-form label-width="80px" :model="form" ref="myForm" :rules="rules">
                <el-form-item label="原始密码" prop="password">
                    <el-input v-model="form.password" type="password"></el-input>
                </el-form-item>
                <el-form-item label="新密码" prop="newpassword">
                    <el-input v-model="form.newpassword" type="password"></el-input>
                </el-form-item>
                <el-form-item label="确认密码" prop="rnpassword">
                    <el-input v-model="form.rnpassword" type="password"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="submit">确认</el-button>
                </el-form-item>
            </el-form>
        </el-col>
    </el-row>
</template>

<script>
    export default {
        name: "PassChange",
        data(){
            let passwordValidate1=(rule, value, callback)=>{
                let reg=/^[a-z0-9]{6,}$/;
                if(reg.test(value)){
                    callback();
                }else{
                    callback(new Error("密码必须由六位以上的数字和字母组成!"))
                }
            }

            let passwordValidate2=(rule, value, callback)=>{
                if(this.form.newpassword!==value){
                    callback(new Error("两次密码输入不一致!"))
                }else{
                    callback()
                }
            }
            return{
                form:{
                    password:'',
                    newpassword:'',
                    rnpassword:'',
                    username:sessionStorage.getItem("login")
                },
                rules:{
                    password:{required:true,message:"请输入原始密码",trigger:"blur"},
                    newpassword:[
                        {required:true,message:"请输入新密码",trigger:"blur"},
                        {validator:passwordValidate1,trigger:"blur"}
                    ],
                    rnpassword:[
                        {required:true,message:"请确认密码",trigger:"blur"},
                        {validator:passwordValidate2,trigger:"blur"}
                    ]
                }
            }
        },
        // components:{
        //     "basic":basic
        // },
        methods: {
            submit(){
                this.$refs.myForm.validate(validate=>{
                    if(validate){
                        this.$axios.put(this.$api.PASSWORD,this.form).then(res=>{
                            if(res.data.code===200){
                                this.$message.success("修改成功!")
                            }
                            else if(res.data.code===400){
                                this.$message.error("不存在的用户!")
                            }
                        })
                    }else{
                        return false
                    }
                })

            }
        },
        mounted() {
        }
    }
</script>

<style scoped lang="scss">
.bread_header{
    margin-bottom: 20px;
}
</style>