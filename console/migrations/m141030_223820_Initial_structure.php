<?php

use yii\db\Schema;
use yii\db\Migration;

class m141030_223820_Initial_structure extends Migration
{
    public function up()
    {
        $this->db->createCommand("
            CREATE TABLE `question` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `question` varchar(255) DEFAULT NULL,
              `weight` float DEFAULT '0',
              PRIMARY KEY (`id`),
              KEY `weight` (`weight`)
            ) ENGINE=InnoDB
        ")->execute();

        $this->db->createCommand("
            CREATE TABLE `reply` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `reply` varchar(255) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB
        ")->execute();

        $this->db->createCommand("
            CREATE TABLE `question_reply` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `question_id` int(11) DEFAULT NULL,
              `reply_id` int(11) DEFAULT NULL,
              `reply_index` float DEFAULT NULL,
              `reply_cnt` int(11) DEFAULT '0',
              PRIMARY KEY (`id`),
              KEY `question_id` (`question_id`),
              KEY `reply_id` (`reply_id`),
              KEY `reply_index` (`reply_index`),
              CONSTRAINT `question_reply_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `question_reply_ibfk_2` FOREIGN KEY (`reply_id`) REFERENCES `reply` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB
        ")->execute();
    }

    public function down()
    {
        echo "m141030_223820_Initial_structure cannot be reverted.\n";

        return false;
    }
}
