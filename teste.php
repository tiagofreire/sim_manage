
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<style type="text/css">
<!--
.regular {
background-color: #0099FF;
border: 2px solid #000066;
}
.drag {
background-color: #0099FF;
border: 2px solid #000066;
filter:alpha(opacity=40);
-moz-opacity:.40;
opacity:.40;
z-index:100;
}
.dragHandle {
cursor:move;
background-color:#003399;
color:#FFFFFF;
display:block;
padding:2px 0;
width:150px;
text-align:center;
}
-->
</style>
<script type="text/javascript">
document.onmousemove=getMouseMove
document.onmousedown=getMouseDown
document.onmouseup=getMouseUp
var clicked = false;
var x;
var y;
var element;
var clickX;
var clickY;
reg = new RegExp("([0-9]*)px", "i");
function getMouseDown()
{
clickItem = event.srcElement;
if(clickItem.className && clickItem.className == "dragHandle")
{
clicked = true;
element = clickItem.parentNode;
if(event.offsetX || event.offsetY) {
clickX=event.offsetX;
clickY=event.offsetY;
}
else {
clickX=event.pageX;
clickY=event.pageY;
}
element.className = 'drag';
}
}
function getMouseMove() {
if(clicked == true) {
elementX = parseInt(reg.exec(element.style.left)[1]);
elementY = parseInt(reg.exec(element.style.top)[1]);
if(event.offsetX || event.offsetY) // IE
{
document.getElementById("x").innerHTML = event.offsetX;
document.getElementById("y").innerHTML = event.offsetY;
x=elementX + (event.offsetX - clickX);
y=elementY + (event.offsetY - clickY);
if(x < 0){x=0;event.pageX = clickX;}
if(y < 0){y=0;event.pageY = clickY;}
} else { // Netscape or FireFox
document.getElementById("x").innerHTML = event.offsetX;
document.getElementById("y").innerHTML = event.offsetY ;
x=elementX + (event.pageX - clickX);
y=elementY + (event.pageY - clickY);
if(x < 0) x=0;
if(y < 0) y=0;
}
element.style.left = x +'px';
element.style.top = y +'px';
document.getElementById('xval').innerHTML = x;
document.getElementById('yval').innerHTML = y;
}
return;
}
function getMouseUp() {
if(clicked == true)
{
clicked = false;
element.className = 'regular';
element = null;
}
}
</script>
</head>
<body>
<div id="dragContainer" class="regular" style="position:absolute; top: 34px; left: 135px; height: 200px; width: 150px;" >
<div class="dragHandle">
Drag Title
</div>
<div id="content">
Here is some text in a box being draged. <a href="#" >Link goes here</a>
</div>
</div>
<div id="dragContainer2" class="regular" style="position:absolute; top: 34px; left: 467px; height: 200px; width: 150px;" >
<div class="dragHandle">
Drag Title
</div>
<div id="content">
Here is some text in a box being draged. <a href="#" >Link goes here</a>
</div>
</div>
<div id="dragContainer3" class="regular" style="position:absolute; top: 148px; left: 303px; height: 200px; width: 150px;" >
<div class="dragHandle">
Drag Title
</div>
<div id="content">
Here is some text in a box being draged. <a href="#" >Link goes here</a>
</div>
</div>
<div id="data">
<br>X: <span id="xval"></span>
<br>Y: <span id="yval"></span>
<br>
<br>Xtop: <span id="xtopval"></span>
<br>Ytop: <span id="ytopval"></span>
<br>
<br>x: <span id="x"></span>
<br>y: <span id="y"></span>
</div>
<body>
</body>
