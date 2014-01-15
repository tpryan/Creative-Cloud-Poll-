$(document).ready(function () {
    // Handler for .ready() called.
    pollFamiliar();
    pollQuestions();
    pollRole();
    pollOther();


});

var barMaxWidth = 300;
var rolesCreated = false;

function pollFamiliar() {
    $.ajax({
        url: "/poll/api/product.php"
    }).done(processFamiliar);
}

function pollQuestions() {
    $.ajax({
        url: "/poll/api/question.php"
    }).done(processQuestion);
}

function pollRole() {
    $.ajax({
        url: "/poll/api/role.php"
    }).done(processRole);
}

function pollOther() {
    $.ajax({
        url: "/poll/api/other.php"
    }).done(processOther);
}

function processFamiliar(e) {

    var products = jQuery.parseJSON(e);
    var higestVotes = 0;

    for (var i = 0; i < products.length; i++) {
        if (Number(products[i].votes) > higestVotes) {
            higestVotes = Number(products[i].votes);
        }
    }


    for (var i = 0; i < products.length; i++) {
        var $barToTarget = $(".familiar_" + products[i].product);
        var scaleAmount = products[i].votes / higestVotes;
        var newWidth = barMaxWidth * scaleAmount;
        $barToTarget.html('<span><span class="number">' + products[i].votes + '</span></span>');
        $barToTarget.width(newWidth);


    }

    setTimeout(pollFamiliar, 5000);

}

function processRole(e) {
    var roles = jQuery.parseJSON(e);
    var higestVotes = 0;

    if (rolesCreated !== true) {
        createRoleHTML(roles);
    }

    for (var i = 0; i < roles.length; i++) {
        if (Number(roles[i].votes) > higestVotes) {
            higestVotes = Number(roles[i].votes);
        }
    }

    for (var i = 0; i < roles.length; i++) {
        var $barToTarget = $("." + roles[i].role);
        var scaleAmount = roles[i].votes / higestVotes;
        var newWidth = barMaxWidth * scaleAmount;
        $barToTarget.html('<span><span class="number">' + roles[i].votes + '</span></span>');
        $barToTarget.width(newWidth);


    }

    setTimeout(pollRole, 5000);

}

function createRoleHTML(roles) {
    var $table = $("#role_results");
    var other = "";
    for (var i = 0; i < roles.length; i++) {


        var rowHTML = '<div class="result" >';
        rowHTML += '<div class="result-label">' + formatRole(roles[i].role) + "</div>";
        rowHTML += '<div class="bar ' + roles[i].role + '"><span><span class="number">' + roles[i].votes + '</span></span></div>';
        rowHTML += "</div>";

        if (roles[i].role == "other") {
            other = rowHTML;
        } else {
            $table.append(rowHTML);
        }
    }
    $table.append(other);
    rolesCreated = true;
}

function formatRole(string) {
    var no_underscores = string.replace("_", " ");
    var pieces = no_underscores.split(" ");
    for (var i = 0; i < pieces.length; i++) {
        var j = pieces[i].charAt(0).toUpperCase();
        pieces[i] = j + pieces[i].substr(1);
    }
    return pieces.join(" ");
}

function processQuestion(e) {
    console.log("Process Question");
    var questions = jQuery.parseJSON(e);

    $("#questions").html("");
    for (var i = 0; i < questions.length; i++) {
        if (questions[i].question.length > 0) {
            var $content = $("#questions").html();
            var newHTML = '<p class="question">' + questions[i].question + "</p>";
            $("#questions").append(newHTML);
        }
    }

    setTimeout(pollQuestions, 5000);

}

function processOther(e) {
    console.log("Process Other");
    var others = jQuery.parseJSON(e);


    $(".other-holder").html("");

    if (others.length === 0) {
        return false;
    } else {
        var list = "<ul>"

        for (var i = 0; i < others.length; i++) {
            var newHTML = '<li>' + others[i].role + "</li>";
            list += newHTML;
        }

        list += "</ul>"
    }

    $(".other-holder").html(list);
    setTimeout(pollOther, 5000);

}