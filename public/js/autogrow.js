!function(e){"use strict";e.fn.autogrow=function(){return this.each(function(){var n=e(this),t=n.height(),i=300,s=(n.css("lineHeight"),0),h=0,o=e("<div></div>").css({position:"absolute",top:-1e4,left:-1e4,width:e(this).width()-parseInt(n.css("paddingLeft"))-parseInt(n.css("paddingRight")),fontSize:n.css("fontSize"),fontFamily:n.css("fontFamily"),lineHeight:n.css("lineHeight"),resize:"none"}).appendTo(document.body),a=function(){var n=function(e,n){for(var t=0,i="";n>t;t++)i+=e;return i},s=this.value.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/&/g,"&amp;").replace(/\n$/,"<br/>&nbsp;").replace(/\n/g,"<br/>").replace(/ {2,}/g,function(e){return n("&nbsp;",e.length-1)+" "});o.html(s),e(this).css("height",Math.max(Math.min(o.height()+17,i),t))};n.change(a).keyup(a).keydown(a),a.apply(this),n.mousedown(function(){s=n.width(),h=n.height()}).mouseup(function(){(n.width()!=s||n.height()!=h)&&n.unbind("keyup",a).unbind("keydown",a).unbind("change",a),s=h=0})})}}(jQuery);
//# sourceMappingURL=autogrow.js.map