<?php $this->layout('layout') ?>
<div class="container p-0">

<div class="row">
    <div class="col" quiz-id="<?= $quiz->getId() ?>">id :<?= $quiz->getId() ?></div>
    <div class="col-12"><h1><?= $quiz->getTitle() ?></h1></div>
    <div class="col-12"><strong><?= $quiz->getDescription() ?></strong></div>
    <div class="col">by: <?= $quiz->getIdAuthor() ?></div>
    <div id="result" class="col-12 rounded mb-1"></div>
</div>
<?php $incr = 0; ?>
<div class="wrapper">
    <form id="quizForm" class="row custom-control custom-radio d-inline-flex flex-row justify-content-start m-0 p-0" action="" method="post">
        <?php foreach ($quizQuestions as $key => $currentQuestionList): ?>
        <div class="question-box border p-0 ml-2 mr-0 mb-4">
            <input type="hidden" value="question-<?= $currentQuestionList['id'] ;?>">
            <div class="bg-light border-bottom p-1 pb-2">
            id: <?= $currentQuestionList['id'] ?>
            level : <?= $currentQuestionList['id_level'];?>
            <h5><?= $currentQuestionList['question'] ?></h5>
        </div>
        <div class="">
            <ul>
            <?php foreach ($currentQuestionList['0'] as $currentResponses): ?>
                <?php foreach ($currentResponses as $key => $currentResponse): ?>
                <?php $incr++; ?>
                <li class="deco-none"><input class="custom-control-input" id="<?= $currentQuestionList['id']."-".$incr ?>" type="radio" name="<?= $currentQuestionList['id'] ?>"  value="<?= $key ?>">
                <label class="custom-control-label" for="<?= $currentQuestionList['id']."-".$incr ?>"><?= $currentResponse ?></label>
                </li>
                <?php endforeach ?>
            <?php endforeach ?>
            </ul>
        </div>
        <div id="more-<?= $currentQuestionList['id'] ?>" data-quiz="<?= $currentQuestionList['id'] ?>" class="more-info alert-secondary d-none p-2">
            <div class="anecdote">
                <?= $currentQuestionList['anecdote'] ?>
            </div>
            <div class="wiki">
                <a href="#"><?= $currentQuestionList['wiki'] ?></a>
            </div>
        </div>
        </div>
    <?php endforeach ?>
    <div id="submitQuiz" class="w-100">
        <button id="submit" type="submit" name="button" class="w-100 btn btn-primary rounded">Envoyer</button>
    </div>
</form>
</div>
</div>
