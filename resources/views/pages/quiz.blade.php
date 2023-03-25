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
                this.counter = 0;
                this.answers = [];
                this.tick = '<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 26 26" width="20px" height="20px"><path d="M 22.566406 4.730469 L 20.773438 3.511719 C 20.277344 3.175781 19.597656 3.304688 19.265625 3.796875 L 10.476563 16.757813 L 6.4375 12.71875 C 6.015625 12.296875 5.328125 12.296875 4.90625 12.71875 L 3.371094 14.253906 C 2.949219 14.675781 2.949219 15.363281 3.371094 15.789063 L 9.582031 22 C 9.929688 22.347656 10.476563 22.613281 10.96875 22.613281 C 11.460938 22.613281 11.957031 22.304688 12.277344 21.839844 L 22.855469 6.234375 C 23.191406 5.742188 23.0625 5.066406 22.566406 4.730469 Z" fill="#039d52"/></svg>';
                this.cross = '<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 26 26" width="20px" height="20px"><path d="M 21.734375 19.640625 L 19.636719 21.734375 C 19.253906 22.121094 18.628906 22.121094 18.242188 21.734375 L 13 16.496094 L 7.761719 21.734375 C 7.375 22.121094 6.746094 22.121094 6.363281 21.734375 L 4.265625 19.640625 C 3.878906 19.253906 3.878906 18.628906 4.265625 18.242188 L 9.503906 13 L 4.265625 7.761719 C 3.882813 7.371094 3.882813 6.742188 4.265625 6.363281 L 6.363281 4.265625 C 6.746094 3.878906 7.375 3.878906 7.761719 4.265625 L 13 9.507813 L 18.242188 4.265625 C 18.628906 3.878906 19.257813 3.878906 19.636719 4.265625 L 21.734375 6.359375 C 22.121094 6.746094 22.121094 7.375 21.738281 7.761719 L 16.496094 13 L 21.734375 18.242188 C 22.121094 18.628906 22.121094 19.253906 21.734375 19.640625 Z" fill="#b61031"/></svg>';
            }

            init() {
                const that = this;
                const startScreen = document.createElement('div');
                startScreen.classList.add('start-screen');
                const button = document.createElement('button');
                button.classList.add('start-btn');
                button.textContent = 'Начать';
                startScreen.appendChild(button);
                document.querySelector('.quiz-list').appendChild(startScreen)
                button.addEventListener('click', function () {
                    startScreen.remove();
                    that.createQuestions();
                });
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
                this.counter++;
                const question = document.createElement('div');
                question.classList.add('quiz-question');
                question.setAttribute('data-id', item.id)
                const video = this.createVideo(item.file);
                const timer = this.createTimer();
                const answerList = this.createAnswerList(item.answers);
                const nextBtn = this.createNextBtn();
                const num = this.createNum(this.counter);
                question.appendChild(video);
                question.appendChild(timer);
                question.appendChild(answerList);
                const questionFooter = document.createElement('div');
                questionFooter.classList.add('quiz-footer');
                questionFooter.appendChild(nextBtn);
                questionFooter.appendChild(num);
                question.appendChild(questionFooter);
                return question;
            }

            createNum(number) {
                const num = document.createElement('div');
                num.classList.add('quiz-num');
                num.innerText = number + '/' + this.items.length;
                return num;

            }

            createNextBtn() {
                const that = this;
                const nextBtn = document.createElement('button');
                nextBtn.classList.add('quiz-next', 'hidden');
                nextBtn.textContent = 'К следующему вопросу';
                nextBtn.addEventListener('click', function () {
                    that.nextQuestion();
                });
                return nextBtn;
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
                                        const tick = document.createElement('span');
                                        tick.innerHTML = that.tick;
                                        document.querySelector(`.quiz-ul li[data-question-id="${id}"][data-id="${that.items[i].answers[j].id}"]`).appendChild(tick);
                                    }
                                }
                            }
                        }
                        document.querySelector(`.quiz-question[data-id="${id}"] .quiz-next`).classList.remove('hidden');
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
                                const tick = document.createElement('span');
                                tick.innerHTML = that.tick;
                                document.querySelector(`.quiz-ul li[data-question-id="${questionId}"][data-id="${answerId}"]`).appendChild(tick);
                            } else {
                                document.querySelector(`.quiz-ul li[data-question-id="${questionId}"][data-id="${answerId}"]`).classList.add('wrong', 'checked');
                                const cross = document.createElement('span');
                                cross.innerHTML = that.cross;
                                document.querySelector(`.quiz-ul li[data-question-id="${questionId}"][data-id="${answerId}"]`).appendChild(cross);
                                document.querySelector(`.quiz-ul li[data-question-id="${questionId}"][data-id="${correctAnswer}"]`).classList.add('correct', 'checked');

                                const tick = document.createElement('span');
                                tick.innerHTML = that.tick;
                                document.querySelector(`.quiz-ul li[data-question-id="${questionId}"][data-id="${correctAnswer}"]`).appendChild(tick);
                            }
                        }
                        clearInterval(that.interval);
                        document.querySelector(`.quiz-question[data-id="${questionId}"] .quiz-next`).classList.remove('hidden');
                    }
                });
            }

            showResult() {
                const that = this;
                const result = document.createElement('div');
                result.classList.add('quiz-result');
                document.querySelector('.quiz-list').appendChild(result);
                $.post("/question/getPercent/{{$user['id']}}", {
                    "answers": that.answers,
                }, function (response) {
                    // TODO правильная ссылка запроса + response
                                    result.innerHTML = `Вы ответили правильно на ${response.percent} % вопросов`;
                                    if(response.percent >= 70){
                                     result.innerHTML += `<img src="/img/qrcode.png" class="home-atua-logo qr-quiz-img">`;
                                    }
                });
            }

            nextQuestion() {
                const that = this;
                const questionId = this.items[this.answers.length]?.id;
                document.querySelectorAll('.quiz-video').forEach(function (item, index) {
                    item.muted = true;
                });
                if (!questionId) { // если этот вопрос не существует, то скрываем все и показываем результат
                    document.querySelectorAll('.quiz-question').forEach(function (item, index) {
                        item.style.display = 'none';
                    });
                    this.showResult();
                    clearInterval(this.interval);
                    return;
                }
                if (this.answers.length === this.items.length - 1) {
                    document.querySelector(`.quiz-question[data-id="${questionId}"] .quiz-next`).textContent = 'Завершить опрос';
                }
                if (!this.answers.length) {
                    document.querySelectorAll('.quiz-question').forEach(function (item, index) {
                        item.style.display = 'none';
                    });
                    if (document.querySelector(`.quiz-question[data-id="${questionId}"]`) !== null) {
                        document.querySelector(`.quiz-question[data-id="${questionId}"]`).style.display = 'block';
                        setTimeout(function () {
                            document.querySelector(`.quiz-question[data-id="${questionId}"] video`).muted = false;
                        }, 100);
                        that.resetTimer(questionId);
                    }
                } else {
                    document.querySelectorAll('.quiz-question').forEach(function (item, index) {
                        item.style.display = 'none';
                    });
                    if (document.querySelector(`.quiz-question[data-id="${questionId}"]`) !== null) {
                        document.querySelector(`.quiz-question[data-id="${questionId}"]`).style.display = 'block';
                        setTimeout(function () {
                            document.querySelector(`.quiz-question[data-id="${questionId}"] video`).muted = false;
                        }, 100);
                        that.resetTimer(questionId);
                    }
                }
            }
        }
    const data = JSON.parse({!! json_encode($questions,JSON_THROW_ON_ERROR) !!});

let quiz = new Quiz(data);
quiz.init();

document.addEventListener('click', function (e) {
    if (e.target.closest('.quiz-ul')) {
        let questionId = e.target.getAttribute('data-question-id');
        let answerId = e.target.getAttribute('data-id');
        quiz.checkAnswer(questionId, answerId);
    }
});

    </script>
@endsection
