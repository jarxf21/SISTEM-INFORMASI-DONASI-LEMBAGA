<?php

namespace App\Filament\Admin\Traits;

use Filament\Notifications\Notification;

trait PreventDeleteIfRelated
{
    public static function bootPreventDeleteIfRelated()
    {
        static::deleting(function ($model) {
            foreach ($model->getRelationsToCheck() as $relation) {
                if ($model->$relation()->exists()) {

                    // Ambil label manusiawi dari method getRelationLabels()
                    $labels = $model->getRelationLabels();
                    $label = $labels[$relation] ?? ucfirst($relation);

                    Notification::make()
                        ->title('Gagal Menghapus')
                        ->body("Data tidak bisa dihapus karena masih memiliki $label terkait.")
                        ->danger()
                        ->send();

                    return false; // stop proses delete
                }
            }
        });
    }

    /**
     * Tentukan relasi yang mau dicek sebelum hapus
     */
    protected function getRelationsToCheck(): array
    {
        return [];
    }

    /**
     * Mapping relasi ke label yang lebih manusiawi
     */
    protected function getRelationLabels(): array
    {
        return [];
    }
}
