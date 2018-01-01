<template>
        <div>
            <img alt="element-logo" src="http://cdn.aixifan.com/acfun-pc/1.9.4/img/logo.png" />
            <div class="nav">
                <el-menu @select="handleSelect" class="el-menu-demo" default-active="1" mode="horizontal" theme="dark">
                    <el-menu-item index="1">
                        处理中心
                    </el-menu-item>
                    <el-submenu index="2">
                        <template slot="title">
                            我的工作台
                        </template>
                        <el-menu-item index="2-1">
                            选项1
                        </el-menu-item>
                        <el-menu-item index="2-2">
                            选项2
                        </el-menu-item>
                        <el-menu-item index="2-3">
                            选项3
                        </el-menu-item>
                    </el-submenu>
                    <el-menu-item index="3">
                        订单管理
                    </el-menu-item>
                    <el-menu-item index="4">
                        退出
                    </el-menu-item>
                </el-menu>
                <div class="line"></div>
            </div>
        </div>
</template>

<script>
    export default {
        name: 'Header',
        data () {
        },
        methods: {
            handleSelect: function (key, keyPath) {
                console.log(key, keyPath)
            }
        }
    }
</script>

<style scoped>
    .nav {
        float: right;
        line-height: 80px;
        background: transparent;
        padding: 0;
        margin: 0;
    }
</style>