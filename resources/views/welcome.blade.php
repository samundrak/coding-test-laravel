<!DOCTYPE html>
<html ng-app="app">
    <head>
        <title>Simple App</title>
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/pace.css">
        <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="bower_components/angular/angular.min.js"></script>
        <script type="text/javascript" src="bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>
        <script type="text/javascript" src="bower_components/underscore/underscore-min.js"></script>
        <script type="text/javascript" src="javascripts/pace.min.js"></script>
        <script type="text/javascript" src="javascripts/toast.min.js"></script>
        <script type="text/javascript" src="javascripts/app.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 alert alert-warning">
                                <button ui-sref="list" class="btn btn-default"> See Lists</button>
                                <button ui-sref="home" class="btn btn-default"> Add Data</button>
                        </div>
                    </div>
                    <div class="row">
                        <ui-view>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
