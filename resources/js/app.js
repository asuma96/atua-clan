import './bootstrap';

let questions = {
    "data": [
        {
            "id": 3,
            "file": "YelawolfxCaskeyBeenAProblemmobclip.net",
            "text": "TTM",
            "answers": {
                "9": {
                    "id": 9,
                    "question_id": 3,
                    "answer": "superpowers",
                    "right_answer": 1
                },
                "10": {
                    "id": 10,
                    "question_id": 3,
                    "answer": "lazy boy",
                    "right_answer": 0
                },
                "11": {
                    "id": 11,
                    "question_id": 3,
                    "answer": "vrubel",
                    "right_answer": 0
                },
                "12": {
                    "id": 12,
                    "question_id": 3,
                    "answer": "no letters",
                    "right_answer": 0
                }
            }
        },
        {
            "id": 1,
            "file": "AKIMATO80sn90ssnip.mp4",
            "text": "1",
            "answers": {
                "1": {
                    "id": 1,
                    "question_id": 1,
                    "answer": "TTM",
                    "right_answer": 1
                },
                "2": {
                    "id": 2,
                    "question_id": 1,
                    "answer": "Thundra",
                    "right_answer": 0
                },
                "3": {
                    "id": 3,
                    "question_id": 1,
                    "answer": "I neva go hard",
                    "right_answer": 0
                },
                "4": {
                    "id": 4,
                    "question_id": 1,
                    "answer": "Пустошь",
                    "right_answer": 0
                }
            }
        },
        {
            "id": 2,
            "file": "CJWHOOPTYmobclip.net",
            "text": "TTM",
            "answers": {
                "5": {
                    "id": 5,
                    "question_id": 2,
                    "answer": "aggregator-create",
                    "right_answer": 1
                },
                "6": {
                    "id": 6,
                    "question_id": 2,
                    "answer": "aggregator-create",
                    "right_answer": 0
                },
                "7": {
                    "id": 7,
                    "question_id": 2,
                    "answer": "Metal birds",
                    "right_answer": 0
                },
                "8": {
                    "id": 8,
                    "question_id": 2,
                    "answer": "tha-namez",
                    "right_answer": 0
                }
            }
        },
        {
            "id": 4,
            "file": "AKIMATO80sn90ssnip.mp4",
            "text": "test",
            "answers": {"5": {
                    "id": 5,
                    "question_id": 4,
                    "answer": "aggregator-create",
                    "right_answer": 1
                },
                "6": {
                    "id": 6,
                    "question_id": 4,
                    "answer": "aggregator-create",
                    "right_answer": 0
                },
                "7": {
                    "id": 7,
                    "question_id": 4,
                    "answer": "Metal birds",
                    "right_answer": 0
                },
                "8": {
                    "id": 8,
                    "question_id": 4,
                    "answer": "tha-namez",
                    "right_answer": 0
                }}
        }
    ],
    "meta": {
        "pagination": {
            "total": 4,
            "count": 4,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": {}
        }
    }
};

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
                }, 3000);
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
                if (!that.answers.filter(function (item) {
                    return item.id == questionId;
                }).length) {
                    that.answers.push({id: questionId, correct: correct});
                }
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
                }, 3000);
            }
        });
    }

    showResult() {
        const result = document.createElement('div');
        result.classList.add('quiz-result');
        result.innerText = `Вы ответили правильно на ${this.answers.filter(function (item) {return item.correct}).length}/${this.items.length} вопросов`;
        document.querySelector('.quiz-list').appendChild(result);
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

let quiz = new Quiz(questions);
quiz.createQuestions();

document.addEventListener('click', function (e) {
    if (e.target.closest('.quiz-ul')) {
        let questionId = e.target.getAttribute('data-question-id');
        let answerId = e.target.getAttribute('data-id');
        quiz.checkAnswer(questionId, answerId);
    }
});
