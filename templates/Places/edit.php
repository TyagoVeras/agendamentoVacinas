<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Place $place
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $place->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $place->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Places'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="places form content">
            <?= $this->Form->create($place) ?>
            <fieldset>
                <legend><?= __('Editar local') ?></legend>
                <?php
                    echo $this->Form->control('descricao');
                    $active = ['0' => 'Não', '1'=>'Sim'];
                    echo $this->Form->control('active',['options'=>$active]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Salvar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
