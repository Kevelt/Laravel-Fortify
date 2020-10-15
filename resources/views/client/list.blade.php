@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container mt-5">
        <table class="dataTable">
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Register User</th>
                    <th>Register Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listClient as $client)
                    <tr>
                        <td>{{$client->id}}</td>
                        <td>{{$client->name}}</td>
                        <td>{{$client->surname}}</td>
                        <td>{{$client->email}}</td>
                        <td>{{$client->phone}}</td>
                        <td>{{$client->user}}</td>
                        <td>{{$client->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

