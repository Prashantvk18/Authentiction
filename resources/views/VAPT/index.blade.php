@include('User.header')

<div class="cointainer">
  

    <!-- <form id="dynamicForm">
        <label for="typeSelect">Choose type:</label>
        <select id="typeSelect">
            <option value="blank">Select an option</option>
            <option value="dropdown">Dropdown</option>
            <option value="text">Text</option>
        </select>
        <div id="dynamicFieldContainer" class="hidden">
            //The dynamic field will be injected here
        </div>
    </form> -->
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
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
    <!---/Modal--->
</div>
<div class="container">
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="get_formdata()">Add Client</button>
<!-- <a href="{{ route('exportpdf') }}" class="btn btn-success">Export to PDF</a> -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Ticket Id</th>
                <th style="width:450px;">Client Name</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $srno = 0?>
            @foreach($vapt_data as $data)
                <tr>
                    <td>{{$vapt_data->firstItem() + $srno }}</td>
                    <td>{{$data->ticket_no}}</td>
                    <td>{{$data->Client_name}}</td>
                    <td>@if(isset($data->End_date)) <p style="color:green;">Completed </p> @else <p style="color:red;">Pending </p> @endif</td>
                    <td>{{$data->start_date}}</td>
                    <td>{{$data->End_date}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="get_formdata({{$data->ticket_no}},0,0);">Edit</button>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="get_formdata({{$data->ticket_no}},1,0);">View</button>
                    </td>
                </tr>
                <?php $srno++ ?>
            @endforeach
        </tbody>
    </table>
    {{$vapt_data->links()}}
    <!-----CRICKET------->
    <?php
    $bowlers = ['bhuvi','boom' , 'Hardik' , 'cool' , 'Baapu'];
    $batters = ['jaiswal','rohit','virat','shrey' , 'surya','KL','bHardik','bBaapu' , 'bbhuvi','bboom'   , 'bcool' ];
    ?>
    <div class="row">
        <div class="col-md-4">
            <span id="random"></span>
            <p>Score: <span id="score"></span>/<span id="wicket"></span>&nbsp;&nbsp;Ball:<span id="ball"></span></p>
            <button id="btnscr"class="btn btn-sm btn-success" onClick="score();">&nbsp;&nbsp;Hit&nbsp;&nbsp;</button>
            <p>1)<span id="first"></span>/<span id="wfirst"></span></p>
            <p>2)<span id="second"></span>/<span id="wsecond"></span></p>
            <p>3)<span id="third"></span>/<span id="wthird"></span></p>
            <p>4)<span id="fourth"></span>/<span id="wfourth"></span></p>
            <p>5)<span id="fifth"></span>/<span id="wfifth"></span></p>
            <p>6)<span id="sixth"></span>/<span id="wsixth"></span></p>
            <p>7)<span id="seven"></span>/<span id="wseven"></span></p>
            <p>8)<span id="eight"></span>/<span id="weight"></span></p>
            <p>9)<span id="nine"></span>/<span id="wnine"></span></p>
            <p>10)<span id="ten"></span>/<span id="wten"></span></p>
            <br>
        </div>
        <div class="col-md-4">
            <span id="random1"></span>
            <p>Score: <span id="score1"></span>/<span id="wicket1"></span>&nbsp;&nbsp;Ball:<span id="ball1"></span></p>
            <button id="btnscr1"class="btn btn-sm btn-success" onClick="score1();">&nbsp;&nbsp;Hit&nbsp;&nbsp;</button>
            <p>1)<span id="first1"></span>/<span id="wfirst1"></span></p>
            <p>2)<span id="second1"></span>/<span id="wsecond1"></span></p>
            <p>3)<span id="third1"></span>/<span id="wthird1"></span></p>
            <p>4)<span id="fourth1"></span>/<span id="wfourth1"></span></p>
            <p>5)<span id="fifth1"></span>/<span id="wfifth1"></span></p>
            <p>6)<span id="sixth1"></span>/<span id="wsixth1"></span></p>
            <p>7)<span id="seven1"></span>/<span id="wseven1"></span></p>
            <p>8)<span id="eight1"></span>/<span id="weight1"></span></p>
            <p>9)<span id="nine1"></span>/<span id="wnine1"></span></p>
            <p>10)<span id="ten1"></span>/<span id="wten1"></span></p>
            <br>
        </div>
        <div class="col-md-4"> </div>
        <div class="col-md-4">
      @foreach($batters as $bat)
        <p>{{$bat}}: <span id="{{$bat}}">0</span></p>
      
      @endforeach
        </div>
        <div class="col-md-4">
      @foreach($bowlers as $bowl)
        <p>{{$bowl}}: <span id="{{$bowl}}"></span>/<span id="w{{$bowl}}"></span></p>
      
      @endforeach
        </div>
    </div>
    </div>
    
<script>
    const bowlers = ['bhuvi','boom' , 'cool' , 'Baapu' , 'Hardik'];
    const batters =  ['jaiswal','rohit','virat','shrey' , 'surya','KL','bHardik','bBaapu' , 'bbhuvi','bboom'   , 'bcool' ];
    var ball =over=scores=wicket=0;
    var fscore = sscore = tscore = foscore = fiscore = siscore = sescore = eiscore = niscore = tescore =0;
    var fwkt = swkt = twkt = fowkt = fiwkt = siwkt = sewkt = eiwkt = niwkt = tewkt = 0;
    var ball1 =over=scores1=wicket1=player_score=0;
    var fscore1 = sscore1 = tscore1 = foscore1 = fiscore1 =  siscore1 = sescore1 = eiscore1 = niscore1 = tescore1 =0;
    var fwkt1 = swkt1 = twkt1 = fowkt1 = fiwkt1 =  siwkt1 = sewkt1 = eiwkt1 = niwkt1 = tewkt1= 0;
    
    function getRandomNumber(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }
    function score() {
        var randomNumber = getRandomNumber(0, 6);
        ++ball;
       
        if(randomNumber != 5 && randomNumber != 0){
            scores = randomNumber + scores;
            player_score = randomNumber + player_score;
            $("#"+batters[wicket]).html(player_score);
            var scorefirst = $("#score1").html();
            if(scorefirst != '' && scores > scorefirst){
                $("#random").html('Chased');
                $("#btnscr").prop('disabled',true);
            }
        }
        $("#score").html(scores);
        if(randomNumber == 0){
            wicket++
            player_score = 0;
        }
        
        $("#wicket").html(wicket);
        if(wicket == 11){
            $("#random").html('All Out');
            $("#btnscr").prop('disabled',true);
        }
        $("#ball").html(ball);
        if(ball == 60){
            $("#random").html('Over Completed');
            $("#btnscr").prop('disabled',true);
        }
        
        if(ball <=6){
            if(randomNumber != 5 && randomNumber != 0){
                fscore = randomNumber + fscore;
            }
            if(randomNumber == 0){
            fwkt++
            }
           
            $("#first").html(fscore);
            $("#wfirst").html(fwkt);
        }
        if(ball <=12 && ball > 6){
            if(randomNumber != 5 && randomNumber != 0){
                sscore = randomNumber + sscore;
            }
            if(randomNumber == 0){
            swkt++
            }
            $("#second").html(sscore);
            $("#wsecond").html(swkt);
        }
        if(ball <=18 && ball > 12){
            if(randomNumber != 5 && randomNumber != 0){
                tscore = randomNumber + tscore;
            }
            if(randomNumber == 0){
            twkt++
            }
            
            $("#third").html(tscore);
            $("#wthird").html(twkt);
        }
        if(ball <=24  && ball > 18){
            if(randomNumber != 5 && randomNumber != 0){
                foscore = randomNumber + foscore;
            }
            if(randomNumber == 0){
            fowkt++
            }
            $("#fourth").html(foscore);
            $("#wfourth").html(fowkt);
        }
        if(ball <=30 && ball > 24){
            if(randomNumber != 5 && randomNumber != 0){
                fiscore = randomNumber + fiscore;
            }
            if(randomNumber == 0){
            fiwkt++
            }
            $("#fifth").html(fiscore);
            $("#wfifth").html(fiwkt);
        }


        if(ball <=36 && ball > 30){
            if(randomNumber != 5 && randomNumber != 0){
                siscore = randomNumber + siscore;
            }
            if(randomNumber == 0){
            siwkt++
            }
            $("#sixth").html(siscore);
            $("#wsixth").html(siwkt);
        }
        if(ball <=42 && ball > 36){
            if(randomNumber != 5 && randomNumber != 0){
                sescore = randomNumber + sescore;
            }
            if(randomNumber == 0){
            sewkt++
            }
            $("#seven").html(sescore);
            $("#wseven").html(sewkt);
        }
        if(ball <=48 && ball > 42){
            if(randomNumber != 5 && randomNumber != 0){
                eiscore = randomNumber + eiscore;
            }
            if(randomNumber == 0){
            eiwkt++
            }
            $("#eight").html(eiscore);
            $("#weight").html(eiwkt);
        }
        if(ball <=54 && ball > 48){
            if(randomNumber != 5 && randomNumber != 0){
                niscore = randomNumber + niscore;
            }
            if(randomNumber == 0){
            niwkt++
            }
            $("#nine").html(niscore);
            $("#wnine").html(niwkt);
        }
        if(ball <=60 && ball > 54){
            if(randomNumber != 5 && randomNumber != 0){
                tescore = randomNumber + tescore;
            }
            if(randomNumber == 0){
            tewkt++
            }

            $("#ten").html(tescore);
            $("#wten").html(tewkt);
          
        }

        
    }
    function score1() {
        var randomNumber1 = getRandomNumber(0, 6);
        ++ball1;
       
        if(randomNumber1 != 5 && randomNumber1 != 0){
            scores1 = randomNumber1 + scores1;
            var scorefirst = $("#score").html();
            if(scorefirst != '' &&scores1 > scorefirst){
                $("#random1").html('Chased');
                $("#btnscr1").prop('disabled',true);
            }
        }
        $("#score1").html(scores1);
        if(randomNumber1 == 0){
            wicket1++
        }
        
        $("#wicket1").html(wicket1);
        if(wicket1 == 11){
            $("#random1").html('All Out');
            $("#btnscr1").prop('disabled',true);

        }
        $("#ball1").html(ball1);
        if(ball1 == 60){
            $("#random1").html('Over Completed');
            $("#btnscr1").prop('disabled',true);
        }
        if(ball1 <=6){
            if(randomNumber1 != 5 && randomNumber1 != 0){
                fscore1 = randomNumber1 + fscore1;
            }
            if(randomNumber1 == 0){
            fwkt1++
            }
           
            $("#first1").html(fscore1);
            $("#wfirst1").html(fwkt1);
            $("#bhuvi").html(fscore1);
            $("#wbhuvi").html(fwkt1);
        }
        if(ball1 <=12 && ball1 > 6){
            if(randomNumber1 != 5 && randomNumber1 != 0){
                sscore1 = randomNumber1 + sscore1;
            }
            if(randomNumber1 == 0){
            swkt1++
            }
            $("#second1").html(sscore1);
            $("#wsecond1").html(swkt1);
            $("#boom").html(sscore1 );
            $("#wboom").html(swkt1);
        }
        if(ball1 <=18 && ball1 > 12){
            if(randomNumber1 != 5 && randomNumber1 != 0){
                tscore1 = randomNumber1 + tscore1;
            }
            if(randomNumber1 == 0){
            twkt1++
            }
            $("#third1").html(tscore1);
            $("#wthird1").html(twkt1);
            $("#bhuvi").html(fscore1 + tscore1);
            $("#wbhuvi").html(fwkt1+twkt1);
        }
        if(ball1 <=24  && ball1 > 18){
            if(randomNumber1 != 5 && randomNumber1 != 0){
                foscore1 = randomNumber1 + foscore1;
            }
            if(randomNumber1 == 0){
            fowkt1++
            }
            $("#fourth1").html(foscore1);
            $("#wfourth1").html(fowkt1);
            $("#cool").html(foscore1);
            $("#wcool").html(fowkt1);
        }
        if(ball1 <=30 && ball1 > 24){
            if(randomNumber1 != 5 && randomNumber1 != 0){
                fiscore1 = randomNumber1 + fiscore1;
            }
            if(randomNumber1 == 0){
            fiwkt1++
            }
            $("#fifth1").html(fiscore1);
            $("#wfifth1").html(fiwkt1);
            $("#Baapu").html(fiscore1);
            $("#wBaapu").html(fiwkt1);
        }


        if(ball1 <=36 && ball1 > 30){
            if(randomNumber1 != 5 && randomNumber1 != 0){
                siscore1 = randomNumber1 + siscore1;
            }
            if(randomNumber1 == 0){
            siwkt1++
            }
            $("#sixth1").html(siscore1);
            $("#wsixth1").html(siwkt1);
            $("#cool").html(foscore1 + siscore1);
            $("#wcool").html(fowkt1+siwkt1);

        }
        if(ball1 <=42 && ball1 > 36){
            if(randomNumber1 != 5 && randomNumber1 != 0){
                sescore1 = randomNumber1 + sescore1;
            }
            if(randomNumber1 == 0){
            sewkt1++
            }
            $("#seven1").html(sescore1);
            $("#wseven1").html(sewkt1);
            $("#boom").html(sscore1 + sescore1);
            $("#wboom").html(swkt1+sewkt1);
        }
        if(ball1 <=48 && ball1 > 42){
            if(randomNumber1 != 5 && randomNumber1 != 0){
                eiscore1 = randomNumber1 + eiscore1;
            }
            if(randomNumber1 == 0){
            eiwkt1++
            }
            $("#eight1").html(eiscore1);
            $("#weight1").html(eiwkt1);
            $("#Hardik").html(eiscore1 );
            $("#wHardik").html(eiwkt1);
        }
        if(ball1 <=54 && ball1 > 48){
            if(randomNumber1 != 5 && randomNumber1 != 0){
                niscore1 = randomNumber1 + niscore1;
            }
            if(randomNumber1 == 0){
            niwkt1++
            }
            $("#nine1").html(niscore1);
            $("#wnine1").html(niwkt1);
            $("#Baapu").html(fiscore1 + niscore1);
            $("#wBaapu").html(fiwkt1+niwkt1);
        }
        if(ball1 <=60 && ball1 > 54){
            if(randomNumber1 != 5 && randomNumber1 != 0){
                tescore1 = randomNumber1 + tescore1;
            }
            if(randomNumber1 == 0){
            tewkt1++
            }
            $("#ten1").html(tescore1);
            $("#wten1").html(tewkt1);
            $("#Hardik").html(eiscore1 + tescore1);
            $("#wHardik").html(eiwkt1+tewkt1);
        }
        
    }
    $(document).ready(function(){
        

        $("#typeSelect").on('change' , function(){
            
            var selectedvalue = $(this).val();
            var $container =$('#dynamicFieldContainer');

            $container.empty();

            if(selectedvalue === 'dropdown'){
                
                var $selected = $('<select id="dynamicDropdown">' +
                                    '<option value="">Select an option</option>' +
                                    '<option value="option1">O+</option>' +
                                    '<option value="option2">AB-</option>' +
                                    '<option value="option3">AB+</option>' +
                                    '<option value="option">B-</option>' +
                                    '<option value="option5">B+</option>' +
                                    '</select>');
                $container.append($selected);
            }else if (selectedvalue === 'text') {
                    var $input = $('<input type="text" id="dynamicTextField" placeholder="Enter text here"/>');
                    $container.append($input);
                }
                $container.toggleClass('hidden', $container.children().length === 0);
        });
    });
    function get_formdata(edit=0,view=0,deletes=0) {

        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: "get",
            url: "{{ route('vapt_model')}}",
            data:{
                edit:edit,
                view:view,    
            },
            success: function (response) {
                $("#form_data").html(response.data);
            },
            error : function (response){
                console.log(response);
            }
        });
    }

  
</script>

@include('User.footer')