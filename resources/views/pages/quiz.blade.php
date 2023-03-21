@extends('layouts.app')
@section('content')
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="quiz-container mx-auto p-6 lg:p-8 quiz-content">
            <div class="flex justify-center">
                <img src="/img/atua-logo-white.svg" class="svg-icon home-atua-logo">
            </div>
            <div class="mt-16 quiz-container-bottom">
                <button id="volume">Звук</button>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                    <span
                        class="quiz-list scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    </span>
                </div>
            </div>
        </div>
    </div>
    <script>

class Quiz {
    constructor(questions) {
        this.items = questions.data;
        this.interval = 0;
        this.timer = 0;
        this.answers = [];
    }

    createQuestions() {
        const that = this;
        this.items.forEach(function (item, index) {
            document.querySelector('.quiz-list').appendChild(that.createQuestion(item))
        });
        document.querySelectorAll('.quiz-question').forEach(function (item, index) {
            item.style.display = 'none';
        });
        this.nextQuestion();
    }

    createQuestion(item) {
        const question = document.createElement('div');
        question.classList.add('quiz-question');
        question.setAttribute('data-id', item.id)
        const video = this.createVideo(item.file);
        const timer = this.createTimer();
        const answerList = this.createAnswerList(item.answers);
        question.appendChild(video);
        {{--volume.addEventListener('click', function () {
            video.muted = !video.muted;
            console.log(video.muted);
        });--}}
        volume.click();
        question.appendChild(timer);
        question.appendChild(answerList);
        return question;
    }

    resetTimer(id) {
        const that = this;
        let timerCount = 0;
        const timerLine = document.querySelector(`.quiz-question[data-id="${id}"] .quiz-timer-line`);
        const timerTime = document.querySelector(`.quiz-question[data-id="${id}"] .quiz-timer-time`);
        let timeLeft = 20;
        let timeLeftString = '20';
        this.interval = setInterval(function () {
            timerCount += 5 * .05;
            timeLeft -= .05;
            if (timeLeft <= 0) {
                timeLeft = 0;
            }
            timeLeftString = String(Math.floor(timeLeft));
            if (timerCount >= 100 || document.querySelector(`.quiz-question[data-id="${id}"]`).style.display != 'block') {
                clearInterval(that.interval);
                that.answers.push({id: id, correct: false});
                for (let i in that.items) {
                    if (that.items[i].id == id) {
                        for (let j in that.items[i].answers) {
                            if (that.items[i].answers[j].right_answer) {
                                document.querySelector(`.quiz-ul li[data-question-id="${id}"][data-id="${that.items[i].answers[j].id}"]`).classList.add('correct', 'checked');
                            }
                        }
                    }
                }
                setTimeout(function () {
                    that.nextQuestion();
                }, 2000);
            }
            timerLine.style.width = timerCount + '%';
            timerTime.textContent = '0:' + (timeLeftString.length > 1 ? timeLeftString: '0' + timeLeftString);
        }, 50);
    }

    createTimer() {
        const timer = document.createElement('div');
        timer.classList.add('quiz-timer-wrapper');
        const timerLineWrapper = document.createElement('div');
        timerLineWrapper.classList.add('quiz-timer-line-wrapper');
        const timerLine = document.createElement('div');
        timerLine.classList.add('quiz-timer-line');
        timerLineWrapper.appendChild(timerLine);
        const timerTime = document.createElement('div');
        timerTime.classList.add('quiz-timer-time');
        timerTime.textContent = '0:20';
        timer.appendChild(timerLineWrapper);
        timer.appendChild(timerTime);
        return timer;
    }

    createVideo(video) {
        const videoItem = document.createElement('video');
        videoItem.classList.add('quiz-video');
        if (video.lastIndexOf('.mp4') == video.length - 4) {
            videoItem.src = './videos/'+video;
        } else {
            videoItem.src = './videos/'+video+'.mp4';
        }
        videoItem.controls = true;
        videoItem.controlsList = "nodownload";
        videoItem.muted = true;
        videoItem.autoplay = true;
        videoItem.loop = true;
        return videoItem;
    }

    createAnswerList(items) {
        const that = this;
        let answers = [];
        for (let i in items) {
            answers.push(items[i]);
        }
        const answerList = document.createElement('ul');
        answerList.classList.add('quiz-ul');
        answers.forEach(function (item, index) {
            answerList.appendChild(that.createAnswer(item));
        });
        return answerList;
    }

    createAnswer(item) {
        const answer = document.createElement('li');
        answer.setAttribute('data-id', item.id);
        answer.setAttribute('data-question-id', item.question_id);
        answer.textContent = item.answer;
        return answer;
    }

    checkAnswer(questionId, answerId) {
        const that = this;
        let correct = false;
        let correctAnswer = 0;
        this.items.forEach(function (item, index) {
            if (item.id == questionId) {
                let answers = [];
                for (let i in item.answers) {
                    answers.push(item.answers[i]);
                }
                answers.forEach(function (answer, id) {
                    if (answer.id == answerId && answer.right_answer) {
                        correct = true;
                    } else if (answer.right_answer) {
                        correctAnswer = answer.id;
                    }
                });
                that.answers.push(correct);
                if (!document.querySelectorAll(`.quiz-ul li[data-question-id="${questionId}"].checked`).length) {
                    if (correct) {
                        document.querySelector(`.quiz-ul li[data-question-id="${questionId}"][data-id="${answerId}"]`).classList.add('correct', 'checked');
                    } else {
                        document.querySelector(`.quiz-ul li[data-question-id="${questionId}"][data-id="${answerId}"]`).classList.add('wrong', 'checked');
                        document.querySelector(`.quiz-ul li[data-question-id="${questionId}"][data-id="${correctAnswer}"]`).classList.add('correct', 'checked');
                    }
                }
                clearInterval(that.interval);
                setTimeout(function () {
                    that.nextQuestion();
                }, 2000);
            }
        });
    }

    showResult() {
        const result = document.createElement('div');
        result.classList.add('quiz-result');
        result.innerText = `Вы ответили правильно на ${this.answers.filter(function (item) {return item}).length}/${this.items.length} вопросов`;
        document.querySelector('.quiz-list').appendChild(result);
        console.log(this.answers);
         $.post("/question/getPercent/23", {
      "answers": that.answers,
      "brand_id": $('.campaign-star-rating').attr('data-id')
    }, function (response) {
      // TODO правильная ссылка запроса + response
      if (response.status === "success") {
        name.val('');
        comment.val('');
        modalInformation("<div class='with-title'><i class='icon-Success'></i><h4>Спасибо за отзыв!</h4><p>После проверки модераторами, он будет добавлен на сайт.</p></div>", 6000);
        _t.addClass('disabled');
      } else {
        modalInformation("<i class='icon-Fail'></i>Ошибка. Попробуйте позже.", 3000);
      }
    });
    }

    nextQuestion() {
        const that = this;
        const questionId = this.items[this.answers.length]?.id;
        if (!questionId) { // если этот вопрос не существует, то скрываем все и показываем результат
            document.querySelectorAll('.quiz-question').forEach(function (item, index) {
                item.style.display = 'none';
            });
            this.showResult();
            clearInterval(this.interval);
            return;
        }
        if (!this.answers.length) {
            document.querySelectorAll('.quiz-question').forEach(function (item, index) {
                item.style.display = 'none';
            });
            if (document.querySelector(`.quiz-question[data-id="${questionId}"]`) !== null) {
                document.querySelector(`.quiz-question[data-id="${questionId}"]`).style.display = 'block';
                that.resetTimer(questionId)
            }
        } else {
            document.querySelectorAll('.quiz-question').forEach(function (item, index) {
                item.style.display = 'none';
            });
            if (document.querySelector(`.quiz-question[data-id="${questionId}"]`) !== null) {
                document.querySelector(`.quiz-question[data-id="${questionId}"]`).style.display = 'block';
                that.resetTimer(questionId)
            }
        }
    }
}
    const data = JSON.parse({!! json_encode($questions,JSON_THROW_ON_ERROR) !!});

let quiz = new Quiz(data);
quiz.createQuestions();

document.addEventListener('click', function (e) {
    if (e.target.closest('.quiz-ul')) {
        let questionId = e.target.getAttribute('data-question-id');
        let answerId = e.target.getAttribute('data-id');
        quiz.checkAnswer(questionId, answerId);
    }
});

    </script>
@endsection
