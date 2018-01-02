/**
*
* User: 梁晓伟  lxw11109@gmail.com
* Date: 2018-01-01
* Time: 15:38
*/
<template>
    <div>
        <h3 style="margin-left:50px;">图片分类</h3>
        <hr>
        <el-button type="primary" style="float:right;margin-right:100px;margin-bottom:10px;"
                   @click="editPicture()">
            新增图片
        </el-button>
        <el-table
                :data="picture"
                v-loading="loading"
                element-loading-text="拼命加载中"
                element-loading-spinner="el-icon-loading"
                style="width: 100%">
            <el-table-column
                    prop="pictureId"
                    label="ID">
            </el-table-column>
            <el-table-column
                    prop="pictureName"
                    label="图片名字">
            </el-table-column>
            <el-table-column
                    prop="pictureCategoryName"
                    label="分类名字">
            </el-table-column>
            <el-table-column
                    prop="pictureUrl"
                    label="图片"
                    width="180">
                <template slot-scope="scope">
                    <img :src="scope.row.pictureUrl" width="40" height="40" />
                </template>

            </el-table-column>
            <el-table-column
                    prop="created_at"
                    label="创建时间">
            </el-table-column>
            <el-table-column
                    label="操作"
                    width="200"
            >
                <template slot-scope="row">
                    <el-button type="text" @click="editPicture(row, $index)" size="small">编辑</el-button>
                    <el-button type="text" @click="destroyPicture(row, $index)" size="small">删除</el-button>
                </template>
            </el-table-column>
        </el-table>

        <el-dialog title="编辑分类" :visible.sync="pictureVisible">
            <el-form :model="form">
                <el-form-item label="分类名称" :label-width="formLabelWidth">
                    <el-input v-model="form.pictureCategoryName" auto-complete="off"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="pictureCategoryVisible = false">取 消</el-button>
                <el-button type="primary" @click="savePictureCategory()">确 定</el-button>
            </div>
        </el-dialog>
        <div align="center" style="margin-top: 20px;">
            <el-pagination
                    @current-change="handleCurrentChange"
                    :page-size="pageSize"
                    layout="prev, pager, next, jumper"
                    :total="total">
            </el-pagination>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                picture: [],
                pictureVisible: false,
                form: {
                    pictureId: 0,
                    pictureUrl: '',
                    pictureName: '',
                    pictureCategoryId: '',
                    pictureSort: '',
                },
                formLabelWidth: '120px',
                total: 0,
                loading: false,
                pageSize: 20,
            }
        },
        created: function () {
            this.getPicture()
        },
        methods: {
            getPicture() {
                let vm = this;
                vm.loading = true
                this.$http.get("/api/picture").then(response => {
                    vm.picture = response.data.resultData.picture
                    vm.total = response.data.resultData.totalNum;
                    vm.loading = false
                })
            },
            handleCurrentChange(page) {
                let vm = this;
                vm.loading = true
                this.$http.get("/api/picture?page=" + page).then(response => {
                    vm.picture = response.data.resultData.picture
                    vm.loading = false
                })
            },
            editPictureCategory(row, index){
                this.pictureVisible = true
                console.log(row)
                if(row){
                    this.form.pictureCategoryId = row.pictureCategoryId
                    this.form.pictureCategoryName = row.pictureCategoryName
                }else{
                    this.form.pictureCategoryId = 0
                    this.form.pictureCategoryName = ''
                }
            },
            savePicture(){
                let vm = this
                this.$http.post("/api/picture", this.form).then((response => {
                    if (response.data.resultStatus) {
                        vm.$message({
                            message: "保存成功",
                            type: 'success',
                            customClass: 'messageTop'
                        });
                        vm.pictureVisible = false
                        vm.getPicture()
                    } else {
                        vm.$message({
                            message: response.data.errorMessage,
                            type: 'error',
                            customClass: 'messageTop'
                        });
                    }
                }), (error) => {
                    vm.$message({
                        message: "未知异常",
                        type: 'error',
                        customClass: 'messageTop'
                    });
                })

            },
            destroyPicture(row, index){
                this.$confirm('确定删除此图片吗？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$http.delete("/api/picture/" + row.pictureId).then(response => {
                        this.$message({
                            type: 'success',
                            message: '删除成功!',
                            customClass: 'messageTop'
                        });
                        this.getPicture()
                    })
                }).catch(() => {
                });
            }
        }
    }
</script>