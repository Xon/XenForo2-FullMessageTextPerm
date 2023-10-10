<?php

namespace SV\FullMessageTextPermission;

abstract class Globals
{
    /** @var bool|null */
    public static $forceConversationNotification = null;

    /**
     * Private constructor, use statically.
     */
    private function __construct() { }
}
