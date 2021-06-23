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
            echo $this->Form->control('imunizado', ['options' => [null => 'Não', '1' => 'Sim']]);
            echo $this->Form->control('cpf', ['label' => 'CPF', 'class' => 'cpfM']);
            echo $this->Form->control('cns', ['label' => 'Nº do cartão do SUS', 'class' => 'cnsM']);
            echo $this->Form->control('nome', ['label' => 'Nome completo']);
            $opSexo = ['0' => 'Feminino', '1' => 'Masculino'];
            echo $this->Form->control('sexo', ['label' => 'Qual seu sexo?', 'options' => $opSexo, 'empty' => '- ESCOLHA UMA OPÇÃO -']);
            echo $this->Form->control('celular', ['label' => 'Celular/Whatsapp', 'class' => 'cel']);
            echo $this->Form->control('datanascimento', ['label' => 'Data de nascimento']);
            echo $this->Form->control('idade');
            ?>
        </div>
        <br>
    </div>
    <div class="column-responsive">
        <div class="message default text-center">
            2ª ETAPA <br>
            <small>Endereço</small>
        </div>

        <div class="people form content">
            <?php
            echo $this->Form->control('cep');
            echo $this->Form->control('estado', ['readonly' => true]);
            echo $this->Form->control('cidade', ['readonly' => true]);
            echo $this->Form->control('bairro');
            echo $this->Form->control('rua', ['label' => 'Logradouro', 'placeholder' => 'Ex: Rua São Miguel']);
            echo $this->Form->control('numerocasa', ['label' => 'Nº da casa']);
            ?>
        </div>
        <br>
    </div>
</div>
<?= $this->Form->button(__('Salvar dados pessoais'), ['style' => 'width:100%']) ?>
<?= $this->Form->end() ?>