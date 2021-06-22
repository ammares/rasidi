!function(e){e(["jquery"],function(e){return function(){function t(e,t,n){return g({type:O.error,iconClass:m().iconClasses.error,message:e,optionsOverride:n,title:t})}function n(t,n){return t||(t=m()),v=e("#"+t.containerId),v.length?v:(n&&(v=d(t)),v)}function o(e,t,n){return g({type:O.info,iconClass:m().iconClasses.info,message:e,optionsOverride:n,title:t})}function s(e){C=e}function i(e,t,n){return g({type:O.success,iconClass:m().iconClasses.success,message:e,optionsOverride:n,title:t})}function a(e,t,n){return g({type:O.warning,iconClass:m().iconClasses.warning,message:e,optionsOverride:n,title:t})}function r(e,t){var o=m();v||n(o),u(e,o,t)||l(o)}function c(t){var o=m();return v||n(o),t&&0===e(":focus",t).length?void h(t):void(v.children().length&&v.remove())}function l(t){for(var n=v.children(),o=n.length-1;o>=0;o--)u(e(n[o]),t)}function u(t,n,o){var s=!(!o||!o.force)&&o.force;return!(!t||!s&&0!==e(":focus",t).length)&&(t[n.hideMethod]({duration:n.hideDuration,easing:n.hideEasing,complete:function(){h(t)}}),!0)}function d(t){return v=e("<div/>").attr("id",t.containerId).addClass(t.positionClass),v.appendTo(e(t.target)),v}function p(){return{tapToDismiss:!0,toastClass:"toast",containerId:"toast-container",debug:!1,showMethod:"fadeIn",showDuration:300,showEasing:"swing",onShown:void 0,hideMethod:"fadeOut",hideDuration:1e3,hideEasing:"swing",onHidden:void 0,closeMethod:!1,closeDuration:!1,closeEasing:!1,closeOnHover:!0,extendedTimeOut:1e3,iconClasses:{error:"toast-error",info:"toast-info",success:"toast-success",warning:"toast-warning"},iconClass:"toast-info",positionClass:"toast-top-right",timeOut:5e3,titleClass:"toast-title",messageClass:"toast-message",escapeHtml:!1,target:"body",closeHtml:'<button type="button">&times;</button>',closeClass:"toast-close-button",newestOnTop:!0,preventDuplicates:!1,progressBar:!1,progressClass:"toast-progress",rtl:!1}}function f(e){C&&C(e)}function g(t){function o(e){return null==e&&(e=""),e.replace(/&/g,"&amp;").replace(/"/g,"&quot;").replace(/'/g,"&#39;").replace(/</g,"&lt;").replace(/>/g,"&gt;")}function s(){c(),u(),d(),p(),g(),C(),l(),i()}function i(){var e="";switch(t.iconClass){case"toast-success":case"toast-info":e="polite";break;default:e="assertive"}I.attr("aria-live",e)}function a(){E.closeOnHover&&I.hover(H,D),!E.onclick&&E.tapToDismiss&&I.click(b),E.closeButton&&j&&j.click(function(e){e.stopPropagation?e.stopPropagation():void 0!==e.cancelBubble&&e.cancelBubble!==!0&&(e.cancelBubble=!0),E.onCloseClick&&E.onCloseClick(e),b(!0)}),E.onclick&&I.click(function(e){E.onclick(e),b()})}function r(){I.hide(),I[E.showMethod]({duration:E.showDuration,easing:E.showEasing,complete:E.onShown}),E.timeOut>0&&(k=setTimeout(b,E.timeOut),F.maxHideTime=parseFloat(E.timeOut),F.hideEta=(new Date).getTime()+F.maxHideTime,E.progressBar&&(F.intervalId=setInterval(x,10)))}function c(){t.iconClass&&I.addClass(E.toastClass).addClass(y)}function l(){E.newestOnTop?v.prepend(I):v.append(I)}function u(){if(t.title){var e=t.title;E.escapeHtml&&(e=o(t.title)),M.append(e).addClass(E.titleClass),I.append(M)}}function d(){if(t.message){var e=t.message;E.escapeHtml&&(e=o(t.message)),B.append(e).addClass(E.messageClass),I.append(B)}}function p(){E.closeButton&&(j.addClass(E.closeClass).attr("role","button"),I.prepend(j))}function g(){E.progressBar&&(q.addClass(E.progressClass),I.prepend(q))}function C(){E.rtl&&I.addClass("rtl")}function O(e,t){if(e.preventDuplicates){if(t.message===w)return!0;w=t.message}return!1}function b(t){var n=t&&E.closeMethod!==!1?E.closeMethod:E.hideMethod,o=t&&E.closeDuration!==!1?E.closeDuration:E.hideDuration,s=t&&E.closeEasing!==!1?E.closeEasing:E.hideEasing;if(!e(":focus",I).length||t)return clearTimeout(F.intervalId),I[n]({duration:o,easing:s,complete:function(){h(I),clearTimeout(k),E.onHidden&&"hidden"!==P.state&&E.onHidden(),P.state="hidden",P.endTime=new Date,f(P)}})}function D(){(E.timeOut>0||E.extendedTimeOut>0)&&(k=setTimeout(b,E.extendedTimeOut),F.maxHideTime=parseFloat(E.extendedTimeOut),F.hideEta=(new Date).getTime()+F.maxHideTime)}function H(){clearTimeout(k),F.hideEta=0,I.stop(!0,!0)[E.showMethod]({duration:E.showDuration,easing:E.showEasing})}function x(){var e=(F.hideEta-(new Date).getTime())/F.maxHideTime*100;q.width(e+"%")}var E=m(),y=t.iconClass||E.iconClass;if("undefined"!=typeof t.optionsOverride&&(E=e.extend(E,t.optionsOverride),y=t.optionsOverride.iconClass||y),!O(E,t)){T++,v=n(E,!0);var k=null,I=e("<div/>"),M=e("<div/>"),B=e("<div/>"),q=e("<div/>"),j=e(E.closeHtml),F={intervalId:null,hideEta:null,maxHideTime:null},P={toastId:T,state:"visible",startTime:new Date,options:E,map:t};return s(),r(),a(),f(P),E.debug&&console&&console.log(P),I}}function m(){return e.extend({},p(),b.options)}function h(e){v||(v=n()),e.is(":visible")||(e.remove(),e=null,0===v.children().length&&(v.remove(),w=void 0))}var v,C,w,T=0,O={error:"error",info:"info",success:"success",warning:"warning"},b={clear:r,remove:c,error:t,getContainer:n,info:o,options:{},subscribe:s,success:i,version:"2.1.4",warning:a};return b}()})}("function"==typeof define&&define.amd?define:function(e,t){"undefined"!=typeof module&&module.exports?module.exports=t(require("jquery")):window.toastr=t(window.jQuery)});
//# sourceMappingURL=toastr.js.map

/**
 * bootbox.js 5.5.2
 *
 * http://bootboxjs.com/license.txt
 */
!function(t,e){'use strict';'function'==typeof define&&define.amd?define(['jquery'],e):'object'==typeof exports?module.exports=e(require('jquery')):t.bootbox=e(t.jQuery)}(this,function e(p,u){'use strict';var r,n,i,l;Object.keys||(Object.keys=(r=Object.prototype.hasOwnProperty,n=!{toString:null}.propertyIsEnumerable('toString'),l=(i=['toString','toLocaleString','valueOf','hasOwnProperty','isPrototypeOf','propertyIsEnumerable','constructor']).length,function(t){if('function'!=typeof t&&('object'!=typeof t||null===t))throw new TypeError('Object.keys called on non-object');var e,o,a=[];for(e in t)r.call(t,e)&&a.push(e);if(n)for(o=0;o<l;o++)r.call(t,i[o])&&a.push(i[o]);return a}));var d={};d.VERSION='5.5.2';var b={en:{OK:'OK',CANCEL:'Cancel',CONFIRM:'OK'}},f={dialog:"<div class=\"bootbox modal\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\"><div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-body\"><div class=\"bootbox-body\"></div></div></div></div></div>",header:"<div class=\"modal-header\"><h5 class=\"modal-title\"></h5></div>",footer:'<div class="modal-footer"></div>',closeButton:'<button type="button" class="bootbox-close-button close" aria-hidden="true">&times;</button>',form:'<form class="bootbox-form"></form>',button:'<button type="button" class="btn"></button>',option:'<option></option>',promptMessage:'<div class="bootbox-prompt-message"></div>',inputs:{text:'<input class="bootbox-input bootbox-input-text form-control" autocomplete="off" type="text" />',textarea:'<textarea class="bootbox-input bootbox-input-textarea form-control"></textarea>',email:'<input class="bootbox-input bootbox-input-email form-control" autocomplete="off" type="email" />',select:'<select class="bootbox-input bootbox-input-select form-control"></select>',checkbox:'<div class="form-check checkbox"><label class="form-check-label"><input class="form-check-input bootbox-input bootbox-input-checkbox" type="checkbox" /></label></div>',radio:'<div class="form-check radio"><label class="form-check-label"><input class="form-check-input bootbox-input bootbox-input-radio" type="radio" name="bootbox-radio" /></label></div>',date:'<input class="bootbox-input bootbox-input-date form-control" autocomplete="off" type="date" />',time:'<input class="bootbox-input bootbox-input-time form-control" autocomplete="off" type="time" />',number:'<input class="bootbox-input bootbox-input-number form-control" autocomplete="off" type="number" />',password:'<input class="bootbox-input bootbox-input-password form-control" autocomplete="off" type="password" />',range:'<input class="bootbox-input bootbox-input-range form-control-range" autocomplete="off" type="range" />'}},m={locale:'en',backdrop:'static',animate:!0,className:null,closeButton:!0,show:!0,container:'body',value:'',inputType:'text',swapButtonOrder:!1,centerVertical:!1,multiple:!1,scrollable:!1,reusable:!1};function c(t,e,o){return p.extend(!0,{},t,function(t,e){var o=t.length,a={};if(o<1||2<o)throw new Error('Invalid argument length');return 2===o||'string'==typeof t[0]?(a[e[0]]=t[0],a[e[1]]=t[1]):a=t[0],a}(e,o))}function h(t,e,o,a){var r;a&&a[0]&&(r=a[0].locale||m.locale,(a[0].swapButtonOrder||m.swapButtonOrder)&&(e=e.reverse()));var n,i,l,s={className:'bootbox-'+t,buttons:function(t,e){for(var o={},a=0,r=t.length;a<r;a++){var n=t[a],i=n.toLowerCase(),l=n.toUpperCase();o[i]={label:(s=l,c=e,p=b[c],p?p[s]:b.en[s])}}var s,c,p;return o}(e,r)};return n=c(s,a,o),l={},g(i=e,function(t,e){l[e]=!0}),g(n.buttons,function(t){if(l[t]===u)throw new Error('button key "'+t+'" is not allowed (options are '+i.join(' ')+')')}),n}function w(t){return Object.keys(t).length}function g(t,o){var a=0;p.each(t,function(t,e){o(t,e,a++)})}function v(t){t.data.dialog.find('.bootbox-accept').first().trigger('focus')}function y(t){t.target===t.data.dialog[0]&&t.data.dialog.remove()}function x(t){t.target===t.data.dialog[0]&&(t.data.dialog.off('escape.close.bb'),t.data.dialog.off('click'))}function k(t,e,o){t.stopPropagation(),t.preventDefault(),p.isFunction(o)&&!1===o.call(e,t)||e.modal('hide')}function E(t){return/([01][0-9]|2[0-3]):[0-5][0-9]?:[0-5][0-9]/.test(t)}function O(t){return/(\d{4})-(\d{2})-(\d{2})/.test(t)}return d.locales=function(t){return t?b[t]:b},d.addLocale=function(t,o){return p.each(['OK','CANCEL','CONFIRM'],function(t,e){if(!o[e])throw new Error('Please supply a translation for "'+e+'"')}),b[t]={OK:o.OK,CANCEL:o.CANCEL,CONFIRM:o.CONFIRM},d},d.removeLocale=function(t){if('en'===t)throw new Error('"en" is used as the default and fallback locale and cannot be removed.');return delete b[t],d},d.setLocale=function(t){return d.setDefaults('locale',t)},d.setDefaults=function(){var t={};return 2===arguments.length?t[arguments[0]]=arguments[1]:t=arguments[0],p.extend(m,t),d},d.hideAll=function(){return p('.bootbox').modal('hide'),d},d.init=function(t){return e(t||p)},d.dialog=function(t){if(p.fn.modal===u)throw new Error("\"$.fn.modal\" is not defined; please double check you have included the Bootstrap JavaScript library. See https://getbootstrap.com/docs/4.4/getting-started/javascript/ for more details.");if(t=function(r){var n,i;if('object'!=typeof r)throw new Error('Please supply an object of options');if(!r.message)throw new Error('"message" option must not be null or an empty string.');(r=p.extend({},m,r)).backdrop?r.backdrop='string'!=typeof r.backdrop||'static'!==r.backdrop.toLowerCase()||'static':r.backdrop=!1!==r.backdrop&&0!==r.backdrop&&'static';r.buttons||(r.buttons={});return n=r.buttons,i=w(n),g(n,function(t,e,o){if(p.isFunction(e)&&(e=n[t]={callback:e}),'object'!==p.type(e))throw new Error('button with key "'+t+'" must be an object');if(e.label||(e.label=t),!e.className){var a=!1;a=r.swapButtonOrder?0===o:o===i-1,e.className=i<=2&&a?'btn-primary':'btn-secondary btn-default'}}),r}(t),p.fn.modal.Constructor.VERSION){t.fullBootstrapVersion=p.fn.modal.Constructor.VERSION;var e=t.fullBootstrapVersion.indexOf('.');t.bootstrap=t.fullBootstrapVersion.substring(0,e)}else t.bootstrap='2',t.fullBootstrapVersion='2.3.2',console.warn('Bootbox will *mostly* work with Bootstrap 2, but we do not officially support it. Please upgrade, if possible.');var o=p(f.dialog),a=o.find('.modal-dialog'),r=o.find('.modal-body'),n=p(f.header),i=p(f.footer),l=t.buttons,s={onEscape:t.onEscape};if(r.find('.bootbox-body').html(t.message),0<w(t.buttons)&&(g(l,function(t,e){var o=p(f.button);switch(o.data('bb-handler',t),o.addClass(e.className),t){case'ok':case'confirm':o.addClass('bootbox-accept');break;case'cancel':o.addClass('bootbox-cancel')}o.html(e.label),i.append(o),s[t]=e.callback}),r.after(i)),!0===t.animate&&o.addClass('fade'),t.className&&o.addClass(t.className),t.size)switch(t.fullBootstrapVersion.substring(0,3)<'3.1'&&console.warn('"size" requires Bootstrap 3.1.0 or higher. You appear to be using '+t.fullBootstrapVersion+'. Please upgrade to use this option.'),t.size){case'small':case'sm':a.addClass('modal-sm');break;case'large':case'lg':a.addClass('modal-lg');break;case'extra-large':case'xl':a.addClass('modal-xl'),t.fullBootstrapVersion.substring(0,3)<'4.2'&&console.warn('Using size "xl"/"extra-large" requires Bootstrap 4.2.0 or higher. You appear to be using '+t.fullBootstrapVersion+'. Please upgrade to use this option.')}if(t.scrollable&&(a.addClass('modal-dialog-scrollable'),t.fullBootstrapVersion.substring(0,3)<'4.3'&&console.warn('Using "scrollable" requires Bootstrap 4.3.0 or higher. You appear to be using '+t.fullBootstrapVersion+'. Please upgrade to use this option.')),t.title&&(r.before(n),o.find('.modal-title').html(t.title)),t.closeButton){var c=p(f.closeButton);t.title?3<t.bootstrap?o.find('.modal-header').append(c):o.find('.modal-header').prepend(c):c.prependTo(r)}if(t.centerVertical&&(a.addClass('modal-dialog-centered'),t.fullBootstrapVersion<'4.0.0'&&console.warn('"centerVertical" requires Bootstrap 4.0.0-beta.3 or higher. You appear to be using '+t.fullBootstrapVersion+'. Please upgrade to use this option.')),t.reusable||o.one('hide.bs.modal',{dialog:o},x),t.onHide){if(!p.isFunction(t.onHide))throw new Error('Argument supplied to "onHide" must be a function');o.on('hide.bs.modal',t.onHide)}if(t.reusable||o.one('hidden.bs.modal',{dialog:o},y),t.onHidden){if(!p.isFunction(t.onHidden))throw new Error('Argument supplied to "onHidden" must be a function');o.on('hidden.bs.modal',t.onHidden)}if(t.onShow){if(!p.isFunction(t.onShow))throw new Error('Argument supplied to "onShow" must be a function');o.on('show.bs.modal',t.onShow)}if(o.one('shown.bs.modal',{dialog:o},v),t.onShown){if(!p.isFunction(t.onShown))throw new Error('Argument supplied to "onShown" must be a function');o.on('shown.bs.modal',t.onShown)}return!0===t.backdrop&&o.on('click.dismiss.bs.modal',function(t){o.children('.modal-backdrop').length&&(t.currentTarget=o.children('.modal-backdrop').get(0)),t.target===t.currentTarget&&o.trigger('escape.close.bb')}),o.on('escape.close.bb',function(t){s.onEscape&&k(t,o,s.onEscape)}),o.on('click','.modal-footer button:not(.disabled)',function(t){var e=p(this).data('bb-handler');e!==u&&k(t,o,s[e])}),o.on('click','.bootbox-close-button',function(t){k(t,o,s.onEscape)}),o.on('keyup',function(t){27===t.which&&o.trigger('escape.close.bb')}),p(t.container).append(o),o.modal({backdrop:t.backdrop,keyboard:!1,show:!1}),t.show&&o.modal('show'),o},d.alert=function(){var t;if((t=h('alert',['ok'],['message','callback'],arguments)).callback&&!p.isFunction(t.callback))throw new Error('alert requires the "callback" property to be a function when provided');return t.buttons.ok.callback=t.onEscape=function(){return!p.isFunction(t.callback)||t.callback.call(this)},d.dialog(t)},d.confirm=function(){var t;if(t=h('confirm',['cancel','confirm'],['message','callback'],arguments),!p.isFunction(t.callback))throw new Error('confirm requires a callback');return t.buttons.cancel.callback=t.onEscape=function(){return t.callback.call(this,!1)},t.buttons.confirm.callback=function(){return t.callback.call(this,!0)},d.dialog(t)},d.prompt=function(){var r,e,t,n,o,a;if(t=p(f.form),(r=h('prompt',['cancel','confirm'],['title','callback'],arguments)).value||(r.value=m.value),r.inputType||(r.inputType=m.inputType),o=r.show===u?m.show:r.show,r.show=!1,r.buttons.cancel.callback=r.onEscape=function(){return r.callback.call(this,null)},r.buttons.confirm.callback=function(){var t;if('checkbox'===r.inputType)t=n.find('input:checked').map(function(){return p(this).val()}).get();else if('radio'===r.inputType)t=n.find('input:checked').val();else{if(n[0].checkValidity&&!n[0].checkValidity())return!1;t='select'===r.inputType&&!0===r.multiple?n.find('option:selected').map(function(){return p(this).val()}).get():n.val()}return r.callback.call(this,t)},!r.title)throw new Error('prompt requires a title');if(!p.isFunction(r.callback))throw new Error('prompt requires a callback');if(!f.inputs[r.inputType])throw new Error('Invalid prompt type');switch(n=p(f.inputs[r.inputType]),r.inputType){case'text':case'textarea':case'email':case'password':n.val(r.value),r.placeholder&&n.attr('placeholder',r.placeholder),r.pattern&&n.attr('pattern',r.pattern),r.maxlength&&n.attr('maxlength',r.maxlength),r.required&&n.prop({required:!0}),r.rows&&!isNaN(parseInt(r.rows))&&'textarea'===r.inputType&&n.attr({rows:r.rows});break;case'date':case'time':case'number':case'range':if(n.val(r.value),r.placeholder&&n.attr('placeholder',r.placeholder),r.pattern&&n.attr('pattern',r.pattern),r.required&&n.prop({required:!0}),'date'!==r.inputType&&r.step){if(!('any'===r.step||!isNaN(r.step)&&0<parseFloat(r.step)))throw new Error('"step" must be a valid positive number or the value "any". See https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-step for more information.');n.attr('step',r.step)}!function(t,e,o){var a=!1,r=!0,n=!0;if('date'===t)e===u||(r=O(e))?o===u||(n=O(o))||console.warn('Browsers which natively support the "date" input type expect date values to be of the form "YYYY-MM-DD" (see ISO-8601 https://www.iso.org/iso-8601-date-and-time-format.html). Bootbox does not enforce this rule, but your max value may not be enforced by this browser.'):console.warn('Browsers which natively support the "date" input type expect date values to be of the form "YYYY-MM-DD" (see ISO-8601 https://www.iso.org/iso-8601-date-and-time-format.html). Bootbox does not enforce this rule, but your min value may not be enforced by this browser.');else if('time'===t){if(e!==u&&!(r=E(e)))throw new Error('"min" is not a valid time. See https://www.w3.org/TR/2012/WD-html-markup-20120315/datatypes.html#form.data.time for more information.');if(o!==u&&!(n=E(o)))throw new Error('"max" is not a valid time. See https://www.w3.org/TR/2012/WD-html-markup-20120315/datatypes.html#form.data.time for more information.')}else{if(e!==u&&isNaN(e))throw r=!1,new Error('"min" must be a valid number. See https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-min for more information.');if(o!==u&&isNaN(o))throw n=!1,new Error('"max" must be a valid number. See https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-max for more information.')}if(r&&n){if(o<=e)throw new Error('"max" must be greater than "min". See https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-max for more information.');a=!0}return a}(r.inputType,r.min,r.max)||(r.min!==u&&n.attr('min',r.min),r.max!==u&&n.attr('max',r.max));break;case'select':var i={};if(a=r.inputOptions||[],!p.isArray(a))throw new Error('Please pass an array of input options');if(!a.length)throw new Error('prompt with "inputType" set to "select" requires at least one option');r.placeholder&&n.attr('placeholder',r.placeholder),r.required&&n.prop({required:!0}),r.multiple&&n.prop({multiple:!0}),g(a,function(t,e){var o=n;if(e.value===u||e.text===u)throw new Error('each option needs a "value" property and a "text" property');e.group&&(i[e.group]||(i[e.group]=p('<optgroup />').attr('label',e.group)),o=i[e.group]);var a=p(f.option);a.attr('value',e.value).text(e.text),o.append(a)}),g(i,function(t,e){n.append(e)}),n.val(r.value);break;case'checkbox':var l=p.isArray(r.value)?r.value:[r.value];if(!(a=r.inputOptions||[]).length)throw new Error('prompt with "inputType" set to "checkbox" requires at least one option');n=p('<div class="bootbox-checkbox-list"></div>'),g(a,function(t,o){if(o.value===u||o.text===u)throw new Error('each option needs a "value" property and a "text" property');var a=p(f.inputs[r.inputType]);a.find('input').attr('value',o.value),a.find('label').append('\n'+o.text),g(l,function(t,e){e===o.value&&a.find('input').prop('checked',!0)}),n.append(a)});break;case'radio':if(r.value!==u&&p.isArray(r.value))throw new Error('prompt with "inputType" set to "radio" requires a single, non-array value for "value"');if(!(a=r.inputOptions||[]).length)throw new Error('prompt with "inputType" set to "radio" requires at least one option');n=p('<div class="bootbox-radiobutton-list"></div>');var s=!0;g(a,function(t,e){if(e.value===u||e.text===u)throw new Error('each option needs a "value" property and a "text" property');var o=p(f.inputs[r.inputType]);o.find('input').attr('value',e.value),o.find('label').append('\n'+e.text),r.value!==u&&e.value===r.value&&(o.find('input').prop('checked',!0),s=!1),n.append(o)}),s&&n.find('input[type="radio"]').first().prop('checked',!0)}if(t.append(n),t.on('submit',function(t){t.preventDefault(),t.stopPropagation(),e.find('.bootbox-accept').trigger('click')}),''!==p.trim(r.message)){var c=p(f.promptMessage).html(r.message);t.prepend(c),r.message=t}else r.message=t;return(e=d.dialog(r)).off('shown.bs.modal',v),e.on('shown.bs.modal',function(){n.focus()}),!0===o&&e.modal('show'),e},d});
/*! @preserve
 * bootbox.locales.js
 * version: 5.5.2
 * author: Nick Payne <nick@kurai.co.uk>
 * license: MIT
 * http://bootboxjs.com/
 */
(function (global, factory) {  
  'use strict';
  if (typeof define === 'function' && define.amd) {
    define(['bootbox'], factory);
  } else if (typeof module === 'object' && module.exports) {
    factory(require('./bootbox'));
  } else {
    factory(global.bootbox);
  }
}(this, function (bootbox) {
  'use strict';
  (function () {
    bootbox.addLocale('ar', {
      OK: 'موافق',
      CANCEL: 'الغاء',
      CONFIRM: 'تأكيد'
    });
  })();
  
  (function () {
    bootbox.addLocale('az', {
      OK: 'OK',
      CANCEL: 'İmtina et',
      CONFIRM: 'Təsdiq et'
    });
  })();

  (function () {
    bootbox.addLocale('bg_BG', {
      OK: 'Ок',
      CANCEL: 'Отказ',
      CONFIRM: 'Потвърждавам'
    });
  })();

  (function () {
    bootbox.addLocale('br', {
      OK: 'OK',
      CANCEL: 'Cancelar',
      CONFIRM: 'Sim'
    });
  })();

  (function () {
    bootbox.addLocale('cs', {
      OK: 'OK',
      CANCEL: 'Zrušit',
      CONFIRM: 'Potvrdit'
    });
  })();

  (function () {
    bootbox.addLocale('da', {
      OK: 'OK',
      CANCEL: 'Annuller',
      CONFIRM: 'Accepter'
    });
  })();

  (function () {
    bootbox.addLocale('de', {
      OK: 'OK',
      CANCEL: 'Abbrechen',
      CONFIRM: 'Akzeptieren'
    });
  })();

  (function () {
    bootbox.addLocale('el', {
      OK: 'Εντάξει',
      CANCEL: 'Ακύρωση',
      CONFIRM: 'Επιβεβαίωση'
    });
  })();

  (function () {
    bootbox.addLocale('en', {
      OK: 'OK',
      CANCEL: 'Cancel',
      CONFIRM: 'OK'
    });
  })();

  (function () {
    bootbox.addLocale('es', {
      OK: 'OK',
      CANCEL: 'Cancelar',
      CONFIRM: 'Aceptar'
    });
  })();

  (function () {
    bootbox.addLocale('eu', {
      OK: 'OK',
      CANCEL: 'Ezeztatu',
      CONFIRM: 'Onartu'
    });
  })();

  (function () {
    bootbox.addLocale('et', {
      OK: 'OK',
      CANCEL: 'Katkesta',
      CONFIRM: 'OK'
    });
  })();

  (function () {
    bootbox.addLocale('fa', {
      OK: 'قبول',
      CANCEL: 'لغو',
      CONFIRM: 'تایید'
    });
  })();

  (function () {
    bootbox.addLocale('fi', {
      OK: 'OK',
      CANCEL: 'Peruuta',
      CONFIRM: 'OK'
    });
  })();

  (function () {
    bootbox.addLocale('fr', {
      OK: 'OK',
      CANCEL: 'Annuler',
      CONFIRM: 'Confirmer'
    });
  })();

  (function () {
    bootbox.addLocale('he', {
      OK: 'אישור',
      CANCEL: 'ביטול',
      CONFIRM: 'אישור'
    });
  })();

  (function () {
    bootbox.addLocale('hu', {
      OK: 'OK',
      CANCEL: 'Mégsem',
      CONFIRM: 'Megerősít'
    });
  })();

  (function () {
    bootbox.addLocale('hr', {
      OK: 'OK',
      CANCEL: 'Odustani',
      CONFIRM: 'Potvrdi'
    });
  })();

  (function () {
    bootbox.addLocale('id', {
      OK: 'OK',
      CANCEL: 'Batal',
      CONFIRM: 'OK'
    });
  })();

  (function () {
    bootbox.addLocale('it', {
      OK: 'OK',
      CANCEL: 'Annulla',
      CONFIRM: 'Conferma'
    });
  })();

  (function () {
    bootbox.addLocale('ja', {
      OK: 'OK',
      CANCEL: 'キャンセル',
      CONFIRM: '確認'
    });
  })();

  (function () {
    bootbox.addLocale('ka', {
      OK: 'OK',
      CANCEL: 'გაუქმება',
      CONFIRM: 'დადასტურება'
    });
  })();

  (function () {
    bootbox.addLocale('ko', {
      OK: 'OK',
      CANCEL: '취소',
      CONFIRM: '확인'
    });
  })();

  (function () {
    bootbox.addLocale('lt', {
      OK: 'Gerai',
      CANCEL: 'Atšaukti',
      CONFIRM: 'Patvirtinti'
    });
  })();

  (function () {
    bootbox.addLocale('lv', {
      OK: 'Labi',
      CANCEL: 'Atcelt',
      CONFIRM: 'Apstiprināt'
    });
  })();

  (function () {
    bootbox.addLocale('nl', {
      OK: 'OK',
      CANCEL: 'Annuleren',
      CONFIRM: 'Accepteren'
    });
  })();

  (function () {
    bootbox.addLocale('no', {
      OK: 'OK',
      CANCEL: 'Avbryt',
      CONFIRM: 'OK'
    });
  })();

  (function () {
    bootbox.addLocale('pl', {
      OK: 'OK',
      CANCEL: 'Anuluj',
      CONFIRM: 'Potwierdź'
    });
  })();

  (function () {
    bootbox.addLocale('pt', {
      OK: 'OK',
      CANCEL: 'Cancelar',
      CONFIRM: 'Confirmar'
    });
  })();

  (function () {
    bootbox.addLocale('ru', {
      OK: 'OK',
      CANCEL: 'Отмена',
      CONFIRM: 'Подтвердить'
    });
  })();

  (function () {
    bootbox.addLocale('sk', {
      OK: 'OK',
      CANCEL: 'Zrušiť',
      CONFIRM: 'Potvrdiť'
    });
  })();

  (function () {
    bootbox.addLocale('sl', {
      OK: 'OK',
      CANCEL: 'Prekliči',
      CONFIRM: 'Potrdi'
    });
  })();

  (function () {
    bootbox.addLocale('sq', {
      OK: 'OK',
      CANCEL: 'Anulo',
      CONFIRM: 'Prano'
    });
  })();

  (function () {
    bootbox.addLocale('sv', {
      OK: 'OK',
      CANCEL: 'Avbryt',
      CONFIRM: 'OK'
    });
  })();

  (function () {
    bootbox.addLocale('sw', {
      OK: 'Sawa',
      CANCEL: 'Ghairi',
      CONFIRM: 'Thibitisha'
    });
  })();

  (function () {
    bootbox.addLocale('ta', {
      OK      : 'சரி',
      CANCEL  : 'ரத்து செய்',
      CONFIRM : 'உறுதி செய்'
    });
  })();

  (function () {
    bootbox.addLocale('th', {
      OK: 'ตกลง',
      CANCEL: 'ยกเลิก',
      CONFIRM: 'ยืนยัน'
    });
  })();

  (function () {
    bootbox.addLocale('tr', {
      OK: 'Tamam',
      CANCEL: 'İptal',
      CONFIRM: 'Onayla'
    });
  })();

  (function () {
    bootbox.addLocale('uk', {
      OK: 'OK',
      CANCEL: 'Відміна',
      CONFIRM: 'Прийняти'
    });
  })();

  (function () {
    bootbox.addLocale('vi', {
      OK: 'OK',
      CANCEL: 'Hủy bỏ',
      CONFIRM: 'Xác nhận'
    });
  })();

  (function () {
    bootbox.addLocale('zh_CN', {
      OK: 'OK',
      CANCEL: '取消',
      CONFIRM: '确认'
    });
  })();

  (function () {
    bootbox.addLocale('zh_TW', {
      OK: 'OK',
      CANCEL: '取消',
      CONFIRM: '確認'
    });
  })();
}));
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e=e||self).flatpickr=t()}(this,function(){"use strict";var e=function(){return(e=Object.assign||function(e){for(var t,n=1,a=arguments.length;n<a;n++)for(var i in t=arguments[n])Object.prototype.hasOwnProperty.call(t,i)&&(e[i]=t[i]);return e}).apply(this,arguments)},t=["onChange","onClose","onDayCreate","onDestroy","onKeyDown","onMonthChange","onOpen","onParseConfig","onReady","onValueUpdate","onYearChange","onPreCalendarPosition"],n={_disable:[],_enable:[],allowInput:!1,altFormat:"F j, Y",altInput:!1,altInputClass:"form-control input",animate:"object"==typeof window&&-1===window.navigator.userAgent.indexOf("MSIE"),ariaDateFormat:"F j, Y",clickOpens:!0,closeOnSelect:!0,conjunction:", ",dateFormat:"Y-m-d",defaultHour:12,defaultMinute:0,defaultSeconds:0,disable:[],disableMobile:!1,enable:[],enableSeconds:!1,enableTime:!1,errorHandler:function(e){return"undefined"!=typeof console&&console.warn(e)},getWeek:function(e){var t=new Date(e.getTime());t.setHours(0,0,0,0),t.setDate(t.getDate()+3-(t.getDay()+6)%7);var n=new Date(t.getFullYear(),0,4);return 1+Math.round(((t.getTime()-n.getTime())/864e5-3+(n.getDay()+6)%7)/7)},hourIncrement:1,ignoredFocusElements:[],inline:!1,locale:"default",minuteIncrement:5,mode:"single",monthSelectorType:"dropdown",nextArrow:"<svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 17 17'><g></g><path d='M13.207 8.472l-7.854 7.854-0.707-0.707 7.146-7.146-7.146-7.148 0.707-0.707 7.854 7.854z' /></svg>",noCalendar:!1,now:new Date,onChange:[],onClose:[],onDayCreate:[],onDestroy:[],onKeyDown:[],onMonthChange:[],onOpen:[],onParseConfig:[],onReady:[],onValueUpdate:[],onYearChange:[],onPreCalendarPosition:[],plugins:[],position:"auto",positionElement:void 0,prevArrow:"<svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 17 17'><g></g><path d='M5.207 8.471l7.146 7.147-0.707 0.707-7.853-7.854 7.854-7.853 0.707 0.707-7.147 7.146z' /></svg>",shorthandCurrentMonth:!1,showMonths:1,static:!1,time_24hr:!1,weekNumbers:!1,wrap:!1},a={weekdays:{shorthand:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],longhand:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]},months:{shorthand:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],longhand:["January","February","March","April","May","June","July","August","September","October","November","December"]},daysInMonth:[31,28,31,30,31,30,31,31,30,31,30,31],firstDayOfWeek:0,ordinal:function(e){var t=e%100;if(t>3&&t<21)return"th";switch(t%10){case 1:return"st";case 2:return"nd";case 3:return"rd";default:return"th"}},rangeSeparator:" to ",weekAbbreviation:"Wk",scrollTitle:"Scroll to increment",toggleTitle:"Click to toggle",amPM:["AM","PM"],yearAriaLabel:"Year",hourAriaLabel:"Hour",minuteAriaLabel:"Minute",time_24hr:!1},i=function(e){return("0"+e).slice(-2)},o=function(e){return!0===e?1:0};function r(e,t,n){var a;return void 0===n&&(n=!1),function(){var i=this,o=arguments;null!==a&&clearTimeout(a),a=window.setTimeout(function(){a=null,n||e.apply(i,o)},t),n&&!a&&e.apply(i,o)}}var l=function(e){return e instanceof Array?e:[e]};function c(e,t,n){if(!0===n)return e.classList.add(t);e.classList.remove(t)}function d(e,t,n){var a=window.document.createElement(e);return t=t||"",n=n||"",a.className=t,void 0!==n&&(a.textContent=n),a}function s(e){for(;e.firstChild;)e.removeChild(e.firstChild)}function u(e,t){var n=d("div","numInputWrapper"),a=d("input","numInput "+e),i=d("span","arrowUp"),o=d("span","arrowDown");if(-1===navigator.userAgent.indexOf("MSIE 9.0")?a.type="number":(a.type="text",a.pattern="\\d*"),void 0!==t)for(var r in t)a.setAttribute(r,t[r]);return n.appendChild(a),n.appendChild(i),n.appendChild(o),n}var f=function(){},m=function(e,t,n){return n.months[t?"shorthand":"longhand"][e]},g={D:f,F:function(e,t,n){e.setMonth(n.months.longhand.indexOf(t))},G:function(e,t){e.setHours(parseFloat(t))},H:function(e,t){e.setHours(parseFloat(t))},J:function(e,t){e.setDate(parseFloat(t))},K:function(e,t,n){e.setHours(e.getHours()%12+12*o(new RegExp(n.amPM[1],"i").test(t)))},M:function(e,t,n){e.setMonth(n.months.shorthand.indexOf(t))},S:function(e,t){e.setSeconds(parseFloat(t))},U:function(e,t){return new Date(1e3*parseFloat(t))},W:function(e,t,n){var a=parseInt(t),i=new Date(e.getFullYear(),0,2+7*(a-1),0,0,0,0);return i.setDate(i.getDate()-i.getDay()+n.firstDayOfWeek),i},Y:function(e,t){e.setFullYear(parseFloat(t))},Z:function(e,t){return new Date(t)},d:function(e,t){e.setDate(parseFloat(t))},h:function(e,t){e.setHours(parseFloat(t))},i:function(e,t){e.setMinutes(parseFloat(t))},j:function(e,t){e.setDate(parseFloat(t))},l:f,m:function(e,t){e.setMonth(parseFloat(t)-1)},n:function(e,t){e.setMonth(parseFloat(t)-1)},s:function(e,t){e.setSeconds(parseFloat(t))},u:function(e,t){return new Date(parseFloat(t))},w:f,y:function(e,t){e.setFullYear(2e3+parseFloat(t))}},p={D:"(\\w+)",F:"(\\w+)",G:"(\\d\\d|\\d)",H:"(\\d\\d|\\d)",J:"(\\d\\d|\\d)\\w+",K:"",M:"(\\w+)",S:"(\\d\\d|\\d)",U:"(.+)",W:"(\\d\\d|\\d)",Y:"(\\d{4})",Z:"(.+)",d:"(\\d\\d|\\d)",h:"(\\d\\d|\\d)",i:"(\\d\\d|\\d)",j:"(\\d\\d|\\d)",l:"(\\w+)",m:"(\\d\\d|\\d)",n:"(\\d\\d|\\d)",s:"(\\d\\d|\\d)",u:"(.+)",w:"(\\d\\d|\\d)",y:"(\\d{2})"},h={Z:function(e){return e.toISOString()},D:function(e,t,n){return t.weekdays.shorthand[h.w(e,t,n)]},F:function(e,t,n){return m(h.n(e,t,n)-1,!1,t)},G:function(e,t,n){return i(h.h(e,t,n))},H:function(e){return i(e.getHours())},J:function(e,t){return void 0!==t.ordinal?e.getDate()+t.ordinal(e.getDate()):e.getDate()},K:function(e,t){return t.amPM[o(e.getHours()>11)]},M:function(e,t){return m(e.getMonth(),!0,t)},S:function(e){return i(e.getSeconds())},U:function(e){return e.getTime()/1e3},W:function(e,t,n){return n.getWeek(e)},Y:function(e){return e.getFullYear()},d:function(e){return i(e.getDate())},h:function(e){return e.getHours()%12?e.getHours()%12:12},i:function(e){return i(e.getMinutes())},j:function(e){return e.getDate()},l:function(e,t){return t.weekdays.longhand[e.getDay()]},m:function(e){return i(e.getMonth()+1)},n:function(e){return e.getMonth()+1},s:function(e){return e.getSeconds()},u:function(e){return e.getTime()},w:function(e){return e.getDay()},y:function(e){return String(e.getFullYear()).substring(2)}},v=function(e){var t=e.config,i=void 0===t?n:t,o=e.l10n,r=void 0===o?a:o;return function(e,t,n){var a=n||r;return void 0!==i.formatDate?i.formatDate(e,t,a):t.split("").map(function(t,n,o){return h[t]&&"\\"!==o[n-1]?h[t](e,a,i):"\\"!==t?t:""}).join("")}},D=function(e){var t=e.config,i=void 0===t?n:t,o=e.l10n,r=void 0===o?a:o;return function(e,t,a,o){if(0===e||e){var l,c=o||r,d=e;if(e instanceof Date)l=new Date(e.getTime());else if("string"!=typeof e&&void 0!==e.toFixed)l=new Date(e);else if("string"==typeof e){var s=t||(i||n).dateFormat,u=String(e).trim();if("today"===u)l=new Date,a=!0;else if(/Z$/.test(u)||/GMT$/.test(u))l=new Date(e);else if(i&&i.parseDate)l=i.parseDate(e,s);else{l=i&&i.noCalendar?new Date((new Date).setHours(0,0,0,0)):new Date((new Date).getFullYear(),0,1,0,0,0,0);for(var f=void 0,m=[],h=0,v=0,D="";h<s.length;h++){var w=s[h],b="\\"===w,C="\\"===s[h-1]||b;if(p[w]&&!C){D+=p[w];var M=new RegExp(D).exec(e);M&&(f=!0)&&m["Y"!==w?"push":"unshift"]({fn:g[w],val:M[++v]})}else b||(D+=".");m.forEach(function(e){var t=e.fn,n=e.val;return l=t(l,n,c)||l})}l=f?l:void 0}}if(l instanceof Date&&!isNaN(l.getTime()))return!0===a&&l.setHours(0,0,0,0),l;i.errorHandler(new Error("Invalid date provided: "+d))}}};function w(e,t,n){return void 0===n&&(n=!0),!1!==n?new Date(e.getTime()).setHours(0,0,0,0)-new Date(t.getTime()).setHours(0,0,0,0):e.getTime()-t.getTime()}var b=function(e,t,n){return e>Math.min(t,n)&&e<Math.max(t,n)},C={DAY:864e5};"function"!=typeof Object.assign&&(Object.assign=function(e){for(var t=[],n=1;n<arguments.length;n++)t[n-1]=arguments[n];if(!e)throw TypeError("Cannot convert undefined or null to object");for(var a=function(t){t&&Object.keys(t).forEach(function(n){return e[n]=t[n]})},i=0,o=t;i<o.length;i++)a(o[i]);return e});var M=300;function y(f,g){var h={config:e({},n,E.defaultConfig),l10n:a};function y(e){return e.bind(h)}function x(){var e=h.config;!1===e.weekNumbers&&1===e.showMonths||!0!==e.noCalendar&&window.requestAnimationFrame(function(){if(void 0!==h.calendarContainer&&(h.calendarContainer.style.visibility="hidden",h.calendarContainer.style.display="block"),void 0!==h.daysContainer){var t=(h.days.offsetWidth+1)*e.showMonths;h.daysContainer.style.width=t+"px",h.calendarContainer.style.width=t+(void 0!==h.weekWrapper?h.weekWrapper.offsetWidth:0)+"px",h.calendarContainer.style.removeProperty("visibility"),h.calendarContainer.style.removeProperty("display")}})}function T(e){0===h.selectedDates.length&&ie(),void 0!==e&&"blur"!==e.type&&function(e){e.preventDefault();var t="keydown"===e.type,n=e.target;void 0!==h.amPM&&e.target===h.amPM&&(h.amPM.textContent=h.l10n.amPM[o(h.amPM.textContent===h.l10n.amPM[0])]);var a=parseFloat(n.getAttribute("min")),r=parseFloat(n.getAttribute("max")),l=parseFloat(n.getAttribute("step")),c=parseInt(n.value,10),d=c+l*(e.delta||(t?38===e.which?1:-1:0));if(void 0!==n.value&&2===n.value.length){var s=n===h.hourElement,u=n===h.minuteElement;d<a?(d=r+d+o(!s)+(o(s)&&o(!h.amPM)),u&&j(void 0,-1,h.hourElement)):d>r&&(d=n===h.hourElement?d-r-o(!h.amPM):a,u&&j(void 0,1,h.hourElement)),h.amPM&&s&&(1===l?d+c===23:Math.abs(d-c)>l)&&(h.amPM.textContent=h.l10n.amPM[o(h.amPM.textContent===h.l10n.amPM[0])]),n.value=i(d)}}(e);var t=h._input.value;k(),we(),h._input.value!==t&&h._debouncedChange()}function k(){if(void 0!==h.hourElement&&void 0!==h.minuteElement){var e,t,n=(parseInt(h.hourElement.value.slice(-2),10)||0)%24,a=(parseInt(h.minuteElement.value,10)||0)%60,i=void 0!==h.secondElement?(parseInt(h.secondElement.value,10)||0)%60:0;void 0!==h.amPM&&(e=n,t=h.amPM.textContent,n=e%12+12*o(t===h.l10n.amPM[1]));var r=void 0!==h.config.minTime||h.config.minDate&&h.minDateHasTime&&h.latestSelectedDateObj&&0===w(h.latestSelectedDateObj,h.config.minDate,!0);if(void 0!==h.config.maxTime||h.config.maxDate&&h.maxDateHasTime&&h.latestSelectedDateObj&&0===w(h.latestSelectedDateObj,h.config.maxDate,!0)){var l=void 0!==h.config.maxTime?h.config.maxTime:h.config.maxDate;(n=Math.min(n,l.getHours()))===l.getHours()&&(a=Math.min(a,l.getMinutes())),a===l.getMinutes()&&(i=Math.min(i,l.getSeconds()))}if(r){var c=void 0!==h.config.minTime?h.config.minTime:h.config.minDate;(n=Math.max(n,c.getHours()))===c.getHours()&&(a=Math.max(a,c.getMinutes())),a===c.getMinutes()&&(i=Math.max(i,c.getSeconds()))}O(n,a,i)}}function I(e){var t=e||h.latestSelectedDateObj;t&&O(t.getHours(),t.getMinutes(),t.getSeconds())}function S(){var e=h.config.defaultHour,t=h.config.defaultMinute,n=h.config.defaultSeconds;if(void 0!==h.config.minDate){var a=h.config.minDate.getHours(),i=h.config.minDate.getMinutes();(e=Math.max(e,a))===a&&(t=Math.max(i,t)),e===a&&t===i&&(n=h.config.minDate.getSeconds())}if(void 0!==h.config.maxDate){var o=h.config.maxDate.getHours(),r=h.config.maxDate.getMinutes();(e=Math.min(e,o))===o&&(t=Math.min(r,t)),e===o&&t===r&&(n=h.config.maxDate.getSeconds())}O(e,t,n)}function O(e,t,n){void 0!==h.latestSelectedDateObj&&h.latestSelectedDateObj.setHours(e%24,t,n||0,0),h.hourElement&&h.minuteElement&&!h.isMobile&&(h.hourElement.value=i(h.config.time_24hr?e:(12+e)%12+12*o(e%12==0)),h.minuteElement.value=i(t),void 0!==h.amPM&&(h.amPM.textContent=h.l10n.amPM[o(e>=12)]),void 0!==h.secondElement&&(h.secondElement.value=i(n)))}function _(e){var t=parseInt(e.target.value)+(e.delta||0);(t/1e3>1||"Enter"===e.key&&!/[^\d]/.test(t.toString()))&&Q(t)}function F(e,t,n,a){return t instanceof Array?t.forEach(function(t){return F(e,t,n,a)}):e instanceof Array?e.forEach(function(e){return F(e,t,n,a)}):(e.addEventListener(t,n,a),void h._handlers.push({element:e,event:t,handler:n,options:a}))}function N(e){return function(t){1===t.which&&e(t)}}function Y(){ge("onChange")}function A(e,t){var n=void 0!==e?h.parseDate(e):h.latestSelectedDateObj||(h.config.minDate&&h.config.minDate>h.now?h.config.minDate:h.config.maxDate&&h.config.maxDate<h.now?h.config.maxDate:h.now),a=h.currentYear,i=h.currentMonth;try{void 0!==n&&(h.currentYear=n.getFullYear(),h.currentMonth=n.getMonth())}catch(e){e.message="Invalid date supplied: "+n,h.config.errorHandler(e)}t&&h.currentYear!==a&&(ge("onYearChange"),K()),!t||h.currentYear===a&&h.currentMonth===i||ge("onMonthChange"),h.redraw()}function P(e){~e.target.className.indexOf("arrow")&&j(e,e.target.classList.contains("arrowUp")?1:-1)}function j(e,t,n){var a=e&&e.target,i=n||a&&a.parentNode&&a.parentNode.firstChild,o=pe("increment");o.delta=t,i&&i.dispatchEvent(o)}function H(e,t,n,a){var i=X(t,!0),o=d("span","flatpickr-day "+e,t.getDate().toString());return o.dateObj=t,o.$i=a,o.setAttribute("aria-label",h.formatDate(t,h.config.ariaDateFormat)),-1===e.indexOf("hidden")&&0===w(t,h.now)&&(h.todayDateElem=o,o.classList.add("today"),o.setAttribute("aria-current","date")),i?(o.tabIndex=-1,he(t)&&(o.classList.add("selected"),h.selectedDateElem=o,"range"===h.config.mode&&(c(o,"startRange",h.selectedDates[0]&&0===w(t,h.selectedDates[0],!0)),c(o,"endRange",h.selectedDates[1]&&0===w(t,h.selectedDates[1],!0)),"nextMonthDay"===e&&o.classList.add("inRange")))):o.classList.add("flatpickr-disabled"),"range"===h.config.mode&&function(e){return!("range"!==h.config.mode||h.selectedDates.length<2)&&w(e,h.selectedDates[0])>=0&&w(e,h.selectedDates[1])<=0}(t)&&!he(t)&&o.classList.add("inRange"),h.weekNumbers&&1===h.config.showMonths&&"prevMonthDay"!==e&&n%7==1&&h.weekNumbers.insertAdjacentHTML("beforeend","<span class='flatpickr-day'>"+h.config.getWeek(t)+"</span>"),ge("onDayCreate",o),o}function L(e){e.focus(),"range"===h.config.mode&&ne(e)}function W(e){for(var t=e>0?0:h.config.showMonths-1,n=e>0?h.config.showMonths:-1,a=t;a!=n;a+=e)for(var i=h.daysContainer.children[a],o=e>0?0:i.children.length-1,r=e>0?i.children.length:-1,l=o;l!=r;l+=e){var c=i.children[l];if(-1===c.className.indexOf("hidden")&&X(c.dateObj))return c}}function R(e,t){var n=ee(document.activeElement||document.body),a=void 0!==e?e:n?document.activeElement:void 0!==h.selectedDateElem&&ee(h.selectedDateElem)?h.selectedDateElem:void 0!==h.todayDateElem&&ee(h.todayDateElem)?h.todayDateElem:W(t>0?1:-1);return void 0===a?h._input.focus():n?void function(e,t){for(var n=-1===e.className.indexOf("Month")?e.dateObj.getMonth():h.currentMonth,a=t>0?h.config.showMonths:-1,i=t>0?1:-1,o=n-h.currentMonth;o!=a;o+=i)for(var r=h.daysContainer.children[o],l=n-h.currentMonth===o?e.$i+t:t<0?r.children.length-1:0,c=r.children.length,d=l;d>=0&&d<c&&d!=(t>0?c:-1);d+=i){var s=r.children[d];if(-1===s.className.indexOf("hidden")&&X(s.dateObj)&&Math.abs(e.$i-d)>=Math.abs(t))return L(s)}h.changeMonth(i),R(W(i),0)}(a,t):L(a)}function B(e,t){for(var n=(new Date(e,t,1).getDay()-h.l10n.firstDayOfWeek+7)%7,a=h.utils.getDaysInMonth((t-1+12)%12),i=h.utils.getDaysInMonth(t),o=window.document.createDocumentFragment(),r=h.config.showMonths>1,l=r?"prevMonthDay hidden":"prevMonthDay",c=r?"nextMonthDay hidden":"nextMonthDay",s=a+1-n,u=0;s<=a;s++,u++)o.appendChild(H(l,new Date(e,t-1,s),s,u));for(s=1;s<=i;s++,u++)o.appendChild(H("",new Date(e,t,s),s,u));for(var f=i+1;f<=42-n&&(1===h.config.showMonths||u%7!=0);f++,u++)o.appendChild(H(c,new Date(e,t+1,f%i),f,u));var m=d("div","dayContainer");return m.appendChild(o),m}function J(){if(void 0!==h.daysContainer){s(h.daysContainer),h.weekNumbers&&s(h.weekNumbers);for(var e=document.createDocumentFragment(),t=0;t<h.config.showMonths;t++){var n=new Date(h.currentYear,h.currentMonth,1);n.setMonth(h.currentMonth+t),e.appendChild(B(n.getFullYear(),n.getMonth()))}h.daysContainer.appendChild(e),h.days=h.daysContainer.firstChild,"range"===h.config.mode&&1===h.selectedDates.length&&ne()}}function K(){if(!(h.config.showMonths>1||"dropdown"!==h.config.monthSelectorType)){var e=function(e){return!(void 0!==h.config.minDate&&h.currentYear===h.config.minDate.getFullYear()&&e<h.config.minDate.getMonth()||void 0!==h.config.maxDate&&h.currentYear===h.config.maxDate.getFullYear()&&e>h.config.maxDate.getMonth())};h.monthsDropdownContainer.tabIndex=-1,h.monthsDropdownContainer.innerHTML="";for(var t=0;t<12;t++)if(e(t)){var n=d("option","flatpickr-monthDropdown-month");n.value=new Date(h.currentYear,t).getMonth().toString(),n.textContent=m(t,h.config.shorthandCurrentMonth,h.l10n),n.tabIndex=-1,h.currentMonth===t&&(n.selected=!0),h.monthsDropdownContainer.appendChild(n)}}}function U(){var e,t=d("div","flatpickr-month"),n=window.document.createDocumentFragment();h.config.showMonths>1||"static"===h.config.monthSelectorType?e=d("span","cur-month"):(h.monthsDropdownContainer=d("select","flatpickr-monthDropdown-months"),F(h.monthsDropdownContainer,"change",function(e){var t=e.target,n=parseInt(t.value,10);h.changeMonth(n-h.currentMonth),ge("onMonthChange")}),K(),e=h.monthsDropdownContainer);var a=u("cur-year",{tabindex:"-1"}),i=a.getElementsByTagName("input")[0];i.setAttribute("aria-label",h.l10n.yearAriaLabel),h.config.minDate&&i.setAttribute("min",h.config.minDate.getFullYear().toString()),h.config.maxDate&&(i.setAttribute("max",h.config.maxDate.getFullYear().toString()),i.disabled=!!h.config.minDate&&h.config.minDate.getFullYear()===h.config.maxDate.getFullYear());var o=d("div","flatpickr-current-month");return o.appendChild(e),o.appendChild(a),n.appendChild(o),t.appendChild(n),{container:t,yearElement:i,monthElement:e}}function q(){s(h.monthNav),h.monthNav.appendChild(h.prevMonthNav),h.config.showMonths&&(h.yearElements=[],h.monthElements=[]);for(var e=h.config.showMonths;e--;){var t=U();h.yearElements.push(t.yearElement),h.monthElements.push(t.monthElement),h.monthNav.appendChild(t.container)}h.monthNav.appendChild(h.nextMonthNav)}function $(){h.weekdayContainer?s(h.weekdayContainer):h.weekdayContainer=d("div","flatpickr-weekdays");for(var e=h.config.showMonths;e--;){var t=d("div","flatpickr-weekdaycontainer");h.weekdayContainer.appendChild(t)}return z(),h.weekdayContainer}function z(){if(h.weekdayContainer){var e=h.l10n.firstDayOfWeek,t=h.l10n.weekdays.shorthand.slice();e>0&&e<t.length&&(t=t.splice(e,t.length).concat(t.splice(0,e)));for(var n=h.config.showMonths;n--;)h.weekdayContainer.children[n].innerHTML="\n      <span class='flatpickr-weekday'>\n        "+t.join("</span><span class='flatpickr-weekday'>")+"\n      </span>\n      "}}function G(e,t){void 0===t&&(t=!0);var n=t?e:e-h.currentMonth;n<0&&!0===h._hidePrevMonthArrow||n>0&&!0===h._hideNextMonthArrow||(h.currentMonth+=n,(h.currentMonth<0||h.currentMonth>11)&&(h.currentYear+=h.currentMonth>11?1:-1,h.currentMonth=(h.currentMonth+12)%12,ge("onYearChange"),K()),J(),ge("onMonthChange"),ve())}function V(e){return!(!h.config.appendTo||!h.config.appendTo.contains(e))||h.calendarContainer.contains(e)}function Z(e){if(h.isOpen&&!h.config.inline){var t="function"==typeof(r=e).composedPath?r.composedPath()[0]:r.target,n=V(t),a=t===h.input||t===h.altInput||h.element.contains(t)||e.path&&e.path.indexOf&&(~e.path.indexOf(h.input)||~e.path.indexOf(h.altInput)),i="blur"===e.type?a&&e.relatedTarget&&!V(e.relatedTarget):!a&&!n&&!V(e.relatedTarget),o=!h.config.ignoredFocusElements.some(function(e){return e.contains(t)});i&&o&&(void 0!==h.timeContainer&&void 0!==h.minuteElement&&void 0!==h.hourElement&&T(),h.close(),"range"===h.config.mode&&1===h.selectedDates.length&&(h.clear(!1),h.redraw()))}var r}function Q(e){if(!(!e||h.config.minDate&&e<h.config.minDate.getFullYear()||h.config.maxDate&&e>h.config.maxDate.getFullYear())){var t=e,n=h.currentYear!==t;h.currentYear=t||h.currentYear,h.config.maxDate&&h.currentYear===h.config.maxDate.getFullYear()?h.currentMonth=Math.min(h.config.maxDate.getMonth(),h.currentMonth):h.config.minDate&&h.currentYear===h.config.minDate.getFullYear()&&(h.currentMonth=Math.max(h.config.minDate.getMonth(),h.currentMonth)),n&&(h.redraw(),ge("onYearChange"),K())}}function X(e,t){void 0===t&&(t=!0);var n=h.parseDate(e,void 0,t);if(h.config.minDate&&n&&w(n,h.config.minDate,void 0!==t?t:!h.minDateHasTime)<0||h.config.maxDate&&n&&w(n,h.config.maxDate,void 0!==t?t:!h.maxDateHasTime)>0)return!1;if(0===h.config.enable.length&&0===h.config.disable.length)return!0;if(void 0===n)return!1;for(var a=h.config.enable.length>0,i=a?h.config.enable:h.config.disable,o=0,r=void 0;o<i.length;o++){if("function"==typeof(r=i[o])&&r(n))return a;if(r instanceof Date&&void 0!==n&&r.getTime()===n.getTime())return a;if("string"==typeof r&&void 0!==n){var l=h.parseDate(r,void 0,!0);return l&&l.getTime()===n.getTime()?a:!a}if("object"==typeof r&&void 0!==n&&r.from&&r.to&&n.getTime()>=r.from.getTime()&&n.getTime()<=r.to.getTime())return a}return!a}function ee(e){return void 0!==h.daysContainer&&-1===e.className.indexOf("hidden")&&h.daysContainer.contains(e)}function te(e){var t=e.target===h._input,n=h.config.allowInput,a=h.isOpen&&(!n||!t),i=h.config.inline&&t&&!n;if(13===e.keyCode&&t){if(n)return h.setDate(h._input.value,!0,e.target===h.altInput?h.config.altFormat:h.config.dateFormat),e.target.blur();h.open()}else if(V(e.target)||a||i){var o=!!h.timeContainer&&h.timeContainer.contains(e.target);switch(e.keyCode){case 13:o?(e.preventDefault(),T(),de()):se(e);break;case 27:e.preventDefault(),de();break;case 8:case 46:t&&!h.config.allowInput&&(e.preventDefault(),h.clear());break;case 37:case 39:if(o||t)h.hourElement&&h.hourElement.focus();else if(e.preventDefault(),void 0!==h.daysContainer&&(!1===n||document.activeElement&&ee(document.activeElement))){var r=39===e.keyCode?1:-1;e.ctrlKey?(e.stopPropagation(),G(r),R(W(1),0)):R(void 0,r)}break;case 38:case 40:e.preventDefault();var l=40===e.keyCode?1:-1;h.daysContainer&&void 0!==e.target.$i||e.target===h.input||e.target===h.altInput?e.ctrlKey?(e.stopPropagation(),Q(h.currentYear-l),R(W(1),0)):o||R(void 0,7*l):e.target===h.currentYearElement?Q(h.currentYear-l):h.config.enableTime&&(!o&&h.hourElement&&h.hourElement.focus(),T(e),h._debouncedChange());break;case 9:if(o){var c=[h.hourElement,h.minuteElement,h.secondElement,h.amPM].concat(h.pluginElements).filter(function(e){return e}),d=c.indexOf(e.target);if(-1!==d){var s=c[d+(e.shiftKey?-1:1)];e.preventDefault(),(s||h._input).focus()}}else!h.config.noCalendar&&h.daysContainer&&h.daysContainer.contains(e.target)&&e.shiftKey&&(e.preventDefault(),h._input.focus())}}if(void 0!==h.amPM&&e.target===h.amPM)switch(e.key){case h.l10n.amPM[0].charAt(0):case h.l10n.amPM[0].charAt(0).toLowerCase():h.amPM.textContent=h.l10n.amPM[0],k(),we();break;case h.l10n.amPM[1].charAt(0):case h.l10n.amPM[1].charAt(0).toLowerCase():h.amPM.textContent=h.l10n.amPM[1],k(),we()}(t||V(e.target))&&ge("onKeyDown",e)}function ne(e){if(1===h.selectedDates.length&&(!e||e.classList.contains("flatpickr-day")&&!e.classList.contains("flatpickr-disabled"))){for(var t=e?e.dateObj.getTime():h.days.firstElementChild.dateObj.getTime(),n=h.parseDate(h.selectedDates[0],void 0,!0).getTime(),a=Math.min(t,h.selectedDates[0].getTime()),i=Math.max(t,h.selectedDates[0].getTime()),o=!1,r=0,l=0,c=a;c<i;c+=C.DAY)X(new Date(c),!0)||(o=o||c>a&&c<i,c<n&&(!r||c>r)?r=c:c>n&&(!l||c<l)&&(l=c));for(var d=0;d<h.config.showMonths;d++)for(var s=h.daysContainer.children[d],u=function(a,i){var c=s.children[a],d=c.dateObj.getTime(),u=r>0&&d<r||l>0&&d>l;return u?(c.classList.add("notAllowed"),["inRange","startRange","endRange"].forEach(function(e){c.classList.remove(e)}),"continue"):o&&!u?"continue":(["startRange","inRange","endRange","notAllowed"].forEach(function(e){c.classList.remove(e)}),void(void 0!==e&&(e.classList.add(t<=h.selectedDates[0].getTime()?"startRange":"endRange"),n<t&&d===n?c.classList.add("startRange"):n>t&&d===n&&c.classList.add("endRange"),d>=r&&(0===l||d<=l)&&b(d,n,t)&&c.classList.add("inRange"))))},f=0,m=s.children.length;f<m;f++)u(f)}}function ae(){!h.isOpen||h.config.static||h.config.inline||le()}function ie(){h.setDate(void 0!==h.config.minDate?new Date(h.config.minDate.getTime()):new Date,!0),S(),we()}function oe(e){return function(t){var n=h.config["_"+e+"Date"]=h.parseDate(t,h.config.dateFormat),a=h.config["_"+("min"===e?"max":"min")+"Date"];void 0!==n&&(h["min"===e?"minDateHasTime":"maxDateHasTime"]=n.getHours()>0||n.getMinutes()>0||n.getSeconds()>0),h.selectedDates&&(h.selectedDates=h.selectedDates.filter(function(e){return X(e)}),h.selectedDates.length||"min"!==e||I(n),we()),h.daysContainer&&(ce(),void 0!==n?h.currentYearElement[e]=n.getFullYear().toString():h.currentYearElement.removeAttribute(e),h.currentYearElement.disabled=!!a&&void 0!==n&&a.getFullYear()===n.getFullYear())}}function re(){"object"!=typeof h.config.locale&&void 0===E.l10ns[h.config.locale]&&h.config.errorHandler(new Error("flatpickr: invalid locale "+h.config.locale)),h.l10n=e({},E.l10ns.default,"object"==typeof h.config.locale?h.config.locale:"default"!==h.config.locale?E.l10ns[h.config.locale]:void 0),p.K="("+h.l10n.amPM[0]+"|"+h.l10n.amPM[1]+"|"+h.l10n.amPM[0].toLowerCase()+"|"+h.l10n.amPM[1].toLowerCase()+")",void 0===e({},g,JSON.parse(JSON.stringify(f.dataset||{}))).time_24hr&&void 0===E.defaultConfig.time_24hr&&(h.config.time_24hr=h.l10n.time_24hr),h.formatDate=v(h),h.parseDate=D({config:h.config,l10n:h.l10n})}function le(e){if(void 0!==h.calendarContainer){ge("onPreCalendarPosition");var t=e||h._positionElement,n=Array.prototype.reduce.call(h.calendarContainer.children,function(e,t){return e+t.offsetHeight},0),a=h.calendarContainer.offsetWidth,i=h.config.position.split(" "),o=i[0],r=i.length>1?i[1]:null,l=t.getBoundingClientRect(),d=window.innerHeight-l.bottom,s="above"===o||"below"!==o&&d<n&&l.top>n,u=window.pageYOffset+l.top+(s?-n-2:t.offsetHeight+2);if(c(h.calendarContainer,"arrowTop",!s),c(h.calendarContainer,"arrowBottom",s),!h.config.inline){var f=window.pageXOffset+l.left-(null!=r&&"center"===r?(a-l.width)/2:0),m=window.document.body.offsetWidth-(window.pageXOffset+l.right),g=f+a>window.document.body.offsetWidth,p=m+a>window.document.body.offsetWidth;if(c(h.calendarContainer,"rightMost",g),!h.config.static)if(h.calendarContainer.style.top=u+"px",g)if(p){var v=document.styleSheets[0];if(void 0===v)return;var D=window.document.body.offsetWidth,w=Math.max(0,D/2-a/2),b=v.cssRules.length,C="{left:"+l.left+"px;right:auto;}";c(h.calendarContainer,"rightMost",!1),c(h.calendarContainer,"centerMost",!0),v.insertRule(".flatpickr-calendar.centerMost:before,.flatpickr-calendar.centerMost:after"+C,b),h.calendarContainer.style.left=w+"px",h.calendarContainer.style.right="auto"}else h.calendarContainer.style.left="auto",h.calendarContainer.style.right=m+"px";else h.calendarContainer.style.left=f+"px",h.calendarContainer.style.right="auto"}}}function ce(){h.config.noCalendar||h.isMobile||(ve(),J())}function de(){h._input.focus(),-1!==window.navigator.userAgent.indexOf("MSIE")||void 0!==navigator.msMaxTouchPoints?setTimeout(h.close,0):h.close()}function se(e){e.preventDefault(),e.stopPropagation();var t=function e(t,n){return n(t)?t:t.parentNode?e(t.parentNode,n):void 0}(e.target,function(e){return e.classList&&e.classList.contains("flatpickr-day")&&!e.classList.contains("flatpickr-disabled")&&!e.classList.contains("notAllowed")});if(void 0!==t){var n=t,a=h.latestSelectedDateObj=new Date(n.dateObj.getTime()),i=(a.getMonth()<h.currentMonth||a.getMonth()>h.currentMonth+h.config.showMonths-1)&&"range"!==h.config.mode;if(h.selectedDateElem=n,"single"===h.config.mode)h.selectedDates=[a];else if("multiple"===h.config.mode){var o=he(a);o?h.selectedDates.splice(parseInt(o),1):h.selectedDates.push(a)}else"range"===h.config.mode&&(2===h.selectedDates.length&&h.clear(!1,!1),h.latestSelectedDateObj=a,h.selectedDates.push(a),0!==w(a,h.selectedDates[0],!0)&&h.selectedDates.sort(function(e,t){return e.getTime()-t.getTime()}));if(k(),i){var r=h.currentYear!==a.getFullYear();h.currentYear=a.getFullYear(),h.currentMonth=a.getMonth(),r&&(ge("onYearChange"),K()),ge("onMonthChange")}if(ve(),J(),we(),h.config.enableTime&&setTimeout(function(){return h.showTimeInput=!0},50),i||"range"===h.config.mode||1!==h.config.showMonths?void 0!==h.selectedDateElem&&void 0===h.hourElement&&h.selectedDateElem&&h.selectedDateElem.focus():L(n),void 0!==h.hourElement&&void 0!==h.hourElement&&h.hourElement.focus(),h.config.closeOnSelect){var l="single"===h.config.mode&&!h.config.enableTime,c="range"===h.config.mode&&2===h.selectedDates.length&&!h.config.enableTime;(l||c)&&de()}Y()}}h.parseDate=D({config:h.config,l10n:h.l10n}),h._handlers=[],h.pluginElements=[],h.loadedPlugins=[],h._bind=F,h._setHoursFromDate=I,h._positionCalendar=le,h.changeMonth=G,h.changeYear=Q,h.clear=function(e,t){void 0===e&&(e=!0),void 0===t&&(t=!0),h.input.value="",void 0!==h.altInput&&(h.altInput.value=""),void 0!==h.mobileInput&&(h.mobileInput.value=""),h.selectedDates=[],h.latestSelectedDateObj=void 0,!0===t&&(h.currentYear=h._initialDate.getFullYear(),h.currentMonth=h._initialDate.getMonth()),h.showTimeInput=!1,!0===h.config.enableTime&&S(),h.redraw(),e&&ge("onChange")},h.close=function(){h.isOpen=!1,h.isMobile||(void 0!==h.calendarContainer&&h.calendarContainer.classList.remove("open"),void 0!==h._input&&h._input.classList.remove("active")),ge("onClose")},h._createElement=d,h.destroy=function(){void 0!==h.config&&ge("onDestroy");for(var e=h._handlers.length;e--;){var t=h._handlers[e];t.element.removeEventListener(t.event,t.handler,t.options)}if(h._handlers=[],h.mobileInput)h.mobileInput.parentNode&&h.mobileInput.parentNode.removeChild(h.mobileInput),h.mobileInput=void 0;else if(h.calendarContainer&&h.calendarContainer.parentNode)if(h.config.static&&h.calendarContainer.parentNode){var n=h.calendarContainer.parentNode;if(n.lastChild&&n.removeChild(n.lastChild),n.parentNode){for(;n.firstChild;)n.parentNode.insertBefore(n.firstChild,n);n.parentNode.removeChild(n)}}else h.calendarContainer.parentNode.removeChild(h.calendarContainer);h.altInput&&(h.input.type="text",h.altInput.parentNode&&h.altInput.parentNode.removeChild(h.altInput),delete h.altInput),h.input&&(h.input.type=h.input._type,h.input.classList.remove("flatpickr-input"),h.input.removeAttribute("readonly"),h.input.value=""),["_showTimeInput","latestSelectedDateObj","_hideNextMonthArrow","_hidePrevMonthArrow","__hideNextMonthArrow","__hidePrevMonthArrow","isMobile","isOpen","selectedDateElem","minDateHasTime","maxDateHasTime","days","daysContainer","_input","_positionElement","innerContainer","rContainer","monthNav","todayDateElem","calendarContainer","weekdayContainer","prevMonthNav","nextMonthNav","monthsDropdownContainer","currentMonthElement","currentYearElement","navigationCurrentMonth","selectedDateElem","config"].forEach(function(e){try{delete h[e]}catch(e){}})},h.isEnabled=X,h.jumpToDate=A,h.open=function(e,t){if(void 0===t&&(t=h._positionElement),!0===h.isMobile)return e&&(e.preventDefault(),e.target&&e.target.blur()),void 0!==h.mobileInput&&(h.mobileInput.focus(),h.mobileInput.click()),void ge("onOpen");if(!h._input.disabled&&!h.config.inline){var n=h.isOpen;h.isOpen=!0,n||(h.calendarContainer.classList.add("open"),h._input.classList.add("active"),ge("onOpen"),le(t)),!0===h.config.enableTime&&!0===h.config.noCalendar&&(0===h.selectedDates.length&&ie(),!1!==h.config.allowInput||void 0!==e&&h.timeContainer.contains(e.relatedTarget)||setTimeout(function(){return h.hourElement.select()},50))}},h.redraw=ce,h.set=function(e,n){if(null!==e&&"object"==typeof e)for(var a in Object.assign(h.config,e),e)void 0!==ue[a]&&ue[a].forEach(function(e){return e()});else h.config[e]=n,void 0!==ue[e]?ue[e].forEach(function(e){return e()}):t.indexOf(e)>-1&&(h.config[e]=l(n));h.redraw(),we(!1)},h.setDate=function(e,t,n){if(void 0===t&&(t=!1),void 0===n&&(n=h.config.dateFormat),0!==e&&!e||e instanceof Array&&0===e.length)return h.clear(t);fe(e,n),h.showTimeInput=h.selectedDates.length>0,h.latestSelectedDateObj=h.selectedDates[h.selectedDates.length-1],h.redraw(),A(),I(),0===h.selectedDates.length&&h.clear(!1),we(t),t&&ge("onChange")},h.toggle=function(e){if(!0===h.isOpen)return h.close();h.open(e)};var ue={locale:[re,z],showMonths:[q,x,$],minDate:[A],maxDate:[A]};function fe(e,t){var n=[];if(e instanceof Array)n=e.map(function(e){return h.parseDate(e,t)});else if(e instanceof Date||"number"==typeof e)n=[h.parseDate(e,t)];else if("string"==typeof e)switch(h.config.mode){case"single":case"time":n=[h.parseDate(e,t)];break;case"multiple":n=e.split(h.config.conjunction).map(function(e){return h.parseDate(e,t)});break;case"range":n=e.split(h.l10n.rangeSeparator).map(function(e){return h.parseDate(e,t)})}else h.config.errorHandler(new Error("Invalid date supplied: "+JSON.stringify(e)));h.selectedDates=n.filter(function(e){return e instanceof Date&&X(e,!1)}),"range"===h.config.mode&&h.selectedDates.sort(function(e,t){return e.getTime()-t.getTime()})}function me(e){return e.slice().map(function(e){return"string"==typeof e||"number"==typeof e||e instanceof Date?h.parseDate(e,void 0,!0):e&&"object"==typeof e&&e.from&&e.to?{from:h.parseDate(e.from,void 0),to:h.parseDate(e.to,void 0)}:e}).filter(function(e){return e})}function ge(e,t){if(void 0!==h.config){var n=h.config[e];if(void 0!==n&&n.length>0)for(var a=0;n[a]&&a<n.length;a++)n[a](h.selectedDates,h.input.value,h,t);"onChange"===e&&(h.input.dispatchEvent(pe("change")),h.input.dispatchEvent(pe("input")))}}function pe(e){var t=document.createEvent("Event");return t.initEvent(e,!0,!0),t}function he(e){for(var t=0;t<h.selectedDates.length;t++)if(0===w(h.selectedDates[t],e))return""+t;return!1}function ve(){h.config.noCalendar||h.isMobile||!h.monthNav||(h.yearElements.forEach(function(e,t){var n=new Date(h.currentYear,h.currentMonth,1);n.setMonth(h.currentMonth+t),h.config.showMonths>1||"static"===h.config.monthSelectorType?h.monthElements[t].textContent=m(n.getMonth(),h.config.shorthandCurrentMonth,h.l10n)+" ":h.monthsDropdownContainer.value=n.getMonth().toString(),e.value=n.getFullYear().toString()}),h._hidePrevMonthArrow=void 0!==h.config.minDate&&(h.currentYear===h.config.minDate.getFullYear()?h.currentMonth<=h.config.minDate.getMonth():h.currentYear<h.config.minDate.getFullYear()),h._hideNextMonthArrow=void 0!==h.config.maxDate&&(h.currentYear===h.config.maxDate.getFullYear()?h.currentMonth+1>h.config.maxDate.getMonth():h.currentYear>h.config.maxDate.getFullYear()))}function De(e){return h.selectedDates.map(function(t){return h.formatDate(t,e)}).filter(function(e,t,n){return"range"!==h.config.mode||h.config.enableTime||n.indexOf(e)===t}).join("range"!==h.config.mode?h.config.conjunction:h.l10n.rangeSeparator)}function we(e){void 0===e&&(e=!0),void 0!==h.mobileInput&&h.mobileFormatStr&&(h.mobileInput.value=void 0!==h.latestSelectedDateObj?h.formatDate(h.latestSelectedDateObj,h.mobileFormatStr):""),h.input.value=De(h.config.dateFormat),void 0!==h.altInput&&(h.altInput.value=De(h.config.altFormat)),!1!==e&&ge("onValueUpdate")}function be(e){var t=h.prevMonthNav.contains(e.target),n=h.nextMonthNav.contains(e.target);t||n?G(t?-1:1):h.yearElements.indexOf(e.target)>=0?e.target.select():e.target.classList.contains("arrowUp")?h.changeYear(h.currentYear+1):e.target.classList.contains("arrowDown")&&h.changeYear(h.currentYear-1)}return function(){h.element=h.input=f,h.isOpen=!1,function(){var a=["wrap","weekNumbers","allowInput","clickOpens","time_24hr","enableTime","noCalendar","altInput","shorthandCurrentMonth","inline","static","enableSeconds","disableMobile"],i=e({},g,JSON.parse(JSON.stringify(f.dataset||{}))),o={};h.config.parseDate=i.parseDate,h.config.formatDate=i.formatDate,Object.defineProperty(h.config,"enable",{get:function(){return h.config._enable},set:function(e){h.config._enable=me(e)}}),Object.defineProperty(h.config,"disable",{get:function(){return h.config._disable},set:function(e){h.config._disable=me(e)}});var r="time"===i.mode;if(!i.dateFormat&&(i.enableTime||r)){var c=E.defaultConfig.dateFormat||n.dateFormat;o.dateFormat=i.noCalendar||r?"H:i"+(i.enableSeconds?":S":""):c+" H:i"+(i.enableSeconds?":S":"")}if(i.altInput&&(i.enableTime||r)&&!i.altFormat){var d=E.defaultConfig.altFormat||n.altFormat;o.altFormat=i.noCalendar||r?"h:i"+(i.enableSeconds?":S K":" K"):d+" h:i"+(i.enableSeconds?":S":"")+" K"}i.altInputClass||(h.config.altInputClass=h.input.className+" "+h.config.altInputClass),Object.defineProperty(h.config,"minDate",{get:function(){return h.config._minDate},set:oe("min")}),Object.defineProperty(h.config,"maxDate",{get:function(){return h.config._maxDate},set:oe("max")});var s=function(e){return function(t){h.config["min"===e?"_minTime":"_maxTime"]=h.parseDate(t,"H:i:S")}};Object.defineProperty(h.config,"minTime",{get:function(){return h.config._minTime},set:s("min")}),Object.defineProperty(h.config,"maxTime",{get:function(){return h.config._maxTime},set:s("max")}),"time"===i.mode&&(h.config.noCalendar=!0,h.config.enableTime=!0),Object.assign(h.config,o,i);for(var u=0;u<a.length;u++)h.config[a[u]]=!0===h.config[a[u]]||"true"===h.config[a[u]];t.filter(function(e){return void 0!==h.config[e]}).forEach(function(e){h.config[e]=l(h.config[e]||[]).map(y)}),h.isMobile=!h.config.disableMobile&&!h.config.inline&&"single"===h.config.mode&&!h.config.disable.length&&!h.config.enable.length&&!h.config.weekNumbers&&/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);for(u=0;u<h.config.plugins.length;u++){var m=h.config.plugins[u](h)||{};for(var p in m)t.indexOf(p)>-1?h.config[p]=l(m[p]).map(y).concat(h.config[p]):void 0===i[p]&&(h.config[p]=m[p])}ge("onParseConfig")}(),re(),h.input=h.config.wrap?f.querySelector("[data-input]"):f,h.input?(h.input._type=h.input.type,h.input.type="text",h.input.classList.add("flatpickr-input"),h._input=h.input,h.config.altInput&&(h.altInput=d(h.input.nodeName,h.config.altInputClass),h._input=h.altInput,h.altInput.placeholder=h.input.placeholder,h.altInput.disabled=h.input.disabled,h.altInput.required=h.input.required,h.altInput.tabIndex=h.input.tabIndex,h.altInput.type="text",h.input.setAttribute("type","hidden"),!h.config.static&&h.input.parentNode&&h.input.parentNode.insertBefore(h.altInput,h.input.nextSibling)),h.config.allowInput||h._input.setAttribute("readonly","readonly"),h._positionElement=h.config.positionElement||h._input):h.config.errorHandler(new Error("Invalid input element specified")),function(){h.selectedDates=[],h.now=h.parseDate(h.config.now)||new Date;var e=h.config.defaultDate||("INPUT"!==h.input.nodeName&&"TEXTAREA"!==h.input.nodeName||!h.input.placeholder||h.input.value!==h.input.placeholder?h.input.value:null);e&&fe(e,h.config.dateFormat),h._initialDate=h.selectedDates.length>0?h.selectedDates[0]:h.config.minDate&&h.config.minDate.getTime()>h.now.getTime()?h.config.minDate:h.config.maxDate&&h.config.maxDate.getTime()<h.now.getTime()?h.config.maxDate:h.now,h.currentYear=h._initialDate.getFullYear(),h.currentMonth=h._initialDate.getMonth(),h.selectedDates.length>0&&(h.latestSelectedDateObj=h.selectedDates[0]),void 0!==h.config.minTime&&(h.config.minTime=h.parseDate(h.config.minTime,"H:i")),void 0!==h.config.maxTime&&(h.config.maxTime=h.parseDate(h.config.maxTime,"H:i")),h.minDateHasTime=!!h.config.minDate&&(h.config.minDate.getHours()>0||h.config.minDate.getMinutes()>0||h.config.minDate.getSeconds()>0),h.maxDateHasTime=!!h.config.maxDate&&(h.config.maxDate.getHours()>0||h.config.maxDate.getMinutes()>0||h.config.maxDate.getSeconds()>0),Object.defineProperty(h,"showTimeInput",{get:function(){return h._showTimeInput},set:function(e){h._showTimeInput=e,h.calendarContainer&&c(h.calendarContainer,"showTimeInput",e),h.isOpen&&le()}})}(),h.utils={getDaysInMonth:function(e,t){return void 0===e&&(e=h.currentMonth),void 0===t&&(t=h.currentYear),1===e&&(t%4==0&&t%100!=0||t%400==0)?29:h.l10n.daysInMonth[e]}},h.isMobile||function(){var e=window.document.createDocumentFragment();if(h.calendarContainer=d("div","flatpickr-calendar"),h.calendarContainer.tabIndex=-1,!h.config.noCalendar){if(e.appendChild((h.monthNav=d("div","flatpickr-months"),h.yearElements=[],h.monthElements=[],h.prevMonthNav=d("span","flatpickr-prev-month"),h.prevMonthNav.innerHTML=h.config.prevArrow,h.nextMonthNav=d("span","flatpickr-next-month"),h.nextMonthNav.innerHTML=h.config.nextArrow,q(),Object.defineProperty(h,"_hidePrevMonthArrow",{get:function(){return h.__hidePrevMonthArrow},set:function(e){h.__hidePrevMonthArrow!==e&&(c(h.prevMonthNav,"flatpickr-disabled",e),h.__hidePrevMonthArrow=e)}}),Object.defineProperty(h,"_hideNextMonthArrow",{get:function(){return h.__hideNextMonthArrow},set:function(e){h.__hideNextMonthArrow!==e&&(c(h.nextMonthNav,"flatpickr-disabled",e),h.__hideNextMonthArrow=e)}}),h.currentYearElement=h.yearElements[0],ve(),h.monthNav)),h.innerContainer=d("div","flatpickr-innerContainer"),h.config.weekNumbers){var t=function(){h.calendarContainer.classList.add("hasWeeks");var e=d("div","flatpickr-weekwrapper");e.appendChild(d("span","flatpickr-weekday",h.l10n.weekAbbreviation));var t=d("div","flatpickr-weeks");return e.appendChild(t),{weekWrapper:e,weekNumbers:t}}(),n=t.weekWrapper,a=t.weekNumbers;h.innerContainer.appendChild(n),h.weekNumbers=a,h.weekWrapper=n}h.rContainer=d("div","flatpickr-rContainer"),h.rContainer.appendChild($()),h.daysContainer||(h.daysContainer=d("div","flatpickr-days"),h.daysContainer.tabIndex=-1),J(),h.rContainer.appendChild(h.daysContainer),h.innerContainer.appendChild(h.rContainer),e.appendChild(h.innerContainer)}h.config.enableTime&&e.appendChild(function(){h.calendarContainer.classList.add("hasTime"),h.config.noCalendar&&h.calendarContainer.classList.add("noCalendar"),h.timeContainer=d("div","flatpickr-time"),h.timeContainer.tabIndex=-1;var e=d("span","flatpickr-time-separator",":"),t=u("flatpickr-hour",{"aria-label":h.l10n.hourAriaLabel});h.hourElement=t.getElementsByTagName("input")[0];var n=u("flatpickr-minute",{"aria-label":h.l10n.minuteAriaLabel});if(h.minuteElement=n.getElementsByTagName("input")[0],h.hourElement.tabIndex=h.minuteElement.tabIndex=-1,h.hourElement.value=i(h.latestSelectedDateObj?h.latestSelectedDateObj.getHours():h.config.time_24hr?h.config.defaultHour:function(e){switch(e%24){case 0:case 12:return 12;default:return e%12}}(h.config.defaultHour)),h.minuteElement.value=i(h.latestSelectedDateObj?h.latestSelectedDateObj.getMinutes():h.config.defaultMinute),h.hourElement.setAttribute("step",h.config.hourIncrement.toString()),h.minuteElement.setAttribute("step",h.config.minuteIncrement.toString()),h.hourElement.setAttribute("min",h.config.time_24hr?"0":"1"),h.hourElement.setAttribute("max",h.config.time_24hr?"23":"12"),h.minuteElement.setAttribute("min","0"),h.minuteElement.setAttribute("max","59"),h.timeContainer.appendChild(t),h.timeContainer.appendChild(e),h.timeContainer.appendChild(n),h.config.time_24hr&&h.timeContainer.classList.add("time24hr"),h.config.enableSeconds){h.timeContainer.classList.add("hasSeconds");var a=u("flatpickr-second");h.secondElement=a.getElementsByTagName("input")[0],h.secondElement.value=i(h.latestSelectedDateObj?h.latestSelectedDateObj.getSeconds():h.config.defaultSeconds),h.secondElement.setAttribute("step",h.minuteElement.getAttribute("step")),h.secondElement.setAttribute("min","0"),h.secondElement.setAttribute("max","59"),h.timeContainer.appendChild(d("span","flatpickr-time-separator",":")),h.timeContainer.appendChild(a)}return h.config.time_24hr||(h.amPM=d("span","flatpickr-am-pm",h.l10n.amPM[o((h.latestSelectedDateObj?h.hourElement.value:h.config.defaultHour)>11)]),h.amPM.title=h.l10n.toggleTitle,h.amPM.tabIndex=-1,h.timeContainer.appendChild(h.amPM)),h.timeContainer}()),c(h.calendarContainer,"rangeMode","range"===h.config.mode),c(h.calendarContainer,"animate",!0===h.config.animate),c(h.calendarContainer,"multiMonth",h.config.showMonths>1),h.calendarContainer.appendChild(e);var r=void 0!==h.config.appendTo&&void 0!==h.config.appendTo.nodeType;if((h.config.inline||h.config.static)&&(h.calendarContainer.classList.add(h.config.inline?"inline":"static"),h.config.inline&&(!r&&h.element.parentNode?h.element.parentNode.insertBefore(h.calendarContainer,h._input.nextSibling):void 0!==h.config.appendTo&&h.config.appendTo.appendChild(h.calendarContainer)),h.config.static)){var l=d("div","flatpickr-wrapper");h.element.parentNode&&h.element.parentNode.insertBefore(l,h.element),l.appendChild(h.element),h.altInput&&l.appendChild(h.altInput),l.appendChild(h.calendarContainer)}h.config.static||h.config.inline||(void 0!==h.config.appendTo?h.config.appendTo:window.document.body).appendChild(h.calendarContainer)}(),function(){if(h.config.wrap&&["open","close","toggle","clear"].forEach(function(e){Array.prototype.forEach.call(h.element.querySelectorAll("[data-"+e+"]"),function(t){return F(t,"click",h[e])})}),h.isMobile)!function(){var e=h.config.enableTime?h.config.noCalendar?"time":"datetime-local":"date";h.mobileInput=d("input",h.input.className+" flatpickr-mobile"),h.mobileInput.step=h.input.getAttribute("step")||"any",h.mobileInput.tabIndex=1,h.mobileInput.type=e,h.mobileInput.disabled=h.input.disabled,h.mobileInput.required=h.input.required,h.mobileInput.placeholder=h.input.placeholder,h.mobileFormatStr="datetime-local"===e?"Y-m-d\\TH:i:S":"date"===e?"Y-m-d":"H:i:S",h.selectedDates.length>0&&(h.mobileInput.defaultValue=h.mobileInput.value=h.formatDate(h.selectedDates[0],h.mobileFormatStr)),h.config.minDate&&(h.mobileInput.min=h.formatDate(h.config.minDate,"Y-m-d")),h.config.maxDate&&(h.mobileInput.max=h.formatDate(h.config.maxDate,"Y-m-d")),h.input.type="hidden",void 0!==h.altInput&&(h.altInput.type="hidden");try{h.input.parentNode&&h.input.parentNode.insertBefore(h.mobileInput,h.input.nextSibling)}catch(e){}F(h.mobileInput,"change",function(e){h.setDate(e.target.value,!1,h.mobileFormatStr),ge("onChange"),ge("onClose")})}();else{var e=r(ae,50);h._debouncedChange=r(Y,M),h.daysContainer&&!/iPhone|iPad|iPod/i.test(navigator.userAgent)&&F(h.daysContainer,"mouseover",function(e){"range"===h.config.mode&&ne(e.target)}),F(window.document.body,"keydown",te),h.config.inline||h.config.static||F(window,"resize",e),void 0!==window.ontouchstart?F(window.document,"touchstart",Z):F(window.document,"mousedown",N(Z)),F(window.document,"focus",Z,{capture:!0}),!0===h.config.clickOpens&&(F(h._input,"focus",h.open),F(h._input,"mousedown",N(h.open))),void 0!==h.daysContainer&&(F(h.monthNav,"mousedown",N(be)),F(h.monthNav,["keyup","increment"],_),F(h.daysContainer,"mousedown",N(se))),void 0!==h.timeContainer&&void 0!==h.minuteElement&&void 0!==h.hourElement&&(F(h.timeContainer,["increment"],T),F(h.timeContainer,"blur",T,{capture:!0}),F(h.timeContainer,"mousedown",N(P)),F([h.hourElement,h.minuteElement],["focus","click"],function(e){return e.target.select()}),void 0!==h.secondElement&&F(h.secondElement,"focus",function(){return h.secondElement&&h.secondElement.select()}),void 0!==h.amPM&&F(h.amPM,"mousedown",N(function(e){T(e),Y()})))}}(),(h.selectedDates.length||h.config.noCalendar)&&(h.config.enableTime&&I(h.config.noCalendar?h.latestSelectedDateObj||h.config.minDate:void 0),we(!1)),x(),h.showTimeInput=h.selectedDates.length>0||h.config.noCalendar;var a=/^((?!chrome|android).)*safari/i.test(navigator.userAgent);!h.isMobile&&a&&le(),ge("onReady")}(),h}function x(e,t){for(var n=Array.prototype.slice.call(e).filter(function(e){return e instanceof HTMLElement}),a=[],i=0;i<n.length;i++){var o=n[i];try{if(null!==o.getAttribute("data-fp-omit"))continue;void 0!==o._flatpickr&&(o._flatpickr.destroy(),o._flatpickr=void 0),o._flatpickr=y(o,t||{}),a.push(o._flatpickr)}catch(e){console.error(e)}}return 1===a.length?a[0]:a}"undefined"!=typeof HTMLElement&&"undefined"!=typeof HTMLCollection&&"undefined"!=typeof NodeList&&(HTMLCollection.prototype.flatpickr=NodeList.prototype.flatpickr=function(e){return x(this,e)},HTMLElement.prototype.flatpickr=function(e){return x([this],e)});var E=function(e,t){return"string"==typeof e?x(window.document.querySelectorAll(e),t):e instanceof Node?x([e],t):x(e,t)};return E.defaultConfig={},E.l10ns={en:e({},a),default:e({},a)},E.localize=function(t){E.l10ns.default=e({},E.l10ns.default,t)},E.setDefaults=function(t){E.defaultConfig=e({},E.defaultConfig,t)},E.parseDate=D({}),E.formatDate=v({}),E.compareDates=w,"undefined"!=typeof jQuery&&void 0!==jQuery.fn&&(jQuery.fn.flatpickr=function(e){return x(this,e)}),Date.prototype.fp_incr=function(e){return new Date(this.getFullYear(),this.getMonth(),this.getDate()+("string"==typeof e?parseInt(e,10):e))},"undefined"!=typeof window&&(window.flatpickr=E),E});
"use strict";

/* global DocumentTouch */
var _prefLang = '';
var _lang = document.getElementsByTagName('html')[0].lang;
var _direction = _lang === 'ar' ? 'rtl' : 'ltr';

$(window).on('load', function () {
    if (feather) {
        feather.replace({
            width: 14
            , height: 14
        });
    }
})

jQuery.fn.serializeObject = function (i) {
    function e(i, t) {
        var a,
            r = t.splice(0, 1);
        return 0 === t.length
            ? a = i
            : i[r]
                ? a = e(i[r], t)
                : (i[r] = {}, a = e(i[r], t)),
            a;
    }

    var t = {},
        a = this.serializeArray(),
        r = this;
    return jQuery.each(a, function () {
        var a = this.name,
            s = t;
        if (i) {
            if (i[a]) {
                var n = i[a].split(".");
                s = e(t, n),
                    a = a.split(".").splice(-1, 1);
            }
        } else {
            if (-1 !== a.indexOf(".")) {
                var n = a.split(".");
                s = e(t, n),
                    a = a.split(".").splice(-1, 1);
            }
            var l = jQuery("*[name='" + this.name + "']", r).data("form-path");
            l && (s = e(s, [a, l]), a = l);
        }
        void 0 !== s[a]
            ? (s[a].push || (s[a] = [s[a]]), s[a].push(this.value || ""))
            : s[a] = this.value || "";
    }),
        t;
};

// Helpful Functions
function getBaseURL() {
    return jQuery("base:first", "head").length === 1 ? (jQuery("base:first", "head").attr("href") + '/') : '';
};

function gridLang() {
    return jQuery("base#grid-lang:first", "head").length === 1 ? (jQuery("#grid-lang:first", "head").attr("href") + '/') : '';
};

function getWebsiteBaseURL() {
    return jQuery("base#website-base", "head").length === 1 ? (jQuery("base#website-base", "head").attr("href") + '/') : '';
};

function avatarWrapper(value) {
    var $name = value.full_name,
        $email = value.email,
        $image = value.avatar,
        stateNum = Math.floor(Math.random() * 6),
        states = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'],
        $state = states[stateNum],
        $initials = $name.match(/\b\w/g) || [];
    $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
    if ($image) {
        // For Avatar image
        var $output =
            '<img  src="' + assetPath + 'images/avatars/' + $image + '" alt="Avatar" width="32" height="32">';
    } else {
        // For Avatar badge
        $output = '<div class="avatar-content">' + $initials + '</div>';
    }
    // Creates full output for row
    var colorClass = $image === '' ? ' bg-light-' + $state + ' ' : ' ';

    var $rowOutput =
        '<div class="d-flex justify-content-left align-items-center">' +
        '<div class="avatar-wrapper">' +
        '<div class="avatar' +
        colorClass +
        'mr-50">' +
        $output +
        '</div>' +
        '</div>' +
        '<div class="d-flex flex-column">' +
        '<h6 class="user-name text-truncate mb-0">' +
        $name +
        '</h6>' +
        '<small class="text-truncate text-muted">' +
        $email +
        '</small>' +
        '</div>' +
        '</div>';
    return $rowOutput;
};

function appendRowsTable(columns, data, $tableBody) {
    data.length ? $tableBody.html('') : $tableBody.html(`<tr><td colspan="${columns.length}" class="text-center"><i class="fa fa-exclamation-triangle"></i> No data to display</td></tr>`);
    for (var i = 0; i < data.length; i++) {
        var td;
        var tr = document.createElement('tr');
        for (var j = 0; j < columns.length; ++j) {
            td = document.createElement('td');
            if (['contact_number', 'phone1', 'phone2', 'mobile'].indexOf(columns[j]['name']) > -1) {
                td.classList.add('phone-number');
            }
            var val = data[i][columns[j]['name']];
            if (typeof columns[j]['name'] === 'object') {
                val = data[i][columns[j]['name'][0]];
                for (var k = 1; k < columns[j]['name'].length; ++k) {
                    val = val[columns[j]['name'][k]]
                }
            }
            td.innerHTML = formatValue(val, columns[j]['type'], columns[j]['pathFunc']);
            tr.appendChild(td);
        }
        $tableBody.append(tr);
    }
};

function buildSimplePagination(options) {
    onClick = window[options.onClick];
    columns = options.columns;
    var html = '';
    html += `<li class="page-item ${options.onFirstPage ? 'disabled' : ''}"><a href="javascript:;" onclick="onClick(columns, ${options.page - 1})" class="page-link">« Previous</a></li>`;
    html += `<li class="page-item ${options.hasMorePages ? '' : 'disabled'}"><a href="javascript:;" onclick="onClick(columns, ${options.page + 1})" class="page-link">» Next</a></li>`;
    options.widget.find('.pagination').html(html);
};

function formatValue(value, type, pathFunc = '') {
    switch (type) {
        case 'string':
            return jQuery.isEmptyObject(value) ? '-' : value;
        case 'ucword':
            return ucwords(value);
        case 'ucword_string':
            return jQuery.isEmptyObject(value) ? '-' : ucwords(value.replace('_', ' '));
        // case 'translated_string':
        //     return jQuery.isEmptyObject(value) ? '-' : Lang.get(`global.${value}`);
        case 'float':
            return number_format(value, 2);
        case 'positive':
            return value > 0 ? value : '-';
        case 'percent':
            return '%' + number_format(value, 2);
        case 'money':
            return number_format(value, 3);
        case 'number':
            return number_format(value, 0);
        case 'date':
            return jQuery.isEmptyObject(value) || value === undefined ? '-' : date('M j, Y', strtotime(value));
        case 'datetime':
            return jQuery.isEmptyObject(value) || value === undefined ? '-' : date('j M Y g:i A', strtotime(value));
        case 'boolean':
            return value ? 'Yes' : 'No';
        case 'link':
            return `<a href="${value}" target="_blank"><i class="fas fa-2x fa-link"></i></a>`;
        case 'avatar':
            return `<img src="${value}" class="img-thumbnail img-circle img-md image-thumbnail">`;
        case 'details_link':
            return `<a href="javascript:;" class="custom-details-link" data-value="${value}">${value}</a>`;
        case 'document':
            return `<a href="${window[pathFunc](value)}" target="_blank"><i class="fas fa-2x fa-download"></i></a>`;
        case 'json':
            var json = value;
            try {
                json = JSON.stringify(value).replace(/\\n/g, "")
                    .replace(/\\/g, "")
                    .replace(/\\&/g, "")
                    .replace(/\\r/g, "")
                    .replace(/\\t/g, "")
                    .replace(/\\b/g, "")
                    .replace(/\\f/g, "");
            } catch (e) {
            }
            return jQuery.isEmptyObject(value) ? '-' : `<code>${json}</code>`;
        default:
            return value;
    }
};

function changeGridLangPreference(keyValue, keyName, $el, dataTablesReload = false) {
    jQuery.ajax({
        url: getBaseURL() + "user_preferences",
        data: {
            'key': keyName,
            'value': keyValue,
        },
        dataType: "JSON",
        type: "POST",
        beforeSend: function () {
            $el.attr('disabled', true);
            $el.addClass('disabled');
        },
        complete: function () {
            $el.attr('disabled', false);
            $el.removeClass('disabled');
        },
        success: function () {
            if (dataTablesReload) {
                _prefLang = keyValue;
                reloadDataGrid();
                jQuery('.grid-heading .lang-text').html(keyValue.toUpperCase())
                jQuery('.grid-heading .lang-icon').attr('class', 'lang-icon mr-25 flag-icon flag-icon-' + keyValue)
            } else {
                location.reload();
            }
        },
        error: HandleJsonErrors
    });
}

function isTouchDevice() {
    return true === ("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch);
};

function isEmpty(str) {
    return str ? (str.length === 0 || !str.trim()) : true;
};

function validateEmail(mail, notify) {
    if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(mail)) {
        return (true)
    }
    let _notify = notify === undefined ? true : notify;
    if (_notify) {
        console.log(_notify);
        toastr.warning(Lang.get('global.must_be_a_valid_email_address'), 400);
    }
    return (false)
}

function formatDate(str) {
    return jQuery.isEmptyObject(str) ? '-' : (str.length > 12 ? str.substring(0, str.length - 9) : str);
};

function substring(str, $limiter = 40) {
    return str.length > $limiter ? str.substring(0, $limiter) + '...' : str;
}

function HandleJsonErrors(xhr, errorThrown) {
    var _message = '';
    switch (xhr.status) {
        case 400:
            if (typeof xhr.responseJSON.message === 'string') {
                toastr.error(xhr.responseJSON.message, 400);
            }
            if (typeof xhr.responseJSON.message === 'object') {
                _message = '<div class="text-left">';
                for (var i in xhr.responseJSON.message) {
                    _message += xhr.responseJSON.message[i];
                }
                _message += '</div>';

                toastr.error(_message, '400', {
                    timeOut: 3000
                });
            }
            break;
        case 401:
            toastr.warning(xhr.responseJSON.message, '401');
            if (window.location.pathname !== '/login') {
                setTimeout(function () {
                    window.location = getBaseURL() + 'login';
                }, 1500);
            }
            break;
        case 403:
            toastr.error(xhr.responseJSON.message, '403');
            break;
        case 404:
            toastr.error(xhr.responseJSON.message, '404');
            break;
        case 406:
            toastr.warning(xhr.responseJSON.message, '406');
            break;
        case 422:
            _message = '<div class="text-left">';
            for (var i in xhr.responseJSON.errors) {
                _message += xhr.responseJSON.errors[i];
            }
            _message += '</div>';

            toastr.error(_message, '422', {
                timeOut: 5000
            });
            break;
        case 451:
            toastr.error(xhr.responseJSON.message, '451');
            break;
        case 500:
            toastr.error(xhr.responseJSON.message, '500');
            break;
        default:
            toastr.error('Something went wrong: ' + errorThrown, 'Oops..');
    }
    return false;
};

// Dialog Button Loading/Reset On Action
function btnLoading($this) {
    var $originalText = $this.html();
    $this.attr('data-original-text', $originalText)
        .attr('data-loading-text', ($originalText + ' ' + "<i class='fa fa-spinner fa-spin'></i>"))
        .prop('disabled', true)
        .html($this.data('loadingText'));
};

function btnReset($this) {
    $this.html($this.data('originalText'))
        .prop('disabled', false);
    $this.unbind();
};

function ucwords(str) {
    return (str + '').replace(/-/g, ' ').replace(/_/g, ' ').replace(/^(.)|\s+(.)/g, function ($1) {
        return $1.toUpperCase();
    });
};

function array_merge() {
    var args = Array.prototype.slice.call(arguments);
    var argl = args.length;
    var arg;
    var retObj = {};
    var k = '';
    var argil = 0;
    var j = 0;
    var i = 0;
    var ct = 0;
    var toStr = Object.prototype.toString;
    var retArr = true;
    for (i = 0; i < argl; i++) {
        if (toStr.call(args[i]) !== '[object Array]') {
            retArr = false;
            break
        }
    }
    if (retArr) {
        retArr = [];
        for (i = 0; i < argl; i++) {
            retArr = retArr.concat(args[i]);
        }
        return retArr;
    }
    for (i = 0, ct = 0; i < argl; i++) {
        arg = args[i];
        if (toStr.call(arg) === '[object Array]') {
            for (j = 0, argil = arg.length; j < argil; j++) {
                retObj[ct++] = arg[j];
            }
        } else {
            for (k in arg) {
                if (arg.hasOwnProperty(k)) {
                    if (parseInt(k, 10) + '' === k) {
                        retObj[ct++] = arg[k];
                    } else {
                        retObj[k] = arg[k];
                    }
                }
            }
        }
    }
    return retObj;
};

function number_format(number, decimals, decPoint, thousandsSep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ?
        0 :
        +number;
    var prec = !isFinite(+decimals) ?
        0 :
        Math.abs(decimals);
    var sep = (typeof thousandsSep === 'undefined') ?
        ',' :
        thousandsSep;
    var dec = (typeof decPoint === 'undefined') ?
        '.' :
        decPoint;
    var s = '';
    var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec);
        return '' + (
            Math.round(n * k) / k).toFixed(prec);
    };
    s = (
        prec ?
            toFixedFix(n, prec) :
            '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
};

function copyToClipboard(text) {
    const el = document.createElement('textarea');
    el.value = text;
    el.setAttribute('readonly', '');
    el.style.position = 'absolute';
    el.style.left = '-9999px';
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
    toastr.info('', 'Copied!');
};

function date(format, timestamp) {
    var jsdate,
        f;
    var txtWordsEn = [
        'Sun',
        'Mon',
        'Tues',
        'Wednes',
        'Thurs',
        'Fri',
        'Satur',
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];
    var txtWordsTr = [
        'Pazar',
        'Pazartesi',
        'Salı',
        'Çarşamba',
        'Perşembe',
        'Cuma',
        'Cumartesi',
        'Ocak',
        'Şubat',
        'Mart',
        'Nisan',
        'Mayıs',
        'Haziran',
        'Temmuz',
        'Ağustos',
        'Eylül',
        'Ekim',
        'Kasım',
        'Aralık'
    ];
    var txtWordsAr = [
        'أحد',
        'الاثنين',
        'الثلاثاء',
        'الأربعاء',
        'الخميس',
        'الجمعة',
        'السبت',
        'كانون الثاني',
        'شباط',
        'آذار',
        'نيسان',
        'أيار',
        'حزيران',
        'تموز',
        'آب',
        'أيلول',
        'تشرين الأول',
        'تشرين الثاني',
        'كانون الأول'
    ];
    var txtWords = _lang === 'ar'
        ? txtWordsAr
        : (
            _lang === 'en'
                ? txtWordsEn
                : txtWordsTr);
    var formatChr = /\\?(.?)/gi;
    var formatChrCb = function (t, s) {
        return f[t]
            ? f[t]()
            : s;
    };
    var _pad = function (n, c) {
        n = String(n);
        while (n.length < c) {
            n = '0' + n;
        }
        return n;
    };
    f = {
        d: function () {
            return _pad(f.j(), 2);
        },
        D: function () {
            return f.l().slice(0, 3);
        },
        j: function () {
            return jsdate.getDate();
        },
        l: function () {
            return txtWords[f.w()] + (
                _lang === 'ar'
                    ? 'يوم'
                    : (
                        _lang === 'en'
                            ? 'day'
                            : 'gün'));
        },
        N: function () {
            return f.w() || 7;
        },
        S: function () {
            var j = f.j();
            var i = j % 10;
            if (i <= 3 && parseInt((j % 100) / 10, 10) === 1) {
                i = 0;
            }
            return ['st', 'nd', 'rd'][i - 1] || 'th';
        },
        w: function () {
            return jsdate.getDay();
        },
        z: function () {
            var a = new Date(f.Y(), f.n() - 1, f.j());
            var b = new Date(f.Y(), 0, 1);
            return Math.round((a - b) / 864e5);
        },
        W: function () {
            var a = new Date(f.Y(), f.n() - 1, f.j() - f.N() + 3);
            var b = new Date(a.getFullYear(), 0, 4);
            return _pad(1 + Math.round((a - b) / 864e5 / 7), 2);
        },
        F: function () {
            return txtWords[6 + f.n()];
        },
        m: function () {
            return _pad(f.n(), 2);
        },
        M: function () {
            return _lang === 'ar'
                ? f.F()
                : f.F().slice(0, 3);
        },
        n: function () {
            return jsdate.getMonth() + 1;
        },
        t: function () {
            return (new Date(f.Y(), f.n(), 0)).getDate();
        },
        L: function () {
            var j = f.Y();
            return j % 4 === 0 & j % 100 !== 0 | j % 400 === 0;
        },
        o: function () {
            var n = f.n();
            var W = f.W();
            var Y = f.Y();
            return Y + (
                n === 12 && W < 9
                    ? 1
                    : n === 1 && W > 9
                        ? -1
                        : 0);
        },
        Y: function () {
            return jsdate.getFullYear();
        },
        y: function () {
            return f.Y().toString().slice(-2);
        },
        a: function () {
            return jsdate.getHours() > 11
                ? (
                    _lang === 'ar'
                        ? 'م'
                        : 'pm')
                : (
                    _lang === 'ar'
                        ? 'ص'
                        : 'am');
        },
        A: function () {
            return f.a().toUpperCase();
        },
        B: function () {
            var H = jsdate.getUTCHours() * 36e2;
            var i = jsdate.getUTCMinutes() * 60;
            var s = jsdate.getUTCSeconds();
            return _pad(Math.floor((H + i + s + 36e2) / 86.4) % 1e3, 3);
        },
        g: function () {
            return f.G() % 12 || 12;
        },
        G: function () {
            return jsdate.getHours();
        },
        h: function () {
            return _pad(f.g(), 2);
        },
        H: function () {
            return _pad(f.G(), 2);
        },
        i: function () {
            return _pad(jsdate.getMinutes(), 2);
        },
        s: function () {
            return _pad(jsdate.getSeconds(), 2);
        },
        u: function () {
            return _pad(jsdate.getMilliseconds() * 1000, 6);
        },
        e: function () {
            var msg = 'Not supported (see source code of date() for timezone on how to add support)';
            throw new Error(msg);
        },
        I: function () {
            var a = new Date(f.Y(), 0);
            var c = Date.UTC(f.Y(), 0);
            var b = new Date(f.Y(), 6);
            var d = Date.UTC(f.Y(), 6);
            return ((a - c) !== (b - d))
                ? 1
                : 0;
        },
        O: function () {
            var tzo = jsdate.getTimezoneOffset();
            var a = Math.abs(tzo);
            return (
                tzo > 0
                    ? '-'
                    : '+') + _pad(Math.floor(a / 60) * 100 + a % 60, 4);
        },
        P: function () {
            var O = f.O();
            return (O.substr(0, 3) + ':' + O.substr(3, 2));
        },
        T: function () {
            return 'UTC';
        },
        Z: function () {
            return -jsdate.getTimezoneOffset() * 60;
        },
        c: function () {
            return 'Y-m-d\\TH:i:sP'.replace(formatChr, formatChrCb);
        },
        r: function () {
            return 'D, d M Y H:i:s O'.replace(formatChr, formatChrCb);
        },
        U: function () {
            return jsdate / 1000 | 0;
        }
    };
    var _date = function (format, timestamp) {
        jsdate = (timestamp === undefined ? new Date() // Not provided
            : (timestamp instanceof Date) ? new Date(timestamp) // JS Date()
                : new Date(timestamp * 1000) // UNIX timestamp (auto-convert to int)
        );
        return format.replace(formatChr, formatChrCb);
    };
    return _date(format, timestamp);
};
function strtotime(text, now) {
    var parsed;
    var match;
    var today;
    var year;
    var date;
    var days;
    var ranges;
    var len;
    var times;
    var regex;
    var i;
    var fail = false;
    if (!text) {
        return fail;
    }
    text = text.replace(/^\s+|\s+$/g, '').replace(/\s{2,}/g, ' ').replace(/[\t\r\n]/g, '').toLowerCase();
    var pattern = new RegExp([
        '^(\\d{1,4})',
        '([\\-\\.\\/:])',
        '(\\d{1,2})',
        '([\\-\\.\\/:])',
        '(\\d{1,4})',
        '(?:\\s(\\d{1,2}):(\\d{2})?:?(\\d{2})?)?',
        '(?:\\s([A-Z]+)?)?$'
    ].join(''));
    match = text.match(pattern);
    if (match && match[2] === match[4]) {
        if (match[1] > 1901) {
            switch (match[2]) {
                case '-':
                    // YYYY-M-D
                    if (match[3] > 12 || match[5] > 31) {
                        return fail;
                    }
                    return new Date(match[1], parseInt(match[3], 10) - 1, match[5], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
                case '.':
                    // YYYY.M.D is not parsed by strtotime()
                    return fail;
                case '/':
                    // YYYY/M/D
                    if (match[3] > 12 || match[5] > 31) {
                        return fail;
                    }
                    return new Date(match[1], parseInt(match[3], 10) - 1, match[5], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
            }
        } else if (match[5] > 1901) {
            switch (match[2]) {
                case '-':
                    // D-M-YYYY
                    if (match[3] > 12 || match[1] > 31) {
                        return fail;
                    }
                    return new Date(match[5], parseInt(match[3], 10) - 1, match[1], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
                case '.':
                    // D.M.YYYY
                    if (match[3] > 12 || match[1] > 31) {
                        return fail;
                    }
                    return new Date(match[5], parseInt(match[3], 10) - 1, match[1], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
                case '/':
                    // M/D/YYYY
                    if (match[1] > 12 || match[3] > 31) {
                        return fail;
                    }
                    return new Date(match[5], parseInt(match[1], 10) - 1, match[3], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
            }
        } else {
            switch (match[2]) {
                case '-':
                    // YY-M-D
                    if (match[3] > 12 || match[5] > 31 || (match[1] < 70 && match[1] > 38)) {
                        return fail;
                    }
                    year = match[1] >= 0 && match[1] <= 38
                        ? +match[1] + 2000
                        : match[1];
                    return new Date(year, parseInt(match[3], 10) - 1, match[5], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
                case '.':
                    // D.M.YY or H.MM.SS
                    if (match[5] >= 70) {
                        // D.M.YY
                        if (match[3] > 12 || match[1] > 31) {
                            return fail;
                        }
                        return new Date(match[5], parseInt(match[3], 10) - 1, match[1], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
                    }
                    if (match[5] < 60 && !match[6]) {
                        // H.MM.SS
                        if (match[1] > 23 || match[3] > 59) {
                            return fail;
                        }
                        today = new Date();
                        return new Date(today.getFullYear(), today.getMonth(), today.getDate(), match[1] || 0, match[3] || 0, match[5] || 0, match[9] || 0) / 1000;
                    }
                    // invalid format, cannot be parsed
                    return fail;
                case '/':
                    // M/D/YY
                    if (match[1] > 12 || match[3] > 31 || (match[5] < 70 && match[5] > 38)) {
                        return fail;
                    }
                    year = match[5] >= 0 && match[5] <= 38
                        ? +match[5] + 2000
                        : match[5];
                    return new Date(year, parseInt(match[1], 10) - 1, match[3], match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
                case ':':
                    // HH:MM:SS
                    if (match[1] > 23 || match[3] > 59 || match[5] > 59) {
                        return fail;
                    }
                    today = new Date();
                    return new Date(today.getFullYear(), today.getMonth(), today.getDate(), match[1] || 0, match[3] || 0, match[5] || 0) / 1000;
            }
        }
    }
    // other formats and "now" should be parsed by Date.parse()
    if (text === 'now') {
        return now === null || isNaN(now)
            ? new Date().getTime() / 1000 | 0
            : now | 0;
    }
    if (!isNaN(parsed = Date.parse(text))) {
        return parsed / 1000 | 0;
    }
    // Browsers !== Chrome have problems parsing ISO 8601 date strings, as they do
    // not accept lower case characters, space, or shortened time zones.
    // Therefore, fix these problems and try again.
    // Examples:
    //   2015-04-15 20:33:59+02
    //   2015-04-15 20:33:59z
    //   2015-04-15t20:33:59+02:00
    pattern = new RegExp(['^([0-9]{4}-[0-9]{2}-[0-9]{2})', '[ t]', '([0-9]{2}:[0-9]{2}:[0-9]{2}(\\.[0-9]+)?)', '([\\+-][0-9]{2}(:[0-9]{2})?|z)'].join(''));
    match = text.match(pattern);
    if (match) {
        // @todo: time zone information
        if (match[4] === 'z') {
            match[4] = 'Z';
        } else if (match[4].match(/^([+-][0-9]{2})$/)) {
            match[4] = match[4] + ':00';
        }
        if (!isNaN(parsed = Date.parse(match[1] + 'T' + match[2] + match[4]))) {
            return parsed / 1000 | 0;
        }
    }
    date = now
        ? new Date(now * 1000)
        : new Date();
    days = {
        'sun': 0,
        'mon': 1,
        'tue': 2,
        'wed': 3,
        'thu': 4,
        'fri': 5,
        'sat': 6
    };
    ranges = {
        'yea': 'FullYear',
        'mon': 'Month',
        'day': 'Date',
        'hou': 'Hours',
        'min': 'Minutes',
        'sec': 'Seconds'
    };

    function lastNext(type, range, modifier) {
        var diff;
        var day = days[range];
        if (typeof day !== 'undefined') {
            diff = day - date.getDay();
            if (diff === 0) {
                diff = 7 * modifier;
            } else if (diff > 0 && type === 'last') {
                diff -= 7;
            } else if (diff < 0 && type === 'next') {
                diff += 7;
            }
            date.setDate(date.getDate() + diff);
        }
    }

    function process(val) {
        var splt = val.split(' ');
        var type = splt[0];
        var range = splt[1].substring(0, 3);
        var typeIsNumber = /\d+/.test(type);
        var ago = splt[2] === 'ago';
        var num = (
            type === 'last'
                ? -1
                : 1) * (
                ago
                    ? -1
                    : 1);
        if (typeIsNumber) {
            num *= parseInt(type, 10);
        }
        if (ranges.hasOwnProperty(range) && !splt[1].match(/^mon(day|\.)?$/i)) {
            return date['set' + ranges[range]](date['get' + ranges[range]]() + num);
        }
        if (range === 'wee') {
            return date.setDate(date.getDate() + (num * 7));
        }
        if (type === 'next' || type === 'last') {
            lastNext(type, range, num);
        } else if (!typeIsNumber) {
            return false;
        }
        return true;
    }

    times = '(years?|months?|weeks?|days?|hours?|minutes?|min|seconds?|sec' + '|sunday|sun\\.?|monday|mon\\.?|tuesday|tue\\.?|wednesday|wed\\.?' + '|thursday|thu\\.?|friday|fri\\.?|saturday|sat\\.?)';
    regex = '([+-]?\\d+\\s' + times + '|' + '(last|next)\\s' + times + ')(\\sago)?';
    match = text.match(new RegExp(regex, 'gi'));
    if (!match) {
        return fail;
    }
    for (i = 0, len = match.length; i < len; i++) {
        if (!process(match[i])) {
            return fail;
        }
    }
    return (date.getTime() / 1000);
};

// Select2
// (function () {
//     if (jQuery && jQuery.fn && jQuery.fn.select2 && jQuery.fn.select2.amd)
//         var e = jQuery.fn.select2.amd;
//     return e.define("select2/i18n/tr", [], function () {
//         return {
//             inputTooLong: function (e) {
//                 var t = e.input.length - e.maximum,
//                     n = t + " karakter daha girmelisiniz";
//                 return n;
//             },
//             inputTooShort: function (e) {
//                 var t = e.minimum - e.input.length,
//                     n = "En az " + t + " karakter daha girmelisiniz";
//                 return n;
//             },
//             loadingMore: function () {
//                 return "Daha fazla…";
//             },
//             maximumSelected: function (e) {
//                 var t = "Sadece " + e.maximum + " seçim yapabilirsiniz";
//                 return t;
//             },
//             noResults: function () {
//                 return "Sonuç bulunamadı";
//             },
//             searching: function () {
//                 return "Aranıyor…";
//             }
//         }
//     }), {
//         define: e.define,
//         require: e.require
//     }
// })();
// (function () {
//     if (jQuery && jQuery.fn && jQuery.fn.select2 && jQuery.fn.select2.amd)
//         var e = jQuery.fn.select2.amd;
//     return e.define("select2/i18n/ar", [], function () {
//         return {
//             errorLoading: function () {
//                 return "لا يمكن تحميل النتائج";
//             },
//             inputTooLong: function (e) {
//                 var t = e.input.length - e.maximum,
//                     n = "الرجاء حذف " + (
//                         t === 1
//                             ? ("حرف ")
//                             : (
//                                 t === 2
//                                     ? "حرفين "
//                                     : (t + " أحرف")));
//                 return n;
//             },
//             inputTooShort: function (e) {
//                 var t = e.minimum - e.input.length,
//                     n = "الرجاء إضافة " + (
//                         t === 1
//                             ? ("حرف ")
//                             : (
//                                 t === 2
//                                     ? "حرفين "
//                                     : (t + " أحرف")));
//                 return n;
//             },
//             loadingMore: function () {
//                 return "جاري تحميل نتائج إضافية...";
//             },
//             maximumSelected: function (e) {
//                 var t = "تستطيع إختيار " + e.maximum + " بنود فقط";
//                 return t;
//             },
//             noResults: function () {
//                 return "لم يتم العثور على أي نتائج";
//             },
//             searching: function () {
//                 return "جاري البحث…";
//             }
//         }
//     }), {
//         define: e.define,
//         require: e.require
//     }
// })();
// !! Libraries Translations !!

function resetForm(selector) {
    let $form = jQuery(selector);
    $form[0].reset();
    $form.find('input:not([type="hidden"])').val('');
    $form.find('textarea').val('');
    $form.find('.select, .autocomplete').val('').trigger('change.select2');
};

function noDataTemplate() {
    return `<div class="no-data-to-display">
    <i class="fa fa-exclamation-triangle mb-2"></i>
    <br>
    ${Lang.get('global.no_data_to_display')}
    </div>`;
}

// DOM
jQuery(function () {
    // $('.select').select2({
    //     width: '100%'
    // });

    // Prevent Double Submits
    document.querySelectorAll('form').forEach(form => {
        if (form.classList.contains('non-ajax-form')) {
            form.addEventListener('submit', (e) => {
                // Prevent if already submitting
                if (form.classList.contains('is-submitting')) {
                    e.preventDefault();
                }
                // Add class to hook our visual indicator on
                form.classList.add('is-submitting');
                if (jQuery('form.is-submitting .btn[type="submit"]').length) {
                    btnLoading(jQuery('form.is-submitting .btn[type="submit"]'));
                }
            });
        }
    });

    if (jQuery('[data-toggle="tooltip"]').length) {
        jQuery('[data-toggle="tooltip"]').tooltip();
    }

    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    if (isTouchDevice() === true) {
        jQuery("[data-toggle='tooltip']").tooltip('disable');
    }

    var url = window.location.pathname.split('/');
    var $activeLink = jQuery('ul.nav-pills.nav-sidebar a[urls*="' + url[1] + '"]');
    $activeLink.parent().addClass('active');

    jQuery('.dropdown-notification').on('click', function () {
        jQuery('.dropdown-menu .scrollable-container').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
        jQuery.ajax({
            type: 'GET',
            url: getBaseURL() + 'notifications',
            success(xhr) {
                jQuery('.dropdown-menu .overlay').remove();
                // jQuery('.notification-badge').text(xhr.count);
                jQuery('.notification-badge').hide();
                jQuery('.clear-notifications').attr('disabled', true);
                if (xhr.notifications.data.length > 0) {
                    jQuery('.clear-notifications').attr('disabled', false);
                    jQuery('.dropdown-menu .scrollable-container').html('');
                    for (let i = 0; i < xhr.notifications.data.length; i++) {
                        jQuery('.dropdown-menu .scrollable-container').append(`
                          <a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                              <div class="media-body">
                                <p class="media-heading">${xhr.notifications.data[i].data.message ? xhr.notifications.data[i].data.message : ''}</p>
                                <small class="notification-text">${date('d-m-Y g:i A', strtotime(xhr.notifications.data[i].created_at))}</small>
                              </div>
                            </div>
                          </a>`)
                    }
                }
            }
        });
    });

    jQuery('.clear-notifications').on('click', function () {
        if (window.confirm('Clear all notifications?')) {
            jQuery('.dropdown-menu .scrollable-container').append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
            jQuery.ajax({
                url: getBaseURL() + 'notifications/delete_all',
                dataType: "JSON",
                type: "POST",
                data: {
                    '_method': 'DELETE'
                },
                beforeSend: function () {
                },
                success: function () {
                    jQuery('.dropdown-menu .scrollable-container').html('<p class="text-center my-2">No Notifications</p>');
                    jQuery('.dropdown-menu .overlay').remove();
                    jQuery('.new-notifications-badge').hide();
                },
                error: HandleJsonErrors,
            });
        }
    });

    jQuery.fn.inputFilter = function (inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
        });
    };

    if (jQuery("input.numeric").length) {
        jQuery("input.numeric").inputFilter(function (value) {
            return /^(\d+(\.\d*)?)?$/.test(value);
        });
    }

    if (jQuery("input.money").length) {
        jQuery("input.money").inputFilter(function (value) {
            return /^(\d+(\.\d{0,2})?)?$/.test(value);
        });
    }

    if (jQuery("input.phone").length) {
        jQuery("input.phone").inputFilter(function (value) {
            return /^([1-9]\d*)?$/.test(value);
        });
    }

    if (jQuery("input.percentage").length) {
        jQuery("input.percentage").inputFilter(function (value) {
            return /^(\d{1,2}(\.\d{0,2})?|100(\.0{0,2})?)?$/.test(value);
        });
    }
});