(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Auth/Signin.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Auth/Signin.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _cards_LoginForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./cards/LoginForm */ "./src/modules/Auth/cards/LoginForm.vue");
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
  components: {
    LoginForm: _cards_LoginForm__WEBPACK_IMPORTED_MODULE_0__["default"]
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Auth/cards/LoginForm.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Auth/cards/LoginForm.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var js_cookie__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! js-cookie */ "./node_modules/js-cookie/src/js.cookie.js");
/* harmony import */ var js_cookie__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(js_cookie__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _utils_user_user__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @/utils/user/user */ "./src/utils/user/user.js");
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
  created: function created() {
    if (_utils_user_user__WEBPACK_IMPORTED_MODULE_1__["default"].isLoggedIn()) {// this.$router.push({name: 'dashboard.index'});
    }
  },
  data: function data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    handleSubmit: function handleSubmit(e) {
      e.preventDefault();
      axios.post('api/v1/login', {
        username: this.email,
        password: this.password
      }).then(function (response) {
        console.log(response);

        if (response.data.success) {// this.$router.push({name: 'dashboard.index'});
        }
      }).catch(function (error) {
        console.error(error);
      });

      if (this.password.length > 0) {}
    }
  },
  beforeRouteEnter: function beforeRouteEnter(to, from, next) {
    if (localStorage.getItem('jwt')) {
      return next('board');
    }

    next();
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Auth/Signin.vue?vue&type=template&id=e56ac6d0&":
/*!**************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Auth/Signin.vue?vue&type=template&id=e56ac6d0& ***!
  \**************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-container",
    { attrs: { fluid: "", "fill-height": "" } },
    [
      _c(
        "v-layout",
        {
          attrs: {
            row: "",
            wrap: "",
            "fill-height": "",
            "align-center": "",
            "justify-center": ""
          }
        },
        [
          _c(
            "v-flex",
            {
              attrs: {
                xs12: "",
                sm8: "",
                md4: "",
                lg3: "",
                "fill-height": "",
                "align-center": "",
                "justify-center": ""
              }
            },
            [_c("login-form")],
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



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Auth/cards/LoginForm.vue?vue&type=template&id=1cbe909b&":
/*!***********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Auth/cards/LoginForm.vue?vue&type=template&id=1cbe909b& ***!
  \***********************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "container" }, [
    _c("div", { staticClass: "row justify-content-center" }, [
      _c("div", { staticClass: "col-md-8" }, [
        _c("div", { staticClass: "card card-default" }, [
          _c("div", { staticClass: "card-header" }, [_vm._v("Login")]),
          _vm._v(" "),
          _c("div", { staticClass: "card-body" }, [
            _c("form", { attrs: { method: "POST", action: "/login" } }, [
              _c("div", { staticClass: "form-group row" }, [
                _c(
                  "label",
                  {
                    staticClass: "col-sm-4 col-form-label text-md-right",
                    attrs: { for: "email" }
                  },
                  [_vm._v("E-Mail Address")]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-6" }, [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.email,
                        expression: "email"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: {
                      id: "email",
                      type: "email",
                      required: "",
                      autofocus: ""
                    },
                    domProps: { value: _vm.email },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.email = $event.target.value
                      }
                    }
                  })
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "form-group row" }, [
                _c(
                  "label",
                  {
                    staticClass: "col-md-4 col-form-label text-md-right",
                    attrs: { for: "password" }
                  },
                  [_vm._v("Password")]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-6" }, [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.password,
                        expression: "password"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { id: "password", type: "password", required: "" },
                    domProps: { value: _vm.password },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.password = $event.target.value
                      }
                    }
                  })
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "form-group row mb-0" }, [
                _c("div", { staticClass: "col-md-8 offset-md-4" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-primary",
                      attrs: { type: "submit" },
                      on: { click: _vm.handleSubmit }
                    },
                    [
                      _vm._v(
                        "\n                                    Login\n                                "
                      )
                    ]
                  )
                ])
              ])
            ])
          ])
        ])
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./src/modules/Auth/Signin.vue":
/*!*************************************!*\
  !*** ./src/modules/Auth/Signin.vue ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Signin_vue_vue_type_template_id_e56ac6d0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Signin.vue?vue&type=template&id=e56ac6d0& */ "./src/modules/Auth/Signin.vue?vue&type=template&id=e56ac6d0&");
/* harmony import */ var _Signin_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Signin.vue?vue&type=script&lang=js& */ "./src/modules/Auth/Signin.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Signin_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Signin_vue_vue_type_template_id_e56ac6d0___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Signin_vue_vue_type_template_id_e56ac6d0___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/modules/Auth/Signin.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./src/modules/Auth/Signin.vue?vue&type=script&lang=js&":
/*!**************************************************************!*\
  !*** ./src/modules/Auth/Signin.vue?vue&type=script&lang=js& ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Signin_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Signin.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Auth/Signin.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Signin_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/modules/Auth/Signin.vue?vue&type=template&id=e56ac6d0&":
/*!********************************************************************!*\
  !*** ./src/modules/Auth/Signin.vue?vue&type=template&id=e56ac6d0& ***!
  \********************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Signin_vue_vue_type_template_id_e56ac6d0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Signin.vue?vue&type=template&id=e56ac6d0& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Auth/Signin.vue?vue&type=template&id=e56ac6d0&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Signin_vue_vue_type_template_id_e56ac6d0___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Signin_vue_vue_type_template_id_e56ac6d0___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./src/modules/Auth/cards/LoginForm.vue":
/*!**********************************************!*\
  !*** ./src/modules/Auth/cards/LoginForm.vue ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _LoginForm_vue_vue_type_template_id_1cbe909b___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./LoginForm.vue?vue&type=template&id=1cbe909b& */ "./src/modules/Auth/cards/LoginForm.vue?vue&type=template&id=1cbe909b&");
/* harmony import */ var _LoginForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./LoginForm.vue?vue&type=script&lang=js& */ "./src/modules/Auth/cards/LoginForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _LoginForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _LoginForm_vue_vue_type_template_id_1cbe909b___WEBPACK_IMPORTED_MODULE_0__["render"],
  _LoginForm_vue_vue_type_template_id_1cbe909b___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/modules/Auth/cards/LoginForm.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./src/modules/Auth/cards/LoginForm.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./src/modules/Auth/cards/LoginForm.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LoginForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./LoginForm.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Auth/cards/LoginForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LoginForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/modules/Auth/cards/LoginForm.vue?vue&type=template&id=1cbe909b&":
/*!*****************************************************************************!*\
  !*** ./src/modules/Auth/cards/LoginForm.vue?vue&type=template&id=1cbe909b& ***!
  \*****************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LoginForm_vue_vue_type_template_id_1cbe909b___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./LoginForm.vue?vue&type=template&id=1cbe909b& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Auth/cards/LoginForm.vue?vue&type=template&id=1cbe909b&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LoginForm_vue_vue_type_template_id_1cbe909b___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LoginForm_vue_vue_type_template_id_1cbe909b___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);