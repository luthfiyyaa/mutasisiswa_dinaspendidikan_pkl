<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TUserModel extends Model
{
  protected $table = 'tbl_t_user';
  protected $primaryKey = 't_user_id';

  /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'group_id',
        'menu_id',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'group_id' => 'integer',
        'menu_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the group that owns the t_user
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(GroupModel::class, 'group_id', 'group_id');
    }

    /**
     * Get the menu that owns the t_user
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(MenuModel::class, 'menu_id', 'menu_id');
    }
}
