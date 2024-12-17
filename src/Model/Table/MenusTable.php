<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class MenusTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('menus');
        $this->setDisplayField('intitule');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('ordre')
            ->requirePresence('ordre', 'create')
            ->notEmptyString('ordre');

        $validator
            ->scalar('intitule')
            ->maxLength('intitule', 255)
            ->requirePresence('intitule', 'create')
            ->notEmptyString('intitule');

        $validator
            ->scalar('lien')
            ->maxLength('lien', 255)
            ->requirePresence('lien', 'create')
            ->notEmptyString('lien');

        return $validator;
    }
}
