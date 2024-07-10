<x-main-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content:space-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Request log Viewer') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-3 text-gray-900" style="background: #1bac91;">
                    <div style="color:#fff" class="text-dark">
                        <div id="reportrange"
                            style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-1">
                <div class="max-w-7xl text-right p-2">
                    <nav class="navbar navbar-light bg-light justify-content-between">
                        <a class="navbar-brand"></a>
                        <form class="form-inline">
                          <input class="form-control mr-sm-2 rounded" type="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                      </nav>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr class="font-weight-bold">
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Bucket</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Status / Attempts</th>
                            <th scope="col">Response Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($request_logs as $request_log)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{$request_log?->user->name}}</td>
                            <td>{{$request_log->bucket}}</td>
                            <td>{{$request_log->destination}}</td>
                            <td>{{$request_log->status}}</td>
                            <td>{{$request_log->response_code}}</td>
                            <td><a href="{{route('request-log.show', $request_log)}}" class="badge badge-info m-1" style="font-size: medium;">View</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-main-layout>
