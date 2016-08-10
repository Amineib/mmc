<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bands Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Cities
 * @property \Cake\ORM\Association\HasMany $Albums
 * @property \Cake\ORM\Association\HasMany $Networks
 * @property \Cake\ORM\Association\BelongsToMany $Artists
 * @property \Cake\ORM\Association\BelongsToMany $Genres
 *
 * @method \App\Model\Entity\Band get($primaryKey, $options = [])
 * @method \App\Model\Entity\Band newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Band[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Band|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Band patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Band[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Band findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BandsTable extends Table
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

        $this->table('bands');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id'
        ]);
        $this->hasMany('Albums', [
            'foreignKey' => 'band_id',
            'dependent' => true,
            'cascadeCallbacks' => true
        ]);
        $this->hasMany('Networks', [
            'foreignKey' => 'band_id',
            'dependent' => true
        ]);
        $this->belongsToMany('Artists', [
            'foreignKey' => 'band_id',
            'targetForeignKey' => 'artist_id',
            'joinTable' => 'artists_bands'
        ]);
        $this->belongsToMany('Genres', [
            'foreignKey' => 'band_id',
            'targetForeignKey' => 'genre_id',
            'joinTable' => 'bands_genres'
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
            ->boolean('active')
            ->allowEmpty('active');

        $validator
            ->allowEmpty('formed');

        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('picture');

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
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        return $rules;
    }

    public function findGenre(Query $query, array $options)
    {
        $bands = $this->find()->matching([
                            'Cities' => function($q) use ($options){
                                return $q->where(['Cities.name' => $options['genre']]);
                            } 
            ]);
        return $bands;
    }
}
