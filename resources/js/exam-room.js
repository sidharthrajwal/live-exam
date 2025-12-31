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
    $('h2#question').text(data.current_question).attr('data-question-index', index + 1);
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

let idx = Number($('p#question').attr('data-question-index')) || 0;

$('#nextBtn').on('click', function (e) {
  e.preventDefault();

  idx++;
  updateIndex(idx);
  loadNextQuestion(idx, getExamCode());
});

$('#prevBtn').on('click', function (e) {
  e.preventDefault();

  idx = Math.max(0, idx - 1);
  updateIndex(idx);
  loadNextQuestion(idx, getExamCode());
});

function updateIndex(index) {
  $('p#question').attr('data-question-index', index);
}

function getExamCode() {
  return $('p#question').attr('data-exam-code');
}


$('.change-question').on('click', (e) => {
  e.preventDefault();
  var idx = Number($(e.target).data('index')) || 0;
  loadNextQuestion(idx, $('p#question').data('exam-code'));
});
