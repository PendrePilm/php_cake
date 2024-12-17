<?php
declare(strict_types=1);

namespace App\Controller;

class MenusController extends AppController
{
    public function index()
    {
        $menus = $this->Menus->find('all')->order(['ordre' => 'ASC']);
        $this->set(compact('menus'));
    }

    public function view($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('menu'));
    }

    public function add()
    {
        $menu = $this->Menus->newEmptyEntity();
        if ($this->request->is('post')) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        $this->set(compact('menu'));
    }

    public function edit($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        $this->set(compact('menu'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menu = $this->Menus->get($id);
        if ($this->Menus->delete($menu)) {
            $this->Flash->success(__('The menu has been deleted.'));
        } else {
            $this->Flash->error(__('The menu could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function updateOrder()
    {
        $this->request->allowMethod(['post']);

        $order = $this->request->getData('order');
        if (!$order || !is_array($order)) {
            return $this->response->withStatus(400)->withStringBody('Invalid data.');
        }

        $connection = $this->Menus->getConnection();
        $connection->begin();

        try {
            foreach ($order as $index => $id) {
                $menu = $this->Menus->get($id);
                $menu->ordre = $index + 1; 
                if (!$this->Menus->save($menu)) {
                    throw new \Exception('Failed to save menu order.');
                }
            }
            $connection->commit();
            return $this->response->withStringBody('Order updated successfully.');
        } catch (\Exception $e) {
            $connection->rollback();
            return $this->response->withStatus(500)->withStringBody('Failed to update order.');
        }
    }
}
