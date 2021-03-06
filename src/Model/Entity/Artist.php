<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Artist Entity
 *
 * @property int $id
 * @property string $name
 * @property string $created
 * @property string $modified
 * @property string $profile
 * @property string $picture
 * @property string $description
 *
 * @property \App\Model\Entity\Band $band
 */
class Artist extends Entity
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
