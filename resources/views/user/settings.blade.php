@extends('themes.' . env('THEME', THEME_DEFAULT) . '.dashboard' )

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Settings</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="/user/settings">
                {!! csrf_field() !!}

                <div class="raw-margin-top-24 {{ get_field_error_class('email', $errors) }}">
                    @input_maker_label('Email')
                    @input_maker_create('email', ['type' => 'string'], $user)
                    {!! get_field_error_detail('email', $errors) !!}
                </div>

                <div class="raw-margin-top-24 {{ get_field_error_class('name', $errors) }}">
                    @input_maker_label('Name')
                    @input_maker_create('name', ['type' => 'string'], $user)
                    {!! get_field_error_detail('name', $errors) !!}
                </div>

                @include('user.meta')

                @if ($user->roles->first()->name === 'admin' || $user->id == 1)
                    <div class="raw-margin-top-24">
                        @input_maker_label('Role')
                        @input_maker_create('roles', ['type' => 'relationship', 'model' => 'App\Models\Role', 'label' => 'label', 'value' => 'name'], $user)
                    </div>
                @endif

                <div class="raw-margin-top-24">
                    <a class="btn btn-default pull-left" href="{{ URL::previous() }}">Cancel</a>
                    <button class="btn btn-primary pull-right" type="submit">Save</button>
                    <a class="btn btn-info pull-right raw-margin-right-16" href="{{ url('user/password') }}">Change Password</a><br>
                </div>
            </form>
        </div>
    </div>

@stop
