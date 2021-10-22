<?php

namespace SevenLab\Stamps\Listeners;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Deleting
{
    /**
     * When the model is being deleted.
     *
     * @param Illuminate\Database\Eloquent $model
     * @return void
     */
    public function handle($model)
    {
        if (!$model->isStamping() || is_null($model->getDeletedByColumn())) {
            return;
        }

        if (is_null($model->{$model->getDeletedByColumn()})) {
            $model->{$model->getDeletedByColumn()} = Auth::id();
        }

        if (is_null($model->{$model->getDeletedAtColumn()})) {
            $model->{$model->getDeletedAtColumn()} = Carbon::now();
        }

        $dispatcher = $model->getEventDispatcher();

        $model->unsetEventDispatcher();

        $model->save();

        $model->setEventDispatcher($dispatcher);
    }
}
