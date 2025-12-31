import $ from 'jquery';


$('#marked_value').on('click', function (e) {
    e.preventDefault();
    const index = $('p#question').attr('data-question-index');
    const examCode = $(this).data('exam-code');
    const value = $(this).val();

    marksaveQuestion(value, examCode, index);
});

$('#submit_answer').on('click', function (e) {
    e.preventDefault();
    const index = $('h2#question').attr('data-question-index');
    const option_id = $('input[name="q1"]:checked').attr('data-opt-id');
    const examCode = $(this).data('exam-code');
    const value = $(this).val();

    marksaveQuestion(value, examCode, index, option_id);
});

async function marksaveQuestion(currentValue, exam_code, index, option_id) {

    try {

        console.log(exam_code);

        console.log(index);


        const response = await fetch('/examroom/submit-answer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({ marked_value: currentValue || 0, exam_code: exam_code, index: index, option_id: option_id })
        });


        response.json().then(data => {
            if (data.remark_added == true) {
                console.log('sadasds');
            }
            $('#alert-wrapper').html(data.error_view);
        })

    } catch (error) {
        console.error('Error fetching question:', error);
        alert('Failed to load next question.');
    }
}

