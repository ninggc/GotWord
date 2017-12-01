<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 12/1/2017 0001
 * Time: 7:33 PM
 */

require '../util/mysql.php';

$response = array();

/**
 * @param $user_id
 * @return mixed 结果数组
 */
function selectByUserId($user_id) {
    $conn = getConn();

    if (!$conn) {
        die('不能连接Mysql');
    }
    
    $mysqli_result = mysqli_query($conn, "select id, name from word_group where user_id = '$user_id';");

    if ($mysqli_result) {
        $array = array();
        while($row = mysqli_fetch_row($mysqli_result)) {
            $array[] = $row;
        }
        $GLOBALS['response']['length'] = count($array);
        mysqli_close($conn);
        return $array;
    } else {
        $GLOBALS['response']['error'] = mysqli_error($conn);
    }
}

$user_id = $_POST['user_id'];
e_log('user_id: '.$user_id.'<br>');

if ($user_id) {
    $result = selectByUserId($user_id);
    $response['data'] = $result;
}

echo json_encode($response);

?>
