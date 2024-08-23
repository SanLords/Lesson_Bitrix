BX.ready(function() {
    // 1. Спомощью document.querySelectorAll получить все DOM-элементы с классом star
    var stars = document.querySelectorAll('.star');

    // 2. Повесить обработчик события на click
    stars.forEach(function(element) {
        BX.bind(element, "click", clickStar);
    });
});

function clickStar(event) {
    event.preventDefault();

    // Получить agentID, в template.php добавьте тегу в классов star атрибут dataset
    // cо значением ID элемента Агента
    var agentID = event.currentTarget.dataset.agentId;

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
                    console.log(response); // консоле можно будет увидеть ответ от бэка, для разработки в конечном коде лучше убрать
                    let data = response.data;
                    if (data['action'] == 'success') {
                        // Отобразить пользователю, что агент добавлен в избранное (желтая звездочка, есть в верстке)
                        event.currentTarget.classList.toggle('active');
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