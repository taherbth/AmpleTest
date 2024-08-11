<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BaseDomain extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'base_domains';
    protected $fillable = ['domain_name','user_id'];
    protected $dates = ['deleted_at'];

    public function domianUrls()
    {
        return $this->hasMany('App\Models\DomainUrl');
    }
}
 