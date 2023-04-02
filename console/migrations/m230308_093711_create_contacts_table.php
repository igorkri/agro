<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contacts}}`.
 */
class m230308_093711_create_contacts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contacts}}', [
            'id' => $this->primaryKey(),
            'address' => $this->string()->comment('Адреса'),
            'tel_primary' => $this->string()->comment('Телефон перший'),
            'tel_second' => $this->string()->comment('Телефон другий'),
            'hours_work' => $this->string()->comment('Години роботи'),
            'coments_comm' => $this->string()->comment('Коментар зв"язок з нами'),
            'coments_footer' => $this->string()->comment('Коментар в футері'),
            'email' => $this->string()->comment('Пошта'),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contacts}}');
    }
}
