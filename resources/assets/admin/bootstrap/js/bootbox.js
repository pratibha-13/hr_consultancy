!function(t,o){"use strict";"function"==typeof define&&define.amd?define(["jquery"],o):"object"==typeof exports?module.exports=o(require("jquery")):t.bootbox=o(t.jQuery)}(this,function t(o,e){"use strict";var a={dialog:"<div class='bootbox modal' tabindex='-1' role='dialog'><div class='modal-dialog'><div class='modal-content'><div class='modal-body'><div class='bootbox-body'></div></div></div></div></div>",header:"<div class='modal-header'><h4 class='modal-title'></h4></div>",footer:"<div class='modal-footer'></div>",closeButton:"<button type='button' class='bootbox-close-button close' data-dismiss='modal' aria-hidden='true'>&times;</button>",form:"<form class='bootbox-form'></form>",inputs:{text:"<input class='bootbox-input bootbox-input-text form-control' autocomplete=off type=text />",textarea:"<textarea class='bootbox-input bootbox-input-textarea form-control'></textarea>",email:"<input class='bootbox-input bootbox-input-email form-control' autocomplete='off' type='email' />",select:"<select class='bootbox-input bootbox-input-select form-control'></select>",checkbox:"<div class='checkbox'><label><input class='bootbox-input bootbox-input-checkbox' type='checkbox' /></label></div>",date:"<input class='bootbox-input bootbox-input-date form-control' autocomplete=off type='date' />",time:"<input class='bootbox-input bootbox-input-time form-control' autocomplete=off type='time' />",number:"<input class='bootbox-input bootbox-input-number form-control' autocomplete=off type='number' />",password:"<input class='bootbox-input bootbox-input-password form-control' autocomplete='off' type='password' />"}},n={locale:"en",backdrop:"static",animate:!0,className:null,closeButton:!0,show:!0,container:"body"},r={};function l(t,e,a){t.stopPropagation(),t.preventDefault(),o.isFunction(a)&&!1===a.call(e,t)||e.modal("hide")}function i(t,e){var a=0;o.each(t,function(t,o){e(t,o,a++)})}function c(t,e,a){return o.extend(!0,{},t,function(t,o){var e=t.length,a={};if(e<1||e>2)throw new Error("Invalid argument length");return 2===e||"string"==typeof t[0]?(a[o[0]]=t[0],a[o[1]]=t[1]):a=t[0],a}(e,a))}function s(t,o,e,a){return p(c({className:"bootbox-"+t,buttons:u.apply(null,o)},a,e),o)}function u(){for(var t,o,e={},a=0,r=arguments.length;a<r;a++){var l=arguments[a],i=l.toLowerCase(),c=l.toUpperCase();e[i]={label:(t=c,void 0,o=b[n.locale],o?o[t]:b.en[t])}}return e}function p(t,o){var a={};return i(o,function(t,o){a[o]=!0}),i(t.buttons,function(t){if(a[t]===e)throw new Error("button key "+t+" is not allowed (options are "+o.join("\n")+")")}),t}r.alert=function(){var t;if((t=s("alert",["ok"],["message","callback"],arguments)).callback&&!o.isFunction(t.callback))throw new Error("alert requires callback property to be a function when provided");return t.buttons.ok.callback=t.onEscape=function(){return!o.isFunction(t.callback)||t.callback.call(this)},r.dialog(t)},r.confirm=function(){var t;if((t=s("confirm",["cancel","confirm"],["message","callback"],arguments)).buttons.cancel.callback=t.onEscape=function(){return t.callback.call(this,!1)},t.buttons.confirm.callback=function(){return t.callback.call(this,!0)},!o.isFunction(t.callback))throw new Error("confirm requires a callback");return r.dialog(t)},r.prompt=function(){var t,n,l,s,b,d,f;if(s=o(a.form),n={className:"bootbox-prompt",buttons:u("cancel","confirm"),value:"",inputType:"text"},d=(t=p(c(n,arguments,["title","callback"]),["cancel","confirm"])).show===e||t.show,t.message=s,t.buttons.cancel.callback=t.onEscape=function(){return t.callback.call(this,null)},t.buttons.confirm.callback=function(){var e;switch(t.inputType){case"text":case"textarea":case"email":case"select":case"date":case"time":case"number":case"password":e=b.val();break;case"checkbox":var a=b.find("input:checked");e=[],i(a,function(t,a){e.push(o(a).val())})}return t.callback.call(this,e)},t.show=!1,!t.title)throw new Error("prompt requires a title");if(!o.isFunction(t.callback))throw new Error("prompt requires a callback");if(!a.inputs[t.inputType])throw new Error("invalid prompt type");switch(b=o(a.inputs[t.inputType]),t.inputType){case"text":case"textarea":case"email":case"date":case"time":case"number":case"password":b.val(t.value);break;case"select":var m={};if(f=t.inputOptions||[],!o.isArray(f))throw new Error("Please pass an array of input options");if(!f.length)throw new Error("prompt with select requires options");i(f,function(t,a){var n=b;if(a.value===e||a.text===e)throw new Error("given options in wrong format");a.group&&(m[a.group]||(m[a.group]=o("<optgroup/>").attr("label",a.group)),n=m[a.group]),n.append("<option value='"+a.value+"'>"+a.text+"</option>")}),i(m,function(t,o){b.append(o)}),b.val(t.value);break;case"checkbox":var C=o.isArray(t.value)?t.value:[t.value];if(!(f=t.inputOptions||[]).length)throw new Error("prompt with checkbox requires options");if(!f[0].value||!f[0].text)throw new Error("given options in wrong format");b=o("<div/>"),i(f,function(e,n){var r=o(a.inputs[t.inputType]);r.find("input").attr("value",n.value),r.find("label").append(n.text),i(C,function(t,o){o===n.value&&r.find("input").prop("checked",!0)}),b.append(r)})}return t.placeholder&&b.attr("placeholder",t.placeholder),t.pattern&&b.attr("pattern",t.pattern),t.maxlength&&b.attr("maxlength",t.maxlength),s.append(b),s.on("submit",function(t){t.preventDefault(),t.stopPropagation(),l.find(".btn-primary").click()}),(l=r.dialog(t)).off("shown.bs.modal"),l.on("shown.bs.modal",function(){b.focus()}),!0===d&&l.modal("show"),l},r.dialog=function(t){t=function(t){var e,a;if("object"!=typeof t)throw new Error("Please supply an object of options");if(!t.message)throw new Error("Please specify a message");return(t=o.extend({},n,t)).buttons||(t.buttons={}),e=t.buttons,a=function(t){var o,e=0;for(o in t)e++;return e}(e),i(e,function(t,n,r){if(o.isFunction(n)&&(n=e[t]={callback:n}),"object"!==o.type(n))throw new Error("button with key "+t+" must be an object");n.label||(n.label=t),n.className||(n.className=a<=2&&r===a-1?"btn-primary":"btn-default")}),t}(t);var r=o(a.dialog),c=r.find(".modal-dialog"),s=r.find(".modal-body"),u=t.buttons,p="",b={onEscape:t.onEscape};if(o.fn.modal===e)throw new Error("$.fn.modal is not defined; please double check you have included the Bootstrap JavaScript library. See http://getbootstrap.com/javascript/ for more details.");if(i(u,function(t,o){p+="<button data-bb-handler='"+t+"' type='button' class='btn "+o.className+"'>"+o.label+"</button>",b[t]=o.callback}),s.find(".bootbox-body").html(t.message),!0===t.animate&&r.addClass("fade"),t.className&&r.addClass(t.className),"large"===t.size?c.addClass("modal-lg"):"small"===t.size&&c.addClass("modal-sm"),t.title&&s.before(a.header),t.closeButton){var d=o(a.closeButton);t.title?r.find(".modal-header").prepend(d):d.css("margin-top","-10px").prependTo(s)}return t.title&&r.find(".modal-title").html(t.title),p.length&&(s.after(a.footer),r.find(".modal-footer").html(p)),r.on("hidden.bs.modal",function(t){t.target===this&&r.remove()}),r.on("shown.bs.modal",function(){r.find(".btn-primary:first").focus()}),"static"!==t.backdrop&&r.on("click.dismiss.bs.modal",function(t){r.children(".modal-backdrop").length&&(t.currentTarget=r.children(".modal-backdrop").get(0)),t.target===t.currentTarget&&r.trigger("escape.close.bb")}),r.on("escape.close.bb",function(t){b.onEscape&&l(t,r,b.onEscape)}),r.on("click",".modal-footer button",function(t){var e=o(this).data("bb-handler");l(t,r,b[e])}),r.on("click",".bootbox-close-button",function(t){l(t,r,b.onEscape)}),r.on("keyup",function(t){27===t.which&&r.trigger("escape.close.bb")}),o(t.container).append(r),r.modal({backdrop:!!t.backdrop&&"static",keyboard:!1,show:!1}),t.show&&r.modal("show"),r},r.setDefaults=function(){var t={};2===arguments.length?t[arguments[0]]=arguments[1]:t=arguments[0],o.extend(n,t)},r.hideAll=function(){return o(".bootbox").modal("hide"),r};var b={bg_BG:{OK:"Ок",CANCEL:"Отказ",CONFIRM:"Потвърждавам"},br:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Sim"},cs:{OK:"OK",CANCEL:"Zrušit",CONFIRM:"Potvrdit"},da:{OK:"OK",CANCEL:"Annuller",CONFIRM:"Accepter"},de:{OK:"OK",CANCEL:"Abbrechen",CONFIRM:"Akzeptieren"},el:{OK:"Εντάξει",CANCEL:"Ακύρωση",CONFIRM:"Επιβεβαίωση"},en:{OK:"OK",CANCEL:"Cancel",CONFIRM:"OK"},es:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Aceptar"},et:{OK:"OK",CANCEL:"Katkesta",CONFIRM:"OK"},fa:{OK:"قبول",CANCEL:"لغو",CONFIRM:"تایید"},fi:{OK:"OK",CANCEL:"Peruuta",CONFIRM:"OK"},fr:{OK:"OK",CANCEL:"Annuler",CONFIRM:"D'accord"},he:{OK:"אישור",CANCEL:"ביטול",CONFIRM:"אישור"},hu:{OK:"OK",CANCEL:"Mégsem",CONFIRM:"Megerősít"},hr:{OK:"OK",CANCEL:"Odustani",CONFIRM:"Potvrdi"},id:{OK:"OK",CANCEL:"Batal",CONFIRM:"OK"},it:{OK:"OK",CANCEL:"Annulla",CONFIRM:"Conferma"},ja:{OK:"OK",CANCEL:"キャンセル",CONFIRM:"確認"},lt:{OK:"Gerai",CANCEL:"Atšaukti",CONFIRM:"Patvirtinti"},lv:{OK:"Labi",CANCEL:"Atcelt",CONFIRM:"Apstiprināt"},nl:{OK:"OK",CANCEL:"Annuleren",CONFIRM:"Accepteren"},no:{OK:"OK",CANCEL:"Avbryt",CONFIRM:"OK"},pl:{OK:"OK",CANCEL:"Anuluj",CONFIRM:"Potwierdź"},pt:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Confirmar"},ru:{OK:"OK",CANCEL:"Отмена",CONFIRM:"Применить"},sq:{OK:"OK",CANCEL:"Anulo",CONFIRM:"Prano"},sv:{OK:"OK",CANCEL:"Avbryt",CONFIRM:"OK"},th:{OK:"ตกลง",CANCEL:"ยกเลิก",CONFIRM:"ยืนยัน"},tr:{OK:"Tamam",CANCEL:"İptal",CONFIRM:"Onayla"},zh_CN:{OK:"OK",CANCEL:"取消",CONFIRM:"确认"},zh_TW:{OK:"OK",CANCEL:"取消",CONFIRM:"確認"}};return r.addLocale=function(t,e){return o.each(["OK","CANCEL","CONFIRM"],function(t,o){if(!e[o])throw new Error("Please supply a translation for '"+o+"'")}),b[t]={OK:e.OK,CANCEL:e.CANCEL,CONFIRM:e.CONFIRM},r},r.removeLocale=function(t){return delete b[t],r},r.setLocale=function(t){return r.setDefaults("locale",t)},r.init=function(e){return t(e||o)},r});