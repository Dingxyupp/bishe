<template>
    <el-row>
        <el-breadcrumb separator=">" class="bread_header">
            <el-breadcrumb-item :to="{ path: '/index' }">网站首页编辑</el-breadcrumb-item>
            <el-breadcrumb-item>轮播图编辑</el-breadcrumb-item>
        </el-breadcrumb>
        <el-row>
            <el-button type="primary" icon="el-icon-circle-plus-outline" circle style="float:left;margin: 20px 0px 20px 10px" @click="add"></el-button>
        </el-row>
        <template>
            <el-table :data="tableData" height="300" border style="width: 80%">
                <el-table-column
                        prop="id"
                        label="编号"
                        width="160">
                </el-table-column>
                <el-table-column
                        prop="detail"
                        label="图片地址"
                        width="400">
                </el-table-column>
                <el-table-column
                        prop="interview"
                        label="文字"
                        width="160">
                </el-table-column>
                <el-table-column
                        prop="do"
                        label="操作"
                        >
                    <template #default="obj">
                        <el-button type="success" size="mini" @click="lbtEdit(obj.row.id)">编辑</el-button>
                        <el-button type="danger" size="mini" @click="del(obj.row.id)" icon="el-icon-delete" style="margin-left: 30px" circle></el-button>
                    </template>

                </el-table-column>
            </el-table>

            <el-dialog
                    :visible.sync="dialogVisible"
                    width="50%"
                    :before-close="handleClose">
                <template >
                <el-form ref="form" :model="form" label-width="80px">
                    <el-form-item label="图片编号" prop="id">
                        <el-input v-model="form.id" disabled></el-input>
                    </el-form-item>
                    <el-form-item label="简介" prop="interview">
                        <el-input v-model="form.interview"></el-input>
                    </el-form-item>
                    <el-form-item label="缩略图" prop="picture">
                        <div class="demo-image__preview">
                            <el-image
                                    style="width: 100px; height: 100px"
                                    :src="form.detail"
                                    :preview-src-list="form.detail">
                            </el-image>
                        </div>
                    </el-form-item>
                    <el-form-item label="上传" prop="img">
                        <el-upload
                                class="avatar-uploader"
                                :action="upload"
                                :show-file-list="false"
                                :on-success="handleAvatarSuccess"
                                :before-upload="beforeAvatarUpload">
                            <img v-if="form.img" :src="form.img" class="avatar">
                            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                        </el-upload>
                    </el-form-item>
                </el-form>
                </template>

                <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisible = false">取 消</el-button>
    <el-button type="primary" @click="submit">提交</el-button>
  </span>
            </el-dialog>
            <el-dialog
                    :visible.sync="dialogVisible1"
                    width="50%"
                    :before-close="handleClose">
                <template >
                    <el-form ref="addForm" :model="addForm" label-width="80px">
                        <el-form-item label="图片编号" prop="id">
                            <el-input v-model="addForm.id"></el-input>
                        </el-form-item>
                        <el-form-item label="简介" prop="interview">
                            <el-input v-model="addForm.interview"></el-input>
                        </el-form-item>
<!--                        <el-form-item label="缩略图" prop="picture">-->
<!--                            <div class="demo-image__preview">-->
<!--                                <el-image-->
<!--                                        style="width: 100px; height: 100px"-->
<!--                                        :src="addForm.detail"-->
<!--                                        :preview-src-list="addForm.detail">-->
<!--                                </el-image>-->
<!--                            </div>-->
<!--                        </el-form-item>-->
                        <el-form-item label="上传" prop="img">
                            <el-upload
                                    class="avatar-uploader"
                                    :action="upload"
                                    :show-file-list="false"
                                    :on-success="handleAvatarSuccess1"
                                    :before-upload="beforeAvatarUpload">
                                <img v-if="addForm.img" :src="addForm.img" class="avatar">
                                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                            </el-upload>
                        </el-form-item>
                    </el-form>
                </template>

                <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisible1 = false">取 消</el-button>
    <el-button type="primary" @click="addUp">提交</el-button>
  </span>
            </el-dialog>

        </template>
    </el-row>
</template>

<script>
    export default {
        name: "LbtEd",
        data(){
            return {
                upload:this.$api.UPLOAD,
                tableData: [],
                dialogVisible:false,
                dialogVisible1:false,
                form: {
                    id:"",
                    interview:"",
                    picture:"",
                    detail:"",
                    img:""
                },
                addForm:{
                    id:"",
                    interview:"",
                    detail:"",
                    img:""
                }
            }
        },
        methods: {
            fetchData() {
                this.$axios.get(this.$api.LBTSELECT).then(res => {
                    if (res.data.code === 200) {
                        this.tableData = res.data.data;
                    }
                })
            },
            add(){
                this.dialogVisible1=true;
                this.addForm.id=null;
                this.addForm.interview=null;
                this.addForm.detail=null;
                this.addForm.img=null;
            },
            addUp(){
                this.$axios.post(this.$api.LBTADD,this.addForm).then(res=>{
                    if(res.data.code===200){
                        this.$message.success("添加成功!")
                        this.dialogVisible1=false;
                        this.fetchData();
                    }
                })
            },
            lbtEdit(id){
                this.dialogVisible=true;
                this.$axios.get(this.$api.LBTEDIT,{id:id}).then(res => {
                    if (res.data.code === 200) {
                        this.form = res.data.data;
                    }
                })
            },
            del(id){
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.delete(this.$api.LBTDELETE,{id:id}).then(res=>{
                        if(res.data.code===200){
                            this.$message.success("删除成功!")
                        }else{
                            this.$message.error("删除失败!")
                        }
                    })
                    this.fetchData();
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });
            },
            submit(){
                this.dialogVisible=false;
                this.$axios.post(this.$api.LBTALTER,this.form).then(res => {
                    if (res.data.code === 200) {
                        this.$message.success("修改成功！")
                        this.tableData = res.data.data;
                    }
                })
                this.fetchData()
            },
            handleClose(done) {
                this.$confirm('确认关闭？')
                    .then(_ => {
                        done();
                    })
                    .catch(_ => {});
            },
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
                this.form.detail=res;
                this.form.img=res
                this.dialogVisible=false;
                this.dialogVisible=true;

            },
            handleAvatarSuccess1(res, file) {
                this.addForm.detail=res;
                this.addForm.img=res;
                this.dialogVisible1=false;
                this.dialogVisible1=true;

            }
        },
        mounted() {
            this.fetchData();
        }
    }
</script>

<style scoped lang="scss">
    .bread_header{
        margin-bottom: 20px;
    }
    .demo-image__preview{
        float:left;
    }
    .avatar-uploader {
        width: 178px;
        height:178px;
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