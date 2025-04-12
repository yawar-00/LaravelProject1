@extends('layout.master')
@section('content')
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentmodal">
  Launch demo modal
</button>



<!-- Modal -->
<div class="modal fade" id="studentmodal" tabindex="-1" aria-labelledby="studentmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id='studentform'>
                @csrf
                    <input name="id" id="id" type="hidden">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name">
                    <br><br>
                    <label for="enroll">Enroll:</label>
                    <input type="text" id="enroll" name="enroll">
                    <br><br> 
            
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary addStudent">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.addStudent').on('click', function(e) {

            e.preventDefault();
            var data = $('#studentform').serialize();
            $.ajax({
                url: "/postData",
                type: "POST",
                data: {
                    "_token": "{{csrf_token()}}",
                    data: data
                },
                success: function(response) {
                    
                    $('#studentform')[0].reset();
                    $('#studentmodal').modal('hide');
                    // fetchrecords();
                }
            });
        })
    });
</script>


@endsection