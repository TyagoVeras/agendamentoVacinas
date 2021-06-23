<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Doses Controller
 *
 * @property \App\Model\Table\DosesTable $Doses
 * @method \App\Model\Entity\Dose[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DosesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $doses = $this->paginate($this->Doses);

        $this->set(compact('doses'));
    }

    /**
     * View method
     *
     * @param string|null $id Dose id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dose = $this->Doses->get($id, [
            'contain' => ['Schedules'=>['People','Vaccines','Categories','Places']],
        ]);

        $this->set(compact('dose'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dose = $this->Doses->newEmptyEntity();
        if ($this->request->is('post')) {
            $dose = $this->Doses->patchEntity($dose, $this->request->getData());
            if ($this->Doses->save($dose)) {
                $this->Flash->success(__('The dose has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dose could not be saved. Please, try again.'));
        }
        $this->set(compact('dose'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dose id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dose = $this->Doses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dose = $this->Doses->patchEntity($dose, $this->request->getData());
            if ($this->Doses->save($dose)) {
                $this->Flash->success(__('The dose has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dose could not be saved. Please, try again.'));
        }
        $this->set(compact('dose'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dose id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dose = $this->Doses->get($id);
        if ($this->Doses->delete($dose)) {
            $this->Flash->success(__('The dose has been deleted.'));
        } else {
            $this->Flash->error(__('The dose could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
