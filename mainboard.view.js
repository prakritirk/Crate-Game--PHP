'use strict';
(function(){
    
    var mainBrd = new Board();
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    document.body.appendChild(canvas);

    var x;
    var y;
    var rectwidth;
    var rectheight;
    var inner = "";
    var bobcatFwd = new Image();
    bobcatFwd.src = 'bobcat-fwd.gif';

    var zero = new Image();
    zero.src = 'zero.gif'

    var one = new Image();
    one.src = 'one.gif'

    var two = new Image();
    two.src = 'two.gif'

    var three = new Image();
    three.src = 'three.gif'

    var finish = new Image();
    finish.src = 'Finish.gif'

    var target = new Image();
    target.src = 'Target.gif'

  

    var bobcat1stposx = "";
    var bobcat1stposy = "";
    var counter = 0;
    var count = "";
    var targetWeight;
    
    function viewText(brd) {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    rectwidth = canvas.width / 30;
    var rectheight = canvas.width / 30;

    var a;
    var b;
    var angle;

    x = (canvas.width) / 3;
    y = 60;
    var bobText = ["^", ">", "v", "<"];
    var q = brd.getData();

    for (var r = 0; r < q.n; r++) {
        for (var c = 0; c < q.n; c++) {
            if (r === q.bobRow && c === q.bobCol) {
                inner = bobText[q.bobDir];
                counter++;
                //To set the initial position of Bob Cat on page load
                if (counter == 1) {
                    bobcat1stposx = x;
                    bobcat1stposy = y;
                }

                switch (inner) {
                    case "^":
                        context.drawImage(bobcatFwd, x - rectwidth / 3, y - rectwidth + rectwidth / 4, rectwidth, rectwidth);
                        break;
                    case ">":
                        //a = rectwidth / (rectwidth / 2);
                        //b = rectwidth - (rectwidth / 2);
                        a = rectwidth / 2;
                        b = rectwidth / 2;
                        angle = Math.PI / 2;
                        Util.rotateImage(bobcatFwd, context, a, b, angle, x, y, rectwidth);
                        //context.drawImage(bobcatRight, x - rectwidth / 3, y - rectwidth + rectwidth / 4, rectwidth, rectwidth);
                        break;
                    case "<":
                        a = rectwidth / 2;
                        b = rectwidth / 2;
                        angle = -Math.PI / 2;
                        Util.rotateImage(bobcatFwd, context, a, b, angle, x, y, rectwidth);
                        //context.drawImage(bobcatLeft, x - rectwidth / 3, y - rectwidth + rectwidth / 4, rectwidth, rectwidth);
                        break;
                    case "v":
                        a = rectwidth / 2;
                        b = rectwidth / 2;
                        angle = Math.PI;
                        Util.rotateImage(bobcatFwd, context, a, b, angle, x, y, rectwidth);
                        //context.drawImage(bobcatDown, x - rectwidth / 3, y - rectwidth + rectwidth / 4, rectwidth, rectwidth);
                        break;
                    default:
                        context.drawImage(bobcatFwd, x - rectwidth / 3, y - rectwidth + rectwidth / 4, rectwidth, rectwidth);
                }

                x = x + rectwidth + 4;
            }

            else if (r === q.targetRow && c === q.targetCol) {
                targetWeight = brd.getWeight(r, c);
                inner = (brd.getWeight(r, c) + 6);
                creatRect();
            }

            else {
                inner = brd.getWeight(r, c);
                creatRect();

            }
        }
        y = y + rectwidth + 4
        x = x - (rectwidth + 4) * c;
    }

    }


    

function creatRect() {
   
    switch (inner) {
        case 3:
            context.drawImage(three, x - rectwidth / 3, y - rectwidth + rectwidth / 4, rectwidth, rectwidth);
            break;
        case 2:
            context.drawImage(two, x - rectwidth / 3, y - rectwidth + rectwidth / 4, rectwidth, rectwidth)
            break;
        case 1:
            context.drawImage(one, x - rectwidth / 3, y - rectwidth + rectwidth / 4, rectwidth, rectwidth)
            break;
        case 0:
            context.drawImage(zero, x - rectwidth / 3, y - rectwidth + rectwidth / 4, rectwidth, rectwidth)
            break;
        //default:
        //    context.fillRect(x - rectwidth / 3, y - rectwidth + rectwidth / 4, rectwidth, rectwidth);
        //    var font = rectwidth / 3;
        //    context.font = font + "pt sans-serif";
        //    context.lineWidth = "1";
        //    context.strokeStyle = "black";
        //    context.strokeText(inner, x, y);
    }

    //to set the target position
    if (inner > 4) {
        context.drawImage(target, x - rectwidth / 3, y - rectwidth + rectwidth / 4, rectwidth, rectwidth)
        //context.fillStyle = "green";
        //inner = 'T';
    }

    else {
        //context.fillStyle = "white";

        //To set the initial position of Bob Cat on key press
        if (x == bobcat1stposx && y == bobcat1stposy) {
            //inner = "B";
            //context.fillStyle = "yellow"
            //context.stroke();
            context.drawImage(finish, x - rectwidth / 3, y - rectwidth + rectwidth / 4, rectwidth, rectwidth)
        }
    }
    x = x + rectwidth + 4;

}

//var brd = new Board();
window.addEventListener('resize', drawBoard.bind(null), false);


    window.onload = function(){

        document.onkeydown = function (ev) {
            ev.preventDefault();
            var key = ev.keyCode;
            var ret = mainBrd.move(key);
            drawBoard();
        }
        drawBoard();
    };

    function drawBoard(){
        context.clearRect(0, 0, canvas.width, canvas.height);
        viewText(mainBrd);

         
        var html = 'Score : ' + mainBrd.getScore();
        var header = 'CRATE BOARD'
        var font = rectwidth / 2;

        if(mainBrd.hasWon()){
            html += " <bold>Victory !!!!</bold>"
        }
        
        var messageBoard = document.getElementById('messageBoard');
        var targetWt = document.getElementById('targetWeight');
        var headerdiv = document.getElementById('myHeader');

        messageBoard.innerHTML = html;
        headerdiv.innerHTML = header;
        targetWt.innerHTML = "Target Weight: " + targetWeight;

       
        messageBoard.style.fontSize = font + "px";
        headerdiv.style.fontSize = font + "px";
        targetWt.style.fontSize = font + "px";
    }
})();
