<?php
	require('connection.php'); // se estiver adicionado, adiciona de novo
	include('include_dao.php');
	
	$id = $_GET['id'];
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Renanblog</title>
		<link rel="stylesheet" href = "CSS/style.css">
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	</head>
	<body>
		<?php
			$result = DAOFactory::getPostDAO()->load($id);
			
			$contentPost = new Post();
			$contentPost = $result;
			$id = $contentPost->id;
			$idUse = $contentPost->idUsuario;
			$titulo = $contentPost->titulo;
			$data = $contentPost->Data;
			$corpo = $contentPost->corpo;
			
			$r = DAOFactory::getUsuarioDAO()->load($idUse);
			$use = new Usuario();
			$use = $r;
		
			$nome = $use->nome;
			
		?>		
		<div id="postagem">
			<div id="tPost">
						
				<?php 
					$texto = $titulo."\n Por: ".$nome." | ".$data;
					echo nl2br($texto); // nl2br para o navegador reconhecer a quebra de linha
							
				?>
			</div>
						
			<div id="cPost">
				<?php echo $corpo ?> 
			</div>
			
			<div id = "tagged">
				Tagged:
				<?php
					$result = DAOFactory::getTagDAO()->load($id); // Encontrar todas as tag do post
					
					foreach($result as $single){
						$tag = new Tag();
						$tag = $single;
						$nome = $tag->nome;
						echo $nome." ";
					}
				?>
			</div>
			
		</div>

	</body>
</html>
