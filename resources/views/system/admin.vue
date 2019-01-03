<template>
    <div>
        <el-form :inline="true" :model="form">
            <el-form-item label="ID">
                <el-input v-model="form.id" placeholder="ID"></el-input>
            </el-form-item>
            <el-form-item label="登录名">
                <el-input v-model="form.username" placeholder="请输入登录名"></el-input>
            </el-form-item>
            <el-form-item label="真实姓名">
                <el-input v-model="form.realname" placeholder="请输入真实姓名"></el-input>
            </el-form-item>
            <el-form-item label="手机号">
                <el-input v-model="form.mobile" placeholder="请输入手机号"></el-input>
            </el-form-item>
            <el-form-item label="邮箱">
                <el-input v-model="form.email" placeholder="请输入邮箱"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSearch">查询</el-button>
            </el-form-item>
        </el-form>

        <el-row>
            <el-button type="primary" size="small">新增</el-button>
        </el-row>

        <el-table :data="tableData">
            <el-table-column prop="id" label="ID" width="80"></el-table-column>
            <el-table-column prop="username" label="用户名"></el-table-column>
            <el-table-column prop="realname" label="真实姓名"></el-table-column>
            <el-table-column prop="mobile" label="手机号"></el-table-column>
            <el-table-column prop="email" label="邮箱"></el-table-column>
            <el-table-column label="用户状态" width="150">
                <template slot-scope="scope">
                    <el-tag type="success" v-if="scope.row.status == 1" size="small">正常</el-tag>
                    <el-tag type="info" v-if="scope.row.status == 2" size="small">禁用</el-tag>
                </template>
            </el-table-column>
            <el-table-column prop="last_login" label="最后登录时间"></el-table-column>
            <el-table-column prop="last_ip" label="最后登录IP"></el-table-column>
            <el-table-column prop="create_time" label="创建时间"></el-table-column>
            <el-table-column fixed="right" label="操作" width="100">
                <template slot-scope="scope">
                    <el-button type="text" size="small">编辑</el-button>
                </template>
            </el-table-column>
        </el-table>

        <br/>

        <el-row>
            <el-col :span="13" :offset="11">
                <el-pagination
                    background
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange"
                    :current-page="form.page"
                    :page-sizes="[10,20,30,40,50]"
                    :page-size="form.pageSize"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="totalItems"
                >
                </el-pagination>
            </el-col>
        </el-row>

        <br/>

        <el-dialog title="新增/修改管理员" :visible.sync="addNewDialog" width="35%">
            <el-form ref="saveForm" :model="saveForm" label-width="100px" size="small">
                <el-form-item label="登录名" prop="username">
                    <el-input></el-input>
                </el-form-item>
            </el-form>
        </el-dialog>

    </div>
</template>

<script>
    export default {
        name: "admin",
        mounted() {
            this.getList();
        },
        data(){
            return {
                form: {
                    page: 1,
                    pageSize: 20
                },
                tableData: [],
                totalItems: 0,
                addNewDialog: false,
                saveForm: {
                    id: '',
                    username: '',
                    password: '',
                    groups: [],
                    status: true
                }
            }
        },
        methods: {
            onSearch(){
                this.form.page = 1;
                this.getList();
            },
            handleSizeChange(size){
                this.form.pageSize = size;
            },
            handleCurrentChange(page){
                this.form.page = page;
                this.getList();
            },
            getList(){
                this.$http.post('/api/admin/list', this.form).then(res => {
                    this.tableData = res.data.list;
                    this.totalItems = res.data.total;
                    this.auth = res.data.auth;
                });
            }
        }
    }
</script>

<style scoped>

</style>
