<?php
class Validando{
    public function validar(){
        $nome = $_POST["nomeDoUsuario"];
        if ($nome) {
            $nome = $nome . ', ';
        }

        $perguntas = [
            isset($_POST["pergunta1"]) ? $_POST["pergunta1"] : null,
            isset($_POST["pergunta2"]) ? $_POST["pergunta2"] : null,
            isset($_POST["pergunta3"]) ? $_POST["pergunta3"] : null,
            isset($_POST["pergunta4"]) ? $_POST["pergunta4"] : null,
            isset($_POST["pergunta5"]) ? $_POST["pergunta5"] : null,
            isset($_POST["pergunta6"]) ? $_POST["pergunta6"] : null,
            isset($_POST["pergunta7"]) ? $_POST["pergunta7"] : null,
            isset($_POST["pergunta8"]) ? $_POST["pergunta8"] : null,
            isset($_POST["pergunta9"]) ? $_POST["pergunta9"] : null,
            isset($_POST["pergunta10"]) ? $_POST["pergunta10"] : null
        ];

        $questoes = json_decode(file_get_contents('questoes.json'));

        for ($i = 1; $i <= 10; $i++) {
            $corretas[] = $i . strval($questoes->$i->correct);
        }

        $respostasCertas = 0;
        $naoRespondidas = 0;
        for ($i = 0; $i <= 9; $i++) {
            if ($corretas[$i] === $perguntas[$i]) {
                $respostasCertas = $respostasCertas + 1;
            }
            if ($perguntas[$i] === null) {
                $naoRespondidas = $naoRespondidas + 1;
            }
        }

        if ($respostasCertas < 7) {
            $resultado = '<h1>Você foi reprovado</h1>';
        } else {
            $resultado = '<h1>Você foi aprovado</h1>';
        }

        $respostasCertas = strval($respostasCertas * 10) . '%';

        $resultado = $resultado . '<span>' . $nome . 'você acertou ' . $respostasCertas . ' do questionário';

        if ($naoRespondidas > 0) {
            $naoRespondidas = strval($naoRespondidas * 10) . '%';
            $resultado = $resultado . ' e ' . $naoRespondidas . ' não respondidas.<span>';
        } else {
            $resultado = $resultado . '.<span>';
        }

        return $resultado;
    }
}
$validacao = new Validando();
echo $validacao->validar();