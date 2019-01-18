webpackJsonp([1],{

/***/ 207:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(221)
}
var normalizeComponent = __webpack_require__(78)
/* script */
var __vue_script__ = __webpack_require__(223)
/* template */
var __vue_template__ = __webpack_require__(224)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-6c532c42"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/views/system/profile.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6c532c42", Component.options)
  } else {
    hotAPI.reload("data-v-6c532c42", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 221:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(222);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(77)("2baa32d0", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6c532c42\",\"scoped\":true,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./profile.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6c532c42\",\"scoped\":true,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./profile.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 222:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(49)(false);
// imports


// module
exports.push([module.i, "\n.avatar-uploader .el-upload[data-v-6c532c42] {\n    border: 1px dashed #d9d9d9;\n    border-radius: 6px;\n    cursor: pointer;\n    position: relative;\n    overflow: hidden;\n}\n.avatar-uploader .el-upload[data-v-6c532c42]:hover {\n    border-color: #409EFF;\n}\n.avatar-uploader-icon[data-v-6c532c42] {\n    font-size: 28px;\n    color: #8c939d;\n    width: 145px;\n    height: 178px;\n    line-height: 150px;\n    text-align: center;\n}\n.avatar[data-v-6c532c42] {\n    width: 145px;\n    height: 150px;\n    display: block;\n}\n.form[data-v-6c532c42]{\n    width: 600px;\n    margin-right: auto;\n    margin-left: auto;\n}\n", ""]);

// exports


/***/ }),

/***/ 223:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    name: "profile",
    mounted: function mounted() {
        this.getProfile();
    },
    data: function data() {
        var _this = this;

        var validatePass = function validatePass(rule, value, callback) {
            if (value === '') {
                callback(new Error('请输入密码'));
            } else if (value.length < 6) {
                callback(new Error('密码不能少于6位'));
            } else {
                if (_this.saveForm.check_password !== '') {
                    _this.$refs.saveForm.validateField('check_password');
                }
                callback();
            }
        };
        var validatePassCheck = function validatePassCheck(rule, value, callback) {
            if (value === '') {
                callback(new Error('请再次输入密码'));
            } else if (value !== _this.saveForm.password) {
                callback(new Error('两次输入密码不一致'));
            } else {
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
                old_password: [{ required: true, message: '请输入密码', trigger: 'blur' }],
                password: [{ validator: validatePass, trigger: 'blur' }],
                check_password: [{ validator: validatePassCheck, trigger: 'blur' }]
            },
            csrfToken: $('meta[name="csrf-token"]').attr('content')
        };
    },

    methods: {
        handleAvatarSuccess: function handleAvatarSuccess(res, file) {
            this.imageUrl = res.data.img_path;
            // this.imageUrl = URL.createObjectURL(file.raw);
            console.log(this.imageUrl);
        },
        beforeAvatarUpload: function beforeAvatarUpload(file) {
            var isJPG = file.type === 'image/png';
            var isLt2M = file.size / 1024 / 1024 < 2;

            if (!isJPG) {
                this.$message.error('上传头像图片只能是png格式');
            }

            if (!isLt2M) {
                this.$message.error('上传头像图片大小不能超过2M');
            }
        },
        onSubmit: function onSubmit(formName) {
            var _this2 = this;

            var vm = this;
            this.$refs[formName].validate(function (valid) {
                if (valid) {
                    _this2.$http.post('/api/system/admin/password/change', _this2.saveForm).then(function (res) {
                        if (res.error === 0) {
                            _this2.$message({
                                message: '保存成功',
                                type: 'success'
                            });
                        } else {
                            _this2.$message({
                                message: res.msg,
                                type: 'error'
                            });
                        }

                        setTimeout(function () {
                            vm.$router.push('/system/profile');
                        }, 1000);
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        resetForm: function resetForm(formName) {
            this.$refs[formName].resetFields();
        },
        saveAvatar: function saveAvatar() {
            var _this3 = this;

            if (!this.imageUrl) {
                this.$message.error('请上传头像！');
                return false;
            }
            var vm = this;
            this.$http.post('/api/system/admin/avatar/save', { avatar: this.imageUrl }).then(function (res) {
                if (res.error === 0) {
                    _this3.$message({
                        message: '保存成功',
                        type: 'success'
                    });
                } else {
                    _this3.$message({
                        message: res.msg,
                        type: 'error'
                    });
                }
            });
        },
        getProfile: function getProfile() {
            var _this4 = this;

            this.$http.get('/api/system/admin/userinfo/get', {}).then(function (res) {
                if (res.error === 0) {
                    _this4.imageUrl = res.data.avatar;
                }
            });
        }
    }
});

/***/ }),

/***/ 224:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("el-alert", { attrs: { title: "个人资料", type: "info" } }),
      _vm._v(" "),
      _c("br"),
      _c("br"),
      _vm._v(" "),
      _c(
        "el-row",
        [
          _c(
            "el-col",
            [
              _c(
                "el-form",
                {
                  staticClass: "form",
                  attrs: {
                    "label-position": _vm.labelPosition,
                    "label-width": "100px"
                  }
                },
                [
                  _c(
                    "el-form-item",
                    { attrs: { label: "上传头像", prop: "pass" } },
                    [
                      _c(
                        "el-upload",
                        {
                          attrs: {
                            "list-type": "picture-card",
                            action: "/api/admin/avatar/upload",
                            "show-file-list": false,
                            "on-success": _vm.handleAvatarSuccess,
                            "before-upload": _vm.beforeAvatarUpload,
                            headers: { "X-CSRF-TOKEN": _vm.csrfToken }
                          }
                        },
                        [
                          _vm.imageUrl
                            ? _c("img", {
                                staticClass: "avatar",
                                attrs: { src: _vm.imageUrl }
                              })
                            : _c("i", {
                                staticClass: "el-icon-plus avatar-uploader-icon"
                              })
                        ]
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "el-form-item",
                    { staticStyle: { "margin-top": "50px" } },
                    [
                      _c(
                        "el-button",
                        {
                          attrs: { type: "primary" },
                          on: { click: _vm.saveAvatar }
                        },
                        [_vm._v("保存")]
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c("el-alert", { attrs: { title: "修改密码", type: "info" } }),
      _vm._v(" "),
      _c("br"),
      _c("br"),
      _vm._v(" "),
      _c(
        "el-row",
        [
          _c(
            "el-col",
            [
              _c(
                "el-form",
                {
                  ref: "saveForm",
                  staticClass: "form",
                  attrs: {
                    "label-position": _vm.labelPosition,
                    model: _vm.saveForm,
                    "label-width": "100px",
                    rules: _vm.rules
                  }
                },
                [
                  _c(
                    "el-form-item",
                    { attrs: { label: "原密码", prop: "old_password" } },
                    [
                      _c("el-input", {
                        staticStyle: { width: "300px" },
                        attrs: { type: "password", autocomplete: "off" },
                        model: {
                          value: _vm.saveForm.old_password,
                          callback: function($$v) {
                            _vm.$set(_vm.saveForm, "old_password", $$v)
                          },
                          expression: "saveForm.old_password"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "el-form-item",
                    { attrs: { label: "新密码", prop: "password" } },
                    [
                      _c("el-input", {
                        staticStyle: { width: "300px" },
                        attrs: { type: "password", autocomplete: "off" },
                        model: {
                          value: _vm.saveForm.password,
                          callback: function($$v) {
                            _vm.$set(_vm.saveForm, "password", $$v)
                          },
                          expression: "saveForm.password"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "el-form-item",
                    { attrs: { label: "确认密码", prop: "check_password" } },
                    [
                      _c("el-input", {
                        staticStyle: { width: "300px" },
                        attrs: { type: "password", autocomplete: "off" },
                        model: {
                          value: _vm.saveForm.check_password,
                          callback: function($$v) {
                            _vm.$set(_vm.saveForm, "check_password", $$v)
                          },
                          expression: "saveForm.check_password"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "el-form-item",
                    [
                      _c(
                        "el-button",
                        {
                          attrs: { type: "primary" },
                          on: {
                            click: function($event) {
                              _vm.onSubmit("saveForm")
                            }
                          }
                        },
                        [_vm._v("提交")]
                      ),
                      _vm._v(" "),
                      _c(
                        "el-button",
                        {
                          on: {
                            click: function($event) {
                              _vm.resetForm("saveForm")
                            }
                          }
                        },
                        [_vm._v("重置")]
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-6c532c42", module.exports)
  }
}

/***/ })

});