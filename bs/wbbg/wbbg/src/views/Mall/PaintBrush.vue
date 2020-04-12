<template>
    <el-row>
        <el-breadcrumb separator=">" class="bread_header">
            <el-breadcrumb-item :to="{ path: '/serve' }">商城</el-breadcrumb-item>
            <el-breadcrumb-item>涂刷配件编辑页面</el-breadcrumb-item>
        </el-breadcrumb>
        <el-col style="margin-bottom: 30px">
            <el-button type="primary" icon="el-icon-circle-plus-outline" style="float:left;" @click="add"></el-button>
            <el-button type="primary" icon="el-icon-search" style="float:left;" @click="search"></el-button>
            <el-button type="warning" plain style="margin-right: 30px" @click="sortHL">数量从高到低排列</el-button>
            <el-button type="warning" plain @click="sortLH">数量低到高排列</el-button>
        </el-col>
        <!--表格-->
        <el-table
                :data="tableData"
                border
                style="width: 100%;">
            <el-table-column
                    prop="id"
                    label="编号"
                    width="60">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="名称"
                    width="160">
            </el-table-column>
            <el-table-column
                    prop="picture"
                    label="图片"
                    width="160">
                <template #default="scope">
                    <img :src="scope.row.picture" class="head_pic"/>
                </template>
            </el-table-column>
            <el-table-column
                    prop="productintd"
                    label="产品介绍"
                    width="200">
            </el-table-column>
            <el-table-column
                    prop="specifications"
                    label="规格"
                    width="100">
            </el-table-column>
            <el-table-column
                    prop="cleaning"
                    label="工具清洗"
                    width="240">
            </el-table-column>
            <el-table-column
                    prop="temperature"
                    label="施工温度"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="method"
                    label="使用方法"
                    width="200">
            </el-table-column>
            <el-table-column
                    prop="count"
                    label="数量"
                    width="70">
            </el-table-column>
            <el-table-column
                    prop="do"
                    fixed="right"
                    width="150"
                    label="操作">
                <template #default="obj">
                    <el-button type="warning" size="mini" @click="modify(obj.row.id)" style="margin-right: 30px;">修改</el-button>
                    <el-button type="danger" size="mini" @click="del(obj.row.id)" icon="el-icon-delete" circle></el-button>
                </template>
            </el-table-column>
        </el-table>
        <!--修改对话框-->
        <el-dialog
                :visible.sync="dialogVisibleModify"
                width="50%"
        >
            <template >
                <el-form ref="editForm" :model="editForm" label-width="80px" :rules="editFormRules">
                    <el-form-item label="编号">
                        <el-input v-model="editForm.id" disabled></el-input>
                    </el-form-item>
                    <el-form-item label="名称" prop="name">
                        <el-input v-model="editForm.name"></el-input>
                    </el-form-item>
                    <el-form-item label="缩略图" prop="picture">
                        <div class="demo-image__preview">
                            <el-image
                                    style="width: 100px; height: 100px"
                                    :src="url"
                                    :preview-src-list="srcList">
                            </el-image>
                        </div>
                    </el-form-item>
                    <el-form-item label="上传新图">
                        <el-upload
                                class="avatar-uploader"
                                :action="upload"
                                :show-file-list="false"
                                :on-success="handleAvatarSuccess"
                                :before-upload="beforeAvatarUpload">
                            <img v-if="editForm.img" :src="editForm.img" class="avatar">
                            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                        </el-upload>
                    </el-form-item>
                    <el-form-item label="产品介绍" prop="productintd">
                        <el-input type="textarea" v-model="editForm.productintd"></el-input>
                    </el-form-item>
                    <el-form-item label="规格" prop="specifications">
                        <el-input type="textarea" v-model="editForm.specifications"></el-input>
                    </el-form-item>
                    <el-form-item label="工具清洗" prop="cleaning">
                        <el-input type="textarea" v-model="editForm.cleaning"></el-input>
                    </el-form-item>
                    <el-form-item label="施工温度" prop="temperature">
                        <el-input v-model="editForm.temperature" type="textarea"></el-input>
                    </el-form-item>
                    <el-form-item label="使用方法" prop="method">
                        <el-input v-model="editForm.method"></el-input>
                    </el-form-item>
                    <el-form-item label="数量" prop="count">
                        <el-input v-model.number="editForm.count"></el-input>
                    </el-form-item>
                </el-form>
            </template>

            <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisibleModify = false">取 消</el-button>
    <el-button type="primary" @click="submit">提交</el-button>
  </span>
        </el-dialog>
        <!--添加对话框-->
        <el-dialog
                :visible.sync="dialogVisibleAdd"
                width="50%"
        >
            <template >
                <el-form ref="addForm" :model="addForm" label-width="80px" :rules="addFormRules">
                    <el-form-item label="编号" prop="id">
                        <el-input v-model.number="addForm.id"></el-input>
                    </el-form-item>
                    <el-form-item label="名称" prop="name">
                        <el-input v-model="addForm.name"></el-input>
                    </el-form-item>
                    <el-form-item label="上传新图" prop="picture">
                        <el-upload
                                class="avatar-uploader"
                                :action="upload"
                                :show-file-list="false"
                                :on-success="handleAvatarSuccessAdd"
                                :before-upload="beforeAvatarUpload">
                            <img v-if="addForm.img" :src="addForm.img" class="avatar">
                            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                        </el-upload>
                    </el-form-item>
                    <el-form-item label="产品介绍" prop="productintd">
                        <el-input type="textarea" v-model="addForm.productintd"></el-input>
                    </el-form-item>
                    <el-form-item label="规格" prop="specifications">
                        <el-input type="textarea" v-model="addForm.specifications"></el-input>
                    </el-form-item>
                    <el-form-item label="工具清洗" prop="cleaning">
                        <el-input type="textarea" v-model="addForm.cleaning"></el-input>
                    </el-form-item>
                    <el-form-item label="施工温度" prop="temperature">
                        <el-input v-model="addForm.temperature" type="textarea"></el-input>
                    </el-form-item>
                    <el-form-item label="使用方法" prop="method">
                        <el-input v-model="addForm.method"></el-input>
                    </el-form-item>
                    <el-form-item label="数量" prop="count">
                        <el-input v-model.number="addForm.count"></el-input>
                    </el-form-item>
                </el-form>
            </template>

            <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisibleAdd = false">取 消</el-button>
    <el-button type="primary" @click="addUp">提交</el-button>
  </span>
        </el-dialog>
        <!--搜索对话框-->
        <el-dialog
                :visible.sync="dialogVisibleSearch"
                width="50%"
        >
            <template>
                <el-form ref="searchForm" :model="searchForm" label-width="80px" :rules="searchFormRules">
                    <el-form-item label="输入您想要查询的内容" label-width="180px" prop="content">
                        <el-input v-model="searchForm.content" placeholder="可以根据编号、油漆名称、光泽、用途、数量以及产品系列来查询"></el-input>
                    </el-form-item>
                </el-form>
            </template>
            <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisibleSearch = false">取 消</el-button>
    <el-button type="primary" @click="searchDb">提交</el-button>
  </span>
        </el-dialog>
        <!--分页-->
        <el-pagination
                class="order-el-page"
                background
                :current-page.sync="page"
                @current-change="pageChange"
                layout="prev, pager, next"
                :page-size.sync="pageSize"
                :total="total">
        </el-pagination>
    </el-row>
</template>

<script>
    export default {
        name: "PaintBrush",
        data(){
            return {
                upload:this.$api.UPLOAD,
                dialogVisibleModify:false,
                dialogVisibleAdd:false,
                dialogVisibleSearch:false,
                tableData:[],
                page:1,
                pageSize:5,
                total:0,
                url: '',
                index:"",
                srcList: [],
                editFormRules:{
                    name:[
                        { required: true, message: '该栏不能为空', trigger: 'blur' },
                        { min: 3, max: 10, message: '长度在 3 到 10 个字符', trigger: 'blur' }
                    ],
                    productintd:[
                        { required: true, message: '该栏不能为空', trigger: 'blur' },
                    ],
                    specifications:[
                        { required: true, message: '该栏不能为空', trigger: 'blur' },
                    ],
                    cleaning:[
                        { required: true, message: '该栏不能为空', trigger: 'blur' },
                    ],
                    temperature:[
                        { required: true, message: '该栏不能为空', trigger: 'blur' },
                    ],
                    method:[
                        { required: true, message: '该栏不能为空', trigger: 'blur' },
                    ],
                    count:[
                        { type:"number",required: true, message: '该栏不能为空', trigger: 'blur' },
                    ],
                },
                addFormRules:{
                    id:[
                        { type:"number",required: true, message: '该栏不能为空', trigger: 'blur' },
                    ],
                    name:[
                        { required: true, message: '该栏不能为空', trigger: 'blur' },
                        { min: 3, max: 10, message: '长度在 3 到 10 个字符', trigger: 'blur' }
                    ],
                    picture:[
                        { required: true, message: '该栏不能为空', trigger: 'blur' },
                    ],
                    productintd:[
                        { required: true, message: '该栏不能为空', trigger: 'blur' },
                    ],
                    specifications:[
                        { required: true, message: '该栏不能为空', trigger: 'blur' },
                    ],
                    cleaning:[
                        { required: true, message: '该栏不能为空', trigger: 'blur' },
                    ],
                    temperature:[
                        { required: true, message: '该栏不能为空', trigger: 'blur' },
                    ],
                    method:[
                        { required: true, message: '该栏不能为空', trigger: 'blur' },
                    ],
                    count:[
                        { type:"number",required: true, message: '该栏不能为空', trigger: 'blur' },
                    ],
                },
                editForm:{
                    id:"",
                    name:"",
                    picture:"",
                    img:"",
                    productintd:"",
                    specifications:"",
                    cleaning:"",
                    temperature:"",
                    method:"",
                    count:"",
                },
                addForm:{
                    id:"",
                    name:"",
                    picture:"",
                    img:"",
                    productintd:"",
                    specifications:"",
                    cleaning:"",
                    temperature:"",
                    method:"",
                    count:"",
                    state:4,
                },
                searchForm:{
                    content:""
                },
                searchFormRules:{
                    content:[
                        { required: true, message: '搜索内容不能为空', trigger: 'blur' },
                        { min: 1, max: 20, message: '长度在 1 到 30 个字符', trigger: 'blur' }
                    ],
                },
            }
        },
        methods: {
            fetchData() {
                this.$axios.get(this.$api.PAINTBRUSHSELECT,{state:4,index:this.index,page:this.page,size:this.pageSize,content:this.searchForm.content}).then(res => {
                    if (res.data.code === 200) {
                        this.total=res.data.total.length;
                        this.tableData = res.data.data;
                    }
                })
            },
            sortHL(){
                this.index=1;
                this.fetchData();
            },
            sortLH(){
                this.index=2;
                this.fetchData();
            },
            modify(id){
                this.dialogVisibleModify=true;
                this.$axios.get(this.$api.PAINTBRUSHMODIFY,{id:id}).then(res=>{
                    if (res.data.code === 200) {
                        this.url=res.data.data.picture;
                        this.srcList.splice(0,1,res.data.data.picture);
                        this.editForm = res.data.data;
                    }
                })
            },
            add(){
                this.dialogVisibleAdd=true;
                this.$nextTick(()=>{
                    this.$refs.addForm.resetFields();
                })
                this.addForm.id="";
                this.addForm.img="";
            },
            addUp(){
                this.$refs.addForm.validate(vali=>{
                    if(vali){
                        this.$axios.post(this.$api.PAINTBRUSHADD,this.addForm).then(res=>{
                            if(res.data.code===200){
                                this.$message.success("添加成功!");
                                this.dialogVisibleAdd=false;
                                this.fetchData();
                            }
                        })
                    }else{
                        return false;
                    }
                })
            },
            search(){
                this.dialogVisibleSearch=true;
                this.$nextTick(()=>{
                    this.$refs.searchForm.resetFields();
                })
            },
            searchDb(){
                this.$refs.searchForm.validate(vali=>{
                    if(vali){
                        this.dialogVisibleSearch=false;
                        this.fetchData();
                    }else{
                        return false;
                    }
                })
            },
            del(id){
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.delete(this.$api.PAINTBRUSHDELETE,{id:id,state:4}).then(res=>{
                        if(res.data.code===200){
                            this.$message.success("删除成功!");
                            //删除当前页最后一条数据。删除之后更新total。
                            this.total=res.data.total.length;
                            let totalPage = Math.ceil((this.total - 1)/this.pageSize);
                            let currentPage = this.page > totalPage ? totalPage : this.page;
                            this.page = this.page < 1 ? 1 : currentPage;
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
                this.$refs.editForm.validate(vali=>{
                    if(vali){
                        this.$axios.post(this.$api.PAINTBRUSHALTER,this.editForm).then(res => {
                            if (res.data.code === 200) {
                                this.$message.success("修改成功!");
                                this.fetchData();
                            }
                        });
                        this.dialogVisibleModify=false;
                    }else{
                        return false;
                    }
                })
            },
            pageChange(){
                this.fetchData();
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
                this.editForm.picture=res;
                this.editForm.img=res;
                this.dialogVisibleModify=false;
                this.dialogVisibleModify=true;

            },
            handleAvatarSuccessAdd(res, file) {
                this.addForm.picture=res;
                this.addForm.img=res;
                this.dialogVisibleAdd=false;
                this.dialogVisibleAdd=true;

            }
        },
        mounted() {
            this.fetchData();
        }
    }
</script>

<style scoped lang="scss">
    .head_pic{
        width: 80%;
        height:50px;
    }
    .bread_header{
        margin-bottom: 30px;
    }
    .order-el-page{
        margin-top: 50px;
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