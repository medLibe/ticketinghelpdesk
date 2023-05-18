@extends('admin.layout')

@section('content')
<div class="right_col" role="main">

    {{-- Title --}}
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{ $title }}</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row" style="display: inline-block;">
            <div class="tile_count">
                <div class="col-md-auto col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-ticket"></i> Active Tickets</span>
                    <div class="count">2500</div>
                </div>
                <div class="col-md-auto col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-sitemap"></i> Departments</span>
                    <div class="count">123.50</div>
                </div>
                <div class="col-md-auto col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-headphones"></i> Helpdesks</span>
                    <div class="count">123.50</div>
                </div>
                <div class="col-md-auto col-sm-4  tile_stats_count">
                    <span class="count_top"><i class="fa fa-users"></i> Teams</span>
                    <div class="count">123.50</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
