<?php
/**
 * Created by PhpStorm.
 * User: chenxiaolei
 * Date: 2016/4/24
 * Time: 22:49
 */

class Validator
{
    private $_rule = array();
    private $_error;

    public function error()
    {
        return $this->_error;
    }
    public function addRule($str, $rule=array())
    {
        $tmp = array(
            'str' => $str,
            'rule' => $rule
            );
        array_push($this->_rule,$tmp);
    }


    private function action()
    {
        global $flag;
        $flag = true;
        foreach($this->_rule as $items)
        {
            $str = $items['str'];
            foreach ($items['rule'] as $key => $value)
            {
                switch ($key)
                {
                    case 'type':
                        $fun_name = 'is_' . $value;
                        $res = $this->$fun_name($str);
                        if ($res == false)
                        {
                            $this->_error = $value . "don't match";
                            $flag = false;
                        }
                    break;
                    case 'length':
                        if (!$this->length($str,$value['min'],$value['max']))
                        {
                            $this->_error = "length don't match";
                            $flag = false;
                        }
                    break;
                    case 'empty':
                        if ($value = false)
                        {
                            if ($this->isEmpty($str))
                            {
                                $this->_error = "can't be empty";
                                $flag = false;
                            }
                        }
                    break;
                    default:
                        break;
                }

                if ($flag == false)
                {
                    return false;
                    break;
                }
            }
            if ($flag == false)
            {
                return false;
                break;
            }
        }
        return true;
    }


    public function validate()
    {
        if ($this->action())
        {
            $this->_rule = array();
            return true;
        }
        else
        {
            $this->_rule = array();
            return false;
        }
    }
    /**
     * 是否为空值
     * @param :string $str 要验证的字符串
     * @return boolean
     */
    public static function isEmpty($str){
        $str = trim($str);
        return !empty($str) ? true : false;
    }
    /**
     * 验证长度
     * @param: string $str
     * @param: int $min,最小值
     * @param :$max,最大值;
     * @return boolean
     */
    public  function length($str,$min=0,$max=0){
        $len = mb_strlen($str);
        return (($min <= $len) && ($len <= $max)) ? true : false;
    }


    /**
     * 验证日期格式
     * @param :string $date 日期
     * @param :$format 格式
     * @return boolean
    */
    function is_date($date,$format='Y-m-d'){
        $t=date_parse_from_format($format,$date);
        if(empty($t['errors'])){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 验证身份证号码
     * @param :string $card 身份证
     * @return boolean
    */
    function is_card($card){
        if(preg_match('/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$/',$card)||preg_match('/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/',$card))
            return true;
        else
            return false;
    }

    /**
     * 判断是否为图片
     * @param string $file  图片文件路径
     * @return boolean
     */
    function is_image($file){
        if(file_exists($file)&&getimagesize($file===false)){
            return false;
        }else{
            return true;
        }
    }

    /**
     * 是否为英文
     * @param string $str
     * @return boolean
     */
    function is_english($str){
        if(ctype_alpha($str))
            return true;
        else
            return false;
    }
    /**
     * 是否为中文
     * @param string $str
     * @return boolean
     */
    function is_chinese($str){
        if(preg_match('/^[\x{4e00}-\x{9fa5}]+$/u',$str))
            return true;
        else
            return false;
    }

    /**
     * 是否为小数
     * @param float $number
     * @return boolean
     */
    function is_decimal($number){
        if(preg_match('/^[-\+]?\d+(\.\d+)?$/',$number)){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 是否为正小数
     * @param float $number
     * @return boolean
     */
    function is_positive_decimal($number){
        if(preg_match('/^\d+(\.\d+)?$/',$number)){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 是否为整数
     * @param int $number
     * @return boolean
     */
    function is_number($number){
        if(preg_match('/^[-\+]?\d+$/',$number)){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 是否为一个合法的url
     * @param string $url
     * @return boolean
     */
    function is_url($url){
        if (filter_var ($url, FILTER_VALIDATE_URL )) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * 是否为一个合法的ip地址
     * @param string $ip
     * @return boolean
     */
    function is_ip($ip){
        if (ip2long($ip)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 验证字符串是否为数字,字母,中文和下划线构成
     * @param string $username
     * @return bool
     */
    function is_username($username){
        if(preg_match('/^[\x{4e00}-\x{9fa5}\w_]+$/u',$username)){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 验证密码
     * @return boolean
     */
    public static function is_password($value,$minLen=6,$maxLen=16){
        $match='/^[\\~!@#$%^&*()-_=+|{}
,.?\/:;\'\"\d\w]{'.$minLen.','.$maxLen.'}$/';
        $v = trim($value);
        if(empty($v))
            return false;
        return preg_match($match,$v);
    }
    /**
     * 是否为一个合法的email
     * @param sting $email
     * @return boolean
     */
    function is_email($email){
        if (filter_var ($email, FILTER_VALIDATE_EMAIL )) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * 是否是手机号码
     *
     * @param string $phone 手机号码
     * @return boolean
     */
    function is_phone($phone) {
        if (strlen ( $phone ) != 11 || ! preg_match ( '/^1[3|4|5|8][0-9]\d{4,8}$/', $phone )) {
            return false;
        } else {
            return true;
        }
    }
}