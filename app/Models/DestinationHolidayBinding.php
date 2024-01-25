<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Admin\SearchTrait;
use App\Traits\Admin\ColumnsTrait;
use App\Traits\Admin\UuidTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DestinationHolidayBinding extends Model
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
    // protected $hidden = [
    //     'id',
    // ];
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
    public static function options($column){
        if($column == 'status'){
            $options = [
                ['id' => 1,'caption' => 'Save Only', 'color' => 'bg-gray-400'],
                ['id' => 2,'caption' => 'Save & Publish', 'color' => 'bg-green-500'],
                ['id' => 3,'caption' => 'Save & Publish Later', 'color' => 'bg-yellow-500'],
            ];
        }
        if(isset($options)){
            return $options;
        }else{
            return null;
        }
    }
    /**
     * Get all of the destinations for the DestinationHolidayBinding
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function destinations(): HasMany
    {
        return $this->hasMany(Destination::class, 'id', 'destination_id');
    }
    /**
     * Get all of the holidays for the DestinationHolidayBinding
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function holidays(): HasMany
    {
        return $this->hasMany(HolidayCategory::class, 'id', 'holiday_id');
    }
}
