<?php
declare(strict_types = 1);

require_once __DIR__ . "./../../private/database/connection.php";
require_once __DIR__ . "./../../private/database/classes/project.class.php";

function drawSectionHeader(string $header) : void { ?>
	<header>
		<h2><?= $header ?></h2>
	</header>
<?php }

function drawStar(Project $project) : void {
	if ($project->isFavorite()) { ?>
		<i class="fa-solid fa-star"></i>
	<?php } else { ?>
		<i class="fa-regular fa-star"></i>
	<?php }
}

function drawProjectCard(Project $project, bool $isFavoriteSection) : void { 
	if ($isFavoriteSection) { ?>
		<article class="project invisible">
	<?php } else { ?>
		<article class="project">
	<?php } ?>

		<header class="flex-row">
			<h3><?= $project->getProjectName() ?></h3>
			<?php if (!$isFavoriteSection) { 
				drawStar($project);
			}?>
		</header>
		<p><?= $project->getDescription() ?></p>
		<img src="https://picsum.photos/300/300" width=300 height=300 alt="project-<?= $project->getId() ?>-image">
		<a href="<?= $project->getGithub() ?>"><i class="icon fa-brands fa-github"></i></a>
	</article>
<?php } 

function drawProjectList(PDO $db, bool $isFavoriteSection) : void { 
	$projects = Project::getFavoriteProjects($db);
	for ($i = 0; $i < count($projects); $i++) drawProjectCard($projects[$i], $isFavoriteSection);
}

function drawFavorite() { ?>
	<section id="best-projects">
		<?php drawSectionHeader("My favorite projects") ?>
		<div class="flex-row" id="best-projects-content">
			<button class="arrow left-arrow">
				<i class="fa-solid fa-caret-left"></i>
			</button>

			<?php
				$db = getDatabaseConnection();
				drawProjectList($db, true);
			?>

			<button class="arrow right-arrow">
				<i class="fa-solid fa-caret-right"></i>
			</button>
		</div>
	</section>
<?php }

function drawAllProjects() { ?>
	<section class="flex-column" id="all-projects">
		<?php
   			drawSectionHeader("All projects");
			drawProjectList(getDatabaseConnection(), false);
		?>
	</section>
<?php }

function drawSearchList() { ?>

<?php }

function drawSearchModal() { ?>
	<dialog class="modal" id="search-modal">
		<div id="search-modal-content">
			<ul class="trunctate-items">
				<li class="selected">Project 1</li>
				<li>Project 2aasjhdwjdjksahdjksahdjkshajkdhsjkdhshdjkashdjkashdjksahdjkshkdashkdsha</li>
				<li>Project 3</li>
				<li>Project 4</li>
				<li>Project 5</li>
			</ul>

			<article class="project trunctate-items">
				<header>
					<h3>Project 1</h3>
				</header>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
					the
					industry's standard dummy text ever since 1966, when designers at Letraset and James Mosley, the
					librarian at St Bride Printing Library in London, took a 1914 Cicero translation and scrambled...
				</p>

				<img src="https://picsum.photos/150/150" width=150 height=150 alt="project-1-image">
			</article>
		</div>

		<label id="search-bar" class="flex-row">
			&gt;
			<input name="search-project" type="search">
		</label>
	</dialog>
<?php }

function drawExtraActions() : void { ?>
	<div class="flex-row" id="extra-actions">
		<button class="icon" id="add-project">
			<i class="icon fa-solid fa-plus"></i>
		</button>

		<button class="icon" id="see-projects">
			<i class="fa-solid fa-magnifying-glass"></i>
		</button>
	</div>
<?php }


?>
