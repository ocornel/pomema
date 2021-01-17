// function systemSearch(term) {
//     $("#search_results").html('<span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span>&nbsp;Please wait while searching.').addClass("text-info").removeClass('hidden');
//     $.ajax({
//         type: "GET",
//         url: '/search',
//         data: {
//             'search_text': term,
//         },
//         success: function (data) {
//             $('body').addClass('layout-header-fixed');
//             $("#search_results").html("<h3>Results for " + term + "</h3>" + data['drivers'] + data['customers'] + data['vehicles'] + data['towns']).removeClass("text-info").removeClass("text-danger");
//         },
//         error: function () {
//             $("#search_results").html("An Error Occurred.").removeClass("text-info").addClass("text-danger");
//         }
//     });
// }

// set required

$("input[required]").parent().addClass("required");

$(".dataTable").dataTable();

// lazy load images
const config = {
    rootMargin: '0px 0px 50px 0px',
    threshold: 0
};

let observer = new IntersectionObserver(function (entries, self) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            preloadImage(entry.target);
            self.unobserve(entry.target)
        }
    });
}, config);

function preloadImage(target) {
    const lazyImage = target;
    lazyImage.src = lazyImage.dataset.src;
}

const imgs = document.querySelectorAll('[data-src]');
imgs.forEach(img => {
    observer.observe(img);
});

function linkText(input_string) {
    return input_string.replace(/ /g, '-').toLowerCase();
}

