<?php $this->layout('layout') ?>
<div class="container">

<div class="row">
    <div class="col-12 d-inline-flex"><h1><?= $quiz->getTitle() ?></h1><span class="nbrQuest bg-secondary
 text-center text-white font-weight-bold rounded pt-0 mt-4" ></span></div>
    <div class="col-12"><strong><?= $quiz->getDescription() ?></strong></div>
    <div class="col"><small>By: <?= $quiz->getAuthorFirstName() ?>&nbsp;<?= $quiz->getAuthorLastName() ?></small></div>
    <?php if ($connectedUser) : ?>
    <div id="result" class="col-12 rounded alert-primary pb-2 pt-2 mb-1">Nouveau jeu : Réponsez au maximum de questions avant de valider !</div>
    <?php endif ?>
</div>
<?php $incr = 0; ?>
<div class="wrapper">

    <form id="quizForm" class="row custom-control custom-radio d-inline-flex flex-row justify-content-center m-0 p-0" action="" method="post">
        <?php foreach ($quizQuestions as $key => $currentQuestionList): ?>
        <div class="question-box position-relative border p-0 ml-2 mr-0 mb-4">
            <input type="hidden" value="question-<?= $currentQuestionList['id'] ;?>">
            <div class="bg-light border-bottom p-1 pb-2">
            <span class="level-<?= $currentQuestionList['id_level'];?> float-right text-center text-white font-weight-bold rounded pt-0"><?= $currentQuestionList['id_level'];?></span>
            <h5><?= $currentQuestionList['question'] ?></h5>
        </div>
        <div class="">
            <ul>
            <?php foreach ($currentQuestionList['0'] as $currentResponses): ?>
                <?php foreach ($currentResponses as $key => $currentResponse): ?>
                <?php $incr++; ?>
                <?php if ($connectedUser) : ?>
                <li class="deco-none"><input class="custom-control-input" id="<?= $currentQuestionList['id']."-".$incr ?>" type="radio" name="<?= $currentQuestionList['id'] ?>"  value="<?= $key ?>">
                <label class="custom-control-label" for="<?= $currentQuestionList['id']."-".$incr ?>"><?= $currentResponse ?></label>
                </li>
                <?php else: ?>
                    <li class=""><?= $currentResponse ?></li>
                </li>
                <?php endif ?>
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
        <?php if ($connectedUser) : ?>
        <button id="submit" type="submit" name="button" class="w-100 btn btn-primary rounded">Envoyer</button>
        <?php endif ?>
    </div>
</form>
</div>
</div>
