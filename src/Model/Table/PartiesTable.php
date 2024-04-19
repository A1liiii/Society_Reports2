<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parties Model
 *
 * @property \App\Model\Table\ComplaintsTable&\Cake\ORM\Association\HasMany $Complaints
 * @property \App\Model\Table\ResponsesTable&\Cake\ORM\Association\HasMany $Responses
 *
 * @method \App\Model\Entity\Party newEmptyEntity()
 * @method \App\Model\Entity\Party newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Party> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Party get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Party findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Party patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Party> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Party|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Party saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Party>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Party>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Party>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Party> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Party>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Party>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Party>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Party> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PartiesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('parties');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Complaints', [
            'foreignKey' => 'party_id',
        ]);
        $this->hasMany('Responses', [
            'foreignKey' => 'party_id',
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
            ->scalar('nik')
            ->maxLength('nik', 16)
            ->requirePresence('nik', 'create')
            ->notEmptyString('nik');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('username')
            ->maxLength('username', 50)
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 100)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 12)
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone');

        $validator
            ->scalar('role')
            ->requirePresence('role', 'create')
            ->notEmptyString('role');

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
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);

        return $rules;
    }
}
