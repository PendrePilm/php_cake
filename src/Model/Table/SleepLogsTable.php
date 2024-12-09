<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SleepLogs Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\SleepLog newEmptyEntity()
 * @method \App\Model\Entity\SleepLog newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SleepLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SleepLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\SleepLog findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SleepLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SleepLog[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SleepLog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SleepLog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SleepLog[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SleepLog[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SleepLog[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SleepLog[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SleepLogsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    // src/Model/Table/SleepLogsTable.php
public function initialize(array $config): void
{
    parent::initialize($config);

    $this->addAssociations([
        'belongsTo' => [
            'Users' => [
                'foreignKey' => 'user_id',
                'joinType' => 'INNER',
            ]
        ]
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
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmptyDate('date');

        $validator
            ->time('bedtime')
            ->requirePresence('bedtime', 'create')
            ->notEmptyTime('bedtime');

        $validator
            ->time('wake_time')
            ->requirePresence('wake_time', 'create')
            ->notEmptyTime('wake_time');

        $validator
            ->scalar('naps')
            ->allowEmptyString('naps');

        $validator
            ->allowEmptyString('wake_score');

        $validator
            ->scalar('comment')
            ->allowEmptyString('comment');

        $validator
            ->boolean('sport_done')
            ->allowEmptyString('sport_done');

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
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
