/**
*
* User: 梁晓伟  lxw11109@gmail.com
* Date: 2017-12-30
* Time: 15:30
*/
<template>
    <div>
        <h3 style="margin-left:50px;">友情链接</h3>
        <hr>
        <el-button type="primary" style="float:right;margin-right:100px;margin-bottom:10px;"
                   @click="editFriendship()">
            新增友情链接
        </el-button>
        <el-table
                :data="friendship"
                v-loading="loading"
                element-loading-text="拼命加载中"
                element-loading-spinner="el-icon-loading"
                style="width: 100%">
            <el-table-column
                    prop="friendshipId"
                    label="ID">
            </el-table-column>

            <el-table-column
                    prop="urlName"
                    label="名称">
            </el-table-column>
            <el-table-column
                    prop="url"
                    label="链接地址">
            </el-table-column>
            <el-table-column
                    label="操作"
                    width="200"
            >
                <template slot-scope="row">

                    <el-button type="text" @click="editFriendship(row)" size="small">编辑</el-button>
                    <el-button type="text" @click="destroyFriendship(row)" size="small">删除</el-button>
                </template>
            </el-table-column>
        </el-table>

        <el-dialog title="编辑友情链接" :visible.sync="friendshipVisible">
            <el-form :model="form" :rules="rules" ref="form" class="demo-ruleForm">
                <el-form-item label="名称" :label-width="formLabelWidth" prop="urlName">
                    <el-input v-model="form.urlName"></el-input>
                </el-form-item>
                <el-form-item label="链接地址" :label-width="formLabelWidth" prop="url">
                    <el-input v-model="form.url" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item>

                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="friendshipVisible = false">取 消</el-button>
                <el-button type="primary" @click="saveFriendshipVisible('form')">确 定</el-button>
            </div>
        </el-dialog>

    </div>
</template>

<script>
    export default {
        data() {
            var reg = /(http|ftp|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&:/~\+#]*[\w\-\@?^=%&/~\+#])?/;

            var urlReg = (rule, value, callback) => {
                if (!reg.test(value)) {
                    callback(new Error('请输入正确的网址'));
                } else {
                    callback();
                }
            };
            return {
                friendship: [],
                friendshipVisible: false,
                form: {
                    friendshipId: 0,
                    urlName: '',
                    url: ''
                },
                formLabelWidth: '120px',
                rules: {
                    urlName: [
                        {required: true, message: '请输入名称', trigger: 'blur'},
                    ],
                    url: [
                        {validator: urlReg, trigger: 'blur'},
                    ],
                },
                loading:true
            }
        },
        created: function () {
            this.getFriendshipId()
        },
        methods: {
            getFriendshipId() {
                let vm = this;
                vm.loading = true
                this.$http.get("/api/friendship").then(response => {
                    let res = response.data.resultData;
                    vm.friendship = res;
                    vm.loading = false
                })
            },
            editFriendship(row){
                if (row) {
                    this.form.url = row.url
                    this.form.urlName = row.urlName
                    this.form.friendshipId = row.friendshipId
                }else{
                    this.form.url = ''
                    this.form.urlName = ''
                    this.form.friendshipId = 0
                }
                this.friendshipVisible = true
            },
            saveFriendshipVisible(formName){
                let vm = this
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post("/api/friendship", this.form).then((response => {
                            if (response.data.resultStatus) {
                                vm.$message({
                                    message: "保存成功",
                                    type: 'success',
                                    customClass: 'messageTop'
                                });
                                vm.friendshipVisible = false
                                vm.getFriendshipId()
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
                    } else {
                        return false;
                    }
                });
            },
            destroyFriendship(row){
                this.$confirm('确定删除吗？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$http.delete("/api/friendship/" + row.friendshipId).then(response => {
                        this.$message({
                            type: 'success',
                            message: '删除成功!',
                            customClass: 'messageTop'
                        });
                        this.getFriendshipId()
                    })
                }).catch(() => {
                });
            }
        }
    }
</script>