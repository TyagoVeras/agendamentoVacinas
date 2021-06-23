<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schedule $schedule
 */
use Cake\I18n\FrozenTime;
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Agendamentos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Vacinas'), ['controller' => 'vaccines', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="message default text-center">
            Novo agendamento. Criando: <span class="qntdAgendamentos">1</span>
        </div>
        <?= $this->Form->create($schedule) ?>
        <div class="agendamentosreply">
            <div id="schedules">
                <div class="schedules form content agendamentosarray">
                    <fieldset class="row" style="justify-content: space-around;">
                        <?php
                        echo $this->Form->control('0.category_id', ['options' => $categories, 'label' => 'Categoria','class'=>'schedulesinput']);
                        echo $this->Form->control('0.place_id', ['options' => $places, 'label' => 'Local', 'class'=>'schedulesinput']);
                        echo $this->Form->control('0.vaccine_id', ['options' => $vaccines, 'label' => 'Vacina','class'=>'schedulesinput']);
                        echo $this->Form->control('0.data', ['type' => 'date', 'label' => 'Data','class'=>'date schedulesinput','value'=>FrozenTime::now()->addDay()]);
                        echo $this->Form->control('0.hora', ['type' => 'time', 'label' => 'Hora','class'=>'time schedulesinput inputtime','step'=>$settings->tempodeatendimento]);
                        ?>
                        <div class="inputsaddremove">
                            <div class="input" style="margin-top:35px; margin-left:20px;float: left;width: 60px;">
                                <button type="button" class="btn btn-success add-btn">+</button>
                                <button type="button" class="btn btn-danger remove-btn">-</button>
                            </div>

                        </div>
                    </fieldset>
                </div>
            </div>

        </div>

        <?= $this->Form->button(__('Salvar'),['name'=>'save','value'=>'save','class'=>'btnpre']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
