<?php

namespace OpenDialogAi\SensorEngine\Sensors;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenDialogAi\Core\Utterances\Exceptions\UtteranceUnknownMessageType;
use OpenDialogAi\Core\Utterances\UtteranceInterface;
use OpenDialogAi\Core\Utterances\Webchat\WebchatChatOpenUtterance;
use OpenDialogAi\Core\Utterances\Webchat\WebchatTextUtterance;
use OpenDialogAi\Core\Utterances\Webchat\WebchatTriggerUtterance;

class WebchatSensor extends BaseSensor implements SensorInterface
{
    protected $name = 'webchat';

    /**
     * Interpret a request.
     *
     * @param Request $request
     * @return UtteranceInterface
     * @throws UtteranceUnknownMessageType
     */
    public function interpret(Request $request) : UtteranceInterface
    {
        Log::debug('Interpreting webchat request.');

        switch ($request['content']['type']) {
            case 'chat_open':
                Log::debug('Received webchat open request.');
                return new WebchatChatOpenUtterance();
                break;
            case 'text':
                Log::debug('Received webchat message.');
                return new WebchatTextUtterance();
                break;
            case 'trigger':
                Log::debug('Received webchat trigger message.');
                return new WebchatTriggerUtterance();
                break;
            default:
                Log::debug("Received unknown webchat message type {$request['content']['type']}.");
                throw new UtteranceUnknownMessageType('Unknown Webchat Message Type.');
                break;
        }
    }
}