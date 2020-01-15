/**
 * Created by vietv on 5/27/2019.
 */

let question = {
    addAnswer: function () {
        let answerLabel = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'V', 'W', 'X', 'Y', 'Z'];

        let answerMain = $('#answer-main');
        let answerTemp = $('#answer-temp');

        let answerNumber = answerMain.find('input').length;

        answerTemp.find('input').attr('id', 'answer_' + answerLabel[answerNumber]);
        answerTemp.find('input').attr('name', 'answer[' + answerLabel[answerNumber] + ']');
        answerTemp.find('label').text('Câu trả lời ' + answerLabel[answerNumber]);

        answerMain.append(answerTemp.html());
    },
    uploadFile: function (id) {
        $('#' + id).bind('change', function (event) {
            let size = Number((this.files[0].size / (1024 * 1024)).toFixed(3));

            $(event.target).closest('label').find('span').text(this.files[0].name.substring(0, 10) + ' (' + size + 'mb)');
        });
    },
    validateForm: function () {
        let typeAnswer = $('#type-question');
        if (typeof typeAnswer !== 'undefined' && typeAnswer.val() === 'choose_answer') {
            let answerChecked = $("input:checkbox.tp-checkbox:checked").length;
            if (answerChecked === 0 || answerChecked === 4) {
                let errorQuestionModal = $('#errorQuestion');

                errorQuestionModal.find('.modal-body').text('Chưa chọn đáp án đúng. Vui lòng chọn lớn hơn 1 và nhỏ hơn 4 đáp án đúng');

                errorQuestionModal.modal('show');

                return false;
            }
        }

        return true;
    },
    deleteQuestion: function (id) {
        let deleteQuestionModal = $('#deleteQuestion');

        deleteQuestionModal.find('input[name="question_id"]').val(id);

        deleteQuestionModal.modal('show');
    }
};