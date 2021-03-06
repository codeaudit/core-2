<?php

namespace OpenDialogAi\ConversationBuilder\Jobs\Traits;

use OpenDialogAi\ConversationBuilder\Conversation;
use OpenDialogAi\ConversationBuilder\ConversationStateLog;

trait ValidateConversationTrait
{
    /** @var Conversation */
    protected $conversation;

    /**
     * Check the conversation status and update the job
     * status if it is invalid.
     *
     * @return bool
     */
    public function checkConversationStatus()
    {
        if ($this->conversation->status === 'invalid') {
            // Delete the job so that it will not be re-tried.
            $this->delete();

            // Update this job's status.
            $this->conversation->{$this->jobName} = 'invalid';
            $this->conversation->save(['validate' => false]);
            return false;
        }

        return true;
    }

    /**
     * Log validation messages.
     */
    private function logMessage($conversationId, $type, $message)
    {
        $log = new ConversationStateLog();
        $log->conversation_id = $conversationId;
        $log->type = $type;
        $log->message = $message;
        $log->save();
    }
}
