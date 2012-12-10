<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<title><?php echo $doc->name;  ?> - 文库演示</title>
    <base href="<?php echo base_url(); ?>" />
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/flexpaper.css" />
</head>
<body>
<div id="container">
	<h1>文库演示</h1>
	<div id="body">
		<p><?php echo $doc->name;  ?></p>
		<p style="height:500px;" id="viewer" class="flexpaper_viewer"></p>
	</div>
	<p class="footer">
        Built with CodeIgniter, openoffice, swftools, python, python-MySQLdb, PyODConverter, supervisor, httpsqs, jquery, underscore.js, backbone.js, FlexPaper.<br />
        Runs on Kubuntu 12.10 via LAMPStack 5.4.8-0 dev. <br />
        Developed By chekun.<br />
        此系统仅作演示之用.
    </p>
</div>
<script src="/js/jquery-1.8.2.min.js"></script>
<script src="/js/flexpaper.js"></script>
<script src="/js/flexpaper_handlers.js"></script>
<script type="text/javascript">
    $('#viewer').FlexPaperViewer(
        { config : {
            SWFFile : 'attachments/<?php echo $doc->path; ?>',
            Scale : 0.6,
            ZoomTransition : 'easeOut',
            ZoomTime : 0.5,
            ZoomInterval : 0.2,
            FitPageOnLoad : true,
            FitWidthOnLoad : false,
            FullScreenAsMaxWindow : false,
            ProgressiveLoading : false,
            MinZoomSize : 0.2,
            MaxZoomSize : 5,
            SearchMatchAll : false,
            InitViewMode : 'Portrait',
            RenderingOrder : 'flash,html',
            StartAtPage : '',
            ViewModeToolsVisible : true,
            ZoomToolsVisible : true,
            NavToolsVisible : true,
            CursorToolsVisible : true,
            SearchToolsVisible : true,
            WMode : 'window',
            localeChain: 'en_US'
        }}
    );
</script>
</body>
</html>