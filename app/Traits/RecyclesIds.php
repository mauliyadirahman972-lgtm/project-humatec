<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait RecyclesIds
{
    /**
     * Boot the trait.
     */
    protected static function bootRecyclesIds(): void
    {
        static::creating(function ($model) {
            $keyName = $model->getKeyName();
            
            // Only find next available ID if it's not explicitly set
            if (empty($model->{$keyName})) {
                $model->{$keyName} = $model->getNextAvailableId();
            }
        });
    }

    /**
     * Get the next available ID by reusing deleted ones.
     */
    public function getNextAvailableId(): int
    {
        $key = $this->getKeyName();
        $table = $this->getTable();

        // 1. If 1 is not used yet, return 1
        if (!DB::table($table)->where($key, 1)->exists()) {
            return 1;
        }

        // 2. Otherwise, find the smallest ID + 1 that doesn't exist
        $result = DB::table("{$table} as t1")
            ->leftJoin("{$table} as t2", function ($join) use ($key) {
                $join->on(DB::raw("t1.{$key} + 1"), '=', "t2.{$key}");
            })
            ->whereNull("t2.{$key}")
            ->orderBy("t1.{$key}", 'asc')
            ->select(DB::raw("t1.{$key} + 1 as next_id"))
            ->first();

        return $result ? (int) $result->next_id : 1;
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     * Overriding this to false, so Eloquent won't ignore the explicitly set ID or fetch lastInsertId.
     */
    public function getIncrementing(): bool
    {
        return false;
    }
}
