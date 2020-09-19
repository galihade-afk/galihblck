@extends('layouts.admin')
@section('content')
<section class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-capitalize">Welcome {{auth()->user()->name}}
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Default box -->
    <div class="card">
        
        <div class="card-body">
            
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</section>


@endsection
