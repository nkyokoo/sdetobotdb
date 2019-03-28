 let sendMail = () => {
     let content = document.getElementById('Message-input')
     let category = document.getElementById('categoryList')
     let title = document.getElementById('messageTitle')

     if (title.value !== "" && content.value !== "" && category.value !== "") {
         $.post("api/sendEmail.php", {
             title:  category.options[category.selectedIndex].value + "-" + title.value,
             content: content.value,

         },  (data) => {
             alert(data)
         })
     } else {
         alert("error")


     }

 }
