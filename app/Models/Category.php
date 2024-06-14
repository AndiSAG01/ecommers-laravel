<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'parent_id', 'description', 'status'];

    public function getStatusLabelAttribute()
    {
        if ($this->status == 0) {
            return '<span class="badge bg-warning">Tidak Aktif</span>';
        }
        return '<span class="badge bg-primary">Aktif</span>';
    }

    public function getStatusNonLabelAttribute()
    {
        if ($this->status == 0) {
            return 'Tidak Aktif';
        }
        return 'Aktif';
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function scopeGetParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
