$(() => {
    $('.starred').on('click', (e) => {
        console.log(e.currentTarget);
        let target = $(e.currentTarget);
        $.post(routeCourseStarred, {
            'idUser': user,
            'idCourse': target.attr('course')
        }, (data) => {
            if(data){ // starred
                target.html('<span class="text-secondary"><i class="fas fa-star"></i></span>');
            } else { // not starred
                target.html('<span class="text-secondary"><i class="far fa-star"></i></span>');
            }
        })
    })
});