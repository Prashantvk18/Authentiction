@include('User.Header')
<div class="container">
    @foreach($roadmap_data as $data)
    <h4><u><i><b>{{$data->from_place}} - {{$data->to_place}}
        By {{$data->by_transport}} took {{$data->time_taken}}
    </b></i></u></h4>
    <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;----&nbsp;&nbsp;<i>{{$data->descrip}}</i></h5>
        <br>
    @endforeach
    <form action="{{url('export_roadmap_pdf')}}" method = "get" class="d-inline-block mr-2">
        <input type="hidden" value="{{$trip_id}}" name="tid">
        <button type="submit" class="btn btn-primary btn-sm" vaue="1" ><i>Generate Pdf</i></button>   
    </form>
</div>
@include('User.footer')