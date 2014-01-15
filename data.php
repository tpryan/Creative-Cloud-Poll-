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
          pollQuestions();
          pollRole();
          
          
        });

        var barMaxWidth = 300;
        var rolesCreated = false;
        
        function pollData(){
            $.ajax({url: "/poll/api/product.php"}).done(processData);
        }
        
        function pollQuestions(){
            $.ajax({url: "/poll/api/question.php"}).done(processQuestion);
        }  

        function pollRole(){
            $.ajax({url: "/poll/api/role.php"}).done(processRoleData);
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
                var $barToTarget = $(".familiar_" + products[i].product);    
                var scaleAmount = products[i].votes/ higestVotes;
                var newWidth = barMaxWidth * scaleAmount;
                $barToTarget.width(newWidth);
                
            
            }

            setTimeout(pollData,5000);

        }

        function processRoleData(e) {
            console.log("Process Role Data");
            var roles = jQuery.parseJSON(e);
            var higestVotes = 0;

            if (rolesCreated !== true) {
                createRoleHTML(roles);
            }
            
            for (var i = 0; i < roles.length; i++ ){
                if (roles[i].votes >  higestVotes){
                    higestVotes = roles[i].votes;
                }      
            }
            
            
            for (var i = 0; i < roles.length; i++ ){
                var $barToTarget = $("." + roles[i].role);    
                var scaleAmount = roles[i].votes/ higestVotes;
                var newWidth = barMaxWidth * scaleAmount;
                $barToTarget.width(newWidth);


            }

            setTimeout(pollRole,5000);

        }

        function createRoleHTML(roles) {
            var $table = $("#role_results"); 
            var other = "";
            for (var i = 0; i < roles.length; i++ ){
                
                
                var rowHTML = "<tr>";
                rowHTML += "<th>" + formatRole(roles[i].role) + "</th>";
                rowHTML += '<td><div class="bar ' + roles[i].role + '"></div></td>';
                rowHTML += "</tr>";
                
                if (roles[i].role == "other"){
                    other = rowHTML;
                } else {                
                    $table.append(rowHTML);
                } 
            } 
            $table.append(other);
            rolesCreated = true;   
        }
        
        function formatRole(string)
        {
            var no_underscores = string.replace("_", " ");
            var pieces = no_underscores.split(" ");
            for ( var i = 0; i < pieces.length; i++ )
            {
                var j = pieces[i].charAt(0).toUpperCase();
                pieces[i] = j + pieces[i].substr(1);
            }
            return pieces.join(" ");
        }
                
        function processQuestion(e) {
            console.log("Process Question");
            var questions = jQuery.parseJSON(e);

            $("#questions").html("");   
            for (var i = 0; i < questions.length; i++ ){
                var $content = $("#questions").html();
                var newHTML = '<p class="question">' + questions[i].question + "</p>" ;
                $("#questions").append(newHTML);     
            }

            setTimeout(pollQuestions,5000);

        }
        
    </script>
    
    
</head>
<body>

        <h1>What do you consider your self? [Can be more than one.]</h1>
        <table id="role_results">
            
        </table>
        
            
            
            
            
            
            
            
            
        

        <h1>Which products are you very familiar with?</h1>
         
         <table>
            <tr>
                
                <th>After Effects<img id="after_effects" alt="" src="assets/img/after_effects.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_after_effects after_effects"></div></td>
            </tr>
            <tr>
                <th>Audition <img id="audition" alt="" src="assets/img/audition.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_audition audition"></div></td>
            </tr>
            <tr>
                <th>Bridge <img id="bridge" alt="" src="assets/img/bridge.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_bridge bridge"></div></td>
            </tr>
            <tr>
                <th>Dreamweaver <img id="dreamweaver" alt="" src="assets/img/dreamweaver.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_dreamweaver dreamweaver"></div></td>
            </tr>
            <tr>
                <th>Encore <img id="encore" alt="" src="assets/img/encore.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_encore encore"></div></td>
            </tr>
            <tr>
                <th>Fireworks <img id="fireworks" alt="" src="assets/img/fireworks.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_fireworks fireworks"></div></td>
            </tr>
            <tr>
                <th>Flash Professional <img id="flash" alt="" src="assets/img/flash.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_flash flash"></div></td>
            </tr>
            <tr>
                <th>Illustrator <img id="illustrator" alt="" src="assets/img/illustrator.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_illustrator illustrator"></div></td>
            </tr>
            <tr>
                <th>InCopy <img id="incopy" alt="" src="assets/img/incopy.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_incopy incopy"></div></td>
            </tr>
            <tr>
                <th>InDesign <img id="indesign" alt="" src="assets/img/indesign.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_indesign indesign"></div></td>
            </tr>
            <tr>
                <th>Lightroom <img id="lightroom" alt="" src="assets/img/lightroom.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_lightroom lightroom"></div></td>
            </tr>
            <tr>
                <th>Media Encoder <img id="encoder" alt="" src="assets/img/media_encoder.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_encoder encoder"></div></td>
            </tr>
            <tr>
                <th>Muse <img id="muse" alt="" src="assets/img/muse.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_muse muse"></div></td>
            </tr>
            <tr>
                <th>Photoshop <img id="photoshop" alt="" src="assets/img/photoshop.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_photoshop photoshop"></div></td>
            </tr>
            <tr>
                <th>Premiere Pro <img id="premiere" alt="" src="assets/img/premiere.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_premiere premiere"></div></td>
            </tr>
            <tr>
                <th>Speedgrade <img id="speedgrade" alt="" src="assets/img/speedgrade.svg" class="app result-icon" /></th>
                <td><div class="bar familiar_speedgrade speedgrade"></div></td>
            </tr>
            <tr>
                <th>Edge Animate <img id="animate" alt="" src="assets/img/animate.svg" class="edge app result-icon" /></th>
                <td><div class="bar familiar_animate animate"></div></td>
            </tr>
            <tr>
                <th>Edge Code <img id="code" alt="" src="assets/img/code.svg" class="edge app result-icon" /></th>
                <td><div class="bar familiar_code code"></div></td>
            </tr>
            <tr>
                <th>Edge Inspect <img id="inspect" alt="" src="assets/img/inspect.svg" class="edge app result-icon" /></th>
                <td><div class="bar familiar_inspect inspect"></div></td>
            </tr>
            <tr>
                <th>PhoneGap Build <img id="pgb" alt="" src="assets/img/phonegap_build.svg" class="edge app result-icon" /></th>
                <td><div class="bar familiar_pgb pgb"></div></td>
            </tr>
            <tr>
                <th>Edge Reflow <img id="reflow" alt="" src="assets/img/reflow.svg" class="edge app result-icon" /></th>
                <td><div class="bar familiar_reflow reflow"></div></td>
            </tr>





         </table>



    
       
    
        <h1>What one question do you want answered today?</h1>
        <div id="questions"></div>
    
    
    
    
    
    
</body>
</html>