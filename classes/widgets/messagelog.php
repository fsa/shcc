<?php

namespace Widgets;

use httpResponse;

class MessageLog {

    public static function show() {
        httpResponse::showCard('Последние голосовые сообщения', '<span id="tts_message_log"></span>');
    }

}
