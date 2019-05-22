@extends('home')


@section('content')
<div class="container">
        <div class="is-size-3 m-b-lg">Je ben ingelogd als <b>{{ Auth::user()->name }}</b></div>
        <br>
        <div class="columns is-multiline ">
            <table class="table m-b-xl">
                <tbody>
                    <tr>
                        <td>Naam: </td>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <td>Level: </td>
                        <td>{{ Auth::user()->level }}</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
        </div>
                
</div>
@stop
