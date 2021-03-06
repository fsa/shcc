<?php
/**
 * Не редактируйте данный файл. Он может быть изменён при обновлении системы.
 */

$night=boolval(getVar('System.NightMode'));
$security=boolval(getVar('System.SecurityMode'));
$mute=boolval($night or $security or getVar('System.SoundMute'));
$minute=date('i');
$hour=date('H');
$time=date('H:i');

function say($text) {
    \Tts\Log::newMessage($text);
    global $mute;
    if ($mute) {
        return;
    }
    $tts=new Tts\Queue();
    $tts->addMessage($text);
}

function getDevivce($name) {
    return SmartHome\Devices::get($name);
}

function getVar($name) {
    return SmartHome\Vars::get($name);
}

function setVar($name, $value) {
    SmartHome\Vars::set($name, $value);
}

function getOject($name) {
    return SmartHome\Vars::getObject($name);
}

function setObject($name, $object) {
    SmartHome\Vars::setObject($name, $object);
}

function getJson($name) {
    return SmartHome\Vars::getJson($name);
}

function setJson($name, $object) {
    SmartHome\Vars::setJson($name, $object);
}
