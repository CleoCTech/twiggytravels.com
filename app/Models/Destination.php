<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Admin\SearchTrait;
use App\Traits\Admin\ColumnsTrait;
use App\Traits\Admin\UuidTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cviebrock\EloquentSluggable\Sluggable;

class Destination extends Model
{
    use HasFactory;
    use UuidTrait;
    use SearchTrait;
    use ColumnsTrait;
    use Sluggable; 

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
        } elseif ($column == 'category_id') {
            $options = DestinationCategory::all();
        }
        if(isset($options)){
            return $options;
        }else{
            return null;
        }
    }
    /**
     * Get all of the priceCategoriesBinds for the Destination
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function priceCategoriesBinds(): HasMany
    {
        return $this->hasMany(PriceCategoryBinding::class, 'destination_id', 'id');
    }
    /**
     * Get the destinationCategory that owns the Destination
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinationCategory(): BelongsTo
    {
        return $this->belongsTo(DestinationCategory::class, 'category_id', 'id');
    }
    /**
     * Get the destinationHolidayBinding that owns the Destination
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinationHolidayBinding(): HasMany
    {
        return $this->hasMany(DestinationHolidayBinding::class, 'destination_id', 'id');
    }
    /**
     * Get all of the rattings for the Destination
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rattings(): HasMany
    {
        return $this->hasMany(Ratting::class, 'destination_id', 'id');
    }

     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
