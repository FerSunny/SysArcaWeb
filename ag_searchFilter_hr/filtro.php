<?php
    include ("../controladores/conex.php");
    include ("../ag_searchFilter_hr/querys.php");
    session_start();
    $fk_id_perfil=$_SESSION['fk_id_perfil'];

    $data=json_decode($_POST['datas'],true);
    $tipoConsulta=$data['tipoConsulta'];
    $parametros=$data['parametros'];
    $isParametrosVacio=true;

    /*Verifica si los parametros vienen vacio*/
    foreach($parametros as $key => $value)
    {
        if($value!=null)
            $isParametrosVacio=false;
    }

    $query="";
    if(!$isParametrosVacio){
        $query = getQuery($tipoConsulta,$fk_id_perfil);
        foreach($parametros as $key => $value)
        {
            $query=str_replace("#".$key."#",$value,$query);
        }
        //echo $query; //quitar esta linea para ver como se construyo el query
        $resultado = mysqli_query($conexion, $query);

        while($data=mysqli_fetch_assoc($resultado)){
            $arreglo["data"][]=$data;
        }
        echo json_encode($arreglo);

        mysqli_free_result($resultado);
        mysqli_close($conexion);
    }else{
        echo "parametros vacios";
    }
?>