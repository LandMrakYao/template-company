/**
* 文章分类列表
* User: 梁晓伟  lxw11109@gmail.com
* Date: 2017-10-27
* Time: 18:31
articleCategory
**/
<template>
    <div>
        <h3 style="margin-left:50px;">文章分类</h3>
        <hr>
        <el-button type="primary" style="float:right;margin-right:100px;margin-bottom:10px;"
                   @click="editArticleCategory()">
            新增分类
        </el-button>
        <el-table
                :data="articleCategory"
                style="width: 100%">
            <el-table-column
                    prop="acId"
                    label="acId">
            </el-table-column>
            <el-table-column
                    prop="acName"
                    label="分类名称">
            </el-table-column>
            <el-table-column
                    prop="acSort"
                    label="排序">
            </el-table-column>
            <el-table-column
                    label="操作"
                    width="200"
            >
                <template slot-scope="row">
                    <el-button @click="show(row)" type="text" size="small">查看</el-button>
                    <el-button type="text" @click="editArticleCategory(row, $index)" size="small">编辑</el-button>
                    <el-button type="text" @click="destroyArticleCategory(row, $index)" size="small">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-dialog title="编辑分类" :visible.sync="articleCategoryVisible">
            <el-form :model="form">
                <el-form-item label="分类名称" :label-width="formLabelWidth">
                    <el-input v-model="form.acName" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="排序" :label-width="formLabelWidth">
                    <el-input v-model="form.acSort" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="上级分类" :label-width="formLabelWidth">
                    <el-select v-model="form.acParentId" placeholder="请选择分类">
                        <el-option
                                v-for="item in articleCategorySelect"
                                :key="item.acId"
                                :label="item.acName"
                                :value="item.acId"
                                :disabled="item.disabled">
                        </el-option>
                    </el-select>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="articleCategoryVisible = false">取 消</el-button>
                <el-button type="primary" @click="saveArticleCategory()">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                articleCategory: [],
                articleCategoryVisible: false,
                form: {
                    acParentId: "",
                    acName: '',
                    acSort: '',
                    acId: ''
                },
                articleCategorySelect: [],
                formLabelWidth: '120px',
            }
        },
        created: function () {
            this.getArticleCategory()
        },
        methods: {
            getArticleCategory() {
                let vm = this;
                this.$http.get("/api/article/category").then(response => {
                    let res = response.data.resultData;
                    vm.articleCategory = res;
                    for (let i = 0; i < res.length; i++) {
                        let temp = '';
                        let level = res[i]['level'];
                        for (let j = 0; j < level; j++) {
                            temp += " |—  ";
                        }
                        vm.articleCategory[i].acNameTemp = vm.articleCategory[i].acName;
                        vm.articleCategory[i].acName = temp + vm.articleCategory[i].acName;
                    }
                })
            },
            show(row) {
                let acId = row.acId;
                this.$router.push('articleDetail?acId=' + acId);
            },
            editArticleCategory(row, index){
                this.articleCategorySelect = [{
                    acParentId: "",
                    acName: "请选择分类"
                }]
                if (row) {
                    this.form.acParentId = row.acParentId ? row.acParentId : ""
                    this.form.acName = this.articleCategory[index].acNameTemp
                    this.form.acSort = row.acSort
                    this.form.acId = row.acId
                    if (!this.form.acParentId) {
                        this.articleCategorySelect[0].disabled = true
                    }
                } else {
                    this.form.acParentId = ""
                    this.form.acName = ""
                    this.form.acSort = ""
                    this.form.acId = 0
                }
                this.articleCategorySelect = this.articleCategorySelect.concat(this.articleCategory)
                this.articleCategoryVisible = true
                for (let i = 1; i < this.articleCategorySelect.length; i++) {
                    console.log(this.articleCategorySelect[i].acId, this.form.acId)
                    if (this.articleCategorySelect[i].acId === this.form.acId) {
                        this.articleCategorySelect[i].disabled = true
                    } else {
                        this.articleCategorySelect[i].disabled = false
                    }
                }

            },
            saveArticleCategory(){
                let vm = this
             //   this.form.acParentId = this.form.acParentId ? this.form.acParentId : 0
                this.$http.post("/api/article/category", this.form).then((response => {
                    if (response.data.resultStatus) {
                        vm.$message({
                            message: "保存成功",
                            type: 'success',
                            customClass: 'messageTop'
                        });
                        vm.articleCategoryVisible = false
                        vm.getArticleCategory()
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
            destroyArticleCategory(row, index){
                this.$confirm('确定删除此分类吗？', '对应的子分类也会删除', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$http.delete("/api/article/category/" + row.acId).then(response => {
                        this.$message({
                            type: 'success',
                            message: '删除成功!',
                            customClass: 'messageTop'
                        });
                        this.getArticleCategory()
                    })
                }).catch(() => {
                });
            }
        }
    }
</script>