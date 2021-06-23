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
            <?= $this->Html->link(__('Editar configurações'), ['action' => 'edit'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="settings view content">
            <table>
                <tr>
                    <th><?= __('Sigla') ?></th>
                    <td><?= h($setting->sigla) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Url Sistema') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($setting->url_sistema)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Url Logo') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($setting->url_logo)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Recaptcha google sitekey') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($setting->sitekey)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Recaptcha google secret') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($setting->secret)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Tempo de atendimento') ?></strong>
                <blockquote>
                <?php  $tempoatendimento = ['120'=>'2 minutos','300' => '5 minutos', '600' => '10 minutos', '900' => '15 minutos'];
 ?>
                    <?= $this->Text->autoParagraph(h($tempoatendimento[$setting->tempodeatendimento])); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Telefone secretaria') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($setting->celsecretaria)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
