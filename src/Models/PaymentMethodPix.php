<?php

namespace Samueletur\IpagLaravel\Models;

use Samueletur\IpagLaravel\Abstracts\Model;

/**
 *
 * @property int $fine
 * @property int $interest
 * @property string $instructions
 * @property Deadline $Deadline
 * @property Discount $Discount
 */
class PaymentMethodPix extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['fine', 'interest', 'instructions', 'Deadline', 'Discount'];

    /**
     * @var string[]
     */
    protected $modelRefs = [
        'Deadline' => Deadline::class,
        'Discount' => Discount::class,
    ];
}
