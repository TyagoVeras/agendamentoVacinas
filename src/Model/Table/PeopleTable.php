<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * People Model
 *
 * @property \App\Model\Table\SchedulesTable&\Cake\ORM\Association\HasMany $Schedules
 *
 * @method \App\Model\Entity\Person newEmptyEntity()
 * @method \App\Model\Entity\Person newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Person[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Person get($primaryKey, $options = [])
 * @method \App\Model\Entity\Person findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Person patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Person[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Person|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Person saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PeopleTable extends Table
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

        $this->setTable('people');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Schedules', [
            'foreignKey' => 'person_id',
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
            ->allowEmptyString('imunizado');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 45)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('cpf')
            ->maxLength('cpf', 45)
            ->requirePresence('cpf', 'create')
            ->notEmptyString('cpf');

        $validator
            ->scalar('cns')
            ->maxLength('cns', 45)
            ->requirePresence('cns', 'create')
            ->notEmptyString('cns');

        $validator
            ->date('datanascimento')
            ->requirePresence('datanascimento', 'create')
            ->notEmptyDate('datanascimento');

        $validator
            ->integer('idade')
            ->requirePresence('idade', 'create')
            ->notEmptyString('idade');

        $validator
            ->scalar('celular')
            ->maxLength('celular', 45)
            ->allowEmptyString('celular');

        $validator
            ->requirePresence('sexo', 'create')
            ->notEmptyString('sexo');

        $validator
            ->scalar('cep')
            ->maxLength('cep', 45)
            ->requirePresence('cep', 'create')
            ->notEmptyString('cep');

        $validator
            ->scalar('estado')
            ->maxLength('estado', 45)
            ->requirePresence('estado', 'create')
            ->notEmptyString('estado');

        $validator
            ->scalar('cidade')
            ->maxLength('cidade', 45)
            ->requirePresence('cidade', 'create')
            ->notEmptyString('cidade');

        $validator
            ->scalar('bairro')
            ->maxLength('bairro', 45)
            ->requirePresence('bairro', 'create')
            ->notEmptyString('bairro');

        $validator
            ->scalar('rua')
            ->maxLength('rua', 45)
            ->requirePresence('rua', 'create')
            ->notEmptyString('rua');

        $validator
            ->scalar('numerocasa')
            ->maxLength('numerocasa', 45)
            ->requirePresence('numerocasa', 'create')
            ->notEmptyString('numerocasa');

        return $validator;
    }
}
