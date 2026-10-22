<?php

namespace App\Jobs;

use App\Models\Course;
use App\Models\User;
use App\Notifications\ExportReady;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class GenerateCatalogPdf implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;
    public int $backoff = 10;

    public function __construct(public User $user) {}

    public function handle(): void
    {
        // Получаем курсы с языками для каталога
        $courses = Course::with('language')->orderBy('title')->get();
        $pdf   = Pdf::loadView('pdf.catalog', compact('courses'))->output();

        $file = 'catalog-' . now()->format('Ymd-His') . '.pdf';
        Storage::put("exports/{$file}", $pdf);

        // Отправляем уведомление пользователю
        $this->user->notify(new ExportReady($file));
    }

    public function failed(?Throwable $e): void
    {
        Log::error('PDF не создан: ' . $e?->getMessage());
    }
}