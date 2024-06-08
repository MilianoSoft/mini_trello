<div class="contenedor login">
<?php include_once __DIR__. '/../templates/nombre-pagina.php';?> 

    <div class="contenedor-sm">
        <p class="descripcion-pagina">olvidaste tu contraseña</p>
        <!-- integro las alertas  -->
        <?php include_once __DIR__.'/../templates/alertas.php';?>
        
        <!-- agrego un formulario con el metodo post -->
        <form class="formulario" method="POST" action="/olvide">
    
            <!-- email -->
        <div class="campo">
                <label for="email">email</label>
                <input 
                    type="email"
                    id="email"
                    placeholder="tu email"
                    name="email"
                >

            </div>
        
            <input type="submit" class="boton" value="Enviar Instrucciones">

        </form>
        <div class="acciones">
            <a href="/">iniciar sesion</a>
            <a href="/crear">Aun no tienes cuenta? crear una</a>
        </div>
    </div> <!-- contenedor sm -->


</div>