<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schedule $schedule
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $schedule->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $schedule->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Schedules'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="schedules form content">
            <?= $this->Form->create($schedule) ?>
            <fieldset>
                <legend><?= __('Edit Schedule') ?></legend>
                <?php
                    echo $this->Form->control('data');
                    echo $this->Form->control('hora');
                    echo $this->Form->control('ocupado');
                    echo $this->Form->control('confirmado');
                    echo $this->Form->control('place_id', ['options' => $places]);
                    echo $this->Form->control('vaccine_id', ['options' => $vaccines]);
                    echo $this->Form->control('users_id', ['options' => $users]);
                    echo $this->Form->control('dose_id', ['options' => $doses]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
