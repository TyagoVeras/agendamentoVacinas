<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Doses Model
 *
 * @property \App\Model\Table\SchedulesTable&\Cake\ORM\Association\HasMany $Schedules
 *
 * @method \App\Model\Entity\Dose newEmptyEntity()
 * @method \App\Model\Entity\Dose newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Dose[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Dose get($primaryKey, $options = [])
 * @method \App\Model\Entity\Dose findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Dose patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Dose[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Dose|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Dose saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Dose[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Dose[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Dose[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Dose[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DosesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('doses');
        $this->setDisplayField('descricao');
        $this->setPrimaryKey('id');

        $this->hasMany('Schedules', [
            'foreignKey' => 'dose_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('descricao')
            ->maxLength('descricao', 45)
            ->requirePresence('descricao', 'create')
            ->notEmptyString('descricao');

        $validator
            ->notEmptyString('active');

        return $validator;
    }
}
