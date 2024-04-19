<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Complaints Model
 *
 * @property \App\Model\Table\PartiesTable&\Cake\ORM\Association\BelongsTo $Parties
 * @property \App\Model\Table\ResponsesTable&\Cake\ORM\Association\HasMany $Responses
 *
 * @method \App\Model\Entity\Complaint newEmptyEntity()
 * @method \App\Model\Entity\Complaint newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Complaint> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Complaint get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Complaint findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Complaint patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Complaint> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Complaint|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Complaint saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Complaint>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Complaint>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Complaint>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Complaint> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Complaint>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Complaint>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Complaint>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Complaint> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ComplaintsTable extends Table
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

        $this->setTable('complaints');
        $this->setDisplayField('evidence');
        $this->setPrimaryKey('id');

        $this->belongsTo('Parties', [
            'foreignKey' => 'party_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Responses', [
            'foreignKey' => 'complaint_id',
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
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmptyDateTime('date');

        $validator
            ->scalar('report_content')
            ->requirePresence('report_content', 'create')
            ->notEmptyString('report_content');

        $validator
            ->scalar('evidence')
            ->maxLength('evidence', 50)
            ->requirePresence('evidence', 'create')
            ->notEmptyString('evidence');

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->allowEmptyFile('images')
            ->requirePresence('images','create')
            ->uploadedFile('images',[
                'types' => [
                    'image/png',
                    'image/jpg',
                    'image/jpeg',
                ],
            ], 'Cannot Input File Cause File Allowed is .png, .jpg and .jpeg');

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

        return $rules;
    }
}
