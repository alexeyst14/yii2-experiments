<?php

namespace common\core;


class ReplyCollection
{
    private static $instance;
    private $replies = [];

    private function __construct()
    {
        $replies = \Yii::$app->getSession()->get('replies');
        $this->replies = $replies ? $replies : [];
    }

    public function __destruct()
    {
        \Yii::$app->getSession()->set('replies', $this->replies);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function clear()
    {
        $this->replies = [];
    }

    public function addReply($questionId, $reply)
    {
        $this->replies[$questionId] = $reply;
    }

    public function getReplies()
    {
        return $this->replies;
    }

} 