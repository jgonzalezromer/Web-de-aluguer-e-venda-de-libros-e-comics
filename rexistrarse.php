<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Rexistrase</title>
    </head>
    <body>
        <h1> Rexistrate </h1>
        <form method="post">
            <!--Falta comparar usuario e contrasinal cos xa rexistrados 
            e reedireciionamento correspondente-->
            Nome de usuario: <input type="text" name="nome_usuario" required><br><br>
            Contrasinal: <input type="password" name="contrasinal_usuario" required><br><br>
            Repite Contrasinal: <input type="password" required><br><br>
            Nome: <input type="text" name="nome" required><br><br>
            Dirección: <input type="text" name="direccion_usuario" required><br><br>
            Teléfono: <input type="number" name="telefono_usuario" required><br><br>
            DNI|NIF: <input type="number" name="telefono_usuario" required><br><br>
            <!--Falta reedireccionamiento-->
            <input type="submit" value="Rexistrar" href="index.php"> 
        </form>
    </body>
</html>