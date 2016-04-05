
//g:全文查找  i:忽略大小写 m:多行查找     re:/\d+/gim 

//是否匹配
function IsMatch(content,re)
{
    //var re = new RegExp(exp, regexOptions);
    return re.test(content);
}

//返回匹配的数组
function Match(content, re)
{
    //var re = new RegExp(exp, regexOptions);
    return content.match(re);
}

//正则替换
function RegExpRegPlace(content,re,replaceValue)
{
    //var re = new RegExp(exp, regexOptions);
    return content.replace(re,replaceValue);
}

//字符串分割,返回数组
function Split(content,re)
{
    //var re = new RegExp(exp, regexOptions);
    return content.split(re);
}