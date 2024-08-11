<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DomainUrl extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'domain_urls';
    protected $fillable = ['domain_url_name','base_domain_id'];
    protected $dates = ['deleted_at'];

    public function baseDomain()
    {
        return $this->belongsTo('App\Models\BaseDomain');
    }
}
