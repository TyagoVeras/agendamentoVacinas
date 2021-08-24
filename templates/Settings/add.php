<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Setting $setting
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Listar Configurações'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="settings form content">
            <?= $this->Form->create($setting) ?>
            <fieldset>
                <legend><?= __('Add Setting') ?></legend>
                <?php
                    echo $this->Form->control('url_sistema');
                    echo $this->Form->control('url_logo');
                    echo $this->Form->control('sitekey',['label'=>'ReCaptcha Google: Sitekey']);
                    echo $this->Form->control('secret',['label'=>'ReCaptcha Google: Secret']);
                    echo $this->Form->control('sigla');
                    $tempoatendimento = ['120'=>'2 minutos','300' => '5 minutos', '600' => '10 minutos', '900' => '15 minutos'];
                    echo $this->Form->control('tempodeatendimento',['label'=>'Tempo de atendimento','options'=>$tempoatendimento]);
                    echo $this->Form->control('celsecretaria', ['label' => 'Celular/Whatsapp', 'class' => 'cel']);
                    $optionsAgendamentoLiberado = ['0' => 'Não', '1'=>'Sim'];
                    echo $this->Form->control('agendamentoliberado',['options'=>$optionsAgendamentoLiberado]);
                    ?>
            </fieldset>
            <?= $this->Form->button(__('Enviar')) ?>
            <?= $this->Form->end() ?>
        </div>
        <br>
        <div class="settings form content">
            <h1>Ajuda para configurações</h1>
            <h4>ReCaptcha</h4>
            <p>Acesso o site <a href="https://www.google.com/recaptcha/admin/site/" target="_blank">https://www.google.com/recaptcha/admin/site/</a> para obter a sitekey e secret </p>
        </div>
    </div>
</div>
