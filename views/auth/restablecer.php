<div class="contenedor login">
<?php include_once __DIR__. '/../templates/nombre-pagina.php';?> 

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Restablece tu contraseña</p>
        <!-- agrego un formulario con el metodo post -->
        <form class="formulario" method="POST" action="/restablecer">
    
            <!-- email -->
        <div class="campo">
                <label for="email">contraseña nueva</label>
                <input 
                    type="password"
                    id="passwor"
                    placeholder="tu nueva contraseña"
                    name="password"
                >

            </div>
        
            <input type="submit" class="boton" value="cambiar contraseña">

        </form>
        <div class="acciones">
            <a href="/">iniciar sesion</a>
            <a href="/crear">Aun no tienes cuenta? crear una</a>
        </div>
    </div> <!-- contenedor sm -->


</div>