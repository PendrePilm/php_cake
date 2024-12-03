<?php
declare(strict_types=1);

namespace App\Controller;


use Cake\Event\EventInterface;

class UsersController extends AppController
{

    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
        
    public function creation()
    {
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success('Votre compte a été créé avec succès.');
                return $this->redirect(['action' => 'login']);
            }

            $this->Flash->error('Une erreur est survenue. Veuillez réessayer.');
        }

        $this->set(compact('user'));
    }

    public function home()
    {

    }
    
    public function forgotPassword()
    {
        $temporaryPassword = null;

        if ($this->request->is('post')) {
            $email = $this->request->getData('email');

            $user = $this->Users->findByEmail($email)->first();

            if ($user) {
                $temporaryPassword = bin2hex(random_bytes(4));

                $user->password = $temporaryPassword;

                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Votre nouveau mot de passe a été généré.'));
                } else {
                    $this->Flash->error(__('Impossible de réinitialiser le mot de passe. Veuillez réessayer.'));
                }
            } else {
                $this->Flash->error(__('Aucun utilisateur trouvé avec cette adresse e-mail.'));
            }
        }

        $this->set(compact('temporaryPassword'));
    }


public function dashboard()
{
    if (!$this->request->getAttribute('identity')) {
        $this->Flash->error('Veuillez vous connecter pour accéder au tableau de bord.');
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    $this->set('user', $this->request->getAttribute('identity'));
}


    

    public function logout()
{
    $result = $this->Authentication->getResult();
    if ($result && $result->isValid()) {
        $this->Authentication->logout();

        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
}

    public function beforeFilter(\Cake\Event\EventInterface $event)
{
    parent::beforeFilter($event);
    $this->Authentication->addUnauthenticatedActions(['login', 'creation','forgotPassword']);
}

public function login()
{
    $this->request->allowMethod(['get', 'post']);
    $result = $this->Authentication->getResult();
    if ($result && $result->isValid()) {
        $redirect = $this->request->getQuery('redirect', [
            'controller' => 'Users', 
            'action' => 'dashboard'
        ]);

        return $this->redirect($redirect);
    }
    if ($this->request->is('post') && !$result->isValid()) {
        $this->Flash->error(__('Votre identifiant ou votre mot de passe est incorrect.'));
    }

}
}