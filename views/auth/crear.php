<div class="contenedor login">
<?php include_once __DIR__. '/../templates/nombre-pagina.php';?> 

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea Tu Cuenta</p>
        <!-- agrego un formulario con el metodo post -->
        <form class="formulario" method="POST" action="/crear">
            <!-- nombre -->
        <div class="campo">
                <label for="email">nombre</label>
                <input 
                    type="nombre"
                    id="nombre"
                    placeholder="tu nombre"
                    name="nombre"
                    value="<?php $usuario->nombre;?>"
                >

            </div>
            <!-- email -->
        <div class="campo">
                <label for="email">email</label>
                <input 
                    type="email"
                    id="email"
                    placeholder="tu email"
                    name="email"
                    value="<?php $usuario->email;?>"
                >

            </div>
            <!-- password -->
        <div class="campo">
                <label for="password">password</label>
                <input 
                    type="password"
                    id="password"
                    placeholder="contraseña"
                    name="password"

                >

            </div>
            <!-- Repetir password -->
        <div class="campo">
                <label for="password2">repetir password</label>
                <input 
                    type="password"
                    id="password2"
                    placeholder="repetir contraseña"
                    name="password2"
                >

            </div>

            <input type="submit" class="boton" value="crear cuenta">

        </form>
        <div class="acciones">
            <a href="/">iniciar sesion</a>
            <a href="/olvide">Olvidaste tu password?</a>
        </div>
    </div> <!-- contenedor sm -->


</div>