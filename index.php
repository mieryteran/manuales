<?php include('conexion.php');?>
<!DOCTYPE html>
<html lang="es-ES">
  <head>
    <title>MANUALES</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="icon" type="image/png" href="img/favicon.png" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="funciones.js" type="text/javascript" language="javascript"></script>
    <script type="text/javascript" src="jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $("#new").click(function() {
        $("div#nuevo").dialog({ 
          width: "auto",  
          height: "auto",
          show: "scale",
          hide: "scale",
          resizable: "false",
          /*position: "center middle",*/
          modal: "true",
          closeOnEscape: "true"
        });
      });
     $('#enviar').click(function(event){
      var t = $("input#titulo").val();
      var c = $('textarea#contenido').val();
      var o = $('select#opt').val();
      if ( t != '' && c != '' && o != '' ) {
      event.preventDefault();
      event.stopPropagation();
        $.ajax({
             async:true,
             type:'POST',
             dataType: "html",
             contentType: "application/x-www-form-urlencoded",
             url:"nuevo.php",
             data:{titulo:t,contenido:c,opciones:o},
             beforeSend:inicioEnvio,
             success:llegadaDatos,
             timeout:4000,
             error:problemas
        });
      }

      function inicioEnvio()
      {
        var x=$("#resultados");
        x.html('cargando..');
      }

      function llegadaDatos(datos)
      {
        $("#res").text(datos);
      }

      function problemas()
      {
        $("#resultados").text('Problemas en el servidor.');
      }
    });
    });
    </script>
  </head>
  <body>
    <header>
      <h2>BUSCAR MANUALES</h2>
      <div id="menu">
        <nav>
          <table>
            <tr>
              <td>OPCIONES: 
                <select id="opciones">
                  <option value="0">SELECCIONE</option>
                  <?php 
                  $opciones = '';
                  $query = $mysqli->query('SELECT * FROM lenguajes ORDER BY lenguaje');
                  if ( $query->num_rows > 0 ){

                    while( $row = $query->fetch_assoc() ) {
                      $opciones .= "<option value={$row['id']}>{$row['lenguaje']}</option>";
                    }
                      echo $opciones;
                  }
                  ?>
                </select>
                <input type="button" id="buscar" value="buscar">
                <button id="new">Nuevo</button>
              </td>
            </tr>
          </table>
        </nav>
      </div>
    </header>
     <div id="nuevo" title="NUEVO CONTENIDO">
        <span id="res"></span>
        <form id="formulario">
      <table>
         <tr> 
            <th><label for="opt">Lenguajes:</label></th>
            <td>
              <select id="opt" name="opt">
              <?php echo $opciones;?>
              </select>
            </td>
          </td>
        </tr>
        <tr> 
            <th><label for="titulo">Titulo:</label></th>
            <td><input type="text" name="titulo" id="titulo" size="66" required="required"/></td>
          </td>
        </tr>
        <tr>
          <th><label for="contenido">Contenido:</label></th>
          <td><textarea id="contenido" name="contenido" rows="3" cols="50" required="required"></textarea></td>
          </td>
        </tr>
        <tr>
          <td colspan="2" align="right">
            <input type="submit" id="enviar" name="enviar" value="Enviar">
          </td>
          </td>
        </tr>
      </table>
      </form>
    </div>
    <div id="resultado">
    </div>
    <footer>
      <div id="pie">
        <table>
          <tr>
            <td>Manual de Lenguajes todos los derechos reservados &copy;</td>
          </tr>
        </table>
      </div>
    </footer>
  </body>
</html>