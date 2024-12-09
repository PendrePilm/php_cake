<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SleepLog Entity
 *
 * @property int $id
 * @property int $user_id
 * @property \Cake\I18n\FrozenDate $date
 * @property \Cake\I18n\Time $bedtime
 * @property \Cake\I18n\Time $wake_time
 * @property string|null $naps
 * @property int|null $wake_score
 * @property string|null $comment
 * @property bool|null $sport_done
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 */
class SleepLog extends Entity
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
    protected $_accessible = [
        'user_id' => true,
        'date' => true,
        'bedtime' => true,
        'wake_time' => true,
        'naps' => true,
        'wake_score' => true,
        'comment' => true,
        'sport_done' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
