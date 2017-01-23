'use strict';
    function Board(){
        var s= ""+window.location;
        if(s.indexOf("seed=")== -1)
        {
            s=Math.random();
            
        } else{
            s=s.indexOf("seed=");
            s=parseInt(s);
        }
               
        Util.random(s);
        var n = 8;
        var brd = [];
        var rBob = 0; //row postion of the bobcat
		var cBob = 0; //column position of the bobcate
		var dBob = 0; //direction of the bobcat

        var startRow=0; //holds the starting Row position of the bobcat; 
        var startCol=0; //holds the starting Col position of the bobcat;

        
        var targetRow = 0;
		var targetCol = 0;

        var score = 0;
        var state = 0; // 1 means completed target to goal
        
        var dr = [-1,0,1,0], dc=[0,1,0,-1];  //directions NESW are 0 1 2 3, row 0 at top

        init();

        function init(){
            brd = [];
            var min = 8 ;
            var max = 12 ;
            n = Math.floor(Util.random() * (max - min + 1)) + min;
            for(var r = 0 ; r < n; r++){
                brd[r] = [] ;
                for(var c=0 ; c<n ; c++){
                    brd[r][c] = weight();
                }
            }
            
            //setting BobCat starting position
            startRow  = rBob = n-1;
            startCol=cBob=Math.floor(Util.random() * n);
            brd[rBob][cBob] = 0; //bobcat can't be on a crate;

            //setting Target postion
            targetRow = Math.floor(1 + Util.random() * (n - 2));
            targetCol = Math.floor(1 + Util.random() * (n - 2));
            while (brd[targetRow][targetCol] === 0) brd[targetRow][targetCol] = weight(); //giving weith to target;

        }

        function countCratesMoved(newr,newc,maxWt){
            var wt = 0;
            var count = 0;
            while(onBrd(newr,newc)){
                wt += brd[newr][newc];
                
                if(wt > maxWt) return -1;
                if(brd[newr][newc] === 0) return count;
                count +=1;
                newr = newr + dr[dBob];
                newc = newc + dc[dBob];
            }
            return -1;
        }

        function explode(ret){
            var newr = rBob + dr[dBob];
            var newc = cBob+ dc[dBob]; 
            if(onBrd(newr,newc) && brd[newr][newc] > 0 && !(targetRow === newr && targetCol === newc)){
                brd[newr][newc] =0;
                score +=100;
                ret.kind = "explode";
            }
            return ret;
        }

        function weight(){
            var wt = [.6, .7, .9];   //cumulative dist of wt=0 =1 =2  else 3
            var rand = Util.random();  //[0.0 - 1.0)
            for (var i = 0; i < 3; i = i + 1) if (rand < wt[i]) return i;
            return i;
        }

        function onBrd(row, col){
            if (row < 0 || col < 0) return false;
            if(row >= n || col >= n) return false;
            
            return true;
        }

        
        this.toString=function(){
            var out='';
            for (var r=0;r<n;r++){
                for (var c=0;c<n;c++){
                    if(r === rBob && c === cBob){
                       out = out +''+"B";
                    }else if(r === startRow  && c === startCol){
                        out = out +''+"T";
                    }else if(r === targetRow && c === targetCol){
                        out = out + ''+"-";
                    }else{
                        out = out +''+brd[r][c];
                    }
                } 
                out=out+'<br/>';
            }
            return out;
        }
        
        this.move = function(key) {  
            var maxWt = 3;

            var ret = this.getData(); ret.kind = "illegal";

            if(state===1) return ret;
            var cmd ="";
            var dir= -1;
            switch (key) {
                case 37:  // left i.e East
                    cmd = "F";
                    dir = 3;
                    break;
                case 40: //down i.e South
                    cmd = "F";
                    dir = 2;
                break;
                case 39: //right i.e West
                    cmd = "F";
                    dir = 1;
                break;
                case 38: //up i.e North
                    cmd = "F";
                    dir = 0;
                break;
                case 88: //X explode
                    cmd = "X";
                    dir = 4;
                    return explode(ret);
                break;
                default:
                    return ret;
            }

            if(cmd === 'F' && dir === dBob) {
                //this is if the player wants the bobcat to push forward
                var newr = rBob + dr[dBob];
                var newc = cBob+ dc[dBob];
                
                var movedCrates = countCratesMoved(newr,newc,maxWt);
                if(movedCrates<0){ return ret; }
               
				//move the crates, starting at newr,newc working back to the bob
				//update other data (e.g., position of bob, position of target, etc.
				var moveR = 0;
				var moveC = 0;
                while(movedCrates >= 0){
                    moveR= rBob + movedCrates * dr[dBob];
                    moveC= cBob + movedCrates * dc[dBob];
                    if(moveR === targetRow && moveC === targetCol){
                        //Moving Target
                        targetRow += dr[dBob];
                        targetCol += dc[dBob];
                    }
                    brd[moveR +dr[dBob]][moveC + dc[dBob]] = brd[moveR][moveC];
                    movedCrates -=1;
                }
                rBob +=dr[dBob];
                cBob += dc[dBob];
                score +=1;
                if(targetRow === startRow && targetCol === startCol) state =1; //VICTORY

                ret.kind = "push";

				/*while(newr !== rBob || newc !== cBob){
					moveR = newr;
					moveC = newc;
					newr = newr - dr[dBob];
					newc = newc - dc[dBob];
					brd[moveR][moveC] = brd[newr][newc];		
				}
				
				brd[rBob][cBob] = 0;
				//brd[newr][newc] = 'B';
				rBob= moveR;
				cBob = moveC;*/
            } else {
                dBob = dir;
                score +=1;
                ret.kind = 'trun';
            }
			return ret;
        }



        this.getDirection = function(){
			switch(dBob) {
				case 0:
					return 'North';
					break;
				case 1:
					return 'East';
				break;
				case 2:
					return 'South';
				break;
				case 3:
					return 'West';
				break;
				default:
					return 'Invalid';
			}
		}

        this.hasWon = function(){
            return state === 1;
        }
        this.getScore = function(){
            return score;
        }

        this.getWeight = function(row,col){
            return brd[row][col];
        }

        this.getData=function(){
            return {
                'bobRow':rBob,
                'bobCol':cBob,
                'bobDir':dBob,
                'targetRow':targetRow,
                'targetCol':targetCol,
                'startRow':startRow,
                'startCol':startCol,
                'n':n
            }
        }
        
    };

