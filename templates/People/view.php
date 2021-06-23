<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person $person
 */
?>

<div class="row">
    <div class="column-responsive">
        <div class="cabecalho">

            <img src="<?= $settings->url_logo; ?>" alt="" width="200" style="float:left">
            <br>
            <button onclick="window.print()" class="btn btn-primary" style="float:right">Imprimir documento ou CTRL + P</button>
        </div>
        <div style="clear:both;"></div>
        <br>

        <div class="people view content">
            <h3>Identificação | Registro no sistema de numero # <?= $person->id ?></h3>
            <h4>Totalmente imunizado? <?= $person->imunizado == null ? '<span style="font-weight:bold">NÃO</span>' : '<span style="font-weight:bold">SIM</span>' ?></h4>
            <table>
                <tr>
                    <th><?= __('Nome') ?></th>
                    <td colspan="3"><?= h($person->nome) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cpf') ?></th>
                    <td><?= h($person->cpf) ?></td>
                    <th><?= __('Cns') ?></th>
                    <td><?= h($person->cns) ?></td>
                </tr>

                <tr>
                    <th><?= __('Sexo') ?></th>
                    <td><?php if ($this->Number->format($person->sexo) == 0) {
                            echo 'Feminino';
                        } else {
                            echo 'Masculino';
                        } ?></td>
                    <th><?= __('Celular') ?></th>
                    <td><?= h($person->celular) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cep') ?></th>
                    <td><?= h($person->cep) ?></td>
                    <th><?= __('Estado') ?></th>
                    <td><?= h($person->estado) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cidade') ?></th>
                    <td><?= h($person->cidade) ?></td>
                    <th><?= __('Bairro') ?></th>
                    <td><?= h($person->bairro) ?></td>
                </tr>

                <tr>
                    <th><?= __('Rua') ?></th>
                    <td><?= h($person->rua) ?></td>
                    <th><?= __('Numerocasa') ?></th>
                    <td><?= h($person->numerocasa) ?></td>
                </tr>
                <tr>
                    <th><?= __('Data de nascimento') ?></th>
                    <td><?= h($person->datanascimento) ?></td>
                    <th><?= __('Idade') ?></th>
                    <td><?= $this->Number->format($person->idade) ?></td>
                </tr>
                <tr>
                    <th><?= __('Registro criado em') ?></th>
                    <td><?= h($person->created) ?></td>
                    <th><?= __('Ultima alteração no registro') ?></th>
                    <td><?= h($person->modified) ?></td>
                </tr>
            </table>
        </div>
        <br>
        <div class="people view content">
            <div class="related">
                <h3>Agendamentos</h3>
                <?php if (!empty($person->schedules)) : ?>
                    <?php foreach ($person->schedules as $schedules) : ?>
                        <div class="table-responsive voucherprint">
                            <table>
                                <tr>
                                    <th><?= __('ID') ?></th>
                                    <th><?= __('Data') ?></th>
                                    <th><?= __('Hora') ?></th>
                                    <th><?= __('Dose') ?></th>
                                    <th><?= __('Categoria') ?></th>
                                    <th><?= __('Vacina') ?></th>
                                    <th><?= __('Local') ?></th>
                                    <th align=>Check-in <br> <small>para uso do porfissional de saúde<small></th>
                                </tr>
                                <tr>
                                    <td><?= $schedules->has('id') ? $this->Html->link($schedules->id,['controller'=>'schedules','action'=>'view',$schedules->id]) : '' ?></td>
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