<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * Party Entity
 *
 * @property int $id
 * @property string $nik
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $phone
 * @property string $role
 *
 * @property \App\Model\Entity\Complaint[] $complaints
 * @property \App\Model\Entity\Response[] $responses
 */
class Party extends Entity
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
        'nik' => true,
        'name' => true,
        'username' => true,
        'password' => true,
        'phone' => true,
        'role' => true,
        'complaints' => true,
        'responses' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var list<string>
     */
    protected array $_hidden = [
        'password',
    ];

    protected function _setPassword(string $password) : ? string
    {
        if(strlen($password)>0){
            return (new DefaultPasswordHasher())->hash($password);
        }
    }
}
