<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schedule[]|\Cake\Collection\CollectionInterface $schedules
 */
?>
<div class="schedules index content">
    <button onclick="window.print()" class="btn btn-primary" style="float:right">Imprimir</button>
    <h3><?= __('Agendamentos') ?></h3>
    <?= $this->Form->create(null, ['type' => 'get']); ?>
    <table>
        <tr>
            <td><?= $this->Form->control('keydate', ['label' => 'Pesquisar por data', 'value' => $this->request->getQuery('keydate'), 'type' => 'date']); ?>
            </td>
            <td><?= $this->Form->control('keytimeBegin', ['label' => 'Hora início', 'value' => $this->request->getQuery('keytimeBegin'), 'type' => 'time']); ?>
            </td>
            <td><?= $this->Form->control('keytimeEnd', ['label' => 'Hora fim', 'value' => $this->request->getQuery('keytimeEnd'), 'type' => 'time']); ?>
            </td>

        </tr>
        <tfoot>
            <tr>
                <td> <?= $this->Form->submit('Pesquisar'); ?>
                    <?= $this->Form->end(); ?></td>
            </tr>
        </tfoot>
    </table>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('person_id', 'Nome') ?></th>
                    <th><?= $this->Paginator->sort('cpf', 'CPF') ?></th>
                    <th><?= $this->Paginator->sort('cns', 'CNS') ?></th>
                    <th><?= $this->Paginator->sort('datanascimento', 'Nasc.') ?></th>
                    <th><?= $this->Paginator->sort('idade', 'Idade') ?></th>
                    <th><?= $this->Paginator->sort('data-hora') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schedules as $schedule) : ?>
                    <tr>
                        <td><?= $schedule->has('person') ? $schedule->person->nome : '<span style="background:#6acc24;padding:5px; border-radius:2px; color:#fff;">AG. ABERTO</span>' ?></td>
                        <td><?= $schedule->has('person') ? $schedule->person->cpf : '<span style="background:#6acc24;padding:5px; border-radius:2px; color:#fff;">AG. ABERTO</span>' ?></td>
                        <td><?= $schedule->has('person') ? $schedule->person->cns : '<span style="background:#6acc24;padding:5px; border-radius:2px; color:#fff;">AG. ABERTO</span>' ?></td>
                        <td><?= $schedule->has('person') ? $schedule->person->datanascimento : '<span style="background:#6acc24;padding:5px; border-radius:2px; color:#fff;">AG. ABERTO</span>' ?></td>
                        <td><?= $schedule->has('person') ? $schedule->person->idade : '' ?></td>
                        <td><?= h($schedule->display) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>