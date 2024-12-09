<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Menus Controller
 *
 * @property \App\Model\Table\MenusTable $Menus
 * @method \App\Model\Entity\Menu[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MenusController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $menus = $this->Menus->find('all')->order(['ordre' => 'ASC']);
        $this->set(compact('menus'));
    }

    /**
     * View method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('menu'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
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

    /**
     * Edit method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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

    /**
     * Delete method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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

    /**
     * Update Order method
     *
     * This method handles the AJAX request to update the order of menus.
     *
     * @return \Cake\Http\Response|null|void
     */
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
                $menu->ordre = $index + 1; // Mise à jour de l'ordre
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
