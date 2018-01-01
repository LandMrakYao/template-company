/**
* 文章列表
* User: 梁晓伟  lxw11109@gmail.com
* Date: 2017-11-08
* Time: 17:40
*/
<template>
    <div>
        <h3 style="margin-left:50px;">文章列表</h3>
        <hr>
        <el-button type="primary" style="float:right;margin-right:100px;margin-bottom:10px;" @click="addArticle()">
            新增文章
        </el-button>
        <div style="margin-left:20px;margin-top:30px;">
            <el-table
                    :data="articleDetail"
                    v-loading="loading"
                    element-loading-text="拼命加载中"
                    element-loading-spinner="el-icon-loading"
                    style="width: 100%">
                <el-table-column
                        prop="articleSort"
                        label="排序">
                </el-table-column>

                <el-table-column
                        prop="articleTitle"
                        label="标题名称">
                </el-table-column>
                <el-table-column
                        prop="created_at"
                        label="创建时间">
                </el-table-column>
                <el-table-column
                        label="操作"
                        inline-template
                        width="200"
                >
                    <template>
                        <el-button @click="show(row)" type="text" size="small"><i class="el-icon-edit"></i></el-button>
                        <el-button @click.native.prevent="destroy($index, row)" type="text" size="small"><i
                                class="el-icon-delete"></i>
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>

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
                acId: 0,
                articleDetail: [],
                total: 0,
                loading: false,
                pageSize: 15
            }

        },
        created: function () {
            this.acId = this.$route.query.acId
            this.getArticleCategory()
        },
        methods: {
            getArticleCategory() {
                let vm = this;
                vm.loading = true
                this.$http.get("/api/article?acId=" + vm.acId).then(response => {
                    let res = response.data.resultData;
                    vm.articleDetail = res.article;
                    vm.total = res.totalNum;
                    vm.loading = false
                })
            },
            handleCurrentChange(page) {
                let vm = this;
                vm.loading = true
                this.$http.get("/api/article?acId=" + vm.acId + "&page=" + page).then(response => {
                    let res = response.data.resultData.article
                    vm.articleDetail = res
                    vm.loading = false
                })
            },
            show(row) {
                let articleId = row.articleId;
                window.location.href = '/#/articleContent?articleId=' + articleId + "&acId=" + this.acId
                // this.$router.push('articleContent?articleId='+articleId+"&acId="+this.acId);
            },
            destroy(index, row) {
                this.$confirm('确定删除此文章吗？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$http.delete("/api/article/" + row.articleId).then(response => {
                        this.articleDetail.splice(index, 1)
                        this.$message({
                            type: 'success',
                            message: '删除成功!',
                            customClass: 'messageTop'
                        });
                    })

                }).catch(() => {
                });
            },
            addArticle(){
                window.location.href = '/#/articleContent?articleId=' + 0 + "&acId=" + this.acId
            }
        }
    }
</script>