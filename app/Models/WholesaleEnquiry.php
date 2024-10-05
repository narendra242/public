<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WholesaleEnquiry extends Model
{
    use HasFactory;
    protected $guarded = ['g-recaptcha-response'];

}

