// Author: Jogis
// Website: http://imagescroll.qiniudn.com/test1.html
// Plugin Website: https://github.com/yesvods/jquery-ImageScroll
(function($){
  $.fn.imageScroll = function(opts){
    var defaults = {
      orientation:"left",
      speed:600,
      interval:1500,
      hoverPause:true,
      callback:function(){ return false;}
    }
    var options = $.extend(defaults, opts);
    var _this = this;
    function scroll() {
      var $firstLi = $(_this).children().first();
      var $lastLi = $(_this).children().last();
      var liOuterWidth = $firstLi.outerWidth(true);
      //In case that parent take a center text-algin layout
      if($(_this).parent().css("text-align").toLowerCase()=="center"){
        liOuterWidth*=2;
      }
      switch(options.orientation){
        case "left":
        case "top":
          $firstLi.animate({
            "margin-left":"-="+liOuterWidth+"px"
          },options.speed,function(){
            $firstLi.css("margin-left","+="+liOuterWidth+"px");
            $lastLi.after($firstLi);
          });
          break;
        case "right":
        case "bottom":
          $firstLi.animate({
            "margin-left":"+="+liOuterWidth+"px"
          },options.speed,function(){
            $firstLi.css("margin-left","-="+liOuterWidth+"px");
            $firstLi.before($lastLi);
          });
          break;
      }
      //binding this to callback action scope link which make coding native
      options.callback.call(_this);
    }
    scroll();
    return this;
  }
})(window.jQuery || window.Zepto);