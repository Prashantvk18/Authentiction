@include('User.Header')
<div class="container">
<div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Trip Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $srno = 1 ?>
                @foreach($trip_data as $data)
                    <tr>
                        <td></td>
                        <td><a href ="{{route('trip_roadmap_detail', ['id' => $data->id])}}" ><i style="color:black">{{$data->trip_name}}</i></a></td>
                        <td></td>
                    </tr>
                    <?php $srno++ ?>
                @endforeach
            </tbody>
        </table>
</div>
@include('User.Footer')