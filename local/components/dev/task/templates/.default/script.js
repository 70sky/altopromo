$(document).ready(function () {
    $(document).on('click', '.vote-plus, .vote-minus', function () {
        var prop = "VOTE_COUNT";
        var id = $(this).parent('.task-vote').data("id");
        var value = parseInt($(this).parent('.task-vote').find('.vote-value').text());
        var plus = $(this).hasClass('vote-plus');
        if (plus) {
            value += 1;
        } else if (value != 0) {
            value -= 1;
        }

        $(this).parent('.task-vote').find('.vote-value').text(value);
        $.post("/local/components/dev/task/templates/.default/vote.php",
        {
            PROP: prop,
            ID: id,
            VALUE: value
        })
        .done(function() {        
        })
        .fail(function() {
            alert ("При отправки данных произошла ошибка.");
        });
    });
});