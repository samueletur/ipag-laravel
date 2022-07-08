<?php

namespace Samueletur\IpagLaravel\Models;

use Samueletur\IpagLaravel\Abstracts\Model;

/**
 * @property string qrCode
 * @property string image
 * @property string page
 */
class Pix extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['qrCode', 'image', 'page',];
}
