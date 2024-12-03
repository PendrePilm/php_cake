<?php
declare(strict_types=1);

namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * Users mailer.
 */
class UsersMailer extends Mailer
{
    /**
     * Envoie un email de réinitialisation de mot de passe
     *
     * @param string $email L'email de l'utilisateur
     * @param string $resetLink Le lien de réinitialisation du mot de passe
     * @return void
     */
    public function sendResetPasswordEmail(string $email, string $resetLink): void
    {
        $this->setTo($email)
             ->setSubject('Réinitialisation du mot de passe')
             ->setTemplate('reset_password')
             ->setViewVars(['resetLink' => $resetLink])
             ->setEmailFormat('html')
             ->send();
    }
}


