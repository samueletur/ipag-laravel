<?php

namespace Samueletur\IpagLaravel\Models;

use Samueletur\IpagLaravel\Abstracts\Model;

/**
 *
 * @property string $type
 * @property int $value
 */
class Deadline extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['type', 'value'];
}
