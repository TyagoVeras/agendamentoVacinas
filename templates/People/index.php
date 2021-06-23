<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person[]|\Cake\Collection\CollectionInterface $people
 */
?>
<div class="people index content">
    <?= $this->Html->link(__('Nova pessoa'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Pessoas') ?></h3>
    <?= $this->Form->create(null,['type'=>'get']); ?>
    <?= $this->Form->control('key',['label'=>'Pesquisar','value'=>$this->request->getQuery('key')]); ?>
    <?= $this->Form->submit('Pesquisar'); ?>
    <?= $this->Form->end(); ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('nome') ?></th>
                    <th><?= $this->Paginator->sort('imu') ?></th>
                    <th><?= $this->Paginator->sort('cpf') ?></th>
                    <th><?= $this->Paginator->sort('cns') ?></th>
                    <th><?= $this->Paginator->sort('datanascimento','Nascimento') ?></th>
                    <th><?= $this->Paginator->sort('idade') ?></th>
                    <th><?= $this->Paginator->sort('sexo') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($people as $person): ?>
                <tr>
                    <td><?= $this->Number->format($person->id) ?></td>
                    <td><?= h($person->nome) ?></td>
                    <td><?= ($this->Number->format($person->imunizado) == '0') ? '<span style="background:#cc2c24;padding:5px; border-radius:2px; color:#fff;">NÃO</span>' : '<span style="background:#6acc24;padding:5px; border-radius:2px;">SIM ✔</span>' ?></td>
                    <td><?= h($person->cpf) ?></td>
                    <td><?= h($person->cns) ?></td>
                    <td><?= h($person->datanascimento) ?></td>
                    <td><?= $this->Number->format($person->idade) ?></td>
                    <td><?= $this->Number->format($person->sexo == 0) ? 'F' : 'M' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__(' V '), ['action' => 'view', $person->id]) ?>
                        <?= $this->Html->link(__(' E '), ['action' => 'edit', $person->id]) ?>
                        <?= $this->Form->postLink(__(' D '), ['action' => 'delete', $person->id], ['confirm' => __('Voce realmente quer excluir essa pessoa de ID # {0}?', $person->id)]) ?>
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
