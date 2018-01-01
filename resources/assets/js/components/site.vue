/**
*
* User: 梁晓伟  lxw11109@gmail.com
* Date: 2017-10-26
* Time: 19:14
*/
<template>
    <div>
    <h3 style="margin-left:50px;">站点设置</h3>
        <hr>
    <div style= "margin: 0 auto ; width: 50%;margin-top:50px;">
    <el-form ref="form" :model="form" label-width="80px">
        <el-form-item label="公司名称">
            <el-input v-model="form.company"></el-input>
        </el-form-item>
        <el-form-item label="ICP证书号">
            <el-input v-model="form.recordNumber"></el-input>
        </el-form-item>
        <el-form-item label="域名">
            <div>
                <el-input v-model="form.url">
                    <template slot="prepend">Http://</template>
                </el-input>
            </div>
        </el-form-item>
        <el-form-item label="第三方流量统计">
            <el-input type="textarea" v-model="form.flow"></el-input>
        </el-form-item>
        <div style="text-align:center;">
            <el-button type="primary" @click="onSubmit">保存</el-button>
            <el-button>取消</el-button>
        </div>
        </el-form-item>
    </el-form>
    </div>
    </div>
</template>

<style>

</style>

<script>
    export default {
        data() {
            return {
                form: {
                    company: '',
                    recordNumber: '',
                    url: '',
                    flow: ''
                }
            }
        },
        created: function () {
            let vm = this;
            this.$http.get("/api/setting").then(response =>{
                let res = response.data.resultData;
                vm.form.company = res[0].value;
                vm.form.recordNumber = res[1].value;
                vm.form.url = res[2].value;
                vm.form.flow = res[3].value;
            });
        },
        methods: {
            onSubmit() {
                let vm = this;
               this.$http.post("/api/setting",{company:vm.form.company,recordNumber:vm.form.recordNumber,
                   url:vm.form.url,flow:vm.form.flow}).then(function (res) {
                   if(res.data.resultStatus){
                       vm.$message('修改成功');
                   }else{
                       vm.$message('修改失败');
                   }
               })
            }
        }
    }
</script>