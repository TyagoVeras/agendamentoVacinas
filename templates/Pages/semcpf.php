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
                Agendamentos de Vacinas <!--da <?= $settings->sigla ?>--> (💉)
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
                            <?= $this->Html->link('Clique aqui para fazer o agendamento da vacina',['controller'=>'people', 'action'=>'existPeople'],['escape'=>false,'class'=>'']) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <h5>Para pessoas que <b>NÃO TEM CPF</b></h5>
                        <ul>
                            <li> PROCURAR
                                <ul>
                                    <li class=""> ✔ Agência dos Correios</li>
                                    <li class=""> ✔ Agências Bancárias</li> 
                                    <li class=""> ✔ Receita Federal</li>
                                </ul>			
                            </li>
			    <li> COM OS DOCUMENTOS
                                <ul>
                                    <li class=""> ✔ Certidão de Nascimento</li>
                                    <li class=""> ✔ Identidade</li> 
                                    <li class=""> ✔ Comprovante de Endereço</li>
                                    <li class=""> ✔ Título de Eleitor (Se possuir)</li>
                                </ul>			
			    </li>
		    </div>
		    <div class="column">
			<h5>Para pessoas que <b> NÃO TEM O NUMERO DO CARTÃO DO SUS</b> </h5>
			<ul>
                            <li>Procurar a  SECRETARIA DE SAÚDE
                                <ul>
                                    <li class=""> ✔ Rua Joaquim Serra - Centro</li>
                                   
                                </ul>
                            </li>
                            
                        </ul>
			<ul>
                            <li> Baixar o APP CONECTSUS
                                <ul>
                                    <li class=""><a href="https://play.google.com/store/apps/details?id=br.gov.datasus.cnsdigital&hl=pt" 
target="_blanck"><img src="https://www.gstatic.com/android/market_images/web/play_prism_hlock_2x.png" width="140px" heigth="auto" alt="Google Play"></a>
				   </li>
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
