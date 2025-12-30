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
    const index = $('p#question').attr('data-question-index');
    const examCode = $(this).data('exam-code');
    const value = $(this).val();

    marksaveQuestion(value, examCode, index);
});

async function marksaveQuestion(currentValue, exam_code, index) {

    try {

        console.log(exam_code);

        console.log(index);


        const response = await fetch('/examroom/submit-answer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({ marked_value: currentValue || 0, exam_code: exam_code, index: index })
        });


        response.json().then(data => {
            $('#alert-wrapper').html(data.error_view);
        })

    } catch (error) {
        console.error('Error fetching question:', error);
        alert('Failed to load next question.');
    }
}

