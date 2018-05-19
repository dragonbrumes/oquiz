<?php $this->layout('layout') ?>
<div class="container p-0">

<div class="row">
    <div class="col">id :<?= $quiz->getId() ?></div>
    <div class="col-12"><h1><?= $quiz->getTitle() ?></h1></div>
    <div class="col-12"><strong><?= $quiz->getDescription() ?></strong></div>
    <div class="col">by: <?= $quiz->getIdAuthor() ?></div>
</div>

<div class="wrapper">

<!-- <div class="row d-flex flex-row  justify-content-start m-0 p-0"> -->
    <form id="quizForm" class="row custom-control custom-radio d-inline-flex flex-row justify-content-start m-0 p-0" action="" method="post">
    <!-- création des cartouches de questions -->
    <?php foreach ($questionsList as $key => $currentQuestion): ?>
    <div class="border col-md-3 p-0 ml-4 mb-4">
        <input type="hidden" value="quiz-<?= $currentQuestion['id'] ?>">
        <div class="bg-light border-bottom p-1 pb-2">
            id: <?= $currentQuestion['id'] ?>
            <h5><?= $currentQuestion['question'] ?></h5>
        </div>
        <div class="">
            <ul id="">
                <li class="deco-none"><input class="custom-control-input" type="radio" name="<?= $currentQuestion['id'] ?>" id="<?= $currentQuestion['id'] ?>-1" value="1">
                <label class="custom-control-label" for="<?= $currentQuestion['id'] ?>-1"><?= $currentQuestion['prop1'] ?></label></li>

                <li class="deco-none"><input class="custom-control-input" type="radio" name="<?= $currentQuestion['id'] ?>" id="<?= $currentQuestion['id'] ?>-2" value="2">
                <label class="custom-control-label" for="<?= $currentQuestion['id'] ?>-2"><?= $currentQuestion['prop2'] ?></label></li>

                <li class="deco-none"><input class="custom-control-input" type="radio" name="<?= $currentQuestion['id'] ?>" id="<?= $currentQuestion['id'] ?>-3" value="3">
                <label class="custom-control-label" for="<?= $currentQuestion['id'] ?>-3"><?= $currentQuestion['prop3'] ?></label></li>

                <li class="deco-none"><input class="custom-control-input" type="radio" name="<?= $currentQuestion['id'] ?>" id="<?= $currentQuestion['id'] ?>-4" value="4">
                <label class="custom-control-label" for="<?= $currentQuestion['id'] ?>-4"><?= $currentQuestion['prop4'] ?></label></li>
            </ul>
        </div>
        <div id="more-<?= $currentQuestion['id'] ?>" data-quiz="<?= $currentQuestion['id'] ?>" class="more-info alert-secondary d-none p-2">
            <div class="anecdote">
                <?= $currentQuestion['anecdote'] ?>
            </div>
            <div class="wiki">
                <a href="#"><?= $currentQuestion['wiki'] ?></a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="w-100">
        <button type="submit" name="button" class="w-100 btn btn-primary">Envoyer</button>
    </div>
</form>
<!-- </div> -->

</div>

<!-- container -->
</div>
