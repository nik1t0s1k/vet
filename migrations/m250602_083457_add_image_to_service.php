<?php

use yii\db\Migration;

/**
 * Class m250602_083457_add_image_to_service
 */
class m250602_083457_add_image_to_service extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%service}}', 'image', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%service}}', 'image');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250602_083457_add_image_to_service cannot be reverted.\n";

        return false;
    }
    */
}
