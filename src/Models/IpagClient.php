<?php

namespace Samueletur\IpagLaravel\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $model_type
 * @property string $model_id
 * @property string $ipag_id
 * @property string $ipag_hash
 * @property string $webhook_hash
 * @property string $created_at
 * @property string $updated_at
 * @property IpagRegistration[] $ipagRegistrations
 * @property IpagSession $ipagSession
 */
class IpagClient extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['model_type', 'model_id', 'ipag_id', 'ipag_hash', 'webhook_hash', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ipagRegistrations()
    {
        return $this->hasMany(IpagRegistration::class, 'ipag_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ipagSession()
    {
        return $this->hasOne(IpagSession::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }
}
