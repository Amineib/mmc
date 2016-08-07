<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Singles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Bands
 *
 * @method \App\Model\Entity\Single get($primaryKey, $options = [])
 * @method \App\Model\Entity\Single newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Single[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Single|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Single patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Single[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Single findOrCreate($search, callable $callback = null)
 */
class SinglesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('singles');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Bands', [
            'foreignKey' => 'band_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');

        $validator
            ->allowEmpty('link');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['band_id'], 'Bands'));

        return $rules;
    }
}
