<?php

namespace Samueletur\IpagLaravel\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $ipag_id
 * @property string $model
 * @property string $model_id
 * @property string $my_id
 * @property string $ipag_id
 * @property string $created_at
 * @property string $updated_at
 */
class IpagRegistration extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['ipag_id', 'model_type', 'model_id', 'my_id', 'ipag_id', 'created_at', 'updated_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (IpagRegistration $ipag) {
            if (empty($ipag->ipag_id))
                $ipag->ipag_id = config('ipag.credentials.client.id');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ipagClient()
    {
        return $this->belongsTo(IpagClient::class, 'ipag_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $model
     * @param int $modelId
     */
    public function scopeWhereModelId($query, $model, $modelId)
    {
        return $query->where([['model_type', $model], ['model_id', $modelId]]);
    }
}
