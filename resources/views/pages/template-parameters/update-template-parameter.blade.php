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
                        <li class="breadcrumb-item"><a href="#!">Template Parameters</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Update Template Parameter</a>
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
                                <h5>Update Template Parameter</h5>
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

                                {{-- <pre>{{ print_r($template_data) }}</pre> --}}
                               <form action="{{ url('/') }}/dashboard/template-parameter/update" method="post">
                                @csrf
                                    <input type="hidden" name="id" id="id" value="{{ $template_data->id }}" />
                                    <input type="hidden" name="template_id" id="template_id" value="{{ $template_data->template_id }}" />
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Parameter</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="parameter" class="form-control" placeholder="Enter Parameter" value="{{ $template_data->parameter }}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Type</label>
                                        <div class="col-sm-10">
                                            <select name="type" id="type" class="form-control">
                                                    <option value=" ">None</option>
                                                    <option value="input" {{ ($template_data->type == 'input'?'selected':'') }}>Input</option>
                                                    <option value="textarea" {{ ($template_data->type == 'textarea'?'selected':'') }}>Textarea</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Text Length</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="text_length" class="form-control" placeholder="Enter text length" value="{{ $template_data->text_length }}" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" for="">Is Required?</label>
                                        <div class="col-sm-10">
                                            <input type="checkbox" name="is_required" id="is_required" value="1" {{ ($template_data->is_required == 1?'checked':'') }} />
                                            <span class="text-small"> Check this box to enable the required validation.</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary">Update Template Parameter</button>
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
