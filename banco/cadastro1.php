<?php 
session_start();
require('config.php');

if(isset($_POST['cadastrar']) && !empty($_POST['cadastrar']) ) {	

if($_POST['nome'] || $_POST['agencia'] || $_POST['conta'] || $_POST['senha'] != 0 ){
	$ver = true;
	/*aqui eu pego os dados que o usuario digitou la no meu formulario*/
	$nome =  addslashes($_POST['nome']);
	$agencia =  addslashes($_POST['agencia']);
	$conta  =  addslashes($_POST['conta']);
	$senha =  md5(addslashes($_POST['senha']));/* aqui eu encripto a senha antes de inserir no BD*/
	/*aqui eu monto a query*/
	$sql ="INSERT INTO contas SET  titular = '$nome',	agencia = '$agencia',conta = '$conta', senha = '$senha'"; 	
	/*aqui eu executo a query*/
	$pdo->query($sql); /*posso usar a variavel $pdo sem declarar porque ela foi declarada em config.php*/		
	/*voltar para a pagina principal*/	
	header("Location:login.php");
	}else{
		echo '<script>alert("Preencha os campos")</script>';
	}
}
?>

<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="10"> 
	<link rel="stylesheet" type="text/css" href="css/login.css">

	<title>GRINGOTTS</title>

	<style type="text/css">
		
	</style>

</head>
<body>

	<div class="topo">
		<h1>Cadastro</h1>
	</div>
	<div style="margin-left: 600px; margin-top: 100px;" >
		<div class="formulario interna">
			<form method="POST" class="form" >
				Nome:<br/>
				<input type="text" name="nome" /><br><br><br>
				Agência:<br/>
				<input type="text" name="agencia" /><br><br>
				Conta:<br/>
				<input type="text" name="conta" /><br><br>
				Senha:<br/>
				<input type="password" name="senha" /><br><br><br>			
				 <input type="submit"  name="cadastrar" value="cadastrar" />
			</form>
		</div>
	</div>
</div>
	<footer class="clearfix " >
		<p>&copy;2018 Banco gringotts !<br>
		<span >Este site é um projeto do curso de PWII da etec Uirapuru. Ele serve apenas para inlutração parcial do contúdo do curso de  HTML5 , CSS3 , PHP e JavaScript</span></p>		
	</footer>
</body>
</html>