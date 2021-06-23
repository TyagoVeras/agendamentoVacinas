<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person $person
 */
?>
<div class="message error text-center">
    ATENÇÃO! <br>
    <small>Para alterar outros campos, é necessario entrar em contato com a coordenação de imunização do seu municipio, e solicitar tais mudanças</small>
</div>
<div class="row">

    <div class="column-responsive">
        <div class="message default text-center">
            1ª ETAPA <br>
            <small>Seus dados pessoais</small>
        </div>
        <div class="people form content">
            <?= $this->Form->create($person) ?>

            <?php
            echo '<h5 class="profile_title">CPF</h5>';
            echo '<p class="profile_value">' . $person->cpf . '<p>';

            echo '<h5 class="profile_title">CNS</h5>';
            echo '<p class="profile_value">' . $person->cns . '<p>';

            echo '<h5 class="profile_title">Nome</h5>';
            echo '<p class="profile_value">' . $person->nome . '<p>';

            echo '<h5 class="profile_title">Sexo</h5>';
            echo $person->sexo == 0 ? '<p class="profile_value">Feminino</p>' : '<p class="profile_value">Masculino<p>';

            echo $this->Form->control('celular', ['label' => 'Celular/Whatsapp', 'class' => 'cel']);

            echo '<h5 class="profile_title">Data de nascimento</h5>';
            echo '<p class="profile_value">' . $person->datanascimento . '<p>';

            echo '<h5 class="profile_title">Idade</h5>';
            echo '<p class="profile_value">' . $person->idade . '<p>';

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
            echo $this->Form->control('estado', ['readonly' => true]);
            echo $this->Form->control('cidade', ['readonly' => true]);
            echo $this->Form->control('bairro');
            echo $this->Form->control('rua', ['label' => 'Logradouro', 'placeholder' => 'Ex: Rua São Miguel']);
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
        <?php if (!empty($person->doses)) : ?>
        <div class="people form content">
            <?php
            echo $this->Form->control('dose_id', ['options' => $doses, 'label' => 'Essa será sua primeira ou segunda dose?']);
            echo $this->Form->control('category_id', ['options' => $categories, 'label' => 'A qual grupo você pertence?', 'required' => true]);
            echo $this->Form->control('scheduling_id', ['options' => $schedules, 'label' => 'Dias e horarios disponiveis', 'required' => true]);
            echo $this->Form->control('observacao', ['label' => 'Observação']);
            ?>
        </div>
        <br>
        <?= $this->Form->button(__('Agendar'), ['style' => 'width:100%']) ?>
        <?= $this->Form->end() ?>
        <?php endif;?>
        <?php if (empty($person->doses)) : ?>
        <div class="people form content">
            <h5>Seu processo de vacinação está em andamento. Qualquer dúvida entre em contato com a coordenação de imunização do seu municipio</h5>
        </div>
        <br>
        <?= $this->Form->button(__('Salvar dados pessoais'), ['style' => 'width:100%']) ?>
        <?= $this->Form->end() ?>
        <?php endif;?>
        
        
    </div>
</div>

<div class="row">
    <div class="column-responsive">
        <div class="people view content">
            <div class="related">
                <h3>Agendamentos</h3>
                <?php if (!empty($person->schedules)) : ?>
                    <?php foreach ($person->schedules as $schedules) : ?>
                        <div class="table-responsive voucherprint">
                            <table>
                                <tr>
                                    <th><?= __('Data') ?></th>
                                    <th><?= __('Hora') ?></th>
                                    <th><?= __('Dose') ?></th>
                                    <th><?= __('Categoria') ?></th>
                                    <th><?= __('Vacina') ?></th>
                                    <th><?= __('Local') ?></th>
                                    <th align=>Check-in <br> <small>para uso do porfissional de saúde<small></th>
                                </tr>
                                <tr>
                                    <td><?= h($schedules->data) ?></td>
                                    <td><?= h($schedules->hora) ?></td>
                                    <td><?= h($schedules->dose->descricao) ?></td>
                                    <td><?= h($schedules->category->descricao) ?></td>
                                    <td><?= h($schedules->vaccine->descricao) ?></td>
                                    <td><?= h($schedules->place->descricao) ?></td>
                                    <td align="center"><?php echo $schedules->vacinado == 0 ? $this->QrCode->url($settings->url_sistema . '/schedules/checkin/' . $schedules->id) : '<span style="background:#6acc24;padding:5px; border-radius:2px;">DOSE APLICADA</span>' ?> </td>
                                </tr>
                            </table>
                            <p>Observação: <span style="color:#000"><?= h($schedules->observacao) ?></span></p>
                        </div>
                        <hr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->Html->script('listar_horarios.js'); ?>
