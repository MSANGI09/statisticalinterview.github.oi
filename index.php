<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics Interview Simulator</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px;
            background-color: #f8f9fa;
        }
        .question-card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .feedback {
            margin-top: 10px;
            padding: 15px;
            border-radius: 5px;
            display: none;
        }
        .video-container {
            display: none;
            margin-top: 10px;
        }
        video {
            width: 100%;
            background-color: #000;
        }
        #results {
            display: none;
            margin-top: 40px;
        }
        .progress {
            height: 25px;
        }
        #interviewComplete {
            display: none;
            margin-top: 20px;
        }
        .timer {
            font-size: 1.2rem;
            font-weight: bold;
            color: #495057;
        }
        .answer-option {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="display-4">M/S StatisticalInterview Simulator</h1>
                <p class="lead">Practice answering common statistics interview questions</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Instructions</h5>
                        <p>This simulator will present 10 common statistics interview questions one at a time.</p>
                        <p>You can choose to answer via text or record a video response for each question.</p>
                        <p>After answering, you'll receive feedback on your response.</p>
                        <p>Complete all questions to see your overall performance.</p>
                        <button id="startBtn" class="btn btn-primary btn-lg w-100">Start Interview</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="interviewSection" class="row" style="display: none;">
            <div class="col-lg-8 offset-lg-2">
                <div class="card question-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span id="questionCounter">Question 1/10</span>
                        <span class="timer" id="timer">02:00</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title" id="question">Question text will appear here</h5>
                        
                        <div class="mt-3">
                            <div class="btn-group w-100 mb-3" role="group">
                                <button id="textAnswerBtn" class="btn btn-outline-primary active">Text Answer</button>
                                <button id="videoAnswerBtn" class="btn btn-outline-primary">Video Answer</button>
                            </div>
                        </div>
                        
                        <!-- Text Answer Section -->
                        <div id="textAnswerSection">
                            <textarea id="textAnswer" class="form-control" rows="6" placeholder="Type your answer here..."></textarea>
                        </div>
                        
                        <!-- Video Answer Section -->
                        <div id="videoAnswerSection" class="video-container">
                            <div class="text-center mb-2">
                                <button id="startRecordingBtn" class="btn btn-danger">Start Recording</button>
                                <button id="stopRecordingBtn" class="btn btn-secondary" style="display: none;">Stop Recording</button>
                            </div>
                            <video id="videoPreview" autoplay muted></video>
                            <div id="recordingStatus" class="small text-muted text-center mt-1">Press 'Start Recording' when ready</div>
                        </div>
                        
                        <button id="submitAnswer" class="btn btn-success w-100 mt-3">Submit Answer</button>
                        
                        <div id="feedback" class="feedback mt-3">
                            <h5>Feedback:</h5>
                            <div id="feedbackContent"></div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <span class="fw-bold">Score: </span>
                                    <span id="scoreValue">0</span>/10
                                </div>
                                <button id="nextQuestion" class="btn btn-primary">Next Question</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="interviewComplete" class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">Interview Complete!</h3>
                        <p class="lead">Thank you for completing the statistics interview simulation.</p>
                        <button id="viewResultsBtn" class="btn btn-primary btn-lg">View Results</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="results" class="row mt-4">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Interview Results</h3>
                    </div>
                    <div class="card-body">
                        <h4 class="text-center mb-4">Overall Performance</h4>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5>Total Score</h5>
                                        <h2 id="totalScore">0/100</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5>Performance Level</h5>
                                        <h2 id="performanceLevel">Beginner</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <h4 class="mb-3">Performance by Category</h4>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Statistical Concepts</span>
                                <span id="conceptsScore">0%</span>
                            </div>
                            <div class="progress">
                                <div id="conceptsProgress" class="progress-bar" role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Statistical Methods</span>
                                <span id="methodsScore">0%</span>
                            </div>
                            <div class="progress">
                                <div id="methodsProgress" class="progress-bar" role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Data Analysis</span>
                                <span id="analysisScore">0%</span>
                            </div>
                            <div class="progress">
                                <div id="analysisProgress" class="progress-bar" role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Problem Solving</span>
                                <span id="problemSolvingScore">0%</span>
                            </div>
                            <div class="progress">
                                <div id="problemSolvingProgress" class="progress-bar" role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="d-flex justify-content-between">
                                <span>Communication</span>
                                <span id="communicationScore">0%</span>
                            </div>
                            <div class="progress">
                                <div id="communicationProgress" class="progress-bar" role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>
                        
                        <h4 class="mb-3">Detailed Question Review</h4>
                        <div id="questionReview" class="accordion">
                            <!-- Question reviews will be inserted here -->
                        </div>
                        
                        <div class="mt-4">
                            <h4>Areas for Improvement</h4>
                            <ul id="improvementAreas" class="list-group">
                                <!-- Improvement areas will be inserted here -->
                            </ul>
                        </div>
                        
                        <div class="mt-4 text-center">
                            <button id="restartBtn" class="btn btn-primary btn-lg">Restart Interview</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
      // Interview questions with model answers and categories
const questions = [
{
    question: "Explain the difference between a population and a sample. When would you use one over the other?",
    modelAnswer: "A population includes all members of a defined group that we're studying, while a sample is a subset of the population. We use samples when studying the entire population is impractical due to size, cost, or time constraints. Samples are used to make inferences about the population, but they must be representative to avoid bias. Population studies are preferred when the population is small, accessible, and when extremely high precision is required.",
    category: "Statistical Concepts",
    keyPoints: [
        "Definition of population vs. sample",
        "Reasons for using samples (cost, time, practicality)",
        "Importance of representative samples",
        "When to use population studies"
    ]
},
{
    question: "What's the difference between Type I and Type II errors? How would you explain the trade-off between them?",
    modelAnswer: "Type I error (false positive) occurs when we incorrectly reject a true null hypothesis. Type II error (false negative) happens when we fail to reject a false null hypothesis. The trade-off between these errors is inverse - decreasing one typically increases the other. This trade-off is managed by setting the significance level (alpha). A lower alpha reduces Type I errors but increases Type II errors. The choice depends on which error is more costly in a specific context, such as preferring false positives in medical screening but avoiding them in criminal justice.",
    category: "Statistical Concepts",
    keyPoints: [
        "Definition of Type I (false positive) and Type II (false negative) errors",
        "Inverse relationship between the two errors",
        "Role of significance level (alpha) in determining error rates",
        "Context-dependent nature of which error is more important"
    ]
},
{
    question: "Explain the Central Limit Theorem and its practical importance in statistics.",
    modelAnswer: "The Central Limit Theorem states that regardless of the original population distribution, the sampling distribution of the sample means will approximate a normal distribution as the sample size increases. This is crucial because it allows us to use normal distribution methods even when working with non-normal data if we're dealing with sample means. Practically, it enables inferential statistics like confidence intervals and hypothesis tests without knowing the true population distribution. Generally, a sample size of 30 or more is considered sufficient for the CLT to apply, though this can vary based on how skewed the original distribution is.",
    category: "Statistical Concepts",
    keyPoints: [
        "Definition of the Central Limit Theorem",
        "Independence from original population distribution",
        "Relationship between sample size and normal approximation",
        "Practical applications in statistical inference"
    ]
},
{
    question: "How would you explain the concept of p-value to someone without a statistics background?",
    modelAnswer: "A p-value is the probability of observing results at least as extreme as what we found, assuming the null hypothesis is true. In simpler terms, it measures how surprising our data would be if there were truly no effect or difference. A small p-value (typically below 0.05) suggests that our observed results would be unlikely under the null hypothesis, giving us reason to reject it. However, it's important to note that p-values don't tell us the probability that the null hypothesis is true or false, nor do they indicate the size or importance of an effect. They simply quantify the evidence against the null hypothesis based on our data.",
    category: "Statistical Concepts",
    keyPoints: [
        "Definition in simple, non-technical language",
        "Relationship to null hypothesis",
        "Interpretation of small vs. large p-values",
        "Common misconceptions about p-values"
    ]
},
{
    question: "Describe the difference between correlation and causation with a real-world example.",
    modelAnswer: "Correlation measures the statistical relationship between two variables, indicating how they tend to move together, while causation means one variable directly influences or causes changes in another. A classic example is the correlation between ice cream sales and drowning deaths, which both increase during summer months. While these variables are correlated, ice cream sales don't cause drownings; instead, both are influenced by a third factor: warm weather. To establish causation, we need additional evidence beyond correlation, such as controlled experiments, time sequence confirmation (cause precedes effect), ruling out alternative explanations, and supporting theoretical mechanisms.",
    category: "Statistical Concepts",
    keyPoints: [
        "Clear definitions of correlation and causation",
        "Compelling real-world example",
        "Explanation of confounding variables",
        "Methods to establish causation beyond correlation"
    ]
},
{
    question: "How would you handle missing data in a dataset? What different approaches exist and when would you use each?",
    modelAnswer: "Handling missing data involves several approaches: 1) Complete case analysis (listwise deletion) removes observations with any missing values, which is simple but can introduce bias and reduce sample size; 2) Imputation methods replace missing values with estimated ones, such as mean/median imputation (for MCAR data), regression imputation (predicting missing values), or multiple imputation (creating several complete datasets); 3) Maximum likelihood methods use all available data to estimate parameters; 4) Incorporating missingness as a feature through indicator variables. The choice depends on the missingness mechanism (MCAR, MAR, or MNAR), sample size, proportion of missing data, and the specific analysis goals. For critical analyses, sensitivity analysis using different methods is recommended to ensure robust conclusions.",
    category: "Data Analysis",
    keyPoints: [
        "Description of multiple approaches (deletion, imputation, etc.)",
        "Types of missing data mechanisms (MCAR, MAR, MNAR)",
        "Pros and cons of different methods",
        "Consideration of context in method selection"
    ]
},
{
    question: "Explain the bias-variance tradeoff in statistical modeling.",
    modelAnswer: "The bias-variance tradeoff is a fundamental concept in statistical modeling that balances two sources of error. Bias represents systematic error from oversimplified models that miss important patterns in the data. Variance represents model sensitivity to random fluctuations in training data. High-bias models (like linear regression) are too simple and underfit the data, while high-variance models (like complex decision trees) are too flexible and overfit. The goal is to find the optimal complexity that minimizes total error. Techniques to manage this tradeoff include regularization (penalizing complexity), cross-validation (for model selection), ensemble methods (combining models), and gathering more training data (which primarily reduces variance).",
    category: "Statistical Methods",
    keyPoints: [
        "Clear definition of bias and variance components",
        "Relationship to model complexity and overfitting/underfitting",
        "Total error as the sum of bias, variance, and irreducible error",
        "Techniques to optimize the tradeoff"
    ]
},
{
    question: "You're analyzing the effectiveness of a new marketing campaign. What statistical tests might you use and why?",
    modelAnswer: "For analyzing a marketing campaign's effectiveness, I'd use several tests depending on the specific metrics: 1) For before/after comparison of continuous outcomes (like sales or revenue), paired t-tests or Wilcoxon signed-rank tests; 2) For comparing control vs. treatment groups, independent t-tests or Mann-Whitney U tests; 3) For conversion rates or other proportions, chi-square tests or Fisher's exact test; 4) For relationships between campaign exposure and customer characteristics, correlation analysis or regression models; 5) For time-series data, interrupted time series analysis or ARIMA models to account for trends and seasonality. For proper causal inference, A/B testing would be ideal, randomly assigning customers to treatment/control groups. I'd also consider multiple testing corrections if analyzing many metrics, and ensure adequate sample sizes for reliable statistical power.",
    category: "Statistical Methods",
    keyPoints: [
        "Identification of appropriate tests for different metrics",
        "Consideration of experiment design (A/B testing)",
        "Discussion of parametric vs. non-parametric approaches",
        "Mention of statistical power and sample size considerations"
    ]
},
{
    question: "In a classification problem, when would you choose precision over recall, or vice versa?",
    modelAnswer: "The choice between optimizing for precision or recall depends on the consequences of different types of errors in your specific context. Precision measures the proportion of positive predictions that are actually positive, while recall measures the proportion of actual positives that were correctly identified. You would prioritize precision when false positives are more costly than false negatives, such as in spam detection (where marking legitimate emails as spam is particularly problematic) or in recommender systems (where irrelevant recommendations damage user trust). Conversely, you would prioritize recall when false negatives are more costly, such as in medical screening (where missing a disease is worse than a false alarm) or fraud detection (where missing fraudulent transactions is very expensive). Often, the F1-score provides a balanced measure when both types of errors matter, or you can use the F-beta score to weight precision and recall according to their relative importance in your application.",
    category: "Data Analysis",
    keyPoints: [
        "Clear definitions of precision and recall",
        "Business contexts where each metric matters more",
        "Specific examples for each scenario",
        "Discussion of F1 and other balanced measures"
    ]
},
{
    question: "If you were given a dataset to analyze, what would be your first steps?",
    modelAnswer: "My first steps in analyzing a new dataset would be: 1) Understand the context and objectives by clarifying the business problem, key questions, and how results will be used; 2) Perform data exploration through summary statistics, checking data types, distributions, missing values, and outliers; 3) Create visualizations like histograms, scatter plots, and correlation matrices to understand relationships; 4) Clean the data by handling missing values, outliers, and inconsistencies; 5) Engineer features as needed based on domain knowledge; 6) Form initial hypotheses based on exploration results; 7) Plan the analysis approach by selecting appropriate statistical methods; and 8) Validate assumptions required by those methods. Throughout this process, I would document my findings and decisions, and maintain reproducibility in my workflow. This systematic approach ensures thorough understanding of the data before applying more complex analyses.",
    category: "Problem Solving",
    keyPoints: [
        "Systematic exploration process",
        "Data quality assessment",
        "Visualization approaches",
        "Connection between business context and analysis plan"
    ]
}
];

document.addEventListener('DOMContentLoaded', function() {
// UI Elements
const startBtn = document.getElementById('startBtn');
const interviewSection = document.getElementById('interviewSection');
const questionCounter = document.getElementById('questionCounter');
const questionElement = document.getElementById('question');
const textAnswerBtn = document.getElementById('textAnswerBtn');
const videoAnswerBtn = document.getElementById('videoAnswerBtn');
const textAnswerSection = document.getElementById('textAnswerSection');
const videoAnswerSection = document.getElementById('videoAnswerSection');
const textAnswer = document.getElementById('textAnswer');
const startRecordingBtn = document.getElementById('startRecordingBtn');
const stopRecordingBtn = document.getElementById('stopRecordingBtn');
const videoPreview = document.getElementById('videoPreview');
const recordingStatus = document.getElementById('recordingStatus');
const submitAnswer = document.getElementById('submitAnswer');
const feedback = document.getElementById('feedback');
const feedbackContent = document.getElementById('feedbackContent');
const scoreValue = document.getElementById('scoreValue');
const nextQuestion = document.getElementById('nextQuestion');
const interviewComplete = document.getElementById('interviewComplete');
const viewResultsBtn = document.getElementById('viewResultsBtn');
const results = document.getElementById('results');
const totalScore = document.getElementById('totalScore');
const performanceLevel = document.getElementById('performanceLevel');
const conceptsScore = document.getElementById('conceptsScore');
const methodsScore = document.getElementById('methodsScore');
const analysisScore = document.getElementById('analysisScore');
const problemSolvingScore = document.getElementById('problemSolvingScore');
const communicationScore = document.getElementById('communicationScore');
const conceptsProgress = document.getElementById('conceptsProgress');
const methodsProgress = document.getElementById('methodsProgress');
const analysisProgress = document.getElementById('analysisProgress');
const problemSolvingProgress = document.getElementById('problemSolvingProgress');
const communicationProgress = document.getElementById('communicationProgress');
const questionReview = document.getElementById('questionReview');
const improvementAreas = document.getElementById('improvementAreas');
const restartBtn = document.getElementById('restartBtn');
const timerElement = document.getElementById('timer');

// State variables
let currentQuestionIndex = 0;
let scores = [];
let categoryScores = {
    'Statistical Concepts': [],
    'Statistical Methods': [],
    'Data Analysis': [],
    'Problem Solving': [],
    'Communication': []
};
let answerMode = 'text';
let mediaRecorder;
let recordedChunks = [];
let timerInterval;
let timeLeft = 120; // 2 minutes per question

// Shuffle questions
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

const shuffledQuestions = shuffleArray([...questions]);

// Start interview
startBtn.addEventListener('click', function() {
    document.querySelector('.row.mb-4').style.display = 'none';
    interviewSection.style.display = 'block';
    loadQuestion(currentQuestionIndex);
    startTimer();
});

// Toggle answer mode
textAnswerBtn.addEventListener('click', function() {
    answerMode = 'text';
    textAnswerBtn.classList.add('active');
    videoAnswerBtn.classList.remove('active');
    textAnswerSection.style.display = 'block';
    videoAnswerSection.style.display = 'none';
    stopRecording();
});

videoAnswerBtn.addEventListener('click', function() {
    answerMode = 'video';
    videoAnswerBtn.classList.add('active');
    textAnswerBtn.classList.remove('active');
    videoAnswerSection.style.display = 'block';
    textAnswerSection.style.display = 'none';
    
    // Request camera access
    navigator.mediaDevices.getUserMedia({ video: true, audio: true })
        .then(stream => {
            videoPreview.srcObject = stream;
        })
        .catch(error => {
            console.error('Error accessing media devices:', error);
            recordingStatus.textContent = 'Error: Could not access camera. Please check permissions.';
            recordingStatus.style.color = 'red';
        });
});

// Recording functionality
startRecordingBtn.addEventListener('click', function() {
    startRecording();
});

stopRecordingBtn.addEventListener('click', function() {
    stopRecording();
});

function startRecording() {
    recordedChunks = [];
    const stream = videoPreview.srcObject;
    if (!stream) return;
    
    mediaRecorder = new MediaRecorder(stream);
    
    mediaRecorder.ondataavailable = function(e) {
        if (e.data.size > 0) {
            recordedChunks.push(e.data);
        }
    };
    
    mediaRecorder.onstop = function() {
        const blob = new Blob(recordedChunks, { type: 'video/webm' });
        const url = URL.createObjectURL(blob);
        videoPreview.srcObject = null;
        videoPreview.src = url;
        videoPreview.controls = true;
    };
    
    mediaRecorder.start();
    startRecordingBtn.style.display = 'none';
    stopRecordingBtn.style.display = 'inline-block';
    recordingStatus.textContent = 'Recording in progress...';
    recordingStatus.style.color = 'red';
}

function stopRecording() {
    if (mediaRecorder && mediaRecorder.state !== 'inactive') {
        mediaRecorder.stop();
        stopRecordingBtn.style.display = 'none';
        startRecordingBtn.style.display = 'inline-block';
        startRecordingBtn.textContent = 'Record Again';
        recordingStatus.textContent = 'Recording completed. You can record again or submit.';
        recordingStatus.style.color = 'green';
    }
}

// Submit answer
submitAnswer.addEventListener('click', function() {
    clearInterval(timerInterval);
    let answer = '';
    
    if (answerMode === 'text') {
        answer = textAnswer.value.trim();
        if (answer === '') {
            alert('Please provide an answer before submitting.');
            return;
        }
    } else {
        // For video answers, we would normally process the video or store it
        // Here we'll just check if there's a recording
        if (recordedChunks.length === 0 && videoPreview.src === '') {
            alert('Please record a video answer before submitting.');
            return;
        }
        answer = "Video answer provided";
    }
    
    evaluateAnswer(answer);
    submitAnswer.disabled = true;
});

// Next question
nextQuestion.addEventListener('click', function() {
    currentQuestionIndex++;
    
    if (currentQuestionIndex < shuffledQuestions.length) {
        loadQuestion(currentQuestionIndex);
        feedback.style.display = 'none';
        submitAnswer.disabled = false;
        textAnswer.value = '';
        
        // Reset video if needed
        if (videoPreview.srcObject) {
            const tracks = videoPreview.srcObject.getTracks();
            tracks.forEach(track => track.stop());
        }
        videoPreview.srcObject = null;
        videoPreview.src = '';
        videoPreview.controls = false;
        recordedChunks = [];
        startRecordingBtn.textContent = 'Start Recording';
        recordingStatus.textContent = 'Press \'Start Recording\' when ready';
        recordingStatus.style.color = '';
        
        // Reset to text answer mode
        textAnswerBtn.click();
        
        // Reset timer
        timeLeft = 120;
        updateTimerDisplay();
        startTimer();
    } else {
        interviewSection.style.display = 'none';
        interviewComplete.style.display = 'block';
    }
});

// View results
viewResultsBtn.addEventListener('click', function() {
    displayResults();
    interviewComplete.style.display = 'none';
    results.style.display = 'block';
});

// Restart interview
restartBtn.addEventListener('click', function() {
    currentQuestionIndex = 0;
    scores = [];
    
    categoryScores = {
        'Statistical Concepts': [],
        'Statistical Methods': [],
        'Data Analysis': [],
        'Problem Solving': [],
        'Communication': []
    };
    
    results.style.display = 'none';
    shuffleArray(shuffledQuestions);
    loadQuestion(currentQuestionIndex);
    interviewSection.style.display = 'block';
    feedback.style.display = 'none';
    submitAnswer.disabled = false;
    textAnswer.value = '';
    
    // Reset timer
    timeLeft = 120;
    updateTimerDisplay();
    startTimer();
});

// Timer functionality
function startTimer() {
    timerInterval = setInterval(function() {
        timeLeft--;
        updateTimerDisplay();
        
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            alert("Time's up! Please submit your answer.");
        }
    }, 1000);
}

function updateTimerDisplay() {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    
    if (timeLeft <= 30) {
        timerElement.style.color = 'red';
    } else {
        timerElement.style.color = '';
    }
}

// Load question
function loadQuestion(index) {
    questionCounter.textContent = `Question ${index + 1}/${shuffledQuestions.length}`;
    questionElement.textContent = shuffledQuestions[index].question;
}

// Evaluate answer
function evaluateAnswer(answer) {
    const currentQuestion = shuffledQuestions[currentQuestionIndex];
    const modelAnswer = currentQuestion.modelAnswer;
    const keyPoints = currentQuestion.keyPoints;
    const category = currentQuestion.category;
    
    // Evaluate the answer
    const score = evaluateResponse(answer, modelAnswer, keyPoints);
    
    // Add communication score for all answers
    const communicationScore = Math.min(10, Math.max(1, score + (Math.random() > 0.7 ? 1 : -1)));
    
    // Store scores
    scores.push(score);
    categoryScores[category].push(score);
    categoryScores['Communication'].push(communicationScore);
    
    // Generate feedback
    const feedbackHTML = generateFeedback(answer, modelAnswer, keyPoints, score);
    feedbackContent.innerHTML = feedbackHTML;
    
    scoreValue.textContent = score;
    feedback.style.display = 'block';
    
    // Apply appropriate color to feedback
    if (score >= 8) {
        feedback.className = 'feedback bg-success text-white';
    } else if (score >= 5) {
        feedback.className = 'feedback bg-warning';
    } else {
        feedback.className = 'feedback bg-danger text-white';
    }
}

// Generate feedback
function generateFeedback(answer, modelAnswer, keyPoints, score) {
    let feedback = '';
    
    // General assessment based on score
    if (score >= 8) {
        feedback += '<p><strong>Excellent answer!</strong> You covered most key points effectively.</p>';
    } else if (score >= 5) {
        feedback += '<p><strong>Good answer!</strong> You addressed several important points but missed some key aspects.</p>';
    } else {
        feedback += '<p><strong>Your answer needs improvement.</strong> Several key points were missing or incorrect.</p>';
    }
    
    // Key points comparison
    feedback += '<h6 class="mt-3">Key Points to Include:</h6>';
    feedback += '<ul>';
    
    for (const point of keyPoints) {
        const pointIncluded = isPointCovered(answer, point);
        if (pointIncluded) {
            feedback += `<li class="text-success">✓ ${point}</li>`;
        } else {
            feedback += `<li class="text-danger">✗ ${point}</li>`;
        }
    }
    
    feedback += '</ul>';
    
    // Model answer
    feedback += '<h6 class="mt-3">Model Answer:</h6>';
    feedback += `<p>${modelAnswer}</p>`;
    
    return feedback;
}

// Check if a key point is covered in the answer
function isPointCovered(answer, point) {
    // Simple keyword matching - this would be more sophisticated in a real application
    const keywords = extractKeywords(point);
    let coveredCount = 0;
    
    for (const keyword of keywords) {
        if (answer.toLowerCase().includes(keyword.toLowerCase())) {
            coveredCount++;
        }
    }
    
    // Consider the point covered if at least 60% of keywords are found
    return coveredCount >= Math.ceil(keywords.length * 0.6);
}

// Extract keywords from a key point
function extractKeywords(point) {
    // Remove common words and extract meaningful terms
    const commonWords = ['the', 'a', 'an', 'and', 'or', 'but', 'of', 'to', 'in', 'for', 'with', 'on', 'at', 'by', 'from', 'about'];
    
    return point.split(' ')
        .filter(word => word.length > 3 || !isNaN(word))
        .filter(word => !commonWords.includes(word.toLowerCase()))
        .map(word => word.replace(/[.,;:()]/g, ''));
}

// Evaluate response against model answer and key points
function evaluateResponse(answer, modelAnswer, keyPoints) {
    if (!answer || answer.trim() === '') return 0;
    
    // Count covered key points
    let coveredPoints = 0;
    for (const point of keyPoints) {
        if (isPointCovered(answer, point)) {
            coveredPoints++;
        }
    }
    
    // Calculate score based on percentage of covered points
    const pointsScore = Math.round((coveredPoints / keyPoints.length) * 10);
    
    // Add some randomness to simulate realistic scoring (+/- 1 point)
    const finalScore = Math.min(10, Math.max(0, pointsScore + (Math.random() > 0.5 ? 1 : -1)));
    
    return finalScore;
}

// Display final results
function displayResults() {
    // Calculate overall score
    const overallScore = Math.round(scores.reduce((sum, score) => sum + score, 0) / scores.length * 10);
    totalScore.textContent = `${overallScore}/100`;
    
    // Determine performance level
    let performance = '';
    if (overallScore >= 90) {
        performance = 'Expert';
        performanceLevel.style.color = '#28a745';
    } else if (overallScore >= 80) {
        performance = 'Advanced';
        performanceLevel.style.color = '#20c997';
    } else if (overallScore >= 70) {
        performance = 'Proficient';
        performanceLevel.style.color = '#17a2b8';
    } else if (overallScore >= 60) {
        performance = 'Intermediate';
        performanceLevel.style.color = '#fd7e14';
    } else {
        performance = 'Beginner';
        performanceLevel.style.color = '#dc3545';
    }
    
    performanceLevel.textContent = performance;
    
    // Calculate category scores
    const categories = Object.keys(categoryScores);
    for (const category of categories) {
        const scores = categoryScores[category];
        if (scores.length > 0) {
            const avgScore = Math.round(scores.reduce((sum, score) => sum + score, 0) / scores.length * 10);
            const scoreElement = document.getElementById(`${camelCase(category)}Score`);
            const progressElement = document.getElementById(`${camelCase(category)}Progress`);
            
            if (scoreElement && progressElement) {
                scoreElement.textContent = `${avgScore}%`;
                progressElement.style.width = `${avgScore}%`;
                
                // Set progress bar color
                if (avgScore >= 80) {
                    progressElement.className = 'progress-bar bg-success';
                } else if (avgScore >= 60) {
                    progressElement.className = 'progress-bar bg-warning';
                } else {
                    progressElement.className = 'progress-bar bg-danger';
                }
            }
        }
    }
    
    // Generate question-by-question review
    questionReview.innerHTML = '';
    
    shuffledQuestions.forEach((question, index) => {
        const score = scores[index];
        const scoreClass = score >= 8 ? 'text-success' : (score >= 5 ? 'text-warning' : 'text-danger');
        
        const questionItem = document.createElement('div');
        questionItem.className = 'accordion-item';
        questionItem.innerHTML = `
            <h2 class="accordion-header" id="heading${index}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${index}" aria-expanded="false" aria-controls="collapse${index}">
                    <div class="d-flex justify-content-between w-100">
                        <span>Question ${index + 1}: ${question.question.substring(0, 50)}...</span>
                        <span class="${scoreClass} fw-bold ms-2">Score: ${score}/10</span>
                    </div>
                </button>
            </h2>
            <div id="collapse${index}" class="accordion-collapse collapse" aria-labelledby="heading${index}">
                <div class="accordion-body">
                    <p><strong>Question:</strong> ${question.question}</p>
                    <p><strong>Category:</strong> ${question.category}</p>
                    <div class="card mb-3">
                        <div class="card-header">Model Answer</div>
                        <div class="card-body">
                            <p>${question.modelAnswer}</p>
                        </div>
                    </div>
                    <h6>Key Points:</h6>
                    <ul>
                        ${question.keyPoints.map(point => `<li>${point}</li>`).join('')}
                    </ul>
                </div>
            </div>
        `;
        
        questionReview.appendChild(questionItem);
    });
    
    // Generate improvement areas
    improvementAreas.innerHTML = '';
    
    // Find weakest categories
    const categoriesWithScores = categories.map(category => {
        const scores = categoryScores[category];
        const avgScore = scores.length > 0 ? 
            scores.reduce((sum, score) => sum + score, 0) / scores.length : 0;
        return { category, avgScore };
    }).sort((a, b) => a.avgScore - b.avgScore);
    
    // Add improvement areas based on weakest categories
    categoriesWithScores.slice(0, 3).forEach(({ category, avgScore }) => {
        if (avgScore < 7) {
            const item = document.createElement('li');
            item.className = 'list-group-item';
            
            let advice = '';
            switch (category) {
                case 'Statistical Concepts':
                    advice = 'Review fundamental statistical concepts like probability distributions, hypothesis testing, and sampling methods.';
                    break;
                case 'Statistical Methods':
                    advice = 'Practice applying different statistical tests and techniques to various problem scenarios.';
                    break;
                case 'Data Analysis':
                    advice = 'Strengthen your ability to clean, transform, and extract insights from data sets.';
                    break;
                case 'Problem Solving':
                    advice = 'Work on approaching statistical problems systematically and selecting appropriate methods for different scenarios.';
                    break;
                case 'Communication':
                    advice = 'Improve your ability to explain statistical concepts and results clearly to non-technical audiences.';
                    break;
            }
            
            item.innerHTML = `<strong>${category}:</strong> ${advice}`;
            improvementAreas.appendChild(item);
        }
    });
    
    // If no categories below threshold, add general improvement note
    if (improvementAreas.children.length === 0) {
        const item = document.createElement('li');
        item.className = 'list-group-item';
        item.innerHTML = 'Great job! Continue practicing with more advanced statistical concepts and real-world applications.';
        improvementAreas.appendChild(item);
    }
}

// Helper function to convert category name to camelCase for ID
function camelCase(str) {
    return str
        .toLowerCase()
        .replace(/[^a-zA-Z0-9]+(.)/g, (_, chr) => chr.toUpperCase());
}
});
    </script>
</body>
</html>
