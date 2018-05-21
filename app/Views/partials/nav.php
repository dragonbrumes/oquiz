<div class="container">
	<div class="navbar navbar-light bg-light justify-content-end">
		<div class="logo mr-auto">
			<strong><a class="navbar-brand text-primary" href="<?= $router->generate('main_indexaction'); ?>">O'Quiz</a></strong>
		</div>
		<div class="menu_hello">
            <?php if ($connectedUser) : ?>
			Bonjour <?= $connectedUser->getFirstName(); ?>
            <?php endif; ?>
		</div>
		<div class="menu_accueil">
			<a class="nav-link" href="<?= $router->generate('main_indexaction'); ?>"><i class="fas fa-home"></i>&nbsp;Accueil</a>
		</div>
		<div class="menu_moncompte mr-1 pr-1">
            <?php if ($connectedUser !== false) : ?>
            <a href="#">
            <i class="fas fa-user"></i>&nbsp;Mon compte</a>
            <?php else : ?>
			<a href="#"><i class="fas fa-edit"></i>&nbsp;Inscription</a>
            <?php endif; ?>
		</div>
		<div class="menu_log">
            <?php if ($connectedUser !== false) : ?>
			<a href="<?= $router->generate('user_logout'); ?>"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
            <?php else : ?>
            <a href="<?= $router->generate('user_login'); ?>">
            <i class="fas fa-sign-in-alt"></i>&nbsp;Login</a>
            <?php endif; ?>
		</div>
	</div>
</div>
