<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Admin\SearchTrait;
use App\Traits\Admin\ColumnsTrait;
use App\Traits\Admin\UuidTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;
    use UuidTrait;
    use SearchTrait;
    use ColumnsTrait;

    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:d-M-Y',
        'updated_at'  => 'date:d-M-Y',
        'publish_time'  => 'datetime:d-M-Y h:m:s',
    ];
    protected $hidden = [
        'id',
    ];
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
    public static function options($column){
        if($column == 'status'){
            $options = [
                ['id' => 1,'caption' => 'Under Review', 'color' => 'bg-gray-400'],
                ['id' => 2,'caption' => 'Reviewed', 'color' => 'bg-green-500'],
                ['id' => 3,'caption' => 'Archive', 'color' => 'bg-yellow-500'],
            ];
        }
        if(isset($options)){
            return $options;
        }else{
            return null;
        }
    }

    /**
     * Get the destination that owns the Booking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class, 'destination_id', 'id');
    }

}
