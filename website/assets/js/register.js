
$("#register_btn").on('click', registerUser = () => {
    let name = document.getElementById('registerName')
    let email = document.getElementById('registerEmail')
    let password = document.getElementById('password_1')
    let password2 = document.getElementById('password_2')

    if (name.value !== "" && email.value !== "" && password.value !== "" && password2.value !== "") {
        if (password.value === password2.value) {
            $.post("http://localhost:8000/api/users/register", {
                name: name.value,
                email: email.value,
                password: password.value,


            }, (data) => {
                console.log(data.code)
                if (data.code === 200) {
                    window.location.replace("/login")
                } else {
                   alert(data.message)
                }
            })
        } else {
            alert("passwords don't match")
        }
    } else {
       alert("fill something in")

    }

});
let  Userlogin = () => {
    let email = document.getElementById('InputEmailLogin')
    let password = document.getElementById('InputPasswordLogin')

    if (email.value !== "" || password.value !== "") {
        $.post("", {
            email: email.value,
            password: password.value,
        }, (data) => {
            if (data.code === 200) {
                window.location.replace("/")

            } else {
                alert(data.message)

            }
        })
    } else {
      alert("fill something in")
    }
}
