<?php

namespace App\Services;

use App\Models\Discussion;
use App\Models\Reply;

class DiscussionService
{
    public function createDiscussion(int $courseId, int $userId, string $content): Discussion
    {
        return Discussion::create([
            'course_id' => $courseId,
            'user_id' => $userId,
            'content' => $content,
        ]);
    }

    public function createReply(int $discussionId, int $userId, string $content): Reply
    {
        return Reply::create([
            'discussion_id' => $discussionId,
            'user_id' => $userId,
            'content' => $content,
        ]);
    }
}



