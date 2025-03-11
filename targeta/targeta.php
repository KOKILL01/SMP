<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de tarjeta</title>
    
    <link rel="stylesheet" href="../cartel/cartel.css">
</head>
<body>
    <div class="box">
        <div class="formulario"> 
        <form action="../targeta/SubirTargeta.php" method="post">
            <h1>Ingresa tus datos</h1> 

            <p>Nombre de propietario: *</p> 
            <input type="text" required name="nombre" > 

            <p>Número de tarjeta: *</p> 
            <input type="number" required name="numTargeta" id="targeta"> <br>
            <span id="targetaError" class="error"></span>

            <p>Fecha de vencimiento: *</p> 
            <input type="date" required name="fecha">

            <p>Código de seguridad: *</p>
            <input type="number" required name="numSeguridad" id="codigo">  
            <span id="seguridadError" class="error"></span>
            <input type="submit" value="Guardar">
        </form>

        <a href="../index/inicio.php">Cancelar</a> <br>
        </div>
    </div>
    <script src="../javas/validarTargeta.js"></script>
</body>
</html>
