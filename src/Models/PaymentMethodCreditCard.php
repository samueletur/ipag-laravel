<?php

namespace Samueletur\IpagLaravel\Models;

use Samueletur\IpagLaravel\Abstracts\Model;

/**
 *
 * @property Link $Link
 * @property Card $Card
 * @property int $qtdInstallments
 */
class PaymentMethodCreditCard extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['Link', 'Card', 'qtdInstallments'];

    /**
     * @var string[]
     */
    protected $modelRefs = [
        'Link' => Link::class,
        'Card' => Card::class,
    ];
}
