@extends('layout.under_dashboard')

@section('main-container')

            <div class="page-header">
                <div class="page-header-title">
                    <h4>Contents</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-2.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Contents</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Add Contents</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Page header end -->
            <!-- Page body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Basic Form Inputs card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Add Contents</h5>
                                <div class="card-header-right">
                                    <i class="icofont icofont-rounded-down"></i>
                                    <i class="icofont icofont-refresh"></i>
                                    <i class="icofont icofont-close-circled"></i>
                                </div>
                            </div>
                            <div class="card-block">
                             <div class="col-sm-8">
                                 <div class="validation_errors_alert">

                                </div>
                            </div>
                             <div class="col-sm-8">
                               <form action="{{ url('/') }}/dashboard/contents/add" method="post">
                                @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Slug</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="slug" class="form-control" placeholder="Enter a slug" value="" />
                                        </div>
                                        @if ($errors->any())
                                        <span></span>
                                        @endif
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" class="form-control" placeholder="Enter some description."></textarea>
                                        </div>
                                        @if ($errors->any())
                                        <span></span>
                                        @endif
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary">Add Content</button>
                                        </div>
                                    </div>
                                    <textarea id="description" style="visibility: hidden;"></textarea>

                                </form>
                               </div>

                                </div>
                            </div>
                        </div>
                        <!-- Basic Form Inputs card end -->

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    @endif
@endsection
