<?php
declare(strict_types=1);

namespace App\Controller;
//LOGIN
use Cake\Event\EventInterface;
use Cake\Utility\Security;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['logout']);
    }
    public function login(){
        //VERIFICA SE JA EXISTE UM LOGIN
        if($this->Auth->user('id') != null){
            $this->Flash->info(__('Você já está logado'));
            return $this->redirect(['controller'=>'users','action'=>'index']);
        }

        if($this->request->is('post')){
            
            $dados = $this->request->getData();
           
            $user = $this->Users->find('all')
            ->where(['username' => $dados['username']])
            //->where(['active' => '0'])
            ->where(['password'=> Security::hash($dados['password'], 'sha256')])
            ->first();

            if ($user) {
                if($user['active'] == 0){ 
                    $this->Flash->warning(__('Seu usuário está inativo'));
                    return $this->redirect($this->Auth->redirectUrl());
                                     
                }else{
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                }
               
            } else {
                $this->Flash->error(__('Usuário ou senha inválidos'));
            }
        }
    }

    public function logout()
    {
        $this->Flash->success('Você saiu do sistema');
        return $this->redirect($this->Auth->logout());
    }

    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
             //VERIFICANDO SE JA EXISTE UM EMAIL 
             $verificaUserExist = $this->Users->find('all')
             ->where(['username' => $user['username']])
             ->first();
             
             if ($verificaUserExist) {
                     $this->Flash->warning(__('Já existe um usuario com esse email'));
                     return $this->redirect(['action' => 'add']);
             } 
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuário salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Usuário não pode ser salvo. Por favor tente novamente'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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
}
