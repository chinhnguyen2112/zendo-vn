var BaseUIWidgets=function(){var initWidgetsSparkline=function(){var $lineOptions={type:'line',width:'100%',height:'120px',tooltipOffsetX:-25,tooltipOffsetY:20,lineColor:'#abe37d',fillColor:'#abe37d',spotColor:'#777777',minSpotColor:'#777777',maxSpotColor:'#777777',highlightSpotColor:'#777777',highlightLineColor:'#777777',spotRadius:2,tooltipPrefix:'',tooltipSuffix:' người dùng',tooltipFormat:'{{prefix}}{{y}}{{suffix}}'};jQuery('.js-widget-line1').sparkline('html',$lineOptions);$lineOptions['lineColor']='#fadb7d';$lineOptions['fillColor']='#fadb7d';$lineOptions['tooltipPrefix']='';$lineOptions['tooltipSuffix']=' lượt mua';jQuery('.js-widget-line2').sparkline('html',$lineOptions);$lineOptions['lineColor']='#faad7d';$lineOptions['fillColor']='#faad7d';$lineOptions['tooltipPrefix']=' ';$lineOptions['tooltipSuffix']='vnđ';jQuery('.js-widget-line3').sparkline('html',$lineOptions);};return{init:function(){initWidgetsSparkline();}};}();jQuery(function(){BaseUIWidgets.init();});