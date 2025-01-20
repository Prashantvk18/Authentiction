@include('User.Header')
<div class="container">
    <form action="{{ url('trip_roadmap')}}" method='get'>
        @csrf
        <div class="container" style=" float: inline-end;">
            <input type="hidden" value='1' name='check_default'>
            <input  type="text" name="search_name" placeholder="Search by name" id="search_name" >
            <span class="text-danger"></span>
            
            <button type="submit" class = "btn btn-info btn-sm">Search</button>
        </div>
    </form>

<br><br>

<div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Trip Name</th>
                    <th>Days</th>
                </tr>
            </thead>
            <tbody>
                <?php $srno = 1 ?>
                @foreach($trip_data as $data)
                <?php 
                  $fromDate = "$data->start_date";
                  $toDate = "$data->End_date";
                  
                  // Create DateTime objects from the string dates
                  $from = new DateTime($fromDate);
                  $to = new DateTime($toDate);
                 
                    $interval = $from->diff($to);
                ?>
                    <tr>
                        <td></td>
                        <td><a href ="{{route('trip_roadmap_detail', ['id' => $data->id])}}" ><i style="color:black">{{$data->trip_name}}</i></a></td>
                        <td>{{$interval->format('%d days')}}</td>
                    </tr>
                    <?php $srno++ ?>
                @endforeach
            </tbody>
        </table>
</div>
</div>
@include('User.Footer')