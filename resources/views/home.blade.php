@extends('layouts.app')

@section('content')
<div class="container" ng-app="myApp" ng-controller="customersCtrl">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <input class="form-control" placeholder="Search title.." ng-model="search.title"/>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <input class="form-control" placeholder="Search genre.." ng-model="search.genre_ids"/>
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
                                        <div class="col-sm-6">
                                            <h4><b><%movie.original_title%></b></h4>
                                            <h5>Released: <%movie.release_date%></h5>
                                            <p><%movie.vote_average%>/10</p><br/>
                                            <div ng-click="lessDetails(movie.id)" style="display: none;" class="well" id="<%movie.id%>">
                                                <p class="lead"><%movie.overview%></p>
                                            </div>
                                            <button class="btn btn-<%movie.id%>" ng-click="moreDetails(movie.id)">+</button>
                                        </div>
                                        <div class="col-sm-3">
                                            <blockquote ng-repeat="genre in movie.genre_ids">
                                                <%genre%><br/>
                                            <blockquote/>
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

@endsection
