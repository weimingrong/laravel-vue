webpackJsonp([4],{

/***/ 208:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(220)
}
var normalizeComponent = __webpack_require__(78)
/* script */
var __vue_script__ = __webpack_require__(222)
/* template */
var __vue_template__ = __webpack_require__(223)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-02a6e1b0"
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
Component.options.__file = "resources/views/system/admin.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-02a6e1b0", Component.options)
  } else {
    hotAPI.reload("data-v-02a6e1b0", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 220:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(221);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(77)("6a13df8f", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-02a6e1b0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./admin.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-02a6e1b0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./admin.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 221:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(49)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 222:
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
    name: "admin",
    mounted: function mounted() {
        this.getList();
        this.getGroupList();
    },
    data: function data() {
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
                status: true,
                realname: ''
            },
            dialogVisible: false,
            id: 0,
            auth: {},
            groups: [],
            rulesForm: {
                username: [{ required: true, message: '请输入用户名称', trigger: 'blur' }],
                realname: [{ required: true, message: '请输入真实姓名', trigger: 'blur' }],
                groups: [{ required: true, message: '请选择用户组', trigger: 'blur' }]
            }
        };
    },

    methods: {
        onSearch: function onSearch() {
            this.form.page = 1;
            this.getList();
        },
        handleSizeChange: function handleSizeChange(size) {
            this.form.pageSize = size;
        },
        handleCurrentChange: function handleCurrentChange(page) {
            this.form.page = page;
            this.getList();
        },
        getList: function getList() {
            var _this = this;

            this.$http.post('/api/system/admin/list', this.form).then(function (res) {
                _this.tableData = res.data.list;
                _this.totalItems = res.data.total;
                _this.auth = res.data.auth;
            });
        },
        getGroupList: function getGroupList() {
            var _this2 = this;

            this.$http.get('/api/system/group/list', { status: 1 }).then(function (res) {
                _this2.groups = res.data.list;
            });
        },
        onSubmit: function onSubmit() {
            var _this3 = this;

            this.$refs['saveForm'].validate(function (valid) {
                if (valid) {
                    if (typeof _this3.saveForm.password === 'undefined') {
                        _this3.saveForm.password = '';
                    }

                    if (!_this3.saveForm.id && _this3.saveForm.password.length < 6) {
                        _this3.$message({
                            message: '请输入不少于6位的密码',
                            type: 'error'
                        });

                        return;
                    }

                    _this3.$http.post('/api/system/admin/save', _this3.saveForm).then(function (res) {
                        if (res.error == 0) {
                            _this3.$message({
                                message: '保存成功',
                                type: 'success'
                            });
                            _this3.addNewDialog = false;
                            _this3.getList();
                        } else {
                            _this3.$message({
                                message: res.msg,
                                type: 'error'
                            });
                        }
                    });
                } else {
                    console.log('error submit');
                    return false;
                }
            });
        },
        handleAdd: function handleAdd() {
            this.addNewDialog = true;
            if (typeof this.$refs['saveForm'] !== 'undefined') {
                this.$refs['saveForm'].resetFields();
            }
        },
        editRow: function editRow(row) {
            this.addNewDialog = true;
            if (typeof this.$refs['saveForm'] !== 'undefined') {
                this.$refs['saveForm'].resetFields();
            }

            this.saveForm = {
                id: row.id,
                username: row.username,
                groups: row.groups,
                realname: row.realname,
                mobile: row.mobile,
                email: row.email,
                status: row.status === 1
            };
        },
        deleteRow: function deleteRow() {
            var _this4 = this;

            this.$http.post('/api/system/admin/delete', { id: this.id }).then(function (res) {
                if (res.error == 0) {
                    _this4.$message({
                        message: '删除成功',
                        type: 'success'
                    });
                } else {
                    _this4.$message({
                        message: res.msg,
                        type: 'error'
                    });
                }
                _this4.dialogVisible = false;
                _this4.getList();
            });
        },
        handleDelete: function handleDelete(row) {
            this.id = row.id, this.dialogVisible = true;
        }
    }
});

/***/ }),

/***/ 223:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "el-form",
        { attrs: { inline: true, model: _vm.form } },
        [
          _c(
            "el-form-item",
            { attrs: { label: "ID" } },
            [
              _c("el-input", {
                attrs: { placeholder: "ID" },
                model: {
                  value: _vm.form.id,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "id", $$v)
                  },
                  expression: "form.id"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "登录名" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入登录名" },
                model: {
                  value: _vm.form.username,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "username", $$v)
                  },
                  expression: "form.username"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "真实姓名" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入真实姓名" },
                model: {
                  value: _vm.form.realname,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "realname", $$v)
                  },
                  expression: "form.realname"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "手机号" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入手机号" },
                model: {
                  value: _vm.form.mobile,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "mobile", $$v)
                  },
                  expression: "form.mobile"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-form-item",
            { attrs: { label: "邮箱" } },
            [
              _c("el-input", {
                attrs: { placeholder: "请输入邮箱" },
                model: {
                  value: _vm.form.email,
                  callback: function($$v) {
                    _vm.$set(_vm.form, "email", $$v)
                  },
                  expression: "form.email"
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
                { attrs: { type: "primary" }, on: { click: _vm.onSearch } },
                [_vm._v("查询")]
              )
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "el-row",
        [
          _vm.auth.canAdd
            ? _c(
                "el-button",
                {
                  attrs: { type: "primary", size: "small" },
                  on: { click: _vm.handleAdd }
                },
                [_vm._v("新增")]
              )
            : _vm._e()
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "el-table",
        { attrs: { data: _vm.tableData } },
        [
          _c("el-table-column", {
            attrs: { prop: "id", label: "ID", width: "80" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { prop: "username", label: "用户名" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { prop: "realname", label: "真实姓名" }
          }),
          _vm._v(" "),
          _c("el-table-column", { attrs: { prop: "mobile", label: "手机号" } }),
          _vm._v(" "),
          _c("el-table-column", { attrs: { prop: "email", label: "邮箱" } }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { label: "用户状态", width: "150" },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function(scope) {
                  return [
                    scope.row.status == 1
                      ? _c(
                          "el-tag",
                          { attrs: { type: "success", size: "small" } },
                          [_vm._v("正常")]
                        )
                      : _vm._e(),
                    _vm._v(" "),
                    scope.row.status == 2
                      ? _c(
                          "el-tag",
                          { attrs: { type: "info", size: "small" } },
                          [_vm._v("禁用")]
                        )
                      : _vm._e()
                  ]
                }
              }
            ])
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { prop: "last_login", label: "最后登录时间" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { prop: "last_ip", label: "最后登录IP" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { prop: "created_at", label: "创建时间" }
          }),
          _vm._v(" "),
          _c("el-table-column", {
            attrs: { fixed: "right", label: "操作", width: "100" },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function(scope) {
                  return [
                    _vm.auth.canEdit
                      ? _c(
                          "el-button",
                          {
                            attrs: { type: "text", size: "small" },
                            on: {
                              click: function($event) {
                                _vm.editRow(scope.row)
                              }
                            }
                          },
                          [_vm._v("编辑")]
                        )
                      : _vm._e(),
                    _vm._v(" "),
                    _vm.auth.canDelete
                      ? _c(
                          "el-button",
                          {
                            attrs: { type: "text", size: "small" },
                            on: {
                              click: function($event) {
                                _vm.handleDelete(scope.row)
                              }
                            }
                          },
                          [_vm._v("删除")]
                        )
                      : _vm._e()
                  ]
                }
              }
            ])
          })
        ],
        1
      ),
      _vm._v(" "),
      _c("br"),
      _vm._v(" "),
      _c(
        "el-row",
        [
          _c(
            "el-col",
            { attrs: { span: 13, offset: 11 } },
            [
              _c("el-pagination", {
                attrs: {
                  background: "",
                  "current-page": _vm.form.page,
                  "page-sizes": [10, 20, 30, 40, 50],
                  "page-size": _vm.form.pageSize,
                  layout: "total, sizes, prev, pager, next, jumper",
                  total: _vm.totalItems
                },
                on: {
                  "size-change": _vm.handleSizeChange,
                  "current-change": _vm.handleCurrentChange
                }
              })
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c("br"),
      _vm._v(" "),
      _c(
        "el-dialog",
        {
          attrs: {
            title: "新增/修改管理员",
            visible: _vm.addNewDialog,
            width: "35%"
          },
          on: {
            "update:visible": function($event) {
              _vm.addNewDialog = $event
            }
          }
        },
        [
          _c(
            "el-form",
            {
              ref: "saveForm",
              attrs: {
                model: _vm.saveForm,
                "label-width": "100px",
                size: "small",
                rules: _vm.rulesForm
              }
            },
            [
              _c(
                "el-form-item",
                { attrs: { label: "登录名", prop: "username" } },
                [
                  _c("el-input", {
                    staticStyle: { width: "50%" },
                    model: {
                      value: _vm.saveForm.username,
                      callback: function($$v) {
                        _vm.$set(_vm.saveForm, "username", $$v)
                      },
                      expression: "saveForm.username"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "el-form-item",
                { attrs: { label: "密码", prop: "password" } },
                [
                  _c("el-input", {
                    staticStyle: { width: "50%" },
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
                { attrs: { label: "用户组", prop: "groups" } },
                [
                  _c(
                    "el-select",
                    {
                      staticStyle: { width: "50%" },
                      attrs: { placeholder: "请选择" },
                      model: {
                        value: _vm.saveForm.groups,
                        callback: function($$v) {
                          _vm.$set(_vm.saveForm, "groups", $$v)
                        },
                        expression: "saveForm.groups"
                      }
                    },
                    _vm._l(_vm.groups, function(item) {
                      return _c("el-option", {
                        key: item.id,
                        attrs: { label: item.title, value: item.id }
                      })
                    }),
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "el-form-item",
                { attrs: { label: "真实姓名", prop: "realname" } },
                [
                  _c("el-input", {
                    staticStyle: { width: "50%" },
                    model: {
                      value: _vm.saveForm.realname,
                      callback: function($$v) {
                        _vm.$set(_vm.saveForm, "realname", $$v)
                      },
                      expression: "saveForm.realname"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "el-form-item",
                { attrs: { label: "手机号", prop: "mobile" } },
                [
                  _c("el-input", {
                    staticStyle: { width: "50%" },
                    model: {
                      value: _vm.saveForm.mobile,
                      callback: function($$v) {
                        _vm.$set(_vm.saveForm, "mobile", $$v)
                      },
                      expression: "saveForm.mobile"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "el-form-item",
                { attrs: { label: "邮箱", prop: "email" } },
                [
                  _c("el-input", {
                    staticStyle: { width: "50%" },
                    model: {
                      value: _vm.saveForm.email,
                      callback: function($$v) {
                        _vm.$set(_vm.saveForm, "email", $$v)
                      },
                      expression: "saveForm.email"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "el-form-item",
                { attrs: { label: "状态", prop: "status" } },
                [
                  _c("el-switch", {
                    attrs: { "active-text": "正常", "inactive-text": "禁用" },
                    model: {
                      value: _vm.saveForm.status,
                      callback: function($$v) {
                        _vm.$set(_vm.saveForm, "status", $$v)
                      },
                      expression: "saveForm.status"
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
                    { attrs: { type: "primary" }, on: { click: _vm.onSubmit } },
                    [_vm._v("保存")]
                  ),
                  _vm._v(" "),
                  _c(
                    "el-button",
                    {
                      on: {
                        click: function($event) {
                          _vm.addNewDialog = false
                        }
                      }
                    },
                    [_vm._v("取消")]
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
      _c(
        "el-dialog",
        {
          attrs: {
            title: "提示",
            visible: _vm.dialogVisible,
            width: "30%",
            center: ""
          },
          on: {
            "update:visible": function($event) {
              _vm.dialogVisible = $event
            }
          }
        },
        [
          _c("span", [_vm._v("确定删除此管理员吗？")]),
          _vm._v(" "),
          _c(
            "span",
            {
              staticClass: "dialog-footer",
              attrs: { slot: "footer" },
              slot: "footer"
            },
            [
              _c(
                "el-button",
                {
                  on: {
                    click: function($event) {
                      _vm.dialogVisible = false
                    }
                  }
                },
                [_vm._v("取 消")]
              ),
              _vm._v(" "),
              _c(
                "el-button",
                {
                  attrs: { type: "primary" },
                  on: {
                    click: function($event) {
                      _vm.deleteRow()
                    }
                  }
                },
                [_vm._v("确 定")]
              )
            ],
            1
          )
        ]
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
    require("vue-hot-reload-api")      .rerender("data-v-02a6e1b0", module.exports)
  }
}

/***/ })

});