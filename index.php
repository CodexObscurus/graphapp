<?php include "funnel.php"; include "funnel2.php"; ?>
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
<body><div class="pageBG"></div>

    <div class="container">
        <div class="row">
            <nav class="navbar" role="navigation">
                <div class="container">
                <div class="navbar-header">
                  <a class="navbar-brand" href="#"><span class='white'>Graphing</span><span class='red'>App</span></a>
                </div>&nbsp;&nbsp;<a class="btn btn-default infobtn"><i class="glyphicon glyphicon-info-sign"></i></a>
                </div>
            </nav>
        </div>
    </div>

    <div class="container datapanel">
      <div class="jumbotron rounded glow">
        <div class="row">
            <h4>Choose data source/channel...</h4>
            <a href='#' class="btn btn-success tranbtn startbtn"><span class="glyphicon glyphicon-play"></span>&nbsp;&nbsp;Start</a>&nbsp;&nbsp;<a href='#' class="btn btn-danger tranbtn stopbtn"><span class="glyphicon glyphicon-stop"></span>&nbsp;&nbsp;Stop</a>

            <form name="searchForm" id="searchForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"><input type="file" name="tag" id="uploadbox" placeholder="Upload data" disabled /><button type="submit" class="btn btn-default disabled"><i class="glyphicon glyphicon-open"></i></button></form>
        </div><!-- /.row -->

        <div class="row" id="infopanel">
            <div class="infobox">
                <h3><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;Technologies used:</h3>
                <p><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Javascript, jQuery, JSON & jqPlot</p>
                <p><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;HTML5 & CSS</p>
                <h2>Information</h2><p>1. The graph is not currently linked to an active data source. The values shown are from a local array, and are only for demonstration purposes.</p><p>2. Linking backend data to visualisation is simply a matter of substituting local values for server-generated JSON-encoded values, and decoding them back into a local array.</p><p>3. As the transport controls need to be linked to an active data source to make sense, they have had their functionality removed. Likewise the file upload function, which requires securing and parsing to be useful, has also been disabled.</p><p align='right'><a href='#' class='btn btn-default infobtn'>Close</a></p>
            </div>
        </div>
      </div><!-- /.jumbotron -->

        <div class="chartcontainer glow">
            <div class="row">
                <div id="info1">Select a point for details</div>
                <div id="chart1"></div>
                <button value="reset" type="button" onclick="plot1.resetZoom();" class="btn btn-primary rstbtn">Reset Zoom</button>
           </div>
            <div id='footer' class='roundedWhite'>&copy; <?php echo date("Y") ?>&nbsp;<a href="http://www.siteworx.ie/">Siteworx.ie</a></div>
        </div>
    </div>

	<script type="text/javascript" class="code">
	  $(document).ready(function(){
		$("#infopanel").hide();
		$(".infobtn,.tranbtn").click(function(){ $("#infopanel").toggle(500); });

		  // Enable plugins like cursor and highlighter by default.
		  $.jqplot.config.enablePlugins = true;
		  // For these examples, don't show the to image button.
		  $.jqplot._noToImageButton = true;

		goog = <?php echo $ret; ?>;
		goog2 = <?php echo $ret2; ?>;

		opts = {
		  title: '',
		  grid: { drawBorder: false, shadow: true, background: 'rgba(0,0,0,0)' },
		  highlighter: {
            sizeAdjust: 12,shadowAlpha: 0.1, shadowDepth: 2, fillToZero: true,
            tooltipLocation: 'n', tooltipAxes: 'both', useAxesFormatters: true },
		  series: [{
				color: 'rgba(198,88,88,1)', negativeColor: 'rgba(100,50,50,.6)', showMarker: true, showLine: true, fill: false, fillAndStroke: true,
				markerOptions: { style: 'filledCircle', size: 8 },
				rendererOptions: { smooth: true }
			},{
				color: 'rgba(92,184,92,1)', showMarker: true,
				rendererOptions: { smooth: true, },
				markerOptions: { style: 'filledSquare', size: 8 },
			}],
			axes: {
				xaxis: {
				  renderer:$.jqplot.DateAxisRenderer, min:'August 19, 2014', tickInterval: "6 months", tickOptions:{formatString:"%Y/%#m/%#d"}
				},
				yaxis: {
					renderer: $.jqplot.LogAxisRenderer,
					tickOptions:{ prefix: '&pound;' }
				}
			},
			cursor:{zoom:true, 
			showTooltipOutsideZoom: true, 
			constrainOutsideZoom: true, 
			showTooltip:false,
			followMouse: false }
		};

		plot1 = $.jqplot('chart1', [goog,goog2], opts);
		    
        $('#chart1').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
			data2 = data[1];
                $('#info1').slideUp(250,function(){$(this).html('series: '+seriesIndex+', point: '+pointIndex+', data: &pound;'+data2+ ', pageX: '+ev.pageX+', pageY: '+ev.pageY);}).slideDown(250);
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
</body>
</html>