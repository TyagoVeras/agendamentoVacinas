<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schedule[]|\Cake\Collection\CollectionInterface $schedules
 */
?>
    <?= $this->Html->link(__('TODOS'), ['action' => 'index'], ['class' => 'button todas']) ?>
    
    <?= $this->Html->link(__('ABERTOS'), ['action' => 'index',1], ['class' => 'button abertos']) ?>

    <?= $this->Html->link(__('VINCULADOS'), ['action' => 'index',2], ['class' => 'button vinculados']) ?>

    <?= $this->Html->link(__('VACINADOS'), ['action' => 'index',3], ['class' => 'button vacinados']) ?>
    
    <?= $this->Html->link(__('AUSENTE'), ['action' => 'index',4], ['class' => 'button semcomparecimento']) ?>

    <?= $this->Html->link(__('RELATÓRIO'), ['action' => 'indexpessoas'], ['class' => 'button']) ?>

<br>
<small>Legenda nas ações: <span style="color:#000">V</span> -> Ver dados do registro | <span style="color:#000">D</span> -> Desvincular um agendamento de uma pessoa | <span style="color:#000">E</span> -> Excluir registro</small>
<div class="schedules index content">
    <?= $this->Html->link(__('Novo agendamento'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Agendamentos ( ').$tipo.' )' ?></h3>
    <?= $this->Form->create(null,['type'=>'get']); ?>
    <table>
        <tr>
            <td><?= $this->Form->control('keydate',['label'=>'Pesquisar por data','value'=>$this->request->getQuery('keydate'),'type'=>'date']); ?>
            </td>
            <td><?= $this->Form->control('keytime',['label'=>'Pesquisar por hora','value'=>$this->request->getQuery('keytime'),'type'=>'time']); ?>
            </td>

        </tr>
    <tfoot>
        <tr>
            <td>        <?= $this->Form->submit('Pesquisar'); ?>
        <?= $this->Form->end(); ?></td>
        </tr>
    </tfoot>
    </table>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('data') ?></th>
                    <th><?= $this->Paginator->sort('hora') ?></th>
                    <th><?= $this->Paginator->sort('vacinado') ?></th>
                    <th><?= $this->Paginator->sort('dose_id') ?></th>
                    <th><?= $this->Paginator->sort('person_id','Pessoa ID') ?></th>
                    <th><?= $this->Paginator->sort('person_id','Idade') ?></th>
                    <th><?= $this->Paginator->sort('category_id','Categoria') ?></th>
                    <th><?= $this->Paginator->sort('vaccine_id','Vacina') ?></th>
                    <th><?= $this->Paginator->sort('place_id','Local') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schedules as $schedule): ?>
                <tr>
                    <td><?= $this->Number->format($schedule->id) ?></td>
                    <td><?= h($schedule->data) ?></td>
                    <td><?= h($schedule->hora) ?></td>
                    <td><?= ($this->Number->format($schedule->vacinado) == '0') ? '<span style="background:#cc2c24;padding:5px; border-radius:2px; color:#fff;">NÃO</span>' : '<span style="background:#2779bd;color:#fff;padding:5px; border-radius:2px;">SIM</span>' ?></td>
                    <td><?= $schedule->has('dose') ? $this->Html->link($schedule->dose->descricao, ['controller' => 'Doses', 'action' => 'view', $schedule->dose->id]) : '' ?></td>
                    <td><?= $schedule->has('person') ? $this->Html->link($schedule->person->id, ['controller' => 'People', 'action' => 'view', $schedule->person->id]) : '<span style="background:#6acc24;padding:5px; border-radius:2px; color:#fff;">AG. ABERTO</span>' ?></td>
                    <td><?= $schedule->has('person') ? $this->Html->link($schedule->person->idade, ['controller' => 'People', 'action' => 'view', $schedule->person->id]) : '' ?></td>
                    <td><?= $schedule->has('category') ? $this->Html->link($schedule->category->descricao, ['controller' => 'Categories', 'action' => 'view', $schedule->category->id]) : '' ?></td>
                    <td><?= $schedule->has('vaccine') ? $this->Html->link($schedule->vaccine->descricao, ['controller' => 'Vaccines', 'action' => 'view', $schedule->vaccine->id]) : '' ?></td>
                    <td><?= $schedule->has('place') ? $this->Html->link($schedule->place->descricao, ['controller' => 'Places', 'action' => 'view', $schedule->place->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('V'), ['action' => 'view', $schedule->id]) ?>
                        <?php // $this->Html->link(__('E'), ['action' => 'edit', $schedule->id]) ?>
                        <?= $this->Form->postLink(__('D'), ['action' => 'unbind', $schedule->id], ['confirm' => __('Você relamente quer DESVINCULAR O AGENDAMENTO da pessoa # {0}?', $schedule->person_id)]) ?>
                        <?= $this->Form->postLink(__('E'), ['action' => 'delete', $schedule->id], ['confirm' => __('Você relamente quer EXCLUIR O AGENDAMENTO # {0}?', $schedule->id)]) ?>
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

