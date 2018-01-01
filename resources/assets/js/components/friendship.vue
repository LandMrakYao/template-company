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
                    inline-template
                    width="200"
            >
                <template slot-scope="row">

                    <el-button type="text" @click="editFriendship(row)" size="small">编辑</el-button>
                    <el-button type="text" @click="destroyFriendship(row)" size="small">删除</el-button>
                </template>
            </el-table-column>
        </el-table>

        <el-dialog title="编辑友情链接" :visible.sync="friendshipVisible">
            <el-form :model="form">
                <el-form-item label="名称" :label-width="formLabelWidth">
                    <el-input v-model="form.urlName" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="链接地址" :label-width="formLabelWidth">
                    <el-input v-model="form.url" auto-complete="off"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="friendshipVisible = false">取 消</el-button>
                <el-button type="primary" @click="saveFriendshipVisible()">确 定</el-button>
            </div>
        </el-dialog>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                friendship: [],
                friendshipVisible: false,
                form: {
                    friendshipId: 0,
                    urlName: '',
                    url: ''
                },
                formLabelWidth: '120px',
            }
        },
        created: function () {
            this.getFriendshipId()
        },
        methods: {
            getFriendshipId() {
                let vm = this;
                this.$http.get("/api/friendship").then(response => {
                    let res = response.data.resultData;
                    vm.friendship = res;
                })
            },
            editFriendship(row){
                if (row) {
                    this.form.url = row.url
                    this.form.urlName = row.urlName
                    this.form.friendshipId = row.friendshipId
                }
                this.friendshipVisible = true
            },
            saveFriendshipVisible(){
                let vm = this
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