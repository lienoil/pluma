(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[3],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Announcement/Create.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Announcement/Create.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************/
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
      dataset: []
    };
  },
  // created () {
  //   console.log(this.categories.items, 'data')
  //   axios.get('/api/v1/categories/announcements/all').then(response => {
  //     this.categories.items = response.data.data
  //   })
  // },
  methods: {
    beforeFormSubmit: function beforeFormSubmit() {
      var _this = this;

      this.$validator.reset();
      this.$validator.validateAll().then(function (ok) {
        if (ok) {
          _this.storeData();
        }
      });
    },
    storeData: function storeData() {
      var _this2 = this;

      axios.post('/api/v1/users/store', this.dataset).then(function (response) {
        _this2.$router.push({
          name: 'users'
        });
      });
    },
    remove: function remove(item) {
      var index = this.categoryModel.indexOf(item.name);
      if (index >= 0) this.categoryModel.splice(index, 1);
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Announcement/Create.vue?vue&type=template&id=c38bde1a&":
/*!**********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/modules/Announcement/Create.vue?vue&type=template&id=c38bde1a& ***!
  \**********************************************************************************************************************************************************************************************************/
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
                      attrs: { method: "POST", action: "/api/v1/users/store" },
                      on: {
                        submit: function($event) {
                          $event.preventDefault()
                          return _vm.storeData($event)
                        }
                      }
                    },
                    [
                      _c("v-text-field", {
                        attrs: { label: "First Name", box: "" },
                        model: {
                          value: _vm.dataset.firstname,
                          callback: function($$v) {
                            _vm.$set(_vm.dataset, "firstname", $$v)
                          },
                          expression: "dataset.firstname"
                        }
                      }),
                      _vm._v(" "),
                      _c("v-text-field", {
                        attrs: { label: "Last Name", box: "" },
                        model: {
                          value: _vm.dataset.lastname,
                          callback: function($$v) {
                            _vm.$set(_vm.dataset, "lastname", $$v)
                          },
                          expression: "dataset.lastname"
                        }
                      }),
                      _vm._v(" "),
                      _c("v-text-field", {
                        attrs: { label: "Username", box: "" },
                        model: {
                          value: _vm.dataset.username,
                          callback: function($$v) {
                            _vm.$set(_vm.dataset, "username", $$v)
                          },
                          expression: "dataset.username"
                        }
                      }),
                      _vm._v(" "),
                      _c("v-text-field", {
                        attrs: { label: "Email Address", box: "" },
                        model: {
                          value: _vm.dataset.email,
                          callback: function($$v) {
                            _vm.$set(_vm.dataset, "email", $$v)
                          },
                          expression: "dataset.email"
                        }
                      }),
                      _vm._v(" "),
                      _c("v-text-field", {
                        attrs: { label: "Password", box: "" },
                        model: {
                          value: _vm.dataset.password,
                          callback: function($$v) {
                            _vm.$set(_vm.dataset, "password", $$v)
                          },
                          expression: "dataset.password"
                        }
                      }),
                      _vm._v(" "),
                      _c("v-textarea", {
                        attrs: {
                          name: "input-7-1",
                          box: "",
                          label: "Username",
                          "auto-grow": ""
                        },
                        model: {
                          value: _vm.dataset.username,
                          callback: function($$v) {
                            _vm.$set(_vm.dataset, "username", $$v)
                          },
                          expression: "dataset.username"
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

/***/ "./src/modules/Announcement/Create.vue":
/*!*********************************************!*\
  !*** ./src/modules/Announcement/Create.vue ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Create_vue_vue_type_template_id_c38bde1a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Create.vue?vue&type=template&id=c38bde1a& */ "./src/modules/Announcement/Create.vue?vue&type=template&id=c38bde1a&");
/* harmony import */ var _Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Create.vue?vue&type=script&lang=js& */ "./src/modules/Announcement/Create.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Create_vue_vue_type_template_id_c38bde1a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Create_vue_vue_type_template_id_c38bde1a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "src/modules/Announcement/Create.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./src/modules/Announcement/Create.vue?vue&type=script&lang=js&":
/*!**********************************************************************!*\
  !*** ./src/modules/Announcement/Create.vue?vue&type=script&lang=js& ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Create.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Announcement/Create.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./src/modules/Announcement/Create.vue?vue&type=template&id=c38bde1a&":
/*!****************************************************************************!*\
  !*** ./src/modules/Announcement/Create.vue?vue&type=template&id=c38bde1a& ***!
  \****************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_c38bde1a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Create.vue?vue&type=template&id=c38bde1a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/modules/Announcement/Create.vue?vue&type=template&id=c38bde1a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_c38bde1a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Create_vue_vue_type_template_id_c38bde1a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);