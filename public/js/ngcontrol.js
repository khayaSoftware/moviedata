var app = angular.module('myApp', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
app.controller('customersCtrl', function($scope, $http) {

    $http.get("https://api.themoviedb.org/3/genre/movie/list?api_key=7a5254ae6cc2bfff088c47da1358dfb1")
        .then(function (genrs) {
            $scope.genres = genrs.data.genres;
    });

    $http.get("https://api.themoviedb.org/4/list/1?api_key=7a5254ae6cc2bfff088c47da1358dfb1")
        .then(function (response) {

            $scope.genreNameTask = function(movie_id){
                index = $scope.genres.findIndex( genre => genre.id === movie_id );
                return $scope.genres[index].name;
            };

            $scope.movies = response.data.results;

            $scope.movies.forEach(function(movie,index2) {
                movie.genre_ids.forEach(function(element,index1) {
                    $scope.movies[index2].genre_ids[index1] = $scope.genreNameTask(element);
                });
            });
    });

    $scope.moreDetails = function(movie_id){
        $("#"+movie_id).slideDown("slow", function(){
            $(".btn-"+movie_id).slideUp("slow");
        });
    };

    $scope.lessDetails = function(movie_id){
        $("#"+movie_id).slideUp("slow", function(){
            $(".btn-"+movie_id).slideDown("slow");
        });
    };
    
});