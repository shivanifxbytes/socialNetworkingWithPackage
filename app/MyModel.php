<?php
namespace App;
use Illuminate\Support\Facades\DB;
/**
 * User Class
 *
 * @package
 * @subpackage            User
 * @category              Model
 * @DateOfCreation        17 August 2018
 * @DateOfDeprecated
 * @ShortDescription      This class contains basic database operation related functions using laravel db facade
 * @LongDescription
 */
class MyModel
{
    /**
     * @DateOfCreation       17 September 2018
     * @DateOfDeprecated   
     * @ShortDescription     This function selects the specified data from table
     * @LongDescription      
     * @param  string $table_name   
     * @param  array  $select_array 
     * @param  array  $where_array  
     * @return [object]               [StdClass result object]
     */
    public static function select($table_name = '', $select_array = [], $where_array = [])
    {
        $result = DB::table($table_name)->select($select_array)->where($where_array)->get()->toArray();
        return $result;
    }
    /**
     * @DateOfCreation       17 September 2018
     * @DateOfDeprecated   
     * @ShortDescription     This function insert the specified data into table
     * @LongDescription    
     * @param  string $table_name   
     * @param  array  $insert_array 
     * @return void
     */
    public static function insert($table_name = '', $insert_array = [])
    {
       return DB::table($table_name)->insertGetId($insert_array);
    }
    /**
     * @DateOfCreation       17 September 2018
     * @DateOfDeprecated   
     * @ShortDescription     This function update the specified data into table
     * @LongDescription    
     * @param  string $table_name   
     * @param  array  $update_array 
     * @param  array  $where_array  
     * @return void
     */
    public static function update($table_name = '', $update_array = [], $where_array = [])
    {
        DB::table($table_name)->where($where_array)->update($update_array);
    }
    
     /**
     * [getPostData description]
     * @param  array  $array [description]
     * @return [type]        [description]
     */
    public static function getPostData($array = [])
    {
    return    DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select('users.user_first_name', 'post_title', 'post_description','post_image','posts.id')
            ->whereIn('posts.user_id', $array)
            ->get();
    }
    public static function getColumnCount($table_name = '',$where_array = [],$column_name)
    {
        $count = DB::table($table_name)->where($where_array)->count($column_name);
        return $count;
    }


}