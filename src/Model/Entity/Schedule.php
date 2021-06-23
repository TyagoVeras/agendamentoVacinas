<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Schedule Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $data
 * @property \Cake\I18n\Time $hora
 * @property int $vacinado
 * @property string $display
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|null $observacao
 * @property int|null $person_id
 * @property int|null $dose_id
 * @property int $category_id
 * @property int $vaccine_id
 * @property int $place_id
 * @property int $user_id
 *
 * @property \App\Model\Entity\Person $person
 * @property \App\Model\Entity\Dose $dose
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Vaccine $vaccine
 * @property \App\Model\Entity\Place $place
 * @property \App\Model\Entity\User $user
 */
class Schedule extends Entity
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
        'data' => true,
        'hora' => true,
        'vacinado' => true,
        'display' => true,
        'created' => true,
        'modified' => true,
        'observacao' => true,
        'person_id' => true,
        'dose_id' => true,
        'category_id' => true,
        'vaccine_id' => true,
        'place_id' => true,
        'user_id' => true,
        'person' => true,
        'dose' => true,
        'category' => true,
        'vaccine' => true,
        'place' => true,
        'user' => true,
        'usercheck' => true,
    ];
}
