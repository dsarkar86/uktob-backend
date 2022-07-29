@extends('layout.under_dashboard')

@section('main-container')

            <div class="page-header">
                <div class="page-header-title">
                    <h4>Template</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-2.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Template</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Add Templates</a>
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
                                <h5>Add Templates</h5>
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
                               <form action="{{ url('/') }}/dashboard/template/add" method="post">
                                @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Type</label>
                                        <div class="col-sm-10">
                                            <select name="type_id" id="type_id" class="form-control">
                                                    <option value=" ">None</option>
                                                @foreach ($template_types as $template)
                                                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="title" class="form-control" placeholder="Enter Template Title" value="" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Word Limit</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="word_limit" class="form-control" placeholder="Enter word limit" value="" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Icon</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="icon" class="form-control"/>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Temperature</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="temperature" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Max Tokens</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="max_tokens" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Top_p</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="top_p" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Frequency Penalty</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="frequency_penalty" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Presence Penalty</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="presence_penalty" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Stop</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="stop" class="form-control"/>
                                        </div>
                                    </div>
                                    

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary">Add Template</button>
                                        </div>
                                    </div>
                                    <textarea id="description" style="visibility: hidden;"></textarea>

                                </form>
                               </div>

                                </div>
                            </div>
                        </div>
                        <!-- Basic Form Inputs card end -->
@endsection
