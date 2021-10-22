<?php

namespace SevenLab\Stamps\Listeners;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Creating
{
    /**
     * When the model is being created.
     *
     * @param Illuminate\Database\Eloquent $model
     * @return void
     */
    public function handle($model)
    {
        if (!$model->isStamping() || is_null($model->getCreatedByColumn()) || is_null($model->getCreatedAtColumn())) {
            return;
        }

        if (is_null($model->{$model->getCreatedByColumn()})) {
            $model->{$model->getCreatedByColumn()} = Auth::id();
        }

        if (is_null($model->{$model->getCreatedAtColumn()})) {
            $model->{$model->getCreatedAtColumn()} = Carbon::now();
        }

        if (is_null($model->{$model->getUpdatedByColumn()}) && !is_null($model->getUpdatedByColumn())) {
            $model->{$model->getUpdatedByColumn()} = Auth::id();
        }

        if (is_null($model->{$model->getUpdatedAtColumn()}) && !is_null($model->getUpdatedAtColumn())) {
            $model->{$model->getUpdatedAtColumn()} = Carbon::now();
        }
    }
}
