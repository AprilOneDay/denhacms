webpackJsonp([0],{105:function(t,e,a){var s=a(8)(a(112),a(124),null,null,null);t.exports=s.exports},110:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"UE",data:function(){return{editor:null}},props:{defaultMsg:{type:String},config:{type:Object},id:{type:String}},mounted:function(){var t=this;this.editor=UE.getEditor(this.id,this.config),this.editor.addListener("ready",function(){t.editor.setContent(t.defaultMsg)})},methods:{getUEContent:function(){return this.editor.getContent()}},destroyed:function(){this.editor.destroy()}}},111:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var s=a(28),i=a.n(s),n=a(117),o=a.n(n);e.default={name:"console-setting-menus-edit",components:{UE2:o.a},data:function(){return{data:{is_show:1},menulist:{},defaultMsg:"这里是UE测试",config:{initialFrameWidth:null,initialFrameHeight:350},ue1:"ue1"}},props:["msg"],created:function(){this.getDetail()},mounted:function(){},methods:{getDetail:function(){this.$layer.loading(),this.$http.get(config.data.console+"/setting/menus/tree_list",{data:i()(this.data)}).then(function(t){this.menulist=t.body.menulist}),store.state.settingMenusEditId&&this.$http.get(config.data.console+"/setting/menus/edit?id="+store.state.settingMenusEditId).then(function(t){this.data=t.body.data.data}),store.state.settingMenusEditparentId&&(this.data.parentid=store.state.settingMenusEditparentId),this.$layer.closeAll("loading")},btnClose:function(){this.clear(),this.$layer.closeAll()},comply:function(){this.$layer.loading(),this.$http.post(config.data.console+"/setting/menus/edit",{data:i()(this.data)}).then(function(t){this.$layer.closeAll("loading");var e=t.body;this.$layer.msg(e.msg),e.status&&this.btnClose()})},clear:function(){store.dispatch("settingMenusList",!0),store.dispatch("settingMenusEditId",""),store.dispatch("settingMenusEditparentId","")}}}},112:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var s=a(118),i=a.n(s);e.default={name:"console-content-index-index",components:{edit:i.a},data:function(){return{data:{},ue2:"ue2",config:{initialFrameWidth:null,initialFrameHeight:350},defaultMsg:"AAAA"}},methods:{getList:function(){this.$layer.loading(),this.$http.get(config.data.console+"/setting/menus/index").then(function(t){this.$layer.closeAll("loading"),this.data=t.body.data.data})},open:function(t){var e=t.target.getAttribute("data-id"),a=t.target.getAttribute("data-title"),s=t.target.getAttribute("data-parentId");e&&store.dispatch("settingMenusEditId",e),s&&store.dispatch("settingMenusEditparentId",s),a=a||t.target.innerHTML,this.$layer.iframe({content:{content:i.a,parent:this,data:["msg"]},closeBtn:1,area:["890px","770px"],title:a})}},created:function(){this.getList()},computed:{settingMenusList:function(){return store.state.settingMenusList}},watch:{settingMenusList:function(t){this.getList(),store.dispatch("settingMenusList",!1)}}}},117:function(t,e,a){var s=a(8)(a(110),a(127),null,null,null);t.exports=s.exports},118:function(t,e,a){var s=a(8)(a(111),a(123),null,null,null);t.exports=s.exports},123:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{attrs:{id:"console-setting-menus-edit"}},[a("div",{staticClass:"modal-content"},[a("div",{staticClass:"modal-body clearfix"},[a("div",{staticClass:"panel"},[a("div",{staticClass:"panel-body"},[a("form",{staticClass:"form-horizontal",attrs:{role:"form"}},[a("fieldset",[a("div",{staticClass:"form-group"},[t._m(0),t._v(" "),a("div",{staticClass:"col-sm-8"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.data.name,expression:"data.name"}],staticClass:"form-control",attrs:{type:"text",placeholder:"标题",required:""},domProps:{value:t.data.name},on:{input:function(e){e.target.composing||(t.data.name=e.target.value)}}})])]),t._v(" "),a("div",{staticClass:"form-group"},[t._m(1),t._v(" "),a("div",{staticClass:"col-sm-8"},[a("select",{directives:[{name:"model",rawName:"v-model",value:t.data.parentid,expression:"data.parentid"}],staticClass:"form-control w160",on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.data.parentid=e.target.multiple?a:a[0]}}},[a("option",{attrs:{value:"0"}},[t._v("作为一级菜单")]),t._v(" "),t._l(t.menulist,function(e){return a("option",{domProps:{value:e.id,innerHTML:t._s(e.htmlname)}})})],2)])]),t._v(" "),a("div",{staticClass:"form-group"},[t._m(2),t._v(" "),a("div",{staticClass:"col-sm-8"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.data.icon,expression:"data.icon"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Icon图标"},domProps:{value:t.data.icon},on:{input:function(e){e.target.composing||(t.data.icon=e.target.value)}}})])]),t._v(" "),a("div",{staticClass:"form-group"},[t._m(3),t._v(" "),a("div",{staticClass:"col-sm-8"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.data.module,expression:"data.module"}],staticClass:"form-control",attrs:{type:"text",placeholder:"控制器名称"},domProps:{value:t.data.module},on:{input:function(e){e.target.composing||(t.data.module=e.target.value)}}})])]),t._v(" "),t._m(4),t._v(" "),a("div",{staticClass:"form-group"},[a("label",{staticClass:"control-label col-sm-3"},[t._v("显示状态：")]),t._v(" "),a("div",{staticClass:"radio-inline"},[a("label",[a("input",{directives:[{name:"model",rawName:"v-model",value:t.data.is_show,expression:"data.is_show"}],attrs:{type:"radio",value:"1"},domProps:{checked:t._q(t.data.is_show,"1")},on:{__c:function(e){t.data.is_show="1"}}}),t._v(" 显示\n\t\t\t\t\t\t\t\t\t")])]),t._v(" "),a("div",{staticClass:"radio-inline"},[a("label",[a("input",{directives:[{name:"model",rawName:"v-model",value:t.data.is_show,expression:"data.is_show"}],attrs:{type:"radio",value:"0"},domProps:{checked:t._q(t.data.is_show,"0")},on:{__c:function(e){t.data.is_show="0"}}}),t._v(" 隐藏\n\t\t\t\t\t\t\t\t\t")])])])])])])])]),t._v(" "),a("div",{staticClass:"modal-footer"},[a("button",{staticClass:"btn btn-primary",attrs:{type:"submit"},on:{click:t.comply}},[t._v("确定")]),t._v(" "),a("button",{staticClass:"btn btn-default",attrs:{type:"button",id:"btn-close"},on:{click:t.btnClose}},[t._v("取消")])])]),t._v(" "),a("UE2",{ref:"ue",attrs:{defaultMsg:t.defaultMsg,config:t.config,id:t.ue1}})],1)},staticRenderFns:[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("label",{staticClass:"control-label col-sm-3"},[a("span",{staticClass:"text-danger"},[t._v("*")]),t._v(" "),a("span",[t._v("标题")])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("label",{staticClass:"control-label col-sm-3"},[a("span",{staticClass:"text-danger"},[t._v("*")]),t._v(" "),a("span",[t._v("上级菜单")])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("label",{staticClass:"control-label col-sm-3"},[a("span",{staticClass:"text-danger"},[t._v("*")]),t._v(" "),a("span",[t._v("发布时间")])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("label",{staticClass:"control-label col-sm-3"},[a("span",{staticClass:"text-danger"},[t._v("*")]),t._v(" "),a("span",[t._v("摘要")])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-group"},[a("label",{staticClass:"control-label col-sm-3"},[a("span",{staticClass:"text-danger"},[t._v("*")]),t._v(" "),a("span",[t._v("内容")])]),t._v(" "),a("div",{staticClass:"col-sm-8"})])}]}},124:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{attrs:{id:"console-content-index-index"}},[a("div",{staticClass:"view-content-container"},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-sm-12"},[a("div",{staticClass:"console-title console-title-border clearfix"},[t._m(0),t._v(" "),a("div",{staticClass:"pull-right"},[a("a",{staticClass:"btn btn-primary",attrs:{"data-id":"","data-height":"750"},on:{click:function(e){t.open(e)}}},[t._v("添加文章")])])]),t._v(" "),a("div",{staticClass:"console-form"},[a("div",{staticClass:"mt8"},[a("form",[a("table",{staticClass:"table table-hover"},[t._m(1),t._v(" "),a("tbody",t._l(t.data.list,function(e){return a("tr",[a("td",[t._v(t._s(e.id))]),t._v(" "),a("td",[a("span",{domProps:{innerHTML:t._s(e.delimiter)}}),t._v(t._s(e.name))]),t._v(" "),a("td",[t._v(t._s(e.module))]),t._v(" "),a("td",[t._v(t._s(e.controller))]),t._v(" "),a("td",[t._v(t._s(e.action))]),t._v(" "),a("td",[t._v(t._s(e.parameter))]),t._v(" "),a("td",{attrs:{align:"center"}},[t._v(t._s(e.sort))]),t._v(" "),a("td",{attrs:{align:"center"}},[t._v(t._s(e.status))]),t._v(" "),a("td",{attrs:{align:"center"}},[t._v(t._s(e.is_show))]),t._v(" "),a("td",{attrs:{align:"center"}},[a("a",{attrs:{"data-title":"编辑菜单","data-height":"800","data-parentId":e.id},on:{click:function(e){t.open(e)}}},[t._v("添加子菜单")]),t._v(" "),a("span",{staticClass:"text-explode"},[t._v("|")]),t._v(" "),a("a",{attrs:{"data-title":"编辑菜单","data-id":e.id,"data-height":"800"},on:{click:function(e){t.open(e)}}},[t._v("编辑")]),t._v(" "),a("span",{staticClass:"text-explode"},[t._v("|")]),t._v(" "),a("a",{attrs:{"ng-click":"delete(list.id)"}},[t._v("删除")])])])}))])])])])])])])])},staticRenderFns:[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"pull-left"},[a("h5",[t._v("菜单列表")])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("thead",[a("tr",[a("th",{staticStyle:{width:"75px"}},[t._v("ID")]),t._v(" "),a("th",[t._v("标题")]),t._v(" "),a("th",{staticStyle:{width:"120px"}},[t._v("类型")]),t._v(" "),a("th",{staticStyle:{width:"120px"}},[t._v("发布时间")]),t._v(" "),a("th",{staticStyle:{width:"120px"}},[t._v("状态")]),t._v(" "),a("th",{staticStyle:{width:"160px","text-align":"center"}},[t._v("编辑/操作")])])])}]}},127:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("script",{attrs:{id:t.id,type:"text/plain"}})])},staticRenderFns:[]}}});
//# sourceMappingURL=0.69d1c2780e16241402e8.js.map