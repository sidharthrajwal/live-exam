import $ from 'jquery';

$(function () {
    console.log("Question ready!");

    let currentIndex = $('p#question').data('index');

    async function loadNextQuestion() {
        try {
            const response = await fetch(`/examroom/change-questions?index=${currentIndex}`);
            
            const data = await response.json();
            
            console.log(data.current_question);

            if (data.current_question) {

                $('p#question').text(data.current_question);
                console.log(data.current_options);
                $('div.list-group').empty();
                currentIndex = currentIndex + 1;
                data.current_options.forEach((answer, _index) => {
                    const options = `
                        <label class="list-group-item">
                            <input class="form-check-input me-2" type="radio" name="q1" data-index="${currentIndex}" value="${answer.option_value}">
                            ${answer.option_value}
                        </label>
                    `;
                    $('div.list-group').append(options);
                });
                console.log(currentIndex);
            } 
         
            if (data.current_question === null) {

                alert('Exam finished!');
            }            
            
        } catch (error) {
            console.error("Error fetching question:", error);
            alert('Failed to load next question.');
        }
    }

    $('#nextBtn').on('click', loadNextQuestion);

    $('.change-question').on('click', function() {
        currentIndex = $(this).data('index');
        loadNextQuestion();
    });
});
