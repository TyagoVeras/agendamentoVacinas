<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Vaccines Controller
 *
 * @property \App\Model\Table\VaccinesTable $Vaccines
 * @method \App\Model\Entity\Vaccine[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VaccinesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $vaccines = $this->paginate($this->Vaccines);

        $this->set(compact('vaccines'));
    }

    /**
     * View method
     *
     * @param string|null $id Vaccine id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vaccine = $this->Vaccines->get($id, [
            'contain' => ['Schedules'],
        ]);

        $this->set(compact('vaccine'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vaccine = $this->Vaccines->newEmptyEntity();
        if ($this->request->is('post')) {
            $vaccine = $this->Vaccines->patchEntity($vaccine, $this->request->getData());
            if ($this->Vaccines->save($vaccine)) {
                $this->Flash->success(__('The vaccine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vaccine could not be saved. Please, try again.'));
        }
        $this->set(compact('vaccine'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vaccine id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vaccine = $this->Vaccines->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vaccine = $this->Vaccines->patchEntity($vaccine, $this->request->getData());
            if ($this->Vaccines->save($vaccine)) {
                $this->Flash->success(__('The vaccine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vaccine could not be saved. Please, try again.'));
        }
        $this->set(compact('vaccine'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vaccine id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vaccine = $this->Vaccines->get($id);
        if ($this->Vaccines->delete($vaccine)) {
            $this->Flash->success(__('The vaccine has been deleted.'));
        } else {
            $this->Flash->error(__('The vaccine could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
