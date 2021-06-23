<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schedule $schedule
 */

use Cake\I18n\FrozenTime;

?>

<div class="row">
    <div class="column-responsive">
        <div class="people view content">
            <h3>Check-in</h3>
            <table>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <td><?= h($schedule->person->nome) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cpf') ?></th>
                    <td><?= h($schedule->person->cpf) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cns') ?></th>
                    <td><?= h($schedule->person->cns) ?></td>
                </tr>

                <tr>
                    <th><?= __('Sexo') ?></th>
                    <td><?php if ($this->Number->format($schedule->person->sexo) == 0) {
                            echo 'Feminino';
                        } else {
                            echo 'Masculino';
                        } ?></td>
                </tr>
                <tr>
                    <th><?= __('Data de nascimento') ?></th>
                    <td><?= h($schedule->person->datanascimento) ?></td>
                </tr>
                <tr>
                    <th><?= __('Idade') ?></th>
                    <td><?= $this->Number->format($schedule->person->idade) ?></td>
                </tr>
            </table>
        </div>
        <br>
        <div class="people view content">
            <div class="related">
                <h3>Agendamento</h3>
                <table>
                <tr>
                    <th><?= __('Data') ?></th>
                    <td><?= h($schedule->data) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hora') ?></th>
                    <td><?= h($schedule->hora) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hora') ?></th>
                    <td><?= h($schedule->dose->descricao) ?></td>
                </tr>
                
                </table>
            </div>

        </div>
    </div>
</div>
<br>
<div class="row" style="margin-bottom:20px;">
    <div class="column-responsive">
        <div class="schedules form content">
            <h3>Confirmar check-in</h3>
            <?= $this->Form->create($schedule) ?>
            <?php echo $this->Form->control('usercheck', ['value'=>$userLogado['id'],'type'=>'hidden']);  ?> 
            <fieldset>
                <?php
                $optionConfirmado = ['0' => 'Não', '1' => 'Sim'];
                echo $this->Form->control('vacinado', ['options' => $optionConfirmado, 'label' => 'Paciente foi vacinado?']);
                ?>
            </fieldset>
        </div>
    </div>
</div>
<div class="row estaimunizado" style="margin-bottom:20px;display:none">
    <div class="column-responsive">
        <div class="schedules form content">
            <h3>Paciente está totalmente imunizado?</h3>
            <fieldset>
                <?php
                $optionImunizado = ['null' => 'Não', '1' => 'Sim'];
                echo $this->Form->control('person.imunizado', ['options' => $optionImunizado, 'label' => '', 'empty'=>' - Escolha a opção -', 'required'=>false]);
                ?>
            </fieldset>

        </div>
    </div>
</div>
<div class="row novoAgendamentoCheckin" style="margin-bottom:20px;display:none">
    <div class="column-responsive">

        <div class="people form content">
            <h3>Faça o agendamento da proxima vacinação</h3>
            <fieldset class="row" style="justify-content: space-around;">
                <?php
                echo $this->Form->control('novo.category_id', ['options' => $categories, 'label' => 'Categoria', 'class' => 'schedulesinput']);
                echo $this->Form->control('novo.place_id', ['options' => $places, 'label' => 'Local', 'class' => 'schedulesinput']);
                echo $this->Form->control('novo.vaccine_id', ['options' => $vaccines, 'label' => 'Vacina', 'class' => 'schedulesinput']);
                echo $this->Form->control('novo.dose_id', ['options' => $doses, 'label' => 'Dose', 'class' => 'schedulesinput']);
                echo $this->Form->control('novo.data', ['type' => 'date', 'label' => 'Data', 'class' => 'date schedulesinput', 'value' => FrozenTime::now()->addDay()]);
                echo $this->Form->control('novo.hora', ['type' => 'time', 'label' => 'Hora', 'class' => 'time schedulesinput inputtime', 'step' => $settings->tempodeatendimento,'required'=>false]);
                ?>
            </fieldset>
        </div>
    </div>
</div>
<div class="row">
    <div class="column-responsive">
        <?= $this->Form->button(__('Salvar'),['style'=>'width:100%']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>