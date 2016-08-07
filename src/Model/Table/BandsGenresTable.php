<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BandsGenres Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Bands
 * @property \Cake\ORM\Association\BelongsTo $Genres
 *
 * @method \App\Model\Entity\BandsGenre get($primaryKey, $options = [])
 * @method \App\Model\Entity\BandsGenre newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BandsGenre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BandsGenre|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BandsGenre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BandsGenre[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BandsGenre findOrCreate($search, callable $callback = null)
 */
class BandsGenresTable extends Table
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

        $this->table('bands_genres');
        $this->displayField('band_id');
        $this->primaryKey(['band_id', 'genre_id']);

        $this->belongsTo('Bands', [
            'foreignKey' => 'band_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Genres', [
            'foreignKey' => 'genre_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['genre_id'], 'Genres'));

        return $rules;
    }
}
