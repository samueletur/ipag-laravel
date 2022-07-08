<?php

namespace Samueletur\IpagLaravel\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $ipag_client_id
 * @property string $token_type
 * @property string $access_token
 * @property string $expires_in
 * @property string $scope
 * @property string $created_at
 * @property string $updated_at
 * @property IpagClient $ipagClient
 */
class IpagSession extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['ipag_client_id', 'token_type', 'access_token', 'expires_in', 'scope', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ipagClient()
    {
        return $this->belongsTo(IpagClient::class);
    }
}
