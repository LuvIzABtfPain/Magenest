<?php
namespace Magenest\Movie\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;


class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(\Magento\Framework\Setup\SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = $setup->getTable('magenest_director');
        $tableName2 = $setup->getTable('magenest_actor');
        $tableName3 = $setup->getTable('magenest_movie_actor');
        if (version_compare($context->getVersion(), '2.0.2', '<')) {
            if ($setup->getConnection()->isTableExists($tableName) != true){
                $table = $setup->getConnection()->newTable($tableName)->addColumn(
                        'director_id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'unsigned' => true,
                            'nullable' => false,
                            'primary' => true,
                            'auto_increment' => true
                        ],
                        'Director ID'
                    )
                    ->addColumn(
                        'name',
                        Table::TYPE_TEXT,
                        null,
                        ['nullable' => false, 'default' => ''],
                        'name'
                    )

                    ->setComment('Magenest_Director')
                    ->setOption('type', 'InnoDB')
                    ->setOption('charset', 'utf8');
                $setup->getConnection()->createTable($table);
            }
            if ($setup->getConnection()->isTableExists($tableName2) != true){
                $table = $setup->getConnection()->newTable($tableName2)
                    ->addColumn(
                        'actor_id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'unsigned' => true,
                            'nullable' => false,
                            'primary' => true,
                            'auto_increment' => true
                        ],
                        'Actor ID'
                    )
                    ->addColumn(
                        'name',
                        Table::TYPE_TEXT,
                        null,
                        ['nullable' => false, 'default' => ''],
                        'Actor name'
                    )

                    ->setComment('Magenest_Actorr')
                    ->setOption('type', 'InnoDB')
                    ->setOption('charset', 'utf8');
                $setup->getConnection()->createTable($table);
            }
        }
        if (version_compare($context->getVersion(), '2.0.4', '<')){
            if ($setup->getConnection()->isTableExists($tableName3) != true){
                $table = $setup->getConnection()->newTable($tableName3)
                    ->addColumn(
                        'id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'unsigned' => true,
                            'nullable' => false,
                            'primary' => true,
                        ],
                        'ID'
                    )
                    ->addColumn(
                        'actor_id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'unsigned' => true,
                            'nullable' => false,
                            'primary' => false,
                        ],
                        'Actor_ID'
                    )
                    ->addColumn(
                        'movie_id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'unsigned' => true,
                            'nullable' => false,
                            'primary' => false,
                        ],
                        'Movie_ID'
                    )->addForeignKey(
                    $setup->getFkName('magenest_movie_actor', 'actor_id', 'magenest_actor', 'actor_id'),
                    'actor_id',
                    'magenest_actor',
                    'actor_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )->addForeignKey(
                    $setup->getFkName('magenest_movie_actor', 'movie_id', 'magenest_movie', 'movie_id'),
                    'movie_id',
                    'magenest_movie',
                    'movie_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                    ->setComment('Magenest_Movie_Actor')
                    ->setOption('type', 'InnoDB')
                    ->setOption('charset', 'utf8');
                $setup->getConnection()->createTable($table);
            }
        }
        $setup->endSetup();
    }
}
