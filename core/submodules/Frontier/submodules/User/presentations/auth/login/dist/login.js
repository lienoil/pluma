(function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.login=t():e.login=t()})(this,function(){return function(e){function t(s){if(r[s])return r[s].exports;var a=r[s]={i:s,l:!1,exports:{}};return e[s].call(a.exports,a,a.exports,t),a.l=!0,a.exports}var r={};return t.m=e,t.c=r,t.i=function(e){return e},t.d=function(e,r,s){t.o(e,r)||Object.defineProperty(e,r,{configurable:!1,enumerable:!0,get:s})},t.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(r,"a",r),r},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="/",t(t.s=5)}([function(e,t,r){r(2);var s=r(3)(r(1),r(4),"data-v-fda9d18c",null);e.exports=s.exports},function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var s={name:"login",props:["meta","url"],data:function(){return{_token:window.csrfToken,username:"",password:"",remember:!0,submitting:!1,visible:!1,rules:[]}},watch:{username:function(){return!0}},methods:{submit:function(e){var t=this;this.$validator.validateAll().then(function(e){t.submitting=!0;var r={_token:t._token,username:t.username,password:t.password,remember:t.remember};axios.post(t.url,r).then(function(e){e.data&&!e.data.success?t.errors=t.response.data:window.location=e.data.redirect,t.submitting=!1}).catch(function(e){e.response&&console.log(e.response.data),t.submitting=!1})})}}};t.default=s},function(e,t){},function(e,t){e.exports=function(e,t,r,s){var a,n=e=e||{},o=typeof e.default;"object"!==o&&"function"!==o||(a=e,n=e.default);var i="function"==typeof n?n.options:n;if(t&&(i.render=t.render,i.staticRenderFns=t.staticRenderFns),r&&(i._scopeId=r),s){var c=i.computed||(i.computed={});Object.keys(s).forEach(function(e){var t=s[e];c[e]=function(){return t}})}return{esModule:a,exports:n,options:i}}},function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("form",{attrs:{method:"POST"},on:{submit:function(t){t.preventDefault(),e.submit(t)}}},[r("v-card",{staticClass:"card--flex-toolbar card--flex-toolbar--stylized",attrs:{transition:"slide-x-transition"}},[e.meta?r("v-toolbar",{staticClass:"white",attrs:{card:"",prominent:""}},[r("v-toolbar-title",[e._v(e._s(e.meta.title)+" "),e.meta.subtitle?r("span",{staticClass:"grey--text"},[e._v(e._s(e.meta.subtitle))]):e._e()]),e._v(" "),r("v-spacer")],1):e._e(),e._v(" "),r("v-divider"),e._v(" "),r("v-card-text",[r("v-layout",{attrs:{row:""}},[r("input",{attrs:{type:"hidden",name:"_token"},domProps:{value:e.csrfToken}}),e._v(" "),r("v-flex",[r("v-text-field",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"'required'"}],staticClass:"input-group",attrs:{hint:e.errors.has("username")?e.errors.first("username"):"",label:"Email or username",name:"username","persistent-hint":"",type:"text","data-vv-name":"username"},model:{value:e.username,callback:function(t){e.username=t},expression:"username"}}),e._v(" "),r("v-text-field",{directives:[{name:"validate",rawName:"v-validate",value:"required",expression:"'required'"}],staticClass:"input-group",attrs:{"append-icon-cb":function(){return e.visible=!e.visible},"append-icon":e.visible?"visibility":"visibility_off",hint:e.errors.has("password")?e.errors.first("password"):"",type:e.visible?"text":"password",label:"Password",min:"6",name:"password","persistent-hint":"","data-vv-name":"password"},model:{value:e.password,callback:function(t){e.password=t},expression:"password"}}),e._v(" "),r("v-checkbox",{attrs:{checked:e.remember,label:"Remember Me",light:""},on:{click:function(){e.remember=!e.remember}},model:{value:e.remember,callback:function(t){e.remember=t},expression:"remember"}})],1)],1),e._v(" "),r("v-layout",[r("v-btn",{attrs:{primary:"",type:"submit"}},[e.submitting?r("v-progress-circular",{staticClass:"white--text",attrs:{indeterminate:""}}):r("span",[e._v("Login")])],1)],1),e._v(" "),e.meta&&e.meta.social?[r("div",{staticClass:"hr"},[r("strong",{staticClass:"hr-text grey--text text--lighten-2"},[e._v("or")])]),e._v(" "),r("v-layout",[r("v-flex",{staticClass:"text-xs-center",attrs:{md6:""}},[r("v-btn",{staticClass:"color--google elevation-0",attrs:{block:""}},[r("i",{staticClass:"fa fa-google"},[e._v(" ")]),e._v("\n                            Google\n                        ")])],1),e._v(" "),r("v-flex",{staticClass:"text-xs-center",attrs:{md6:""}},[r("v-spacer"),e._v(" "),r("v-btn",{staticClass:"color--facebook elevation-0",attrs:{block:""}},[r("i",{staticClass:"fa fa-facebook"},[e._v(" ")]),e._v("\n                            Facebook\n                        ")])],1)],1)]:e._e()],2),e._v(" "),r("v-divider"),e._v(" "),r("v-card-text",[r("v-layout",{attrs:{row:""}},[e._t("default")],2)],1)],1)],1)},staticRenderFns:[]}},function(e,t,r){e.exports=r(0)}])});
//# sourceMappingURL=login.js.map