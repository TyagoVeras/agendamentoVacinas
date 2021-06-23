<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Place[]|\Cake\Collection\CollectionInterface $places
 */
?>
<div class="places index content">
    <?= $this->Html->link(__('Novo local'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Places') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('descricao') ?></th>
                    <th><?= $this->Paginator->sort('ativo') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($places as $place): ?>
                <tr>
                    <td><?= $this->Number->format($place->id) ?></td>
                    <td><?= h($place->descricao) ?></td>
                    <td><?= $this->Number->format($place->active) == 1 ? 'Sim' : 'Não' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $place->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $place->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $place->id], ['confirm' => __('Are you sure you want to delete # {0}?', $place->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('Primeiro')) ?>
            <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Próximo') . ' >') ?>
            <?= $this->Paginator->last(__('Ultimo') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} registro(s) de {{count}} no total')) ?></p>
    </div>
</div>
