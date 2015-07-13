<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.0/material.indigo-pink.min.css">
	<script src="https://storage.googleapis.com/code.getmdl.io/1.0.0/material.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="styles.css">
</head>
<body>
		
	<div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
		<header class="demo-header mdl-layout__header mdl-layout__header--scroll mdl-color--grey-100 mdl-color-text--grey-800">
			<div class="mdl-layout__header-row">
				<span class="mdl-layout-title">Moneybird helper</span>
				<div class="mdl-layout-spacer"></div>
			</div>
		</header>
		<div class="demo-ribbon"></div>
		<main class="demo-main mdl-layout__content">
			<div class="demo-container mdl-grid">
				<div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
				<div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
					<h3>Converteer een ING CSV naar Moneybird transactiebestand</h3>
					<form enctype="multipart/form-data" action="./upload.php" method="POST">
						<input type="file" name="inputfile" required> 
						<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">
							Converteren
						</button>
					</form>
				</div>
			</div>        
		</main>
	</div>

</body>
</html>