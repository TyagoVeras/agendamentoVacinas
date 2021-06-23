<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person $person
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Não tenho CPF'), ['controller'=>'pages','action' => 'display','semcpf'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="people form content">
            <?= $this->Form->create() ?>
            <fieldset>
                <legend><?= __('Para entrar na sua ficha insira o numero do seu CNS') ?></legend>
                <?php
                    echo $this->Form->control('cpf',['class'=>'cpf','value'=>'']);
                    echo $this->Form->control('cns',['class'=>'cnsM']);
                    echo $this->Recaptcha->display();
                    
                ?>
            </fieldset>
            <?= $this->Form->button(__('ENVIAR'),['disabled'=>false,'class'=>'btnpre']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
