<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\EventInterface;


/**
 * Schedules Model
 *
 * @property \App\Model\Table\PeopleTable&\Cake\ORM\Association\BelongsTo $People
 * @property \App\Model\Table\DosesTable&\Cake\ORM\Association\BelongsTo $Doses
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\VaccinesTable&\Cake\ORM\Association\BelongsTo $Vaccines
 * @property \App\Model\Table\PlacesTable&\Cake\ORM\Association\BelongsTo $Places
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Schedule newEmptyEntity()
 * @method \App\Model\Entity\Schedule newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Schedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Schedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\Schedule findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Schedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Schedule[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Schedule|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Schedule saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Schedule[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Schedule[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Schedule[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Schedule[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SchedulesTable extends Table
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

        $this->setTable('schedules');
        $this->setDisplayField('display');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('People', [
            'foreignKey' => 'person_id',
        ]);
        $this->belongsTo('Doses', [
            'foreignKey' => 'dose_id',
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Vaccines', [
            'foreignKey' => 'vaccine_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Places', [
            'foreignKey' => 'place_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'usercheck',
            'joinType' => 'LEFT',
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
            ->date('data')
            ->requirePresence('data', 'create')
            ->notEmptyDate('data');

        $validator
            ->time('hora')
            ->requirePresence('hora', 'create')
            ->notEmptyTime('hora');

        $validator
            ->notEmptyString('vacinado');

        $validator
            ->scalar('display')
            ->maxLength('display', 45)
            ->allowEmptyString('display');

        $validator
            ->scalar('observacao')
            ->allowEmptyString('observacao');
        
        $validator
            ->scalar('usercheck')
            ->allowEmptyString('usercheck');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['person_id'], 'People'), ['errorField' => 'person_id']);
        $rules->add($rules->existsIn(['dose_id'], 'Doses'), ['errorField' => 'dose_id']);
        $rules->add($rules->existsIn(['category_id'], 'Categories'), ['errorField' => 'category_id']);
        $rules->add($rules->existsIn(['vaccine_id'], 'Vaccines'), ['errorField' => 'vaccine_id']);
        $rules->add($rules->existsIn(['place_id'], 'Places'), ['errorField' => 'place_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }

    public function beforeSave(EventInterface $event)
    {
        $entity = $event->getData('entity');
        if ($entity->isNew()) {
            $entity->display = $entity->data->format('d/m/Y').' às '.$entity->hora;
        }else{
            //update
            $entity->display = $entity->data->format('d/m/Y').' às '.$entity->hora;
        }
        return true;
    }

    //CONSULTAS PERSONALIZADAS
    //NAO TEM NINGUEM VINCULADO
    public function findSchedulesEmpty(Query $query, array $options)
    {
        // $type = $options['type'];
        return $query->where(['person_id IS ' => null]);
    }
    
    //TEM ALGUEM VINCULADO
    public function findSchedulesNotEmpty(Query $query, array $options)
    {
        // $type = $options['type'];
        return $query->where(['person_id IS NOT' => null]);
    }

    //VACINADO
    public function findSchedulesIsVaccines(Query $query, array $options)
    {
        // $type = $options['type'];
        return $query->where(['vacinado' => 1]);
    }
    //BUSCANDO AGENDAMENTOS QUE NAO POSSUEM PESSOA
    public function findSchedulesIsNotPerson(Query $query, array $options)
    {
        // $type = $options['type'];
        return $query->where(['person_id IS ' => null]);
    }
    //BUSCANDO PESSOAS QUE NAO COMPARECERAM AO AGENDAMENTO
    public function findSchedulesNotCompareceram(Query $query, array $options)
    {
        // $type = $options['type'];
        return $query->where(['vacinado ' => 0, 'person_id IS NOT'=> null, 'data <' =>  date('Y/m/d')]);
    }
}
