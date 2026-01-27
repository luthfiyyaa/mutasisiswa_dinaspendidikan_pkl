<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model
{
  protected $table = 'tbl_group';
  protected $primaryKey = 'group_id';

  protected $fillable = [
        'group_nama',
        // tambahkan field lainnya
    ];

    public function users()
    {
        return $this->hasMany(MasterUserModel::class, 'group_id', 'group_id');
    }
}
