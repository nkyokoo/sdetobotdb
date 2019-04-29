let active = false;

let sideBarShow = () => {
let sidebar = $('#sideBar')
    if (!active) {
        sidebar.addClass('is-shown');
        sidebar.removeClass('is-hidden');
        active = true;
    } else {
        sidebar.addClass('is-hidden')
        sidebar.removeClass('is-shown');

        active = false;

    }
}