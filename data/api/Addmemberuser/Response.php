<?php
header("Content-type: text/html; charset=utf-8");
class Response {
    /**
     * 按json方式输出通信数据
     * 
     * @param unknown $status 状态码
     *            
     * @param string $message  提示信息
     *     
	 * @param string $time  操作时间
	       
     * @param array $data 数据
     *            
     * @return string
     */
    public static function json($status,$message = '', $data = array(), $createtime) {
        if (! is_bool ( $status )) {
            return '';
        }
        $result = array (
                'status' => $status,
                'message' => $message,
                'data' => $data,
				'createtime' => $createtime,
        );
        echo json_encode ( $result);
    }
}