<template>
    <div>
        <el-container v-if="isLogin">

            <el-container style="border: 1px solid #eee">
                <el-aside width="200px" style="background-color: rgb(238, 241, 246)">
                    <div style="text-align: center;height: 60px;">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                        <span class="logo-mini" v-if="isCollapse"><b>LA</b></span>
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg" v-if="!isCollapse"><b>Laravel</b>-Admin</span>
                    </div>
                    <el-menu
                            :default-active="active"
                            class="el-menu-custom"
                            :collapse="isCollapse"
                            :router="true"
                            style="border-right: 0"
                    >
                        <el-submenu :index="menu.id + ''" v-for="menu in menus" :key="menu.id">
                            <template slot="title">
                                <a class="menu-icon" v-html="menu.icon"></a>
                                <span slot="title">{{menu.label}}</span>
                            </template>
                            <el-menu-item :index="menu.id + '-' + child.id" :route="child.path" v-for="child in menu.children" :key="child.id">{{child.label}}</el-menu-item>
                        </el-submenu>

                    </el-menu>
                </el-aside>

                <el-container>

                    <el-header style="text-align: right; font-size: 12px">
                        <el-dropdown>
                            <i class="el-icon-setting" style="margin-right: 15px"></i>
                            <el-dropdown-menu slot="dropdown">
                                <el-dropdown-item>
                                    <router-link :to="'/system/profile'" >
                                        <el-button type="text" @click="">设置</el-button>
                                    </router-link>
                                </el-dropdown-item>
                                <el-dropdown-item>
                                    <el-button type="text" @click="logout">退出</el-button>
                                </el-dropdown-item>
                                <!--<el-dropdown-item>删除</el-dropdown-item>-->
                            </el-dropdown-menu>
                        </el-dropdown>
                        <span>{{userInfo.username}}</span>
                    </el-header>

                    <el-main style="background-color: white">
                        <el-breadcrumb separator="/">
                            <el-breadcrumb-item :to="{ path: item.name }" v-for="item in navBre" :key="item.id">{{item.title}}</el-breadcrumb-item>
                        </el-breadcrumb>
                        <hr style="color:#ccc;"/>
                        <router-view>

                        </router-view>
                    </el-main>

                    <!--<el-footer class="main-footer" style="padding:15px">-->
                        <!--<strong>Copyright © 2018 <a href="http://xxx">Laravel-Admin</a>.</strong>  All rights reserved.-->
                    <!--</el-footer>-->
                </el-container>
            </el-container>
        </el-container>

        <!-- 登录 --->
        <el-container v-if="!isLogin" class="login-panel">
            <el-row class="login-form">
                <el-alert
                        :title="error"
                        type="error" v-if="error">
                </el-alert>
                <el-form label-position="top" label-width="80px" :model="form" ref="form" :rules="ruleForm" >
                    <el-form-item label="用户名" prop="username">
                        <el-input v-model="form.username" autocomplete="on" name="username"></el-input>
                    </el-form-item>
                    <el-form-item label="密码" prop="password">
                        <el-input type="password" v-model="form.password" autocomplete="on" name="password"></el-input>
                    </el-form-item>

                    <el-form-item >
                        <el-button type="primary" @click="login('form')" size="samll">登录</el-button>
                    </el-form-item>
                </el-form>
            </el-row>
        </el-container>
    </div>
</template>

<script>
    export default {
        name: 'app',
        mounted() {
            this.userInfo = JSON.parse(window.sessionStorage.getItem('userInfo'));
            this.isLogin = this.userInfo !== null;

            //定位默认菜单
            if(this.isLogin) {
                this.menus = this.userInfo.menus;
                console.log(this.menus)
            }
        },
        data() {
            return {
                isCollapse:false,
                asideWidth:'230px',
                logoStyle:'',
                navbarStyle:'',
                isLogin:false,
                form:{},
                ruleForm:{
                    username: [
                        { required: true, message: '请输入用户名', trigger: 'blur' }
                    ],
                    password: [
                        { required: true, message: '请输入密码', trigger: 'blur' }
                    ],
                },
                userInfo:{},
                error:'',
                menus:[],
                active:'',
                hash:location.hash,
                navBre:[]
            }
        },
        watch: {
            $route: function (route) {
                if(!this.isLogin) {
                    return;
                }
                this.routeChange(route.path);
            },
        },
        methods: {
            switchNav() {
                this.isCollapse = !this.isCollapse;
                if(this.isCollapse) {
                    this.asideWidth = '64px';
                    this.logoStyle = 'width:64px';
                    this.navbarStyle = 'margin-left:64px;'
                } else {
                    this.asideWidth = '230px';
                    this.logoStyle = 'width:230px';
                    this.navbarStyle = 'margin-left:230px;'
                }
            },
            routeChange(path) {
                this.$http.post('/api/system/get/path/info', {path:path}).then(res => {
                    if(res.error === 0) {
                        this.navBre = res.data;
                        this.active = this.navBre[0].id + '-' + this.navBre[1].id;
                    }
                });
            },
            login(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/api/login', this.form).then(res => {
                            if(res.error === 0) {
                                window.sessionStorage.setItem('userInfo', JSON.stringify(res.data));
                                location.reload();
                            } else {
                                this.error = res.msg;
                            }
                        });
                    }
                });
            },
            toDate(times){
                let date = new Date(times * 1000);
                let Y = date.getFullYear() + '/';
                let M = (date.getMonth() + 1 < 10 ? '0'+(date.getMonth() + 1) : date.getMonth() + 1) + '/';
                let D = date.getDate() + ' ';
                return Y + M + D;
            },

            logout() {
                this.$http.post('/api/logout', this.form).then(res => {
                    if(res.error === 0) {
                        window.sessionStorage.removeItem('userInfo');
                        location.reload();
                    } else {
                        this.error = res.msg;
                    }
                });
            }
        }
    }
</script>

<style>
    body {
        background-color: #F1F1F1;
    }
    .login-form {
        background-color: #FFF;
        width: 350px;
        margin-left: auto;
        margin-right: auto;
        padding: 30px;
        margin-top: 100px;
    }
    .el-header {
        background-color: #B3C0D1;
        color: #333;
        line-height: 60px;
    }

    .el-aside {
        color: #333;
    }
</style>
