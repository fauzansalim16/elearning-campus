<?php

namespace App\Http\Controllers;

use App\Http\Requests\Discussion\StoreDiscussionRequest;
use App\Http\Requests\Reply\StoreReplyRequest;
use App\Models\Discussion;
use App\Services\DiscussionService;
use Illuminate\Http\JsonResponse;

class DiscussionController extends Controller
{
    public function __construct(private DiscussionService $discussionService)
    {
    }

    public function store(StoreDiscussionRequest $request): JsonResponse
    {
        $discussion = $this->discussionService->createDiscussion(
            (int) $request->input('course_id'),
            (int) $request->user()->id,
            (string) $request->input('content')
        );
        return response()->json(['id' => $discussion->id], 201);
    }

    public function reply(StoreReplyRequest $request, int $id): JsonResponse
    {
        $discussion = Discussion::findOrFail($id);
        $reply = $this->discussionService->createReply(
            (int) $discussion->id,
            (int) $request->user()->id,
            (string) $request->input('content')
        );
        return response()->json(['id' => $reply->id], 201);
    }
}



