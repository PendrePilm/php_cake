<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class SleepLogsTable extends Table
{
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

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
