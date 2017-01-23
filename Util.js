"use strict";

//Utility module for mygame
var Util = {
  
    seed : Math.random(),     //not ideal since not private
            
    random : function (newSeed){   //[0 - 1.0)  optional seeding     
        if(newSeed) Util.seed = newSeed;        
        
        Util.seed = (Util.seed*9301 + 49297) % 233280;
        var ret = Util.seed/233280;
        if(ret>=1) ret = .99999;  //maybe rounding error?
        return ret;
    },
     
    rotateImage: function (image, context, a, b, angle, x, y, rectwidth){
    //using but not changing context ctx, draws image with its ulc at x,y,
    // rotated theta radians cw about its center
         context.translate(x + rectwidth / 5, y - rectwidth/4);
    //context.translate(x - rectwidth / 3, y - rectwidth + rectwidth / 4);
    context.rotate(angle);
    context.drawImage(image, -(a), -(b), rectwidth, rectwidth);
    context.rotate(-angle);
    context.translate(-(x + rectwidth / 5), -(y - rectwidth/4));
    //context.translate(-(x - rectwidth / 3), -(y - rectwidth + rectwidth / 4));
    }
};
    