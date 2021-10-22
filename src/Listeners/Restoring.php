<?php

namespace SevenLab\Stamps\Listeners;

class Restoring
{
    /**
     * When the model is being restored.
     *
     * @param Illuminate\Database\Eloquent $model
     * @return void
     */
    public function handle($model)
    {
        if (!$model->isStamping() || is_null($model->getDeletedByColumn()) || is_null($model->getDeletedAtColumn())) {
            return;
        }

        $model->{$model->getDeletedByColumn()} = null;
        $model->{$model->getDeletedAtColumn()} = null;
    }
}
