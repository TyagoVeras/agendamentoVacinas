<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person $person
 */
?>
<div class="row">

    <div class="column-responsive">
        <div class="message default text-center">
            1ª ETAPA <br>
            <small>Seus dados pessoais</small>
        </div>
        <div class="people form content">
            <?= $this->Form->create($person) ?>

            <?php
            echo $this->Form->control('cpf', ['label' => 'CPF', 'value' => $this->request->getSession()->read('cpf'), 'readonly' => true]);
            echo $this->Html->link(__('Não é seu CPF?'), ['controller' => 'people', 'action' => 'existPeople'], ['class' => ''])
            ?>
            <br><br>
            <?php
            echo $this->Form->control('cns', ['label' => 'Nº do cartão do SUS', 'class' => 'cnsM']);
            echo $this->Form->control('nome', ['label' => 'Nome completo']);
            $opSexo = ['0' => 'Feminino', '1' => 'Masculino'];
            echo $this->Form->control('sexo', ['label' => 'Qual seu sexo?', 'options' => $opSexo, 'empty' => '- ESCOLHA UMA OPÇÃO -']);
            echo $this->Form->control('celular', ['label' => 'Celular/Whatsapp', 'class' => 'cel']);
            echo $this->Form->control('datanascimento', ['label' => 'Data de nascimento']);
            echo $this->Form->control('idade', ['readonly' => true]);
            ?>
        </div>
        <br>
    </div>
    <div class="column-responsive">
        <div class="message default text-center">
            2ª ETAPA <br>
            <small>Seu endereço</small>
        </div>

        <div class="people form content">
            <?php
            echo $this->Form->control('cep');
            echo $this->Form->control('estado', ['readonly' => true, 'required' => true]);
            echo $this->Form->control('cidade', ['readonly' => true, 'required' => true]);
            echo $this->Form->control('bairro',['required' => true]);
            echo $this->Form->control('rua', ['label' => 'Logradouro / Povoado', 'placeholder' => 'Ex: Rua São Miguel / São Benedito']);
            echo $this->Form->control('numerocasa', ['label' => 'Nº da casa']);
            ?>
        </div>
        <br>
    </div>

    <div class="column-responsive">
        <div class="message default text-center">
            3ª ETAPA <br>
            <small>Dados da vacinação</small>
        </div>
        <div class="people form content">
            <?php
            echo $this->Form->control('dose_id', ['options' => $doses, 'label' => 'Essa será sua primeira ou segunda dose?']);
            echo $this->Form->control('category_id', ['options' => $categories, 'label' => 'A qual grupo você pertence?', 'required' => true, 'empty' => ' - ESCOLHA A CATEGORIA -']);
            echo $this->Form->control('place_id', ['options' => $places, 'label' => 'Local da vacinação', 'required' => true, 'empty' => ' - ESCOLHA O LOCAL - ']);
            echo $this->Form->control('scheduling_id', ['options' => $schedules, 'label' => 'Dias e horarios disponiveis', 'required' => true]);
            echo $this->Form->control('observacao', ['label' => 'Observação']);
            ?>
        </div>
        <br>
        <div class="message error text-center">
            ANTES DE AGENDAR, CONFIRA SE SEUS DADOS ESTÃO CORRETOS.
        </div>
        <?= $this->Form->button(__('Agendar'), ['style' => 'width:100%', 'class' => 'btnpre']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<?= $this->Html->script('listar_horarios.js'); ?>