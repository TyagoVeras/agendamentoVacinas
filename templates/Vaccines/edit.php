<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vaccine $vaccine
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $vaccine->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vaccine->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Vaccines'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="vaccines form content">
            <?= $this->Form->create($vaccine) ?>
            <fieldset>
                <legend><?= __('Edit Vaccine') ?></legend>
                <?php
                    echo $this->Form->control('descricao');
                    $active = ['0' => 'Não', '1'=>'Sim'];
                    echo $this->Form->control('active',['options'=>$active]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
