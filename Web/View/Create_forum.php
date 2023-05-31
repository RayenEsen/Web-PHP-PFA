<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>Create Forum</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=1h5UBRFkFXIaQX3Rg3uxC3GsUosB6cMB1_GKv3VhLkzDmj_8ea9BiXnZ5UDzgV76xqlIGgrRz_U9Nh6ITeTJ9llqcDhsK4R6b279tMvhGZ0" charset="UTF-8"></script><style type="text/css">
    	@import url('http://fonts.googleapis.com/css?family=Open+Sans:200,300');
body {
    background: #eee;
  	font-family: 'Open Sans',Arial,Helvetica,Sans-Serif;
}

.modal-header-info {
    color:#fff;
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color: #5bc0de;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
}


    </style>
</head>
<body>

<div class="modal show" id="modalCompose">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header modal-header-info">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title"><span class="glyphicon glyphicon-envelope"></span> Compose Forum</h4>
</div>
<div class="modal-body">
<form role="form" class="form-horizontal" action="../Controller/UserController.php" method="POST">
    <div class="form-group">
        <label class="col-sm-2" for="inputTo"><span class="glyphicon glyphicon-user"></span> Title</label>
        <div class="col-sm-10"><input type="text" class="form-control" id="inputTo" name="title" placeholder="comma separated list of recipients"></div>
    </div>
    <div class="form-group">
        <label class="col-sm-2" for="inputSubject"><span class="glyphicon glyphicon-list-alt"></span> Tags</label>
        <div class="col-sm-10"><input type="text" class="form-control" id="inputSubject" name="tags" placeholder="subject"></div>
    </div>
    <!-- Hidden input field for category -->
    <input type="hidden" name="category" value="<?php echo $_GET['categorie']; ?>">
    <div class="modal-footer">
        <a href="../View/Forum.php">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
        </a>
        <button type="button" class="btn btn-warning pull-left">Save Draft</button>
        <button type="submit" class="btn btn-primary" name="create_forum">Send <i class="fa fa-arrow-circle-right fa-lg"></i></button>
    </div>
</form>

</div>

</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>