<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ExportReady extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $file) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'text' => 'PDF-каталог готов',
            'file' => $this->file,
            'url'  => route('admin.exports.download', $this->file),
        ];
    }
}