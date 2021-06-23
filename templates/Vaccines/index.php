<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vaccine[]|\Cake\Collection\CollectionInterface $vaccines
 */
?>
<div class="vaccines index content">
    <?= $this->Html->link(__('Nova vacina'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Vacinas') ?></h3>
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
                <?php foreach ($vaccines as $vaccine): ?>
                <tr>
                    <td><?= $this->Number->format($vaccine->id) ?></td>
                    <td><?= h($vaccine->descricao) ?></td>
                    <td><?= $this->Number->format($vaccine->active) == 1 ? 'Sim' : 'Não' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $vaccine->id]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $vaccine->id]) ?>
                        <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $vaccine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vaccine->id)]) ?>
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
