<?php // Inicia sessões 
session_start(); // Verifica se existe os dados da sessão de login
 if (!isset($_SESSION["email"])) { header("Location: index.php"); exit; } ?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <title>Veterinario</title>
    </head>

    <body id="body1">
        <script>
            //função pra copiar consulta (implode)
            function Copiar(consulta) {
                console.log(consulta);
                navigator.clipboard.writeText(consulta);
                alert("Resultado da consulta: " + consulta + ".");
            }
        </script>
        <?php
        //classificações de animais atendidos na clinica
        $petsAtendidos = array("Gato", "Cachorro", "Peixe", "Hamster");
        $sivelstresAtendidos = array("Veado", "Jaguatirica", "Tamanduá");
        //filtro generico (merge)
        $totalAnimais = array_merge($petsAtendidos, $sivelstresAtendidos);
        ?>
        <img src="imgs/logo.png" class="position-absolute start-50 top-0 translate-middle" id="imagelogo">

        <div class="position-absolute start-50 translate-middle bg-success rounded" id="div_2">
            <div class="p-4">
                <div class="text-center"><h5>Filtros<h5></div>
                <form method="POST" action="">
                    <label for="especifico" class="form-label">Procure um animal especifico:</label>
                    <input type="text" id="especifico" name="especifico" class="form-control">
            </div>
            <div class="m-3">
                <label for="animais" class="form-label">Escolha os tipos de animais:</label>
                <select name="animais" id="seletor" class="form-select">
                    <option value="total">Todos os animais</option>
                    <option value="pets">Apenas Pets</option>
                    <option value="silvestres">Apenas Silvestres</option>
                </select>
            </div>

            <input type="submit" value="Enviar" class="btn btn-dark ms-4">
            </form>
        </div>
        <div class="div_3">
            <?php
            // Verifica se o formulário foi enviado
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Captura o valor selecionado
                $tipoAnimal = $_POST['animais'];
                if ($tipoAnimal == "pets") {
                    $resultado = $petsAtendidos;
                } elseif ($tipoAnimal == "silvestres") {
                    $resultado = $sivelstresAtendidos;

                } elseif ($tipoAnimal == "total") {

                    $resultado = $totalAnimais;
                }
                //verifica se há uma consulta especifica
                if (!empty($_POST['especifico'])) {
                    //captura o valor do html
                    $especifico = htmlspecialchars($_POST['especifico']);
                    //verifica se o valor do html está no array
                    $encontrado = in_array($especifico, $resultado);

                    //condicional baseada na presença do valor especifico no array
                    if ($encontrado) {
                        echo
                            "<div id='div_4'>
                            <div class='bg-success rounded p-2 text-light text-center mb-5'><h5><p class='bg-success rounded p-2 text-light text-center w-100'>Resultado da consulta: Animal Encontrado<h5></p>
                         </div>";
                        //parametro para poder copiar a consulta, caso necessário
                        $parametro = '"' . $especifico . '"';
                        echo "<button onclick='Copiar(" . $parametro . ")' class='mx-auto d-block m-5 btn btn-dark position-fixed' id='botaofixo'>Copiar Consulta</button></div>";

                        echo "<img class='img-fluid rounded mx-auto d-block' src='imgs/" . $especifico . ".png' alt=" . $especifico . ">";
                        
                    } else {
                        echo "<div class='bg-success rounded p-2 text-light text-center mb-5' id='div_4'><h5><p>Resultado da consulta: Sem resultados</p><h5></div>";
                    }

                }
                //else se caso não há consulta especifica
                else {
                    echo '<div id="div_4">';
                    //coloca a consulta em ordem alfabetica (Sort)
                    sort($resultado);
                    //conta a quantidade de animais correspondentes na consulta (Count)
                    $quantidade = count($resultado);
                    echo "<div><div><div class='bg-success rounded p-2 text-light text-center mb-5' id='div_5' ><p ><h5>Resultado da consulta: " . $quantidade . " resultado(s)<h5></p></div>";
                   

                    //transfomação o array em string (implode) e criação de parametro para poder copiar a consulta, caso necessário
                    $animais = implode(", ", $resultado);
                    $parametro = '"' . $animais . '"';
                     echo "<button onclick='Copiar(" . $parametro . ")' class='mx-auto d-block m-5 btn btn-dark position-fixed' id='botaofixo'>Copiar Consulta</button></div>";
                   

                    //mostrando todos os itens correnspondetes a consulta e suas respectivas fotos (manipulação de imagem) atráves de um for
                    echo "<div class=''>";
                    for ($i = 0; $i < $quantidade; $i++) {
                        
                        
                        echo "<div class='start-50 mb-0 border mb-5 borded' id='divImages'><img class='img-fluid rounded mx-auto d-block mt-5' src='imgs/" . $resultado[$i] . ".png' alt=" . $resultado[$i] . " id='image'>";
                        echo "<p class='position-relative start-50'>" . $resultado[$i] . "</p>";
                        
                        echo "</div>";
                
                    }

                    echo "</div>";
                    echo "</div>";
                    echo "</div>";  
                }
            
            }
        
            ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA5NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>
        </div>
    </body>

    </html>