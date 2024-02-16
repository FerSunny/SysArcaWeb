<?php
  $fk_id_perfil=$_SESSION['fk_id_perfil'];
  $id_usuario=$_SESSION['id_usuario'];
  if($fk_id_perfil==1)
  {
    if($id_usuario == 80)
    {
      echo '<div class="container">
        <div class="bs-docs-section clearfix">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bs-component">
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="../xx_menu/menu_0">Inicio</a>
                            </div>
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                            <div class="navbar-right">
                                     <a class="navbar-brand" href="../xx_menu/menu_0">
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
    }else
    {
        echo '<div class="container">
      <div class="bs-docs-section clearfix">
        <div class="row">
            <div class="col-lg-12">
                <div class="bs-component">
                  <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                      <div class="container-fluid">
                          <div class="navbar-header">
                            <a class="navbar-brand" href="../xx_menu/menu.php">Inicio</a>
                          </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                          <div class="navbar-right">
                                   <a class="navbar-brand" href="../xx_menu/menu.php">
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


  elseif($fk_id_perfil==11)
  {
      echo '<div class="container">
        <div class="bs-docs-section clearfix">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bs-component">
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="../xx_menu/menu_11.php">Inicio</a>
                            </div>
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                            <div class="navbar-right">
                                     <a class="navbar-brand" href="../xx_menu/menu_11.php">
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
    elseif($fk_id_perfil==13)
  {
      echo '<div class="container">
        <div class="bs-docs-section clearfix">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bs-component">
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="../xx_menu/menu_13.php">Inicio </a>
                            </div>
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                            <div class="navbar-right">
                                     <a class="navbar-brand" href="../xx_menu/menu_13.php">
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

       elseif($fk_id_perfil==19)
  {
      echo '<div class="container">
        <div class="bs-docs-section clearfix">
          <div class="row">
              <div class="col-lg-12">
                  <div class="bs-component">
                    <nav class="navbar navbar-light" style="background-color: #e3f2fd; color: #fff;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                              <a class="navbar-brand" href="../xx_menu/menu_19">Inicio </a>
                            </div>
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                            <div class="navbar-right">
                                     <a class="navbar-brand" href="../xx_menu/menu_19">
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


  else
  {
    echo '<script> alert("Perfil no asignado")</script>';
    echo "<script>location.href='../index.html'</script>";
  }
?>
