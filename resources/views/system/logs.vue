<template>
    <div>
        <el-form :inline="true" size="small" :model="form" label-width="100px">
            <el-form-item label="管理员">
                <el-input v-model="form.admin_id" placeholder="管理员ID"></el-input>
            </el-form-item>
            <el-form-item label="API路径">
                <el-input v-model="form.func" placeholder="请输入API路径"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSearch">查询</el-button>
            </el-form-item>
        </el-form>

        <el-table :data="tableData">
            <el-table-column prop="id" label="ID" width="80"></el-table-column>
            <el-table-column prop="operator" width="150" label="操作者"></el-table-column>
            <el-table-column prop="func" label="API路径"></el-table-column>
            <el-table-column prop="details" label="请求参数"></el-table-column>
            <el-table-column prop="ip" label="操作IP"></el-table-column>
            <el-table-column prop="create_time" label="操作时间"></el-table-column>
        </el-table>

        <br/>

        <el-row>
            <el-col :span="13" :offset="11">
                <el-pagination
                        @size-change="handleSizeChange"
                        @current-change="handleCurrentChange"
                        :current-page="form.page"
                        :page-sizes="[10, 20, 30, 40]"
                        :page-size="form.pageSize"
                        layout="total, sizes, prev, pager, next, jumper"
                        :total="totalItems">
                </el-pagination>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        name: "logs",
        mounted(){
            this.getList();
        },
        data(){
          return {
              tableData: [],
              form: {
                  page: 1,
                  pageSize: 10
              },
              totalItems: 40
          }
        },
        methods: {
            handleSizeChange(size){
                this.form.pageSize = size;
                this.getList();
            },
            handleCurrentChange(page){
                this.form.page = page;
                this.getList();
            },
            getList(){
                this.$http.post('/api/admin/loglist', this.form).then(res => {
                    this.tableData = res.data.data;
                    this.totalItems = res.data.total;
                })
            },
            onSearch(){
                this.form.page = 1;
                this.getList();
            }
        }
    }
</script>

<style scoped>

</style>
