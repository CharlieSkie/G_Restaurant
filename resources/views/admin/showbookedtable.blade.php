@extends('admin.maindesign')

@section('show_food')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Food Items</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Customer Email</th>
                                    <th>Number_of_guests</th>
                                    <th>Time</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booked_tables as $booked_table)
                                    <tr>
                                        <td class="align-middle">{{ $booked_table->Email}}</td>
                                        <td class="align-middle">{{ $booked_table->number_of_guests }}</td>
                                        <td class="align-middle">{{ $booked_table->time }}</td>
                                        <td class="align-middle">{{ $booked_table->date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection