$("#accept").click(function () {
            $.ajax({
            url: "../page/functions.php", // путь к одработчику (прописать свой)
            data: {musicians_ismodered: 1}, // передаваемые параметры в обработчик
            type: 'POST', // или GET - метод передачи данных // тип данных в ожидаемом ответе
        });
    });
