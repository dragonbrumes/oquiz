<?php

namespace Oquiz\Controllers;

use Oquiz\Models\UserModel;
use Oquiz\Utils\User;

class UserController extends CoreController
{
    //affiche la view en get
    public function login() {
    // J'affiche le rendu de ma template
        echo $this->templates->render('user/login');
    }

    //controle le form de login en post
  public function loginPost() {
        // On sauvegarde la liste des erreurs dans un tableau
        $errorList = array();

        // Je récupère les données
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        // Je valide les données
        if (empty($email)) {
            $errorList[] = 'L\'adresse email doit être renseignée';
        }
        // Vérfification par un filtre de PHP que l'email est correct
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errorList[] = 'L\'adresse email n\'est pas correcte';
        }
        if (empty($password)) {
            $errorList[] = 'Le mot de passe doit être renseigné';
        }

        // Si tout est ok (aucune erreur)
        if (count($errorList) == 0) {
            // Je récupère le user correspondant au mot de passe
            // la méthode renvoie false si aucun résultat
            $userModel = UserModel::findByEmail($email);
            //dump($userModel);exit;

            // Si j'ai un résultat sous forme d'objet
            if ($userModel !== false) {
                // Alors je test le mot de passe
                if (password_verify($password, $userModel->getPassword())) {
                    // On stocke le user en session
                    // C'est suffisant pour connecter l'utilisateur
                    // Par contre, on doit convertir l'objet en StdClass
                    // $_SESSION['user'] = $userModel;
                    User::setUser($userModel);
                    //print_r($_SESSION['user']);
                    //dump($_SESSION['user']);
                    //header('Location: '.$this->router->generate('main_indexaction').' ');
                    //exit;
                    // On affiche un JSON disant que tout est ok
                    $this->sendJSON([
                        'code' => 1,
                        'url' => $this->router->generate('main_indexaction')
                    ]);
                }
                else {
                    $errorList[] = 'Le mot de passe est incorrect pour cet email';
                }
            }
            else {
                $errorList[] = 'Aucun compte n\'a été trouvé pour cet email';
            }
        }

        // J'envoie (j'affiche) les erreurs au format JSON
        $this->sendJSON([
            'code' => 2,
            'errorList' => $errorList
        ]);
    }

    public function logout() {
        // doit être connecté pour se déconnecter
        if (User::isConnected()) {
            //  appel la méthode de la librairie User, permettant de déconnecter
            User::logout();

            // redirige vers la home
            $this->redirectToRoute('main_indexaction');
        }
        else {
            // Utilisateur non connecté => redirection vers la page de connexion
            $this->redirectToRoute('user_login');
        }
    }

}
