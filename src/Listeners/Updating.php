<?php

namespace SevenLab\Stamps\Listeners;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Updating
{
    /**
     * When the model is being updated.
     *
     * @param Illuminate\Database\Eloquent $model
     * @return void
     */
    public function handle($model)
    {
        if (!$model->isStamping() || is_null($model->getUpdatedByColumn()) || is_null(Auth::id())) {
            return;
        }

        $model->{$model->getUpdatedByColumn()} = Auth::id();
        $model->{$model->getUpdatedAtColumn()} = Carbon::now();
    }
}
