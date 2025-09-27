<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <?php 

        echo "PRueba";
            
            // 16**(1/2) raiz cuadra directa
            for ($numero = 1; $numero < 16; $numero++) {

                for ($divisor = 1; $numero < 10; $divisor++) {

                    $result = $numero / $divisor;

                    if ($result === $divisor) {
                        echo "La raiz cuadra $numero es igual a $result";
                    }

                }

            }

            function esPrimo ($num) {

                if ($num < 2) return false;

                //echo "Empezando con el numero $num que tiene como raiz cuadra " . sqrt($num) . " <br>";
                for ($i = 2; $i <= sqrt($num); $i++) {
                    $result = $num % $i === 0;
                    //echo "Comparando $num con $i que tiene como resultado: $result <br>";
                    if ($result) return false;
                }

                return true;

            }
            // Numeros primos del 1 al 50
            for ($x = 1; $x <= 50; $x++) {
                
                if (esPrimo($x)) {
                    //echo "Los numeros son: $x <br>"; 
                }
                
            }

        ?>

        
    </body>

</html>



