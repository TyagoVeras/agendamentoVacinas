<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;

/**
 * People Controller
 *
 * @property \App\Model\Table\PeopleTable $People
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PeopleController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['existPeople', 'add', 'listarHorarios','listarLocais', 'voucher', 'loginPerson', 'profile', 'logout']);
    }

    public function existPeople()
    {
        $person = $this->People->newEmptyEntity();
        if ($this->request->is('post')) {
            // $verifyCpf = new \App\View\Helper\VerifyCpfHelper(new \Cake\View\View());
            if ($this->Recaptcha->verify()) { // if configure enable = false, always return tru
                $this->loadComponent('Validators');
                $isValidCPF = $this->Validators->validaCPF($this->request->getData('cpf'));
                if (!$isValidCPF) {
                    $this->Flash->error(__('CPF INVÁLIDO'));
                    return $this->redirect(['action' => 'existPeople']);
                }
                $person = $this->People->patchEntity($person, $this->request->getData());
                //VERIFICANDO SE JA EXISTE UM CPF CADASTRADO
                $verificaPersonExist = $this->People->find('all')
                    ->where(['cpf' => $person['cpf']])
                    ->first();

                if ($verificaPersonExist) {
                    $this->Flash->warning(__('Já existe uma pessoa agendada com esse CPF'));
                    return $this->redirect(['action' => 'loginPerson']);
                } else {
                    $this->Flash->warning(__('Faça o seu agendamento'));
                    $this->request->getSession()->write('cpf', $person['cpf']);
                    return $this->redirect(['action' => 'add']);
                }
            }
        }
        $this->set(compact('person'));
    }
    
    public function listarLocais()
    {
        $this->layout = false;
        if ($this->request->is('ajax')) {
            //PEGANDO O VALOR DO PARAM CATEGORY ENVIANDO NO ARQUIVO listar_horarios.js E ATRIBUINDO PARA A VARIAVAL CATEGORY
            $category = $this->request->getQuery('category');
            $locais_id = $this->People->Schedules->find('all')
            ->select(['place_id'])
            ->where(['And' => ['Schedules.category_id' =>$category, 'Schedules.person_id IS'=>null]])
            ->distinct(['place_id'])->toList();
            foreach($locais_id as $key => $value){
                $array[] =  $value['place_id'];
            }
            $this->loadModel('Places');
            $locais = $this->Places->find('list')->where(['id IN'=>$array ?? '']);
            return $this->response->withType('application/json')
                ->withStringBody(json_encode([$locais]));
        }
    }

    public function listarHorarios()
    {
        $this->layout = false;
        if ($this->request->is('ajax')) {
            //PEGANDO O VALOR DO PARAM CATEGORY ENVIANDO NO ARQUIVO listar_horarios.js E ATRIBUINDO PARA A VARIAVAL CATEGORY
            $category = $this->request->getQuery('category');
            $place = $this->request->getQuery('place');
            $horarios = $this->People->Schedules->find('list')
            ->where(['And' => ['Schedules.place_id' => $place, 'Schedules.category_id' =>$category, 'Schedules.person_id IS'=>null]]);
            return $this->response->withType('application/json')
                ->withStringBody(json_encode([$horarios]));
        }
    }




    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $person = $this->People->newEmptyEntity();
        if (($this->request->getSession()->read('cpf') == '') || (!$this->request->getSession()->read('cpf'))) {
            $this->Flash->error(__('CPF NÃO INFORMADO'));
            return $this->redirect(['action' => 'existPeople']);
        }
        if ($this->request->is('post')) {

            $this->loadComponent('Validators');

            //VERIFICAÇÃO DE IDADE
            if ($this->request->getData('idade') <= 0) {
                $this->Flash->error(__('IDADE INVÁLIDA'));
                return $this->redirect(['action' => 'add']);
            }

            //VERIFICANDO SE O CNS É VALIDO
            $isValidCNS = $this->Validators->validaCNS($this->request->getData('cns'));
            if (!$isValidCNS) {
                $this->Flash->error(__('CNS INVÁLIDA'));
                return $this->redirect(['action' => 'add']);
            }

            //VERIFICANDO SE JA EXISTE UM REGISTRO COM O CNS
            $existCNS = $this->People->find('all')
                ->where(['cns' => $this->request->getData('cns')])
                ->first();

            if ($existCNS) {
                $this->Flash->error(__('Já existe uma pessoa cadastrada com esse CNS. ENTRE EM CONTATO COM A ADMINISTRAÇÃO'));
                return $this->redirect(['action' => 'add']);
            }

            // //VERIFICANDO SE JA EXISTE UM CPF CADASTRADO
            // $verificaPersonExist = $this->People->find('all')
            //     ->where(['cpf' => $person['cpf']])
            //     ->first();

            // if ($verificaPersonExist) {
            //     $this->Flash->warning(__('Já existe uma pessoa agendada com esse CPF'));
            //     return $this->redirect(['action' => 'existPeople']);
            // }

            $person = $this->People->patchEntity($person, $this->request->getData());
            if ($this->People->save($person)) {
                //ATUALIZAR COLUNA EM OUTRA TABELA
                $updateschedules = TableRegistry::getTableLocator()->get('Schedules');
                $updateschedules_uniq = $updateschedules->get($person->scheduling_id); // Return article with id = $id (primary_key of row which need to get updated)
                $updateschedules_uniq->dose_id = $this->request->getData('dose_id');
                $updateschedules_uniq->observacao = $this->request->getData('observacao');
                $updateschedules_uniq->person_id = $person->id;
                $updateschedules->save($updateschedules_uniq);

                $this->Flash->success(__('Agendamento salvo! IMPRIMA SEU COMPROVANTE'));

                return $this->redirect(['action' => 'voucher', $person->id]);
            }
            $this->Flash->error(__('Existe algum erro no formulário! por favor confira os campos.'));
        }
        // $schedules = $this->People->Schedules->find('list', ['limit' => 200]);
        //esta null para começar o valor em branco e so apos o ajax da escolha da categoria e local sera preenchido
        $schedules = [];
        // $places = $this->People->Schedules->Places->find('list')->where(['active'=>1]);
        $places = [];
        $doses = $this->People->Schedules->Doses->find('list')->where(['active'=>1]);
        $categories = $this->People->Schedules->Categories->find('list')->where(['active'=>1]);
        $this->set(compact('person', 'schedules', 'doses', 'categories','places'));
    }

    public function voucher($id = null)
    {
        if (($this->request->getSession()->read('cpf') == '') || (!$this->request->getSession()->read('cpf'))) {
            $this->Flash->error(__('CPF NÃO INFORMADO'));
            return $this->redirect(['action' => 'existPeople']);
        } else {
            $person = $this->People->get($id, [
                'contain' => ['Schedules' => ['Categories', 'Places', 'Vaccines', 'Doses']],
            ]);

            if ($person->cpf != $this->request->getSession()->read('cpf')) {
                $this->Flash->error(__('CPF NÃO CORRESPONDE A ESSE CADASTRO'));
                return $this->redirect(['action' => 'existPeople']);
            } else {
                $this->set(compact('person'));
            }
        }
    }

    public function logout()
    {
        $this->request->getSession()->destroy();
        $this->Flash->success('Você saiu do sistema');
        return $this->redirect(['action' => 'existPeople']);
    }
    //login of person   

    public function loginPerson()
    {
        if ($this->request->is('post')) {
            if ($this->Recaptcha->verify()) { // if configure enable = false, always return tr
                $dados = $this->request->getData();
                $person = $this->People->find('all', ['contain' => ['Schedules' => ['Categories', 'Places', 'Vaccines', 'Doses']]])
                    ->where(['cpf' => $dados['cpf']])
                    ->where(['cns' => $dados['cns']])
                    // ->where(['password'=> Security::hash($dados['password'], 'sha256')])
                    ->first();

                if ($person) {
                    if ($person['imunizado'] == null) {
                        $this->Flash->success(__('Bem vindo ao seu perfil'));
                        $this->request->getSession()->write('cpf', $person['cpf']);
                        $this->request->getSession()->write('id_person', $person['id']);
                        // return $this->redirect(['action' => 'profile', $person->id]);
                        return $this->redirect(['action' => 'profile']);
                    } else {
                        $this->Flash->success(__('Você ja recebeu todas as vacinas necessarias. Aguarde o prazo para ficar totalmente imunizado e seja feliz 😍!!'));
                    }
                } else {
                    $this->Flash->error(__('CPF ou CNS inválidos'));
                }
            }
        }
    }


    // public function profile($id = null)
    public function profile($id = null)
    {
        $id = $this->request->getSession()->read('id_person');
        if (($this->request->getSession()->read('cpf') == '') || (!$this->request->getSession()->read('cpf'))) {
            $this->Flash->error(__('CPF NÃO INFORMADO'));
            return $this->redirect(['action' => 'existPeople']);
        } else {
            $person = $this->People->get($id, [
                'contain' => ['Schedules' => ['Categories', 'Places', 'Vaccines', 'Doses']],
            ]);
            if ($person->cpf != $this->request->getSession()->read('cpf')) {
                $this->Flash->error(__('CPF NÃO CORRESPONDE A ESSE CADASTRO'));
                return $this->redirect(['action' => 'existPeople']);
            }else{
                
                if ($this->request->is(['patch', 'post', 'put'])) {
                    $person = $this->People->patchEntity($person, $this->request->getData());
                    $this->loadComponent('Validators');
    
                    if ($this->People->save($person)) {
                        //ATUALIZAR COLUNA EM OUTRA TABELA
                        if ($person->scheduling_id != null) {
    
                            $updateschedules = TableRegistry::getTableLocator()->get('Schedules'); //PEGANDO A TABELA SCHEDULES
                            $updateschedules_uniq = $updateschedules->get($person->scheduling_id); //PEGANDO O REGISTRO DO ID SCHEDULING
                            $updateschedules_uniq->dose_id = $this->request->getData('dose_id'); //ATUALIZANDO CAMPOS
                            $updateschedules_uniq->observacao = $this->request->getData('observacao'); //ATUALIZANDO CAMPOS
                            $updateschedules_uniq->person_id = $person->id; //ATUALIZANDO CAMPOS
                            $updateschedules->save($updateschedules_uniq); //SALVANDO ESSE REGISTRO NO BANCO
                        }
    
                        $this->Flash->success(__('Seus dados foram salvos com sucesso!'));
    
                        return $this->redirect(['action' => 'profile']);
                    }
                    $this->Flash->error(__('Seus dados nao foram salvos. Por favor tente novamente'));
                }
                $listExistDoses = [];
                foreach ($person['schedules'] as $key => $value) {
                    $listExistDoses[$key] = $value['dose_id'];
                }
    
                if ($listExistDoses == null) {
                    $listExistDoses[0] = 100000000;
                }
                //debug($this->request->getSession()->destroy());
    
                $doses = $this->People->Schedules->Doses->find('list')->where(['id not in' => $listExistDoses]);
                $categories = $this->People->Schedules->Categories->find('list');
                $schedules = $this->People->Schedules->find('list', ['limit' => 200]);
                $this->set(compact('person', 'schedules', 'doses', 'categories'));
            }
        }
    }



    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $key = $this->request->getQuery('key');
        if ($key) {
            $query = $this->People->find('all')
                ->where(['Or' => ['nome like' => '%' . $key . '%', 'cpf like' => '%' . $key . '%']]);
        } else {
            $query = $this->People;
        }
        $this->paginate = [
            'contain' => ['Schedules'],
        ];
        $people = $this->paginate($query);

        $this->set(compact('people'));
    }

    /**
     * View method
     *
     * @param string|null $id Person id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $person = $this->People->get($id, [
            'contain' => ['Schedules' => ['Categories', 'Places', 'Vaccines', 'Doses']],
        ]);

        $this->set(compact('person'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Person id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $person = $this->People->get($id, [
            'contain' => ['Schedules' => ['Categories', 'Places', 'Vaccines', 'Doses']],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $person = $this->People->patchEntity($person, $this->request->getData());
            $this->loadComponent('Validators');
            //VERIFICAÇÃO DE IDADE
            // if (($this->request->getData('idade') <= 0) || ($this->request->getData('idade') > 120) || ($this->request->getData('idade') == NULL)) {
            //     $this->Flash->error(__('IDADE INVÁLIDA'));
            //     return $this->redirect(['action' => 'add']);
            // }

            //VERIFICANDO SE O CNS É VALIDO
            // $isValidCNS = $this->Validators->validaCNS($this->request->getData('cns'));
            // if (!$isValidCNS) {
            //     $this->Flash->error(__('CNS INVÁLIDA'));
            //     return $this->redirect(['action' => 'add']);
            // }
            if ($this->People->save($person)) {
                //ATUALIZAR COLUNA EM OUTRA TABELA
                $updateschedules = TableRegistry::getTableLocator()->get('Schedules'); //PEGANDO A TABELA SCHEDULES
                $updateschedules_uniq = $updateschedules->get($person->scheduling_id); //PEGANDO O REGISTRO DO ID SCHEDULING
                $updateschedules_uniq->dose_id = $this->request->getData('dose_id'); //ATUALIZANDO CAMPOS
                $updateschedules_uniq->observacao = $this->request->getData('observacao'); //ATUALIZANDO CAMPOS
                $updateschedules_uniq->person_id = $person->id; //ATUALIZANDO CAMPOS
                $updateschedules->save($updateschedules_uniq); //SALVANDO ESSE REGISTRO NO BANCO

                $this->Flash->success(__('Agendamento vinculado com sucesso'));

                return $this->redirect(['action' => 'view',$id]);
            }
            $this->Flash->error(__('The person could not be saved. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }
        $schedules = $this->People->Schedules->find('list', ['limit' => 200]);
        $places = $this->People->Schedules->Places->find('list')->where(['active'=>1]);
        $doses = $this->People->Schedules->Doses->find('list')->where(['active'=>1]);
        $categories = $this->People->Schedules->Categories->find('list')->where(['active'=>1]);
        $this->set(compact('person', 'schedules', 'doses', 'categories','places'));
    }


    public function editPeople($id = null)
    {
        $person = $this->People->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $person = $this->People->patchEntity($person, $this->request->getData());
            $this->loadComponent('Validators');
            //VERIFICAÇÃO DE IDADE
            if ($this->request->getData('idade') <= 0) {
                $this->Flash->error(__('IDADE INVÁLIDA'));
            }

            //VERIFICANDO SE O CNS É VALIDO
            $isValidCNS = $this->Validators->validaCNS($this->request->getData('cns'));
            if (!$isValidCNS) {
                $this->Flash->error(__('CNS INVÁLIDA'));
                //return $this->redirect(['action' => 'add']);
            }
            if ($this->People->save($person)) {
                $this->Flash->success(__('Dados da pessoa salvo com sucesso'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Pessoa nao pode ser salva, por favor tente novamente'));
        }
        $this->set(compact('person'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Person id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $person = $this->People->get($id);
        if ($this->People->delete($person)) {
            $this->Flash->success(__('Pessoa excluida com sucesso, e caso tenha algum agendamento vinculado a ela, tambem foi excluido!'));
        } else {
            $this->Flash->error(__('Pessoa nao pode ser excluida'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
