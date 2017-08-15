/**
 *description:logoCanvas
 *author:fanwei
 *date:2014/4/17
 */
 define(function(require, exports, module){

 	var support,
 		isWebkit;

 	try{

 		var oC = document.createElement('canvas');

 		var gd = oC.getContext('2d');

 		isWebkit = /webkit/i.test( window.navigator.userAgent );

 		if( gd.getImageData && isWebkit ) {

 			support = true;

 		} else {

 			support = false;

 		}

 		oC = null;

 	}catch (e){

 		support = false;

 	}


 	/**
		if canvas getImageData && webkit
		other broswer effect mabye slow
 	*/

 	var oLogo,
 		oLogoWrap,
 		src;

 	oLogo = $('[sc = logo]');
 	oLogoWrap = $('[sc = logo-wrap]');

 	//ie6
 	if ( !window.localStorage ) {

 		return;

 		alert('kill ie6');

 	}

 	if ( support && !localStorage.hasShowed && window._platform === 'pc' ) {

 		src = oLogo.attr('src');

 		oLogo.remove();

 		localStorage.hasShowed = true;

 		moveLogo( oLogoWrap, src );

 	} else {

 		oLogo.show();

 	}


 	function moveLogo( oWrap, srcLogo ) {

 		var oC = document.createElement('canvas');

 		var moveTimer = null;

 		oWrap.get(0).appendChild( oC );

 		var gd = oC.getContext("2d");

		var oImage = new Image();

		var W = oC.width;
		var H = oC.height;
		var arr = [];

		oImage.onload = function() {

			oC.width = this.width;
			oC.height = this.height;

			gd.drawImage(this, 0 ,0, this.width, this.height);

			var data = gd.getImageData(0, 0, this.width, this.height).data;

			var i=0;

			var num = data.length/4;

			var oDiv;

			var _this = this;

			var x,
				y,
				sum;

			sum = 0;

			gd.clearRect(0,0,this.width,this.height);


			for ( i=0;i<num;i++ ) {

				
				var cube = new Cube();
				cube.gd = gd;

				var bguo = Math.random();

				if ( bguo>0.5 ) {

					cube.x = rnd(0,-2000);
					cube.y = rnd(H+1,H+2000);	

				} else {

					cube.x = rnd(W+2000,W);
					cube.y = rnd(-1,-2000);

				}


				cube.w = 1;
				cube.h = 1;
				cube.r = data[i*4];
				cube.g = data[i*4+1];
				cube.b = data[i*4+2];
				cube.a = data[i*4+3];

				if ( cube.r==0 && cube.g==0 && cube.b==0 && cube.a!=0 ) {

					cube.a = 0;
				}

				cube.draw();

				arr.push(cube);

			}

			for (var i=0;i<arr.length;i++) {

				startMove(arr[i],{

					x: i%_this.width/*+Math.ceil((W-_this.width)/2)*/+rnd(1,-1),
					y: Math.floor(i/_this.width)/*+Math.ceil((H-_this.height)/2)*/+rnd(1,-1)

				},function(){

					sum++;

					if ( sum>= arr.length ) {

						clearInterval( moveTimer );

						$(oC).fadeOut(function(){

							var oImage = $('<img src="/static/build/img/lib/logo/logo.png" width="300" height="59" />');

							oLogoWrap.append( oImage );

							oImage.fadeIn();

						});

					}

				});
			}


			//重绘
			moveTimer = setInterval(function(){

				gd.clearRect(0,0,W,H);

				for (var i=0;i<arr.length;i++) {

					arr[i].draw();

				}

			},28);

		};

		oImage.src = srcLogo;

		function rnd(m,n) {

			return parseInt(Math.random()*((m+1)-n)+n)

		}


		function Cube() {

			this.gd = null
			this.x = 0
			this.y = 0
			this.w = 0;
			this.h = 0;
			this.r = 0;
			this.g = 0;
			this.b = 0;
			this.a = 0;

		}
		
		Cube.prototype = {
			draw: function() {

				this.gd.save();
				this.gd.translate(this.x,this.y);
				this.gd.fillStyle = 'rgba('+  this.r +','+ this.g +','+ this.b +','+ this.a +')';
				this.gd.fillRect(0,0,this.w,this.h);
				this.gd.restore();

			}
		}


		function startMove(obj, json, fnEnd)
		{
			clearInterval(obj.timer);
			obj.timer=setInterval(function (){
				var bStop=true;
				for(var i in json)
				{
					var cur=obj[i];
					
					var speed=(json[i]-cur)/12;
					speed=speed>0?Math.ceil(speed):Math.floor(speed);
					
					if(cur!=json[i])
					{
						bStop=false;
					}
					
					obj[i]=cur+speed;
				}
				
				if(bStop)
				{
					clearInterval(obj.timer);
					
					fnEnd && fnEnd();
				}
			}, 28);
		}

 	}


 });
