<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'text',
        'module_id',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function subNavLinks()
    {
        return (object) [
            'id' => $this->id,
            'href' => route($this->name),
            'name' => $this->name,
            'text' => __($this->text),
        ];
    }
}
