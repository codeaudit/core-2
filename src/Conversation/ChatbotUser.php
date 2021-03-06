<?php

namespace OpenDialogAi\Core\Conversation;

use OpenDialogAi\Core\Attribute\StringAttribute;
use OpenDialogAi\Core\Graph\Edge\DirectedEdge;
use OpenDialogAi\Core\Graph\Node\Node;

class ChatbotUser extends Node
{
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->addAttribute(new StringAttribute(Model::EI_TYPE, Model::CHATBOT_USER));
    }

    /**
     * @return bool
     */
    public function isHavingConversation() : bool
    {
        if ($this->hasOutgoingEdgeWithRelationship(Model::HAVING_CONVERSATION)) {
            return true;
        }
        return false;
    }

    /**
     * @param Conversation $conversation
     */
    public function setCurrentConversation(Conversation $conversation)
    {
        $currentConversation = clone $conversation;
        $currentConversation->setConversationType(Model::CONVERSATION_USER);
        $this->createOutgoingEdge(Model::HAVING_CONVERSATION, $currentConversation);
    }

    /**
     *
     */
    public function moveCurrentConversationToPast()
    {
        $currentConversation = $this->getCurrentConversation();
        $this->outgoingEdges->remove(Model::HAVING_CONVERSATION);
        $this->createOutgoingEdge(Model::HAD_CONVERSATION, $currentConversation);
    }

    /**
     * @return Conversation
     */
    public function getCurrentConversation(): Conversation
    {
        return $this->getNodesConnectedByOutgoingRelationship(Model::HAVING_CONVERSATION)->first()->value;
    }

    /**
     * Creates a new outgoing edge if there is no current intent otherwise changes the pointer
     * @param Intent $intent
     */
    public function setCurrentIntent(Intent $intent)
    {
        if ($this->hasCurrentIntent()) {
            /* @var DirectedEdge $existingEdge */
            $existingEdge = $this->getCurrentConversation()
                ->getOutgoingEdgesWithRelationship(Model::CURRENT_INTENT)->getFirstEdge();
            $existingEdge->setToNode($intent);
        } else {
            $this->getCurrentConversation()->createOutgoingEdge(Model::CURRENT_INTENT, $intent);
        }
    }

    /**
     * @return Intent
     */
    public function getCurrentIntent(): Intent
    {
        if ($this->isHavingConversation()) {
            if ($this->getCurrentConversation()->hasOutgoingEdgeWithRelationship(Model::CURRENT_INTENT)) {
                return $this->getCurrentConversation()
                    ->getNodesConnectedByOutgoingRelationship(Model::CURRENT_INTENT)
                    ->first()
                    ->value;
            }
        }

        return null;
    }

    /**
     * @return bool
     */
    public function hasCurrentIntent() : bool
    {
        if ($this->isHavingConversation()) {
            if ($this->getCurrentConversation()->hasOutgoingEdgeWithRelationship(Model::CURRENT_INTENT)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $uid
     * @return Intent
     */
    public function getIntentByUid($uid): Intent
    {
        return $this->getCurrentConversation()->getIntentByUid($uid);
    }
}
