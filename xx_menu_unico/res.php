    
      <?php foreach ($menu->getMenu() as $m):
            $num_rows_sub = count($menu->countSub($m['id']));
            if($num_rows_sub > 0)
            {
      ?>
    <li class="menu-has-children"><a href=""><?php echo $m['titulo'] ?></a>
      <ul style="display:none">
        <?php foreach ($menu->getSubMenu($m['id']) as $s):
              $num_rows_subsub = count($menu->countSubSub($s['idmenu']));
              if( $num_rows_subsub > 0)
              {
        ?>
        <li class="menu-has-children"><a href="<?php echo $s['enlace'] ?>"><?php echo $s['titulo']; ?></a>
          <ul style="display:none">
            <?php foreach ($menu->getSubSubMenu($s['idmenu']) as $ss): ?>
              <li class=""><a href="<?php echo $ss['enlace'] ?>"><?php echo $ss['titulo']; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <?php }else{ ?>
        <li class=""><a href="<?php echo $s['enlace'] ?>"><?php echo $s['titulo']; ?></a>
        </li>
        <?php } endforeach; ?>
      </ul>
    </li>
    <?php }else{ ?>
    <li><a href="" style="color: #FFF;"><?php echo $m['titulo'] ?></a>
    </li>
    <?php } endforeach; ?>
      <li class=""><a href="../includes/logout.php" style="color: #FFF;font-weight: 900"> Salir </a>
      </li>
    

        <?php 
    $contar = explode (" ", "Irvin Yair Bustamante Hernnadez");//para saltar las conclusiones
  
  $arr = "";
  for($i = 0; $i < count($contar); $i++ )
  {

    if($i == 2)
    {
        $arr .= " <p class='menu-oc'>".$contar[$i]." ";
    }else
    if($i == count($contar))
    {
        $arr .= " ".$contar[$i]."</p> ";
    }else
    {
      $arr .= $contar[$i]." ";
    }
  }

  echo "<li class='menu-ver'>".$arr."</li>";
   ?>