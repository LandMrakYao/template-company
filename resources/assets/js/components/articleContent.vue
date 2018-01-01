/**
* 文章内容
* User: 梁晓伟  lxw11109@gmail.com
* Date: 2017-11-09
* Time: 20:25
*/
<template>
    <div>
        <h3 style="margin-left:50px;">文章内容</h3>
        <hr>
        <div style="margin-left:20px;margin-top:30px;">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
                <el-form-item label="标题" prop="articleTitle">
                    <el-input v-model="ruleForm.articleTitle" style="width:400px;"></el-input>
                </el-form-item>
                <el-form-item label="排序" prop="articleSort">
                    <el-input v-model="ruleForm.articleSort" style="width:400px;"></el-input>
                </el-form-item>
                <el-form-item label="图片" prop="imageUrl">
                    <el-upload
                            class="avatar-uploader"
                            action="/api/upload"
                            :show-file-list="false"
                            :on-success="uploadSuccess"
                    >
                        <img v-if="ruleForm.imageUrl" :src="ruleForm.imageUrl" class="avatar">
                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                    </el-upload>
                </el-form-item>
                <el-form-item label="内容">
                    <div id="editor" type="text/plain" style="width:1024px;height:500px;"></div>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="submitForm('ruleForm')">保存</el-button>
                    <el-button type="primary" @click="goBack()">返回</el-button>
                </el-form-item>
            </el-form>

        </div>
    </div>
</template>
<style>
    .btn {
        margin: 0 auto;
    }

    .avatar-uploader .el-upload {
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

    .el-upload__input {
        display: none !important;
    }
</style>
<script>
    export default {
        data() {
            return {
                ruleForm: {
                    articleTitle: '',
                    articleSort: 1,
                    imageUrl: '',
                    articleContent: ''
                },
                imageUrl: false,
                articleId: 0,
                acId: 0,
                loading: false,
                ue: '',
                rules: {
                    articleTitle: [
                        {required: true, message: '请输入文章标题', trigger: 'blur'},
                    ],
                },
            }
        },
        mounted() {
            var vm = this
            vm.ue = UE.getEditor('editor', {
                BaseUrl: '127.0.0.1',
                UEDITOR_HOME_URL: '/js/ueditor/',
            });

        },
        created: function () {
            this.articleId = this.$route.query.articleId
            this.acId = this.$route.query.acId
            this.getArticleContent()
        },
        destroyed() {
            this.ue.destroy();
        },
        methods: {
            getArticleContent() {
                let vm = this;
                vm.loading = true
                this.$http.get("/api/article/" + vm.articleId).then(response => {
                    let res = response.data.resultData
                    vm.ruleForm.articleContent = res.articleContent
                    vm.ruleForm.articleSort = res.articleSort
                    vm.ruleForm.imageUrl = res.imageUrl
                    vm.ruleForm.articleTitle = res.articleTitle
                    vm.ue.ready(function () {
                        if (vm.ruleForm.articleContent) {
                            UE.getEditor('editor').setContent(vm.ruleForm.articleContent);
                        }
                    })
                    vm.loading = false
                })
            },
            submitForm(formName) {
                const vm = this;
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        vm.$http.post("/api/article", {
                            "articleTitle": vm.ruleForm.articleTitle,
                            "articleSort": vm.ruleForm.articleSort,
                            "imageUrl": vm.ruleForm.imageUrl,
                            "articleId": vm.articleId,
                            "acId": vm.acId,
                            "articleContent": UE.getEditor('editor').getContent()
                        }).then((response) => {
                            if (response.data.resultStatus) {
                                vm.$message({
                                    message: "保存成功",
                                    type: 'success',
                                    customClass: 'messageTop'
                                });
                            } else {
                                vm.$message({
                                    message: response.data.errorMessage,
                                    type: 'error',
                                    customClass: 'messageTop'
                                });
                            }
                        }, (error) => {
                            vm.$message({
                                message: "未知异常",
                                type: 'error',
                                customClass: 'messageTop'
                            });
                        });
                    } else {
                        return false;
                    }
                });
            },
            uploadSuccess(data) {
                if (data.resultStatus) {
                    this.ruleForm.imageUrl = data.resultData
                    this.imageUrl = true
                } else {
                    this.$message.error(data.errorMessage);
                }
            },
            goBack(){
                window.history.go(-1);
            }
        }
    }
</script>