import $ from 'jquery';

$(function() {
    console.log("Exam room ready!");

    $('#examCodeForm').on('submit', function(e) {
        e.preventDefault();

        var exam_code = $('#examCodeInput').val();
        $.ajax({
            headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/join-slot",
            data: { 'exam_code': exam_code },
            type: 'POST',
            dataType: 'json',
            success: function(result) {
                console.log("Success:", result);
                if (result.status === 'joined') {
                  $('#status-msg').html('<div class="alert alert-primary">Joined successfully</div>');
                  $('.status-active').after(' <span class="ml-4 badge bg-danger status-joined">Joined</span>');
                  $('.enter-exam').remove();
                  $('#examCodeModal').remove();
                  $('.modal-backdrop.fade').remove();
                  window.location.href = '/examroom';
                }
            },
            error: function(xhr, status, error) {
      
              if(xhr.responseJSON && xhr.responseJSON.msg){
                $('#status-msg').html('<div class="alert alert-danger">' + xhr.responseJSON.msg + '</div>');
            } else if(error === 'Not Found'){
                $('#status-msg').html('<div class="alert alert-danger">Exam Not Found</div>');
            } else {
                $('#status-msg').html('<div class="alert alert-danger">Something went wrong</div>');
            }
               
            }
        });
    });
});
