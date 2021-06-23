<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;

/**
 * Schedules Controller
 *
 * @property \App\Model\Table\SchedulesTable $Schedules
 * @method \App\Model\Entity\Schedule[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SchedulesController extends AppController
{

    public function checkin($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => ['People', 'Doses'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // if($schedule->vacinado == 1){
            //     $this->Flash->error(__('Pessoa ja foi vacinada'));
            // }
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->getData());
            $estaImunizado = $this->request->getData('person.imunizado'); // NULL -> nao | 1 -> SIM
            $foiVacinado = $this->request->getData('vacinado'); // 0 -> nao | 1 -> SIM
            $dataPrimeiraDose = $schedule->data;
            $idPerson = $schedule->person_id;
            $schedule->usercheck = $this->userLogado->id;
            $novadata = new FrozenTime($this->request->getData('novo.data'));
            //verificando se a data do proximo agendamento é menor ou igual a do dia atual
            if ( $novadata <= $dataPrimeiraDose) {
                $this->Flash->error(__('A data desse agendamento nao pode ser no mesmo dia ou menor do que a data do agendamento passado'));
                return $this->redirect(['action' => 'checkin', $id]);
            }
            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('CheckIn realizado com sucesso'));
                if ($estaImunizado == 'null' && $foiVacinado == 1) {
                    $scheduleNew = $this->Schedules->newEmptyEntity();
                    //CRIAR NOVO AGENDAMENTO
                    $scheduleNew->data = new FrozenTime($this->request->getData('novo.data'));
                    $scheduleNew->hora =  $this->request->getData('novo.hora');
                    $scheduleNew->place_id =  $this->request->getData('novo.place_id');
                    $scheduleNew->dose_id =  $this->request->getData('novo.dose_id');
                    $scheduleNew->vaccine_id =  $this->request->getData('novo.vaccine_id');
                    $scheduleNew->category_id =  $this->request->getData('novo.category_id');
                    $scheduleNew->user_id = $this->userLogado->id;
                    $scheduleNew->person_id = $idPerson;


                    //pesquisando se ja existe um agendamento com o mesmo dia e mesmo horario
                    $existSchedulesWithDateAndMinute = $this->Schedules->find()
                        ->select(['id'])
                        ->where(['data' => $scheduleNew['data']])
                        ->where(['hora' => $scheduleNew['hora']])
                        ->where(['place_id' => $scheduleNew['place_id']])
                        ->where(['vaccine_id' => $scheduleNew['vaccine_id']])
                        ->where(['category_id' => $scheduleNew['category_id']])
                        // ->where(['password'=> Security::hash($dados['password'], 'sha256')])
                        ->first();

                    if (!$existSchedulesWithDateAndMinute) {
                        $saveWithSuccess = $this->Schedules->save($scheduleNew);
                        $this->Flash->success(__('Agendamento criado com sucesso'));
                    } else {
                        $this->Flash->error(__('Ja existe um agendamento para esse dia: ' . $scheduleNew['data'] . ' e para esse horario: ' . $scheduleNew['hora'] . ' para o mesmo local e para a mesma vacina'));
                        return $this->redirect(['action' => 'checkin', $id]);
                    }
                }
                return $this->redirect(['action' => 'indexcheckin']);
            }
        }
        $people = $this->Schedules->People->find('list', ['limit' => 200]);
        $doses = $this->Schedules->Doses->find('list')->where(['id is not ' => $schedule['dose_id']]);
        $categories = $this->Schedules->Categories->find('list', ['limit' => 200])->where(['id' => $schedule->category_id]);
        $vaccines = $this->Schedules->Vaccines->find('list', ['limit' => 200])->where(['id' => $schedule->vaccine_id]);
        $places = $this->Schedules->Places->find('list', ['limit' => 200])->where(['active' => 1]);
        $users = $this->Schedules->Users->find('list', ['limit' => 200]);
        $this->set(compact('schedule', 'people', 'doses', 'categories', 'vaccines', 'places', 'users'));
    }


    //index checkin
    public function indexcheckin()
    {

        $keydate = $this->request->getQuery('keydate');
        $keytime = $this->request->getQuery('keytime');
        $this->paginate = [
            'contain' => ['People', 'Doses', 'Categories', 'Vaccines', 'Places', 'Users'],
        ];
        if ($keydate || $keytime) {
            $query = $this->Schedules->find('all')
                ->where(['And' => ['data' => $keydate, 'hora >=' => $keytime ?? '00:00:00','usercheck'=>$this->userLogado->id]]);
        } else {
            $query = $this->Schedules->find('all')->where(['usercheck'=>$this->userLogado->id]);
        }
        $schedules = $this->paginate($query);

        $this->set(compact('schedules'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $schedule = $this->Schedules->newEmptyEntity();
        if ($this->request->is('post')) {
            $schedules = $this->Schedules->newEntities($this->request->getData());
            foreach ($schedules as $schedulex) {
                $schedulex->user_id = $this->userLogado->id;
                //pesquisando se ja existe um agendamento com o mesmo dia e mesmo horario
                $existSchedulesWithDateAndMinute = $this->Schedules->find()
                    ->select(['id'])
                    ->where(['data' => $schedulex['data']])
                    ->where(['hora' => $schedulex['hora']])
                    ->where(['place_id' => $schedulex['place_id']])
                    ->where(['vaccine_id' => $schedulex['vaccine_id']])
                    ->where(['category_id' => $schedulex['category_id']])
                    // ->where(['password'=> Security::hash($dados['password'], 'sha256')])
                    ->first();

                if (!$existSchedulesWithDateAndMinute) {
                    $saveWithSuccess = $this->Schedules->save($schedulex);
                } else {
                    $this->Flash->error(__('Ja existe um agendamento para esse dia: ' . $schedulex['data'] . ' para esse horario: ' . $schedulex['hora'] . ' para o mesmo local e para a mesma vacina'));
                }
            }
            if (isset($saveWithSuccess) && $saveWithSuccess == true) {
                $this->Flash->success(__('Agendamento salvo'));
                if ($this->request->getData('save') == 'save') {
                    return $this->redirect(['action' => 'index']);
                }
            } else {

                $this->Flash->error(__('Agendamento nao foi salvo. Por favor tente novamente'));
            }
        }
        $people = $this->Schedules->People->find('list', ['limit' => 200]);
        $doses = $this->Schedules->Doses->find('list', ['limit' => 200]);
        $categories = $this->Schedules->Categories->find('list', ['limit' => 200])->where(['active' => 1]);
        $vaccines = $this->Schedules->Vaccines->find('list', ['limit' => 200])->where(['active' => 1]);
        $places = $this->Schedules->Places->find('list', ['limit' => 200])->where(['active' => 1]);
        $users = $this->Schedules->Users->find('list', ['limit' => 200]);
        $this->set(compact('schedule', 'people', 'doses', 'categories', 'vaccines', 'places', 'users'));
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($type = null)
    {
        $tipo = 'TODOS';
        if ($type == null) {
            $this->paginate = [
                'contain' => ['People', 'Doses', 'Categories', 'Vaccines', 'Places', 'Users'],
            ];
            $tipo = 'TODOS';
        } else if ($type == 1) {
            $this->paginate = [
                'contain' => ['People', 'Doses', 'Categories', 'Vaccines', 'Places', 'Users'],
                'finder' => 'schedulesEmpty'
            ];
            $tipo = 'ABERTOS';
        } else if ($type == 2) {
            $this->paginate = [
                'contain' => ['People', 'Doses', 'Categories', 'Vaccines', 'Places', 'Users'],
                'finder' => 'schedulesNotEmpty'
            ];
            $tipo = 'VINCULADOS A PACIENTES';
        } else if ($type == 3) {
            $this->paginate = [
                'contain' => ['People', 'Doses', 'Categories', 'Vaccines', 'Places', 'Users'],
                'finder' => 'schedulesIsVaccines'
            ];
            $tipo = 'C/ PACIENTES VACINADOS';
        } else if ($type == 4) {
            $this->paginate = [
                'contain' => ['People', 'Doses', 'Categories', 'Vaccines', 'Places', 'Users'],
                'finder' => 'schedulesNotCompareceram'
            ];
            $tipo = 'C/ PACIENTES QUE NÃO COMPARECERAM';
        } else {
            $this->paginate = [
                'contain' => ['People', 'Doses', 'Categories', 'Vaccines', 'Places', 'Users'],
            ];
            $tipo = 'TODOS';
        }
        $keydate = $this->request->getQuery('keydate');
        $keytime = $this->request->getQuery('keytime');
        if ($keydate || $keytime) {
            $query = $this->Schedules->find('all')
                ->where(['And' => ['data' => $keydate, 'hora >=' => $keytime ?? '00:00:00']]);
        } else {
            $query = $this->Schedules;
        }
        $schedules = $this->paginate($query);

        $this->set(compact('schedules', 'tipo'));
    }

    /**
     * View method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => ['People', 'Doses', 'Categories', 'Vaccines', 'Places', 'Users'],
        ]);

        $this->set(compact('schedule'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->getData());
            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('The schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The schedule could not be saved. Please, try again.'));
        }
        $people = $this->Schedules->People->find('list', ['limit' => 200]);
        $doses = $this->Schedules->Doses->find('list', ['limit' => 200]);
        $categories = $this->Schedules->Categories->find('list', ['limit' => 200]);
        $vaccines = $this->Schedules->Vaccines->find('list', ['limit' => 200]);
        $places = $this->Schedules->Places->find('list', ['limit' => 200]);
        $users = $this->Schedules->Users->find('list', ['limit' => 200]);
        $this->set(compact('schedule', 'people', 'doses', 'categories', 'vaccines', 'places', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schedule = $this->Schedules->get($id);
        $id_person = $schedule->person_id;
        //EXCLUINDO AGENGENDAMENTO SE NAO TIVER NINGUEM ATRELADO A ELE
        if ($id_person == null) {
            if ($this->Schedules->delete($schedule)) {
                $this->Flash->success(__('Agendamento excluido com sucesso.'));
            } else {
                $this->Flash->error(__('Agendamento nao pode ser excluido, por favor tente novamente'));
            }
            return $this->redirect(['action' => 'index']);
        }
        //EXCLUINDO AGENDAMENTO SE A PESSOA AINDA NAO TIVER SIDO VACINADA
        if ($schedule->vacinado == 0) {
            if ($this->Schedules->delete($schedule)) {
                $this->Flash->success(__('Agendamento excluido com sucesso.'));
            } else {
                $this->Flash->error(__('Agendamento nao pode ser excluido, por favor tente novamente'));
            }
            return $this->redirect(['controller' => 'people', 'action' => 'edit', $id_person]);
        } else {
            $this->Flash->error('Agendamento nao pode ser excluido porque o paciente ja foi vacinado');
            return $this->redirect(['controller' => 'people', 'action' => 'edit', $id_person]);
        }
    }

    //DESVINCULANDO UM AGENDAMENTO DE UM PACINTE
    public function unbind($id = null)
    {
        $schedule = $this->Schedules->get($id);
        $this->request->allowMethod(['post', 'delete']);
        $id_person = $schedule->person_id;
        //EXCLUINDO AGENGENDAMENTO SE NAO TIVER NINGUEM ATRELADO A ELE
        if ($id_person == null) {
            $this->Flash->error(__('Agendamento ainda não possui pessoa vinculada. Você pode usar a opção de E -> Excluir agendamento'));
            return $this->redirect(['action' => 'index']);
        }
        //DESVINCULAR VACINA SÓ SE O PACIENTE JA NAO ESTIVER SIDO VACINADO
        if ($schedule->vacinado == 0) {
            $schedule->dose_id = null; //ATUALIZANDO CAMPOS
            $schedule->observacao = ''; //ATUALIZANDO CAMPOS
            $schedule->person_id = null; //ATUALIZANDO CAMPOS
            if ($this->Schedules->save($schedule)) { //SALVANDO ESSE REGISTRO NO BANCO
                $this->Flash->success(__('Agendamento desvinculado dessa pessoa'));
            } else {
                $this->Flash->error(__('Nao conseguimos desvincular esse agendamento, tente novamente ou tente exclui-lo'));
            }
            return $this->redirect(['controller' => 'people', 'action' => 'edit', $id_person]);
        } else {
            $this->Flash->error('Agendamento nao pode ser desvinculado porque o paciente ja foi vacinado');
            return $this->redirect(['controller' => 'people', 'action' => 'edit', $id_person]);
        }
    }
}