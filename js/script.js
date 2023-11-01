const hamb = document.querySelector("#hamb");
const popup = document.querySelector("#popup");
const menu = document.querySelector("#menu").cloneNode(1);
const header = document.querySelector('#header');
const body = document.querySelector('#body');

hamb.addEventListener("click", hambHandler);

function hambHandler(e) {
    e.preventDefault();
    popup.classList.toggle("open");
    hamb.classList.toggle("active");
    body.classList.toggle("noscroll");
    header.classList.toggle("header-fixed")
    renderPopup();
}

function renderPopup() {
    popup.appendChild(menu);
}

jQuery(function ($) {
    $(document).on('click', '.link', function () {
        $('#popup').removeClass('open')
        $('#hamb').removeClass('active')
        $('body').removeClass('noscroll')
        $('#header').removeClass('header-fixed')
    })
});

jQuery(function ($) {
    $(document).on('click', '#person_btn', function () {
        $('#person_btn__dropdown').toggleClass('show')
        $('#person_btn').toggleClass('show')
    })
});

const btn = document.querySelector("#filter_bnt");
const filter = document.querySelector("#filter");
const d_filter = document.querySelector("#desctop_filter");
const form = document.querySelector("#form");


function appendBreakTag() {
    var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    var text = '';

    if (windowWidth >= 768 && windowWidth <= 991) {
        text += '<br>';
    }

    return text;
}

window.onload = function () {
    var result = appendBreakTag();
    var result = appendBreakTag();
    var result = appendBreakTag();
    var result = appendBreakTag();
    var outputElementA = document.getElementById('outputa');
    var outputElementB = document.getElementById('outputb');
    var outputElementC = document.getElementById('outputc');
    var outputElementD = document.getElementById('outputd');
    outputElementA.innerHTML = result;
    outputElementC.innerHTML = result;
    outputElementB.innerHTML = result;
    outputElementD.innerHTML = result;
};

window.addEventListener('scroll', function () {
    var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
    // console.log('Позиция скролла:', scrollPosition);
});

function scrollToPosition(position) {
    window.scrollTo({
        top: position,
        behavior: 'smooth'
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Проверяем, что находимся на главной странице
    if (window.location.pathname === '/') {
        var linkA = document.querySelector('#scrollLinkA');
        var linkB = document.querySelector('#scrollLinkB');

        linkA.addEventListener('click', function (event) {
            event.preventDefault();

            var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            var scrollPosition;

            if (windowWidth <= 425) {
                scrollPosition = 3300;
            } else if (windowWidth <= 767) {
                scrollPosition = 3288;
            } else if (windowWidth <= 1024) {
                scrollPosition = 2150;
            } else if (windowWidth <= 1440) {
                scrollPosition = 1534;
            }

            window.scrollTo({
                top: scrollPosition,
                behavior: 'smooth'
            });
        });

        linkB.addEventListener('click', function (event) {
            event.preventDefault();

            var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            var scrollPosition;

            if (windowWidth <= 425) {
                scrollPosition = 4960;
            } else if (windowWidth <= 767) {
                scrollPosition = 5050;
            } else if (windowWidth <= 1024) {
                scrollPosition = 3486;
            } else if (windowWidth <= 1440) {
                scrollPosition = 2743;
            }

            window.scrollTo({
                top: scrollPosition,
                behavior: 'smooth'
            });
        });
    }
});



// btn.addEventListener("click", filterHandler);

// function filterHandler(e) {
//     e.preventDefault();
//     if (filter && d_filter) {
//         // Копирование содержимого элемента d_filter в элемент form
//         form.innerHTML = d_filter.innerHTML;

//         // Проверка наличия элемента form перед его удалением
//         if (form.parentNode) {
//             form.parentNode.removeChild(form);
//         }

//         // Добавление элемента form внутрь элемента filter
//         filter.appendChild(form);
//     }
// }