<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'text',
    ];

    public function subModules()
    {
        return $this->hasMany(SubModule::class);
    }

    public function navLinks()
    {
        return (object)[
            'id' => $this->id,
            'href' => route($this->name),
            'name' => $this->name,
            'text' => __($this->text),
            'subNames' => $this->subModules->pluck('name')->toArray(),
            'subLinks' => $this->subModules->map(function ($subModule) {
                return $subModule->subNavLinks();
            })->toArray(),
        ];
    }
}
