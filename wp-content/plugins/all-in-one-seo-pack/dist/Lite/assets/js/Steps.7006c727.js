import{b as a}from"./WpTable.68e67998.js";import{n as e}from"./_plugin-vue2_normalizer.d86aa1f3.js";import"./index.8eedf1b9.js";import"./SaveChanges.68e73792.js";import{a as r,c as i}from"./vuex.esm.19624049.js";const l={mixins:[a]};var c=function(){var t=this,s=t._self._c;return s("div",{staticClass:"aioseo-wizard-close-and-exit"},[t.$isPro||t.$aioseo.options.advanced.usageTracking?s("a",{attrs:{href:t.$aioseo.urls.aio.dashboard}},[t._v(" "+t._s(t.strings.closeAndExit)+" ")]):s("a",{attrs:{href:"#"},on:{click:function(n){n.preventDefault(),t.showModal=!0}}},[t._v(" "+t._s(t.strings.closeAndExit)+" ")]),t.showModal&&!t.$isPro?s("core-modal",{on:{close:function(n){t.showModal=!1}},scopedSlots:t._u([{key:"header",fn:function(){return[t._v(" "+t._s(t.strings.buildABetterAioseo)+" "),s("button",{staticClass:"close",on:{click:function(n){n.stopPropagation(),t.showModal=!1}}},[s("svg-close",{on:{click:function(n){t.showModal=!1}}})],1)]},proxy:!0},{key:"body",fn:function(){return[s("div",{staticClass:"aioseo-modal-body"},[s("div",{staticClass:"reset-description",domProps:{innerHTML:t._s(t.strings.getImprovedFeatures)}}),s("div",{staticClass:"actions"},[s("base-button",{attrs:{tag:"a",href:t.$aioseo.urls.aio.dashboard,type:"gray",size:"medium"}},[t._v(" "+t._s(t.strings.noThanks)+" ")]),s("base-button",{attrs:{type:"blue",size:"medium",loading:t.loading},on:{click:t.processOptIn}},[t._v(" "+t._s(t.strings.yesCountMeIn)+" ")])],1)])]},proxy:!0}],null,!1,3497119961)}):t._e()],1)},u=[],_=e(l,c,u,!1,null,null,null,null);const C=_.exports;const d={computed:{...r("wizard",["currentStage"]),...i("wizard",["getCurrentStageCount","getTotalStageCount"]),getSteps(){return this.$t.sprintf(this.$t.__("Step %1$s of %2$s",this.$td),this.getCurrentStageCount,this.getTotalStageCount)}}};var p=function(){var t=this,s=t._self._c;return s("div",{staticClass:"aioseo-wizard-steps"},[t._v(" "+t._s(t.getSteps)+" ")])},f=[],g=e(d,p,f,!1,null,null,null,null);const $=g.exports;export{C as W,$ as a};