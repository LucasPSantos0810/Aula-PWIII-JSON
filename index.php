<?php
    class questionario{
		public $enunciado;
		public $alternativas;
		public $conjunto;

		public function setPerguntas($perguntas){
			$nome = $_POST["nomeDoUsuario"];

			$img1 = './ex1.jpg';
			$img2 = './ex2.jpg';
			$img3 = './ex3.jpg';
			$img4 = './ex4.jpg';
			$img5 = './ex5.jpg';
			$img6 = './ex6.jpg';
			$img7 = './ex7.jpg';
			$img8 = './ex8.jpg';
			$img9 = './ex9.jpg';
			$img10 = './ex10.jpg';

			$imgs = [null, $img1, $img2, $img3, $img4, $img5, $img6, $img7, $img8, $img9, $img10];
			$this->conjunto = '<form action="index2.php" mehod="POST"><h1 name="nomeDoUsuario" value"user">Questionário<h1><hr>';

			for($i = 1;$i <= 10;$i++){
				$this->enunciado = strval($perguntas->$i->enunciado);
				$this->alternativas = null;

				$quant = ['a', 'b', 'c', 'd', 'e'];
				$operador = 0;

				foreach($perguntas->$i->alternativas as $op):
					if($this->alternativas != null):
						$operador = $operador + 1;
						$this->alternativas = $this->alternativas . '<input type="radio" name="questao' . $i . '" value="' . $i . $quant[$operador] . '">' . $quant[$operador] . ')' . $op . '<br/>';
					else : $this->alternativas = '<input type="radio" name="pergunta' . $i . '" value="' . $i . 'a" >' . 'a)' . $op . '<br/>';
                endif;

            endforeach;

            $this->conjunto = $this->conjunto . '<div id="perguntas' . $i . '">' . '<p>' . $i . ')' . $this->enunciado . '</p>' . $this->alternativas . '<br><img src="' . $imgs[$i] . '" style="width:400px; height:250px; border-radius:15px;"></div><br/><hr><br>';
        }

        $this->conjunto = $this->conjunto . '<hr><center><input type="submit"></input><input type="hidden" name="nomeDoUsuario" value="' . $nome . '"></form>';

        return $this->conjunto;
    }
}
$perguntas = json_decode(file_get_contents('questoes.json'));

$pergunta = new questionario();

echo $pergunta->setPerguntas($perguntas);
?>