/**
 * Created by xuguoliang on 2015/11/22.
 */
$(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        //当前点击的tag
        var curr = e.target;
        //上一个点击的tag
        var prev = e.relatedTarget;
        var li = $(this).parent();
        var index = li.index();
        var tab_content = li.parent().siblings('.tab-content');
        var tab_pane    = tab_content.children('.tab-pane').eq(index);
        var hiftchart_div   = tab_pane.children().find(".own-highchart");
        var highctart = hiftchart_div.highcharts();
        if(highctart != undefined) {
            highctart.destroy();
        }
        //触发一个重绘事件
        hiftchart_div.trigger('refresh.chart');
    });
    var Graphic = function(){

    };

    Graphic.prototype.registerListen = function(){
        $("#adp").on('refresh.chart',function(){
            var t = new Graphic();
            t.refresh_add_player();
        });
        $("#avp").on('refresh.chart',function(){
            var t = new Graphic();
            t.refresh_activate_player();
        });
        $("#rto").on('refresh.chart',function(){
            var t = new Graphic();
            t.refresh_online_player();
        });
        $("#acp").on('refresh.chart',function(){
            var t = new Graphic();
            t.refresh_active_player();
        });
    },
    Graphic.prototype.refresh_add_player = function(){
        $('#adp').highcharts({
            chart : {
                type : 'column'
            },
            title : {
                text : '新增玩家'
            },
            subtitle : {
                text : '最高人数：30990'
            },
            xAxis : {
                categories : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis : {
                title : {
                    text : '人数'
                }
            },
            tooltip : {
                enabled : false,
                formatter : function () {
                    return '<b>' + this.series.name + '</b><br>' + this.x + ': ' + this.y + '°C';
                }
            },
            plotOptions : {
                line : {
                    dataLabels : {
                        enabled : true
                    },
                    enableMouseTracking : false
                }
            },
            series : [{
                name : '新增',
                data : [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name : '激活',
                data : [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
            }
            ]
        });
    },Graphic.prototype.refresh_activate_player=function(){
        $('#avp').highcharts({
            chart : {
                type : 'column'
            },
            title : {
                text : '激活玩家'
            },
            subtitle : {
                text : '最高：80%'
            },
            xAxis : {
                categories : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis : {
                min : 0,
                title : {
                    text : '人数'
                }
            },
            tooltip : {
                headerFormat : '<span style=\"font-size:10px\">{point.key}</span>',
                pointFormat : '' + '',
                footerFormat : '<table><tbody><tr><td style=\"color:{series.color};padding:0\">{series.name}: </td><td style=\"padding:0\"><b>{point.y:.1f} mm</b></td></tr></tbody></table>',
                shared : true,
                useHTML : true
            },
            plotOptions : {
                column : {
                    pointPadding : 0.2,
                    borderWidth : 0
                }
            },
            series : [{
                name : '测试1',
                data : [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
            }, {
                name : '测试2',
                data : [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
            }, {
                name : '测试3',
                data : [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
            }, {
                name : '测试4',
                data : [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
            }
            ]
        });
    },Graphic.prototype.refresh_online_player = function(){
        $('#rto').highcharts({
            chart : {
                type : 'line'
            },
            title : {
                text : '实时在线'
            },
            subtitle : {
                text : '最高人数：30990'
            },
            xAxis : {
                categories : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis : {
                title : {
                    text : '人数'
                }
            },
            tooltip : {
                enabled : false,
                formatter : function () {
                    return '<b>' + this.series.name + '</b><br>' + this.x + ': ' + this.y + '°C';
                }
            },
            plotOptions : {
                line : {
                    dataLabels : {
                        enabled : true
                    },
                    enableMouseTracking : false
                }
            },
            series : [{
                name : '新增',
                data : [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name : '激活',
                data : [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
            }
            ]
        });
    },Graphic.prototype.refresh_active_player = function(){
        $("#acp").highcharts({
            chart : {
                type : 'column'
            },
            title : {
                text : '玩家转化率'
            },
            subtitle : {
                text : '最高：80%'
            },
            xAxis : {
                categories : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis : {
                min : 0,
                title : {
                    text : '人数'
                }
            },
            tooltip : {
                headerFormat : '<span style=\"font-size:10px\">{point.key}</span>',
                pointFormat : '' + '',
                footerFormat : '<table><tbody><tr><td style=\"color:{series.color};padding:0\">{series.name}: </td><td style=\"padding:0\"><b>{point.y:.1f} mm</b></td></tr></tbody></table>',
                shared : true,
                useHTML : true
            },
            plotOptions : {
                column : {
                    pointPadding : 0.2,
                    borderWidth : 0
                }
            },
            series : [{
                name : '测试1',
                data : [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
            }, {
                name : '测试2',
                data : [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
            }, {
                name : '测试3',
                data : [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
            }, {
                name : '测试4',
                data : [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
            }
            ]
        });
    }

    var e = new Graphic();
    e.registerListen();
    var content = $(".own-panel .nav-pills .active").parent().siblings('.tab-content');
    content.each(function(i,item){
        $(item).children().find(".own-highchart").trigger('refresh.chart');
    });
});