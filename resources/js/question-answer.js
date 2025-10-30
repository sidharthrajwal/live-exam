import $ from 'jquery';

$(function() {
    console.log("Question ready!");

    // Handle next question loading
    let currentIndex = 0;

    async function loadNextQuestion() {
        try {
            const response = await fetch(`/examroom/change-questions`);
            const data = await response.json();

            if (data.question) {
                $('#question').html(data.question.text);
                currentIndex = data.next_index;
            } else {
                alert('Exam finished!');
            }
        } catch (error) {
            console.error("Error fetching question:", error);
            alert('Failed to load next question.');
        }
    }

    $('#nextBtn').on('click', loadNextQuestion);
});
