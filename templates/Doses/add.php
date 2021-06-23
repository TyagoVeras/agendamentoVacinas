<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dose $dose
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Listar doses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="doses form content">
            <?= $this->Form->create($dose) ?>
            <fieldset>
                <legend><?= __('Nova dose') ?></legend>
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
