<?php
    function decimalParaIEEE754($numero){
        if($numero == 0.0){
            //Se o numero for 0, deixa todos os 32bits em 0.
            return str_repeat("0", 32);
        }

        // Sinal. O primeiro bit do IEEE 754 representa o sinal, 0 para positivo, 1 para negativo
        $sinal = 0;

        if($numero < 0){
            //Deixando o sinal negativo
            $sinal = 1;
            $numero = abs($numero);
        }

        $parteInteira = (int)$numero;
        $parteFracionaria = $numero - $parteInteira;

        //Conversão da Parte Inteira para binario
        if ($parteInteira == 0) {
            $inteiroBin = "0";
        } else {
            $inteiroBin = "";

            //Divisões sucessivar por 2, e armazenando o valor
            while ($parteInteira > 0) {
                $inteiroBin = ($parteInteira % 2) . $inteiroBin;
                
                //Divide por 2 e descarta os decimais
                $parteInteira = intdiv($parteInteira, 2);
            }
        }

        //Conversão da parte fracionaria
        $fracaoBin = "";
        
        while (strlen($fracaoBin) < 30) {
            //Multiplicações sucessivas por 2
            $parteFracionaria *= 2;

            if ($parteFracionaria >= 1) {
                $fracaoBin .= "1";

                // Remove a parte inteira gerada.
                $parteFracionaria -= 1;
            } else {
                $fracaoBin .= "0";
            }
        }

        //Normalizando
        if (strpos($inteiroBin, "1") !== false) {
            //Pega a qtde de posições que o ponto foi deslocado.
            $expoenteReal = strlen($inteiroBin) - 1;

            //Remove o primeiro 1 implícito
            $mantissaCompleta = substr($inteiroBin, 1) . $fracaoBin;

        } else {
            //Casps de números menores que 1
            $primeiroUm = strpos($fracaoBin, "1");
            $expoenteReal = -($primeiroUm + 1);

            //Remove todos os 0 até o primeiro 1
            $mantissaCompleta = substr($fracaoBin, $primeiroUm + 1);

        }

        $bias = 127;

        //Seguindo a forma: expoente armazenado = expoente real + bias
        $expoente = $expoenteReal + $bias;

        //Completa com 0 a esquerda
        $expoenteBin = str_pad(
            decbin($expoente),
            8,
            "0",
            STR_PAD_LEFT
        );

        //Mantissa (Tudo depois do primeiro 1)
        $mantissa = substr($mantissaCompleta, 0, 23);

        //Completa com 0 se faltar
        $mantissa = str_pad(
            $mantissa,
            23,
            "0"
        );

        //Montagem final dos bits
        return
            $sinal .
            $expoenteBin .
            $mantissa;
    }

    //Entrada de dois numeros
    $numero1 = (float) readline("Digite o número 1 Ex(10.04): ");
    $numero2 = (float) readline("Digite o número 2 Ex(1.0): ");

    //Conversão de decimal para IEEE754
    $ieeeA = decimalParaIEEE754($numero1);
    $ieeeB = decimalParaIEEE754($numero2);    

    echo "\n=== Numero A ===\n";
    echo "Decimal: $numero1 \n";
    echo "IEEE754: $ieeeA\n";
    echo "Sinal: " . substr($ieeeA, 0, 1) . "\n";
    echo "Expoente: " . substr($ieeeA, 1, 8) . "\n";
    echo "Mantissa: " . substr($ieeeA, 9, 23) . "\n";

    echo "\n=== Numero B ===\n";
    echo "Decimal: $numero2 \n";
    echo "IEEE754: $ieeeB\n";
    echo "Sinal: " . substr($ieeeB, 0, 1) . "\n";
    echo "Expoente: " . substr($ieeeB, 1, 8) . "\n";
    echo "Mantissa: " . substr($ieeeB, 9, 23) . "\n";

    //Soma dos numeros
    $resultadoSoma = $numero1 + $numero2;
    $ieeeResultado = decimalParaIEEE754($resultadoSoma);

    echo "\n=== SOMA ===\n";
    echo "$numero1 + $numero2 =";
    printf("%.17f\n", $resultadoSoma);

    echo "\nRepresentação IEEE 754 da soma:\n";
    echo "$ieeeResultado\n";
    ?>