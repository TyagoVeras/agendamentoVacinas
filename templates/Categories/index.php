<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $categories
 */
?>
<div class="categories index content">
    <?= $this->Html->link(__('Novo Grupo'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Grupos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('Descrição') ?></th>
                    <th><?= $this->Paginator->sort('Início') ?></th>
                    <th><?= $this->Paginator->sort('Encerramento') ?></th>
                    <th><?= $this->Paginator->sort('Ativo') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $this->Number->format($category->id) ?></td>
                    <td><?= h($category->descricao) ?></td>
                    <td><?= h($category->iniciovacinacao) ?></td>
                    <td><?= h($category->fimvacinacao) ?></td>
                    <td><?= $this->Number->format($category->active) == 1 ? 'Sim' : 'Não'  ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $category->id]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $category->id]) ?>
                        <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $category->id], ['confirm' => __('Tem certeza que quer apagar # 
{0}?', 
$category->id)]) ?>
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
            <?= $this->Paginator->last(__('Último') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, exibindo {{current}} registros(s) de {{count}} no total')) ?></p>
    </div>
</div>
