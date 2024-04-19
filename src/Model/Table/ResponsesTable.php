<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Responses Model
 *
 * @property \App\Model\Table\PartiesTable&\Cake\ORM\Association\BelongsTo $Parties
 * @property \App\Model\Table\ComplaintsTable&\Cake\ORM\Association\BelongsTo $Complaints
 *
 * @method \App\Model\Entity\Response newEmptyEntity()
 * @method \App\Model\Entity\Response newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Response> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Response get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Response findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Response patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Response> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Response|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Response saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Response>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Response>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Response>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Response> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Response>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Response>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Response>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Response> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ResponsesTable extends Table
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

        $this->setTable('responses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Parties', [
            'foreignKey' => 'party_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Complaints', [
            'foreignKey' => 'complaint_id',
            'joinType' => 'INNER',
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
            ->integer('party_id')
            ->notEmptyString('party_id');

        $validator
            ->integer('complaint_id')
            ->notEmptyString('complaint_id');

        $validator
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmptyDateTime('date');

        $validator
            ->scalar('response_content')
            ->requirePresence('response_content', 'create')
            ->notEmptyString('response_content');

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
        $rules->add($rules->existsIn(['party_id'], 'Parties'), ['errorField' => 'party_id']);
        $rules->add($rules->existsIn(['complaint_id'], 'Complaints'), ['errorField' => 'complaint_id']);

        return $rules;
    }
}
