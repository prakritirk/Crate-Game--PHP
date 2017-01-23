"use strict";

function rotateImage(image, context, a, b, angle, x, y, rectwidth) {
    context.translate(x + rectwidth / 5, y - rectwidth/4);
    //context.translate(x - rectwidth / 3, y - rectwidth + rectwidth / 4);
    context.rotate(angle);
    context.drawImage(image, -(a), -(b), rectwidth, rectwidth);
    context.rotate(-angle);
    context.translate(-(x + rectwidth / 5), -(y - rectwidth/4));
    //context.translate(-(x - rectwidth / 3), -(y - rectwidth + rectwidth / 4));

}