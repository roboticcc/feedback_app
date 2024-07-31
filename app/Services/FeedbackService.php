<?php

namespace App\Services;

use App\Data\Feedback\FeedbackData;
use App\Models\Feedback;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackCreated;

class FeedbackService
{
    public function getAll(): array
    {
        $feedbacks = [];

        foreach (Feedback::all() as $feedback) {
            $feedbacks[] = FeedbackData::fromModel($feedback);
        }

        return $feedbacks;
    }

    public function getById(int $id): FeedbackData
    {
        return FeedbackData::fromModel(Feedback::findOrFail($id));
    }

    public function create(FeedbackData $data)
    {
        $feedback = Feedback::create([
            'subject' => $data->subject,
            'message' => $data->message,
            'user_id' => auth()->id(),
            'attachment' => $data->getAttachmentUrl() ?? null,
        ]);

        Mail::to('manager@example.com')->send(new FeedbackCreated($feedback));

        return FeedbackData::fromModel($feedback);
    }
}
