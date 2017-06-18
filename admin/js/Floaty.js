/**
 * jQuery YouTube On The Fly Plugin
 * This jQuery plugin created by Tohid Golkar http://tohidgolkar.com
 * @author Tohid Golkar http://tohidgolkar.com
 * @version 1.0
 * @date Jan 11, 2010
 * @category jQuery plugin
 * @copyright (c) 2010 byASP.net http://www.byasp.net
 * @demo http://floaty.byasp.net/ for more informations about this jQuery plugin
 */

(function($) {
    
  $.fn.Floaty = function(options) {

  settings = jQuery.extend({
     vWidth:            340,
     vHeight:           300,
     vThumbSize:        "small", // Default is Small, other value is "big"!
     vThumbVer:         2, // Default is 2, (1,2,3 only for small thumbnail)
     BgColor :          '#000',
     BgOpacity:         0.6,
     BorderColor:       '#FFF',
     BorderOpacity:     0.9,
     ShowBorder:        0,
     ShowRelatedVideo:  1,
     Color1:            '000000', // Hexa color code without #
     Color2:            '000000',
     CloseKey:          'x',
     imgClose:          '../imagens/graphics/close.png',
     ResizeSpeed:       500
     
  }, options);
  

  
  // Active each element 
  $(this).each(function() {
  
    var id = GetvId(this.getAttribute('href'));
    //alert(id)
    $(this).html('<div class="imagemboxvideo"><div class="ico_play"><img border="0" src="imagens/ico_play.png" /></div><img border="0" src='+GetThumb(id,settings.vThumbSize)+' class="FloatyThumb" id='+id+' /></div>');

    
    $(this).click(function(){
    
       show(id); 
       return false;
    });
    
    
  //END EACH  
  });

  
    
   // SHOW
   function show(id){
     $('body').append('<div id="jq-overlay"></div><div id="jq-floaty"><div id="floaty-container-embed"><div id="floaty-close-btn"> </div></div></div>');
   
     var arrPageSizes = getPageSize();
     
     $('#jq-overlay').css({
		backgroundColor:	settings.BgColor,
		opacity:			settings.BgOpacity,
		width:				arrPageSizes[0],
		height:				arrPageSizes[1]
	 }).fadeIn();
     
     $('#floaty-container-embed').css({
		backgroundColor:	settings.BorderColor,
		opacity:			settings.BorderOpacity
	 });
	 
     
     $('#floaty-close-btn').css({
        backgroundImage: 'url('+settings.imgClose+')'
     });
     
   
     var arrPageScroll = getPageScroll();

		$('#jq-floaty').css({
			top:	arrPageScroll[1] + (arrPageSizes[3] / 10),
			left:	arrPageScroll[0]
		}).show();

		$('#jq-overlay,#jq-floaty').click(function() {
			close();									
		});

		$('#floaty-close-btn').click(function() {
			close();
			return false;
		});

        // Calculate the new size if page resized!
		$(window).resize(function() {
			var arrPageSizes = getPageSize();
			$('#jq-overlay').css({
				width:		arrPageSizes[0],
				height:		arrPageSizes[1]
			});
			var arrPageScroll = getPageScroll();
			$('#jq-floaty').css({
				top:	arrPageScroll[1] + (arrPageSizes[3] / 10),
				left:	arrPageScroll[0]
			});
		});
   
   
   resize(settings.vWidth,settings.vHeight,id)
   
   
   //END show(id)
   }
   
   
   
   function resize(vWidth,vHeight,id) {
			var intCurrentWidth = $('#floaty-container-embed').width();
			var intCurrentHeight = $('#floaty-container-embed').height();
			var intWidth = (vWidth + 20); 
			var intHeight = (vHeight + 20);
			var intDiffW = intCurrentWidth - intWidth;
			var intDiffH = intCurrentHeight - intHeight;
			$('#floaty-container-embed').animate({ width: intWidth, height: intHeight },settings.ResizeSpeed,function() { play(id,settings.vWidth,settings.vHeight,settings.ShowBorder,settings.ShowRelatedVideo,settings.Color1,settings.Color2); keyboard_activate();});
	}
   
   
   // Keyboard //////////
   function keyboard_activate() {
			$(document).keydown(function(objEvent) {
				keyboard(objEvent);
			});
		}
		
   function keyboard(objEvent) {
   
		if ( objEvent == null ) {
			keycode = event.keyCode;
			escapeKey = 27;

		} else {
			keycode = objEvent.keyCode;
			escapeKey = objEvent.DOM_VK_ESCAPE;
		}

		key = String.fromCharCode(keycode).toLowerCase();
		if ( ( key == settings.CloseKey ) || ( key == 'x' ) || ( keycode == escapeKey ) ) {
			close();
		}
	}
   
   
   // PLAY ///////////////////////////////
   function play(id,w,h,b,r,c1,c2){
   var str = '';
   
   if (c1!='666666'){str+='&color1=0x'+c1}
   if (c2!='efefef'){str+='&color2=0x'+c2}
   if (r!=1){str+='&rel=0'}
   if (b!=0){str+='&border=1'}

    var em = '<div id="floaty-object"><object width="'+w+'" height="'+h+'"><param name="movie" value="http://www.youtube.com/v/'+id+'&hl=en&fs=1'+str+'"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'+id+'&hl=en&fs=1'+str+'" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'+w+'" height="'+h+'"></embed></object></div>'
    $('#floaty-loading').hide();
    $('#floaty-container-embed').append(em);
   }
   
   
   
   
   // CLOSE //////////////
   function close() {
        $('#jq-floaty').remove();
        $('#jq-overlay').fadeOut(function() { $('#jq-overlay').remove(); });
        $('embed, object, select').css({ 'visibility' : 'visible' });
   }
    
    
    
    
   // GET Video ID  ////////////////////
   function GetvId(url){
    if(url == null){return "";}
        var vid;
        var results;
        results = url.match("[\\?&]v=([^&#]*)");
        vid = ( results == null ) ? url : results[1];
        return vid;
   }
    

   // Thumbnail of Video //////////////
   function GetThumb(vid,size){
        if(size == "small"){
        return "http://img.youtube.com/vi/"+vid+"/"+settings.vThumbVer+".jpg";
        }else{
        return "http://img.youtube.com/vi/"+vid+"/0.jpg";
        }
    }



	//getPageSize() and getPageScroll() by quirksmode.com
    function getPageSize() {
			var xScroll, yScroll;
			if (window.innerHeight && window.scrollMaxY) {	
				xScroll = window.innerWidth + window.scrollMaxX;
				yScroll = window.innerHeight + window.scrollMaxY;
			} else if (document.body.scrollHeight > document.body.offsetHeight){
				xScroll = document.body.scrollWidth;
				yScroll = document.body.scrollHeight;
			} else {
				xScroll = document.body.offsetWidth;
				yScroll = document.body.offsetHeight;
			}
			var windowWidth, windowHeight;
			if (self.innerHeight) {
				if(document.documentElement.clientWidth){
					windowWidth = document.documentElement.clientWidth; 
				} else {
					windowWidth = self.innerWidth;
				}
				windowHeight = self.innerHeight;
			} else if (document.documentElement && document.documentElement.clientHeight) {
				windowWidth = document.documentElement.clientWidth;
				windowHeight = document.documentElement.clientHeight;
			} else if (document.body) {
				windowWidth = document.body.clientWidth;
				windowHeight = document.body.clientHeight;
			}	
			
			if(yScroll < windowHeight){
				pageHeight = windowHeight;
			} else { 
				pageHeight = yScroll;
			}
			
			if(xScroll < windowWidth){	
				pageWidth = xScroll;		
			} else {
				pageWidth = windowWidth;
			}
			arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight);
			return arrayPageSize;
		};

		function getPageScroll() {
			var xScroll, yScroll;
			if (self.pageYOffset) {
				yScroll = self.pageYOffset;
				xScroll = self.pageXOffset;
			} else if (document.documentElement && document.documentElement.scrollTop) {
				yScroll = document.documentElement.scrollTop;
				xScroll = document.documentElement.scrollLeft;
			} else if (document.body) {
				yScroll = document.body.scrollTop;
				xScroll = document.body.scrollLeft;	
			}
			arrayPageScroll = new Array(xScroll,yScroll);
			return arrayPageScroll;
		};
		


};//END jQuery
})(jQuery);
