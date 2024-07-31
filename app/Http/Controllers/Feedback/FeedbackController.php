<?php

namespace App\Http\Controllers\Feedback;

use App\Data\Feedback\FeedbackData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Feedback\StoreRequest;
use App\Services\FeedbackService;
use Illuminate\Http\Response;

class FeedbackController extends Controller
{
    public function __construct(
        protected FeedbackService $feedbackService
    )
    {
    }

    public function index(): Response
    {
        return response($this->feedbackService->getAll());
    }

    public function show($id): Response
    {
        try {
            $feedback = $this->feedbackService->getById($id);
        } catch (\Exception $e) {
            return response("not found", 404);

        }

        return response($feedback);
    }

    public function store(StoreRequest $request): Response
    {
        $feedback = $this->feedbackService->create(FeedbackData::fromRequest($request));

        return response($feedback, 201);
    }
}
