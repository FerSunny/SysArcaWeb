<?php
$fk_id_perfil=$_SESSION['fk_id_perfil'];
if($fk_id_perfil==1){

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
?>
<?php
}
else
{
    if($fk_id_perfil==8){
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
?>
<?php
  }
  else
  {
    if($fk_id_perfil=11){
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
  }
}
?>