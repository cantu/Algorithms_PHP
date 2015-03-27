<?php
//memcache config parameters
$cache_server = '127.0.0.1';
$cache_port = '11211';
$cache_prefix = 'file_';
//mysql config parameters
$mysql_server = '127.0.0.1';
$mysql_user = 'root';
$mysql_pw = 'root';
$mysql_db = 'hash_test_db';
$mysql_table = 'dir_string_tb';
$out_data = array();



$start_time = microtime(true);

$name = isset( $_GET['name'] ) ? htmlentities( addslashes(trim( $_GET['name']) )) : '';
$offset = isset( $_GET['offset'] ) ? htmlentities( addslashes(intval( $_GET['offset']) )) : 0;
$number = isset( $_GET['number'] ) ? htmlentities( addslashes(intval( $_GET['number'])) ): 10;
//$query_key = mysql_real_escape_string( trim($_GET[ 'key_word']) ) ;

$memcache = new Memcache();
$memcache->connect( $cache_server, $cache_port) or die ("could not connect memcache");

$mysql_con = mysql_connect( $mysql_server, $mysql_user, $mysql_pw ) or die ('could not connect mysql');
mysql_select_db( $mysql_db,  $mysql_con ) or die ( "could not select db $mysql_db");
$count_sql = "SELECT COUNT(*) AS count FROM dir_string_tb WHERE file = '".$name ."'";
$result = mysql_query( $count_sql);
$row = mysql_fetch_array( $result );
$total = $row['count'];
$out_data['total'] = $total;
$out_data['offset'] = $offset;
$out_data['number'] = $number;


$query_sql = "SELECT SQL_NO_CACHE id, file, last_update FROM dir_string_tb WHERE file = '".$name."' ORDER BY id LIMIT ".$offset.', '.$number;
//SELECT id, file, last_update FROM dir_string_tb WHERE file = '18' ORDER BY id LIMIT 0, 100

//$query_sql = "SELECT sql_no_cache id, file, last_update FROM dir_string_tb WHERE file = '".$name."' AND id > ".
                "(SELECT id FROM dir_string_tb WHERE file = '".$name."' ORDER BY id LIMIT ".$offset.", 1) ".
                    "ORDER BY id  LIMIT ".$number ;
//SELECT sql_no_cache id, file, last_update FROM dir_string_tb WHERE file = '1' AND id > (SELECT id FROM dir_string_tb WHERE file = '1' ORDER BY id LIMIT 0, 1) ORDER BY id LIMIT 2;


$key  = md5( $query_sql );
$result = $memcache->get( $key );

if( !$result )
{
    $result = mysql_query( $query_sql, $mysql_con);
    if( !$result)
    {
        $end_time = microtime(true);
        $out_data['status']='error';
        $out_data['sql'] = $query_sql;
        $out_data['result'] = 'could not successfully query in db, '.mysql_error();
        $out_data['cost_time'] = round( $end_time -$start_time, 3);
        echo (json_encode( $out_data));
        return null;
    }
    while( $row = mysql_fetch_array( $result,  $result_type = MYSQL_ASSOC) )
    {
        $out_data['data'][]= $row;
    }

    $memcache->add( $key, serialize($out_data['data']), 0, 30); //mysql查询完后，将结果插入memcache。
    $out_data['from'] = 'mysql';
    $end_time = microtime(true);
    $out_data['cost_time'] = round( $end_time -$start_time, 3);
}
else
{
    $out_data['data'] = unserialize( $result);
    $out_data['from'] = 'memecache';
    $end_time = microtime(true);
    $out_data['cost_time'] = round( $end_time -$start_time, 3);
}


$out_data['status']='ok';
$out_data['parameters'] = array( 'name'=>$name, 'offset'=>$offset, 'number'=>$number);
$out_data['sql'] = $query_sql;
$out_data['num'] = count( $out_data['data']);
echo ( json_encode( $out_data) );
?>