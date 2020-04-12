<template>
    <el-row>
        <el-breadcrumb separator=">" class="bread_header">
            <el-breadcrumb-item :to="{ path: '/serve' }">服务</el-breadcrumb-item>
            <el-breadcrumb-item>焕新服务订单</el-breadcrumb-item>
        </el-breadcrumb>

<!--        标签页-->
        <el-tabs v-model="activeName" @tab-click="handleClick">
            <el-tab-pane label="未开始的订单" name="1">
                <el-table
                        :data="tableData1"
                        border
                        style="width: 100%">
                    <el-table-column
                            prop="id"
                            label="编号"
                            width="60">
                    </el-table-column>
                    <el-table-column
                            prop="username"
                            label="姓名"
                            width="60">
                    </el-table-column>
                    <el-table-column
                            prop="sex"
                            label="性别"
                            width="50">
                    </el-table-column>
                    <el-table-column
                            prop="phonenumber"
                            label="电话"
                            width="80">
                    </el-table-column>
                    <el-table-column
                            prop="city"
                            label="城市"
                            width="100">
                    </el-table-column>
                    <el-table-column
                            prop="address"
                            label="详细地址"
                            width="180">
                    </el-table-column>
                    <el-table-column
                            prop="serve"
                            label="所选服务"
                            width="200">
                    </el-table-column>
                    <el-table-column
                            prop="date"
                            label="提交日期"
                            width="80">
                    </el-table-column>
                    <el-table-column
                            prop="content"
                            label="备注"
                            width="150">
                    </el-table-column>
                    <el-table-column
                            prop="do"
                            label="操作">
                        <template #default="obj">
                            <el-button type="success" size="mini" @click="confirm1(obj.row.id)">确认</el-button>
                            <el-button type="warning" size="mini" @click="modify(obj.row.id)">修改</el-button>
                            <el-button type="danger" size="mini" @click="del(obj.row.id)" icon="el-icon-delete" circle></el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </el-tab-pane>
            <el-tab-pane label="进行中的订单" name="2">
                <el-table
                        :data="tableData2"
                        border
                        style="width: 100%">
                    <el-table-column
                            prop="id"
                            label="编号"
                            width="60">
                    </el-table-column>
                    <el-table-column
                            prop="username"
                            label="姓名"
                            width="60">
                    </el-table-column>
                    <el-table-column
                            prop="sex"
                            label="性别"
                            width="50">
                    </el-table-column>
                    <el-table-column
                            prop="phonenumber"
                            label="电话"
                            width="80">
                    </el-table-column>
                    <el-table-column
                            prop="city"
                            label="城市"
                            width="100">
                    </el-table-column>
                    <el-table-column
                            prop="address"
                            label="详细地址"
                            width="180">
                    </el-table-column>
                    <el-table-column
                            prop="serve"
                            label="所选服务"
                            width="200">
                    </el-table-column>
                    <el-table-column
                            prop="date"
                            label="提交日期"
                            width="80">
                    </el-table-column>
                    <el-table-column
                            prop="content"
                            label="备注"
                            width="150">
                    </el-table-column>
                    <el-table-column
                            prop="do"
                            label="操作">
                        <template #default="obj">
                            <el-button type="success" size="mini" @click="confirm2(obj.row.id)">确认</el-button>
                            <el-button type="warning" size="mini" @click="modify(obj.row.id)">修改</el-button>
                            <el-button type="danger" size="mini" @click="del(obj.row.id)" icon="el-icon-delete" circle></el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </el-tab-pane>
            <el-tab-pane label="已完成的订单" name="3">
                <el-table
                        :data="tableData3"
                        border
                        style="width: 100%">
                    <el-table-column
                            prop="id"
                            label="编号"
                            width="60">
                    </el-table-column>
                    <el-table-column
                            prop="username"
                            label="姓名"
                            width="60">
                    </el-table-column>
                    <el-table-column
                            prop="sex"
                            label="性别"
                            width="50">
                    </el-table-column>
                    <el-table-column
                            prop="phonenumber"
                            label="电话"
                            width="80">
                    </el-table-column>
                    <el-table-column
                            prop="city"
                            label="城市"
                            width="100">
                    </el-table-column>
                    <el-table-column
                            prop="address"
                            label="详细地址"
                            width="180">
                    </el-table-column>
                    <el-table-column
                            prop="serve"
                            label="所选服务"
                            width="200">
                    </el-table-column>
                    <el-table-column
                            prop="date"
                            label="提交日期"
                            width="80">
                    </el-table-column>
                    <el-table-column
                            prop="content"
                            label="备注"
                            width="200">
                    </el-table-column>
                    <el-table-column
                            prop="do"
                            label="操作">
                        <template #default="obj">
                            <el-button type="warning" size="mini" @click="modify(obj.row.id)">修改</el-button>
                            <el-button type="danger" size="mini" @click="del(obj.row.id)" icon="el-icon-delete" circle></el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </el-tab-pane>
        </el-tabs>

<!--        dig1:修改dig-->
        <el-dialog
                :visible.sync="dialogVisibleModify"
                width="50%"
               >
            <template >
                <el-form ref="editForm" :model="editForm" label-width="80px" :rules="editFormRules">
                    <el-form-item label="编号">
                        <el-input v-model="editForm.id" disabled></el-input>
                    </el-form-item>
                    <el-form-item label="姓名" prop="username">
                        <el-input v-model="editForm.username"></el-input>
                    </el-form-item>
                    <el-form-item label="性别" prop="sex">
                        <el-radio-group v-model="editForm.sex" style="display: block;float:left;margin-top: 10px">
                            <el-radio label="男"></el-radio>
                            <el-radio label="女"></el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="电话" prop="phonenumber">
                        <el-input v-model="editForm.phonenumber"></el-input>
                    </el-form-item>
                    <el-form-item label="城市" prop="city">
                        <el-input v-model="editForm.city"></el-input>
                    </el-form-item>
                    <el-form-item label="详细地址" prop="address">
                        <el-input v-model="editForm.address"></el-input>
                    </el-form-item>
                    <el-form-item label="所选服务" prop="serve">
                        <el-select v-model="editForm.serve" style="display: block;float:left">
                            <el-option label="刷新服务" value="刷新服务"></el-option>
                            <el-option label="墙面基检" value="墙面基检"></el-option>
                            <el-option label="刷新服务&&墙面基检" value="刷新服务&&墙面基检"></el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="提交日期" prop="date">
                        <el-row :span="6">
                            <el-date-picker   placeholder="选择日期" v-model="editForm.date1" style="width: 100%;"></el-date-picker>
                        </el-row>
                        <el-col class="line" :span="2">-</el-col>
                        <el-col :span="6"></el-col>
                        <el-form-item prop="date2">
                            <el-time-picker  placeholder="选择时间" v-model="editForm.date2" style="width: 100%;"></el-time-picker>
                        </el-form-item>
                    </el-form-item>
                    <el-form-item label="备注" prop="content">
                        <el-input type="textarea" v-model="editForm.content"></el-input>
                    </el-form-item>
                </el-form>
            </template>

            <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisibleModify = false">取 消</el-button>
    <el-button type="primary" @click="submit">提交</el-button>
  </span>
        </el-dialog>
<!--        分页-->
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
    let value=1;
    export default {
        name: "NewServeOrder",
        data: () => ({
            dialogVisibleModify:false,
            tableData1:[],
            tableData2:[],
            tableData3:[],
            editFormRules:{
                username:[
                    { required: true, message: '该栏不能为空', trigger: 'blur' },
                    { min: 2, max: 5, message: '长度在 2 到 5 个字符', trigger: 'blur' }
                ],
                sex:[
                    { required: true, message: '该栏不能为空', trigger: 'blur' },
                ],
                phonenumber:[
                    { required: true, message: '该栏不能为空', trigger: 'blur' },
                    { min: 7, max: 11, message: '长度在 7 到 11 个数字', trigger: 'blur' }
                ],
                city:[
                    { required: true, message: '该栏不能为空', trigger: 'blur' },
                ],
                address:[
                    { required: true, message: '该栏不能为空', trigger: 'blur' },
                ],
                serve:[
                    { required: true, message: '该栏不能为空', trigger: 'blur' },
                ],
                date:[
                    { required: true, message: '该栏不能为空', trigger: 'blur' },
                ],
            },
            editForm:{
                id:"",
                username:"",
                sex:"",
                phonenumber:"",
                city:"",
                address:"",
                serve:"",
                date1:"",
                date2:"",
                content:""
            },
            activeName: '1',
            page:'',
            pageSize:6,
            total:'',
        }),
        methods: {
            fetchData() {
                if(value!=this.activeName){
                    this.$axios.get(this.$api.SERVEORDERSELECT,{state:this.activeName,page:1,size:this.pageSize}).then(res => {

                        if (res.data.code === 200) {

                            if(res.data.data.length===0){
                                if(this.activeName==1){
                                    this.tableData1=[];
                                }
                                if(this.activeName==2){
                                    this.tableData2=[];
                                }
                                if(this.activeName==3){
                                    this.tableData3=[];
                                }
                            }else{
                                this.total=res.data.total.length;
                                if(res.data.data[0].state===1){
                                    this.tableData1 = res.data.data;
                                }else if(res.data.data[0].state===2){
                                    this.tableData2=res.data.data;
                                }else if(res.data.data[0].state===3){
                                    this.tableData3=res.data.data;
                                }
                            }
                        }
                    })
                }
                else{
                    this.$axios.get(this.$api.SERVEORDERSELECT,{state:this.activeName,page:this.page,size:this.pageSize}).then(res => {

                        if (res.data.code === 200) {

                            if(res.data.data.length===0){
                                if(this.activeName==1){
                                    this.tableData1=[];
                                }
                                if(this.activeName==2){
                                    this.tableData2=[];
                                }
                                if(this.activeName==3){
                                    this.tableData3=[];
                                }
                            }else{
                                this.total=res.data.total.length;
                                if(res.data.data[0].state===1){
                                    this.tableData1 = res.data.data;
                                }else if(res.data.data[0].state===2){
                                    this.tableData2=res.data.data;
                                }else if(res.data.data[0].state===3){
                                    this.tableData3=res.data.data;
                                }
                            }


                        }
                    })
                }


            },
            handleClick(){
                this.fetchData();
            },
            pageChange(){
                this.fetchData();
            },
            confirm1(id){
                value=this.activeName;
                this.$axios.post(this.$api.SERVEORDERCONFIRM1,{id:id}).then(res=>{
                    if(res.data.code===200){
                        this.fetchData();
                        this.$message.success("状态更改成功!");
                    }else{
                        this.$message("状态更改错误!")
                    }
                })
            },
            confirm2(id){
                value=this.activeName;
                this.$axios.post(this.$api.SERVEORDERCONFIRM2,{id:id}).then(res=>{
                    if(res.data.code===200){
                        this.fetchData();
                        this.$message.success("状态更改成功!");
                    }else{
                        this.$message("状态更改错误!")
                    }
                })
            },
            modify(id){
                this.dialogVisibleModify=true;
                this.$axios.get(this.$api.SERVEORDERMODIFY,{id:id}).then(res=>{
                    if(res.data.code===200){
                        //给两个时间框赋值
                        let dateArr=res.data.data.date.split(" ");
                        this.editForm=res.data.data;
                        this.editForm.date1=dateArr[0];
                        this.editForm.date2=res.data.data.date;
                    }
                })
            },
            submit(){
                this.$refs.editForm.validate(vali=>{
                    if(vali){
                        //先将gmt转化为普通格式时间
                        this.editForm.date1=this.GMTToStr1(this.editForm.date1)
                        this.editForm.date2=this.GMTToStr2(this.editForm.date2)
                        this.$axios.post(this.$api.SERVEORDERALTER,this.editForm).then(res => {
                            if (res.data.code === 200) {
                                this.fetchData()
                                this.$message.success("修改成功!");
                            }
                        });
                        this.dialogVisibleModify=false;
                    }else{
                        return false;
                    }
                });
            },
            del(id){
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$axios.delete(this.$api.SERVEORDERDELETE,{id:id}).then(res=>{
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
            //时间转换函数(年月日)
            GMTToStr1(time){
                let date=new Date(time);
                let Str=date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate()+' ';
                return Str;
            },
            //时间从转换函数(时分秒)
            GMTToStr2(time){
                let date=new Date(time);
                let Str=date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
                return Str;
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
    .order-el-page{
        margin-top: 50px;
    }
</style>