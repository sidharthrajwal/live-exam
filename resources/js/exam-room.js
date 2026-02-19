import $ from 'jquery';

let idx = Number($('#question').data('question-index')) || 0;
const examId = $('#nextBtn').data('exam-id');

async function loadNextQuestion(index) {
  const response = await fetch('/examroom/change-questions', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    body: JSON.stringify({
      index: index,
      exam_id: examId
    })
  });

  const data = await response.json();
  console.log(data);

  if (data.current_question !== null) {

    const questionId = data.current_options[0].question_id;
    console.log('question id', questionId);

    $('.qus-count').text(`Q.${index + 1}`);

    $('#question')
      .text(data.current_question)
      .attr('data-question-index', index)
      .attr('data-question-id', questionId);

    $('.list-group').empty();

    data.current_options.forEach(answer => {
      $('.list-group').append(`
      <label class="list-group-item">
        <input type="radio"
               name="answer"
               data-opt-id="${answer.id}"
               value="${answer.option_value}"
               class="form-check-input me-2">
        ${answer.option_value}
      </label>
    `);
    });
  }
  else {

    idx = Math.max(0, idx - 1);
    $('#alert-wrapper').html(data.error_view);

    setTimeout(() => {
      $('#alert-wrapper').html('');
    }, 1000);
  }
}


$('#nextBtn').on('click', function (e) {
  e.preventDefault();
  idx++;
  console.log(idx);
  loadNextQuestion(idx);
});

$('#prevBtn').on('click', function (e) {
  e.preventDefault();
  idx = Math.max(0, idx - 1);
  loadNextQuestion(idx);
});

$('.change-question').on('click', function (e) {
  e.preventDefault();
  idx = Number($(this).data('index')) || 0;
  loadNextQuestion(idx);
});
