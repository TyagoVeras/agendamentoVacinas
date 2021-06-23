<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schedule[]|\Cake\Collection\CollectionInterface $schedules
 */
?>
<div class="schedules index content">
    <h3><?= __('Checkins feito por você') ?></h3>
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
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schedules as $schedule): ?>
                <tr>
                    <td><?= $this->Number->format($schedule->id) ?></td>
                    <td><?= h($schedule->data) ?></td>
                    <td><?= h($schedule->hora) ?></td>
                    <td><?= ($this->Number->format($schedule->vacinado) == '0') ? '<span style="background:#cc2c24;padding:5px; border-radius:2px; color:#fff;">NÃO</span>' : '<span style="background:#6acc24;padding:5px; border-radius:2px;">SIM</span>' ?></td>
                    <td><?= $schedule->has('dose') ? $this->Html->link($schedule->dose->descricao, [null]) : '' ?></td>
                    <td><?= $schedule->has('person') ? $this->Html->link($schedule->person->id, [null]) : '<span style="background:#cc2c24;padding:5px; border-radius:2px; color:#fff;">AG. ABERTO</span>' ?></td>
                    <td><?= $schedule->has('person') ? $this->Html->link($schedule->person->idade, [null]) : '' ?></td>
                    <td><?= $schedule->has('category') ? $this->Html->link($schedule->category->descricao, [null]) : '' ?></td>
                    <td><?= $schedule->has('vaccine') ? $this->Html->link($schedule->vaccine->descricao, [null]) : '' ?></td>
                    <td><?= $schedule->has('place') ? $this->Html->link($schedule->place->descricao,[null]) : '' ?></td>
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

