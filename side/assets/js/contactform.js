$(document).ready(() => {

    $.get("/api/getcategories.php", (data) => {
        let categoryList = document.getElementById("categoryList")
        let option;
        for (let category of data) {
            console.log(category)
            option  = document.createElement('option');
            option.innerText = category.id + " - " + category.name
            categoryList.appendChild(option)
            console.log(option)

        }


    });


});