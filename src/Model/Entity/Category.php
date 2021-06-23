<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity
 *
 * @property int $id
 * @property string|null $descricao
 * @property \Cake\I18n\FrozenDate|null $iniciovacinacao
 * @property \Cake\I18n\FrozenDate|null $fimvacinacao
 * @property int|null $active
 *
 * @property \App\Model\Entity\Schedule[] $schedules
 */
class Category extends Entity
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
        'descricao' => true,
        'iniciovacinacao' => true,
        'fimvacinacao' => true,
        'active' => true,
        'schedules' => true,
    ];
}
