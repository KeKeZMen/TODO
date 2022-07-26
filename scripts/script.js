const counter = () => {
    $('.created-counter').html($('.task').length)
    $('.completed-counter').html($('.btn-success').length)
}

$('.btn-add').on('click', (event) => {
    event.preventDefault()

    if (!$('.task-input').val()) {
        swal('Вы долбоеб!', 'Вы не ввели текст задачи!', 'error')
        return false
    }

    if($('.task-input').val().length >= 100){
        swal('Вы еблан!', 'Текст задачи не может превышать 100 символов!', 'error')
        return false
    }

    let taskText = $('.task-input').val()
    $.ajax({
        url: './vendor/add_task.php',
        method: 'post',
        dataType: 'html',
        data: {text: taskText},
        success: id => {
            $('.tasks').append(`
            <div class="task">
            <button data-id="${id}" class="btnTaskStatus btn-unsuccess"></button>
            <p>${taskText}</p>
            <button data-id="${id}" class="btn-delete"></button>
            </div>`)

            $('.task-input').val('')

            counter()
        }
    })
})

$('.tasks').on('click', (e) => {
    if ($(e.target).hasClass('btnTaskStatus')) {
        let task = $(e.target)
        
        $.ajax({
            url: './vendor/set_task_status.php',
            method: 'post',
            dataType: 'html',
            data: {text:task.attr('data-id')},
            success: () => {
                $(e.target).toggleClass('btn-success').toggleClass('btn-unsuccess')
                task.parent().children('p').toggleClass('done')
                counter()
            }
        })
    }
    
    if ($(e.target).hasClass('btn-delete')) {
        let task = $(e.target)
        
        swal("Вы уверены, что хотите удалить задачу?", {buttons: { cancel: {value: false}, unsuccess: {text: "Нет", value: false}, success: {text: "Да", value: true} }})
        .then(value => {
            if (value) {
                $.ajax({
                    url: './vendor/delete_task.php',
                    method: 'post',
                    dataType: 'html',
                    data: {text: task.attr('data-id')},
                    success: () => {
                        task.parent().remove()
                        counter()
                    }
                })
            }
        })
    }
})