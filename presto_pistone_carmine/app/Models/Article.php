<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'user_id', 
        'is_accepted'
    ];



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function setAccepted($value)
    {
        $this->is_accepted = $value;
        $this->save();
        return true;
    }


    public static function toBerevisedCount()
    {
        return Article::where('is_accepted', null)->count();
    }




    use Searchable;

    /**
     * Definisci quali campi Meilisearch deve indicizzare
     */
    public function toSearchableArray(): array
    {
        return [
            'id'        => $this->id,
            'title'    => $this->title,
            'description' => $this->description,
            'category' => $this->category,
        ];
    }


    public static function searchIndexConfiguration(): array
    {
        return [
            'filterableAttributes' => ['is_accepted'],
        ];
    }

}