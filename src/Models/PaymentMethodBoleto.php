<?php

namespace Samueletur\IpagLaravel\Models;

use Samueletur\IpagLaravel\Abstracts\Model;

/**
 *
 * @property int $fine
 * @property int $interest
 * @property string $instructions
 * @property int $deadlineDays
 */
class PaymentMethodBoleto extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['fine', 'interest', 'instructions', 'deadlineDays'];
}
