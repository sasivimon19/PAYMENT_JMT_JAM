<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="icon" href="<?php echo base_url(); ?>assets/img/jmt-icon.png" type="image/gif">
<link href="<?php echo base_url(); ?>assets/Login/bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>assets/Login/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/Login/jquery/jquery.min.js"></script>
<!--<link href="<?php echo base_url(); ?>assets/fontawesome-free-5.13.0/css/all.css" rel="stylesheet" id="bootstrap-css">-->
<link href="<?php echo base_url(); ?>AdminLTE/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<title> PAMENT SYSTEM </title>


<!------ Include the above in your HEAD tag ---------->
<!--    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login.css" />-->
<!DOCTYPE html>
<!--<html lang="en">
<head>-->

<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
    <!--<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>-->

    
    <title> PAMENT </title>

<style>
    
body {
    background-color: white;
}

#loginbox {
    margin-top: 30px;
}

#loginbox > div:first-child {        
    padding-bottom: 10px;    
}

.iconmelon {
    display: block;
    margin: auto;
}

#form > div {
    margin-bottom: 25px;
}

#form > div:last-child {
    margin-top: 10px;
    margin-bottom: 10px;
}

.panel {    
    background-color: #ffffff;
}

.panel-body {
    padding-top: 30px;
    background-color: rgba(255,255,255,.3);
}

#particles {
    width: 100%;
    height: 100%;
    overflow: hidden;
    top: 0;                        
    bottom: 0;
    left: 0;
    right: 0;
    position: absolute;
    z-index: -2;
}

.iconmelon,
.im {
  position: relative;
  width: 150px;
  height: 150px;
  display: block;
  fill: #4A575D;
}

.iconmelon:after,
.im:after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}




.container{
height: 100%;
align-content: center;
}

.card{
height: 345px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
}

.input-group-prepend span{
width: 50px;
background-color: #cc0000;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #cc0000;

}

.login_btn:hover{
color: black;
background-color: #4A575D;
}

.links{
color: white;
}
.links:hover{
    color: #cc0000;
    }

.links a{
margin-left: 4px;
}
.times:hover{
    background-color: #cc0000;
}
</style>
<!--</head>-->
<body >
        <div class="container">

                <!--<div style="text-align:center"><img class="mt-2"src="https://i.ibb.co/rxKLQ4S/19-1-User-512.png" alt="photo" style="width:10%"></div>-->
                <div class="d-flex justify-content-center h-100">
                    <div class="group" style="text-align:center">
                        <div style=" margin-top: 8%">
                                <img style=" height: 30%;" src="<?php echo base_url(); ?>assets/images/JMT-JAM.PNG">
                        </div>
                        <br>        

                    <div class="card ">
                        <div class="card-header">
                            <h2 class="text-center text-light" ><b>LOGIN PAYMENT</b></h2>
                        </div>
                        <br>
                        <div class="card-body">
<!--                            <form class="needs-validation" style=" text-align: center">-->
                                <form class="needs-validation" style=" text-align: center" method="post" action="<?php echo site_url(); ?>/Payment_controller/login_validation">
<!--                                <div class="group">
                                    <label for="pass" class="label">Password</label>
                                    <input id="password" name="password" type="password" class="input" data-type="password">
                                </div>
                                    <div class="group">
                                    <label for="pass" class="label">Password</label>
                                    <input id="password" name="password" type="password" class="input" data-type="password">
                                </div>-->
                                <div class="group form-group" style="text-align: center">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class='fas fa-user-friends' style='font-size:26px'></i></span>
                                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                                    </div>         
                                </div>
                                <div class="group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class='fa fa-key ml-2' style='font-size:22px'></i></span>
                                        <input type="password" class="form-control" placeholder="Password"  name="password" required>
                                    </div>   
                                </div>
                     
                                <div class="form-group">
                                    <input type="submit" value="Login" class="btn  login_btn text-light" name="insert">    
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div style=" font-size: 9px; color: white;"><b>PAYMENT V.2020.01</b></div>

<!--                            <div class="d-flex justify-content-center links">
                                <button class="btn login_btn text-light" role="button" id="btnKayitOl" >V.0.01</button>
                            </div>-->
<!--                            <div class="d-flex justify-content-center links">
                                    <button class="btn login_btn text-light" role="button" id="btnKayitOl" >PAYMENT</button>
                            </div>-->
                          <!--  <div class="d-flex justify-content-center links my-1">
                             <button class="btn login_btn text-light" role="button" id="btnSifreUnuttum" data-toggle="modal" data-target="#openModalID">
                                Forgot your password?</button>
                             
                             <div class="modal fade " tabindex="-1" role="dialog" id="openModalID" aria-labelledby="ModalTitle" aria="true" data-backdrop="false">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="ModalTitle2">Şifreni Sıfırla</h3>
                                            <button type="button" class="close times" data-dismiss="modal" aria-label="Kapatma işlemi">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="needs-validation">
                                                <div class="form-group">
                                                    <div class="input-group form-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class='fa fa-envelope ml-2' style='font-size:26px'></i></span>
                                                            <input type="text" class="form-control" placeholder="E-mail" id="tbEmail" required> 
                                                            <div class="input-group-append">
                                                                <span class="input-group-text  text-light" style="width: 100px;font-size: 15px; font-weight: 400">@example.com</span>
                                                            </div>     
                                                        </div>       
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" value="Gönder" class="btn login_btn text-light">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
            
        
        <div id="particles"></div>
        

    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->

    <script src="<?php echo base_url(); ?>assets/Login/jquery-3.2.1.slim.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/Login/popper.min.js"></script>
    
    <script>
       !function(a){function b(b,d){function e(){if(w){$canvas=a('<canvas class="pg-canvas"></canvas>'),v.prepend($canvas),p=$canvas[0],q=p.getContext("2d"),f();
       for(var b=Math.round(p.width*p.height/d.density),c=0;b>c;c++){var e=new l;e.setStackPos(c),x.push(e)}a(window).on("resize",function(){h()}),a(document).on("mousemove",function(a){y=a.pageX,z=a.pageY}),
       B&&!A&&window.addEventListener("deviceorientation",function(){D=Math.min(Math.max(-event.beta,-30),30),C=Math.min(Math.max(-event.gamma,-30),30)},!0),g(),o("onInit")}}function f(){p.width=v.width(),
       p.height=v.height(),q.fillStyle=d.dotColor,q.strokeStyle=d.lineColor,q.lineWidth=d.lineWidth}function g(){if(w){s=a(window).width(),t=a(window).height(),q.clearRect(0,0,p.width,p.height);
       for(var b=0;b<x.length;b++)x[b].updatePosition();for(var b=0;b<x.length;b++)x[b].draw();E||(r=requestAnimationFrame(g))}}function h(){for(f(),i=x.length-1;i>=0;i--)
       (x[i].position.x>v.width()||x[i].position.y>v.height())&&x.splice(i,1);var a=Math.round(p.width*p.height/d.density);if(a>x.length)for(;a>x.length;){var b=new l;x.push(b)}else a<x.length&&x.splice(a);
       for(i=x.length-1;i>=0;i--)x[i].setStackPos(i)}function j(){E=!0}function k(){E=!1,g()}function l(){switch(this.stackPos,this.active=!0,this.layer=Math.ceil(3*Math.random()),this.parallaxOffsetX=0,
       this.parallaxOffsetY=0,this.position={x:Math.ceil(Math.random()*p.width),y:Math.ceil(Math.random()*p.height)},this.speed={},d.directionX)
       {case"left":this.speed.x=+(-d.maxSpeedX+Math.random()*d.maxSpeedX-d.minSpeedX).toFixed(2);break;case"right":this.speed.x=+(Math.random()*d.maxSpeedX+d.minSpeedX).toFixed(2);break;
       default:this.speed.x=+(-d.maxSpeedX/2+Math.random()*d.maxSpeedX).toFixed(2),this.speed.x+=this.speed.x>0?d.minSpeedX:-d.minSpeedX}switch(d.directionY){case"up":
       this.speed.y=+(-d.maxSpeedY+Math.random()*d.maxSpeedY-d.minSpeedY).toFixed(2);break;case"down":this.speed.y=+(Math.random()*d.maxSpeedY+d.minSpeedY).toFixed(2);break;default:
       this.speed.y=+(-d.maxSpeedY/2+Math.random()*d.maxSpeedY).toFixed(2),this.speed.x+=this.speed.y>0?d.minSpeedY:-d.minSpeedY}}function m(a,b){return b?void(d[a]=b):d[a]}function n()
       {v.find(".pg-canvas").remove(),o("onDestroy"),v.removeData("plugin_"+c)}function o(a){void 0!==d[a]&&d[a].call(u)}var p,q,r,s,t,u=b,v=a(b),
       w=!!document.createElement("canvas").getContext,x=[],y=0,z=0,A=!navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry|BB10|mobi|tablet|opera mini|nexus 7)/i),B=!!window.DeviceOrientationEvent,
       C=0,D=0,E=!1;return d=a.extend({},a.fn[c].defaults,d),l.prototype.draw=function(){q.beginPath(),q.arc(this.position.x+this.parallaxOffsetX,
       this.position.y+this.parallaxOffsetY,d.particleRadius/2,0,2*Math.PI,!0),q.closePath(),q.fill(),q.beginPath();for(var a=x.length-1;a>this.stackPos;a--){var b=x[a],c=this.position.x-b.position.x,
       e=this.position.y-b.position.y,f=Math.sqrt(c*c+e*e).toFixed(3);f<d.proximity&&(q.moveTo(this.position.x+this.parallaxOffsetX,this.position.y+this.parallaxOffsetY),
       d.curvedLines?q.quadraticCurveTo(Math.max(b.position.x,b.position.x),Math.min(b.position.y,b.position.y),b.position.x+b.parallaxOffsetX,b.position.y+b.parallaxOffsetY):
       q.lineTo(b.position.x+b.parallaxOffsetX,b.position.y+b.parallaxOffsetY))}q.stroke(),q.closePath()},l.prototype.updatePosition=function(){if(d.parallax){if(B&&!A){var a=(s-0)/60;pointerX=(C- -30)*a+0;
       var b=(t-0)/60;pointerY=(D- -30)*b+0}else pointerX=y,pointerY=z;this.parallaxTargX=(pointerX-s/2)/(d.parallaxMultiplier*this.layer),this.parallaxOffsetX+=(this.parallaxTargX-this.parallaxOffsetX)/10,
       this.parallaxTargY=(pointerY-t/2)/(d.parallaxMultiplier*this.layer),this.parallaxOffsetY+=(this.parallaxTargY-this.parallaxOffsetY)/10}switch(d.directionX){case"left":
       this.position.x+this.speed.x+this.parallaxOffsetX<0&&(this.position.x=v.width()-this.parallaxOffsetX);break;case"right":this.position.x+this.speed.x+this.parallaxOffsetX>v.width()&&
       (this.position.x=0-this.parallaxOffsetX);break;default:(this.position.x+this.speed.x+this.parallaxOffsetX>v.width()||this.position.x+this.speed.x+this.parallaxOffsetX<0)&&(this.speed.x=-this.speed.x)}
       switch(d.directionY){case"up":this.position.y+this.speed.y+this.parallaxOffsetY<0&&(this.position.y=v.height()-this.parallaxOffsetY);break;case"down":
       this.position.y+this.speed.y+this.parallaxOffsetY>v.height()&&(this.position.y=0-this.parallaxOffsetY);break;default:(this.position.y+this.speed.y+this.parallaxOffsetY>v.height()||
       this.position.y+this.speed.y+this.parallaxOffsetY<0)&&(this.speed.y=-this.speed.y)}this.position.x+=this.speed.x,this.position.y+=this.speed.y},l.prototype.setStackPos=function(a){this.stackPos=a}
       ,e(),{option:m,destroy:n,start:k,pause:j}}var c="particleground";a.fn[c]=function(d){if("string"==typeof arguments[0]){var e,f=arguments[0],g=Array.prototype.slice.call(arguments,1);
       return this.each(function(){a.data(this,"plugin_"+c)&&"function"==typeof a.data(this,"plugin_"+c)[f]&&(e=a.data(this,"plugin_"+c)[f].apply(this,g))}),void 0!==e?e:
       this}return"object"!=typeof d&&d?void 0:this.each(function(){a.data(this,"plugin_"+c)||a.data(this,"plugin_"+c,new b(this,d))})},a.fn[c].defaults={minSpeedX:.1,maxSpeedX:.7,minSpeedY:.1,maxSpeedY:.7,
       directionX:"center",directionY:"center",density:1e4,dotColor:"#666666",lineColor:"#666666",particleRadius:7,lineWidth:1,curvedLines:!1,proximity:100,parallax:!0,parallaxMultiplier:5,onInit:function(){},
       onDestroy:function(){}}}(jQuery),
       function(){for(var a=0,b=["ms","moz","webkit","o"],c=0;c<b.length&&!window.requestAnimationFrame;++c)window.requestAnimationFrame=window[b[c]+"RequestAnimationFrame"]
       ,window.cancelAnimationFrame=window[b[c]+"CancelAnimationFrame"]||window[b[c]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||
       (window.requestAnimationFrame=function(b){var c=(new Date).getTime(),d=Math.max(0,16-(c-a)),e=window.setTimeout(function(){b(c+d)},d);return a=c+d,e}),window.cancelAnimationFrame||
       (window.cancelAnimationFrame=function(a){clearTimeout(a)})}();
       
       $(function(){
                   
           $('#particles').particleground({
               minSpeedX: 0.4,
               maxSpeedX: 1.2,
               minSpeedY: 0.4,
               maxSpeedY: 1.2,
               directionX: 'center', // 'center', 'left' or 'right'. 'center' = dots bounce off edges
               directionY: 'center', // 'center', 'up' or 'down'. 'center' = dots bounce off edges
               density: 6000, // How many particles will be generated: one particle every n pixels
               dotColor: '#CF1F46', // noktaların rengi.
               lineColor: '#D6D6D6', // çizgilerin rengi.
               particleRadius: 5, // Dot size
               lineWidth: 1,
               curvedLines: true,
               proximity: 130, // How close two dots need to be before they join
               parallax: false
           });
       
       });</script>
    
    <script>
    (function(){
       'use strict';
        window.addEventListener('load',function(){
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms,function(form){
                form.addEventListener('submit',function(event){
                    if(form.checkValidity()===false)
                    {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                },false)
            });
        },false);
    })();
    </script>
