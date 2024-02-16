<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    public function language(){
        return $this->where('key', 'language')->first()->value;
    }

    public function textDirection(){
        return $this->where('key', 'text_direction')->first()->value;
    }

}
