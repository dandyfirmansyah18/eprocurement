<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memorandum extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'memoranda';
    protected $primaryKey = 'id';
    protected $fillable = [
        'procurement_id',
        'purpose',
        'notes'
    ];

    public static function procurement_entity($procurement_id, $purpose)
    {
        return Memorandum::where('procurement_id', $procurement_id)
                            ->where('purpose', $purpose)
                            ->first();
    }
    
    public static function procurement_entities($procurement_id, $purpose)
    {
        return Memorandum::where('procurement_id', $procurement_id)
                            ->where('purpose', 'like', $purpose . '%')
                            ->get();
    }
    
    public function doc()
    {
        return Attachment::procurement_entity($this->procurement_id, 'nego_' . $this->id);
    }
}
