<?php

use yii\db\Migration;

/**
 * Class m250620_061550_add_views_count_to_knowledge_base
 */
class m250620_061550_add_views_count_to_knowledge_base extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('knowledge_base', 'views_count', $this->integer()->defaultValue(0));
    }

    public function safeDown()
    {
        $this->dropColumn('knowledge_base', 'views_count');
    }
}


/*
// Use up()/down() to run migration code without a transaction.
public function up()
{

}

public function down()
{
    echo "m250620_061550_add_views_count_to_knowledge_base cannot be reverted.\n";

    return false;
}
*/

