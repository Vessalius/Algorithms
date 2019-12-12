# 三次乘法完成复数相乘

```php
/**
 * 三次乘法完成复数相乘
 * @param float $a 第一个复数的实部
 * @param float $b 第一个复数的虚部
 * @param float $c 第二个复数的实部
 * @param float $d 第二个复数的虚部
 * @return array
 */
function complex_multiply($a, $b, $c, $d){
    $arr = [];
    $A = $a * $d; //第一次乘法
    $B = $b * $c; //第二次乘法
    $C = ($a + $b) * ($c - $d); //第三次乘法 展开式：ac-ad+bc-bd =>ac-A+B-bd
    //实部
    $arr[] = $C + $A - $B;
    //虚部
    $arr[] = $A + $B;
    return $arr;
}

//两个虚数  1+2i  3-4i
print_r(complex_multiply(1, 2, 3, -4));
```