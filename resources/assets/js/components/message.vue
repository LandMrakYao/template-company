/**
*
* User: 梁晓伟  lxw11109@gmail.com
* Date: 2017-10-27
* Time: 17:30
*/
<template>
    <div>
        <h3 style="margin-left:50px;">留言</h3>
        <hr>
        <div style="margin-left:20px;margin-top:30px;">
            <el-table
                    :data="message"
                    v-loading="loading"
                    element-loading-text="拼命加载中"
                    element-loading-spinner="el-icon-loading"

                    style="width: 100%">
                <el-table-column
                        prop="createTime"
                        label="时间"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="ip"
                        label="IP"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="phone"
                        label="联系方式"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="message"
                        label="留言">
                </el-table-column>
            </el-table>
        </div>
        <div align="center" style="margin-top: 20px;">
            <el-pagination
                    @current-change="handleCurrentChange"
                    :page-size="pageSize"
                    layout="prev, pager, next, jumper"
                    :total= "total">
            </el-pagination>
        </div>

    </div>
</template>
<script>
    export default {
        data() {
            return {
                message:[],
                total:0,
                loading:false,
                pageSize:15

            }
        },
        created: function () {
                this.getMessage();
        },
        methods : {
            getMessage(){
                let vm = this;
                vm.loading = true
                this.$http.get("/api/message").then(response=>{
                    let res = response.data.resultData.message
                    vm.message = res
                    vm.total = response.data.resultData.totalNum
                    vm.loading = false
                })
            },
            handleCurrentChange(page) {
                let vm = this;
                vm.loading = true
                this.$http.get("/api/message?page="+page).then(response=>{
                    let res = response.data.resultData.message
                    vm.message = res
                    vm.loading = false
                })
            }
        }
    }
</script>