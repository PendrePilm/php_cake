<?php
declare(strict_types=1);

namespace App\Controller;

class SleepLogsController extends AppController
{
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $sleepLogs = $this->paginate($this->SleepLogs);

        $this->set(compact('sleepLogs'));
    }

    public function view($id = null)
    {
        $sleepLog = $this->SleepLogs->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('sleepLog'));
    }

    public function add()
{
    $sleepLog = $this->SleepLogs->newEmptyEntity();
    
    $users = $this->SleepLogs->Users->find('list', ['limit' => 200]);

    if ($this->request->is('post')) {
        $sleepLog = $this->SleepLogs->patchEntity($sleepLog, $this->request->getData());
        if ($this->SleepLogs->save($sleepLog)) {
            $this->Flash->success(__('The sleep log has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The sleep log could not be saved. Please, try again.'));
    }

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

    public function graph()
    {
        $userId = $this->Authentication->getIdentity()->get('id'); // Récupère l'utilisateur connecté
        $sleepLogs = $this->SleepLogs->find('all', [
            'conditions' => ['user_id' => $userId],
            'order' => ['date' => 'ASC']
        ])->toArray();
    
        $days = [];
        $cycles = [];
    
        foreach ($sleepLogs as $log) {
            $days[] = $log->date->format('Y-m-d'); // Date du jour
            $bedtime = new \DateTime($log->bedtime);
            $wakeTime = new \DateTime($log->wake_time);
    
            // Calcul de la durée de sommeil en heures
            $duration = $wakeTime->diff($bedtime)->h + ($wakeTime->diff($bedtime)->i / 60);
            // Calcul du nombre de cycles (un cycle de sommeil est d'environ 90 minutes)
            $numCycles = round($duration * 60 / 90, 2);
    
            $cycles[] = $numCycles;
        }
    
        $this->set(compact('days', 'cycles'));
    }
    

    private function calculateSleepCycles($bedtime, $wakeTime)
    {
        $bedTimeInMinutes = strtotime($bedtime);
        $wakeTimeInMinutes = strtotime($wakeTime);
        $totalMinutes = ($wakeTimeInMinutes - $bedTimeInMinutes) / 60;
        return round($totalMinutes / 90, 1);
    }

}
