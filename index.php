<!DOCTYPE html>
<html>
<head>
    <title>Graphing App</title>
	<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link class="include" rel="stylesheet" type="text/css" href="jquery.jqplot.min.css" />
    <link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shThemejqPlot.min.css" />
	<link type="text/css" rel="stylesheet" media="screen" href="graphapp.css" />
	<!--[if IE]><script src="https://github.com/aFarkas/html5shiv/blob/master/dist/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->
    <script class="include" type="text/javascript" src="jquery.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><span class='white'>Graphing</span><span class='red'>App</span></a>
        </div>
      </div>
    </nav>

    <div class="jumbotron">
      <div class="container">	  
		<div class="row">
		<div class="six columns whiterightbrdr infobox"><h3><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;Technologies used:</h3>
		<p><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;HTML5 & CSS</p>
		<p><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Javascript, jQuery, JSON & jqPlot</p></div>
			
		<div class="six columns infobox fltClearOnMob"><h3><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Data stream</h3>
		<p><a href='#' class="btn btn-success tranbtn"><span class="glyphicon glyphicon-play"></span>&nbsp;&nbsp;Start</a>&nbsp;&nbsp;<a href='#' class="btn btn-danger tranbtn"><span class="glyphicon glyphicon-stop"></span>&nbsp;&nbsp;Stop</a>&nbsp;&nbsp;<a class="btn btn-default infobtn"><i class="glyphicon glyphicon-info-sign"></i></a></p>
		<form name="searchForm" id="searchForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"><input type="file" name="tag" id="uploadbox" placeholder="Upload data" disabled /><button type="submit" class="btn btn-default disabled"><i class="glyphicon glyphicon-open"></i></button></form></div>
		</div>
		
		<div class="row" id="infopanel"><h2>Information</h2><p>1. The graph is not currently linked to an active data source. The values shown are from a local array, and are only for demonstration purposes.</p><p>2. Linking backend data to visualisation is simply a matter of substituting local values for server-generated JSON-encoded values, and decoding them back into a local array.</p><p>3. As the transport controls need to be linked to an active data source to make sense, they have had their functionality removed. Likewise the file upload function, which requires securing and parsing to be useful, has also been disabled.</p><p align='right'><a href='#' class='btn btn-default infobtn'>Close</a></p></div> 
	  
      </div>
    </div>
	
	<div class="container chartcontainer glow">

	<div id="chart1"></div>
	<button value="reset" type="button" onclick="plot1.resetZoom();" class="btn btn-primary fleft rstbtn">Reset Zoom</button>

	  <script type="text/javascript" class="code">
	  $(document).ready(function(){
		$("#infopanel").hide();
		$(".infobtn,.tranbtn").click(function(){ $("#infopanel").toggle(500); });
		
		  // Enable plugins like cursor and highlighter by default.
		  $.jqplot.config.enablePlugins = true;
		  // For these examples, don't show the to image button.
		  $.jqplot._noToImageButton = true;

		goog = [["6/22/2016",425.32],["6/15/2016",420.09],["6/8/2016",424.84],["6/1/2016",444.32],["5/26/2016",417.23],
		["5/18/2016",393.5],["5/11/2016",390],["5/4/2016",407.33],["4/27/2016",393.69],["4/20/2016",389.49],
		["4/13/2016",392.24],["4/6/2016",372.5],["3/30/2016",369.78],["3/23/2016",347.7],["3/16/2016",330.16],
		["3/9/2016",324.42],["3/2/2016",308.57],["2/23/2016",337.99],["2/17/2016",346.45],["2/9/2016",357.68],
		["2/2/2016",371.28],["1/26/2016",338.53],["1/20/2016",324.7],["1/12/2016",299.67],["1/5/2016",315.07],
		["12/29/2015",321.32],["12/22/2015",300.36],["12/15/2015",310.17],["12/8/2015",315.76],["12/1/2015",283.99],
		["11/24/2015",292.96],["11/17/2015",262.43],["11/10/2015",310.02],["11/3/2015",331.14],["10/27/2015",359.36],
		["10/20/2015",339.29],["10/13/2015",372.54],["10/6/2015",332],["9/29/2015",386.91],["9/22/2015",431.04],
		["9/15/2015",449.15],["9/8/2015",437.66],["9/2/2015",444.25],["8/25/2015",463.29],["8/18/2015",490.59], 
		["8/11/2015",510.15], ["8/4/2015",495.01], ["7/28/2015",467.86],["7/21/2015",491.98], ["7/14/2015",481.32],
		["7/7/2015",533.8],["6/30/2015",537], ["6/23/2015",528.07], ["6/16/2015",546.43],["6/9/2015",571.51],["6/2/2015",567],
		["5/27/2015",585.8],["5/19/2015",544.62], ["5/12/2015",580.07],["5/5/2015",573.2],["4/28/2015",581.29],
		["4/21/2015",544.06],["4/14/2015",539.41],["4/7/2015",457.45], ["3/31/2015",471.09],["3/24/2015",438.08],
		["3/17/2015",433.55], ["3/10/2015",437.92], ["3/3/2015",433.35],["2/25/2015",471.18],["2/19/2015",507.8],
		["2/11/2015",529.64],["2/4/2015",516.69],["1/28/2015",515.9], ["1/22/2015",566.4],["1/14/2015",600.25],
		["1/7/2015",638.25],["12/31/2014",657],["12/24/2014",702.53],["12/17/2014",696.69],["12/10/2014",689.96],
		["12/3/2014",714.87], ["11/26/2014",693], ["11/19/2014",676.7],["11/12/2014",633.63],["11/5/2014",663.97],
		["10/29/2014",711.25],["10/22/2014",674.6],["10/15/2014",644.71],["10/8/2014",637.39],["10/1/2014",594.05],
		["9/24/2014",567.27], ["9/17/2014",560.1], ["9/10/2014",528.75], ["9/4/2014",519.35],["8/27/2014",515.25],
		["8/20/2014",515]];

		opts = {
			title: 'Data stream paused',
			grid: {
			drawBorder: false, shadow: true, background: 'rgba(0,0,0,0)'
		},
		highlighter: {
         sizeAdjust: 12,shadowAlpha: 0.1, shadowDepth: 2, fillToZero: true,
         tooltipLocation: 'n',
         tooltipAxes: 'both',
         useAxesFormatters: true
		},
		series: [
			{
				color: 'rgba(198,88,88,1)', negativeColor: 'rgba(100,50,50,.6)', showMarker: true, showLine: true, fill: false, fillAndStroke: true,
				markerOptions: {
					style: 'filledCircle', size: 8
				},
				rendererOptions: {
					smooth: true
				}
			},
			{
				color: 'rgba(44, 190, 160, 1)', showMarker: true,
				rendererOptions: {
					smooth: true,
				},
				markerOptions: {
					style: 'filledSquare', size: 8
				},
			}
		],
			axes: {
				xaxis: {
				  renderer:$.jqplot.DateAxisRenderer, min:'August 19, 2014', tickInterval: "6 months", tickOptions:{formatString:"%Y/%#m/%#d"}
				},
				yaxis: {
					renderer: $.jqplot.LogAxisRenderer,
					tickOptions:{prefix: '&euro;'}
				}
			},
			cursor:{zoom:true, 
			showTooltipOutsideZoom: true, 
			constrainOutsideZoom: true, 
			showTooltip:false,
			followMouse: false}
		};

		plot1 = $.jqplot('chart1', [goog], opts);
		    
        $('#chart1').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
			data2 = data[1];
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: &euro;'+data2+ ', pageX: '+ev.pageX+', pageY: '+ev.pageY);
            }
        );
		});
	  </script>

	<script class="include" type="text/javascript" src="jquery.jqplot.min.js"></script>
	<script class="include" type="text/javascript" src="plugins/jqplot.dateAxisRenderer.min.js"></script>
	<script class="include" type="text/javascript" src="plugins/jqplot.cursor.min.js"></script>
	<script class="include" type="text/javascript" src="plugins/jqplot.highlighter.min.js"></script>
	<script type="text/javascript" src="syntaxhighlighter/scripts/shCore.min.js"></script>
	<script type="text/javascript" src="syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
	<script type="text/javascript" src="syntaxhighlighter/scripts/shBrushXml.min.js"></script>
	
	<div id="info1"></div>
	</div>

	<div id='footer'>&copy;<?php echo date("Y") ?>&nbsp;<a href="http://www.siteworx.ie/">Siteworx.ie</a></div>
</body>
</html>