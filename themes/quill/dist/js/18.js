(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[18],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Create.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Page/Create.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _store__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @/store */ "./src/store/index.js");
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
  $_veeValidate: {
    validator: 'new'
  },
  store: _store__WEBPACK_IMPORTED_MODULE_0__["default"],
  name: 'Create',
  data: function data() {
    return {
      dataset: {
        title: '',
        code: '',
        body: ''
      }
    };
  },
  methods: {
    beforeFormSubmit: function beforeFormSubmit() {
      var _this = this;

      this.$validator.reset();
      this.$validator.validateAll().then(function (ok) {
        if (ok) {
          _this.storePage();
        }
      });
    },
    storePage: function storePage() {
      var _this2 = this;

      axios.post('/api/v1/pages/store', this.dataset).then(function (response) {
        console.log(_this2.dataset);

        _this2.$router.push({
          name: 'pages'
        });
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Create.vue?vue&type=template&id=7cb9c5ab&":
/*!**************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Page/Create.vue?vue&type=template&id=7cb9c5ab& ***!
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
    "div",
    [
      _c(
        "v-container",
        { attrs: { fluid: "", "grid-list-lg": "" } },
        [
          _c(
            "v-layout",
            { attrs: { row: "", wrap: "" } },
            [
              _c(
                "v-flex",
                { attrs: { sm6: "", xs12: "" } },
                [
                  _c(
                    "v-form",
                    {
                      attrs: { method: "POST", action: "/api/v1/pages/store" },
                      on: {
                        submit: function($event) {
                          $event.preventDefault()
                          return _vm.storePage($event)
                        }
                      }
                    },
                    [
                      _c("v-text-field", {
                        directives: [
                          {
                            name: "validate",
                            rawName: "v-validate",
                            value: "required",
                            expression: "'required'"
                          }
                        ],
                        attrs: {
                          "data-vv-as": _vm.trans("Title"),
                          "error-messages": _vm.errors.collect("title"),
                          outline: "",
                          autofocus: "",
                          label: "Title",
                          name: "title"
                        },
                        model: {
                          value: _vm.dataset.title,
                          callback: function($$v) {
                            _vm.$set(_vm.dataset, "title", $$v)
                          },
                          expression: "dataset.title"
                        }
                      }),
                      _vm._v(" "),
                      _c("v-text-field", {
                        directives: [
                          {
                            name: "validate",
                            rawName: "v-validate",
                            value: "required",
                            expression: "'required'"
                          }
                        ],
                        attrs: {
                          "data-vv-as": _vm.trans("Code"),
                          "error-messages": _vm.errors.collect("code"),
                          outline: "",
                          autofocus: "",
                          label: "Code",
                          name: "code"
                        },
                        model: {
                          value: _vm.dataset.code,
                          callback: function($$v) {
                            _vm.$set(_vm.dataset, "code", $$v)
                          },
                          expression: "dataset.code"
                        }
                      }),
                      _vm._v(" "),
                      _c("v-text-field", {
                        attrs: {
                          "data-vv-as": _vm.trans("Body"),
                          outline: "",
                          autofocus: "",
                          label: "Body",
                          name: "body"
                        },
                        model: {
                          value: _vm.dataset.body,
                          callback: function($$v) {
                            _vm.$set(_vm.dataset, "body", $$v)
                          },
                          expression: "dataset.body"
                        }
                      }),
                      _vm._v(" "),
                      _c(
                        "v-btn",
                        { staticClass: "secondary", attrs: { type: "submit" } },
                        [_vm._v(_vm._s(_vm.__("Create")))]
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



/***/ }),

/***/ "./src/modules/Page/Create.vue":
/*!*************************************!*\
  !*** ./src/modules/Page/Create.vue ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Create_vue_vue_type_template_id_7cb9c5ab___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Create.vue?vue&type=template&id=7cb9c5ab& */ "./src/modules/Page/Create.vue?vue&type=template&id=7cb9c5ab&");
/* harmony import */ var _Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Create.vue?vue&type=script&lang=js& */ "./src/modules/Page/Create.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Create_vue_vue_type_template_id_7cb9c5ab___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Create_vue_vue_type_template_id_7cb9c5ab___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/modules/Page/Create.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./src/modules/Page/Create.vue?vue&type=script&lang=js&":
/*!**************************************************************!*\
  !*** ./src/modules/Page/Create.vue?vue&type=script&lang=js& ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Create.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Create.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/modules/Page/Create.vue?vue&type=template&id=7cb9c5ab&":
/*!********************************************************************!*\
  !*** ./src/modules/Page/Create.vue?vue&type=template&id=7cb9c5ab& ***!
  \********************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_7cb9c5ab___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Create.vue?vue&type=template&id=7cb9c5ab& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Page/Create.vue?vue&type=template&id=7cb9c5ab&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_7cb9c5ab___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_7cb9c5ab___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);