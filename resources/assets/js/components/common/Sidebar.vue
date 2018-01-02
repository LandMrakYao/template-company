<template>
    <div class="sidebar">
        <el-menu :default-active="onRoutes" class="el-menu-vertical-demo" theme="dark" unique-opened router>
           <!-- <el-menu-item index="index">
                <i class="el-icon-setting"></i>自述
            </el-menu-item>-->
            <el-submenu index="2">
                <template slot="title"><i class="el-icon-setting"></i>系统管理</template>
                <el-menu-item index="site">站点管理</el-menu-item>
                <el-menu-item index="message">留言管理</el-menu-item>
            </el-submenu>
            <el-submenu index="3">
                <template slot="title"><i class="el-icon-date"></i>文章管理</template>
                <el-menu-item index="articleCategory">文章列表</el-menu-item>
            </el-submenu>
            <el-submenu index="4">
                <template slot="title"><i class="el-icon-menu"></i>产品管理</template>
                <el-menu-item index="articleCategory">产品列表</el-menu-item>
            </el-submenu>
            <el-submenu index="5">
                <template slot="title"><i class="el-icon-picture"></i>图片管理</template>
                <el-menu-item index="pictureCategory">图片分类</el-menu-item>
                <el-menu-item index="picture">图片列表</el-menu-item>
            </el-submenu>
            <el-submenu index="6">
                <template slot="title"><i class="el-icon-more"></i>友情链接管理</template>
                <el-menu-item index="friendship">友情链接设置</el-menu-item>
            </el-submenu>
        </el-menu>
    </div>
</template>
<script>
    export default {
        computed: {
            onRoutes(){
                return this.$route.path.replace('/', '');
            }
        }
    }
</script>
<style scoped>
    .sidebar {
        display: block;
        position: fixed;
        width: 250px;
        left: 0;
        top: 70px;
        bottom: 0;
        background: #2E363F;
    }

    .sidebar > ul {
        height: 100%;
    }
</style>