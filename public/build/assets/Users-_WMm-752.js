import{_ as k}from"./Master-DviA6tr0.js";import $ from"./AddUserModal-CIuscKM_.js";import{s as h}from"./index-CAH55EvF.js";import{s as w,a as l}from"./index-DmTNw5x_.js";import{s as S}from"./index-C-DZvclK.js";import{B as P,f as d,c as g,g as b,s as c,v as j,j as f,q as B,e as m,t as U,w as i,b as n,d as a,i as C,l as z}from"./app-Cm8FNNfR.js";import{f as N}from"./index-ZhWAdK_X.js";import{a as v}from"./index-XI8XLrq0.js";import{s as T}from"./index--McxHyUe.js";import{s as _}from"./index-kCRz7nr6.js";import"./index-BSNz3Kzp.js";import"./index-D6AO8LAO.js";import"./index-BXd_d5Le.js";import"./index-Y8OOJhPg.js";import"./Footer-FOU_i4tL.js";import"./index-g0vg4wM2.js";import"./index.esm-B2lfiD6T.js";import"./index-J0EDs0uJ.js";import"./index-CijpoGzo.js";import"./index-Bjgni5gO.js";import"./index-C76d6EZO.js";import"./index-x-Gz7Pml.js";import"./index-CXTU7X2a.js";import"./index-B3cNsKUF.js";var D=`
    .p-tag {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: dt('tag.primary.background');
        color: dt('tag.primary.color');
        font-size: dt('tag.font.size');
        font-weight: dt('tag.font.weight');
        padding: dt('tag.padding');
        border-radius: dt('tag.border.radius');
        gap: dt('tag.gap');
    }

    .p-tag-icon {
        font-size: dt('tag.icon.size');
        width: dt('tag.icon.size');
        height: dt('tag.icon.size');
    }

    .p-tag-rounded {
        border-radius: dt('tag.rounded.border.radius');
    }

    .p-tag-success {
        background: dt('tag.success.background');
        color: dt('tag.success.color');
    }

    .p-tag-info {
        background: dt('tag.info.background');
        color: dt('tag.info.color');
    }

    .p-tag-warn {
        background: dt('tag.warn.background');
        color: dt('tag.warn.color');
    }

    .p-tag-danger {
        background: dt('tag.danger.background');
        color: dt('tag.danger.color');
    }

    .p-tag-secondary {
        background: dt('tag.secondary.background');
        color: dt('tag.secondary.color');
    }

    .p-tag-contrast {
        background: dt('tag.contrast.background');
        color: dt('tag.contrast.color');
    }
`,V={root:function(e){var r=e.props;return["p-tag p-component",{"p-tag-info":r.severity==="info","p-tag-success":r.severity==="success","p-tag-warn":r.severity==="warn","p-tag-danger":r.severity==="danger","p-tag-secondary":r.severity==="secondary","p-tag-contrast":r.severity==="contrast","p-tag-rounded":r.rounded}]},icon:"p-tag-icon",label:"p-tag-label"},A=P.extend({name:"tag",style:D,classes:V}),E={name:"BaseTag",extends:S,props:{value:null,severity:null,rounded:Boolean,icon:String},style:A,provide:function(){return{$pcTag:this,$parentInstance:this}}};function p(t){"@babel/helpers - typeof";return p=typeof Symbol=="function"&&typeof Symbol.iterator=="symbol"?function(e){return typeof e}:function(e){return e&&typeof Symbol=="function"&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},p(t)}function O(t,e,r){return(e=q(e))in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}function q(t){var e=I(t,"string");return p(e)=="symbol"?e:e+""}function I(t,e){if(p(t)!="object"||!t)return t;var r=t[Symbol.toPrimitive];if(r!==void 0){var u=r.call(t,e);if(p(u)!="object")return u;throw new TypeError("@@toPrimitive must return a primitive value.")}return(e==="string"?String:Number)(t)}var y={name:"Tag",extends:E,inheritAttrs:!1,computed:{dataP:function(){return N(O({rounded:this.rounded},this.severity,this.severity))}}},K=["data-p"];function F(t,e,r,u,o,s){return d(),g("span",c({class:t.cx("root"),"data-p":s.dataP},t.ptmi("root")),[t.$slots.icon?(d(),b(j(t.$slots.icon),c({key:0,class:t.cx("icon")},t.ptm("icon")),null,16,["class"])):t.icon?(d(),g("span",c({key:1,class:[t.cx("icon"),t.icon]},t.ptm("icon")),null,16)):f("",!0),t.value!=null||t.$slots.default?B(t.$slots,"default",{key:2},function(){return[m("span",c({class:t.cx("label")},t.ptm("label")),U(t.value),17)]}):f("",!0)],16,K)}y.render=F;const G={class:"flex justify-between"},H={key:0},J={key:1},ft={__name:"Users",props:{users:Object,department:Object},setup(t){const e=t,r=z(!1);return(u,o)=>(d(),b(k,null,{default:i(()=>[n(a(h),{class:"p-5"},{title:i(()=>[m("div",G,[o[4]||(o[4]=m("div",null," Users ",-1)),m("div",null,[n(a(v),{onClick:o[0]||(o[0]=s=>r.value=!0)},{default:i(()=>[...o[3]||(o[3]=[C("Add User",-1)])]),_:1})])]),n(a(T))]),content:i(()=>[n(a(w),{value:e.users,tableStyle:"min-width: 50rem"},{default:i(()=>[n(a(l),{field:"name",header:"Name"}),n(a(l),{field:"email",header:"Email"}),n(a(l),{field:"department.name",header:"Department"}),n(a(l),{field:"status",header:"Status"},{body:i(({data:s})=>[s.status.name==="active"?(d(),g("div",H,[n(a(y),{value:s.status.name.toUpperCase(),severity:"success"},null,8,["value"])])):f("",!0),s.status.name==="inactive"?(d(),g("div",J,[n(a(y),{value:s.status.name.toUpperCase(),severity:"danger"},null,8,["value"])])):f("",!0)]),_:1}),n(a(l),{field:"",header:""},{body:i(()=>[n(a(v),{severity:"secondary",icon:"pi pi-pencil","aria-label":"Save"})]),_:1})]),_:1},8,["value"])]),_:1}),n(a(_),{visible:r.value,"onUpdate:visible":o[2]||(o[2]=s=>r.value=s),modal:"",header:"Add User",style:{width:"35rem"}},{default:i(()=>[n($,{onClose:o[1]||(o[1]=s=>r.value=!1),department:e.department},null,8,["department"])]),_:1},8,["visible"])]),_:1}))}};export{ft as default};
