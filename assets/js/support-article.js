var master;
const faqs = [24, 50, 150, 51, 142, 190, 33, 165, 92, 197, 212, 213];

$(document).ready(function() {
    master_data();
});

var master_data = function() {
    $.ajax({
        url: webUrl + 'assets/support-articles.json',
        async: false,
        success: function(data) {
            master = data;
        }
    });
};

var generate_faq_sliders = function() {
    // $('#supportArticles').html('');
    var temp1 = ''; // outer div
    var temp2 = ''; // inner div
    $.each(master.category, function(key, cat) {
        var questions = master.questions.filter(que => que.category_id === cat.id);
        temp2 += help_card_html(cat, questions.slice(0, 3));

        if ((key + 1) % 6 == 0) {
            $('#supportArticles').append('<div>' + temp1 + '<div class="row no-gutters">' + temp2 + '</div></div>');
            temp1 = '';
            temp2 = '';
        } else if ((key + 1) % 3 == 0) {
            temp1 = '<div class="row no-gutters">' + temp2 + '</div><div class="devide"></div>';
            temp2 = '';
        }
    });
    if (temp2 != '' || temp1 != '') {
        if (temp1 != '')
            $('#supportArticles').append('<div>' + temp1 + '<div class="row no-gutters">' + temp2 + '</div></div>');
        else
            $('#supportArticles').append('<div>' + temp2 + '</div>');
    }
}

var help_card_html = function(category, questions) {
    var ques = '';
    $.each(questions, function(key, question) {
        ques += '<a href="faqlist.php?category=' + category.id + '&question=' + question.id + '" class="text">' + question.question + '</a>';
    });

    return `<div class="col-sm-12 col-md-12 col-lg-4">
    <div href="#" class="help-card">
        <div class="icon">
            <img src="` + category.icon + `" loading="lazy">
        </div>
        <div class="content">
            <div class="body">
                <a href="faqlist.php?category=` + category.id + `" class="heading">` + category.title + `</a>
                ` + ques + `
            </div>
            <a href="faqlist.php?category=` + category.id + `" class="cta">More</a>
        </div>
    </div>
</div>`;
}

var find_questions_based_on_category = function(category_id, question_id) {
        console.log(category_id + ' ' + question_id);
        var category = master.category.filter(cat => cat.id == category_id);
        if (category.length == 0)
            category = master.category.slice(0, 1);
        $('.categoryName').html(category[0].title);
        var questions = master.questions.filter(que => que.category_id === category[0].id);
        $.each(questions, function(key, question) {
            $('#accordionExample').append(`<div class="faq-list-item">
            <button class="ques" type="button" data-toggle="collapse" data-target="#p` + question.id + `" aria-expanded="false" aria-controls="p` + question.id + `">
                ` + question.question + `
            </button>
            <div id="p` + question.id + `" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                ` + question.answer + `
            </div>
        </div>`);
        });

        if (question_id) {
            $('#p' + question_id).addClass('show');
            $('button[data-target=#p' + question_id + ']').attr('aria-expanded', true);
            $('html, body').animate({
                scrollTop: $('button[data-target=#p' + question_id + ']').closest('.faq-list-item').offset().top - 60
            }, 10);
        }
    }
    //Manage Articles
var manage_article = function(article_id) {
    if (article_id) {
        $('#' + article_id).addClass('active');
    }
}
$('.search-input').on('keyup', function() {
    var keyword = $(this).val().trim();
    $('.suggest-result').find('.result-item').remove();
    if (keyword.length < 3)
        return false;

    var categories = master.category.filter(cat => cat.title.toLowerCase().indexOf(keyword.toLowerCase()) != -1);
    if (categories.length < 10)
        var questions = master.questions.filter(que => que.question.toLowerCase().indexOf(keyword.toLowerCase()) != -1);

    for (var i = 0; i < categories.length; i++) {
        $('.suggest-result').append('<li class="result-item"><a href="faqlist.php?category=' + categories[i].id + '"><span>' + categories[i].title + '</span></a></li>');
    }
    for (var i = 0; i < 10 - categories.length && i < questions.length; i++) {
        $('.suggest-result').append('<li class="result-item"><a href="faqlist.php?category=' + questions[i].category_id + '&question=' + questions[i].id + '"><span>' + questions[i].question + '</span></a></li>');
    }
    $('.suggest-result li').show();
});

var create_generic_faqs = function() {
    $.each(faqs, function(key, value) {
        var questions = master.questions.filter(que => que.id === value);
        if (questions.length > 0) {
            $('#accordionExample').find('.row').append(`<div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="faq-list-item">
                        <button class="ques" type="button" data-toggle="collapse" data-target="#p` + questions[0].id + `" aria-expanded="false" aria-controls="p` + questions[0].id + `">
                            ` + questions[0].question + `
                        </button>
                        <div id="p` + questions[0].id + `" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            ` + questions[0].answer + `
                        </div>
                    </div>
                </div>`);
        }
    });
}