<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<title>文库演示</title>
	<base href="<?php echo base_url(); ?>" />
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div id="container">
	<h1>文库演示</h1>
	<h2>服务状态(10s检测一次, 使用 supervisor 监控.)</h2>
	<div style="height:30px;" id="services"></div>
	<h2>所有文件</h2>
	<div id="body">
		<?php if ($msg = $this->session->flashdata('msg')): ?>
		<p class="msg"><?php echo $msg; ?></p>
		<?php endif; ?>
		<p>
			上传格式：doc,docx,xls,xlsx,pdf,ppt,pptx,最大2M.
			<form method="post" action="<?php echo site_url('upload') ?>" enctype="multipart/form-data">
				<input name="file" type="file" />
				<input type="submit" value="上传" />
			</form>
		</p>
		<p>已上传文件列表</p>
		<div id="docs_list"></div>
	</div>
	<p class="footer">
		Built with CodeIgniter, openoffice, swftools, python, python-MySQLdb, PyODConverter, supervisor, httpsqs, jquery, underscore.js, backbone.js, FlexPaper.<br />
		Runs on Kubuntu 12.10 via LAMPStack 5.4.8-0 dev. <br />
		Developed By chekun.<br />
		此系统仅作演示之用.
	</p>
</div>
<script src="js/jquery-1.8.2.min.js"></script>
<script src="js/jquery-ui/jquery-ui.min.js"></script>
<script src="js/underscore-min.js"></script>
<script src="js/backbone-min.js"></script>
<script type="text/template" id="services_template">
  	<ul class="services">
		<li>openoffice服务:<span><%= soffice %></span></li>
		<li>转换队列服务:<span><%= httpsqs %></span></li>
		<li>office转pdf服务:<span><%= office2pdf %></span></li>
		<li>pdf转swf服务:<span><%= pdf2swf %></span></li>
	</ul>
</script>
<script type="text/template" id="doc_list_template">
	<code id="doc_<%= id %>">
		<a target="_blank" href="<?php echo site_url('show'); ?>/<%= id %>"><%= name %></a>
		<span class="status <%= status %>"><%= status %></span>
		<span style="margin-right:100px;"><%= type %></span>
	</code>
</script>
<script>
	(function(){
		Services = Backbone.Model.extend({
			defaults: {
				'id': '',
				'soffice': 'Unknown',
				'httpsqs': 'Unknown',
				'office2pdf': 'Unknown',
				'pdf2swf': 'Unknown'
			},
			urlRoot: '/services'
	    });

	    ServicesView = Backbone.View.extend({
	    	el: $('#services'),
	        initialize: function(){
	        	_.bindAll(this);
	        	this.model.on('change', this.render);
			  	this.model.fetch();
	            (function(view) {
					window.setInterval(function() { view.doRefresh(); }, 10000);
				})(this);
	        },
	        render: function(){
	            var template = _.template( $("#services_template").html(), this.model.toJSON());
	            this.$el.html( template );
	        },
	        doRefresh: function(){
	            this.model.fetch();
	           	this.$el.effect("highlight", {}, 3000);
	        }
	    });
	    new ServicesView({model: new Services()});
	})();

	(function(){
		Doc = Backbone.Model.extend({
	    	urlRoot: '/docs'
	    });

	    Docs =  Backbone.Collection.extend({
		  	model: Doc,
		  	url: '/docs'
		});

		DocsListView = Backbone.View.extend({
	    	el: $('#docs_list'),
	        initialize: function() {
			  _.bindAll(this);
			  this.collection.on('reset', this.render); // bind the reset event to render
			  this.collection.fetch();
			},
	        render: function(){
	        	(function(view) {
	        		var template = $("#doc_list_template").html();
		        	_.each(view.collection.models, function(doc){
		        		var _doc = _.template(template, doc.toJSON());
		            	view.$el.append(_doc);
		            	if (doc.get('status') == 'pending')
		            	{
		            		doc.on('change', view.clearTimer(doc));
		            		doc.timer = window.setInterval(function(){view.doRefresh(doc)}, 2000);
		            	}
		        	});
				})(this);
	        },
	        events: {
		  		'click a': 'doClick'
		  	},
		  	doClick: function(e){
				if ($(e.target).next().text() == 'success')
				{
					return true;
				}
				else
				{
					$(e.target).parent().effect("shake", { times:2 }, 300);
					return false;
				}
		  	},
	        doRefresh: function(doc){
	            doc.fetch();
	        },
	        clearTimer: function(doc){
	        	if (doc.get('status') != 'pending')
	            {
	            	clearInterval(doc.timer);
	            	$('#doc_'+doc.get('id')).children('.status').text(doc.get('status')).effect("highlight", {}, 3000);
	            }
	        }
	    });
		new DocsListView({collection: new Docs()});
	})();
</script>
</body>
</html>