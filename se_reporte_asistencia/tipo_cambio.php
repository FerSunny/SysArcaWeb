<?php
function tipo_cambio_alt($divisa="USD", $decimales=2, $tipo="venta")
{
  $url = "http://www.ixe.com.mx/rates/app?service=page/ExchangeRate";
  $banco = file_get_contents($url);
  if($banco == false) return false;
  preg_match_all('/\\$[0-9]{1,3}(?:,?[0-9]{3})*(?:\\.[0-9]{'.$decimales.'})?/',$banco,$d);
  if(empty($d)) return false;
  $div = array(
    'USD' => array(
      'compra' =>  $d[0][0],
      'venta' =>  $d[0][1]
    ),
    'EUR' => array(
      'compra' =>  $d[0][8],
      'venta' =>  $d[0][9]
    )
  );
  $tc = trim($div[strtoupper($divisa)][strtolower($tipo)], '$');
  echo  $tc;
}

tipo_cambio_alt();
?>
