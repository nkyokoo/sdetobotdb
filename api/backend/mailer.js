const nodemailer = require('nodemailer');

// async..await is not allowed in global scope, must use a wrapper
module.exports = {

    sendmail:async function(verifykey, email) {


    let transporter = nodemailer.createTransport({
        service: 'gmail',
        port: 465,
        secure: true,
        auth:{
            'user':'sdebookingsystem@gmail.com',
            'pass':'n6*M93SD'
        }
    });

    // send mail with defined transport object
    let info = await transporter.sendMail({
        from: 'SDE ROBOT LÅNESYSTEM <sdebookingsystem@gmail.com>', // sender address
        to: `${email},${email}`, // list of receivers
        subject: 'Aktiver konto på Sde låne systemet', // Subject line
        html: `<h1>Lånesystem for robot og automationsteknologi</h1>
                <p>Hej, Du kan aktivere din konto på lånesystemet ved at trykke på linket</p>
                <a style="color: white; box-shadow:  1px 2px 11px 1px #4f4f4f; padding:10px 37px;background-color:#c93643;font-weight:bold;text-shadow:0px -1px 0px #5b6178;" href='https://localhost/users/verify?key=${verifykey}'>aktivér</a>` // html body
    });
        transporter.verify(function(error, success) {
            if (error) {
                console.log(error);
            } else {
                console.log("Server is ready to take our messages");
            }
        });

    }
}

