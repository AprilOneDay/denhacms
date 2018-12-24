<?php
/**
 * 匹配相关信息
 */
namespace dao\base;

class Regular
{

    /** 检测身份证 */
    public function isIDCard($vStr)
    {
        $vCity = array(
            '11', '12', '13', '14', '15', '21', '22',
            '23', '31', '32', '33', '34', '35', '36',
            '37', '41', '42', '43', '44', '45', '46',
            '50', '51', '52', '53', '54', '61', '62',
            '63', '64', '65', '71', '81', '82', '91',
        );
        if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) {
            return false;
        }

        if (!in_array(substr($vStr, 0, 2), $vCity)) {
            return false;
        }

        $vStr    = preg_replace('/[xX]$/i', 'a', $vStr);
        $vLength = strlen($vStr);
        if ($vLength == 18) {
            $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
        } else {
            $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
        }
        if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) {
            return false;
        }

        if ($vLength == 18) {
            $vSum = 0;
            for ($i = 17; $i >= 0; $i--) {
                $vSubStr = substr($vStr, 17 - $i, 1);
                $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr, 11));
            }
            if ($vSum % 11 != 1) {
                return false;
            }

        }

        return true;
    }

    /** 检测邮箱 */
    public function isMail($val)
    {
        if (preg_match("/^[a-z0-9]+([._-][a-z0-9]+)*@([0-9a-z]+\.[a-z]{2,14}(\.[a-z]{2})?)$/i", $val)) {
            return true;
        } else {
            return false;
        }
    }

    /** 检测是否是手机号 */
    public function isMobile($val)
    {

        if (preg_match("/^1[345789]{1}\d{9}$/", $val)) {
            return true;
        } else {
            return false;
        }
    }
}
