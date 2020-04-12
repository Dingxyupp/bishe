<template>
    <el-row>
        <el-upload
                class="avatar-uploader"
                :action="upload"
                :show-file-list="false"
                :on-success="handleAvatarSuccess"
                :before-upload="beforeAvatarUpload">
            <img v-if="image" :src="image" class="avatar">
            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
        </el-upload>
    </el-row>
</template>

<script>
    export default {
        name: "MoreEd",
        data(){
            return {
                upload:this.$api.UPLOAD,
                image:''
            }
        },
        methods: {
            beforeAvatarUpload(file) {
                let typeArr=["image/png","image/gif","image/jpg","image/jpeg"];
                if(!typeArr.includes(file.type)){
                    this.$message.error('请选择正确的图片格式!');
                    return false;
                }
                if(file.size / 1024 / 1024 > 5){
                    this.$message.error('文件大小超出限制!');
                    return false;
                }
                return true;
            },
            handleAvatarSuccess(res, file) {
                this.image=res
                // this.$refs.form.validateField("img");
            }
        },
        mounted() {
        }
    }
</script>

<style scoped lang="scss">
    .avatar-uploader {
        width: 178px;
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .avatar-uploader .el-upload:hover {
        border-color: #409EFF;
    }
    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        line-height: 178px;
        text-align: center;
    }
    .avatar {
        width: 178px;
        height: 178px;
        display: block;
    }
</style>