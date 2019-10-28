@extends('layouts.fyp')

@section('content')
<div class="main_container">
	@include('home/menu')
	@include('home/top_nav')

	<!-- page content -->
	<div class="right_col" role="main">
		<!-- Top Widgets -->
    <div class="row">
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-caret-square-o-right"></i>
          </div>
          <div class="count">{{ $applications }}</div>

          <h3>Card Applications</h3>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-check"></i>
          </div>
          <div class="count">{{ $granted }}</div>

          <h3>Registered Cards</h3>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-exclamation-circle"></i>
          </div>
          <div class="count">{{ $rejections }}</div>

          <h3>Rejected Cards</h3>
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-ban"></i>
          </div>
          <div class="count">{{ $blocked }}</div>

          <h3>Blocked Cards</h3>
        </div>
      </div>
    </div>

    <div class="row">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has($msg))

      <div class="alert alert-{{ $msg }}  alert-dismissible fade in" role="alert">
        {{ Session::get($msg) }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @endforeach
      <table class="table table-striped" id="commuters">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Contact</th>
            <th scope="col">Email</th>
            <th scope="col">Card Status</th>
            <th scope="col">Card Balance (Tsh)</th>
            <th scope="col" class="hidden-field">Card_id</th>
            <th scope="col">Uniqued_id</th>
            <th scope="col">Pin</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $counter = 1; ?>
          @foreach($commuters as $commuter)

          <tr>
            <th scope="row">{{ $counter }}</th>
            <td>{{ $commuter->user->fname }} </td>
            <td>{{ $commuter->user->lname }}</td>
            <td>{{ $commuter->contact }}</td>
            <td>{{ $commuter->user->email }}</td>
            <td>
              <?php
              switch ($commuter->card->status) {
                case 0:
                echo 'Applied and pending';
                break;
                case 1:
                echo 'Granted';
                break;
                case 2:
                echo 'Rejected';
                break;
                case 3:
                echo 'Blocked';
                break;
                case 4:
                echo 'Restored';
                break;

                default:
                    # code...
                break;
              }
              ?>
            </td>
            <td>
              <?php
              if($commuter->card->balance === null){
                echo ' No Balance yet! ';
              }
              else {
                echo $commuter->card->balance ;
              }
              ?>
            </td>

            <td class="hidden-field">{{ $commuter->card_id }}</td>
            <td>
              <?php
              if($commuter->card->unique_id === null){
                echo ' No unique_id yet! ';
              }
              else {
                echo $commuter->card->unique_id ;
              }
              ?>
            </td>

            <td>
              <?php
              if($commuter->card->passcode === null){
                echo ' No passcode yet! ';
              }
              else {
                echo $commuter->card->passcode ;
              }
              ?>
            </td>

            <td>
              <span class="edit">
                <a class="text-success manage-button" href="#">
                  Manage
                </a>
              </span>
            </td>
          </tr>
          <?php $counter++; ?>
          @endforeach
        </tbody>
      </table>
    </div>



    <footer>
     <div class="copyright-info">
      <p class="pull-left">NFC Based Transport payment system
      </p>
      <p class = "pull-right">©2019 All Rights Reserved. Final Year Project developed by Ishimwe Ayman.</p>
    </div>
    <div class="clearfix"></div>
  </footer>
</div>
</div>

<!-- Manage Modal -->
<div class="modal fade" id="showModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <div class="row">
          <span class="col-sm-10">
            <h3 class="modal-title" id="exampleModalLongTitle">Commuter Info</h3>
          </span>
          <span class="col-sm-2">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> 
          </span>
        </div>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6">
            <h5>
              <span> Names: </span> <span id="fname_lname"></span>
            </h5>
          </div>

          <div class="col-sm-6">
            <h5>
              <span> Address: </span> <span id="address"></span>
            </h5>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <h5>
              <span> Contacts: </span> <span id="contacts"></span>
            </h5>
          </div>

          <div class="col-sm-6">
            <h5>
              <span> Email: </span> <span id="email"></span>
            </h5>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <h5>
              <span> Card Status: </span> <span id="status"></span>
            </h5>
          </div>

          <div class="col-sm-6">
            <h5>
              <span> Card Balance: </span> <span id="balance"></span>
            </h5>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <h5>
              <span> Card's Number: </span> <span id="card-number"></span>
            </h5>
          </div>

          <div class="col-sm-6">
            <h5>
              <span> Card's Pin: </span> <span id="card-pin"></span>
            </h5>
          </div>
        </div>

      </div>
      
      <div class="modal-footer">
        <form method="POST" action="/card" id="manageForm">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} row">
            <label for="status" class="col-sm-3">Change card status</label>
            <div class="col-sm-9">
              <select class="form-control" name="card-action" id="card-action">
                

              </select>
            </div>
          </div>
          
          <div class="row" id="card-info">
            <div class="col-sm-6">
              <div class="form-group{{ $errors->has('unique_id') ? ' has-error' : '' }} row">
                <label for="unique_id" class="col-sm-4">Card Number</label>
                <div class="col-sm-8">
                  <input id="unique_id" class="form-control" required type="text" name="unique_id" placeholder="Enter the card UID">
                  @if ($errors->has('unique_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('unique_id') }}</strong>
                  </span>
                  @endif
                </div>

              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group{{ $errors->has('pin') ? ' has-error' : '' }} row">
                <label for="pin" class="col-sm-4">Card Pin</label>
                <div class="col-sm-8">
                  <input id="pin" class="form-control" required readonly type="text" name="pin" >
                  @if ($errors->has('pin'))
                  <span class="help-block">
                    <strong>{{ $errors->first('pin') }}</strong>
                  </span>
                  @endif
                </div>

              </div>
            </div>
          </div>
          <div id = "action-buttons">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary float-right" type="submit">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End of edit Modal -->
@endsection


@section('js')
<script type="text/javascript">
  $(document).ready( function () {
    var table = $('#commuters').DataTable();
    
    //Start Edit record
    table.on('click', '.manage-button', function(){

      $tr = $(this).closest('tr');
      if ($($tr).hasClass('child')) {
        $tr = $tr.prev('.parent');
      }

      var data = table.row($tr).data();
      var card_id = data[7]; // retrieving card_id for update purpose
      var status = data[5];
      $('#fname_lname').text(data[1]  + " " + data[2]);
      $('#contacts').text(data[3]);
      $('#email').text(data[4]);
      $('#status').text(status);
      $('#balance').text(data[6]);

      $('#card-number').text(data[8]);
      $('#card-pin').text(data[9]);


      // Generating Card's Unique ID, randomly
      // function generate_id(l){
      //   var id = "";
      //   var char_list = "0123456789";
      //   for(var i=0; i < l; i++ ){  
      //     id += char_list.charAt(Math.floor(Math.random() * char_list.length));
      //   }
      //   return id;
      // }

      // let unique_id = generate_id(8);

      // $('#unique_id').val(unique_id);

      // Generating Card's Pin, randomly

      function generate_pin(l){
        var pin = "";
        var char_list = "0123456789";
        for(var i = 0; i < l; i++){
          pin += char_list.charAt(Math.floor(Math.random() * char_list.length));
        }

        return pin;
      }

      let pin = generate_pin(4);

      $('#pin').val(pin);

      //Populating the select based on the user's status

      switch (status){
        case "Granted":
        $('#card-action').empty().append("<option value='' selected disabled>Choose option</option> <option value='3'>Block</option>");
        break;

        case "Applied and pending":
        $('#card-action').empty().append("<option value='' selected disabled>Choose option</option> <option value='1'>Grant and Register Card</option> <option value='2'>Reject</option>");
        break;

        case "Rejected":
        $("#card-action").empty().append("<option value='' selected disabled>Choose option</option> <option value='1'>Grant and Register Card</option>");
        break;

        case "Blocked":
        $("#card-action").empty().append("<option value='' selected disabled>Choose option</option> <option value='4'>Restore Card</option>");
        break;

        case "Re-Granted":
        $("#card-action").empty().append("<option value='' selected disabled>Choose option</option> <option value='3'>Block</option>");
        break;

      }

      $('#manageForm').attr('action', '/card/'+data[7]);
      $('#showModal').modal('show');

      console.log(card_id);

    });
    //End Edit record
  } );
</script>

<script type="text/javascript">
  // Setting the card info auto-generation to only happen if granted option is selected
  // And trigger the action-buttons, whose ID is action-buttons
  $(document).ready( function () {

    $("#card-info").hide(); // card-info is the ID for generated unique_id and pin
    $("#action-buttons").hide();

    $("#card-action").change( function() {
      if($("#card-action").val() === "1"){ 
        console.log("Granted");  
        $("#card-info").show();
        $("#action-buttons").show(); 
      }

      else{
        console.log("Not Granted"); 
        $("#card-info").hide();
        $("#action-buttons").show();  
      }
    });
  });
</script>
@endsection

