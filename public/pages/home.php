<?php
declare(strict_types = 1);

require_once __DIR__ . "/../templates/common.php";
require_once __DIR__ . "/../templates/home.tpl.php";

function drawHomePage() {
	drawHeader(); ?>
	<body>	
		<header id="site-header">
			<h1>My Journey</h1>
		</header>
		<main>
			<?php drawFavorite(); ?>
			<?php drawExtraActions(); ?>
			<?php drawAllProjects(); ?>
		</main>
		<?php drawSearchModal(); ?>
	</body>
	</html>
<?php }


drawHomePage();

?>
