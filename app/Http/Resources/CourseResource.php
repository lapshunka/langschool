<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'price'       => $this->price,
            'duration'    => $this->duration,
            'cover'       => $this->cover_url,
            'language'    => new LanguageResource($this->whenLoaded('language')),
            'created_at'  => $this->created_at?->toIso8601String(),
            'links'       => [
                'self' => route('api.v1.courses.show', $this->id),
            ],
        ];
    }
}