<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CC Poll</title>
    <meta name="viewport" content="user-scalable=no,initial-scale = 1.0,maximum-scale = 1.0">
    <link rel="stylesheet" type="text/css" href="assets/topcoat/css/topcoat-desktop-light.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <script src="/poll/assets/js/jquery-2.0.3.min.js"></script>
    
    <script>
        $( document ).ready(function() {
          // Handler for .ready() called.
          pollData();
          pollQuestions()
          
          
          
        });

        function pollData(){
            $.ajax({url: "/poll/api/product.php"}).done(processData);
        }
        
        function pollQuestions(){
            $.ajax({url: "/poll/api/question.php"}).done(processQuestion);
        }        
                
        function processData(e) {
            
            var products = jQuery.parseJSON(e);
            var higestVotes = 0;
            
            for (var i = 0; i < products.length; i++ ){
                if (products[i].votes >  higestVotes){
                    higestVotes = products[i].votes;
                }      
            }
            
            
            for (var i = 0; i < products.length; i++ ){
                $productHTML = $("#" + products[i].product);
                var scaleAmount = products[i].votes/ higestVotes;
                $productHTML.css("webkitTransform", "scale(" + scaleAmount + ")");
                console.log(scaleAmount);
            }

            setTimeout(pollData,5000);

        }
        
        function processQuestion(e) {
            
            var questions = jQuery.parseJSON(e);

            $("#questions").html("");   
            for (var i = 0; i < questions.length; i++ ){
                var $content = $("#questions").html();
                var newHTML = '<p class="question">' + questions[i].question + "</p>" ;
                $("#questions").html($content + newHTML);     
            }
            
            
            

            setTimeout(pollQuestions,5000);

        }
        
    </script>
    
    
</head>
<body>



        <h1>Which products are you very familiar with?</h1>
    
        <img id="after_effects" alt="" src="assets/img/after_effects.svg" class="app result-icon" />
        <img id="audition" alt="" src="assets/img/audition.svg" class="app result-icon" />
        <img id="bridge" alt="" src="assets/img/bridge.svg" class="app result-icon" />
        <img id="dreamweaver" alt="" src="assets/img/dreamweaver.svg" class="app result-icon" />
        <img id="encore" alt="" src="assets/img/encore.svg" class="app result-icon" />
        <img id="fireworks" alt="" src="assets/img/fireworks.svg" class="app result-icon" />
        <img id="flash" alt="" src="assets/img/flash.svg" class="app result-icon" />
        <img id="illustrator" alt="" src="assets/img/illustrator.svg" class="app result-icon" />
        <img id="incopy" alt="" src="assets/img/incopy.svg" class="app result-icon" />
        <img id="indesign" alt="" src="assets/img/indesign.svg" class="app result-icon" />
        <img id="lightroom" alt="" src="assets/img/lightroom.svg" class="app result-icon" />
        <img id="media_encoder" alt="" src="assets/img/media_encoder.svg" class="app result-icon" />
        <img id="muse" alt="" src="assets/img/muse.svg" class="app result-icon" />
        <img id="photoshop" alt="" src="assets/img/photoshop.svg" class="app result-icon" />
        <img id="premiere" alt="" src="assets/img/premiere.svg" class="app result-icon" />
        <img id="speedgrade" alt="" src="assets/img/speedgrade.svg" class="app result-icon" />
        <img id="animate" alt="" src="assets/img/animate.svg" class="edge app result-icon" />
        <img id="code" alt="" src="assets/img/code.svg" class="edge app result-icon" />
        <img id="inspect" alt="" src="assets/img/inspect.svg" class="edge app result-icon" />
        <img id="phonegap_build" alt="" src="assets/img/phonegap_build.svg" class="edge app result-icon" />
        <img id="reflow" alt="" src="assets/img/reflow.svg" class="edge app result-icon" />
    
    
       
    
        <h1>What one question do you want answered today?</h1>
        <div id="questions"></div>
    
    
    
    
    
    
</body>
</html>