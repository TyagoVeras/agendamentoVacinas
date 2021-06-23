<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Form->postLink(
                __('Apagar'),
                ['action' => 'delete', $category->id],
                ['confirm' => __('Tem certeza que quer apagar # {0}?', $category->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Listar'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="categories form content">
            <?= $this->Form->create($category) ?>
            <fieldset>
                <legend><?= __('Editar Grupo') ?></legend>
                <?php
                    echo $this->Form->control('descricao',['label'=>'Descrição']);
                    echo $this->Form->control('iniciovacinacao', ['label'=>'Data de Início','empty' => true]);
                    echo $this->Form->control('fimvacinacao', ['label'=>'Data de Encerramento','empty' => true]);
                    $active = ['0' => 'Não', '1'=>'Sim'];
                    echo $this->Form->control('active',['label'=>'Ativo','options'=>$active]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Salvar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
