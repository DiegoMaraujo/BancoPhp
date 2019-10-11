<!DOCTYPE html>

<?php 

require 'config.php';

if(isset($_SESSION['banco']) && !empty($_SESSION['banco'])){
 #A sessão foi encontrada, logo vamos pegar o id dessa sessao para pegar o restante das informações

	$id   = $_SESSION['banco'];
	$nome = $_SESSION['nome'];
	
	$sql=$pdo->prepare("SELECT *FROM contas WHERE id = :id");
	$sql -> bindValue(":id", $id);
	$sql->execute();
	#se o select retornar alguma linha, significa que existe um usuário. Pegamos os dados da tabela desse usuário passando para variavel $info, que será o vetor.
	if ($sql->rowCount()>0) {
		$info = $sql->fetch();
	}else{
		#caso contrario, não achou ou não bate a senha, encaminha para o login
		header("Location: login.php");
		exit;
	}
}else{
		#caso contrario mandamos para o login e paramos o processamento da pagina
		header("Location: login.php");
		exit;
	}

?>
<?php

require 'config.php';

if (isset($_POST['tipo'])) {
	$tipo = $_POST['tipo'];
	$valor= str_replace(",", ".", $_POST['valor']);
	$valor=floatval($valor);

	$sql = $pdo->prepare("INSERT INTO historico (idConta, tipo, valor, dataOperacao) VALUES (:idConta, :tipo, :valor, NOW())");
	$sql->bindValue(":idConta", $_SESSION['banco']);
	$sql->bindValue(":tipo", $tipo);
	$sql->bindValue(":valor",$valor);
	$sql->execute();

	if($tipo == '0'){
		//deposito
		$sql = $pdo->prepare("UPDATE contas SET saldo = SALDO + :valor WHERE id = :id");
		$sql->bindValue(":valor", $valor);
		$sql->bindValue(":id", $_SESSION['banco']);
		$sql-> execute();

	}else{

		
		//retidada
		$sql = $pdo->prepare("UPDATE contas SET saldo = SALDO - :valor WHERE id = :id");
		$sql->bindValue(":valor", $valor);
		$sql->bindValue(":id", $_SESSION['banco']);
		$sql-> execute();

	}
	header("Location: index.php");
	exit;
	
	}
  ?>

	  	<form method="POST">
	  		Tipo de transação<br>
	  		<select name="tipo">
	  			<option value="0">Depósito</option>
	  			<option value="1">Retirada</option>
	  		</select><br>
			  Valor: <br>		  
			<input type="text" name="valor" pattern="[0-9.,]{1,}"><br>
			  
	  		<input type="submit" name="adicionar" value="Adicionar">
	  	</form>
