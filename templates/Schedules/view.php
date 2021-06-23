<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schedule $schedule
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?php // $this->Html->link(__('Editar agendamento'), ['action' => 'edit', $schedule->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Excluir agendamento'), ['action' => 'delete', $schedule->id], ['confirm' => __('Você realmente quer EXCLUIR o agendamento # {0}?', $schedule->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Desvincular agendamento'), ['action' => 'unbind', $schedule->id], ['confirm' => __('Você realmente quer DESVINCULAR O AGENDAMENTO da pessoa # {0}?', $schedule->person_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Listar agendamento'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Novo agendamento'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Realizar checkin'), ['action' => 'checkin', $schedule->id], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="schedules view content">
            <h3><?= h($schedule->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Pessoa') ?></th>
                    <td><?= $schedule->has('person') ? $this->Html->link($schedule->person->nome, ['controller' => 'People', 'action' => 'view', $schedule->person->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Dose') ?></th>
                    <td><?= $schedule->has('dose') ? $this->Html->link($schedule->dose->descricao, ['controller' => 'Doses', 'action' => 'view', $schedule->dose->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Categoria') ?></th>
                    <td><?= $schedule->has('category') ? $this->Html->link($schedule->category->descricao, ['controller' => 'Categories', 'action' => 'view', $schedule->category->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Vacina') ?></th>
                    <td><?= $schedule->has('vaccine') ? $this->Html->link($schedule->vaccine->descricao, ['controller' => 'Vaccines', 'action' => 'view', $schedule->vaccine->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Local') ?></th>
                    <td><?= $schedule->has('place') ? $this->Html->link($schedule->place->descricao, ['controller' => 'Places', 'action' => 'view', $schedule->place->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Usuario que <br> criou agendamento') ?></th>
                    <td><?= $schedule->has('user') ? $this->Html->link($schedule->user->username, ['controller' => 'Users', 'action' => 'view', $schedule->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Pessoa vacinada?') ?></th>
                    <td><?= $this->Number->format($schedule->vacinado == 0) ? 'NÃO' : 'SIM' ?></td>
                </tr>
                <tr>
                    <th><?= __('Data') ?></th>
                    <td><?= h($schedule->data) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hora') ?></th>
                    <td><?= h($schedule->hora) ?></td>
                </tr>
                <tr>
                    <th><?= __('Registro criado em:') ?></th>
                    <td><?= h($schedule->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Registro alterado em:') ?></th>
                    <td><?= h($schedule->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Observacao') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($schedule->observacao)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
