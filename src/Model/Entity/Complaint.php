<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Complaint Entity
 *
 * @property int $id
 * @property int $party_id
 * @property \Cake\I18n\DateTime $date
 * @property string $report_content
 * @property string $evidence
 * @property string $status
 *
 * @property \App\Model\Entity\Party $party
 * @property \App\Model\Entity\Response[] $responses
 */
class Complaint extends Entity
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
        'date' => true,
        'report_content' => true,
        'evidence' => true,
        'status' => true,
        'party' => true,
        'responses' => true,
    ];
}
