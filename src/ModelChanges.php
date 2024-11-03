<?php declare(strict_types=1);
/**
 * @author Jacques Marneweck <jacques@siberia.co.za>
 */

namespace Jacques\Eloquent\Helpers;

use Illuminate\Database\Eloquent\Model;

final class ModelChanges
{
    public function getChanges(Model $model, ?string $request_id, ?int $created_by)
    {
        $changes = [];

        if ($model->exists && $model->isDirty()) {
            foreach ($model->getDirty() as $dirty => $value) {
                $changes[] = [
                    'table' => $model->getTable(),
                    'identifier' => $model->id,
                    'field' => $dirty,
                    'from' => $model->getOriginal($dirty),
                    'to' => $value,
                    'request_id' => $request_id,
                    'created_by' => $created_by,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ];
            }
        }

        return $changes;
    }
}
