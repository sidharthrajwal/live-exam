import $ from 'jquery';


$('#marked_value').on('click', function (e) {
    e.preventDefault();
    const index = $('h2#question').attr('data-question-index');
    const examCode = $(this).data('exam-code');
    const question_id = $('h2#question').attr('data-question-id');
    const option_id = $('input[name="q1"]:checked').attr('data-opt-id');
    const value = $(this).val();

    marksaveQuestion(value, examCode, index, option_id, question_id);
});

$('#submit_answer').on('click', function (e) {
    e.preventDefault();

    const index = $('h2#question').attr('data-question-index');
    const question_id = $('h2#question').attr('data-question-id');


    const option_id = $('input[name="answer"]:checked').attr('data-opt-id') || null;

    const examCode = $(this).data('exam-code');
    const value = $(this).val();

    if (!option_id) {
        alert('Please select an answer first!');
        return;
    }

    marksaveQuestion(value, examCode, index, option_id, question_id);
});

async function marksaveQuestion(currentValue, exam_code, index, option_id, question_id) {

    try {

        console.log('exam code' + exam_code);

        console.log('index' + index);

        console.log('option_id' + option_id);

        console.log('question_id' + question_id);


        const response = await fetch('/examroom/submit-answer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({ marked_value: currentValue || 0, exam_code: exam_code, index: index, option_id: option_id, question_id: question_id })
        });


        response.json().then(data => {
            if (data.remark_added == true) {
                console.log('sadasds');
            }
            $('#alert-wrapper').html(data.error_view);

            setTimeout(() => {
                $('#alert-wrapper').html('');
            }, 1000);
        })

    } catch (error) {
        console.error('Error fetching question:', error);
        alert('Failed to load next question.');
    }
}


function submitExam() {

    const examQuestionId = $('h2#question').attr('data-question-id');
    const examAnswerId = $('input[name="q1"]:checked').attr('data-opt-id');
    const examCode = $('input[name="q1"]:checked').attr('data-exam-code');
    console.log(examQuestionId);
    console.log(examAnswerId);
    console.log(examCode);

}

$('#submit_exam').on('click', function (e) {
    e.preventDefault();
    submitExam();
});
