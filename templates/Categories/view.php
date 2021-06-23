<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Category'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="categories view content">
            <h3><?= h($category->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Descricao') ?></th>
                    <td><?= h($category->descricao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($category->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $this->Number->format($category->active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Iniciovacinacao') ?></th>
                    <td><?= h($category->iniciovacinacao) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fimvacinacao') ?></th>
                    <td><?= h($category->fimvacinacao) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Schedules') ?></h4>
                <?php if (!empty($category->schedules)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Data') ?></th>
                            <th><?= __('Hora') ?></th>
                            <th><?= __('Vacinado') ?></th>
                            <th><?= __('Display') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Observacao') ?></th>
                            <th><?= __('Person Id') ?></th>
                            <th><?= __('Dose Id') ?></th>
                            <th><?= __('Category Id') ?></th>
                            <th><?= __('Vaccine Id') ?></th>
                            <th><?= __('Place Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($category->schedules as $schedules) : ?>
                        <tr>
                            <td><?= h($schedules->id) ?></td>
                            <td><?= h($schedules->data) ?></td>
                            <td><?= h($schedules->hora) ?></td>
                            <td><?= h($schedules->vacinado) ?></td>
                            <td><?= h($schedules->display) ?></td>
                            <td><?= h($schedules->created) ?></td>
                            <td><?= h($schedules->modified) ?></td>
                            <td><?= h($schedules->observacao) ?></td>
                            <td><?= h($schedules->person_id) ?></td>
                            <td><?= h($schedules->dose_id) ?></td>
                            <td><?= h($schedules->category_id) ?></td>
                            <td><?= h($schedules->vaccine_id) ?></td>
                            <td><?= h($schedules->place_id) ?></td>
                            <td><?= h($schedules->user_id) ?></td>
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
