<?php
/**
 * 求跨越中点的最大子数组
 * @param array $arr 原数组
 * @param int $low 最低点下标
 * @param int $mid 中点下标
 * @param int $high 最高点下标
 * @return array
 */
function find_max_crossing_subarray($arr, $low, $mid, $high){
    //求左半部分最大子数组，已知子数组会跨越中点
    $left_sum = $arr[$mid];
    $max_left  = $mid;
    $sum = 0;
    for($i = $mid;$i >= $low;--$i){
        $sum += $arr[$i];
        if($sum > $left_sum){
            $left_sum = $sum;
            $max_left = $i;
        }
    }
    //同理求右半部分
    $right_sum = $arr[$mid+1];
    $max_right  = $mid+1;
    $sum = 0;
    for($i = $mid+1;$i <=$high;++$i){
        $sum += $arr[$i];
        if($sum > $right_sum){
            $right_sum = $sum;
            $max_right = $i;
        }
    }
    return ['low' => $max_left, 'high' => $max_right, 'sum' => $left_sum + $right_sum];
}

/**
 * 求数组的最大子数组（分治法）
 * @param array $arr 原数组
 * @param int $low 最低点下标
 * @param int $high 最高点下标
 * @return array
 */
function find_maximum_subarray($arr, $low, $high){
    if($high == $low){
        return ['low' => $low, 'high' => $high, 'sum' => $arr[$low]];
    }else{
        $mid = intval(($low + $high) / 2);
        $left = find_maximum_subarray($arr, $low, $mid);
        $right = find_maximum_subarray($arr, $mid + 1, $high);
        $cross = find_max_crossing_subarray($arr, $low, $mid, $high);
        if($left['sum'] >= $right['sum'] && $left['sum'] >= $cross['sum']){ //最大数组在左半边
            return ['low' => $left['low'], 'high' => $left['high'], 'sum' => $left['sum']];
        }else if($right['sum'] >= $left['sum'] && $right['sum'] >= $cross['sum']){ //最大数组在右半边
            return ['low' => $right['low'], 'high' => $right['high'], 'sum' => $right['sum']];
        }else{ //最大数组跨越中点
            return ['low' => $cross['low'], 'high' => $cross['high'], 'sum' => $cross['sum']];
        }
    }
}

$arr = [13,-3,-25,20,-3,-16,-23,18,20,-7,12,-5,-22,15,-4,7];
print_r(find_maximum_subarray($arr, 0, 15));


/**
 * 求数组的最大子数组（暴力求解）
 * @param $arr
 * @return array
 */
function force_find_maximum_subarray($arr){
    $max = $arr[0];
    $low = 0;
    $high = 0;
    for($i = 0;$i < count($arr);++$i){
        $sum = 0;
        for($j = $i;$j < count($arr);++$j){
            $sum += $arr[$j];
            if($sum > $max){
                $max = $sum;
                $low = $i;
                $high = $j;
            }
        }
    }
    return ['low' => $low, 'high' => $high, 'sum' => $max];
}

print_r(force_find_maximum_subarray($arr));


/**
 * 求数组的最大子数组（线性求解）
 * @param $arr
 * @return array
 */
function linear_find_maximum_subarray($arr){
    $max = $arr[0];
    $low = 0;
    $high = 0;
    $temp = $arr[0];
    $temp_left = 0;
    for($i = 1;$i < count($arr);++$i){
        $temp += $arr[$i];
        if($temp > $max){
            $max = $temp;
            $low = $temp_left;
            $high = $i;
        }
        //如果原本temp > 0 加上$arr[$i]后 temp < 0 说明这是子数组的边界， $i + 1开始为新的子数组
        if($temp < 0){
            $temp = 0;
            //先用一个变量记录记录新子数组的最小下标
            $temp_left = $i + 1;
        }
    }
    return ['low' => $low, 'high' => $high, 'sum' => $max];
}

print_r(linear_find_maximum_subarray($arr));