/** Notice * This file contains works from many authors under various (but compatible) licenses. Please see core.txt for more information. **/
(function(){(window.wpCoreControlsBundle=window.wpCoreControlsBundle||[]).push([[11],{432:function(Aa,ua,r){r.r(ua);var pa=r(1);Aa=r(51);var ka=r(372),ma=r(230),ha=r(20),da=window;r=function(){function aa(x){var y=this;this.zda=function(h){return h&&("image"===h.type.split("/")[0].toLowerCase()||h.name&&!!h.name.match(/.(jpg|jpeg|png|gif)$/i))};this.file=x;this.Mda=new Promise(function(h){return Object(pa.b)(y,void 0,void 0,function(){var e;return Object(pa.d)(this,function(b){switch(b.label){case 0:return this.zda(this.file)?
[4,Object(ma.b)(x)]:[3,2];case 1:e=b.ea(),this.file=ha.p?new Blob([e],{type:x.type}):new File([e],null===x||void 0===x?void 0:x.name,{type:x.type}),b.label=2;case 2:return h(!0),[2]}})})})}aa.prototype.getFileData=function(x){var y=this,h=new FileReader;h.onload=function(e){y.trigger(aa.Events.DOCUMENT_LOADING_PROGRESS,[e.loaded,e.loaded]);x(new Uint8Array(e.target.result))};h.onprogress=function(e){e.lengthComputable&&y.trigger(aa.Events.DOCUMENT_LOADING_PROGRESS,[e.loaded,0<e.total?e.total:0])};
h.readAsArrayBuffer(this.file)};aa.prototype.getFile=function(){return Object(pa.b)(this,void 0,Promise,function(){return Object(pa.d)(this,function(x){switch(x.label){case 0:return[4,this.Mda];case 1:return x.ea(),da.utils.isJSWorker?[2,this.file.path]:[2,this.file]}})})};aa.Events={DOCUMENT_LOADING_PROGRESS:"documentLoadingProgress"};return aa}();Object(Aa.a)(r);Object(ka.a)(r);Object(ka.b)(r);ua["default"]=r}}]);}).call(this || window)
