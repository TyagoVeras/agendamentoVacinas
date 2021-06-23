<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dose $dose
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Editar dose'), ['action' => 'edit', $dose->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Excluir dose'), ['action' => 'delete', $dose->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dose->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Listar doses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Nova dose'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="doses view content">
            <h3><?= h($dose->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Descricao') ?></th>
                    <td><?= h($dose->descricao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($dose->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Doses vinculadas com agendamentos') ?></h4>
                <?php if (!empty($dose->schedules)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= ('id') ?></th>
                            <th><?= ('data') ?></th>
                            <th><?= ('hora') ?></th>
                            <th><?= ('vacinado') ?></th>
                            <th><?= ('pessoa ID') ?></th>
                            <th><?= ('Categoria') ?></th>
                            <th><?= ('Vacina') ?></th>
                            <th><?= ('Local') ?></th>
                            <th class="actions"><?= __('Ações') ?></th>
                        </tr>
                        <?php foreach ($dose->schedules as $schedule) : ?>
                        <tr>
                            <td><?= $this->Number->format($schedule->id) ?></td>
                            <td><?= h($schedule->data) ?></td>
                            <td><?= h($schedule->hora) ?></td>
                            <td><?= ($this->Number->format($schedule->vacinado) == '0') ? 'Não' : 'Sim' ?></td>
                            <td><?= $schedule->has('person') ? $this->Html->link($schedule->person->id, ['controller' => 'People', 'action' => 'view', $schedule->person->id]) : '' ?></td>
                            <td><?= $schedule->has('category') ? $this->Html->link($schedule->category->descricao, ['controller' => 'Categories', 'action' => 'view', $schedule->category->id]) : '' ?></td>
                            <td><?= $schedule->has('vaccine') ? $this->Html->link($schedule->vaccine->descricao, ['controller' => 'Vaccines', 'action' => 'view', $schedule->vaccine->id]) : '' ?></td>
                            <td><?= $schedule->has('place') ? $this->Html->link($schedule->place->descricao, ['controller' => 'Places', 'action' => 'view', $schedule->place->id]) : '' ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('V'), ['action' => 'view', $schedule->id]) ?>
                                <?= $this->Html->link(__('E'), ['action' => 'edit', $schedule->id]) ?>
                                <?= $this->Form->postLink(__('D'), ['action' => 'delete', $schedule->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schedule->id)]) ?>
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
