<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person $person
 */
?>
<div class="row">

    <div class="column-responsive">
        <div class="people view content">
        <?= $this->Html->link(__('Editar dados pessoais'), ['action' => 'editPeople',$person->id], ['class' => 'button float-right']) ?>

            <h4>Totalmente imunizado? <?= $person->imunizado == null ? '<span style="font-weight:bold">NÃO</span>' : '<span style="font-weight:bold">SIM</span>' ?></h4>
            <table>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <td colspan="3"><?= h($person->nome) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cpf') ?></th>
                    <td><?= h($person->cpf) ?></td>
                    <th><?= __('Cns') ?></th>
                    <td><?= h($person->cns) ?></td>
                </tr>

                <tr>
                    <th><?= __('Sexo') ?></th>
                    <td><?php if ($this->Number->format($person->sexo) == 0) {
                            echo 'Feminino';
                        } else {
                            echo 'Masculino';
                        } ?></td>
                    <th><?= __('Celular') ?></th>
                    <td><?= h($person->celular) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cep') ?></th>
                    <td><?= h($person->cep) ?></td>
                    <th><?= __('Estado') ?></th>
                    <td><?= h($person->estado) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cidade') ?></th>
                    <td><?= h($person->cidade) ?></td>
                    <th><?= __('Bairro') ?></th>
                    <td><?= h($person->bairro) ?></td>
                </tr>

                <tr>
                    <th><?= __('Rua') ?></th>
                    <td><?= h($person->rua) ?></td>
                    <th><?= __('Numerocasa') ?></th>
                    <td><?= h($person->numerocasa) ?></td>
                </tr>
                <tr>
                    <th><?= __('Data de nascimento') ?></th>
                    <td><?= h($person->datanascimento) ?></td>
                    <th><?= __('Idade') ?></th>
                    <td><?= $this->Number->format($person->idade) ?></td>
                </tr>
                <tr>
                    <th><?= __('Registro criado em') ?></th>
                    <td><?= h($person->created) ?></td>
                    <th><?= __('Ultima alteração no registro') ?></th>
                    <td><?= h($person->modified) ?></td>
                </tr>
            </table>
        </div>
        <br>
    </div>

    <div class="column-responsive">
        <div class="message default text-center">
            VINCULAR AGENDAMENTO <br>
            <small>Dados da vacinação</small>
        </div>
        <div class="people form content">
            <?= $this->Form->create($person) ?>
            <?php
            echo $this->Form->control('dose_id', ['options' => $doses, 'label' => 'Essa será sua primeira ou segunda dose?']);
            echo $this->Form->control('category_id', ['options' => $categories, 'label' => 'A qual grupo você pertence?','required'=>true,'empty'=>' - ESCOLHA A CATEGORIA -']);
            echo $this->Form->control('place_id', ['options' => $places, 'label' => 'Local da vacinação','required'=>true,'empty'=>' - ESCOLHA O LOCAL - ']);
            echo $this->Form->control('scheduling_id', ['options' => $schedules, 'label' => 'Dias e horarios disponiveis','required'=>true]);
            echo $this->Form->control('observacao', ['label' => 'Observação']);
            ?>
        </div>
        <br>
        <?= $this->Form->button(__('Agendar'), ['style' => 'width:100%']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

<div class="row">
    <div class="column-responsive">
        <div class="people view content">
            <div class="related">
                <h3>Agendamentos</h3>
                <?php if (!empty($person->schedules)) : ?>
                    <?php foreach ($person->schedules as $schedules) : ?>
                        <div class="table-responsive voucherprint">
                            <table>
                                <tr>
                                    <th><?= __('ID') ?></th>
                                    <th><?= __('Vacinado') ?></th>
                                    <th><?= __('Data') ?></th>
                                    <th><?= __('Hora') ?></th>
                                    <th><?= __('Dose') ?></th>
                                    <th><?= __('Categoria') ?></th>
                                    <th><?= __('Vacina') ?></th>
                                    <th><?= __('Local') ?></th>
                                    <th><?= __('Ações') ?></th>
                                </tr>
                                <tr>
                                    <td><?= h($schedules->id) ?></td>
                                    <td><?= h($schedules->vacinado == 0) ? 'Não' : 'Sim' ?></td>
                                    <td><?= h($schedules->data) ?></td>
                                    <td><?= h($schedules->hora) ?></td>
                                    <td><?= h($schedules->dose->descricao) ?></td>
                                    <td><?= h($schedules->category->descricao) ?></td>
                                    <td><?= h($schedules->vaccine->descricao) ?></td>
                                    <td><?= h($schedules->place->descricao) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('VER'), ['controller' => 'schedules', 'action' => 'view', $schedules->id]) ?>
                                        <?php // $this->Html->link(__('E'), ['controller'=>'schedules','action' => 'edit', $schedules->id]) 
                                        ?>
                                        <?= $this->Form->postLink(__('DESVINCULAR'), ['controller' => 'schedules', 'action' => 'unbind', $schedules->id], ['confirm' => __('VOCÊ QUER DESVINCULAR O AGENDAMENTO DO  DIA {0} , DA PESSOA {1}?   !!!ATENÇÃO!!! AO DESVINCULAR UM AGENDAMENTO VOCÊ ESTARÁ DEIXANDO LIVRE PARA QUE OUTRA PESSOA FAÇA O AGENDAMENTO NESSE MESMO DIA E HORARIO ', $schedules->display, $person->nome)]) ?>
                                        <?= $this->Form->postLink(__('EXCLUIR'), ['controller' => 'schedules', 'action' => 'delete', $schedules->id], ['confirm' => __('VOCÊ REALMENTE QUER EXCLUIR O AGENDAMENTO # {0}?', $schedules->id)]) ?>
                                    </td>
                                </tr>
                            </table>
                            <p>Observação: <span style="color:#000"><?= h($schedules->observacao) ?></span></p>
                        </div>
                        <hr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->Html->script('listar_horarios.js'); ?>