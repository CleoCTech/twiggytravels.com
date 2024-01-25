<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Admin\SearchTrait;
use App\Traits\Admin\ColumnsTrait;
use App\Traits\Admin\UuidTrait;

class Attachment extends Model
{
    use HasFactory;
    use UuidTrait;
    use SearchTrait;
    use ColumnsTrait;
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:d-M-Y',
        'updated_at'  => 'date:d-M-Y',
    ];
    protected $hidden = [
        'id',
    ];
}