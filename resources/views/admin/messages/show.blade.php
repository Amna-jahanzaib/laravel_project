@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Messages Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.messages.index')}}">Messages</a></li>
                    <li class="breadcrumb-item active">Messages Details</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="row">
    <div class="col-sm-6">
        <h2>Messages</h2>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Message</li>
        </ol>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Show Message
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            {{ $message->id }}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            First Name
                        </th>
                        <td>
                            {{ $message->first_name }}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            Last Name
                        </th>
                        <td>
                            {{ $message->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Phone
                        </th>
                        <td>
                            {{ $message->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Message
                        </th>
                        <td>
                        {{ $message->message }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection