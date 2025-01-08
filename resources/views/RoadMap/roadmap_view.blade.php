@include('User.header')
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md"> <!-- Modal size adjusted for mobile -->
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body" id="form_data">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!---/Modal-->
<div class="container">
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="get_formdata()">Add Road Map</button>
    <br><br>
</div>

<script>
        function get_formdata(edit=0,view=0,deletes=0) {      
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: "get",
            url: "{{ route('roadmap_model')}}",
            data:{
                edit: edit,
                view: view,    
            },
            success: function (response) {
                $("#form_data").html(response.data);
            },
            error: function (response){
                console.log(response);
            }
        });
    }
</script>
@include('User.footer')