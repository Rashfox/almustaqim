<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admin';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['username', 'password','nama','role', 'email', 'email_verified_at'];
}