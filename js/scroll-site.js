 $.clientCoords = function() {
	var dimensions = {width: 0, height: 0};
	if (document.documentElement) {
		dimensions.width = document.documentElement.offsetWidth;
		dimensions.height = document.documentElement.offsetHeight;
	} 
	else{
		if (window.innerWidth && window.innerHeight) {
			dimensions.width = window.innerWidth;
			dimensions.height = window.innerHeight;
		}
	}
	return dimensions;
}


/**
 * jQuery.ScrollTo - Easy element scrolling using jQuery.
 * Copyright (c) 2007-2008 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * Date: 9/11/2008
 * @author Ariel Flesler
 * @version 1.4
 *
 * http://flesler.blogspot.com/2007/10/jqueryscrollto.html
 */
;(function(h){
	var m=h.scrollTo=function(b,c,g){
		h(window).scrollTo(b,c,g)
		};m.defaults={
			axis:'y',duration:1
			};
			m.window=function(b){
				return h(window).scrollable()
				};h.fn.scrollable=function(){
					return this.map(function(){
						var b=this.parentWindow||this.defaultView,c=this.nodeName=='#document'?b.frameElement||b:this,g=c.contentDocument||(c.contentWindow||c).document,i=c.setInterval;return c.nodeName=='IFRAME'||i&&h.browser.safari?g.body:i?g.documentElement:this
						})
					};
					h.fn.scrollTo=function(r,j,a){
						if(typeof j=='object'){
							a=j;j=0}if(typeof a=='function')a={
								onAfter:a
								};a=h.extend({
									
								},
								m.defaults,a);j=j||a.speed||a.duration;a.queue=a.queue&&a.axis.length>1;if(a.queue)j/=2;a.offset=n(a.offset);a.over=n(a.over);return this.scrollable().each(function(){var k=this,o=h(k),d=r,l,e={},p=o.is('html,body');switch(typeof d){case'number':case'string':if(/^([+-]=)?\d+(px)?$/.test(d)){d=n(d);break}d=h(d,this);case'object':if(d.is||d.style)l=(d=h(d)).offset()}h.each(a.axis.split(''),function(b,c){var g=c=='x'?'Left':'Top',i=g.toLowerCase(),f='scroll'+g,s=k[f],t=c=='x'?'Width':'Height',v=t.toLowerCase();if(l){e[f]=l[i]+(p?0:s-o.offset()[i]);if(a.margin){e[f]-=parseInt(d.css('margin'+g))||0;e[f]-=parseInt(d.css('border'+g+'Width'))||0}e[f]+=a.offset[i]||0;if(a.over[i])e[f]+=d[v]()*a.over[i]}else e[f]=d[i];if(/^\d+$/.test(e[f]))e[f]=e[f]<=0?0:Math.min(e[f],u(t));if(!b&&a.queue){if(s!=e[f])q(a.onAfterFirst);delete e[f]}});q(a.onAfter);function q(b){o.animate(e,j,a.easing,b&&function(){b.call(this,r,a)})};function u(b){var c='scroll'+b,g=k.ownerDocument;return p?Math.max(g.documentElement[c],g.body[c]):k[c]}}).end()};function n(b){return typeof b=='object'?b:{top:b,left:b}}})(jQuery);


/**
 * jQuery.LocalScroll - Animated scrolling navigation, using anchors.
 * Copyright (c) 2007-2008 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * Date: 6/3/2008
 * @author Ariel Flesler
 * @version 1.2.6
 * Modified: 23.10.2008 - by Emeric Pongor
 **/
;(function($){
	var URI=location.href.replace(/#.*/,'');
	var $localScroll=$.localScroll=function(settings){
		$('body').localScroll(settings);
		};
	$localScroll.defaults={
		duration:1000,axis:'y',event:'click',stop:true
		};
	$localScroll.hash=function(settings){
		settings=$.extend({
			
		},$localScroll.defaults,settings);
		settings.hash=false;
		if(location.hash)setTimeout(function(){
			scroll(0,location,settings);
			},0);
		};
	$.fn.localScroll=function(settings){
		settings=$.extend({
			
		},$localScroll.defaults,settings);
		return(settings.persistent||settings.lazy)?this.bind(settings.event,function(e){
			var a=$([e.target,e.target.parentNode]).filter(filter)[0];a&&scroll(e,a,settings);
			}):this.find('a,area').filter(filter).bind(settings.event,function(e){
				scroll(e,this,settings);
				}).end().end();function filter(){
					return!!this.href&&!!this.hash&&this.href.replace(this.hash,'')==URI&&(!settings.filter||$(this).is(settings.filter));
					};
		};
		function scroll(e,link,settings){
			var id=link.hash.slice(1),elem=document.getElementById(id)||document.getElementsByName(id)[0];
			if(elem){
				var elem_offset_left=$(elem).offset().left;var elem_offset_top=$(elem).offset().top;
				var elem_width=$(elem).width();
				var window_width=$.clientCoords().width;
				var margin=Math.round((window_width-elem_width)/2);
				var pos_left=elem_offset_left-margin;
				var pos_top=elem_offset_top;
				if(pos_left<=0)pos_left=0;
				if(pos_top<=0)pos_top=0;
				if(elem_offset_left<pos_left){
					pos_left=elem_offset_left;
					}e&&e.preventDefault();
					var $target=$(settings.target||$.scrollTo.window());
					if(settings.lock&&$target.is(':animated')||settings.onBefore&&settings.onBefore.call(link,e,elem,$target)===false)return;
					if(settings.stop)$target.queue('fx',[]).stop();
					$target.scrollTo({
						top:pos_top,left:pos_left
						},settings).trigger('notify.serialScroll',[elem]);
						if(settings.hash)$target.queue(function(){
							location=link.hash;$(this).dequeue();
							});
				}
			};
	})(jQuery);

jQuery(function( $ ){
	$.scrollTo.defaults.axis = 'xy'; 
	$.localScroll({
		axis:'xy',//the default is 'y'
		lazy:true
	});
});