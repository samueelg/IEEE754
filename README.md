# Calculadora IEEE 754 (32 bits)

## Descrição

Este projeto consiste em uma calculadora desenvolvida em PHP para demonstrar o funcionamento do padrão IEEE 754 de precisão simples (32 bits). O programa realiza a conversão de números decimais para sua representação em ponto flutuante, exibindo os campos que compõem o formato IEEE 754:

* Sinal (1 bit)
* Expoente (8 bits)
* Mantissa (23 bits)

Além da conversão, o programa realiza a soma de dois números informados pelo usuário e apresenta o resultado tanto em formato decimal quanto em sua representação IEEE 754.

## Funcionalidades

* Conversão de números decimais para IEEE 754 (32 bits);
* Exibição dos campos de sinal, expoente e mantissa;
* Realização de operações de soma;
* Exibição do resultado da operação em decimal e em IEEE 754;
* Demonstração dos efeitos de arredondamento e limitação de precisão do padrão IEEE 754.

## Requisitos

* PHP 8.0 ou superior

## Como executar

1. Abra um terminal na pasta do projeto.

2. Verifique se o PHP está instalado:

```bash
php -v
```

3. Execute o programa:

```bash
php IEEE754.php
```

> Caso o arquivo principal possua outro nome, substitua `IEEE754.php` pelo nome correto.

4. Informe os valores solicitados pelo programa.

### Exemplo de execução

```text
Digite o primeiro número: 0.1
Digite o segundo número: 0.2

=== NÚMERO 1 ===
Decimal: 0.1
IEEE 754: ...

=== NÚMERO 2 ===
Decimal: 0.2
IEEE 754: ...

=== SOMA ===
0.1 + 0.2 = 0.30000000000000004

Representação IEEE 754 da soma:
00111110100110011001100110011001
```

## Objetivo Acadêmico

O projeto foi desenvolvido com fins educacionais para demonstrar o funcionamento da representação de números em ponto flutuante, permitindo a análise dos conceitos de sinal, expoente, mantissa, erro de arredondamento e limitações de precisão presentes no padrão IEEE 754.
