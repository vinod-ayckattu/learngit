$(document).ready(function () {
    $("#submit").click(function (event) {
        event.preventDefault();
        $.ajax({
            url: "/register?" + new Date().getTime(),
            method: "POST",
            data: $("#myForm").serialize(),
            success: function (response) {
                console.log(response);
                let usersHtml =
                    "<table border='1'><tr><th>Sl No</th><th>Name</th><th>Email</th></tr>";
                response.forEach((user, index) => {
                    usersHtml +=
                        "<tr><td>" +
                        (index + 1) +
                        "</td><td>" +
                        user.name +
                        "</td><td>" +
                        user.email +
                        "</td></tr>";
                });
                usersHtml += "</table>";
                $("#users").html(usersHtml);
                $("#myForm")[0].reset();
            },
            error: function (xhr) {
                console.log(xhr.responseJSON.errors);
                const errors = xhr.responseJSON.errors;
                let x = Object.entries(errors);
                let errorsHtml;
                x.forEach((element) => {
                    element.forEach((msg) => {
                        errorsHtml += "<div>" + msg + "</div>";
                    });
                });
                console.log("errorhtml = " + errorsHtml);
                $("errors").html(errorsHtml);
            },
        });
    });
});
