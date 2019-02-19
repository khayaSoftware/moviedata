@extends('layouts.app')

@section('content')
<div class="container" ng-app="myApp" ng-controller="customersCtrl">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <input class="form-control" placeholder="Search.." ng-model="search.original_title"/>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <select class="form-control" ng-model="search.name" ng-options="genre.name for genre in genres">
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card" style="margin-top:10px;">
                <div class="card-body">
                    <table>
                        <tbody ng-repeat="movie in movies | filter:search">
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img ng-src="http://image.tmdb.org/t/p/w92/<%movie.poster_path%>" class="img img-responsive"/>
                                        </div>
                                        <div class="col-sm-8">
                                            <h4><b><%movie.original_title%></b></h4>
                                            <h5>Released: <%movie.release_date%></h5>
                                            <p><%movie.vote_average%>/10</p><br/>
                                            <div ng-click="lessDetails(movie.id)" style="display: none;" class="well" id="<%movie.id%>">
                                                <p class="lead"><%movie.overview%></p>
                                            </div>
                                            <br/>
                                                <a ng-click="moreDetails(movie.id)" class="caret">more</a>
                                            <br/>
                                            <span ng-repeat="x in movie.genre_ids">
                                                <%genreNameTask(x)%>
                                            <span/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <hr/>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

<script>
    var app = angular.module('myApp', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    app.controller('customersCtrl', function($scope, $http) {

        $http.get("https://api.themoviedb.org/4/list/1?api_key=7a5254ae6cc2bfff088c47da1358dfb1")
            .then(function (response) {
                $scope.movies = response.data.results;
        });

        $http.get("https://api.themoviedb.org/3/genre/movie/list?api_key=7a5254ae6cc2bfff088c47da1358dfb1")
            .then(function (response) {
                $scope.genres = response.data.genres;
        });

        $scope.genreNameTask = function(movie_id){
            index = $scope.genres.findIndex( genre => genre.id === movie_id );
            return $scope.genres[index].name;
        };

        $scope.moreDetails = function(movie_id){
            $("#"+movie_id).slideDown("slow");
        };

        $scope.lessDetails = function(movie_id){
            $("#"+movie_id).slideUp("slow");
        };
        
    });
</script>

@endsection
