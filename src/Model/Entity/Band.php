<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Band Entity
 *
 * @property int $id
 * @property string $name
 * @property bool $active
 * @property string $formed
 * @property string $description
 * @property int $city_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $picture
 *
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Album[] $albums
 * @property \App\Model\Entity\Artist[] $artists
 * @property \App\Model\Entity\Network[] $networks
 * @property \App\Model\Entity\Single[] $singles
 * @property \App\Model\Entity\Genre[] $genres
 */
class Band extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
