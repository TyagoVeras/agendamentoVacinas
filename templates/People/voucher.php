<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person $person
 */
?>
<nav class="top-nav" style="text-align:center;width:100%;justify-content:center">
<br> <p>ATENÇÃO! Imprima essa pagina para levar no dia da aplicação da vacina</p>
</nav>
<div class="row">
    <div class="column-responsive">
        <div class="cabecalho">

            <img src="<?= $settings->url_logo; ?>" alt="" width="200" style="float:left">
            <br>
            <button onclick="window.print()" class="btn btn-primary" style="float:right">Imprimir</button>
        </div>
        <div style="clear:both;"></div>
        <br>

        <div class="people view content">
            <h3>Identificação</h3>
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
            </table>
        </div>
        <br>
        <div class="people view content">
            <div class="related">
                <h3>Agendamentos </h3>
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
                                    <th>Check-in <br> <small>para uso do porfissional de saúde<small></th>
                                </tr>
                                <tr>
                                    <td><?= h($schedules->data) ?></td>
                                    <td><?= h($schedules->hora) ?></td>
                                    <td><?= h($schedules->dose->descricao) ?></td>
                                    <td><?= h($schedules->category->descricao) ?></td>
                                    <td><?= h($schedules->vaccine->descricao) ?></td>
                                    <td><?= h($schedules->place->descricao) ?></td>
                                    <td><?php echo $this->QrCode->url($settings->url_sistema . '/schedules/checkin/' . $schedules->id); ?> </td>
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