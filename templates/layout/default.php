<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Sistema de agendamento de vacinas';
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

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'layout']) ?>
    <?= $this->Html->script(['jquery.min.js', 'jquery.mask.min.js', 'sweetalert2.js', 'scripts.js']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <?php
    if (isset($userLogado)) {
        echo '
        <style>
        .top-nav, .container{
            max-width:100% !important
        }
        </style>';
    }
    ?>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span><?= $settings->sigla ?></span>Vacinas</a>
            <br>
            <?php
            if ($this->request->getSession()->read('cpf')) {
                echo $this->Html->link(__('Sair da sessão da pessoa'), ['controller' => 'people', 'action' => 'logout'], ['class' => 'btn btn-sm btn-light-primary font-weight-bolder py-2 px-5']);
            }
            ?>
        </div>
        <div class="top-nav-links">
            <?php
            if (isset($userLogado) && $userLogado['role'] == 1) {

                echo $this->Html->link(__('Agendamentos'), ['controller' => 'schedules', 'action' => 'index'], ['class' => 'btn btn-sm btn-light-primary font-weight-bolder py-2 px-5']);
                echo $this->Html->link(__('Doses'), ['controller' => 'doses', 'action' => 'index'], ['class' => 'btn btn-sm btn-light-primary font-weight-bolder py-2 px-5']);
                echo $this->Html->link(__('Pessoas'), ['controller' => 'people', 'action' => 'index'], ['class' => 'btn btn-sm btn-light-primary font-weight-bolder py-2 px-5']);
                echo $this->Html->link(__('Locais'), ['controller' => 'places', 'action' => 'index'], ['class' => 'btn btn-sm btn-light-primary font-weight-bolder py-2 px-5']);
                echo $this->Html->link(__('Vacinas'), ['controller' => 'vaccines', 'action' => 'index'], ['class' => 'btn btn-sm btn-light-primary font-weight-bolder py-2 px-5']);
                echo $this->Html->link(__('Grupos'), ['controller' => 'categories', 'action' => 'index'], ['class' => 'btn btn-sm btn-light-primary font-weight-bolder py-2 px-5']);
                echo ' | ';
                echo $this->Html->link(__('Config'), ['controller' => 'settings', 'action' => 'index'], ['class' => 'btn btn-sm btn-light-primary font-weight-bolder py-2 px-5']);
                echo $this->Html->link(__('Usuários'), ['controller' => 'users', 'action' => 'index'], ['class' => 'btn btn-sm btn-light-primary font-weight-bolder py-2 px-5']);
                echo $this->Html->link(__('Sair'), ['controller' => 'users', 'action' => 'logout'], ['class' => 'btn btn-sm btn-light-primary font-weight-bolder py-2 px-5']);
            } else if (isset($userLogado) && $userLogado['role'] == 2) {
                echo $this->Html->link(__('Meus checkins'), ['controller' => 'schedules', 'action' => 'indexcheckin'], ['class' => 'btn btn-sm btn-light-primary font-weight-bolder py-2 px-5']);
                echo ' | ';
                echo $this->Html->link(__('Sair'), ['controller' => 'users', 'action' => 'logout'], ['class' => 'btn btn-sm btn-light-primary font-weight-bolder py-2 px-5']);
            } else {
                echo '';
            }
            ?>
        </div>
    </nav>
    <main class="main">

        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>

    <br>
    <div class="container">
        <div class="content">
            <div class="row">
                <footer style="width:100%">
                    <?php $nrCelular =  $settings->celsecretaria;
                    $somenteNumeros = preg_replace('/[^0-9]/', '', $nrCelular); ?>
                    <h5 style="text-align:center; padding-top:10px">Para qualquer tipo de suporte entre em contato com a secretaria pelo número: <a href="https://api.whatsapp.com/send?phone=55<?= $somenteNumeros ?>&text=Ol%C3%A1%2C%20preciso%20de%20ajuda%20no%20sistema%20de%20gerenciamento%20de%20vacinas" target="_blank"><?= $settings->celsecretaria ?></a> </h5>
                </footer>
            </div>
        </div>
    </div>

    <script>
        var HOST_URL = "<?= $settings->url_sistema; ?>";
    </script>

</body>

</html>