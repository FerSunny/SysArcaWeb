<?php
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $id_usuario=$_SESSION['id_usuario'];
  if( $fk_id_perfil == 1 || $fk_id_perfil == 11 || $fk_id_perfil == 12 || $fk_id_perfil == 13 || $fk_id_perfil == 27 || $fk_id_perfil == 28 || $fk_id_perfil == 29 || $fk_id_perfil == 30 || $fk_id_perfil == 31 || $fk_id_perfil == 19 || $fk_id_perfil == 25 || $fk_id_perfil == 36 || $fk_id_perfil ==  35 || $fk_id_perfil == 33 || $fk_id_perfil == 9)
  {
    echo '<div class="container">
      <div class="bs-docs-section clearfix">
        <div class="row">
            <div class="col-lg-12">
                <div class="bs-component">
                  <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                      <div class="container-fluid">
                          <div class="navbar-header">
                            <a class="navbar-brand" href="../xx_menu_unico/menu_principal">Inicio</a>
                          </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                          <div class="navbar-right">
                                   <a class="navbar-brand" href="../xx_menu_unico/menu_principal">
                                       <span class="glyphicon glyphicon-log-out"></span>Regresar
                                   </a>
                               </div>

                        </div>
                    </div>
                </nav>
            </div>
            </div>
        </div>
    </div>';
  }
  elseif($fk_id_perfil==3)
  {
    echo '<div class="container">
        <div class="bs-docs-section clearfix">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bs-component">
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="../xx_menu/menu_3">Inicio</a>
                            </div>
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                            <div class="navbar-right">
                                     <a class="navbar-brand" href="../xx_menu/menu_3">
                                         <span class="glyphicon glyphicon-log-out"></span>Regresar
                                     </a>
                                 </div>

                          </div>
                      </div>
                  </nav>
              </div>
              </div>
          </div>
      </div>';
  }
    elseif($fk_id_perfil==6)
  {
    echo '<div class="container">
        <div class="bs-docs-section clearfix">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bs-component">
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="../xx_menu/menu_6.php">Inicio</a>
                            </div>
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                            <div class="navbar-right">
                                     <a class="navbar-brand" href="../xx_menu/menu_6.php">
                                         <span class="glyphicon glyphicon-log-out"></span>Regresar
                                     </a>
                                 </div>

                          </div>
                      </div>
                  </nav>
              </div>
              </div>
          </div>
      </div>';
  }

  elseif($fk_id_perfil==8)
  {
    echo '<div class="container">
        <div class="bs-docs-section clearfix">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bs-component">
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="../xx_menu/menu_8.php">Inicio</a>
                            </div>
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                            <div class="navbar-right">
                                     <a class="navbar-brand" href="../xx_menu/menu_8.php">
                                         <span class="glyphicon glyphicon-log-out"></span>Regresar
                                     </a>
                                 </div>

                          </div>
                      </div>
                  </nav>
              </div>
              </div>
          </div>
      </div>';
  }
    elseif($fk_id_perfil==4)
  {
      echo '<div class="container">
        <div class="bs-docs-section clearfix">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bs-component">
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="../xx_menu/menu_4.php">Inicio</a>
                            </div>
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                            <div class="navbar-right">
                                     <a class="navbar-brand" href="../xx_menu/menu_4.php">
                                         <span class="glyphicon glyphicon-log-out"></span>Regresar
                                     </a>
                                 </div>

                          </div>
                      </div>
                  </nav>
              </div>
              </div>
          </div>
      </div>';
  }
  elseif($fk_id_perfil==12)
  {
      echo '<div class="container">
        <div class="bs-docs-section clearfix">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bs-component">
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="../xx_menu/menu_12.php">Inicio </a>
                            </div>
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                            <div class="navbar-right">
                                     <a class="navbar-brand" href="../xx_menu/menu_12.php">
                                         <span class="glyphicon glyphicon-log-out"></span>Regresar
                                     </a>
                                 </div>

                          </div>
                      </div>
                  </nav>
              </div>
              </div>
          </div>
      </div>';
  }
    elseif($fk_id_perfil==9)
  {
      echo '<div class="container">
        <div class="bs-docs-section clearfix">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bs-component">
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="../xx_menu/menu_9.php">Inicio </a>
                            </div>
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                            <div class="navbar-right">
                                     <a class="navbar-brand" href="../xx_menu/menu_9.php">
                                         <span class="glyphicon glyphicon-log-out"></span>Regresar
                                     </a>
                                 </div>

                          </div>
                      </div>
                  </nav>
              </div>
              </div>
          </div>
      </div>';
  }
    elseif($fk_id_perfil==14)
  {
      echo '<div class="container">
        <div class="bs-docs-section clearfix">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bs-component">
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="../xx_menu/menu_00.php">Inicio </a>
                            </div>
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                            <div class="navbar-right">
                                     <a class="navbar-brand" href="../xx_menu/menu_00.php">
                                         <span class="glyphicon glyphicon-log-out"></span>Regresar
                                     </a>
                                 </div>

                          </div>
                      </div>
                  </nav>
              </div>
              </div>
          </div>
      </div>';
  }

    elseif($fk_id_perfil==17)
  {
      echo '<div class="container">
        <div class="bs-docs-section clearfix">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bs-component">
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="../xx_menu/menu_fac.php">Inicio </a>
                            </div>
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                            <div class="navbar-right">
                                     <a class="navbar-brand" href="../xx_menu/menu_fac.php">
                                         <span class="glyphicon glyphicon-log-out"></span>Regresar
                                     </a>
                                 </div>

                          </div>
                      </div>
                  </nav>
              </div>
              </div>
          </div>
      </div>';
  }
      elseif($fk_id_perfil==18)
  {
      echo '<div class="container">
        <div class="bs-docs-section clearfix">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bs-component">
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="../xx_menu/menu_18.php">Inicio </a>
                            </div>
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                            <div class="navbar-right">
                                     <a class="navbar-brand" href="../xx_menu/menu_18.php">
                                         <span class="glyphicon glyphicon-log-out"></span>Regresar
                                     </a>
                                 </div>

                          </div>
                      </div>
                  </nav>
              </div>
              </div>
          </div>
      </div>';
  }
    elseif($fk_id_perfil==20)
  {
      echo '<div class="container">
        <div class="bs-docs-section clearfix">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bs-component">
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="../xx_menu/menu_20">Inicio </a>
                            </div>
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                            <div class="navbar-right">
                                     <a class="navbar-brand" href="../xx_menu/menu_20">
                                         <span class="glyphicon glyphicon-log-out"></span>Regresar
                                     </a>
                                 </div>

                          </div>
                      </div>
                  </nav>
              </div>
              </div>
          </div>
      </div>';
  }

  elseif($fk_id_perfil==21)
{
echo '<div class="container">
  <div class="bs-docs-section clearfix">
    <div class="row">
        <div class="col-lg-12">
            <div class="bs-component">
              <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                  <div class="container-fluid">
                      <div class="navbar-header">
                        <a class="navbar-brand" href="../xx_menu/menu_21">Inicio </a>
                      </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                      <div class="navbar-right">
                               <a class="navbar-brand" href="../xx_menu/menu_21">
                                   <span class="glyphicon glyphicon-log-out"></span>Regresar
                               </a>
                           </div>

                    </div>
                </div>
            </nav>
        </div>
        </div>
    </div>
</div>';
}

elseif($fk_id_perfil==22)
{
echo '<div class="container">
<div class="bs-docs-section clearfix">
  <div class="row">
      <div class="col-lg-12">
          <div class="bs-component">
            <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                <div class="container-fluid">
                    <div class="navbar-header">
                      <a class="navbar-brand" href="../xx_menu/menu_22">Inicio </a>
                    </div>
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                    <div class="navbar-right">
                             <a class="navbar-brand" href="../xx_menu/menu_22">
                                 <span class="glyphicon glyphicon-log-out"></span>Regresar
                             </a>
                         </div>

                  </div>
              </div>
          </nav>
      </div>
      </div>
  </div>
</div>';
}

elseif($fk_id_perfil==23)
{
echo '<div class="container">
<div class="bs-docs-section clearfix">
  <div class="row">
      <div class="col-lg-12">
          <div class="bs-component">
            <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                <div class="container-fluid">
                    <div class="navbar-header">
                      <a class="navbar-brand" href="../xx_menu/menu_23">Inicio </a>
                    </div>
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                    <div class="navbar-right">
                             <a class="navbar-brand" href="../xx_menu/menu_23">
                                 <span class="glyphicon glyphicon-log-out"></span>Regresar
                             </a>
                         </div>

                  </div>
              </div>
          </nav>
      </div>
      </div>
  </div>
</div>';
}
elseif($fk_id_perfil==25)
{
echo '<div class="container">
<div class="bs-docs-section clearfix">
  <div class="row">
      <div class="col-lg-12">
          <div class="bs-component">
            <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                <div class="container-fluid">
                    <div class="navbar-header">
                      <a class="navbar-brand" href="../xx_menu/menu_25">Inicio </a>
                    </div>
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                    <div class="navbar-right">
                             <a class="navbar-brand" href="../xx_menu/menu_25">
                                 <span class="glyphicon glyphicon-log-out"></span>Regresar
                             </a>
                         </div>

                  </div>
              </div>
          </nav>
      </div>
      </div>
  </div>
</div>';
}
elseif($fk_id_perfil==26)
{
echo '<div class="container">
<div class="bs-docs-section clearfix">
  <div class="row">
      <div class="col-lg-12">
          <div class="bs-component">
            <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                <div class="container-fluid">
                    <div class="navbar-header">
                      <a class="navbar-brand" href="../xx_menu/menu_26">Inicio </a>
                    </div>
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                    <div class="navbar-right">
                             <a class="navbar-brand" href="../xx_menu/menu_26">
                                 <span class="glyphicon glyphicon-log-out"></span>Regresar
                             </a>
                         </div>

                  </div>
              </div>
          </nav>
      </div>
      </div>
  </div>
</div>';
}


  else
  {
    echo '<script> alert("Perfil no asignado")</script>';
    echo "<script>location.href='../index.html'</script>";
  }
?>
