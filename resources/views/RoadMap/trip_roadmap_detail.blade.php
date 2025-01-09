@include('User.Header')
<div class="container">
    @foreach($roadmap_data as $data)
    <h3><u><i><b>{{$data->from_place}} - {{$data->to_place}} ( {{$data->travel_date}} )
        By {{$data->by_transport}} 
    </b></i></u></h3>
    <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;----&nbsp;&nbsp;<i>{{$data->descrip}}</i></h4>
        <br>
    @endforeach
</div>

    
@include('User.footer')