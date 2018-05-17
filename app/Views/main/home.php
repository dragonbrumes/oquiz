<?php $this->layout('layout') ?>

<div class="container">
    <div class="row col">
        <h1>Bienvenue sur O'Quiz</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab vitae perspiciatis dolorum cupiditate quibusdam quod omnis ex sit quaerat, quia. Blanditiis id excepturi, quisquam voluptatum, sapiente earum tempore similique ad numquam hic delectus, vitae ut quod quos at magnam obcaecati!</p>
    </div>
    <div class="row col-sm d-flex flex-row justify-content-between">
        <!-- <div class="d-flex flex-row justify-content-between"> -->
            <?php foreach ($quizList as $currentQuiz): ?>
            <div><?= $currentQuiz->getId() ?>
                <h2>
                    <a href="<?= $router->generate('quiz_singlequiz', ['id' => $currentQuiz->getId()]) ?>"><?= $currentQuiz->getTitle() ?></a>
                </h2>
                <p><?= $currentQuiz->getDescription() ?></p>
                <p><small><?= $currentQuiz->getAuthorFirstName() ?>&nbsp;<?= $currentQuiz->getAuthorLastName() ?>&nbsp;<?= $currentQuiz->getIdAuthor() ?></small></p>
            </div>
            <? endforeach; ?>
        <!-- </div> -->
    </div>
</div>
