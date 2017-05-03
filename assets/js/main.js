$(document).ready(function() {

    /* ======= Twitter Bootstrap hover dropdown ======= */   
    /* Ref: https://github.com/CWSpear/bootstrap-hover-dropdown */ 
    /* apply dropdownHover to all elements with the data-hover="dropdown" attribute */
    
    $('[data-hover="dropdown"]').dropdownHover();
    
    /* ======= jQuery Responsive equal heights plugin ======= */
    /* Ref: https://github.com/liabru/jquery-match-height */
    
     $('#who .item-inner').matchHeight();    
     $('#testimonials .item-inner .quote').matchHeight(); 
     $('#latest-blog .item-inner').matchHeight(); 
     $('#services .item-inner').matchHeight();
     $('#team .item-inner').matchHeight();
     
    /* ======= jQuery Placeholder ======= */
    /* Ref: https://github.com/mathiasbynens/jquery-placeholder */
    
    $('input, textarea').placeholder();         
    
    /* ======= jQuery FitVids - Responsive Video ======= */
    /* Ref: https://github.com/davatron5000/FitVids.js/blob/master/README.md */    
    $(".video-container").fitVids();   
    
	
	/* ======= Fixed Header animation ======= */ 
        
    $(window).on('scroll', function() {
         
         if ($(window).scrollTop() > 80 ) {
             $('#header').addClass('header-shrink');
         }
         else {
             $('#header').removeClass('header-shrink');             
         }
    }); 
});


!function(){var a,b,c,d=window,e=document,f=arguments,g="script",h=["config","track","trackForm","trackClick","identify","visit","push","call"],i=function(){var a,b=this,c=function(a){b[a]=function(){return b._e.push([a].concat(Array.prototype.slice.call(arguments,0))),b}};for(b._e=[],a=0;a<h.length;a++)c(h[a])};for(d.__woo=d.__woo||{},a=0;a<f.length;a++)d.__woo[f[a]]=d[f[a]]=d[f[a]]||new i;b=e.createElement(g),b.async=1,b.src="//static.woopra.com/js/w.js",c=e.getElementsByTagName(g)[0],c.parentNode.insertBefore(b,c)}("woopra");
 
// configure tracker
woopra.config({
 domain: "ethereumpool.co"
});
 
// track pageview
woopra.track();