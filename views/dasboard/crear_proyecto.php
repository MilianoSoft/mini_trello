<?php include_once __DIR__.'/headerDasboard.php';?>
<!-- aqui ira el contenido -->
 <div class="contenedor-sm">
  <!-- ingreso alertas -->
    <?php include_once __DIR__.'/../templates/alertas.php';?>
    <!-- ingreso el Formulario -->
    <form action="/crear_proyecto" class="formulario" method="post">
      <!-- cargo el formulario desde el form -->
      <?php include_once __DIR__.'/formularioProyecto.php';?>
      <input type="submit" value="crear proyecto">
    </form> <!-- fin del form -->
 </div> <!-- fin del div -->
<!-- fin del contenido -->
<?php include_once __DIR__.'/footerDasboard.php';?>