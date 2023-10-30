<!DOCTYPE html>
<!-- Ayman Sbay Zekkari - Pràctica 3 -->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="Estils/estils.css">
	<title>Paginació</title>
</head>


<body>
<ul class="ull">
<li class="liii"><a class="lia">Anònim</a></li>
  <li class="lii"><a class="lia" href="model/register.php">Register</a></li>
  <li class="lii"><a class="lia" href="model/login.php">Login</a></li>
</ul>

	<div class="contenidor">
		<h1>Articles</h1>
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
			<select name="numart" id="numart" onchange="this.form.submit()">
				<option value="5" <?php if ($numArt == 5) echo "selected"; ?>>5</option>
				<option value="10" <?php if ($numArt == 10) echo "selected"; ?>>10</option>
				<option value="15" <?php if ($numArt == 15) echo "selected"; ?>>15</option>
				<option value="20" <?php if ($numArt == 20) echo "selected"; ?>>20</option>
			</select>
		</form>
		<section class="articles">
			<ul>
				<?php echo $art; ?>
			</ul>
		</section>

		<section class="paginacio">
			<ul class="pagination">
				<?php if ($pagina > 1) : ?>
					<li class="page-item">
						<a class="page-link" href="<?php echo "index.php?pagina=" . ($pagina - 1) ?>">&laquo; Anterior</a>
					</li>
				<?php endif; ?>

				<?php for ($i = 1; $i <= $pagines; $i++) : ?>
					<li class="page-item <?php echo ($i == $pagina) ? 'active' : ''; ?>">
						<a class="page-link" href="<?php echo "index.php?pagina=" . $i ?>">
							<?php echo $i; ?>
						</a>
					</li>
				<?php endfor; ?>

				<?php if ($pagina < $pagines) : ?>
					<li class="page-item">
						<a class="page-link" href="<?php echo "index.php?pagina=" . ($pagina + 1) ?>">Següent &raquo;</a>
					</li>
				<?php endif; ?>
			</ul>
		</section>
		

	</div>
</body>

</html>