<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class DetailOrder extends Model implements AuthenticatableContract, AuthorizableContract
{   public $table = "detail_order";
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orders_id', 'id_producto','nombre_producto','cantidad', 'precio', 'subtotal'
    ];
    public function orders(){
        return $this->belongsTo(Orders::class);
    }
}
