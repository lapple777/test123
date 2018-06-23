getActionOrder();
function getJsonData(){
    $.ajax({
        url:'/index/Order/getJsonData',
        type:'GET',
        data:{'Symbol':'EURUSD'},
        success:function(data){
            if(data.code == 1){
                initKline(data.msg);
            }

        }
    })
}
getJsonData();

var dom = document.getElementById("container");
var myChart = echarts.init(dom);
var app = {};
var rawData=[],dates=[],datas=[],currentPrice1,currentPrice2;
function initKline(jsonDate){
    option = null;
    rawData = JSON.parse(jsonDate);
    dates= rawData.map(function (item) {
        return item[0];
    });
    datas = rawData.map(function (item) {
        return item[1];
    });
    var datas2 = rawData.map(function (item) {
        return item[2];
    });
    currentPrice1 = formatnumber(datas[parseInt(datas.length)-1],5);
    currentPrice2 = formatnumber(datas2[parseInt(datas2.length)-1],5);
    $('.current_price').text(currentPrice1);
    $('#current_price').val(currentPrice1);
    $('#current_price2').val(currentPrice2);
    option = {
        grid : {
            left:20,
            right:70
        },
        title: {
            text: ''
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                animation: false
            }
        },
        xAxis: {
            type: 'category',
            data: dates,
            splitLine: {
                show: true,//是否显示网格线
                lineStyle: {
                    color: '#8392A5',
                    width: 1,//网格线宽度
                    type: 'dotted'//网格线样式
                },//网格线颜色

            },
            axisLine: { lineStyle: { color: '#8392A5' } }
        },
        yAxis: {
            type: 'value',
            position:'right',
            axisLabel: {
                formatter: function (value, index) {
                    return formatnumber(value,5);
                }
            },
            max: function(value) {
                return value.max + 0.0003;
            },
            min: function(value) {
                return value.min - 0.00005;
            },
            splitLine: {
                show: true,//是否显示网格线
                lineStyle: {
                    color: '#8392A5',
                    width: 1,//网格线宽度
                    type: 'dotted'//网格线样式
                } //网格线颜色

            },

        },
        dataZoom: [{
            type: 'inside',
            start: 50,
            end: 100
        }, {
            start: 0,
            end: 10,
            handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
            handleSize: '80%',
            handleStyle: {
                color: '#fff',
                shadowBlur: 3,
                shadowColor: 'rgba(0, 0, 0, 0.6)',
                shadowOffsetX: 2,
                shadowOffsetY: 2
            }
        }],
        series: [{
            name: '价格',
            type: 'line',
            lineStyle: {

                width: 1,//网格线宽度

            },		//网格线颜色
            showSymbol: false,
            hoverAnimation: false,
            data: datas
        },
            {
                name: '111',
                type: 'line',
                markLine: {
                    name: '111',
                    symbol:['circle','circle'],//标识线两端样式
                    symbolSize:2,//标识线两端样式大小
                    itemStyle : {
                        normal: {
                            color: 'red',//线的颜色
                            lineStyle: {
                                type: 'dotted',//标示线样式
                                width: 1,//线的宽度
                            },
                        }
                    },

                    data: [
                        {
                            name: '111',
                            yAxis:currentPrice1
                        }

                    ]

                }
            },
            {
                name: '222',
                type: 'line',
                markLine: {
                    name: '222',
                    symbol:['circle','circle'],//标识线两端样式
                    symbolSize:2,//标识线两端样式大小
                    itemStyle : {
                        normal: {
                            color: 'blue',//线的颜色
                            lineStyle: {
                                type: 'dotted',//标示线样式
                                width: 1,//线的宽度
                            },
                        }
                    },

                    data: [
                        {
                            name: '222',
                            yAxis: currentPrice2
                        }

                    ]

                }
            }
        ]
    };
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }

}
var da = 0;
var price2 = 0;
function setNewData(date,data1,data2){

    $('.current_price').text(data1);
    $('#current_price').val(data1);
    $('#current_price2').val(data2);
    da = formatnumber(data1,5);

    dates.push(date);
    datas.push(da);

    myChart.setOption({
        xAxis: {
            data: dates,
        },
        series: [{
            data: datas
        },
            {
                name: '111',
                type: 'line',
                markLine: {
                    name: '111',
                    symbol:['circle','circle'],//标识线两端样式
                    symbolSize:2,//标识线两端样式大小
                    itemStyle : {
                        normal: {
                            color: 'red',//线的颜色
                            lineStyle: {
                                type: 'dotted',//标示线样式
                                width: 1,//线的宽度
                            },
                        }
                    },

                    data: [
                        {
                            name: '111',
                            yAxis: da
                        }

                    ]

                }
            },
            {
                name: '222',
                type: 'line',
                markLine: {
                    name: '222',
                    symbol:['circle','circle'],//标识线两端样式
                    symbolSize:2,//标识线两端样式大小
                    itemStyle : {
                        normal: {
                            color: 'blue',//线的颜色
                            lineStyle: {
                                type: 'dotted',//标示线样式
                                width: 1,//线的宽度
                            },
                        }
                    },

                    data: [

                        {
                            name: '222',
                            yAxis: formatnumber(data2,5)
                        },

                    ]

                }
            },]
    });
}
function getKData(name){
    // 连接服务端
    var url ='http://127.0.0.1:2120';//本地环境
    //var url ='http://210.209.85.65:2120';//线上环境
    var socket = io(url);
    // 连接后登录
    socket.on('connect', function(){
        socket.emit('login', name);
        console.log('连接成功');
    });
    // 后端推送来消息时
    socket.on('new_msg', function(msg){

        if(msg){
            var arr = msg.split('|');
            var date = formatDate(arr[0]);
            var params1 = arr[1];
            var params2 = arr[2];
            setNewData(date,params1,params2)
        }


    });

}

//获取在场订单列表
function getActionOrder(){
    $.ajax({
        url:'/index/Order/myOrder',
        type:'POST',
        data:'',
        success:function(data){
            if(data.code == 1){
                var html = '';
                $.each(data.msg,function(a,item){

                    html +='<tr><td>'+item.order_id+'</td>';
                    var type = '';
                    if(item.order_type == 1){
                        type = '<span class="text-danger">做多</span>';
                    }else if(item.order_type == 2){
                        type = '<span class="text-success">做空</span>';
                    }

                    html +='<td>'+type+'</td>';
                    html +='<td>'+formatnumber(item.order_price,5)+'</td>';
                    html +='<td>'+formatnumber(item.stop_profit,5)+'</td>';
                    html +='<td>'+formatnumber(item.stop_loss,5)+'</td>';
                    html +='<td>'+item.lot_num+'</td>';
                    html +='<td>'+formatDate(item.add_time)+'</td>';
                    var status = '';
                    if(item.order_status == 0){
                        status = '<span class="text-danger">未平仓</span>';
                    }else if(item.order_status == 1){
                        status = '<span class="text-success">已平仓</span>';
                    }
                    html +='<td>'+status+'</td></tr>';

                })

                $('#data').append(html);
            }else{
                var nodata = '<tr><td colspan="8">没有数据</td></tr>'
                $('#data').html(nodata);
                return false;
            }
        }
    })
}
//提交订单
function subFrom(from){
    var lot = $('input[name="lot"]').val();
    var current_price = $('input[name="current_price"]').val();
    if(lot == ''){
        layer.msg("<span style='color:white'>请输入手数</span>");
        return false;
    }
    if(current_price == ''){
        layer.msg("<span style='color:white'>当前价格异常</span>");
        return false;
    }
    if(lot < 0.1){
        layer.msg("<span style='color:white'>下单手数至少0.1手</span>");
        return false;
    }
    if(!$('input[name="direction"]').is(':checked')){
        layer.msg("<span style='color:white'>请选择做多或者做空</span>");
        return false;
    }
    $.ajax({
        url:'/index/Order/placeOrder',
        type:'POST',
        data:$('#orderFrom').serialize(),
        beforeSend:function(){
            $('.btn_sub').text('正在提交...');
            $('.btn_sub').attr('disabled','disabled');
        },
        success:function(data){
            $('.btn_sub').text('提交');
            $('.btn_sub').removeAttr('disabled');
            if(data.code == 1){
                //重置表单
                $('button[type="reset"]').click();
                $('#data').html('');
                getActionOrder();
                layer.msg("<span style='color:white'>"+data.msg+"</span>");
                return false;
            }else{
                layer.msg("<span style='color:white'>"+data.msg+"</span>");
                return false;
            }
        },
        error:function(){
            $('.btn_sub').removeAttr('disabled');
            $('.btn_sub').text('提交');
            layer.msg("<span style='color:white'>网络出错，请稍后再试</span>");
            return false;
        }
    })
}
//格式化时间戳
function formatDate(now) {
    var time = new Date(now*1000);
    var y = time.getFullYear();//年
    var m = time.getMonth() + 1;//月
    var d = time.getDate();//日
    var h = time.getHours();//时
    var mm = time.getMinutes();//分
    var s = time.getSeconds();//秒
    if(m < 10){
        m= '0'+m;
    }
    if(d < 10){
        d= '0'+d;
    }
    if(h < 10){
        h= '0'+h;
    }
    if(mm < 10){
        mm= '0'+mm;
    }
    if(s < 10){
        s= '0'+s;
    }
    return y+"-"+m+"-"+d+" "+h+":"+mm+":"+s;
}
function formatnumber(value, num){
    var a, b, c, i;
    a = value.toString();
    b = a.indexOf(".");
    c = a.length;
    if (num == 0) {
        if (b != -1) {
            a = a.substring(0, b);
        }
    } else {//如果没有小数点
        if (b == -1) {
            a = a + ".";
            for (i = 1; i <= num; i++) {
                a = a + "0";
            }
        } else {//有小数点，超出位数自动截取，否则补0
            a = a.substring(0, b + num + 1);
            for (i = c; i <= b + num; i++) {
                a = a + "0";
            }
        }
    }
    return a;
}
//setInterval(function(){
//    $('#data').html('');
//    getActionOrder()
//},2000);
