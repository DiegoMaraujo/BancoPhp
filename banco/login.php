<?php
session_start();
require "config.php";

if(isset($_POST['agencia']) && !empty($_POST['agencia'])){
	$agencia = addslashes($_POST["agencia"]);
	$conta   = addslashes($_POST['conta']);
	$senha   = addslashes($_POST['senha']);

	$sql = $pdo->prepare("SELECT * FROM contas WHERE agencia = :agencia AND conta = :conta AND senha = :senha");
	$sql->bindValue(":agencia", $agencia);
	$sql->bindValue(":conta", $conta);
	$sql->bindValue(":senha", md5($senha));
	$sql->execute();

	if($sql->rowCount()>0){
		$sql = $sql->fetch();
		$_SESSION['banco'] = $sql['id'];
		$_SESSION['nome']  = $sql['titular'];
		header("Location: index.php");
		exit;
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
		<div class="data amarela">
			<script>
				var data  = new Date()
				var dias  = data.getDay()
				var mes   = data.getMonth()
				var ano   = data.getFullYear()
				var meses = new Array('Janeiro','Fevereiro','Marco', 'Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro')
				var diaSemana = new Array('Domingo', 'Segunda','Terca','Quarta','Quinta','Sexta','Sabado')
				var hoje = data.getDate()
				var hora = data.getHours()
				var min = data.getMinutes()
				var sec = data.getSeconds()
				var strHora = hora + ':' + min + ':' + sec
				var strData = diaSemana[dias] + ', ' + hoje + ' de ' + meses[mes] + ' de ' + ano
				document.write(strData + ', ' + strHora)
			</script>
		</div>
		<span class="fonte">GRINGOTTS</span>
	</div>
		
<div class="gif">
		<img src="img/gringotts.gif" alt="Bem vindo a Gringots">
</div>

<div class="centraliza ">

	<div class="formulario interna">
		<form method="POST" class="form">
			Agência:<br/>
			<input type="text" name="agencia" /><br><br>
			Conta:<br/>
			<input type="text" name="conta" /><br><br>
			Senha:<br/>
			<input type="password" name="senha" /><br><br><br>

			<input type="submit" value="Entrar" class="centralizaBotao">
			<a class="centralizaBotao" href="cadastro1.php">Cadastrar</a>
		</form>
	</div>
</div>
<div class="divuga preto clearfix">
	<h1>Faça já sua conta no banco GRINGOTTS</h1>
</div>
		<footer class="clearfix " >
		<p>&copy;2018 Banco gringotts !<br>
		<span >Este site é um projeto do curso de PWII da etec Uirapuru. Ele serve apenas para inlutração parcial do contúdo do curso de  HTML5 , CSS3 , PHP e JavaScript</span></p>		
		</footer>

</body>
</html>