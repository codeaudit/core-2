<?php

namespace OpenDialogAi\ConversationEngine\Jobs\Traits;

trait ValidateConversationTrait
{
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
}
