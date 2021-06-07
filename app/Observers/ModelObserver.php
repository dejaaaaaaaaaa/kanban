<?php

namespace App\Observers;

class ModelObserver
{
    public function updating($model)
    {
        if(auth()->user()){
            $model->updated_by = auth()->user()->id;
        }
    }

    public function creating($model)
    {
        if(auth()->user()){
            $model->created_by = auth()->user()->id;
            $model->updated_by = auth()->user()->id;
        }
    }

    public function deleting($model)
    {
        if(auth()->user()){
            $model->deleted_by = auth()->user()->id;
        }
    }
}
