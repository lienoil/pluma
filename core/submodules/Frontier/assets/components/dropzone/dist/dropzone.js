(function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.dropzone=t():e.dropzone=t()})(this,function(){return function(e){function t(n){if(i[n])return i[n].exports;var r=i[n]={i:n,l:!1,exports:{}};return e[n].call(r.exports,r,r.exports,t),r.l=!0,r.exports}var i={};return t.m=e,t.c=i,t.i=function(e){return e},t.d=function(e,i,n){t.o(e,i)||Object.defineProperty(e,i,{configurable:!1,enumerable:!0,get:n})},t.n=function(e){var i=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(i,"a",i),i},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="/",t(t.s=7)}([function(e,t,i){i(3);var n=i(4)(i(2),i(5),null,null);e.exports=n.exports},function(e,t,i){(function(e){(function(){var t,i,n,r,o,s,l,a,u,p=[].slice,c=function(e,t){function i(){this.constructor=e}for(var n in t)d.call(t,n)&&(e[n]=t[n]);return i.prototype=t.prototype,e.prototype=new i,e.__super__=t.prototype,e},d={}.hasOwnProperty;a=function(){},i=function(){function e(){}return e.prototype.addEventListener=e.prototype.on,e.prototype.on=function(e,t){return this._callbacks=this._callbacks||{},this._callbacks[e]||(this._callbacks[e]=[]),this._callbacks[e].push(t),this},e.prototype.emit=function(){var e,t,i,n,r,o;if(n=arguments[0],e=2<=arguments.length?p.call(arguments,1):[],this._callbacks=this._callbacks||{},i=this._callbacks[n])for(r=0,o=i.length;r<o;r++)t=i[r],t.apply(this,e);return this},e.prototype.removeListener=e.prototype.off,e.prototype.removeAllListeners=e.prototype.off,e.prototype.removeEventListener=e.prototype.off,e.prototype.off=function(e,t){var i,n,r,o;if(!this._callbacks||0===arguments.length)return this._callbacks={},this;if(!(i=this._callbacks[e]))return this;if(1===arguments.length)return delete this._callbacks[e],this;for(n=r=0,o=i.length;r<o;n=++r)if(i[n]===t){i.splice(n,1);break}return this},e}(),t=function(e){function t(e,i){var n,o,s;if(this.element=e,this.version=t.version,this.defaultOptions.previewTemplate=this.defaultOptions.previewTemplate.replace(/\n*/g,""),this.clickableElements=[],this.listeners=[],this.files=[],"string"==typeof this.element&&(this.element=document.querySelector(this.element)),!this.element||null==this.element.nodeType)throw new Error("Invalid dropzone element.");if(this.element.dropzone)throw new Error("Dropzone already attached.");if(t.instances.push(this),this.element.dropzone=this,n=null!=(s=t.optionsForElement(this.element))?s:{},this.options=r({},this.defaultOptions,n,null!=i?i:{}),this.options.forceFallback||!t.isBrowserSupported())return this.options.fallback.call(this);if(null==this.options.url&&(this.options.url=this.element.getAttribute("action")),!this.options.url)throw new Error("No URL provided.");if(this.options.acceptedFiles&&this.options.acceptedMimeTypes)throw new Error("You can't provide both 'acceptedFiles' and 'acceptedMimeTypes'. 'acceptedMimeTypes' is deprecated.");this.options.acceptedMimeTypes&&(this.options.acceptedFiles=this.options.acceptedMimeTypes,delete this.options.acceptedMimeTypes),null!=this.options.renameFilename&&(this.options.renameFile=function(e){return function(t){return e.options.renameFilename.call(e,t.name,t)}}(this)),this.options.method=this.options.method.toUpperCase(),(o=this.getExistingFallback())&&o.parentNode&&o.parentNode.removeChild(o),!1!==this.options.previewsContainer&&(this.options.previewsContainer?this.previewsContainer=t.getElement(this.options.previewsContainer,"previewsContainer"):this.previewsContainer=this.element),this.options.clickable&&(!0===this.options.clickable?this.clickableElements=[this.element]:this.clickableElements=t.getElements(this.options.clickable,"clickable")),this.init()}var r,o;return c(t,e),t.prototype.Emitter=i,t.prototype.events=["drop","dragstart","dragend","dragenter","dragover","dragleave","addedfile","addedfiles","removedfile","thumbnail","error","errormultiple","processing","processingmultiple","uploadprogress","totaluploadprogress","sending","sendingmultiple","success","successmultiple","canceled","canceledmultiple","complete","completemultiple","reset","maxfilesexceeded","maxfilesreached","queuecomplete"],t.prototype.defaultOptions={url:null,method:"post",withCredentials:!1,timeout:3e4,parallelUploads:2,uploadMultiple:!1,maxFilesize:256,paramName:"file",createImageThumbnails:!0,maxThumbnailFilesize:10,thumbnailWidth:120,thumbnailHeight:120,thumbnailMethod:"crop",resizeWidth:null,resizeHeight:null,resizeMimeType:null,resizeQuality:.8,resizeMethod:"contain",filesizeBase:1e3,maxFiles:null,params:{},headers:null,clickable:!0,ignoreHiddenFiles:!0,acceptedFiles:null,acceptedMimeTypes:null,autoProcessQueue:!0,autoQueue:!0,addRemoveLinks:!1,previewsContainer:null,hiddenInputContainer:"body",capture:null,renameFilename:null,renameFile:null,forceFallback:!1,dictDefaultMessage:"Drop files here to upload",dictFallbackMessage:"Your browser does not support drag'n'drop file uploads.",dictFallbackText:"Please use the fallback form below to upload your files like in the olden days.",dictFileTooBig:"File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",dictInvalidFileType:"You can't upload files of this type.",dictResponseError:"Server responded with {{statusCode}} code.",dictCancelUpload:"Cancel upload",dictCancelUploadConfirmation:"Are you sure you want to cancel this upload?",dictRemoveFile:"Remove file",dictRemoveFileConfirmation:null,dictMaxFilesExceeded:"You can not upload any more files.",dictFileSizeUnits:{tb:"TB",gb:"GB",mb:"MB",kb:"KB",b:"b"},init:function(){return a},accept:function(e,t){return t()},fallback:function(){var e,i,n,r,o,s;for(this.element.className=this.element.className+" dz-browser-not-supported",o=this.element.getElementsByTagName("div"),i=0,n=o.length;i<n;i++)e=o[i],/(^| )dz-message($| )/.test(e.className)&&(r=e,e.className="dz-message");return r||(r=t.createElement('<div class="dz-message"><span></span></div>'),this.element.appendChild(r)),s=r.getElementsByTagName("span")[0],s&&(null!=s.textContent?s.textContent=this.options.dictFallbackMessage:null!=s.innerText&&(s.innerText=this.options.dictFallbackMessage)),this.element.appendChild(this.getFallbackForm())},resize:function(e,t,i,n){var r,o,s;if(r={srcX:0,srcY:0,srcWidth:e.width,srcHeight:e.height},o=e.width/e.height,null==t&&null==i?(t=r.srcWidth,i=r.srcHeight):null==t?t=i*o:null==i&&(i=t/o),t=Math.min(t,r.srcWidth),i=Math.min(i,r.srcHeight),s=t/i,r.srcWidth>t||r.srcHeight>i)if("crop"===n)o>s?(r.srcHeight=e.height,r.srcWidth=r.srcHeight*s):(r.srcWidth=e.width,r.srcHeight=r.srcWidth/s);else{if("contain"!==n)throw new Error("Unknown resizeMethod '"+n+"'");o>s?i=t/o:t=i*o}return r.srcX=(e.width-r.srcWidth)/2,r.srcY=(e.height-r.srcHeight)/2,r.trgWidth=t,r.trgHeight=i,r},transformFile:function(e,t){return(this.options.resizeWidth||this.options.resizeHeight)&&e.type.match(/image.*/)?this.resizeImage(e,this.options.resizeWidth,this.options.resizeHeight,this.options.resizeMethod,t):t(e)},previewTemplate:'<div class="dz-preview dz-file-preview">\n  <div class="dz-image"><img data-dz-thumbnail /></div>\n  <div class="dz-details">\n    <div class="dz-size"><span data-dz-size></span></div>\n    <div class="dz-filename"><span data-dz-name></span></div>\n  </div>\n  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>\n  <div class="dz-error-message"><span data-dz-errormessage></span></div>\n  <div class="dz-success-mark">\n    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">\n      <title>Check</title>\n      <defs></defs>\n      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">\n        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>\n      </g>\n    </svg>\n  </div>\n  <div class="dz-error-mark">\n    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">\n      <title>Error</title>\n      <defs></defs>\n      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">\n        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">\n          <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>\n        </g>\n      </g>\n    </svg>\n  </div>\n</div>',drop:function(e){return this.element.classList.remove("dz-drag-hover")},dragstart:a,dragend:function(e){return this.element.classList.remove("dz-drag-hover")},dragenter:function(e){return this.element.classList.add("dz-drag-hover")},dragover:function(e){return this.element.classList.add("dz-drag-hover")},dragleave:function(e){return this.element.classList.remove("dz-drag-hover")},paste:a,reset:function(){return this.element.classList.remove("dz-started")},addedfile:function(e){var i,n,r,o,s,l,a,u,p,c,d,h,f;if(this.element===this.previewsContainer&&this.element.classList.add("dz-started"),this.previewsContainer){for(e.previewElement=t.createElement(this.options.previewTemplate.trim()),e.previewTemplate=e.previewElement,this.previewsContainer.appendChild(e.previewElement),u=e.previewElement.querySelectorAll("[data-dz-name]"),i=0,o=u.length;i<o;i++)a=u[i],a.textContent=e.name;for(p=e.previewElement.querySelectorAll("[data-dz-size]"),n=0,s=p.length;n<s;n++)a=p[n],a.innerHTML=this.filesize(e.size);for(this.options.addRemoveLinks&&(e._removeLink=t.createElement('<a class="dz-remove" href="javascript:undefined;" data-dz-remove>'+this.options.dictRemoveFile+"</a>"),e.previewElement.appendChild(e._removeLink)),d=function(i){return function(n){return n.preventDefault(),n.stopPropagation(),e.status===t.UPLOADING?t.confirm(i.options.dictCancelUploadConfirmation,function(){return i.removeFile(e)}):i.options.dictRemoveFileConfirmation?t.confirm(i.options.dictRemoveFileConfirmation,function(){return i.removeFile(e)}):i.removeFile(e)}}(this),c=e.previewElement.querySelectorAll("[data-dz-remove]"),f=[],r=0,l=c.length;r<l;r++)h=c[r],f.push(h.addEventListener("click",d));return f}},removedfile:function(e){var t;return e.previewElement&&null!=(t=e.previewElement)&&t.parentNode.removeChild(e.previewElement),this._updateMaxFilesReachedClass()},thumbnail:function(e,t){var i,n,r,o;if(e.previewElement){for(e.previewElement.classList.remove("dz-file-preview"),r=e.previewElement.querySelectorAll("[data-dz-thumbnail]"),i=0,n=r.length;i<n;i++)o=r[i],o.alt=e.name,o.src=t;return setTimeout(function(t){return function(){return e.previewElement.classList.add("dz-image-preview")}}(),1)}},error:function(e,t){var i,n,r,o,s;if(e.previewElement){for(e.previewElement.classList.add("dz-error"),"String"!=typeof t&&t.error&&(t=t.error),o=e.previewElement.querySelectorAll("[data-dz-errormessage]"),s=[],i=0,n=o.length;i<n;i++)r=o[i],s.push(r.textContent=t);return s}},errormultiple:a,processing:function(e){if(e.previewElement&&(e.previewElement.classList.add("dz-processing"),e._removeLink))return e._removeLink.textContent=this.options.dictCancelUpload},processingmultiple:a,uploadprogress:function(e,t,i){var n,r,o,s,l;if(e.previewElement){for(s=e.previewElement.querySelectorAll("[data-dz-uploadprogress]"),l=[],n=0,r=s.length;n<r;n++)o=s[n],"PROGRESS"===o.nodeName?l.push(o.value=t):l.push(o.style.width=t+"%");return l}},totaluploadprogress:a,sending:a,sendingmultiple:a,success:function(e){if(e.previewElement)return e.previewElement.classList.add("dz-success")},successmultiple:a,canceled:function(e){return this.emit("error",e,"Upload canceled.")},canceledmultiple:a,complete:function(e){if(e._removeLink&&(e._removeLink.textContent=this.options.dictRemoveFile),e.previewElement)return e.previewElement.classList.add("dz-complete")},completemultiple:a,maxfilesexceeded:a,maxfilesreached:a,queuecomplete:a,addedfiles:a},r=function(){var e,t,i,n,r,o,s;for(o=arguments[0],r=2<=arguments.length?p.call(arguments,1):[],e=0,i=r.length;e<i;e++){n=r[e];for(t in n)s=n[t],o[t]=s}return o},t.prototype.getAcceptedFiles=function(){var e,t,i,n,r;for(n=this.files,r=[],t=0,i=n.length;t<i;t++)e=n[t],e.accepted&&r.push(e);return r},t.prototype.getRejectedFiles=function(){var e,t,i,n,r;for(n=this.files,r=[],t=0,i=n.length;t<i;t++)e=n[t],e.accepted||r.push(e);return r},t.prototype.getFilesWithStatus=function(e){var t,i,n,r,o;for(r=this.files,o=[],i=0,n=r.length;i<n;i++)t=r[i],t.status===e&&o.push(t);return o},t.prototype.getQueuedFiles=function(){return this.getFilesWithStatus(t.QUEUED)},t.prototype.getUploadingFiles=function(){return this.getFilesWithStatus(t.UPLOADING)},t.prototype.getAddedFiles=function(){return this.getFilesWithStatus(t.ADDED)},t.prototype.getActiveFiles=function(){var e,i,n,r,o;for(r=this.files,o=[],i=0,n=r.length;i<n;i++)e=r[i],e.status!==t.UPLOADING&&e.status!==t.QUEUED||o.push(e);return o},t.prototype.init=function(){var e,i,n,r,o,s,l;for("form"===this.element.tagName&&this.element.setAttribute("enctype","multipart/form-data"),this.element.classList.contains("dropzone")&&!this.element.querySelector(".dz-message")&&this.element.appendChild(t.createElement('<div class="dz-default dz-message"><span>'+this.options.dictDefaultMessage+"</span></div>")),this.clickableElements.length&&(l=function(e){return function(){return e.hiddenFileInput&&e.hiddenFileInput.parentNode.removeChild(e.hiddenFileInput),e.hiddenFileInput=document.createElement("input"),e.hiddenFileInput.setAttribute("type","file"),(null==e.options.maxFiles||e.options.maxFiles>1)&&e.hiddenFileInput.setAttribute("multiple","multiple"),e.hiddenFileInput.className="dz-hidden-input",null!=e.options.acceptedFiles&&e.hiddenFileInput.setAttribute("accept",e.options.acceptedFiles),null!=e.options.capture&&e.hiddenFileInput.setAttribute("capture",e.options.capture),e.hiddenFileInput.style.visibility="hidden",e.hiddenFileInput.style.position="absolute",e.hiddenFileInput.style.top="0",e.hiddenFileInput.style.left="0",e.hiddenFileInput.style.height="0",e.hiddenFileInput.style.width="0",document.querySelector(e.options.hiddenInputContainer).appendChild(e.hiddenFileInput),e.hiddenFileInput.addEventListener("change",function(){var t,i,n,r;if(i=e.hiddenFileInput.files,i.length)for(n=0,r=i.length;n<r;n++)t=i[n],e.addFile(t);return e.emit("addedfiles",i),l()})}}(this))(),this.URL=null!=(o=window.URL)?o:window.webkitURL,s=this.events,i=0,n=s.length;i<n;i++)e=s[i],this.on(e,this.options[e]);return this.on("uploadprogress",function(e){return function(){return e.updateTotalUploadProgress()}}(this)),this.on("removedfile",function(e){return function(){return e.updateTotalUploadProgress()}}(this)),this.on("canceled",function(e){return function(t){return e.emit("complete",t)}}(this)),this.on("complete",function(e){return function(t){if(0===e.getAddedFiles().length&&0===e.getUploadingFiles().length&&0===e.getQueuedFiles().length)return setTimeout(function(){return e.emit("queuecomplete")},0)}}(this)),r=function(e){return e.stopPropagation(),e.preventDefault?e.preventDefault():e.returnValue=!1},this.listeners=[{element:this.element,events:{dragstart:function(e){return function(t){return e.emit("dragstart",t)}}(this),dragenter:function(e){return function(t){return r(t),e.emit("dragenter",t)}}(this),dragover:function(e){return function(t){var i;try{i=t.dataTransfer.effectAllowed}catch(e){}return t.dataTransfer.dropEffect="move"===i||"linkMove"===i?"move":"copy",r(t),e.emit("dragover",t)}}(this),dragleave:function(e){return function(t){return e.emit("dragleave",t)}}(this),drop:function(e){return function(t){return r(t),e.drop(t)}}(this),dragend:function(e){return function(t){return e.emit("dragend",t)}}(this)}}],this.clickableElements.forEach(function(e){return function(i){return e.listeners.push({element:i,events:{click:function(n){return(i!==e.element||n.target===e.element||t.elementInside(n.target,e.element.querySelector(".dz-message")))&&e.hiddenFileInput.click(),!0}}})}}(this)),this.enable(),this.options.init.call(this)},t.prototype.destroy=function(){var e;return this.disable(),this.removeAllFiles(!0),(null!=(e=this.hiddenFileInput)?e.parentNode:void 0)&&(this.hiddenFileInput.parentNode.removeChild(this.hiddenFileInput),this.hiddenFileInput=null),delete this.element.dropzone,t.instances.splice(t.instances.indexOf(this),1)},t.prototype.updateTotalUploadProgress=function(){var e,t,i,n,r,o,s,l;if(s=0,o=0,e=this.getActiveFiles(),e.length){for(r=this.getActiveFiles(),i=0,n=r.length;i<n;i++)t=r[i],s+=t.upload.bytesSent,o+=t.upload.total;l=100*s/o}else l=100;return this.emit("totaluploadprogress",l,o,s)},t.prototype._getParamName=function(e){return"function"==typeof this.options.paramName?this.options.paramName(e):this.options.paramName+(this.options.uploadMultiple?"["+e+"]":"")},t.prototype._renameFile=function(e){return"function"!=typeof this.options.renameFile?e.name:this.options.renameFile(e)},t.prototype.getFallbackForm=function(){var e,i,n,r;return(e=this.getExistingFallback())?e:(n='<div class="dz-fallback">',this.options.dictFallbackText&&(n+="<p>"+this.options.dictFallbackText+"</p>"),n+='<input type="file" name="'+this._getParamName(0)+'" '+(this.options.uploadMultiple?'multiple="multiple"':void 0)+' /><input type="submit" value="Upload!"></div>',i=t.createElement(n),"FORM"!==this.element.tagName?(r=t.createElement('<form action="'+this.options.url+'" enctype="multipart/form-data" method="'+this.options.method+'"></form>'),r.appendChild(i)):(this.element.setAttribute("enctype","multipart/form-data"),this.element.setAttribute("method",this.options.method)),null!=r?r:i)},t.prototype.getExistingFallback=function(){var e,t,i,n,r,o;for(t=function(e){var t,i,n;for(i=0,n=e.length;i<n;i++)if(t=e[i],/(^| )fallback($| )/.test(t.className))return t},r=["div","form"],i=0,n=r.length;i<n;i++)if(o=r[i],e=t(this.element.getElementsByTagName(o)))return e},t.prototype.setupEventListeners=function(){var e,t,i,n,r,o,s;for(o=this.listeners,s=[],i=0,n=o.length;i<n;i++)e=o[i],s.push(function(){var i,n;i=e.events,n=[];for(t in i)r=i[t],n.push(e.element.addEventListener(t,r,!1));return n}());return s},t.prototype.removeEventListeners=function(){var e,t,i,n,r,o,s;for(o=this.listeners,s=[],i=0,n=o.length;i<n;i++)e=o[i],s.push(function(){var i,n;i=e.events,n=[];for(t in i)r=i[t],n.push(e.element.removeEventListener(t,r,!1));return n}());return s},t.prototype.disable=function(){var e,t,i,n,r;for(this.clickableElements.forEach(function(e){return e.classList.remove("dz-clickable")}),this.removeEventListeners(),n=this.files,r=[],t=0,i=n.length;t<i;t++)e=n[t],r.push(this.cancelUpload(e));return r},t.prototype.enable=function(){return this.clickableElements.forEach(function(e){return e.classList.add("dz-clickable")}),this.setupEventListeners()},t.prototype.filesize=function(e){var t,i,n,r,o,s,l,a;if(o=0,s="b",e>0){for(a=["tb","gb","mb","kb","b"],i=n=0,r=a.length;n<r;i=++n)if(l=a[i],t=Math.pow(this.options.filesizeBase,4-i)/10,e>=t){o=e/Math.pow(this.options.filesizeBase,4-i),s=l;break}o=Math.round(10*o)/10}return"<strong>"+o+"</strong> "+this.options.dictFileSizeUnits[s]},t.prototype._updateMaxFilesReachedClass=function(){return null!=this.options.maxFiles&&this.getAcceptedFiles().length>=this.options.maxFiles?(this.getAcceptedFiles().length===this.options.maxFiles&&this.emit("maxfilesreached",this.files),this.element.classList.add("dz-max-files-reached")):this.element.classList.remove("dz-max-files-reached")},t.prototype.drop=function(e){var t,i;e.dataTransfer&&(this.emit("drop",e),t=e.dataTransfer.files,this.emit("addedfiles",t),t.length&&(i=e.dataTransfer.items,i&&i.length&&null!=i[0].webkitGetAsEntry?this._addFilesFromItems(i):this.handleFiles(t)))},t.prototype.paste=function(e){var t,i;if(null!=(null!=e&&null!=(i=e.clipboardData)?i.items:void 0))return this.emit("paste",e),t=e.clipboardData.items,t.length?this._addFilesFromItems(t):void 0},t.prototype.handleFiles=function(e){var t,i,n,r;for(r=[],i=0,n=e.length;i<n;i++)t=e[i],r.push(this.addFile(t));return r},t.prototype._addFilesFromItems=function(e){var t,i,n,r,o;for(o=[],n=0,r=e.length;n<r;n++)i=e[n],null!=i.webkitGetAsEntry&&(t=i.webkitGetAsEntry())?t.isFile?o.push(this.addFile(i.getAsFile())):t.isDirectory?o.push(this._addFilesFromDirectory(t,t.name)):o.push(void 0):null!=i.getAsFile&&(null==i.kind||"file"===i.kind)?o.push(this.addFile(i.getAsFile())):o.push(void 0);return o},t.prototype._addFilesFromDirectory=function(e,t){var i,n,r;return i=e.createReader(),n=function(e){return"undefined"!=typeof console&&null!==console&&"function"==typeof console.log?console.log(e):void 0},(r=function(e){return function(){return i.readEntries(function(i){var n,o,s;if(i.length>0){for(o=0,s=i.length;o<s;o++)n=i[o],n.isFile?n.file(function(i){if(!e.options.ignoreHiddenFiles||"."!==i.name.substring(0,1))return i.fullPath=t+"/"+i.name,e.addFile(i)}):n.isDirectory&&e._addFilesFromDirectory(n,t+"/"+n.name);r()}return null},n)}}(this))()},t.prototype.accept=function(e,i){return e.size>1024*this.options.maxFilesize*1024?i(this.options.dictFileTooBig.replace("{{filesize}}",Math.round(e.size/1024/10.24)/100).replace("{{maxFilesize}}",this.options.maxFilesize)):t.isValidFile(e,this.options.acceptedFiles)?null!=this.options.maxFiles&&this.getAcceptedFiles().length>=this.options.maxFiles?(i(this.options.dictMaxFilesExceeded.replace("{{maxFiles}}",this.options.maxFiles)),this.emit("maxfilesexceeded",e)):this.options.accept.call(this,e,i):i(this.options.dictInvalidFileType)},t.prototype.addFile=function(e){return e.upload={progress:0,total:e.size,bytesSent:0,filename:this._renameFile(e)},this.files.push(e),e.status=t.ADDED,this.emit("addedfile",e),this._enqueueThumbnail(e),this.accept(e,function(t){return function(i){return i?(e.accepted=!1,t._errorProcessing([e],i)):(e.accepted=!0,t.options.autoQueue&&t.enqueueFile(e)),t._updateMaxFilesReachedClass()}}(this))},t.prototype.enqueueFiles=function(e){var t,i,n;for(i=0,n=e.length;i<n;i++)t=e[i],this.enqueueFile(t);return null},t.prototype.enqueueFile=function(e){if(e.status!==t.ADDED||!0!==e.accepted)throw new Error("This file can't be queued because it has already been processed or was rejected.");if(e.status=t.QUEUED,this.options.autoProcessQueue)return setTimeout(function(e){return function(){return e.processQueue()}}(this),0)},t.prototype._thumbnailQueue=[],t.prototype._processingThumbnail=!1,t.prototype._enqueueThumbnail=function(e){if(this.options.createImageThumbnails&&e.type.match(/image.*/)&&e.size<=1024*this.options.maxThumbnailFilesize*1024)return this._thumbnailQueue.push(e),setTimeout(function(e){return function(){return e._processThumbnailQueue()}}(this),0)},t.prototype._processThumbnailQueue=function(){var e;if(!this._processingThumbnail&&0!==this._thumbnailQueue.length)return this._processingThumbnail=!0,e=this._thumbnailQueue.shift(),this.createThumbnail(e,this.options.thumbnailWidth,this.options.thumbnailHeight,this.options.thumbnailMethod,!0,function(t){return function(i){return t.emit("thumbnail",e,i),t._processingThumbnail=!1,t._processThumbnailQueue()}}(this))},t.prototype.removeFile=function(e){if(e.status===t.UPLOADING&&this.cancelUpload(e),this.files=u(this.files,e),this.emit("removedfile",e),0===this.files.length)return this.emit("reset")},t.prototype.removeAllFiles=function(e){var i,n,r,o;for(null==e&&(e=!1),o=this.files.slice(),n=0,r=o.length;n<r;n++)i=o[n],(i.status!==t.UPLOADING||e)&&this.removeFile(i);return null},t.prototype.resizeImage=function(e,i,r,o,s){return this.createThumbnail(e,i,r,o,!1,function(i){return function(r,o){var l,a;return null===o?s(e):(l=i.options.resizeMimeType,null==l&&(l=e.type),a=o.toDataURL(l,i.options.resizeQuality),"image/jpeg"!==l&&"image/jpg"!==l||(a=n.restore(e.dataURL,a)),s(t.dataURItoBlob(a)))}}(this))},t.prototype.createThumbnail=function(e,t,i,n,r,o){var s;return s=new FileReader,s.onload=function(l){return function(){return e.dataURL=s.result,"image/svg+xml"===e.type?void(null!=o&&o(s.result)):l.createThumbnailFromUrl(e,t,i,n,r,o)}}(this),s.readAsDataURL(e)},t.prototype.createThumbnailFromUrl=function(e,t,i,n,r,o,s){var a;return a=document.createElement("img"),s&&(a.crossOrigin=s),a.onload=function(s){return function(){var u;return u=function(e){return e(1)},"undefined"!=typeof EXIF&&null!==EXIF&&r&&(u=function(e){return EXIF.getData(a,function(){return e(EXIF.getTag(this,"Orientation"))})}),u(function(r){var u,p,c,d,h,f,m,g;switch(e.width=a.width,e.height=a.height,m=s.options.resize.call(s,e,t,i,n),u=document.createElement("canvas"),p=u.getContext("2d"),u.width=m.trgWidth,u.height=m.trgHeight,r>4&&(u.width=m.trgHeight,u.height=m.trgWidth),r){case 2:p.translate(u.width,0),p.scale(-1,1);break;case 3:p.translate(u.width,u.height),p.rotate(Math.PI);break;case 4:p.translate(0,u.height),p.scale(1,-1);break;case 5:p.rotate(.5*Math.PI),p.scale(1,-1);break;case 6:p.rotate(.5*Math.PI),p.translate(0,-u.height);break;case 7:p.rotate(.5*Math.PI),p.translate(u.width,-u.height),p.scale(-1,1);break;case 8:p.rotate(-.5*Math.PI),p.translate(-u.width,0)}if(l(p,a,null!=(c=m.srcX)?c:0,null!=(d=m.srcY)?d:0,m.srcWidth,m.srcHeight,null!=(h=m.trgX)?h:0,null!=(f=m.trgY)?f:0,m.trgWidth,m.trgHeight),g=u.toDataURL("image/png"),null!=o)return o(g,u)})}}(this),null!=o&&(a.onerror=o),a.src=e.dataURL},t.prototype.processQueue=function(){var e,t,i,n;if(t=this.options.parallelUploads,i=this.getUploadingFiles().length,e=i,!(i>=t)&&(n=this.getQueuedFiles(),n.length>0)){if(this.options.uploadMultiple)return this.processFiles(n.slice(0,t-i));for(;e<t;){if(!n.length)return;this.processFile(n.shift()),e++}}},t.prototype.processFile=function(e){return this.processFiles([e])},t.prototype.processFiles=function(e){var i,n,r;for(n=0,r=e.length;n<r;n++)i=e[n],i.processing=!0,i.status=t.UPLOADING,this.emit("processing",i);return this.options.uploadMultiple&&this.emit("processingmultiple",e),this.uploadFiles(e)},t.prototype._getFilesWithXhr=function(e){var t;return function(){var i,n,r,o;for(r=this.files,o=[],i=0,n=r.length;i<n;i++)t=r[i],t.xhr===e&&o.push(t);return o}.call(this)},t.prototype.cancelUpload=function(e){var i,n,r,o,s,l,a;if(e.status===t.UPLOADING){for(n=this._getFilesWithXhr(e.xhr),r=0,s=n.length;r<s;r++)i=n[r],i.status=t.CANCELED;for(e.xhr.abort(),o=0,l=n.length;o<l;o++)i=n[o],this.emit("canceled",i);this.options.uploadMultiple&&this.emit("canceledmultiple",n)}else(a=e.status)!==t.ADDED&&a!==t.QUEUED||(e.status=t.CANCELED,this.emit("canceled",e),this.options.uploadMultiple&&this.emit("canceledmultiple",[e]));if(this.options.autoProcessQueue)return this.processQueue()},o=function(){var e,t;return t=arguments[0],e=2<=arguments.length?p.call(arguments,1):[],"function"==typeof t?t.apply(this,e):t},t.prototype.uploadFile=function(e){return this.uploadFiles([e])},t.prototype.uploadFiles=function(e){var i,n,s,l,a,u,p,c,d,h,f,m,g,v,y,F,b,w,E,z,x,k,C,L,A,T,S,_,M,D,I,U,R,N,P,O,q;for(q=new XMLHttpRequest,g=0,b=e.length;g<b;g++)s=e[g],s.xhr=q;k=o(this.options.method,e),P=o(this.options.url,e),q.open(k,P,!0),q.timeout=o(this.options.timeout,e),q.withCredentials=!!this.options.withCredentials,U=null,a=function(t){return function(){var i,n,r;for(r=[],i=0,n=e.length;i<n;i++)s=e[i],r.push(t._errorProcessing(e,U||t.options.dictResponseError.replace("{{statusCode}}",q.status),q));return r}}(this),N=function(t){return function(i){var n,r,o,l,a,u,p,c,d;if(null!=i)for(c=100*i.loaded/i.total,r=0,l=e.length;r<l;r++)s=e[r],s.upload.progress=c,s.upload.total=i.total,s.upload.bytesSent=i.loaded;else{for(n=!0,c=100,o=0,a=e.length;o<a;o++)s=e[o],100===s.upload.progress&&s.upload.bytesSent===s.upload.total||(n=!1),s.upload.progress=c,s.upload.bytesSent=s.upload.total;if(n)return}for(d=[],p=0,u=e.length;p<u;p++)s=e[p],d.push(t.emit("uploadprogress",s,c,s.upload.bytesSent));return d}}(this),q.onload=function(i){return function(n){var r;if(e[0].status!==t.CANCELED&&4===q.readyState){if("arraybuffer"!==q.responseType&&"blob"!==q.responseType&&(U=q.responseText,q.getResponseHeader("content-type")&&~q.getResponseHeader("content-type").indexOf("application/json")))try{U=JSON.parse(U)}catch(e){n=e,U="Invalid JSON response from server."}return N(),200<=(r=q.status)&&r<300?i._finished(e,U,n):a()}}}(this),q.onerror=function(i){return function(){if(e[0].status!==t.CANCELED)return a()}}(),A=null!=(T=q.upload)?T:q,A.onprogress=N,c={Accept:"application/json","Cache-Control":"no-cache","X-Requested-With":"XMLHttpRequest"},this.options.headers&&r(c,this.options.headers);for(u in c)(p=c[u])&&q.setRequestHeader(u,p);if(l=new FormData,this.options.params){S=this.options.params;for(y in S)O=S[y],l.append(y,O)}for(v=0,w=e.length;v<w;v++)s=e[v],this.emit("sending",s,q,l);if(this.options.uploadMultiple&&this.emit("sendingmultiple",e,q,l),"FORM"===this.element.tagName)for(_=this.element.querySelectorAll("input, textarea, select, button"),F=0,E=_.length;F<E;F++)if(h=_[F],f=h.getAttribute("name"),m=h.getAttribute("type"),"SELECT"===h.tagName&&h.hasAttribute("multiple"))for(M=h.options,x=0,z=M.length;x<z;x++)L=M[x],L.selected&&l.append(f,L.value);else(!m||"checkbox"!==(D=m.toLowerCase())&&"radio"!==D||h.checked)&&l.append(f,h.value);for(i=0,R=[],d=C=0,I=e.length-1;0<=I?C<=I:C>=I;d=0<=I?++C:--C)n=function(t){return function(n,r,o){return function(n){if(l.append(r,n,o),++i===e.length)return t.submitRequest(q,l,e)}}}(this),R.push(this.options.transformFile.call(this,e[d],n(e[d],this._getParamName(d),e[d].upload.filename)));return R},t.prototype.submitRequest=function(e,t,i){return e.send(t)},t.prototype._finished=function(e,i,n){var r,o,s;for(o=0,s=e.length;o<s;o++)r=e[o],r.status=t.SUCCESS,this.emit("success",r,i,n),this.emit("complete",r);if(this.options.uploadMultiple&&(this.emit("successmultiple",e,i,n),this.emit("completemultiple",e)),this.options.autoProcessQueue)return this.processQueue()},t.prototype._errorProcessing=function(e,i,n){var r,o,s;for(o=0,s=e.length;o<s;o++)r=e[o],r.status=t.ERROR,this.emit("error",r,i,n),this.emit("complete",r);if(this.options.uploadMultiple&&(this.emit("errormultiple",e,i,n),this.emit("completemultiple",e)),this.options.autoProcessQueue)return this.processQueue()},t}(i),t.version="5.1.1",t.options={},t.optionsForElement=function(e){return e.getAttribute("id")?t.options[r(e.getAttribute("id"))]:void 0},t.instances=[],t.forElement=function(e){if("string"==typeof e&&(e=document.querySelector(e)),null==(null!=e?e.dropzone:void 0))throw new Error("No Dropzone found for given element. This is probably because you're trying to access it before Dropzone had the time to initialize. Use the `init` option to setup any additional observers on your Dropzone.");return e.dropzone},t.autoDiscover=!0,t.discover=function(){var e,i,n,r,o,s;for(document.querySelectorAll?n=document.querySelectorAll(".dropzone"):(n=[],e=function(e){var t,i,r,o;for(o=[],i=0,r=e.length;i<r;i++)t=e[i],/(^| )dropzone($| )/.test(t.className)?o.push(n.push(t)):o.push(void 0);return o},e(document.getElementsByTagName("div")),e(document.getElementsByTagName("form"))),s=[],r=0,o=n.length;r<o;r++)i=n[r],!1!==t.optionsForElement(i)?s.push(new t(i)):s.push(void 0);return s},t.blacklistedBrowsers=[/opera.*Macintosh.*version\/12/i],t.isBrowserSupported=function(){var e,i,n,r,o;if(e=!0,window.File&&window.FileReader&&window.FileList&&window.Blob&&window.FormData&&document.querySelector)if("classList"in document.createElement("a"))for(r=t.blacklistedBrowsers,i=0,n=r.length;i<n;i++)o=r[i],o.test(navigator.userAgent)&&(e=!1);else e=!1;else e=!1;return e},t.dataURItoBlob=function(e){var t,i,n,r,o,s,l;for(i=atob(e.split(",")[1]),s=e.split(",")[0].split(":")[1].split(";")[0],t=new ArrayBuffer(i.length),r=new Uint8Array(t),n=o=0,l=i.length;0<=l?o<=l:o>=l;n=0<=l?++o:--o)r[n]=i.charCodeAt(n);return new Blob([t],{type:s})},u=function(e,t){var i,n,r,o;for(o=[],n=0,r=e.length;n<r;n++)(i=e[n])!==t&&o.push(i);return o},r=function(e){return e.replace(/[\-_](\w)/g,function(e){return e.charAt(1).toUpperCase()})},t.createElement=function(e){var t;return t=document.createElement("div"),t.innerHTML=e,t.childNodes[0]},t.elementInside=function(e,t){if(e===t)return!0;for(;e=e.parentNode;)if(e===t)return!0;return!1},t.getElement=function(e,t){var i;if("string"==typeof e?i=document.querySelector(e):null!=e.nodeType&&(i=e),null==i)throw new Error("Invalid `"+t+"` option provided. Please provide a CSS selector or a plain HTML element.");return i},t.getElements=function(e,t){var i,n,r,o,s,l,a;if(e instanceof Array){n=[];try{for(r=0,s=e.length;r<s;r++)i=e[r],n.push(this.getElement(i,t))}catch(e){e,n=null}}else if("string"==typeof e)for(n=[],a=document.querySelectorAll(e),o=0,l=a.length;o<l;o++)i=a[o],n.push(i);else null!=e.nodeType&&(n=[e]);if(null==n||!n.length)throw new Error("Invalid `"+t+"` option provided. Please provide a CSS selector, a plain HTML element or a list of those.");return n},t.confirm=function(e,t,i){return window.confirm(e)?t():null!=i?i():void 0},t.isValidFile=function(e,t){var i,n,r,o,s;if(!t)return!0;for(t=t.split(","),o=e.type,i=o.replace(/\/.*$/,""),n=0,r=t.length;n<r;n++)if(s=t[n],s=s.trim(),"."===s.charAt(0)){if(-1!==e.name.toLowerCase().indexOf(s.toLowerCase(),e.name.length-s.length))return!0}else if(/\/\*$/.test(s)){if(i===s.replace(/\/.*$/,""))return!0}else if(o===s)return!0;return!1},"undefined"!=typeof jQuery&&null!==jQuery&&(jQuery.fn.dropzone=function(e){return this.each(function(){return new t(this,e)})}),void 0!==e&&null!==e?e.exports=t:window.Dropzone=t,t.ADDED="added",t.QUEUED="queued",t.ACCEPTED=t.QUEUED,t.UPLOADING="uploading",t.PROCESSING=t.UPLOADING,t.CANCELED="canceled",t.ERROR="error",t.SUCCESS="success",s=function(e){var t,i,n,r,o,s,l,a,u;for(e.naturalWidth,s=e.naturalHeight,i=document.createElement("canvas"),i.width=1,i.height=s,n=i.getContext("2d"),n.drawImage(e,0,0),r=n.getImageData(1,0,1,s).data,u=0,o=s,l=s;l>u;)t=r[4*(l-1)+3],0===t?o=l:u=l,l=o+u>>1;return a=l/s,0===a?1:a},l=function(e,t,i,n,r,o,l,a,u,p){var c;return c=s(t),e.drawImage(t,i,n,r,o,l,a,u,p/c)},n=function(){function e(){}return e.KEY_STR="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",e.encode64=function(e){var t,i,n,r,o,s,l,a,u;for(u="",t=void 0,i=void 0,n="",r=void 0,o=void 0,s=void 0,l="",a=0;;)if(t=e[a++],i=e[a++],n=e[a++],r=t>>2,o=(3&t)<<4|i>>4,s=(15&i)<<2|n>>6,l=63&n,isNaN(i)?s=l=64:isNaN(n)&&(l=64),u=u+this.KEY_STR.charAt(r)+this.KEY_STR.charAt(o)+this.KEY_STR.charAt(s)+this.KEY_STR.charAt(l),t=i=n="",r=o=s=l="",!(a<e.length))break;return u},e.restore=function(e,t){var i,n,r;return e.match("data:image/jpeg;base64,")?(n=this.decode64(e.replace("data:image/jpeg;base64,","")),r=this.slice2Segments(n),i=this.exifManipulation(t,r),"data:image/jpeg;base64,"+this.encode64(i)):t},e.exifManipulation=function(e,t){var i,n;return i=this.getExifArray(t),n=this.insertExif(e,i),new Uint8Array(n)},e.getExifArray=function(e){var t,i;for(t=void 0,i=0;i<e.length;){if(t=e[i],255===t[0]&225===t[1])return t;i++}return[]},e.insertExif=function(e,t){var i,n,r,o,s,l;return o=e.replace("data:image/jpeg;base64,",""),r=this.decode64(o),l=r.indexOf(255,3),s=r.slice(0,l),n=r.slice(l),i=s,i=i.concat(t),i=i.concat(n)},e.slice2Segments=function(e){var t,i,n,r,o;for(i=0,o=[];;){if(255===e[i]&218===e[i+1])break;if(255===e[i]&216===e[i+1]?i+=2:(n=256*e[i+2]+e[i+3],t=i+n+2,r=e.slice(i,t),o.push(r),i=t),i>e.length)break}return o},e.decode64=function(e){var t,i,n,r,o,s,l,a,u,p;for("",n=void 0,r=void 0,o="",s=void 0,l=void 0,a=void 0,u="",p=0,i=[],t=/[^A-Za-z0-9\+\/\=]/g,t.exec(e)&&console.warning("There were invalid base64 characters in the input text.\nValid base64 characters are A-Z, a-z, 0-9, '+', '/',and '='\nExpect errors in decoding."),e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");;)if(s=this.KEY_STR.indexOf(e.charAt(p++)),l=this.KEY_STR.indexOf(e.charAt(p++)),a=this.KEY_STR.indexOf(e.charAt(p++)),u=this.KEY_STR.indexOf(e.charAt(p++)),n=s<<2|l>>4,r=(15&l)<<4|a>>2,o=(3&a)<<6|u,i.push(n),64!==a&&i.push(r),64!==u&&i.push(o),n=r=o="",s=l=a=u="",!(p<e.length))break;return i},e}(),o=function(e,t){var i,n,r,o,s,l,a,u,p;if(r=!1,p=!0,n=e.document,u=n.documentElement,i=n.addEventListener?"addEventListener":"attachEvent",a=n.addEventListener?"removeEventListener":"detachEvent",l=n.addEventListener?"":"on",o=function(i){if("readystatechange"!==i.type||"complete"===n.readyState)return("load"===i.type?e:n)[a](l+i.type,o,!1),!r&&(r=!0)?t.call(e,i.type||i):void 0},s=function(){try{u.doScroll("left")}catch(e){return e,void setTimeout(s,50)}return o("poll")},"complete"!==n.readyState){if(n.createEventObject&&u.doScroll){try{p=!e.frameElement}catch(e){}p&&s()}return n[i](l+"DOMContentLoaded",o,!1),n[i](l+"readystatechange",o,!1),e[i](l+"load",o,!1)}},t._autoDiscoverFunction=function(){if(t.autoDiscover)return t.discover()},o(window,t._autoDiscoverFunction)}).call(this)}).call(t,i(6)(e))},function(e,t,i){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=i(1);i.n(n);t.default={name:"Dropzone",props:{url:{type:String,default:""},height:{type:String,default:"200px"}},data:function(){return{dropzone:null}},mounted:function(){}}},function(e,t){},function(e,t){e.exports=function(e,t,i,n){var r,o=e=e||{},s=typeof e.default;"object"!==s&&"function"!==s||(r=e,o=e.default);var l="function"==typeof o?o.options:o;if(t&&(l.render=t.render,l.staticRenderFns=t.staticRenderFns),i&&(l._scopeId=i),n){var a=l.computed||(l.computed={});Object.keys(n).forEach(function(e){var t=n[e];a[e]=function(){return t}})}return{esModule:r,exports:o,options:l}}},function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",[i("v-card",{attrs:{id:"upload-dropzone",flat:"",height:e.height}},[e._v("\n    loasdl\n    ")])],1)},staticRenderFns:[]}},function(e,t){e.exports=function(e){return e.webpackPolyfill||(e.deprecate=function(){},e.paths=[],e.children||(e.children=[]),Object.defineProperty(e,"loaded",{enumerable:!0,get:function(){return e.l}}),Object.defineProperty(e,"id",{enumerable:!0,get:function(){return e.i}}),e.webpackPolyfill=1),e}},function(e,t,i){e.exports=i(0)}])});
//# sourceMappingURL=dropzone.js.map