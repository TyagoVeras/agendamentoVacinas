<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Person Entity
 *
 * @property int $id
 * @property int|null $imunizado
 * @property string $cpf
 * @property string $cns
 * @property \Cake\I18n\FrozenDate $datanascimento
 * @property int $idade
 * @property string|null $celular
 * @property int $sexo
 * @property string $cep
 * @property string $estado
 * @property string $cidade
 * @property string $bairro
 * @property string $rua
 * @property string $numerocasa
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Schedule[] $schedules
 */
class Person extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'imunizado' => true,
        'nome' => true,
        'cpf' => true,
        'cns' => true,
        'datanascimento' => true,
        'idade' => true,
        'celular' => true,
        'sexo' => true,
        'cep' => true,
        'estado' => true,
        'cidade' => true,
        'bairro' => true,
        'rua' => true,
        'numerocasa' => true,
        'created' => true,
        'modified' => true,
        'schedules' => true,
        'scheduling_id' => true
    ];


}
