import $ from 'jquery';

$(function () {
    async function loadNextQuestion(currentIndex) {
        try {
            const response = await fetch('/examroom/change-questions', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({ index: Number(currentIndex) || 0 })
            });
            
            const data = await response.json();
            
            if (data.current_question) {
                const nextIndex = (Number(currentIndex) || 0) + 1;

                const $q = $('p#question');
                $q.text(data.current_question)
                  .attr('data-index', nextIndex)
                  .data('index', nextIndex);

                const $list = $('div.list-group');
                $list.empty();
                (data.current_options || []).forEach((answer) => {
                    const options = `
                        <label class="list-group-item">
                            <input class="form-check-input me-2" type="radio" name="q1" value="${answer.option_value}">
                            ${answer.option_value}
                        </label>
                    `;
                    $list.append(options);
                });
            } else {
                alert('Exam finished!');
            }
        } catch (error) {
            console.error('Error fetching question:', error);
            alert('Failed to load next question.');
        }
    }

  
    function getCurrentIndexFromDom() {
        return Number($('p#question').attr('data-index')) || 0;
    }

    $('#nextBtn').on('click', function (e) {
        e.preventDefault();
        const idx = getCurrentIndexFromDom();
        loadNextQuestion(idx);
    });

    $('#prevBtn').on('click', function (e) {
        e.preventDefault();
        
        const idx = Math.max(0, getCurrentIndexFromDom() - 2);
        loadNextQuestion(idx);
    });

    $('.change-question').on('click', function (e) {
        e.preventDefault();
        const idx = Number($(this).data('index')) || 0;
        loadNextQuestion(idx);
    });
});
