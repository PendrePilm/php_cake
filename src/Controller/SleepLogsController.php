<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * SleepLogs Controller
 *
 * @property \App\Model\Table\SleepLogsTable $SleepLogs
 * @method \App\Model\Entity\SleepLog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SleepLogsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $sleepLogs = $this->paginate($this->SleepLogs);

        $this->set(compact('sleepLogs'));
    }

    /**
     * View method
     *
     * @param string|null $id Sleep Log id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sleepLog = $this->SleepLogs->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('sleepLog'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
{
    // Créer une nouvelle entrée pour le journal de sommeil
    $sleepLog = $this->SleepLogs->newEmptyEntity();
    
    // Récupérer les utilisateurs pour la liste déroulante
    $users = $this->SleepLogs->Users->find('list', ['limit' => 200]);

    // Vérifier si le formulaire est soumis
    if ($this->request->is('post')) {
        $sleepLog = $this->SleepLogs->patchEntity($sleepLog, $this->request->getData());
        if ($this->SleepLogs->save($sleepLog)) {
            $this->Flash->success(__('The sleep log has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The sleep log could not be saved. Please, try again.'));
    }

    // Passer les données nécessaires à la vue
    $this->set(compact('sleepLog', 'users'));
}


    public function weeklySummary()
    {
        $userId = $this->Authentication->getIdentity()->get('id');
        $weekLogs = $this->SleepLogs->find('all', [
            'conditions' => [
                'user_id' => $userId,
                'date >=' => date('Y-m-d', strtotime('last monday')),
                'date <=' => date('Y-m-d', strtotime('next sunday')),
            ]
        ]);

        $totalCycles = 0;
        $consecutiveFiveCyclesDays = 0;
        $currentStreak = 0;

        foreach ($weekLogs as $log) {
            $totalCycles += $log->cycles;

            if ($log->cycles >= 5) {
                $currentStreak++;
                if ($currentStreak >= 4) {
                    $consecutiveFiveCyclesDays++;
                }
            } else {
                $currentStreak = 0;
            }
        }

        $greenIndicator = $totalCycles >= 42 && $consecutiveFiveCyclesDays >= 4;

        $this->set(compact('weekLogs', 'totalCycles', 'greenIndicator'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sleep Log id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sleepLog = $this->SleepLogs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sleepLog = $this->SleepLogs->patchEntity($sleepLog, $this->request->getData());
            if ($this->SleepLogs->save($sleepLog)) {
                $this->Flash->success(__('The sleep log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sleep log could not be saved. Please, try again.'));
        }
        $users = $this->SleepLogs->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('sleepLog', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sleep Log id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sleepLog = $this->SleepLogs->get($id);
        if ($this->SleepLogs->delete($sleepLog)) {
            $this->Flash->success(__('The sleep log has been deleted.'));
        } else {
            $this->Flash->error(__('The sleep log could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
