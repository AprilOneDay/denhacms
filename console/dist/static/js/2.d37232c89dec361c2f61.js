webpackJsonp([2],{116:function(t,a,e){var s=e(1)(e(76),e(118),null,null,null);t.exports=s.exports},118:function(t,a){t.exports={render:function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{attrs:{id:"console-setting-admin-edit"}},[e("div",{staticClass:"modal-content"},[e("div",{staticClass:"modal-body clearfix"},[e("div",{staticClass:"panel"},[e("div",{staticClass:"panel-body"},[e("form",{staticClass:"form-horizontal",attrs:{role:"form"}},[e("fieldset",[e("div",{staticClass:"form-group"},[t._m(0),t._v(" "),e("div",{staticClass:"col-sm-8"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.data.nickname,expression:"data.nickname"}],staticClass:"form-control",attrs:{type:"text",placeholder:"昵称"},domProps:{value:t.data.nickname},on:{input:function(a){a.target.composing||(t.data.nickname=a.target.value)}}})])]),t._v(" "),e("div",{staticClass:"form-group"},[t._m(1),t._v(" "),e("div",{staticClass:"col-sm-8"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.data.username,expression:"data.username"}],staticClass:"form-control",attrs:{type:"text",placeholder:"用户名"},domProps:{value:t.data.username},on:{input:function(a){a.target.composing||(t.data.username=a.target.value)}}})])]),t._v(" "),e("div",{staticClass:"form-group"},[t._m(2),t._v(" "),e("div",{staticClass:"col-sm-8"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.data.password,expression:"data.password"}],staticClass:"form-control",attrs:{type:"password",placeholder:"密码"},domProps:{value:t.data.password},on:{input:function(a){a.target.composing||(t.data.password=a.target.value)}}})])]),t._v(" "),e("div",{staticClass:"form-group"},[t._m(3),t._v(" "),e("div",{staticClass:"col-sm-8"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.data.group,expression:"data.group"}],staticClass:"form-control",attrs:{type:"text",placeholder:"所属分组"},domProps:{value:t.data.group},on:{input:function(a){a.target.composing||(t.data.group=a.target.value)}}})])]),t._v(" "),e("div",{staticClass:"form-group"},[t._m(4),t._v(" "),e("div",{staticClass:"col-sm-8"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.data.mobile,expression:"data.mobile"}],staticClass:"form-control",attrs:{type:"text",placeholder:"手机号"},domProps:{value:t.data.mobile},on:{input:function(a){a.target.composing||(t.data.mobile=a.target.value)}}})])]),t._v(" "),e("div",{staticClass:"form-group"},[e("label",{staticClass:"control-label col-sm-3"},[t._v("状态：")]),t._v(" "),e("div",{staticClass:"radio-inline"},[e("label",[e("input",{directives:[{name:"model",rawName:"v-model",value:t.data.status,expression:"data.status"}],attrs:{type:"radio",value:"1"},domProps:{checked:t._q(t.data.status,"1")},on:{__c:function(a){t.data.status="1"}}}),t._v(" 开启\n\t\t\t\t\t\t\t\t\t")])]),t._v(" "),e("div",{staticClass:"radio-inline"},[e("label",[e("input",{directives:[{name:"model",rawName:"v-model",value:t.data.status,expression:"data.status"}],attrs:{type:"radio",value:"0"},domProps:{checked:t._q(t.data.status,"0")},on:{__c:function(a){t.data.status="0"}}}),t._v(" 关闭\n\t\t\t\t\t\t\t\t\t")])])])])])])])]),t._v(" "),e("div",{staticClass:"modal-footer"},[e("button",{staticClass:"btn btn-primary",attrs:{type:"submit"},on:{click:t.comply}},[t._v("确定")]),t._v(" "),e("button",{staticClass:"btn btn-default",attrs:{type:"button",id:"btn-close"},on:{click:t.btnClose}},[t._v("取消")])])])])},staticRenderFns:[function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("label",{staticClass:"control-label col-sm-3"},[e("span",{staticClass:"text-danger"},[t._v("*")]),t._v(" "),e("span",[t._v("昵称")])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("label",{staticClass:"control-label col-sm-3"},[e("span",{staticClass:"text-danger"},[t._v("*")]),t._v(" "),e("span",[t._v("用户名")])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("label",{staticClass:"control-label col-sm-3"},[e("span",{staticClass:"text-danger"},[t._v("*")]),t._v(" "),e("span",[t._v("密码")])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("label",{staticClass:"control-label col-sm-3"},[e("span",{staticClass:"text-danger"},[t._v("*")]),t._v(" "),e("span",[t._v("所属分组")])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("label",{staticClass:"control-label col-sm-3"},[e("span",{staticClass:"text-danger"},[t._v("*")]),t._v(" "),e("span",[t._v("手机号")])])}]}},119:function(t,a){t.exports={render:function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{attrs:{id:"console-admin-index"}},[e("div",{staticClass:"view-content-container"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-sm-12"},[e("div",{staticClass:"console-title console-title-border clearfix"},[t._m(0),t._v(" "),e("div",{staticClass:"pull-right"},[e("a",{staticClass:"btn btn-primary",attrs:{"data-id":"","data-height":"750"},on:{click:function(a){t.open(a)}}},[t._v("添加管理员")])])]),t._v(" "),e("div",{staticClass:"console-form"},[e("div",{staticClass:"mt8"},[e("form",[e("table",{staticClass:"table table-hover"},[t._m(1),t._v(" "),e("tbody",t._l(t.data.list,function(a){return e("tr",[e("td",[t._v(t._s(a.id))]),t._v(" "),e("td",[t._v(t._s(a.username))]),t._v(" "),e("td",[t._v(t._s(a.nickname))]),t._v(" "),e("td",[t._v(t._s(a.group))]),t._v(" "),e("td",[t._v(t._s(a.mobile))]),t._v(" "),e("td",[t._v(t._s(t._f("date")(1e3*a.created,"YMD")))]),t._v(" "),e("td",[t._v(t._s(t._f("date")(1e3*a.login_time,"YMD")))]),t._v(" "),e("td",[a.status?e("p",{staticStyle:{color:"green"}},[t._v(t._s(t.other.statusCopy[a.status]))]):e("p",{staticStyle:{color:"red"}},[t._v(t._s(t.other.statusCopy[a.status]))])]),t._v(" "),e("td",{attrs:{align:"center"}},[e("a",{attrs:{"data-title":"编辑菜单","data-id":a.id,"data-height":"800"},on:{click:function(a){t.open(a)}}},[t._v("编辑")]),t._v(" "),e("span",{staticClass:"text-explode"},[t._v("|")]),t._v(" "),e("a",{on:{click:function(e){t.del(a.id)}}},[t._v("删除")])])])}))])])])])])])])])},staticRenderFns:[function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"pull-left"},[e("h5",[t._v("管理员列表")])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("thead",[e("tr",[e("th",[t._v("ID")]),t._v(" "),e("th",[t._v("用户名")]),t._v(" "),e("th",[t._v("昵称")]),t._v(" "),e("th",[t._v("管理组")]),t._v(" "),e("th",[t._v("手机号")]),t._v(" "),e("th",[t._v("创建时间")]),t._v(" "),e("th",[t._v("登录时间")]),t._v(" "),e("th",[t._v("状态")]),t._v(" "),e("th",{staticStyle:{"text-align":"center"}},[t._v("编辑/操作")])])])}]}},35:function(t,a,e){var s=e(1)(e(77),e(119),null,null,null);t.exports=s.exports},76:function(t,a,e){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var s=e(11),i=e.n(s);a.default={name:"console-settiv-admin-edit",data:function(){return{data:{status:1,password:"123456"},menulist:{}}},props:["msg"],created:function(){this.getDetail()},methods:{getDetail:function(){this.$layer.loading(),store.state.UPDATE_EDIT_ID&&this.$http.get(config.data.console+"/setting/admin/edit?id="+store.state.UPDATE_EDIT_ID).then(function(t){this.data=t.body.data.data}),this.$layer.closeAll("loading")},btnClose:function(){this.clear(),this.$layer.closeAll()},comply:function(){this.$layer.loading(),this.$http.post(config.data.console+"/setting/admin/edit",{data:i()(this.data)}).then(function(t){this.$layer.closeAll("loading");var a=t.body;this.$layer.msg(a.msg),a.status&&this.btnClose()})},clear:function(){store.dispatch("UPDATE_LIST",!0),store.dispatch("UPDATE_EDIT_ID","")}}}},77:function(t,a,e){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var s=e(116),i=e.n(s);a.default={name:"console-settiv-admin-index",data:function(){return{data:{},other:{}}},components:{edit:i.a},methods:{getList:function(){this.$layer.loading(),this.$http.get(config.data.console+"/setting/admin").then(function(t){this.$layer.closeAll("loading"),this.data=t.body.data.data,this.other=t.body.data.other})},del:function(t){var a=this;this.$layer.confirm("确定删除该用户",{btn:["确定","取消"]},function(){a.$http.post(config.data.console+"/setting/admin/delete",{id:t}).then(function(t){this.$layer.closeAll(),this.$layer.msg(t.body.msg),t.body.status&&this.getList()})})},open:function(t){var a=t.target.getAttribute("data-id"),e=t.target.getAttribute("data-title");a&&store.dispatch("UPDATE_EDIT_ID",a),e=e||t.target.innerHTML,this.$layer.iframe({content:{content:i.a,parent:this,data:["msg"]},closeBtn:1,area:["490px","510px"],title:e})}},created:function(){this.getList()},computed:{UPDATE_LIST:function(){return store.state.UPDATE_LIST}},watch:{UPDATE_LIST:function(t){this.getList(),store.dispatch("UPDATE_LIST",!1)}}}}});
//# sourceMappingURL=2.d37232c89dec361c2f61.js.map