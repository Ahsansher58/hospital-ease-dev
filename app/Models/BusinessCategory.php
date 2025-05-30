<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
  use HasFactory;

  protected $table = 'business_categories';

  protected $fillable = [
    'name',
    'main_category_id',
    'is_sub_category',
    'order_no',
    'image'
  ];
}
