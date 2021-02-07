<?php
namespace App\Traits;
use Illuminate\Support\Str;

trait UsesUuid
{
    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    protected static function boot(){
        parent::boot();
        static::creating(function($model){
            if(!$model->getKey()){
                $model->{$model->getKeyname()} = (string) Str::uuid();
            }
        });
    }  
}