<?php
declare(strict_types=1);

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
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $userLogado;
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel('Settings');
        $settings = $this->Settings->get(1);
        $this->set(compact('settings'));

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    //campos que serao usados para o login
                    'filds' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'users',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'controller' => 'schedules',
                'action' => 'index'
            ],
            'authError'    => 'Você não está autorizado para acessar este conteúdo!',
        ]);

        $this->loadComponent('Recaptcha.Recaptcha', [
            'enable' => true,     // true/false
            'sitekey' => $settings->sitekey, //if you don't have, get one: https://www.google.com/recaptcha/intro/index.html
            'secret' => $settings->secret,
            'type' => 'image',  // image/audio
            'theme' => 'light', // light/dark
            'lang' => 'pt',      // default en
            'size' => 'normal'  // normal/compact
        ]);

        $this->Auth->allow(['display']);



        if ($this->Auth->user() != null) {
            $this->userLogado = $this->Auth->User();
            $userLogado = $this->userLogado;
            $this->set(compact('userLogado'));
        }
        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }
}
