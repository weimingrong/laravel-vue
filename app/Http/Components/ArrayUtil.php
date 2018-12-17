<?php
namespace App\Http\Components;


class ArrayUtil {

    /**
     * 二级数组转成map {key=>obj, ...}
     * @param $arr
     * @param $key
     * @param @type
     * @return array
     */
    public static function array2map($arr, $key, $type) {
        $ret = array();
        if ($arr) {
            foreach ($arr as $item) {
                $valueOfKey = $item[$key];
                if ($type === 'int') {
                    $valueOfKey = (int)$valueOfKey;
                }
                $ret[$valueOfKey] = $item;
            }
        }

        return $ret;
    }

    /**
     * 二级数组转成mapList {key => [obj, obj,...], ....}
     * @param $arr
     * @param $key
     * @param @type
     * @return array
     */
    public static function array2mapList($arr, $key, $type) {
        $ret = array();
        if ($arr) {
            foreach ($arr as $item) {
                $valueOfKey = $item[$key];
                if ($type === 'int') {
                    $valueOfKey = (int)$valueOfKey;
                }
                if (!isset($ret[$valueOfKey])) {
                    $ret[$valueOfKey] = array();
                }
                $list = & $ret[$valueOfKey];
                $list[] = $item;
                unset($list);
            }
        }

        return $ret;
    }

    /**
     * 二级数组转成mapList2 {key => [obj, obj,...], ....}
     * @param $arr
     * @param $key
     * @param $custom
     * @param @type
     * @return array
     */
    public static function array2mapListCustom($arr, $key, $custom, $type) {
        $ret = array();
        if ($arr) {
            foreach ($arr as $item) {
                $valueOfKey = $item[$key];
                if ($type === 'int') {
                    $valueOfKey = (int)$valueOfKey;
                }
                if (!isset($ret[$valueOfKey])) {
                    $ret[$valueOfKey] = array();
                }
                foreach ($custom as $k) {
                    $ret[$valueOfKey][] = $item[$k];
                }
            }
        }
        return $ret;
    }

    /**
     * See PHP5.5 array_column
     *
     * Returns the values from a single column of the input array, identified by
     * the $column_key.
     *
     * Optionally, you may provide an $index_key to index the values in the returned
     * array by the values from the $index_key column in the input array.
     *
     * @param array $input A multi-dimensional array (record set) from which to pull
     *                     a column of values.
     * @param mixed $column_key The column of values to return. This value may be the
     *                         integer key of the column you wish to retrieve, or it
     *                         may be the string key name for an associative array.
     * @param mixed $index_key (Optional.) The column to use as the index/keys for
     *                        the returned array. This value may be the integer key
     *                        of the column, or it may be the string key name.
     * @return array
     */
    public static function column($input, $column_key, $index_key = null) {
        if (!function_exists('array_column')) {


            // Using func_get_args() in order to check for proper number of
            // parameters and trigger errors exactly as the built-in array_column()
            // does in PHP 5.5.
            $argc = func_num_args();
            $params = func_get_args();

            if ($argc < 2) {
                trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
                return null;
            }

            if (!is_array($params[0])) {
                trigger_error('array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given', E_USER_WARNING);
                return null;
            }

            if (!is_int($params[1])
                && !is_float($params[1])
                && !is_string($params[1])
                && $params[1] !== null
                && !(is_object($params[1]) && method_exists($params[1], '__toString'))
            ) {
                trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
                return false;
            }

            if (isset($params[2])
                && !is_int($params[2])
                && !is_float($params[2])
                && !is_string($params[2])
                && !(is_object($params[2]) && method_exists($params[2], '__toString'))
            ) {
                trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
                return false;
            }

            $paramsInput = $params[0];
            $paramsColumnKey = ($params[1] !== null) ? (string)$params[1] : null;

            $paramsIndexKey = null;
            if (isset($params[2])) {
                if (is_float($params[2]) || is_int($params[2])) {
                    $paramsIndexKey = (int)$params[2];
                } else {
                    $paramsIndexKey = (string)$params[2];
                }
            }

            $resultArray = array();

            foreach ($paramsInput as $row) {

                $key = $value = null;
                $keySet = $valueSet = false;

                if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                    $keySet = true;
                    $key = (string)$row[$paramsIndexKey];
                }

                if ($paramsColumnKey === null) {
                    $valueSet = true;
                    $value = $row;
                } elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                    $valueSet = true;
                    $value = $row[$paramsColumnKey];
                }

                if ($valueSet) {
                    if ($keySet) {
                        $resultArray[$key] = $value;
                    } else {
                        $resultArray[] = $value;
                    }
                }

            }

            return $resultArray;
        } else {
            return array_column($input, $column_key, $index_key);
        }
    }

    /**
     * 获取KEY
     * @param $array
     * @param mixed $default
     * @param $key1
     * @return mixed|null
     */
    public static function get($array, $default, $key1) {

        $argc = func_num_args();
        $params = func_get_args();

        $i = 2;
        for (; $i < $argc; $i++) {
            if (isset($array[$params[$i]])) {
                $value = $array = $array[$params[$i]];
            } else {
                $value = null;
                break;
            }
        }
        // if you need default value
        if (isset($default[0]) && is_null($value)) {
            $value = $default[0];
        }

        // if you have default function to change the value, like:
        // $value = intval($value);
        if (isset($default[1]) && !is_null($default[1])) {
            $value = call_user_func($default[1], $value);
        }

        return $value;
    }

    /**
     * @param $array
     * @param $old_keys
     * @param $new_keys
     * @param bool $clear_other
     * @return mixd
     */
    public static function renameKey($array, $old_keys, $new_keys, $clear_other = false) {
        if (!is_array($array)) {
            ($array == "") ? $array = array() : false;
            return $array;
        }
        $ret = [];
        if (!$clear_other) {
            $ret = $array;
        }
        foreach ($array as $key => $arr) {
            if (is_array($old_keys)) {
                foreach ($new_keys as $k => $new_key) {
                    (isset($old_keys[$k])) ? true : $old_keys[$k] = NULL;
                    $ret[$key][$new_key] = (isset($arr[$old_keys[$k]]) ? $arr[$old_keys[$k]] : null);
                    unset($ret[$key][$old_keys[$k]]);
                }
            } else {
                $ret[$key][$new_keys] = (isset($arr[$old_keys]) ? $arr[$old_keys] : null);
                unset($ret[$key][$old_keys]);
            }
        }
        return $ret;
    }


    /**
     * 处理从数据库的数据转换到输出
     *
     * @param array $input
     * @param array $rules array('key'=>array('field', 'var handle', 'default var'))
     * @return array
     */
    public static function format($input, $rules)
    {
        $output = array();

        foreach ($rules as $key=>$rule) {
            if (is_array($rule)) {
                $dv = null;
                if (count($rule) == 3) {
                    list($field, $vh, $dv) = $rule;
                } elseif (count($rule) == 2) {
                    list($field, $vh) = $rule;
                }
            } else {
                $field = $rule;
                $vh = 'strval';
                $dv = null;
            }
            $output[$key] = self::get($input, array($dv, $vh), $field);
        }

        return $output;
    }

    /**
     * @param array $arr
     * @param array $keys
     * @return false | string
     */
    public static function checkEmpty($arr, $keys)
    {
        foreach ($keys as $key) {
            $val = array_key_exists($key, $arr) ? $arr[$key] : null;
            if (!strlen($val) && empty($val)) {
                return $key;
            }
        }
        return false;
    }

    public static function multisearch($data, $search, $mode=1){
	    if(empty($data))
		    return array();

	    $tmp = array();
	    foreach($data as $key=>$row){
		    foreach($search as $field=>$val){
			    if(!empty($val)){
				    if(is_string($val)){
					    if($mode == 1){
						    if(strripos($row[$field], $val) === false){
							    continue 2;
						    }
					    } elseif($mode == 2){
						    if(strpos($row[$field], $val) === false){
							    continue 2;
						    }
					    } else {
						    if($row[$field] != $val){
							    continue 2;
						    }
					    }
				    } else if(is_float($val)){
					    if( (float)$row[$field]  != $val){
						    continue 2;
					    }
				    } else if(is_int($val)){
					    if( (int)$row[$field]  != $val){
						    continue 2;
					    }
				    }
			    }
		    }
		    $tmp[$key] = $row;
	    }
	    return $tmp;
    }

    public static function merge($array1, $array2){
    	$ret = $array1;
    	foreach($array2 as $k=>$v){
    		if(array_key_exists($k, $ret)){
    			foreach($v as $a=>$b){
    				$ret[$k][$a] = $b;
			    }
		    }
	    }
	    return $ret;
    }

    public static function rip($arr, $prefix){
    	if(isset($arr[0]) && is_array($arr[0])){  // rows
		    $ret = [];
    		foreach($arr as $_){
    			$ret[] = self::rip($_, $prefix);
		    }
	    } else {    // one row
    	    $ret = [];
    	    foreach($arr as $field => $v){
    	    	$p = '/^('.$prefix.')(.*)$/';
    	    	//$f = str_replace($prefix, '', $field);
		        $r = '$2';
		        $f = preg_replace($p,$r, $field);
    	    	$ret[$f] = $v;
	        }
	    }
	    return $ret;
    }

	/**
	 * @param $arr
	 * @param $format
	 * @return array
	 */
    public static function crop($arr, $format){
    	/* $ooo = [
    		'field' => ['newField', 'callback', 'default value' ],
	    ]; */
	    if(isset($arr[0]) && is_array($arr[0])){  // rows
		    $ret = [];
		    foreach($arr as $_){
			    $ret[] = self::crop($_, $format);
		    }
	    } else {    // one row
		    $ret = [];
		    foreach($format as $f=> $b){
		    	if(array_key_exists($f, $arr)){
		    		$v = $arr[$f];
		    		if(isset($b[1]) && $b[1]!=null && is_callable($b[1])){
		    			$v = $b[1]($v);
				    }
			    } else {
		    		$v = isset($b[2]) ? $b[2] : null;
			    }
			    if(isset($b[0])){
				    $ret[$b[0]] = $v;
			    } else {
				    $ret[$f] = $v;
			    }
		    }
	    }
	    return $ret;
    }

    public static function random($arr){
    	if(count($arr)==0){
    		return null;
	    }

	    return $arr[array_rand($arr)];
    }
}
