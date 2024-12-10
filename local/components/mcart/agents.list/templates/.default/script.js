BX.ready(function() {
    let stars = document.querySelectorAll('.star');
    for (let star of stars) {
        BX.bind(star, "click", clickStar);
    }
});
function clickStar(event) {
    event.preventDefault();
    let agentID = event.currentTarget.dataset.agentId;
    if (agentID) { // если ID есть, то делаем ajax-запрос
        BX.ajax // https://dev.1c-bitrix.ru/api_help/js_lib/ajax/bx_ajax_runcomponentaction.php
            .runComponentAction(
                "mcart:agents.list", // название компонента
                "clickStar", // название метода, который будет вызван из class.php
                {
                    mode: "class", //это означает, что мы хотим вызывать действие из class.php
                    data: {
                        agentID: agentID // параметры, которые передаются на бэк
                    },
                }
            )
            .then( // если на бэке нет ошибок выполниться
                BX.proxy((response) => {
                    let data = response.data;
                    if (data['action'] == 'success') {
                        if ($(this).hasClass('active')) {

                            $(this).removeClass('active')
                        } else {
                            $(this).addClass('active');
                        }
                    }
                }, this)
            )
            .catch( // если на бэке есть ошибки выполниться
                BX.proxy((response) => {
                    console.log(response.errors);
                }, this)
            );
    }

}
