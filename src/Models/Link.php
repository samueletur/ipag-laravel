<?php

namespace Samueletur\IpagLaravel\Models;

use Samueletur\IpagLaravel\Abstracts\Model;

/**
 *
 * @property int $minInstallment;
 * @property int $maxInstallment;
 */
class Link extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['minInstallment', 'maxInstallment'];
}
