<div class="contenedor login">
     
     <?php include_once __DIR__. '/../templates/nombre-pagina.php';?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">iniciar sesion</p>
        <!-- agrego un formulario con el metodo post -->
        <?php include_once __DIR__.'/../templates/alertas.php'; ?>
        
        <form class="formulario" method="POST" action="/">
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
            <!-- password -->
        <div class="campo">
                <label for="password">password</label>
                <input 
                    type="password"
                    id="password"
                    placeholder="tu password"
                    name="password"
                >

            </div>

            <input type="submit" class="boton" value="iniciar sesion">

        </form>

        <div class="acciones">
            <a href="/crear">Aun no tienes cuenta? crear una</a>
            <a href="/olvide">Olvidaste tu password?</a>
        </div>
    </div> <!-- contenedor sm -->


</div>