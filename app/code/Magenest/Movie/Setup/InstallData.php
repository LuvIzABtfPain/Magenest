<?php
namespace Magenest\Movie\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = $setup->getTable('magenest_director');
        if($setup->getConnection()->isTableExists($tableName) == true){
            $data = [
                [
                    'director_id' => 1,
                    'name' => 'nxmh'
                ],                [
                    'director_id' => 2,
                    'name' => 'nguyenxuanmanhhung'
                ],                [
                    'director_id' => 3,
                    'name' => 'manhhung'
                ],                [
                    'director_id' => 4,
                    'name' => 'mhung'
                ],                [
                    'director_id' => 5,
                    'name' => 'nxmhung'
                ],                [
                    'director_id' => 6,
                    'name' => 'hung'
                ],
            ];
            foreach ($data as $item){
                $setup->getConnection()->insert($tableName, $item);
            }
        }
        $tableName = $setup->getTable('magenest_actor');
        if($setup->getConnection()->isTableExists($tableName) == true) {
            $data = [
                [
                    'actor_id' => 1,
                    'name' => 'nxmc'
                ], [
                    'actor_id' => 2,
                    'name' => 'actor2'
                ], [
                    'actor_id' => 3,
                    'name' => 'actor3'
                ], [
                    'actor_id' => 4,
                    'name' => 'actor4'
                ], [
                    'actor_id' => 5,
                    'name' => 'actor5'
                ], [
                    'actor_id' => 6,
                    'name' => 'actor6'
                ],
            ];
            foreach ($data as $item) {
                $setup->getConnection()->insert($tableName, $item);
            }
        }
            $tableName = $setup->getTable('magenest_movie');
            if($setup->getConnection()->isTableExists($tableName) == true){
            $data = [
                [
                    'movie_id' => 1,
                    'name' => 'movie1',
                    'description' => 'desc1',
                    'rating' => 10,
                    'director_id' => 1
                ],
                [
                    'movie_id' => 2,
                    'name' => 'movie2',
                    'description' => 'desc1',
                    'rating' => 3,
                    'director_id' => 2
                ],
                [
                    'movie_id' => 3,
                    'name' => 'movie3',
                    'description' => 'desc3',
                    'rating' => 4,
                    'director_id' => 3
                ],
                [
                    'movie_id' => 4,
                    'name' => 'movie4',
                    'description' => 'desc4',
                    'rating' => 6,
                    'director_id' => 4
                ],
                [
                    'movie_id' => 5,
                    'name' => 'movie5',
                    'description' => 'desc5',
                    'rating' => 7,
                    'director_id' => 5
                ],


            ];
            foreach ($data as $item){
                $setup->getConnection()->insert($tableName, $item);
            }
        }
            $tableName = $setup->getTable('magenest_movie_actor');
            if($setup->getConnection()->isTableExists($tableName) == true){
            $data = [
                [
                    'id' => 1,
                    'movie_id' => 1,
                    'actor_id' => 2,
                ],[
                    'id' => 2,
                    'movie_id' => 1,
                    'actor_id' => 1,
                ],[
                    'id' => 3,
                    'movie_id' => 1,
                    'actor_id' => 3,
                ],[
                    'id' => 4,
                    'movie_id' => 2,
                    'actor_id' => 3,
                ],[
                    'id' => 5,
                    'movie_id' => 3,
                    'actor_id' => 6,
                ],[
                    'id' => 6,
                    'movie_id' => 4,
                    'actor_id' => 4,
                ],[
                    'id' => 7,
                    'movie_id' => 5,
                    'actor_id' => 5,
                ]
            ];
            foreach ($data as $item){
                $setup->getConnection()->insert($tableName, $item);
            }
        }
        $setup->endSetup();
    }
}
