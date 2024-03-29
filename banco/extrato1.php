
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

    <div class ="esquerda">
       	
				<?php echo "Olá, ".$nome; ?>
		</div>
            <h1 class ="esquerda3" >Extrato</h1>
            <table border="1" class ="esquerda2">
				<tr>
					
					<th>Data</th>
					<th>Valor</th>

				</tr>
				<?php 
				#primeiro devemos pegar todas as movimentações

				$sql = $pdo->prepare("SELECT * FROM historico WHERE idConta = :idConta");
				$sql->bindValue(":idConta",$id);
				$sql->execute();

				# Se houver movimentação, vamos exibir com o foreach
				if($sql-> rowCount()>0){
					foreach ($sql->fetchAll() as $item) {
				?>

						<tr>
							<!-- aqui o item contem a data da operação q esta sendo convertida para caractere pela função strtotime, e enviada para date que vai formatar com dia mes Ano horas e minutos -->
							<td align="right">

							<?php echo date('d/m/Y H:i', strtotime($item['dataOperacao'])); ?>
								
							</td>
							
								<td align="right">

								<?php if ($item['tipo'] == '0'): ?> 
								<font color="green"> R$ <?php echo number_format($item['valor'], 2, ',', '.') ?> </font>

							<?php else: ?>

							<font color="red"> - R$ <?php echo number_format($item['valor'], 2, ',', '.')  ?></font>

								<?php endif; ?>

								</td>
						</tr>

						<?php
					}
				}

						?>
			</table>

