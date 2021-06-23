<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vaccine $vaccine
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Editar vacina'), ['action' => 'edit', $vaccine->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Excluir vacina'), ['action' => 'delete', $vaccine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vaccine->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Listar vacinas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Nova vacina'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="vaccines view content">
            <h3><?= h($vaccine->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Descricao') ?></th>
                    <td><?= h($vaccine->descricao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($vaccine->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ativo') ?></th>
                    <td><?= $this->Number->format($vaccine->active) == 1 ? 'Sim' : 'Não' ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Vacinas vinculadas à agendamentos') ?></h4>
                <?php if (!empty($vaccine->schedules)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Data') ?></th>
                            <th><?= __('Hora') ?></th>
                            <th><?= __('Check') ?></th>
                            <th><?= __('Confirmado') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Place Id') ?></th>
                            <th><?= __('Vaccine Id') ?></th>
                            <th><?= __('Users Id') ?></th>
                            <th><?= __('Dose Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($vaccine->schedules as $schedules) : ?>
                        <tr>
                            <td><?= h($schedules->id) ?></td>
                            <td><?= h($schedules->data) ?></td>
                            <td><?= h($schedules->hora) ?></td>
                            <td><?= h($schedules->check) ?></td>
                            <td><?= h($schedules->confirmado) ?></td>
                            <td><?= h($schedules->created) ?></td>
                            <td><?= h($schedules->modified) ?></td>
                            <td><?= h($schedules->place_id) ?></td>
                            <td><?= h($schedules->vaccine_id) ?></td>
                            <td><?= h($schedules->users_id) ?></td>
                            <td><?= h($schedules->dose_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Schedules', 'action' => 'view', $schedules->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Schedules', 'action' => 'edit', $schedules->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Schedules', 'action' => 'delete', $schedules->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schedules->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
