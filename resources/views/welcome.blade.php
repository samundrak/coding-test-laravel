<!DOCTYPE html>
<html ng-app="app">
    <head>
        <title>Simple App</title>
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="bower_components/angular/angular.min.js"></script>
        <script type="text/javascript" src="bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>
        <script type="text/javascript" src="bower_components/vue/dist/vue.min.js"></script>
        <script type="text/javascript" src="bower_components/underscore/underscore-min.js"></script>
        <script type="text/javascript" src="javascripts/toast.min.js"></script>
        <script type="text/javascript" src="javascripts/app.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 alert alert-warning">
                                <button class="btn btn-default"> See Lists</button>
                                <button class="btn btn-default"> Add Data</button>
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
