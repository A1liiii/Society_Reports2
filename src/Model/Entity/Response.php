<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Response Entity
 *
 * @property int $id
 * @property int $party_id
 * @property int $complaint_id
 * @property \Cake\I18n\DateTime $date
 * @property string $response_content
 *
 * @property \App\Model\Entity\Party $party
 * @property \App\Model\Entity\Complaint $complaint
 */
class Response extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'party_id' => true,
        'complaint_id' => true,
        'date' => true,
        'response_content' => true,
        'party' => true,
        'complaint' => true,
    ];
}
