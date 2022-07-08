<?php

namespace Samueletur\IpagLaravel\Models;

use Samueletur\IpagLaravel\Abstracts\Model;

/**
 *
 * @property string pdf
 * @property string bankLine
 */
class Boleto extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['pdf', 'bankLine'];
}
