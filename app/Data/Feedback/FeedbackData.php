<?php

namespace App\Data\Feedback;

use App\Models\Feedback;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelData\Data;

class FeedbackData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string  $subject,
        public readonly string  $message,
        public readonly ?string $client_name,
        public readonly ?string $client_email,
        public readonly ?string $attachment_path,
    )
    {
    }

    public static function fromRequest($request): self
    {
        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');


            $fileName = uniqid() . '_' . $file->getClientOriginalName();

            $attachmentPath = $file->storeAs('feedback_attachments', $fileName, 'public');
        }

        return new self(
            id: $request->input('id') ?? null,
            subject: $request->input('subject'),
            message: $request->input('message'),
            client_name: $request->input('client_name'),
            client_email: $request->input('client_email'),
            attachment_path: $attachmentPath,
        );
    }

    public static function fromModel(Feedback $feedback): self
    {
        return new self(
            id: $feedback->id,
            subject: $feedback->subject,
            message: $feedback->message,
            client_name: $feedback->user->name,
            client_email: $feedback->user->email,
            attachment_path: $feedback->attachment ?? null,
        );
    }

    public function getAttachmentUrl(): ?string
    {
        return $this->attachment_path ? Storage::url($this->attachment_path) : null;
    }
}
