<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * VerifyCpf component
 */
class ValidatorsComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function validaCPF($cpf)
    {
 
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
         
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
    
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
    
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    public function validaCNS($value){

            $cns = preg_replace('/[^0-9]/is', '', $value);
    
            // CNSs definitivos começam em 1 ou 2 / CNSs provisórios em 7, 8 ou 9
            if (preg_match("/[1-2][0-9]{10}00[0-1][0-9]/", $cns) || preg_match("/[7-9][0-9]{14}/", $cns)) {
                return $this->somaPonderadaCns($cns) % 11 == 0;
            }
    
            return false;

    }
        
    private function somaPonderadaCns($value): int
    {
        $soma = 0;

        for ($i = 0; $i < mb_strlen($value); $i++) {
            $soma += $value[$i] * (15 - $i);
        }

        return $soma;
    }
}