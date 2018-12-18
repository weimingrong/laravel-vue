<template>
    <div>
        <el-alert title="个人资料" type="info"></el-alert>
        <br/><br/>
        <el-row>
            <el-col>
                <el-form :label-position="labelPosition"  label-width="100px" class="form">
                    <el-form-item label="上传头像" prop="pass">
                        <el-upload
                                list-type="picture-card"
                                action="/api/admin/avatar/upload"
                                :show-file-list="false"
                                :on-success="handleAvatarSuccess"
                                :before-upload="beforeAvatarUpload"
                                :headers="{'X-CSRF-TOKEN' : csrfToken}"
                        >
                            <img v-if="imageUrl" :src="imageUrl" class="avatar">
                            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                        </el-upload>
                    </el-form-item>

                    <el-form-item style="margin-top: 50px">
                        <el-button type="primary" @click="saveAvatar">保存</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
        <el-alert
            title="修改密码"
            type="info"
        ></el-alert>
        <br/><br/>
        <el-row>
            <el-col>
                <el-form class="form" :label-position="labelPosition" :model="saveForm" label-width="100px" :rules="rules" ref="saveForm">
                    <el-form-item label="原密码" prop="old_password">
                        <el-input type="password" v-model="saveForm.old_password" style="width: 300px;" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="新密码" prop="password">
                        <el-input type="password" v-model="saveForm.password" style="width: 300px;" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="确认密码" prop="check_password">
                        <el-input type="password" v-model="saveForm.check_password" style="width: 300px;" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="onSubmit('saveForm')">提交</el-button>
                        <el-button @click="resetForm('saveForm')">重置</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>

    </div>
</template>

<script>
    export default {
        name: "profile",
        mounted(){
          this.getProfile();
        },
        data(){
            const validatePass = (rule, value, callback) => {
                if (value === ''){
                    callback(new Error('请输入密码'))
                }else if (value.length < 6) {
                    callback(new Error('密码不能少于6位'))
                }else{
                    if (this.saveForm.check_password !== ''){
                        this.$refs.saveForm.validateField('check_password')
                    }
                    callback();
                }
            };
            const validatePassCheck = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请再次输入密码'))
                }else if (value !== this.saveForm.password){
                    callback(new Error('两次输入密码不一致'))
                }else{
                    callback();
                }
            };
            return {
                imageUrl: '',
                labelPosition: 'right',
                saveForm: {
                    old_password: '',
                    check_password: '',
                    password: ''
                },
                rules: {
                    old_password: [
                        {required: true, message: '请输入密码', trigger: 'blur'}
                    ],
                    password: [
                        {validator: validatePass, trigger: 'blur'}
                    ],
                    check_password: [
                        {validator: validatePassCheck, trigger: 'blur'}
                    ]
                },
                csrfToken: $('meta[name="csrf-token"]').attr('content')
            };
        },
        methods: {
            handleAvatarSuccess(res, file){
                this.imageUrl = res.data.img_path;
                // this.imageUrl = URL.createObjectURL(file.raw);
                console.log(this.imageUrl)
            },
            beforeAvatarUpload(file){
                const isJPG = file.type === 'image/png';
                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPG){
                    this.$message.error('上传头像图片只能是png格式');
                }

                if (!isLt2M){
                    this.$message.error('上传头像图片大小不能超过2M');
                }
            },
            onSubmit(formName) {
                let vm = this;
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/api/admin/password/change', this.saveForm).then(res => {
                            if(res.error === 0) {
                                this.$message({
                                    message: '保存成功',
                                    type: 'success'
                                });
                            } else {
                                this.$message({
                                    message: res.msg,
                                    type: 'error'
                                });
                            }

                            setTimeout(function () {
                                vm.$router.push('/system/profile')
                            }, 1000)
                        });
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });

            },
            resetForm(formName){
                this.$refs[formName].resetFields();
            },
            saveAvatar() {
                if(!this.imageUrl) {
                    this.$message.error('请上传头像！');
                    return false;
                }
                let vm = this;
                this.$http.post('/api/admin/avatar/save', {avatar: this.imageUrl}).then(res => {
                    if(res.error === 0) {
                        this.$message({
                            message: '保存成功',
                            type: 'success'
                        });

                    } else {
                        this.$message({
                            message: res.msg,
                            type: 'error'
                        });
                    }
                });

            },
            getProfile(){
                this.$http.get('/api/admin/userinfo/get', {}).then(res => {
                    if(res.error === 0){
                        this.imageUrl = res.data.avatar;
                    }
                })
            }
        }
    }
</script>

<style scoped>
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
        width: 145px;
        height: 178px;
        line-height: 150px;
        text-align: center;
    }
    .avatar {
        width: 145px;
        height: 150px;
        display: block;
    }
    .form{
        width: 600px;
        margin-right: auto;
        margin-left: auto;
    }
</style>
