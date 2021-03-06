

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Slider</title>
<script src="jquery-1.7.2.min.js"></script>
</head>
<body>
<style>
#slider-wrap{ /* Оболочка слайдера и кнопок  Shell slider and buttons * /
	width:660px; 
	}
#slider{ /* Оболочка слайдера   shell slider */
	width:640px;
	height:360px;
	overflow: hidden;
	border:#eee solid 10px;
	position:relative;}
.slide{ /* Слайд */
	width:100%;
	height:100%;
	}
.sli-links{ /* Кнопки смены слайдов  Button switch slides */
	margin-top:10px;
	text-align:center;}
.sli-links .control-slide{
	margin:2px;
	display:inline-block;
	width:16px;
	height:16px;
	overflow:hidden;
	text-indent:-9999px;
	background:url(radioBg.png) center bottom no-repeat;}
.sli-links .control-slide:hover{
	cursor:pointer;
	background-position:center center;}
.sli-links .control-slide.active{
	background-position:center top;}
#prewbutton, #nextbutton{ /* Ссылка "Следующий" и "Пpедыдущий"  Link "Next" and "Previous"  */
	display:block;
	width:15px;
	height:100%;
	position:absolute;
	top:0;
	overflow:hidden;
	text-indent:-999px;
	background:url(arrowBg.png) left center no-repeat;
	opacity:0.8;
	z-index:3;
	outline:none !important;}
#prewbutton{left:10px;}
#nextbutton{
	right:10px;
	background:url(arrowBg.png) right center no-repeat;}
#prewbutton:hover, #nextbutton:hover{
	opacity:1;}
</style>
<script>

/*

Setup script:
Настройки скрипта:

hwSlideSpeed - Скорость анимации перехода слайда. Speed ​​slide transition animations.
hwTimeOut - время до автоматического перелистывания слайдов. time before automatically turning slides.
hwNeedLinks - включает или отключает показ ссылок "следующий - предыдущий". Значения true или false 
				Enables or disables the display of links "next - previous." True or false

*/
(function ($) {
var hwSlideSpeed = 700;
var hwTimeOut = 3000;
var hwNeedLinks = true;

$(document).ready(function(e) {
	$('.slide').css(
		{"position" : "absolute",
		 "top":'0', "left": '0'}).hide().eq(0).show();
	var slideNum = 0;
	var slideTime;
	slideCount = $("#slider .slide").size();
	var animSlide = function(arrow){
		clearTimeout(slideTime);
		$('.slide').eq(slideNum).fadeOut(hwSlideSpeed);
		if(arrow == "next"){
			if(slideNum == (slideCount-1)){slideNum=0;}
			else{slideNum++}
			}
		else if(arrow == "prew")
		{
			if(slideNum == 0){slideNum=slideCount-1;}
			else{slideNum-=1}
		}
		else{
			slideNum = arrow;
			}
		$('.slide').eq(slideNum).fadeIn(hwSlideSpeed, rotator);
		$(".control-slide.active").removeClass("active");
		$('.control-slide').eq(slideNum).addClass('active');
		}
if(hwNeedLinks){
var $linkArrow = $('<a id="prewbutton" href="#">&lt;</a><a id="nextbutton" href="#">&gt;</a>')
	.prependTo('#slider');		
	$('#nextbutton').click(function(){
		animSlide("next");
		return false;
		})
	$('#prewbutton').click(function(){
		animSlide("prew");
		return false;
		})
}
	var $adderSpan = '';
	$('.slide').each(function(index) {
			$adderSpan += '<span class = "control-slide">' + index + '</span>';
		});
	$('<div class ="sli-links">' + $adderSpan +'</div>').appendTo('#slider-wrap');
	$(".control-slide:first").addClass("active");
	$('.control-slide').click(function(){
	var goToNum = parseFloat($(this).text());
	animSlide(goToNum);
	});
	var pause = false;
	var rotator = function(){
			if(!pause){slideTime = setTimeout(function(){animSlide('next')}, hwTimeOut);}
			}
	$('#slider-wrap').hover(	
		function(){clearTimeout(slideTime); pause = true;},
		function(){pause = false; rotator();
		});
	rotator();
});
})(jQuery);

</script>
<div id="slider-wrap">
	<div id="slider">
		<div class="slide">Slider1</div>
		<div class="slide">Slider2</div>
		<div class="slide">Slider3</div>
		<div class="slide">Slider4</div>
	</div>
</div>
<?
	$dbc = mysqli_connect('localhost','root','','sony');
	
	$last_name = $_POST['lastname'];
	$price = $_POST['price'];
	
	$query = "INSERT INTO sliders(last_name,price)
					VALUES('$last_name','$price')";
					
	mysqli_query($dbc,$query);
	
	mysqli_close($dbc);
	/*$dbc = mysqli_connect('localhost','root','','sony');
	$query = "SELECT * FROM slider";
	$result = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($result);
	
	echo $row['last_name'];*/
?>
<form method="post" action=" ">
    <label for="lastname">Last name:</label>
    <input type="text" id="lastname" name="lastname" /><br />
    <label for="email">Price:</label>
    <input type="text" id="price" name="price" /><br />
    <input type="submit" name="Submit" value="Submit" />
  </form>
</body>
</html>