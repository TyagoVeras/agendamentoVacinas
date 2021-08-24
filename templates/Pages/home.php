<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

$cakeDescription = 'Agendamentos online de Vacinas - Luis Correia';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'layout', 'home']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <header>
        <div class="container text-center">
            <img src="<?= $settings->url_logo; ?>" alt="" width="266">
            <h1>
                Agendamentos de Vacinas
                <!--da <?= $settings->sigla ?>--> (💉)
            </h1>
            <h3>
                Secretaria Municipal de Saúde de Luís Correia - PI
            </h3>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="column">
                        <div class="message default text-center">
                            <?php
                            if($settings->agendamentoliberado == '1'){
                            echo $this->Html->link('Clique aqui para fazer o agendamento da vacina', ['controller' => 'people', 'action' => 'existPeople'], ['escape' => false, 'class' => '']);
                            }else{
                             echo 'AGUARDE A LIBERAÇÃO DO AGENDAMENTO NO DIA 25/06/2021 ÀS 17h';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <h4><b>Antes</b> de fazer o agendamento</h4>
                        <ul>

                            <li class=""> ✔ VOCÊ DEVE TER EM MÃOS.
                                <ul>
                                    <li class=""> ✔ CPF</li>
                                    <li class=""> ✔ CARTÃO SUS</li>
                                </ul>
                            </li>
                            <!--                            <li class=""> ✔ VOCÊ NÃO PODE FAZER.
                                <ul>
                                    <li class=""> ✔ COMBER BEM</li>
                                    <li class=""> ✔ COMBER BEM</li>
                                </ul>
                            </li>-->
                        </ul>
                    </div>
                    <div class="column">
                        <h4><b>Depois</b> de fazer o agendamento</h4>
                        <ul>

                            <li class=""> ✔ VOCÊ DEVE.
                                <ul>
                                    <li class=""> ✔ IMPRIMIR SEU COMPROVANTE</li>
                                    <li class=""> ✔ OBSERVAR O LOCAL DE APLICAÇÃO</li>
                                </ul>
                            </li>
                            <li class=""> ✔ VOCÊ NÃO PODE.
                                <ul>
                                    <li class=""> ✔ ESQUECER DE COMPARECER</li>
                                    <!--                                    <li class="bullet problem"></li>-->
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <br>
    <div class="container">
        <div class="content">
            <div class="row">
                <footer style="width:100%">
                <?php  $nrCelular =  $settings->celsecretaria; $somenteNumeros = preg_replace('/[^0-9]/', '', $nrCelular); ?>
                    <h5 style="text-align:center; padding-top:10px">Para qualquer tipo de suporte entre em contato com a secretaria pelo número: <a href="https://api.whatsapp.com/send?phone=55<?= $somenteNumeros ?>&text=Ol%C3%A1%2C%20preciso%20de%20ajuda%20no%20sistema%20de%20gerenciamento%20de%20vacinas" target="_blank"><?= $settings->celsecretaria ?></a> </h5>
                </footer>
            </div>
        </div>
    </div>
</body>

</html>