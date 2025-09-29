<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario numeros primos</title>
</head>
<body>

    <div>
        <h1>Verificador de numeros primos</h1>
        <p>Introduce un número entero para saber si es primo.</p>

        <form method="post"> <!-- este es el fichero que contiene el codigo php y va a usar el metodo post-->
            <input type="number" name="numero" placeholder="Ej: 17" required>  <!-- required bloquea el envio si no se pone un numero -->
            <br><br>

            <input type="submit" value="Verificar" name="btnPrimos">
            <br><br>
        </form>

        <div>
            <?php 
                if (isset($_POST['btnPrimos'])) {
                    include 'verificar_primo.php';
                }
            ?>
        </div>
    </div>

    <div>
        <h1>Verificador números primos entre dos enteros</h1>
        <p>Introduce dos números enteros para saber los primos entre ellos</p>

        <form method="post"> <!-- este es el fichero que contiene el codigo php y va a usar el metodo post-->
            <input type="number" name="num1" placeholder="Ej: 2" required>  <!-- required bloquea el envio si no se pone un numero -->
            <br><br>

            <input type="number" name="num2" placeholder="Ej: 30" required>  <!-- required bloquea el envio si no se pone un numero -->
            <br><br>

            <input type="submit" value="Verificar primos" name="btnPrimosEnteros">
        </form>

        <div>
            <?php 
                if (isset($_POST['btnPrimosEnteros'])) {
                    include 'verificar_primo_entre_enteros.php';
                }
            ?>
        </div>
    </div>

    
</body>
</html>