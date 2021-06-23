<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dose[]|\Cake\Collection\CollectionInterface $doses
 */
?>
<div class="doses index content">
    <?= $this->Html->link(__('Nova dose'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Doses') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('descricao') ?></th>
                    <th><?= $this->Paginator->sort('ativo') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($doses as $dose): ?>
                <tr>
                    <td><?= $this->Number->format($dose->id) ?></td>
                    <td><?= h($dose->descricao) ?></td>
                    <td><?= $this->Number->format($dose->active) == 1 ? 'Sim' : 'Não' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $dose->id]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $dose->id]) ?>
                        <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $dose->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dose->id)]) ?>
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
