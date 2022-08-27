<?php
session_start();
if(!isset($_SESSION['uname']))
  header('location:home.php');
$con=mysqli_connect('localhost','root');

//connecting to the database
mysqli_select_db($con,'timer'); //the second parameter is name of the database
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Attempting again</title>
    <link rel="stylesheet" href="newstyle.css">
    <script src="jquery.js"></script>

  </head>
  <body>
    <div id="bg">
      <br>
    <h2><?php echo $_SESSION['uname']; ?>, let's play!</h2>
    <h3><a href="logout.php">Logout</a></h3>
    <div id="container">
        <div id="start">Start Quiz!</div>
        <div id="quiz" style="display: none">
            <div id="timecontain">
            <div id="qImg">Time:</div>
            <div id="timer">
                <div id="counter"></div>
                <div id="btimeGauge"></div>
                <div id="timeGauge"></div>
            </div>
          </div>
            <div id="qcontain">
            <div id="question"></div>

            <div id="choices">
                  <div class="choice" id="A" onclick="checkAnswer('A')"></div>
                  <div class="choice" id="B" onclick="checkAnswer('B')"></div>
                  <div class="choice" id="C" onclick="checkAnswer('C')"></div>
            </div>
          </div>


            <div id="progress"></div>
        </div>
        	<div id="scoreContainer" style="display: none"></div>
    </div>

  </div>
    </body>

    <script type="text/javascript">

        const start=document.getElementById("start");
        const quiz=document.getElementById("quiz");
        const question=document.getElementById("question");
        const qImg=document.getElementById("qImg");
        const choiceA=document.getElementById("A");
        const choiceB=document.getElementById("B");
        const choiceC=document.getElementById("C");
        const counter=document.getElementById("counter");
        const timeGauge=document.getElementById("timeGauge");
        const progress=document.getElementById("progress");
        const scoreDiv=document.getElementById("scoreContainer");



        <?php
            $nq="select count(*) from questions";
            $query2=mysqli_query($con,$nq);
            $total=mysqli_fetch_array($query2);

        ?>

        const lastQuestion=<?php echo $total['count(*)']; ?>;
        var runningQuestion=1;
        var right=0;
        var wrong=0;

        var correct;
        start.addEventListener("click",startQuiz);
        function startQuiz()
        {

          start.style.display="none";

          quiz.style.display="block";
          renderQuestion();
          renderProgress();
          renderCounter();
          TIMER=setInterval(renderCounter,1000);


        }


        function renderQuestion()
        {
          $(document).ready(function()
          {
             $.ajax({
                      url:"process.php",
                      method:"POST",
                      data:{runningQuestion},
                      dataType:"JSON",
                      success:function(data)
                             {
                                $('#question').text(data.ques);
                                console.log(data.ques);
                                $('#A').text(data.a);
                                $('#B').text(data.b);
                                $('#C').text(data.c);
                                correct=data.rightans;
                                console.log(correct);
                             }
                   })
          });
        }





        function renderProgress()
        {
          for(let qIndex=1;qIndex<=lastQuestion;qIndex++)
          {
            progress.innerHTML+="<div class='prog'id="+qIndex +"></div>";
          }
        }
        //RenderCounter related variables
        let count=0;

        const questionTime=10; //10sec
        const gaugeWidth=150; //150px
        const gaugeUnit= gaugeWidth/questionTime;
        let TIMER;
        let score=0;
        function renderCounter()
        {
          if(count<=questionTime)
          {
            counter.innerHTML=count;
            timeGauge.style.width=count*gaugeUnit+"px";
            count++;

          }
          else
          {
            count=0;
            answerIsWrong();
            if(runningQuestion<lastQuestion)
            {
              runningQuestion++;
              renderQuestion();
            }
            else
            {
              //end the quiz and show the score
              clearInterval(TIMER);
              scoreRender();
            }
          }
        }
        function checkAnswer(answer)
        {
          if(answer==correct)
          {
            score++;
            //changes progress color to green
            answerIsCorrect();
          }
          else
          {
            //answer is wrong
            //changes color to red
            answerIsWrong();
          }
          count=0;
          if(runningQuestion<lastQuestion)
          {
            runningQuestion++;
            renderQuestion();
          }
          else
          {
            //end the quiz and show the score
            clearInterval(TIMER);
            scoreRender();
          }

        }
        function answerIsCorrect()
        {
          document.getElementById(runningQuestion).style.backgroundColor="#0f0";
          right++;
        }
        function answerIsWrong()
        {
          document.getElementById(runningQuestion).style.backgroundColor="#f00";
          wrong++;
        }

        function scoreRender()
        {
        	scoreDiv.style.display="block";

        	//calculate the percentage
        	const scorePerCent=Math.round(100*score/lastQuestion);

        	//choose image as per score
        	let img=(scorePerCent>=80)?"5.png":
        			(scorePerCent>=60)?"4.png":
        			(scorePerCent>=40)?"3.png":
        			(scorePerCent>=20)?"2.png":"1.png";
        	scoreDiv.innerHTML="<img src="+img+">";
          scoreDiv.innerHTML+="<p>"+scorePerCent+"%"+"<br>Right Answers:"+right+"<br>Wrong Answers:"+wrong+"</p";



          $(document).ready(function(){
                  $.ajax({
                        url:"score.php",
                        method:"POST",
                        data:{scorePerCent}

                       })


            });

        }


    </script>
</html>
