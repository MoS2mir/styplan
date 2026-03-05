<?php
namespace Modules\User\Models;
use App\BaseModel;

class UserWishList extends BaseModel
{
    protected $table = 'user_wishlist';
    protected $fillable = [
        'object_id',
        'object_model',
        'user_id'
    ];

    public function service()
    {
        $allServices = get_bookable_services();
        $module = $allServices[$this->object_model] ?? null;
        if ($module and class_exists($module)) {
            return $this->hasOne($module, "id", 'object_id')->where("deleted_at",null);
        }
        return $this->hasOne(\Modules\Space\Models\Space::class, 'id', 'object_id')->whereRaw("1 = 0");
    }
}