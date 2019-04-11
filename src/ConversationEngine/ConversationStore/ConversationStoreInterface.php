<?php


namespace OpenDialogAi\ConversationEngine\ConversationStore;

use Ds\Map;
use OpenDialogAi\Core\Conversation\Conversation;

interface ConversationStoreInterface
{
    public function getAllOpeningIntents(): Map;

    public function getConversation($conversationId): Conversation;
}