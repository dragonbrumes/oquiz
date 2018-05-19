var app = {

  init: function() {
    console.log('init');

    // J'intercepte l'event "submit" du formulaire de login
    $('#formLogin').on('submit', app.submitFormLogin);
    // J'intercepte l'event "submit" du formulaire de quiz
    $('#quizForm').on('submit', app.quizForm);

  },

  quizForm: function(evt){
    //annule la soumission
    evt.preventDefault();
    //prépare pour l'envoi Ajax
    var formData = $(this).serialize();
    //envoi en Ajax
    $.ajax({
      url: BASE_PATH+'quizform', // URL appelée par Ajax
      dataType: 'json', // le type de donnée reçue
      method: 'POST', // la méthode HTTP de l'appel Ajax
      data: formData // Les données envoyés avec l'appel Ajax
    }).done(function(response){

      //https://api.jquery.com/attribute-starts-with-selector/
      //remet à zero les affichages précédents
      $('input[value^="quiz"]').next().removeClass('alert-success').removeClass('alert-warning');
      $('div[id^=more-]').addClass('d-none');
      //parcours le 1er tab de retour
      $.each(response,function(index, questions){
        //parcours le second tab
        $.each(questions,function(currentIndex, currentQuestion){

          //si question est vrai ou fausse l'affichage est modifié
          if (currentQuestion == true){
            $('input[value="quiz-'+currentIndex+'"]').next().removeClass('bg-light').addClass('alert-success');
            $('#more-'+currentIndex+'').removeClass('d-none'); // bonus wiki
          } else if (currentQuestion == false) {
            $('input[value="quiz-'+currentIndex+'"]').next().removeClass('bg-light').addClass('alert-warning');
          }
          let success = $( '.bg-light','#quizForm' ).length;
          let fail = $( '.alert-warning' ).length;
          // let none = $( '.alert-warning' ).length;

          console.log(success);
          console.log(fail);
          if(success == 0 && fail < 1){
            console.log('win');
          }

        });//2eme each
      });//1er each
    })//done

  }, // end quizForm

  submitFormLogin: function(evt) {
    // Ne pas oublier d'annuler le fonctionnement par défaut
    evt.preventDefault();

    // Je récupère toutes les données du formulaire
    var formData = $(this).serialize();

    console.log(formData);

    // Appel Ajax
    $.ajax({
      url: BASE_PATH+'login', // URL appelée par Ajax
      dataType: 'json', // le type de donnée reçue
      method: 'POST', // la méthode HTTP de l'appel Ajax
      data: formData // Les données envoyés avec l'appel Ajax
    }).done(function(response) {
      console.log(response);
      // Si tout est ok
      if (response.code == 1) {
        alert('Connexion réussie');
        // redirection vers l'url fournie
        location.href = response.url;
      }
      // Sinon, il y a eu des erreurs
      else {
        // Je vide la div des "erreurs"
        $('#errorsDiv').html('');
        // Je parcours la liste des erreurs
        response.errorList.forEach(function(value, index) {
          $('#errorsDiv').append(value+'<br>');
        });
        // J'affiche ma div cachée
        $('#errorsDiv').show();
      }
    }).fail(function() {
      alert('Error in ajax');
    });
  },

  loadCommunitiesByUser: function() {
    // Appel ajax
    $.ajax({
      url: BASE_PATH+'profile/communities/ajax',
      method: 'GET',
      dataType: 'json'
    }).done(function(response) {
      console.log(response);
      if (response.length > 0) {
        response.forEach(function(currentValue) {
          $('#communitiesList').append(currentValue.name+'<br>');
        });
      }
      else {
        $('#communitiesList').append('Aucune communauté');
      }
    }).fail(function() {
      alert('fail');
    });
  }
};

$(app.init);
