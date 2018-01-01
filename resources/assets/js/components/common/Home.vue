<template>
    <div class="wrapper">
        <top></top>
        <sidebar></sidebar>
        <div class="content">
            <transition name="move" mode="out-in">
                <router-view></router-view>
            </transition>
        </div>
    </div>
</template>
<style>
    .content {
        margin-left: 250px;
        margin-top: 100px;
    }
</style>
<script>
    import top from './Header.vue';
    import sidebar from './Sidebar.vue';
    export default {
        components: {
            top, sidebar
        }
    }
</script>