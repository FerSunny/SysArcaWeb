<?php 

/**
 * 
 */
class Ejemplo
{
	
	function Ciclo()
	{
		
		
		for($i = 0; $i<10; $i++)
		{
			if($i == 3)
			{
				echo "SE interrumpio la funcion";
				$this->Ejecutar($i);
			}else
			{
				echo $i;
			}
		}

		

	}


	function Ejecutar()
	{
		echo "Se ejecuto esta funcion";
		$this->Ciclo();
	}

}

$ejecutar = new Ejemplo();

$ejecutar->Ciclo();

 ?>