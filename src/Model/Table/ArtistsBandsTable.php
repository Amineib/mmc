<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ArtistsBands Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Artists
 * @property \Cake\ORM\Association\BelongsTo $Bands
 *
 * @method \App\Model\Entity\ArtistsBand get($primaryKey, $options = [])
 * @method \App\Model\Entity\ArtistsBand newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ArtistsBand[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ArtistsBand|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ArtistsBand patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ArtistsBand[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ArtistsBand findOrCreate($search, callable $callback = null)
 */
class ArtistsBandsTable extends Table
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

        $this->table('artists_bands');
        $this->displayField('band_id');
        $this->primaryKey(['band_id', 'artist_id']);

        $this->belongsTo('Artists', [
            'foreignKey' => 'artist_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Bands', [
            'foreignKey' => 'band_id',
            'joinType' => 'INNER'
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
            ->requirePresence('instrument', 'create')
            ->notEmpty('instrument');

        $validator
            ->allowEmpty('joined');

        $validator
            ->dateTime('left')
            ->allowEmpty('left');

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
        $rules->add($rules->existsIn(['artist_id'], 'Artists'));
        $rules->add($rules->existsIn(['band_id'], 'Bands'));

        return $rules;
    }
}
