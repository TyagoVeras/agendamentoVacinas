<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person $person
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Opções') ?></h4>
            <?= $this->Html->link(__('Não tenho CPF'), ['controller'=>'pages','action' => 'display','semcpf'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="people form content">
            <?= $this->Form->create($person) ?>
            <fieldset>
                <legend><?= __('Verificação de cadastro pessoal') ?></legend>
                <?php
                    echo $this->Form->control('cpf',['class'=>'cpf']);
                    echo $this->Recaptcha->display();
                    
                ?>
            </fieldset>
            <?= $this->Form->button(__('ENVIAR'),['disabled'=>false,'class'=>'btnpre']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<?= $this->Html->script(['listar_horarios.js','alert.js']); ?>
