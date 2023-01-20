const button = document.querySelector('#add-button');
button.onclick = function () {
    const div = document.createElement('div');
    const content = document.querySelector('.content-box');
    div.addClass(".card");
    content.appendChild(div);
};


let dragInfo = {
    block: '',
    id: '',
    position: '',
    duration: '',
    start: '',
    shift: '',
    end: ''
};

$(".card").on({
    'dragstart': (e) => {
        dragInfo.block = $(e.currentTarget);
        dragInfo.id = $(e.currentTarget).data("id")
        dragInfo.start = $(e.currentTarget).data("start")
        dragInfo.position = $(e.currentTarget).offset()
        dragInfo.shift = {
            x: dragInfo.position.left - e.pageX,
            y: dragInfo.position.top - e.pageY
        }
        dragInfo.duration = Math.abs(eval($(e.currentTarget).children('div').eq(0).text()))
        img = new Image();
        e.originalEvent.dataTransfer.setDragImage(img, 0, 0)
    },
    'drag': (e) => {
        let pos = {
            top: e.pageY + dragInfo.shift.y,
            left: e.pageX + dragInfo.shift.x
        }
        dragInfo.position = pos
        $(dragInfo.block).hide()
        let timeLine = document.elementFromPoint((pos.left + 75), pos.top)
        if ($(timeLine).hasClass("time-line")) {
            dragInfo.start = $(timeLine).data("hours")
        }
        $(dragInfo.block).show()
        let newEnd = parseInt(dragInfo.start) + dragInfo.duration
        dragInfo.end = newEnd < 10 ? '0' + newEnd : newEnd
        $(dragInfo.block).find('.job-duration').text(`${dragInfo.start}-${dragInfo.end}`)
        $(dragInfo.block).offset(pos)
    },
    'dragend': (e) => {
        $(dragInfo.block).hide()
        let timeLine = document.elementFromPoint((dragInfo.position.left + 75), dragInfo.position.top)
        if ($(timeLine).hasClass("time-line")) {
            $(dragInfo.block).css({ top: 0 })
            $(dragInfo.block).appendTo(timeLine)
        }
        $(dragInfo.block).show()
        console.log(dragInfo);

        $.post("update.php", { id: dragInfo.id, start: dragInfo.start, end: dragInfo.end })
    }
});

$(".time-line").on({
    'dragenter': (e) => {
        e.preventDefault()
    },
    'dragover': (e) => {
        e.preventDefault()
    },
    'drop': (e) => {

    }
})


let currentState = 1;
let states = ["modle_row.php", "modle_calendar.php"];
$("#switch").click(function () {
    currentState = (currentState + 1) % states.length;
    $.get(states[currentState], function (data) {
        $("#container").html(data);
    });
});



// 當有多種狀態時可以把要get的內容寫成物件或陣列格式
// let modeObject=['model_calendar.php','model_row.php']

// $.get(modelOjbect[currentState]),function(data){
//     $("#container").html(data)
// })

