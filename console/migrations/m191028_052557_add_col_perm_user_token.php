<?php

use yii\db\Migration;

/**
 * Class m191028_052557_add_col_perm_user_token
 */
class m191028_052557_add_col_perm_user_token extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user_token}}', 'permissions',$this->text());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user_token}}', 'permissions');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191028_052557_add_col_perm_user_token cannot be reverted.\n";

        return false;
    }
    */
}
