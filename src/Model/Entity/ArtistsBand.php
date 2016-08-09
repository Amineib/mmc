<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ArtistsBand Entity
 *
 * @property int $artist_id
 * @property int $band_id
 * @property string $instrument
 * @property string $joined
 * @property \Cake\I18n\Time $left
 *
 * @property \App\Model\Entity\Artist $artist
 * @property \App\Model\Entity\Band $band
 */
class ArtistsBand extends Entity
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
        'band_id' => false,
        'artist_id' => false
    ];
}
