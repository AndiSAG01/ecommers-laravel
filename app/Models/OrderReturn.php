<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReturn extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['status_label'];

    public function getStatusLabelAttribute()
    {
        if ($this->status == 0) {
            return 'Menunggu Konfirmasi';
        } elseif ($this->status == 1) {
            return 'Disetujui';
        }
        return 'Ditolak';
    }
}
