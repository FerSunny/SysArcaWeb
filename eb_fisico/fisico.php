<!Doctype html>
<html>
    <header>
        <title>  </title>
    </header>

    <body background="../imagenes/logo_arca_sys_web.jpg">
        <h1> Inventario Fisico Productos  </h1>

        <fieldset>
            <legend> Cantidad de productos </legend>
            <form method="POST" action="fisico.php">
                <input type="text" name="cantInputs">
                <input type="submit"name="" value="Generar">
            </form>
        </fieldset>

        <form action="procesar.php"  method="POST">
            <?php if(isset($_POST['cantInputs'])){ ?> 
                <?php for ($i=1; $i <= $_POST['cantInputs'] ; $i++) {?>
                    <input type"text" name="contacto[]" required placeholder="Producto"> 
                    <input type"number" name="cantidad[]" value="1" step="1"  required placeholder="Contacto"> <br>
                <?php } ?>
            <?php } ?>
            <input type="submit" value="PROCESAR"> 
        </form>
    </body>
</html>
