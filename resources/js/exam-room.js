import $ from 'jquery';
async function loadNextQuestion(index) {
    const response = await fetch('/examroom/change-questions', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      body: JSON.stringify({ index })
    });
    const data = await response.json();
    if (data.current_question) {
      $('p#question').text(data.current_question).attr('data-index', index + 1);
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
      alert('Exam finished!');
    }
  }
  
  $('#nextBtn').on('click', (e) => {
    e.preventDefault();
    const idx = Number($('p#question').data('index')) || 0;
    loadNextQuestion(idx);
  });
  
  $('#prevBtn').on('click', (e) => {
    e.preventDefault();
    const idx = Math.max(0, (Number($('p#question').data('index')) || 1) - 2);
    loadNextQuestion(idx);
  });