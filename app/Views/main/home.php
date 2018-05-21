<?php $this->layout('layout') ?>

<div class="container">
    <div class="row col">
        <h1><strong>Bienvenue sur O'Quiz</strong></h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab vitae perspiciatis dolorum cupiditate quibusdam quod omnis ex sit quaerat, quia. Blanditiis id excepturi, quisquam voluptatum, sapiente earum tempore similique ad numquam hic delectus, vitae ut quod quos at magnam obcaecati!</p>
    </div>
    <div class="row col-sm d-flex flex-row justify-content-between">
            <!-- boucle sur la liste des quiz -->
            <?php foreach ($quizList as $currentQuiz): ?>
            <div class="col-sm-6 col-lg-4 pb-1 mb-3">
                <h2>
                    <a href="<?= $router->generate('main_questions', ['id' => $currentQuiz->getId()]) ?>"><?= $currentQuiz->getTitle() ?></a>
                </h2>
                <div><strong><?= $currentQuiz->getDescription() ?></strong></div>
                <div><small>By: <?= $currentQuiz->getAuthorFirstName() ?>&nbsp;<?= $currentQuiz->getAuthorLastName() ?></small></div>
            </div>
            <? endforeach; ?>
    </div>
</div>
