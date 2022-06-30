<?php

namespace SevenLab\Stamps;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait LabStamps
{
    use SoftDeletes;

    /**
     * Whether we're currently maintaing stamps.
     *
     * @param bool
     */
    protected $stamping = true;

    /**
     * Boot the stamps trait for a model.
     *
     * @return void
     */
    public static function bootLabStamps()
    {
        static::registerListeners();
    }

    /**
     * Register events we need to listen for.
     *
     * @return void
     */
    public static function registerListeners()
    {
        static::creating('SevenLab\Stamps\Listeners\Creating@handle');
        static::updating('SevenLab\Stamps\Listeners\Updating@handle');
        static::deleting('SevenLab\Stamps\Listeners\Deleting@handle');
        static::restoring('SevenLab\Stamps\Listeners\Restoring@handle');
    }

    /**
     * Get the user that created the model.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo($this->getUserClass(), $this->getCreatedByColumn());
    }

    /**
     * Get the class being used to provide a User.
     *
     * @return string
     */
    public static function getUserClass()
    {
        return config('auth.providers.users.model');
    }

    /**
     * Get the name of the "created by" column.
     *
     * @return string
     */
    public function getCreatedByColumn()
    {
        return defined('static::CREATED_BY') ? static::CREATED_BY : 'created_by';
    }

    /**
     * Get the user that edited the model.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo($this->getUserClass(), $this->getUpdatedByColumn());
    }

    /**
     * Get the name of the "updated by" column.
     *
     * @return string
     */
    public function getUpdatedByColumn()
    {
        return defined('static::UPDATED_BY') ? static::UPDATED_BY : 'updated_by';
    }

    /**
     * Get the user that deleted the model.
     */
    public function deleter(): BelongsTo
    {
        return $this->belongsTo($this->getUserClass(), $this->getDeletedByColumn());
    }

    /**
     * Get the name of the "deleted by" column.
     *
     * @return string
     */
    public function getDeletedByColumn()
    {
        return defined('static::DELETED_BY') ? static::DELETED_BY : 'deleted_by';
    }

    /**
     * Get the name of the "created by" column.
     *
     * @return string
     */
    public function getCreatedAtColumn()
    {
        return defined('static::CREATED_AT') ? static::CREATED_AT : 'created_at';
    }

    /**
     * Get the name of the "created by" column.
     *
     * @return string
     */
    public function getUpdatedAtColumn()
    {
        return defined('static::UPDATED_AT') ? static::UPDATED_AT : 'updated_at';
    }

    /**
     * Check if we're maintaing Userstamps on the model.
     *
     * @return bool
     */
    public function isStamping()
    {
        return $this->stamping;
    }

    /**
     * Stop maintaining Userstamps on the model.
     *
     * @return void
     */
    public function stopStamping()
    {
        $this->stamping = false;
    }

    /**
     * Start maintaining Userstamps on the model.
     *
     * @return void
     */
    public function startStamping()
    {
        $this->stamping = true;
    }
}
