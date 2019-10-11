<?php 
session_start();
require'config.php';

 ?>
<!DOCTYPE html>


<html>
	<head>
			<title>Gringotts</title>
			<link rel="stylesheet" type="text/css" href="css/estilo.css">
			<link rel="shortcut icon" href="img/gringotts.png">
			
	</head>
<body>

		
			<div class="corpo branco fundoTopo">
				<header class="conteudo branco">

								<a href="index.php">
									<img src="img/gringotts.png" title="Redireciona para página inicial" class="logo">
								</a>

								<nav class=" clearfix bordas sombra cor" id="menu">
										<button id="extrato">Extrato</button>	
										<button id="conta">Conta</button>
										<button id="saldo">saldo</button>
										<button id="transferir">Transação</button>
										<a href="sair1.php" class="sair">Sair</a>
								</nav>
							
						<?php require('home.php');?>
				</header>
			</div>

					<div id="geral" class=" clearfix">

						<div class="f" id="extrato">Extrato
							<?php require'extrato1.php'; ?>

						</div>
						
						<div class="f" id="conta">Conta
							<?php require'dados.php'; ?>
						</div>
						
						<div class="f" id="saldo">Saldo
							<?php require'saldo.php'; ?>
						</div>
						
						<div class="f" id="transferir">Transação
							<?php require'transacao.php'; ?>
						</div>	
					</div>
				
		<script src = "JS/atualiza.js"> </script>
	<footer class="clearfix preto" >
		<p>&copy;2018 Banco gringotts !<br>
		<span >Este site é um projeto do curso de PWII da etec Uirapuru. Ele serve apenas para inlutração parcial do contúdo do curso de HTML5 , CSS3 , PHP e JavaScript</span></p>		
	</footer>
</body>

</html>

