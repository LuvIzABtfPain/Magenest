<?php

namespace Magenest\Blog\Setup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = $setup->getTable('magenest_blog');
        if($setup->getConnection()->isTableExists($tableName) == true){
            $data = [
                [
                    'id' => 1,
                    'author_id' => 1,
                    'title' => 'blog1'
                ],                [
                    'id' => 2,
                    'author_id' => 2,
                    'title' => 'blog2'
                ],                [
                    'id' => 3,
                    'author_id' => 3,
                    'title' => 'blog3'
                ],                [
                    'id' => 4,
                    'author_id' => 1,
                    'title' => 'blog4'
                ],                [
                    'id' => 5,
                    'author_id' => 2,
                    'title' => 'blog5'
                ],                [
                    'id' => 6,
                    'author_id' => 3,
                    'title' => 'blog6'
                ],
            ];
            foreach ($data as $item){
                $setup->getConnection()->insert($tableName, $item);
            }
        }
        $tableName = $setup->getTable('magenest_category');
        if($setup->getConnection()->isTableExists($tableName) == true) {
            $data = [
                [
                    'id' => 1,
                    'name' => 'cat1'
                ], [
                    'id' => 2,
                    'name' => 'cat2'
                ], [
                    'id' => 3,
                    'name' => 'cat3'
                ], [
                    'id' => 4,
                    'name' => 'cat4'
                ], [
                    'id' => 5,
                    'name' => 'cat5'
                ], [
                    'id' => 6,
                    'name' => 'cat6'
                ],
            ];
            foreach ($data as $item) {
                $setup->getConnection()->insert($tableName, $item);
            }
        }
        $tableName = $setup->getTable('magenest_blog_category');
        if($setup->getConnection()->isTableExists($tableName) == true){
            $data = [
                [
                    'id' => 1,
                    'blog_id' => 1,
                    'category_id' => 1,
                ],
                [
                    'id' => 2,
                    'blog_id' => 2,
                    'category_id' => 2,
                ],
                [
                    'id' => 3,
                    'blog_id' => 3,
                    'category_id' => 3,
                ],
                [
                    'id' => 4,
                    'blog_id' => 4,
                    'category_id' => 4,
                ],
                [
                    'id' => 5,
                    'blog_id' => 5,
                    'category_id' => 5,
                ],
                [
                    'id' => 6,
                    'blog_id' => 6,
                    'category_id' => 6,
                ],
                [
                    'id' => 7,
                    'blog_id' => 3,
                    'category_id' => 1,
                ],
                [
                    'id' => 8,
                    'blog_id' => 1,
                    'category_id' => 4,
                ],
            ];
            foreach ($data as $item){
                $setup->getConnection()->insert($tableName, $item);
            }
        }
        $setup->endSetup();
    }
}
