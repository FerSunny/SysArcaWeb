<?php
 session_start();
 date_default_timezone_set('America/Mexico_City');
 $FechaHoy=date("d/m/Y : H : i : s");
 if (isset($_SESSION['fk_id_sucursal']) && $_SESSION['fk_id_sucursal'])
 {
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Encuesta de Calidad</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body background=".././img/Captura.PNG"  
style="     
   font-family: Arial;
   font-weight: normal;
   color:  rgb(42, 5, 252);"
   >
 
<div >

<form method="post" action=".././contradores/agregar.php">
<h2 align="center">Bienvenidos a Laboratorios de Análisis Clínicos <font >ARCA</font>
 <img align="right" src=".././img/arca1.jpg" style="width:100px"></h2>
    

<h3 align="center">Encuesta de Calidad</h3>
    

<div id="titulo" align="justify"

style=" color: rgb(75, 75, 75);
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
     
        width:50% ;
        float: left;
" >
                
<br>
<h3 align="right"><font id="pg">¿Como fue la atención que le brindamos?</font><font style="color: aliceblue;"> sasasasa</font></h3><br>
<h3 align="right"><font id="pg">¿Cómo considera su tiempo de espera?</font><font style="color: aliceblue;">sasasasa</font></h3><br><br>

<h3 align="right"><font id="pg">¿Qué tan probable es que vuelva a elegir nuestros servicios?</font><font style="color: aliceblue;">sasasasa</font></h3>
</div>

<div 
style="
   width:50%;
   float: left;
"  >

 <br>
 
 
   <!-- primer boton -->
<input value="Buena" style=" height: 35px;
    background: rgb(78, 184, 8);
    border: 1px solid rgb(78, 184, 8);
    margin: 8px;
    border-radius: 5px;
  width: 25%;   
  color:black;   
  float:justify;
  " type="button" id="btv" onclick='imprimirArreglo();'> 

<input value="Regular"style=" 
width: 25%;
    color:black;
    height: 35px;
    background: rgb(241, 218, 6);
    border: 1px solid rgb(241, 218, 6);
    margin: 8px;
    border-radius: 5px;
    float:justify;
    "  type="button" id="btm" onclick='imprimirArreglo2();'>

 <input value="Mala" style="
 width: 25%; 
 color:black;
    height: 35px;
    background: red;
    border:1px solid red;
    margin: 8px;
	border-radius: 5px;" type="button" id="btr" onclick='imprimirArreglo3();'>
	<br>
	<input type="text" name="res_preg_1" id="res_preg_1" style="  width:1px; border: aliceblue">  

 <!-- segundo barra-->
<br>
<br>

 
<input  
style="
 height: 35px;
    background: rgb(78, 184, 8);
    border: 1px solid rgb(78, 184, 8);
    margin: 8px;
    border-radius: 5px;
    color:black;
	width: 25%;    
  " type="button" 
  value="Bueno" type="button"id="btv"onclick='imprimirArreglo4();'> 

  <input 
  style="  
width: 25%;
    height: 35px;
    background: rgb(241, 218, 6);
    border: 1px solid rgb(241, 218, 6);
    margin: 8px;
    color:black;
    border-radius: 5px;" 
  value="Regular" type="button" id="btm"onclick='imprimirArreglo5();'>
 
   <input
   style="
   color:black;
 width: 25%; 
    height: 35px;
    background: red;
    border:1px solid red;
    margin: 8px;
	border-radius: 5px;" value="Malo" type="button" id="btr"onclick='imprimirArreglo6();'>
	
<input type="text" name="res_preg_2"  id="res_preg_2"  style="  width:1px; border: aliceblue">  
 <!--tercera barra-->
 <br>
 <br>
 <br>
 
 <input

style="
 height: 35px;
    background: rgb(78, 184, 8);
    border: 1px solid rgb(78, 184, 8);
    margin: 8px;
    color:black;
    border-radius: 5px;
	width: 25%;  "
value="Muy Probable" type="button"id="btv"onclick='imprimirArreglo7();'>  

  <input
  style="  
  color:black;
width: 25%;
    height: 35px;
    background: rgb(241, 218, 6);
    border: 1px solid rgb(241, 218, 6);
    margin: 8px;
    border-radius: 5px;"  
  value="Probable" type="button" id="btm"onclick='imprimirArreglo8();'>
 
   <input 
   style="
   color:black;
 width: 25%; 
    height: 35px;
    background: red;
    border:1px solid red;
    margin: 8px;
	border-radius: 5px;"  
   value="Nada Probable" type="button" id="btr"onclick='imprimirArreglo9();'>
   <br>
<input type="text" name="res_preg_3" id="res_preg_3"  style="  width:1px; border: aliceblue"> 
</div> 

<div  id="titulo" 
style="width: 100%;"    
align="center"> 
<h6 style="color:white;">j</h6>

<br>

<br align="center">
<h3  id="pg">Déjanos tu comentario, tu opinión es importante para nosotros</h3>

</div>

<div  style=" width: 100%;
   height: 100%;
   margin-top: 20px;
   ">
    
    <textarea name="comentario" rows="3" placeholder="Deja tu comentario" style="width:50%;"></textarea>
    <input id="btn"type='submit' value="Enviar" type="button"
    style=" background: rgb(78, 184, 8);
   width: 30%;
   height: 10%;
   margin:40px;
   border: 14px solid rgb(78, 184, 8);
   left: 5%;
   right: 5%;
   border-radius: 4px;">  
    
</div>
</from>

<script src=".././js/bootstrap/js/bootstrap.min.js"></script>
<h1 align="center"id="tl" >Gracias por tu opinión, <font style="color:rgb(20, 20, 139);">¡será tomada en cuenta!</font></h1>


</form>

</div>

</body>

</html>
<?php

  }
  else
  {
    header("location: index.html");
  }
 ?>
<script language="javascript">

function imprimirArreglo(){
	var mesesAnio = ['2'];	
	document.getElementById('res_preg_1').value=mesesAnio.toString();
  
}
function imprimirArreglo2(){
	var mesesAnio = ['1'];	
	document.getElementById('res_preg_1').value=mesesAnio.toString();
  
}
function imprimirArreglo3(){
	var mesesAnio = ['0'];	
	document.getElementById('res_preg_1').value=mesesAnio.toString();
  
}
function imprimirArreglo4(){
	var mesesAnio = ['2'];	
	document.getElementById('res_preg_2').value=mesesAnio.toString();
  
}
function imprimirArreglo5(){
	var mesesAnio = ['1'];	
	document.getElementById('res_preg_2').value=mesesAnio.toString();
  
}
function imprimirArreglo6(){
	var mesesAnio = ['0'];	
	document.getElementById('res_preg_2').value=mesesAnio.toString();
  
}
function imprimirArreglo7(){
	var mesesAnio = ['2'];	
	document.getElementById('res_preg_3').value=mesesAnio.toString();
  
}
function imprimirArreglo8(){
	var mesesAnio = ['1'];	
	document.getElementById('res_preg_3').value=mesesAnio.toString();
  
}
function imprimirArreglo9(){
	var mesesAnio = ['0'];	
	document.getElementById('res_preg_3').value=mesesAnio.toString();
  
}
  </script>