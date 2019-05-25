<?php
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
     **/
	 //模拟joson中文不转义
if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
    function json_encode_ex($var) {
        return json_encode($var, JSON_UNESCAPED_UNICODE);
    }
} else {
    function json_encode_ex($var) {
        if ($var === null)
            return 'null';

        if ($var === true)
            return 'true';

        if ($var === false)
            return 'false';

        static $reps = array(
            array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"', ),
            array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"', ),
        );

        if (is_scalar($var))
            return '"' . str_replace($reps[0], $reps[1], (string) $var) . '"';

        if (!is_array($var))
            throw new Exception('JSON encoder error!');

        $isMap = false;
        $i = 0;
        foreach (array_keys($var) as $k) {
            if (!is_int($k) || $i++ != $k) {
                $isMap = true;
                break;
            }
        }

        $s = array();

        if ($isMap) {
            foreach ($var as $k => $v)
                $s[] = '"' . $k . '":' . call_user_func(__FUNCTION__, $v);

            return '{' . implode(',', $s) . '}';
        } else {
            foreach ($var as $v)
                $s[] = call_user_func(__FUNCTION__, $v);

            return '[' . implode(',', $s) . ']';
        }
    }
}
	 
	class Response { 
    public static function json($status,$message = '', $data = array(), $version) {
		
        if (! is_bool ( $status )) {
            return '';
        }
		
        $result = array (
                'status' => $status,
                'message' => $message,
                'data' => $data,
				'Version' => $version,
        );
       echo json_encode ( $result,JSON_UNESCAPED_UNICODE);
    }
}
?>