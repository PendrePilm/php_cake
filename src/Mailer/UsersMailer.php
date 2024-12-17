<?php
declare(strict_types=1);

namespace App\Mailer;

use Cake\Mailer\Mailer;

class UsersMailer extends Mailer
{
    
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


