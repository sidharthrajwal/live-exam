import $ from 'jquery';
async function loadNextQuestion(index, exam_code) {
  const response = await fetch('/examroom/change-questions', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    body: JSON.stringify({ index, exam_code })
  });
  console.log(response);
  const data = await response.json();
  if (data.current_question !== null) {
    console.log('success');
    $('p#question').text(data.current_question).attr('data-question-index', index + 1);
    $('.list-group').empty();
    data.current_options.forEach((answer) => {
      $('.list-group').append(`
          <label class="list-group-item">
            <input class="form-check-input me-2" type="radio" name="q1" value="${answer.option_value}">
            ${answer.option_value}
          </label>
        `);
    });
  } else {
    $('#alert-wrapper').html(data.error_view);

  }
}

$('#nextBtn').on('click', (e) => {
  e.preventDefault();
  var idx = Number($('p#question').attr('data-question-index')) || 0;
  console.log(idx);
  loadNextQuestion(idx, $('p#question').data('exam-code'));
});

$('#prevBtn').on('click', (e) => {
  e.preventDefault();
  var idx = Math.max(0, (Number($('p#question').attr('data-question-index')) || 1) - 2);
  loadNextQuestion(idx, $('p#question').data('exam-code'));
});


$('.change-question').on('click', (e) => {
  e.preventDefault();
  var idx = Number($(e.target).data('index')) || 0;
  loadNextQuestion(idx, $('p#question').data('exam-code'));
});
