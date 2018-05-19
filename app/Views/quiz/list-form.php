<?php $this->layout('layout') ?>
<div class="container p-0">

<div class="row">
    <div class="col">id :<?= $quiz->getId() ?></div>
    <div class="col-12"><h1><?= $quiz->getTitle() ?></h1></div>
    <div class="col-12"><strong><?= $quiz->getDescription() ?></strong></div>
    <div class="col">by: <?= $quiz->getIdAuthor() ?></div>
</div>

<div class="wrapper">

<div class="row d-flex flex-row  justify-content-start m-0 p-0">
    <form class="" action="index.html" method="post">


    <?php foreach ($questionsList as $currentQuestion): ?>
    <div class="border col-md-6 col-lg-4 ml-1 mb-1 p-0">
        <div class="bg-light border-bottom w-100 p-1 pb-2">
            <h5><?= $currentQuestion->getQuestion() ?></h5>
        </div>
        <p class="text">
            <ol class="">
                <li>
                    <input type="radio" name="contact" id="reponse1" value="telephone">
                    <label for="<?= $currentQuestion->getProp1() ?>"><?= $currentQuestion->getProp1() ?></label><?= $currentQuestion->getProp1() ?>
                </li>
                <li><?= $currentQuestion->getProp2() ?></li>
                <li><?= $currentQuestion->getProp3() ?></li>
                <li><?= $currentQuestion->getProp4() ?></li>
            </ol>
        </p>
    </div>
    <?php endforeach; ?>
    </form>
</div>

</div>

<!-- container -->
</div>
