/**
 * Created by sdqhw on 2018/2/8.
 */

// 验证邮箱
function check_email(str){
    var reg= /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
    return reg.test(str) == true ;
}
var str1 = 'sdqhwzb@163.com';
check_email(str1); // 结果为true


// 验证用户名（验证规则：字母、数字、下划线组成，字母开头，4-16位）
function check_nickname(str){
    var reg= /^[a-zA-z]\w{3,15}$/;
    return res = reg.test(str) == true ;
}
var str2 = '_airvip';
check_nickname(str2); // 结果为true


// 验证手机号
function check_telephone(str){
    var reg= /^((\+86)|(86))?1[3578]\d{9}$/;
    return reg.test(str) == true ;
}
var str3 = '13891052193';
check_telephone(str3); // 结果为true


// 验证网址
function check_url(str){
    var reg= /((https?|ftp|mms):\/\/)?([A-z0-9]+[_\-]?[A-z0-9]+\.)*[A-z0-9]+\-?[A-z0-9]+\.[A-z]{2,}(\/.*)*\/?/;
    return reg.test(str) == true ;
}
var str4 = 'http://www.dear521.com';
check_url(str4); // 结果为true


// 验证整数与浮点数
function check_number(str){
    var reg= /^[+-]?([0-9]*\.?[0-9]+|[0-9]+\.?[0-9]*)([eE][+-]?[0-9]+)?$/;
    return  reg.test(str) == true ;
}
var str5 = 6666.6666;
check_number(str5);// 结果为true


// 验证整数
function check_int(str){
    var reg= /^[-+]?\d*$/;
    return  reg.test(str) == true ;
}
var str6 = 123;
check_int(str6); // 结果为true


// 验证汉字（只能输入汉字）
function check_ch(str){
    var reg= /^[\u0391-\uFFE5]+$/;
    return  reg.test(str) == true ;
}
var str7 = "你好";
check_ch(str7); // 结果为true


// 验证IP
function check_ip(str){
    var reg= /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])(\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])){3}$/;
    return  reg.test(str) == true ;
}
var str8 = "127.0.0.1";
check_ip(str8); // 结果为true


// 验证日期
function check_date(str){
    var reg=  /^\d{4}\/(0?[1-9]|1[0-2])\/(0?[1-9]|[1-2]\d|3[0-1])$/;
    return  reg.test(str) == true ;
}
var str9 = "2015/02/01";
check_date(str9); // 结果为true


// 验证时间
function check_time(str){
    var reg=  /^([0-2][0-9]):([0-5][0-9]):([0-5][0-9])$/;
    return  reg.test(str) == true ;
}
var str10 = "23:23:00";
check_time(str10); // 结果为true

