function systemSearch(term) {
    if (term !== '') {
        console.log(term);
        $("#search_results").html('<span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span>&nbsp;Please wait while searching.').addClass("text-info").removeClass('hidden');
        $.ajax({
            type: "GET",
            url: '/search',
            data: {
                'search_text': term,
            },
            success: function (data) {
                $('body').addClass('layout-header-fixed');
                $("#search_results").html("<h3>Results for " + term + "</h3>" + data['patients'] + data['noks'] + data['credits']).removeClass("text-info").removeClass("text-danger");
            },
            error: function () {
                $("#search_results").html("An Error Occurred.").removeClass("text-info").addClass("text-danger");
            }
        });
        $(".dataTable").DataTable();
    }
}

// set required

$("input[required]").parent().addClass("required");

$(document).ready(function () {
    $('.dataTable').DataTable();
})


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


function Associate(origin = 'patient', origin_id = 0, other_id = 0) {
    $.ajax({
        type: "GET",
        url: "/nok_patient_association",
        data: {
            'origin_id': origin_id,
            'other_id': other_id,
            'origin': origin
        },
        success: function (data) {
            document.getElementById('associated').innerHTML = data.associated;
            document.getElementById('other').innerHTML = data.other;
        },
        error: function () {
            document.getElementById('associated').innerText = 'Error';
            document.getElementById('other').innerText = 'Error';
        }
    });
}

function goBack() {
    window.history.back();
}

